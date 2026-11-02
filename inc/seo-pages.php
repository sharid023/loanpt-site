<?php
if (!defined('ABSPATH')) exit;

/**
 * SEO landing pages (the content machine). Each product gets its own URL,
 * content, FAQ schema and lead form — all deployed via theme/OTA. The pages are
 * auto-created as real WordPress Pages (good permalinks, sitemap, no 404) that
 * use the "LoanPt Landing" template. Bump LOANPT_PAGES_VER to re-seed.
 */

define('LOANPT_PAGES_VER', '4');

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
        'instant-loan' => array(
            'h1'    => 'Instant Loan',
            'title' => 'Instant Personal Loan — Quick Approval & Fast Disbursal',
            'meta'  => 'Need funds fast? Apply for an instant personal loan with LoanPt — quick eligibility check, minimal paperwork and fast disbursal from leading banks & NBFCs. Free.',
            'intro' => 'Need money quickly? We help you access an instant personal loan from banks and NBFCs with the fastest digital journeys — a quick eligibility check, minimal documents and fast disbursal. Share your details and our team gets you moving right away.',
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

/* ---------- Blog + Eligibility Quiz + Customer Login ---------- */
define('LOANPT_BLOG_VER', '2');

/** SEO meta for the blog listing + eligibility-quiz + customer-login pages, keyed by slug. */
function loanpt_tool_pages() {
    return array(
        'blog' => array(
            'h1'    => 'LoanPt Blog',
            'title' => 'LoanPt Blog — Personal Loan, CIBIL Score & EMI Guides',
            'meta'  => 'Simple, honest guides on personal loans, credit score, EMIs, balance transfer and getting the lowest rate — written for borrowers by the LoanPt team.',
            'tpl'   => 'tpl-blog.php',
        ),
        'loan-eligibility' => array(
            'h1'    => 'Check Your Loan Eligibility',
            'title' => 'Check Your Loan Eligibility — Free 60-Second Calculator',
            'meta'  => 'Check how much personal loan you may be eligible for in 60 seconds — free, no documents and no impact on your credit score. Instant estimate from LoanPt.',
            'tpl'   => 'tpl-quiz.php',
        ),
        'customer' => array(
            'h1'      => 'Customer Login',
            'title'   => 'Customer Login — Track Your Loan Application | LoanPt',
            'meta'    => 'Log in to your LoanPt account to track your loan application status, approvals and disbursal. Secure Google sign-in.',
            'tpl'     => 'tpl-account.php',
            'noindex' => true,
        ),
    );
}

/** Starter SEO blog posts (created once). Internal links feed the landing pages. */
function loanpt_starter_posts() {
    return array(
        'how-to-improve-cibil-score' => array(
            'title'   => 'How to Improve Your CIBIL Score: 7 Proven Steps',
            'excerpt' => 'Your CIBIL score decides whether you get a loan — and at what rate. Here are seven practical, proven ways to raise it, and how long each takes.',
            'content' =>
                '<p>Your CIBIL score (300–900) is the first thing a lender checks. A higher score means easier approvals and a lower interest rate — on a big loan, even a 1% lower rate can save you tens of thousands of rupees. The good news: your score is in your hands, and most people can improve it in a few months.</p>'
                . '<h2>What counts as a good CIBIL score?</h2>'
                . '<p>Generally, <strong>750 and above</strong> is considered good and gets you the best offers. Between 650 and 750 you can still get a loan, but often at a higher rate. Below 650, approvals get harder — but it is fixable.</p>'
                . '<h2>7 proven ways to improve your score</h2>'
                . '<ol>'
                . '<li><strong>Always pay EMIs and card bills on time.</strong> Payment history is the single biggest factor. Set auto-pay so you never miss a date.</li>'
                . '<li><strong>Keep credit-card usage under 30%.</strong> If your limit is ₹1,00,000, try to stay under ₹30,000 outstanding. High usage drags your score down.</li>'
                . '<li><strong>Do not close your oldest credit card.</strong> A longer credit history helps. Keep old accounts active with a small recurring spend.</li>'
                . '<li><strong>Avoid too many loan or card applications at once.</strong> Each application triggers a "hard enquiry" that dips your score. Apply only when you need to.</li>'
                . '<li><strong>Keep a healthy mix.</strong> A blend of secured (home/auto) and unsecured (personal loan/card) credit, handled well, reads positively.</li>'
                . '<li><strong>Check your report for errors.</strong> A wrongly reported default or a loan that is not yours can hurt you. Dispute mistakes with the bureau to get them removed.</li>'
                . '<li><strong>Clear old dues and settlements.</strong> A "settled" status is a red flag — wherever possible, pay the full amount to get a "closed" status instead.</li>'
                . '</ol>'
                . '<h2>How long does it take?</h2>'
                . '<p>There is no overnight fix. With disciplined repayment and low utilisation, most people see a meaningful improvement in <strong>4 to 6 months</strong>. Keep it up and it keeps climbing.</p>'
                . '<p>Already have a decent score? <a href="/loan-eligibility/">Check your loan eligibility free</a> in 60 seconds, or <a href="/personal-loan/">compare personal loan offers</a> from every major bank with LoanPt.</p>',
        ),
        'documents-required-for-personal-loan' => array(
            'title'   => 'Documents Required for a Personal Loan in India (2026 Checklist)',
            'excerpt' => 'A clear, up-to-date checklist of the documents banks ask for when you apply for a personal loan — for both salaried and self-employed applicants.',
            'content' =>
                '<p>One of the most common reasons a personal loan gets delayed is missing or mismatched paperwork. Keep these ready before you apply and your approval moves much faster. Most banks now accept clear digital copies (PDF or photo).</p>'
                . '<h2>For salaried applicants</h2>'
                . '<ul>'
                . '<li><strong>Identity proof:</strong> PAN card (mandatory), plus Aadhaar / passport / voter ID / driving licence.</li>'
                . '<li><strong>Address proof:</strong> Aadhaar, passport, utility bill or rent agreement.</li>'
                . '<li><strong>Income proof:</strong> last 3 months\' salary slips.</li>'
                . '<li><strong>Bank statement:</strong> last 3–6 months of your salary account.</li>'
                . '<li><strong>Employment proof:</strong> offer letter or employee ID, if asked.</li>'
                . '<li><strong>Photograph:</strong> a recent passport-size photo.</li>'
                . '</ul>'
                . '<h2>For self-employed applicants</h2>'
                . '<ul>'
                . '<li><strong>Identity &amp; address proof:</strong> PAN plus Aadhaar / passport.</li>'
                . '<li><strong>Income proof:</strong> last 2 years\' ITR with computation of income.</li>'
                . '<li><strong>Bank statement:</strong> last 6–12 months of your current account.</li>'
                . '<li><strong>Business proof:</strong> GST registration, shop licence or business registration.</li>'
                . '</ul>'
                . '<h2>Tips to avoid rejection</h2>'
                . '<p>Make sure the name and date of birth match exactly across your PAN, Aadhaar and bank records. Keep file sizes small and images sharp. And apply where you actually qualify — a rejected application leaves a mark on your credit report.</p>'
                . '<p>Not sure which bank fits your profile? <a href="/loan-eligibility/">Check your eligibility free</a> or let LoanPt <a href="/personal-loan/">compare offers for you</a> — we tell you the exact list for the bank you qualify for.</p>',
        ),
        'personal-loan-vs-overdraft-vs-balance-transfer' => array(
            'title'   => 'Personal Loan vs Overdraft vs Balance Transfer: Which Is Right for You?',
            'excerpt' => 'Three ways to borrow, three very different cost structures. A plain-English guide to choosing between a personal loan, an overdraft and a balance transfer.',
            'content' =>
                '<p>"I need funds" can be solved three very different ways — and picking the right one saves you real money. Here is how a personal loan, an overdraft and a balance transfer actually differ.</p>'
                . '<h2>Personal loan — a fixed amount, a fixed EMI</h2>'
                . '<p>You get a lump sum and repay it in equal monthly instalments over a fixed tenure. Best for a <strong>planned, one-time expense</strong> — a wedding, medical bill, travel or home renovation — where you know exactly how much you need. <a href="/personal-loan/">Compare personal loan offers →</a></p>'
                . '<h2>Overdraft (OD) — a limit you dip into</h2>'
                . '<p>You get a credit limit and draw from it only when you need to, paying interest <strong>only on the amount and days you actually use</strong>. Repay and reuse freely, with no fixed EMI. Best for <strong>irregular or cash-flow needs</strong> where the amount keeps changing. <a href="/overdraft/">See how overdraft works →</a></p>'
                . '<h2>Balance transfer — move to a lower rate</h2>'
                . '<p>Already paying a high rate on an existing loan? A balance transfer moves the outstanding amount to a new lender at a <strong>lower interest rate</strong>, cutting your EMI and total interest — often with a top-up option for extra funds. Best when you still have a good chunk of tenure left. <a href="/balance-transfer/">Check balance-transfer savings →</a></p>'
                . '<h2>Quick comparison</h2>'
                . '<ul>'
                . '<li><strong>Need a fixed sum now?</strong> Personal loan.</li>'
                . '<li><strong>Need flexible, on-and-off access?</strong> Overdraft.</li>'
                . '<li><strong>Already have a costly loan?</strong> Balance transfer.</li>'
                . '</ul>'
                . '<p>Still unsure? <a href="/loan-eligibility/">Check your eligibility free</a> and our team will recommend the option that costs you the least.</p>',
        ),
    );
}

/** Auto-create blog + quiz pages and starter posts (idempotent, version-guarded). */
add_action('init', function () {
    if (get_option('loanpt_blog_ver') === LOANPT_BLOG_VER) return;
    foreach (loanpt_tool_pages() as $slug => $d) {
        $existing = get_page_by_path($slug);
        if ($existing) {
            update_post_meta($existing->ID, '_wp_page_template', $d['tpl']);
        } else {
            wp_insert_post(array(
                'post_title'    => $d['h1'],
                'post_name'     => $slug,
                'post_status'   => 'publish',
                'post_type'     => 'page',
                'post_content'  => 'LoanPt ' . $d['h1'] . '.',
                'page_template' => $d['tpl'],
                'meta_input'    => array('_wp_page_template' => $d['tpl']),
            ));
        }
    }
    foreach (loanpt_starter_posts() as $slug => $p) {
        if (get_page_by_path($slug, OBJECT, 'post')) continue;
        wp_insert_post(array(
            'post_title'   => $p['title'],
            'post_name'    => $slug,
            'post_status'  => 'publish',
            'post_type'    => 'post',
            'post_content' => $p['content'],
            'post_excerpt' => $p['excerpt'],
        ));
    }
    update_option('loanpt_blog_ver', LOANPT_BLOG_VER);
}, 21);

/** Per-page SEO: meta description + FAQ structured data. */
add_action('wp_head', function () {
    if (!is_page()) return;
    $slug = get_post_field('post_name', get_queried_object_id());
    $landing = loanpt_landing_data();
    $info = loanpt_info_data();
    $tools = loanpt_tool_pages();
    if (isset($tools[$slug])) {
        if (!empty($tools[$slug]['noindex'])) {
            echo '<meta name="robots" content="noindex,nofollow">' . "\n";
        }
        echo '<meta name="description" content="' . esc_attr($tools[$slug]['meta']) . '">' . "\n";
        return;
    }
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
    $all = array_merge(loanpt_landing_data(), loanpt_info_data(), loanpt_tool_pages());
    if (isset($all[$slug])) {
        $parts['title'] = $all[$slug]['title'];
        unset($parts['tagline']);
    }
    return $parts;
});
