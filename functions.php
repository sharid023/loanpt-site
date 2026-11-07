<?php
if (!defined('ABSPATH')) exit;

/**
 * LoanPt theme setup, assets, SEO head, and lead → CRM forwarding.
 * CRM endpoint can be overridden in wp-config.php:
 *   define('LOANPT_CRM_LEAD_URL', 'https://loanpt-crm.onrender.com/api/v1/leads/web-lead');
 */

if (!defined('LOANPT_CRM_LEAD_URL')) {
    define('LOANPT_CRM_LEAD_URL', 'https://loanpt-crm.onrender.com/api/v1/leads/web-lead');
}
if (!defined('LOANPT_PHONE'))    define('LOANPT_PHONE', '9625913455');
if (!defined('LOANPT_WA'))       define('LOANPT_WA', '919625913455');
if (!defined('LOANPT_EMAIL'))    define('LOANPT_EMAIL', 'connect@loanpt.com');
// Login links shown in the header/footer. Override in wp-config.php if your URLs differ.
if (!defined('LOANPT_TEAM_URL'))      define('LOANPT_TEAM_URL', 'https://crm.loanpt.com/login');
if (!defined('LOANPT_CONNECTOR_URL')) define('LOANPT_CONNECTOR_URL', 'https://crm.loanpt.com/portal');
// Google Sign-In (Customer Login). Public Web client ID — safe in code. Customizer can override.
if (!defined('LOANPT_GOOGLE_CLIENT_ID')) define('LOANPT_GOOGLE_CLIENT_ID', '903243722094-8mr9745qp45n8htev12kbnqec6nvg7oh.apps.googleusercontent.com');

function loanpt_setup() {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('html5', array('search-form', 'script', 'style'));
    // Lets the owner upload a logo under Appearance → Customize → Site Identity.
    add_theme_support('custom-logo', array(
        'height'      => 60,
        'width'       => 220,
        'flex-height' => true,
        'flex-width'  => true,
    ));
    register_nav_menus(array('primary' => 'Primary Menu'));
}
add_action('after_setup_theme', 'loanpt_setup');

function loanpt_assets() {
    wp_enqueue_style('loanpt-font', 'https://fonts.googleapis.com/css2?family=Poppins:wght@500;600;700;800&display=swap', array(), null);
    wp_enqueue_style('loanpt-style', get_stylesheet_uri(), array(), '1.16.0');
    wp_enqueue_script('loanpt-app', get_template_directory_uri() . '/assets/app.js', array(), '1.15.0', true);
    wp_localize_script('loanpt-app', 'LOANPT', array(
        'leadUrl' => esc_url_raw(rest_url('loanpt/v1/lead')),
        'home'    => esc_url_raw(home_url('/')),
        'wa'      => 'https://wa.me/' . loanpt_opt('wa', LOANPT_WA) . '?text=' . rawurlencode('Hi LoanPt, I just applied on your website — I want to know about a loan.'),
    ));
}
add_action('wp_enqueue_scripts', 'loanpt_assets');

/* SEO: sensible meta description + Organization/FAQ structured data on the homepage.
   (Install Rank Math or Yoast to control per-page titles/descriptions at scale.) */
function loanpt_head() {
    if (is_front_page()) {
        $desc = 'Compare personal loan, overdraft & balance transfer offers from HDFC, Kotak, Axis, ICICI, Bajaj & more. Check eligibility free, get the lowest rate. Zero cost — LoanPt.';
        echo '<meta name="description" content="' . esc_attr($desc) . '">' . "\n";
        echo '<meta property="og:type" content="website"><meta property="og:site_name" content="LoanPt">' . "\n";
        $ld = array(
            '@context' => 'https://schema.org',
            '@graph'   => array(
                array('@type' => 'FinancialService', '@id' => home_url('/#org'), 'name' => 'LoanPt', 'url' => home_url('/'), 'telephone' => '+91-' . loanpt_opt('phone', LOANPT_PHONE), 'email' => loanpt_opt('email', LOANPT_EMAIL), 'slogan' => 'Credit in Pocket', 'areaServed' => 'IN', 'description' => 'Loan facilitation service helping salaried professionals compare and get personal loans, overdraft and balance transfer at the best rates from partner banks.'),
                array('@type' => 'FAQPage', 'mainEntity' => array(
                    array('@type' => 'Question', 'name' => 'Is LoanPt free to use?', 'acceptedAnswer' => array('@type' => 'Answer', 'text' => 'Yes. Comparing offers and applying through LoanPt is completely free for you. We are paid by the lender, not by you.')),
                    array('@type' => 'Question', 'name' => 'Which banks can I compare?', 'acceptedAnswer' => array('@type' => 'Answer', 'text' => 'Leading banks and NBFCs including HDFC, Kotak, ICICI, Axis, Bajaj Finserv and more.')),
                    array('@type' => 'Question', 'name' => 'What interest rate will I get?', 'acceptedAnswer' => array('@type' => 'Answer', 'text' => 'Rates depend on the lender, the product and your profile. The final rate is decided by the lender after approval.')),
                )),
            ),
        );
        echo '<script type="application/ld+json">' . wp_json_encode($ld) . '</script>' . "\n";
    }
}
add_action('wp_head', 'loanpt_head', 5);

/* Analytics: GA4 + Meta Pixel. IDs set in Customize → "LoanPt — Analytics & Tracking".
   Nothing is output until an ID is provided. */
function loanpt_analytics() {
    $ga = preg_replace('/[^A-Za-z0-9\-]/', '', (string) loanpt_opt('ga4_id', ''));
    $px = preg_replace('/[^0-9]/', '', (string) loanpt_opt('pixel_id', ''));
    if ($ga) {
        echo "\n<!-- Google Analytics (GA4) -->\n";
        echo '<script async src="https://www.googletagmanager.com/gtag/js?id=' . esc_attr($ga) . '"></script>' . "\n";
        echo '<script>window.dataLayer=window.dataLayer||[];function gtag(){dataLayer.push(arguments);}gtag("js",new Date());gtag("config","' . esc_js($ga) . '");</script>' . "\n";
    }
    if ($px) {
        echo "\n<!-- Meta Pixel -->\n";
        echo '<script>!function(f,b,e,v,n,t,s){if(f.fbq)return;n=f.fbq=function(){n.callMethod?n.callMethod.apply(n,arguments):n.queue.push(arguments)};if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version="2.0";n.queue=[];t=b.createElement(e);t.async=!0;t.src=v;s=b.getElementsByTagName(e)[0];s.parentNode.insertBefore(t,s)}(window,document,"script","https://connect.facebook.net/en_US/fbevents.js");fbq("init","' . esc_js($px) . '");fbq("track","PageView");</script>' . "\n";
        echo '<noscript><img height="1" width="1" style="display:none" alt="" src="https://www.facebook.com/tr?id=' . esc_attr($px) . '&ev=PageView&noscript=1"/></noscript>' . "\n";
    }
}
add_action('wp_head', 'loanpt_analytics', 1);

/* Lead REST endpoint: receives the form (same-origin, no CORS) and forwards
   server-side to the CRM. Returns {ok:true} on success. */
require get_template_directory() . '/inc/leads.php';

/* No-code settings panel (Appearance → Customize → "LoanPt …"). */
require get_template_directory() . '/inc/customizer.php';

/* SEO landing pages (the content machine): /personal-loan, /balance-transfer, /overdraft. */
require get_template_directory() . '/inc/seo-pages.php';

/* Default bank comparison rows, as the editable "one per line" text. */
function loanpt_banks_default_text() {
    return "HDFC Bank | 10.50%* | ₹40 Lakh | 12–72 mo | Up to 2%\n" .
           "ICICI Bank | 10.75%* | ₹50 Lakh | 12–72 mo | Up to 2%\n" .
           "Axis Bank | 10.99%* | ₹40 Lakh | 12–84 mo | Up to 2%\n" .
           "Kotak Mahindra | 10.99%* | ₹35 Lakh | 12–72 mo | Up to 3%\n" .
           "Bajaj Finserv | 11.00%* | ₹55 Lakh | 12–96 mo | Up to 3.5%\n" .
           "IDFC First | 10.99%* | ₹1 Crore | 12–60 mo | Up to 2%";
}

/* Comparison data — read from the Customizer textarea (editable, no code). */
function loanpt_banks() {
    $text = get_theme_mod('loanpt_banks_text', loanpt_banks_default_text());
    $rows = array();
    foreach (preg_split('/\r\n|\r|\n/', (string) $text) as $line) {
        $line = trim($line);
        if ($line === '') continue;
        $c = array_map('trim', explode('|', $line));
        if ($c[0] === '') continue;
        $rows[] = array(
            isset($c[0]) ? $c[0] : '',
            isset($c[1]) ? $c[1] : '',
            isset($c[2]) ? $c[2] : '',
            isset($c[3]) ? $c[3] : '',
            isset($c[4]) ? $c[4] : '',
        );
    }
    return $rows;
}
