<?php
if (!defined('ABSPATH')) exit;

/**
 * SEO landing pages (the content machine). Each product gets its own URL,
 * content, FAQ schema and lead form — all deployed via theme/OTA. The pages are
 * auto-created as real WordPress Pages (good permalinks, sitemap, no 404) that
 * use the "LoanPt Landing" template. Bump LOANPT_PAGES_VER to re-seed.
 */

define('LOANPT_PAGES_VER', '3');

/** Content for each landing page, keyed by URL slug (base products + city pages). */
function loanpt_landing_data() {
    $base = array(
        'personal-loan' => array(
            'title' => 'Personal Loan — Compare & Apply at the Lowest Rate',
            'h1'    => 'Personal Loan — Compare Offers from <em>Every Bank</em>',
            'meta'  => 'Compare personal loan offers from HDFC, Kotak, ICICI, Axis, Bajaj & more. Check eligibility free, get the lowest rate with minimal paperwork. Apply with LoanPt — zero cost.',
            'product' => 'Personal Loan',
            'intro' => 'A personal loan gives you quick, collateral-free funds for anything — a wedding, a medical emergency, travel, home renovation or consolidating existing debt — with a fixed EMI you plan around. At LoanPt we compare offers across leading banks and NBFCs, match you to the lowest rate your profile qualifies for, and handle the paperwork end to end. It is completely free for you.',
            'bullets' => array('Loan up to ₹50 Lakh+', 'Tenure up to 84 months', 'Minimal documents', 'Quick disbursal', 'Fixed, predictable EMI', 'No collateral needed'),
            'compare' => true,
            'faq' => array(
                'Who is eligible for a personal loan?' => 'Typically salaried or self-employed applicants with a steady income and a reasonable credit score. We check your profile against multiple banks and tell you the best fit — free.',
                'What documents do I need?' => 'Usually ID & address proof, PAN, and recent salary slips or bank statements. We guide you through the exact list for the bank you qualify for.',
                'What interest rate will I get?' => 'It depends on the bank, your income and credit profile, so it is decided by the lender. We pull competitive partner-bank offers and never promise a fixed rate upfront.',
                'Is there any fee to use LoanPt?' => 'No — our service is free to you. Lenders may charge their own processing fee, shown transparently.',
            ),
        ),
        'balance-transfer' => array(
            'title' => 'Personal Loan Balance Transfer — Lower Your EMI',
            'h1'    => 'Balance Transfer — Move to a <em>Lower Rate</em>, Cut Your EMI',
            'meta'  => 'Transfer your existing personal loan to a lower interest rate, reduce your EMI, or take a top-up. Compare balance-transfer offers with LoanPt — free, minimal paperwork.',
            'product' => 'Balance Transfer',
            'intro' => 'Paying a high interest rate on your current personal loan? A balance transfer moves your outstanding loan to another bank at a lower rate — reducing your EMI and the total interest you pay over the tenure. You can also take a top-up for extra funds along with the transfer. LoanPt compares balance-transfer offers and manages the switch for you, end to end.',
            'bullets' => array('Lower interest rate', 'Reduced monthly EMI', 'Top-up for extra funds', 'Save on total interest', 'Minimal paperwork', 'Fully managed switch'),
            'compare' => true,
            'faq' => array(
                'What is a personal loan balance transfer?' => 'It is moving your existing loan\'s outstanding balance to a new lender offering a lower interest rate, so your EMI and total interest come down.',
                'When is a balance transfer worth it?' => 'Usually when you still have a good chunk of tenure left and the new rate is meaningfully lower than your current one. We help you check if it actually saves you money.',
                'Can I get extra money during a transfer?' => 'Often yes — many lenders offer a top-up over the transferred amount, subject to eligibility.',
                'Does LoanPt charge for this?' => 'No, our service is free to you. The lender may have its own processing fee, shown upfront.',
            ),
        ),
        'overdraft' => array(
            'title' => 'Overdraft Loan (OD) — A Credit Limit You Use Anytime',
            'h1'    => 'Overdraft (OD) — Pay Interest Only on <em>What You Use</em>',
            'meta'  => 'Get an overdraft facility — a credit limit you draw from anytime, paying interest only on the amount and days you use. Ideal for cash-flow. Compare OD options with LoanPt.',
            'product' => 'Overdraft',
            'intro' => 'An overdraft (OD) gives you a pre-approved credit limit you can dip into whenever you need it — and you pay interest only on the amount you actually use, for the days you use it. Repay and reuse as often as you like, with no fixed EMI. It is ideal for managing cash-flow, business needs or irregular expenses. LoanPt helps you get the right OD limit from partner banks and NBFCs.',
            'bullets' => array('Use anytime up to your limit', 'Interest only on the used amount', 'Repay & reuse (revolving)', 'No fixed EMI', 'Great for cash-flow', 'Fast, managed setup'),
            'compare' => false,
            'faq' => array(
                'What is an overdraft (OD) facility?' => 'A sanctioned credit limit you can withdraw from as needed. You pay interest only on the amount used and for the period used — not on the full limit.',
                'How is OD different from a personal loan?' => 'A personal loan is a fixed amount with a fixed EMI. An OD is a flexible limit — draw, repay and reuse, paying interest only on usage. OD suits fluctuating needs; a personal loan suits a planned one-time expense.',
                'Who can get an overdraft?' => 'Salaried and self-employed applicants with a steady income can qualify. We match you to the right lender and limit based on your profile.',
                'Is LoanPt free?' => 'Yes, our service is free to you. Any lender fees are shown transparently.',
            ),
        ),
    );
    return array_merge($base, loanpt_city_defs());
}

/** Personal-loan city landing pages across NCR — unique content per city (SEO). */
function loanpt_city_defs() {
    $bullets = array('Loan up to ₹50 Lakh+', 'Tenure up to 84 months', 'Minimal documents', 'Quick disbursal', 'Fixed EMI', 'No collateral needed');
    $cities = array(
        'noida'         => array('Noida', 'Looking for a personal loan in Noida? Whether you work in the Sector 62 or Sector 125 corporate hubs or live anywhere across the city, LoanPt compares personal loan offers from leading banks and NBFCs and matches you to the lowest rate your profile qualifies for. We handle the paperwork end to end — and it is completely free for you.'),
        'delhi'         => array('Delhi', 'Need a personal loan in Delhi? From salaried professionals around Connaught Place and Nehru Place to residents across South, West and East Delhi, LoanPt compares offers from every major bank and NBFC, finds you the best rate for your profile, and manages the whole process — at zero cost to you.'),
        'gurugram'      => array('Gurugram', 'Searching for a personal loan in Gurugram (Gurgaon)? For professionals across Cyber City, Udyog Vihar and the wider corporate belt, LoanPt compares personal loan offers from top banks and NBFCs, matches you to the lowest rate you qualify for, and handles the documentation — free of charge.'),
        'ghaziabad'     => array('Ghaziabad', 'Looking for a personal loan in Ghaziabad? LoanPt helps salaried and self-employed applicants across Indirapuram, Vaishali, Raj Nagar and the wider city compare offers from leading banks and NBFCs, secure a competitive rate, and get funds with minimal paperwork — at no cost to you.'),
        'faridabad'     => array('Faridabad', 'For a personal loan in Faridabad, LoanPt compares offers from all the major banks and NBFCs so you do not have to. Whether you are in NIT, Sector 15 or along the industrial belt, we match you to the lowest rate your profile qualifies for and manage the process end to end — completely free.'),
        'greater-noida' => array('Greater Noida', 'Need a personal loan in Greater Noida? From professionals in the Knowledge Park institutional belt to residents across the city sectors, LoanPt compares personal loan offers from leading banks and NBFCs, finds you a competitive rate, and handles the paperwork — at zero cost to you.'),
    );
    $out = array();
    foreach ($cities as $cslug => $c) {
        $name = $c[0];
        $out['personal-loan-' . $cslug] = array(
            'title'   => 'Personal Loan in ' . $name . ' — Compare & Apply at the Lowest Rate',
            'h1'      => 'Personal Loan in <em>' . $name . '</em> — Compare Offers from Every Bank',
            'meta'    => 'Compare personal loan offers in ' . $name . ' from HDFC, Kotak, ICICI, Axis, Bajaj & more. Check eligibility free, get the lowest rate with minimal paperwork. Apply with LoanPt — zero cost.',
            'product' => 'Personal Loan',
            'intro'   => $c[1],
            'bullets' => $bullets,
            'compare' => true,
            'faq'     => array(
                'Can I get a personal loan in ' . $name . '?' => 'Yes — we work with banks and NBFCs that lend across ' . $name . ' and the wider NCR. Share your details and our team finds your best option, free.',
                'Who is eligible for a personal loan?' => 'Typically salaried or self-employed applicants with a steady income and a reasonable credit score. We check your profile against multiple banks and tell you the best fit.',
                'What documents do I need?' => 'Usually ID & address proof, PAN, and recent salary slips or bank statements. We guide you through the exact list for the bank you qualify for.',
                'What interest rate will I get?' => 'It depends on the bank, your income and credit profile, so the lender decides it. We pull competitive partner-bank offers and never promise a fixed rate upfront.',
            ),
        );
    }
    return $out;
}

/** Informational pages (Services, About, Contact) — clean content that overrides any broken legacy content. */
function loanpt_info_data() {
    return array(
        'services' => array(
            'h1'    => 'Our Services',
            'title' => 'Our Loan Services — Personal Loan, Overdraft & Balance Transfer',
            'meta'  => 'LoanPt helps you compare and get personal loans, overdraft and balance transfer from leading banks & NBFCs at the best rates — free and fully managed.',
            'intro' => 'We help salaried and self-employed professionals access the right credit at the best available rate — fully managed, at zero cost to you. Here is what we arrange:',
        ),
        'about' => array(
            'h1'    => 'About LoanPt',
            'title' => 'About LoanPt — Credit in Pocket, Loan Facilitation Made Simple',
            'meta'  => 'LoanPt is a loan facilitation service helping salaried professionals compare and get personal loans, overdraft and balance transfer at the best rates — at zero cost.',
            'intro' => 'LoanPt is a loan facilitation service on a simple mission: making credit simple and accessible. We help salaried and self-employed professionals compare and get personal loans, overdraft and balance transfer from leading banks and NBFCs at the best available rate — with minimal paperwork and full guidance, at zero cost to them.',
        ),
        'contact' => array(
            'h1'    => 'Contact LoanPt',
            'title' => 'Contact LoanPt — Talk to Our Loan Team',
            'meta'  => 'Contact LoanPt for personal loans, overdraft and balance transfer. Call, WhatsApp or email us — our team responds fast. Free, fully managed loan assistance.',
            'intro' => 'Have a question or want to apply? Reach us whatever way is easiest — our team responds fast and guides you end to end.',
        ),
    );
}

/** Auto-create the landing pages (idempotent, version-guarded). */
add_action('init', function () {
    if (get_option('loanpt_pages_ver') === LOANPT_PAGES_VER) return;
    foreach (loanpt_landing_data() as $slug => $d) {
        $existing = get_page_by_path($slug);
        if (!$existing) {
            wp_insert_post(array(
                'post_title'   => $d['product'],
                'post_name'    => $slug,
                'post_status'  => 'publish',
                'post_type'    => 'page',
                'post_content' => 'LoanPt ' . $d['product'] . ' landing page.',
                'page_template'=> 'tpl-landing.php',
                'meta_input'   => array('_wp_page_template' => 'tpl-landing.php'),
            ));
        } else {
            update_post_meta($existing->ID, '_wp_page_template', 'tpl-landing.php');
        }
    }
    // Info pages (Services/About/Contact) — point existing pages at the info template
    // so their clean content shows instead of any broken legacy content.
    foreach (loanpt_info_data() as $slug => $d) {
        $existing = get_page_by_path($slug);
        if ($existing) {
            update_post_meta($existing->ID, '_wp_page_template', 'tpl-page-info.php');
        } else {
            wp_insert_post(array(
                'post_title'   => $d['h1'],
                'post_name'    => $slug,
                'post_status'  => 'publish',
                'post_type'    => 'page',
                'post_content' => 'LoanPt ' . $d['h1'] . '.',
                'page_template' => 'tpl-page-info.php',
                'meta_input'   => array('_wp_page_template' => 'tpl-page-info.php'),
            ));
        }
    }
    update_option('loanpt_pages_ver', LOANPT_PAGES_VER);
}, 20);

/** Per-page SEO: meta description + FAQ structured data. */
add_action('wp_head', function () {
    if (!is_page()) return;
    $slug = get_post_field('post_name', get_queried_object_id());
    $landing = loanpt_landing_data();
    $info = loanpt_info_data();
    if (isset($landing[$slug])) {
        $d = $landing[$slug];
        echo '<meta name="description" content="' . esc_attr($d['meta']) . '">' . "\n";
        $items = array();
        foreach ($d['faq'] as $q => $a) {
            $items[] = array('@type' => 'Question', 'name' => $q, 'acceptedAnswer' => array('@type' => 'Answer', 'text' => $a));
        }
        echo '<script type="application/ld+json">' . wp_json_encode(array('@context' => 'https://schema.org', '@type' => 'FAQPage', 'mainEntity' => $items)) . '</script>' . "\n";
    } elseif (isset($info[$slug])) {
        echo '<meta name="description" content="' . esc_attr($info[$slug]['meta']) . '">' . "\n";
    }
}, 6);

/** Unique, keyword-rich <title> for each landing page (SEO). */
add_filter('document_title_parts', function ($parts) {
    if (!is_page()) return $parts;
    $slug = get_post_field('post_name', get_queried_object_id());
    $all = array_merge(loanpt_landing_data(), loanpt_info_data());
    if (isset($all[$slug])) {
        $parts['title'] = $all[$slug]['title'];
        unset($parts['tagline']);
    }
    return $parts;
});
