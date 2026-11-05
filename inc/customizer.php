<?php
if (!defined('ABSPATH')) exit;

/**
 * No-code settings panel (Appearance → Customize → "LoanPt …").
 * Lets the owner edit rates, hero text, phone and links without touching code.
 * loanpt_opt() reads a saved value, falling back to the theme default/constant.
 */

function loanpt_opt($key, $default = '') {
    $v = get_theme_mod('loanpt_' . $key, $default);
    return ($v === '' || $v === null) ? $default : $v;
}

/** Hero headline: wrap *text* in green <em>. */
function loanpt_headline_html() {
    $h = esc_html(loanpt_opt('headline', 'Compare Personal Loans from *Every Bank*, Get the Lowest Rate'));
    return preg_replace('/\*(.+?)\*/', '<em>$1</em>', $h);
}

add_action('customize_register', function ($wp) {

    /* ---- Contact & Links ---- */
    $wp->add_section('loanpt_contact', array('title' => 'LoanPt — Contact & Links', 'priority' => 30));
    $contact = array(
        'phone'         => array('Phone number', LOANPT_PHONE, 'sanitize_text_field'),
        'wa'            => array('WhatsApp number (with 91, e.g. 919625913455)', LOANPT_WA, 'sanitize_text_field'),
        'email'         => array('Email', LOANPT_EMAIL, 'sanitize_email'),
        'crm_lead_url'  => array('CRM lead endpoint URL', LOANPT_CRM_LEAD_URL, 'esc_url_raw'),
        'connector_url' => array('Connector login URL', LOANPT_CONNECTOR_URL, 'esc_url_raw'),
        'team_url'      => array('Team login URL', LOANPT_TEAM_URL, 'esc_url_raw'),
        'google_client_id' => array('Google Login Client ID (Customer Login)', '', 'sanitize_text_field'),
    );
    foreach ($contact as $k => $f) {
        $wp->add_setting('loanpt_' . $k, array('default' => $f[1], 'sanitize_callback' => $f[2], 'transport' => 'refresh'));
        $wp->add_control('loanpt_' . $k, array('label' => $f[0], 'section' => 'loanpt_contact', 'type' => 'text'));
    }

    /* ---- Hero (top banner) ---- */
    $wp->add_section('loanpt_hero', array('title' => 'LoanPt — Hero (top banner)', 'priority' => 31));
    $hero = array(
        'eyebrow'  => array('Eyebrow / tagline', 'Credit in Pocket', 'text'),
        'headline' => array('Headline — wrap a word in *stars* to make it green', 'Compare Personal Loans from *Every Bank*, Get the Lowest Rate', 'text'),
        'subtext'  => array('Sub-text under the headline', 'Personal Loan, Overdraft & Balance Transfer offers from HDFC, Kotak, ICICI, Axis, Bajaj & more — matched to your profile. Check eligibility free and apply in minutes.', 'textarea'),
    );
    foreach ($hero as $k => $f) {
        $wp->add_setting('loanpt_' . $k, array('default' => $f[1], 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'refresh'));
        $wp->add_control('loanpt_' . $k, array('label' => $f[0], 'section' => 'loanpt_hero', 'type' => $f[2]));
    }

    /* ---- Bank comparison ---- */
    $wp->add_section('loanpt_banks', array('title' => 'LoanPt — Bank Comparison', 'priority' => 32));
    $wp->add_setting('loanpt_banks_text', array('default' => loanpt_banks_default_text(), 'sanitize_callback' => 'sanitize_textarea_field', 'transport' => 'refresh'));
    $wp->add_control('loanpt_banks_text', array(
        'label'       => 'Banks — one per line',
        'description' => 'Format each line as:  Bank | Rate | Loan up to | Tenure | Processing fee',
        'section'     => 'loanpt_banks',
        'type'        => 'textarea',
    ));

    /* ---- Analytics & Tracking ---- */
    $wp->add_section('loanpt_analytics', array('title' => 'LoanPt — Analytics & Tracking', 'priority' => 33));
    $wp->add_setting('loanpt_ga4_id', array('default' => '', 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'refresh'));
    $wp->add_control('loanpt_ga4_id', array('label' => 'Google Analytics 4 ID', 'description' => 'e.g. G-XXXXXXXXXX', 'section' => 'loanpt_analytics', 'type' => 'text'));
    $wp->add_setting('loanpt_pixel_id', array('default' => '', 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'refresh'));
    $wp->add_control('loanpt_pixel_id', array('label' => 'Meta (Facebook) Pixel ID', 'description' => 'the numeric Pixel ID from Meta Events Manager', 'section' => 'loanpt_analytics', 'type' => 'text'));
});
