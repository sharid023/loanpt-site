<?php
if (!defined('ABSPATH')) exit;

/**
 * POST /wp-json/loanpt/v1/lead
 * Receives the website lead form and forwards it server-side to the LoanPt CRM
 * (no browser CORS needed). Honest intake only — never collects OTP/card/bank.
 */
add_action('rest_api_init', function () {
    register_rest_route('loanpt/v1', '/lead', array(
        'methods'             => 'POST',
        'permission_callback' => '__return_true',
        'callback'            => 'loanpt_handle_lead',
    ));
});

function loanpt_handle_lead(WP_REST_Request $req) {
    $p = $req->get_json_params();
    if (!is_array($p)) $p = $req->get_params();

    $name   = isset($p['name'])   ? sanitize_text_field($p['name'])   : '';
    $mobile = isset($p['mobile']) ? preg_replace('/\D/', '', $p['mobile']) : '';

    if (strlen($name) < 2) {
        return new WP_REST_Response(array('ok' => false, 'error' => 'Please enter your name.'), 400);
    }
    if (!preg_match('/^[6-9]\d{9}$/', $mobile)) {
        return new WP_REST_Response(array('ok' => false, 'error' => 'Enter a valid 10-digit mobile number.'), 400);
    }

    $payload = array(
        'name'    => $name,
        'mobile'  => $mobile,
        'product' => isset($p['product']) ? sanitize_text_field($p['product']) : '',
        'amount'  => isset($p['amount'])  ? sanitize_text_field($p['amount'])  : '',
        'city'    => isset($p['city'])    ? sanitize_text_field($p['city'])    : '',
        'email'   => isset($p['email'])   ? sanitize_email($p['email'])        : '',
        'source'  => 'website_wp',
        'utm'     => array(
            'source' => 'website',
            'medium' => isset($p['ref']) && $p['ref'] !== '' ? 'referral' : 'organic',
            'tool'   => isset($p['tool']) ? sanitize_text_field($p['tool']) : 'wp_home',
            'ref'    => isset($p['ref']) ? sanitize_text_field($p['ref']) : '',
        ),
    );

    $res = wp_remote_post(loanpt_opt('crm_lead_url', LOANPT_CRM_LEAD_URL), array(
        'timeout' => 15,
        'headers' => array('Content-Type' => 'application/json'),
        'body'    => wp_json_encode($payload),
    ));

    if (is_wp_error($res)) {
        // Don't lose the lead: log it so the admin can recover it from wp-admin.
        error_log('[LoanPt] lead forward failed: ' . $res->get_error_message() . ' | ' . wp_json_encode($payload));
        return new WP_REST_Response(array('ok' => true, 'note' => 'queued'), 200);
    }

    $code = wp_remote_retrieve_response_code($res);
    if ($code >= 200 && $code < 300) {
        return new WP_REST_Response(array('ok' => true), 200);
    }
    error_log('[LoanPt] CRM rejected lead (' . $code . '): ' . wp_remote_retrieve_body($res));
    return new WP_REST_Response(array('ok' => true, 'note' => 'received'), 200);
}

/**
 * POST /wp-json/loanpt/v1/apply  — career / job application.
 * Emails HR (best effort) AND forwards a career-tagged lead to the CRM so an
 * application is never lost even if email delivery is not configured.
 */
add_action('rest_api_init', function () {
    register_rest_route('loanpt/v1', '/apply', array(
        'methods'             => 'POST',
        'permission_callback' => '__return_true',
        'callback'            => 'loanpt_handle_application',
    ));
});

function loanpt_handle_application(WP_REST_Request $req) {
    $p = $req->get_json_params();
    if (!is_array($p)) $p = $req->get_params();

    $name   = isset($p['name'])       ? sanitize_text_field($p['name'])       : '';
    $mobile = isset($p['mobile'])     ? preg_replace('/\D/', '', $p['mobile']) : '';
    $email  = isset($p['email'])      ? sanitize_email($p['email'])            : '';
    $pos    = isset($p['position'])   ? sanitize_text_field($p['position'])    : '';
    $exp    = isset($p['experience']) ? sanitize_text_field($p['experience'])  : '';
    $city   = isset($p['city'])       ? sanitize_text_field($p['city'])        : '';
    $resume = isset($p['resume'])     ? esc_url_raw(trim((string) $p['resume'])) : '';
    $msg    = isset($p['message'])    ? sanitize_textarea_field($p['message'])  : '';

    if (strlen($name) < 2) {
        return new WP_REST_Response(array('ok' => false, 'error' => 'Please enter your name.'), 400);
    }
    if (!preg_match('/^[6-9]\d{9}$/', $mobile)) {
        return new WP_REST_Response(array('ok' => false, 'error' => 'Enter a valid 10-digit mobile number.'), 400);
    }

    // 1) Email HR (best effort — won't block the response if mail isn't configured).
    $to   = loanpt_opt('email', LOANPT_EMAIL);
    $body = "New career application via loanpt.com\n\n"
          . "Name: {$name}\n"
          . "Mobile: {$mobile}\n"
          . "Email: " . ($email ?: '—') . "\n"
          . "Position: " . ($pos ?: '—') . "\n"
          . "Experience: " . ($exp ?: '—') . "\n"
          . "City: " . ($city ?: '—') . "\n"
          . "Resume/LinkedIn: " . ($resume ?: '—') . "\n"
          . "Message: " . ($msg ?: '—') . "\n";
    $headers = array();
    if ($email) $headers[] = 'Reply-To: ' . $name . ' <' . $email . '>';
    @wp_mail($to, 'New job application: ' . ($pos ?: 'LoanPt') . ' — ' . $name, $body, $headers);

    // 2) Forward to the CRM as a career-tagged lead (reliable — same path as web leads).
    $payload = array(
        'name'    => $name,
        'mobile'  => $mobile,
        'email'   => $email,
        'product' => 'Career — ' . ($pos ?: 'General'),
        'city'    => $city,
        'amount'  => $exp,
        'note'    => trim("Experience: {$exp} | Resume: {$resume} | {$msg}"),
        'source'  => 'website_career',
        'utm'     => array('source' => 'website', 'medium' => 'career', 'tool' => 'career'),
    );
    $res = wp_remote_post(loanpt_opt('crm_lead_url', LOANPT_CRM_LEAD_URL), array(
        'timeout' => 15,
        'headers' => array('Content-Type' => 'application/json'),
        'body'    => wp_json_encode($payload),
    ));
    if (is_wp_error($res)) {
        error_log('[LoanPt] career application (CRM forward failed): ' . wp_json_encode($payload));
    }

    return new WP_REST_Response(array('ok' => true), 200);
}
