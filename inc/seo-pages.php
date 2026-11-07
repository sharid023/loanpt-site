<?php
if (!defined('ABSPATH')) exit;

/**
 * SEO landing pages (the content machine). Each product gets its own URL,
 * content, FAQ schema and lead form — all deployed via theme/OTA. The pages are
 * auto-created as real WordPress Pages (good permalinks, sitemap, no 404) that
 * use the "LoanPt Landing" template. Bump LOANPT_PAGES_VER to re-seed.
 */

define('LOANPT_PAGES_VER', '13');

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
        'business-loan' => array(
            'title' => 'Business Loan — Unsecured Funds to Grow Your Business',
            'h1'    => 'Business Loan — Fund Your Growth with the <em>Right Lender</em>',
            'meta'  => 'Compare business loan & working-capital offers from leading banks & NBFCs. Collateral-free options, flexible tenure, quick disbursal. Apply with LoanPt — free.',
            'product' => 'Business Loan',
            'intro' => 'A business loan gives you the working capital or growth funds your business needs — to buy stock, expand, manage cash-flow or invest in equipment. LoanPt compares unsecured business-loan and working-capital offers across leading banks and NBFCs, matches you to a lender comfortable with your profile, and handles the paperwork end to end. It is completely free for you.',
            'bullets' => array('Collateral-free options', 'Working capital & term loans', 'Flexible tenure', 'Quick disbursal', 'Minimal paperwork', 'For self-employed & businesses'),
            'compare' => false,
            'faq' => array(
                'Who can get a business loan?' => 'Self-employed professionals, proprietors, partnerships and companies with a running business and reasonable financials. We match you to lenders comfortable with your profile.',
                'What documents are needed?' => 'Usually KYC, business proof (GST / registration), bank statements and ITR. We tell you the exact list for the lender you qualify for.',
                'Is collateral required?' => 'Many business loans are unsecured (no collateral) up to a limit based on your profile; larger amounts may need security. We find the best fit for you.',
                'Does LoanPt charge a fee?' => 'No — our service is free to you. The lender may charge its own processing fee, shown upfront.',
            ),
        ),
        'home-loan' => array(
            'title' => 'Home Loan — Compare & Apply at the Lowest Rate',
            'h1'    => 'Home Loan — Buy Your Home at the <em>Lowest Rate</em>',
            'meta'  => 'Compare home loan offers from leading banks & NBFCs — low rates, long tenure, balance transfer & top-up. Check eligibility free and apply with LoanPt.',
            'product' => 'Home Loan',
            'intro' => 'A home loan helps you buy, build or renovate your home with a long tenure and a comfortable EMI. LoanPt compares home-loan offers across leading banks and NBFCs, matches you to the lowest rate your profile qualifies for, and handles the paperwork — including balance transfer and top-up on an existing home loan. It is completely free for you.',
            'bullets' => array('Low interest rates', 'Tenure up to 30 years', 'High loan amount', 'Balance transfer & top-up', 'Minimal paperwork', 'Fully managed process'),
            'compare' => false,
            'faq' => array(
                'Who is eligible for a home loan?' => 'Salaried or self-employed applicants with a steady income, within the lender\'s age and property criteria. We check your profile across banks and find your best fit.',
                'How much home loan can I get?' => 'It depends on your income, existing obligations and the property value (lenders typically fund up to 75–90% of the value). Share your details for an indicative amount — free.',
                'What documents are needed?' => 'Usually KYC, income proof (salary slips / ITR), bank statements and property documents. We guide you through the exact list.',
                'Can I transfer my existing home loan?' => 'Yes — a home-loan balance transfer can move your loan to a lower rate and cut your EMI, often with a top-up. We check if it saves you money.',
            ),
        ),
        'loan-against-property' => array(
            'title' => 'Loan Against Property (LAP) — Compare & Apply at the Lowest Rate',
            'h1'    => 'Loan Against Property — Big Funds at a <em>Lower Rate</em>',
            'meta'  => 'Compare loan against property (LAP) offers from leading banks & NBFCs — high loan amount, low interest and long tenure against your residential or commercial property. Apply with LoanPt — free.',
            'product' => 'Loan Against Property',
            'intro' => 'A loan against property (LAP) lets you unlock the value of a property you already own — residential, commercial or a plot — by mortgaging it to raise funds, while you continue to use the property. Because it is secured, a LAP usually comes at a lower interest rate and a longer tenure than an unsecured personal loan, and the amount can be large. The funds can be used for almost any purpose — business expansion, a wedding, education, a medical need or consolidating costly debt. LoanPt compares LAP offers across leading banks and NBFCs, matches you to the lowest rate your profile and property qualify for, and handles the paperwork end to end. It is completely free for you.',
            'bullets' => array('Loan up to ₹5 Crore+', 'Lower rate (secured)', 'Tenure up to 15–20 years', 'Residential, commercial or plot', 'Funds for any purpose', 'Balance transfer & top-up'),
            'compare' => false,
            'faq' => array(
                'What is a loan against property (LAP)?' => 'It is a secured loan where you mortgage a property you own — residential, commercial or industrial — and borrow against its value. You keep using the property, and because the loan is secured, the rate is usually lower than an unsecured loan.',
                'How much loan can I get against my property?' => 'Typically up to 60–70% of the property\'s market value, depending on the property type, your income and the lender. Share your details for an indicative amount — free.',
                'Is a loan against property cheaper than a personal loan?' => 'Usually yes. Because it is backed by your property, a LAP generally carries a lower interest rate and a longer tenure than an unsecured personal loan — though the final rate depends on the property and your profile.',
                'What documents are needed for a LAP?' => 'Usually KYC, income proof (salary slips or ITR), bank statements and the property documents. We guide you through the exact list for the lender you qualify for.',
            ),
        ),
        'credit-card' => array(
            'title' => 'Credit Cards — Compare & Apply for the Right Card',
            'h1'    => 'Credit Cards — Find the <em>Right Card</em> for You',
            'meta'  => 'Compare credit cards and get matched to the right one for your profile — rewards, cashback, travel, lifetime-free and EMI options. Apply with LoanPt, free.',
            'product' => 'Credit Card',
            'intro' => 'The right credit card rewards your everyday spending — cashback, reward points, travel benefits, lounge access or lifetime-free options. LoanPt helps you compare cards from leading banks and get matched to the one that fits your profile and spending, then guides you through a quick application. It is completely free for you.',
            'bullets' => array('Rewards & cashback cards', 'Travel & lounge benefits', 'Lifetime-free options', 'Low-interest & EMI cards', 'Matched to your profile', 'Quick, guided application'),
            'compare' => false,
            'faq' => array(
                'Which credit card is best for me?' => 'It depends on how you spend — cashback for daily use, travel cards for flyers, rewards for shopping. We match you to the right card for your profile.',
                'Who is eligible for a credit card?' => 'Salaried or self-employed applicants with a steady income and a reasonable credit score. We tell you the cards you are most likely to be approved for.',
                'What documents do I need?' => 'Usually ID & address proof, PAN, and income proof (salary slips or bank statement). We guide you through the exact list.',
                'Is LoanPt free?' => 'Yes — our service is free to you. The bank sets any card fees, shown transparently.',
            ),
        ),
        'cibil-score' => array(
            'title' => 'Check Your Credit Score (CIBIL) Free — Tips to Improve It',
            'h1'    => 'Check & Improve Your <em>Credit Score</em>',
            'meta'  => 'Understand your CIBIL / credit score, why it matters for loans, and how to improve it. LoanPt helps you check eligibility and get the best loan at the right rate — free.',
            'product' => 'Credit Score',
            'intro' => 'Your credit score (CIBIL, 300–900) is the first thing a lender checks — a higher score means easier approvals and a lower interest rate. LoanPt helps you understand where you stand, improve your score, and get matched to the lenders most likely to approve you. Share your details and our team guides you — completely free.',
            'bullets' => array('Know what affects your score', '7 proven ways to improve it', 'Match to lenders for your profile', 'A better score = a lower rate', 'Free, honest guidance', 'Checking your own score is safe'),
            'compare' => false,
            'faq' => array(
                'What is a good credit score?' => 'Generally 750 and above is considered good and gets the best loan offers. Between 650–750 you can still get a loan, often at a higher rate. Below 650 it is harder, but improvable.',
                'How can I improve my credit score?' => 'Pay EMIs and card bills on time, keep card usage under 30% of the limit, avoid too many loan applications at once, and fix any errors on your report. Most people see improvement in 4–6 months.',
                'Does checking my score lower it?' => 'No. Checking your own score is a soft enquiry and does not affect it. Only a lender\'s hard enquiry (when you apply) has a small, temporary effect.',
                'Can I get a loan with a low score?' => 'Sometimes — some lenders consider a fair score with strong income proof. We check multiple banks to find who may approve you.',
            ),
        ),
        'car-loan' => array(
            'title' => 'Car Loan — New Car Finance at the Lowest Rate',
            'h1'    => 'Car Loan — Drive Home Your <em>New Car</em>',
            'meta'  => 'Compare new car loan offers from leading banks & NBFCs — up to 100% on-road finance, low interest and quick approval. Check eligibility free and apply with LoanPt.',
            'product' => 'Car Loan',
            'intro' => 'A car loan helps you buy your new car now and pay for it over comfortable EMIs, with banks often financing up to 90–100% of the on-road price. LoanPt compares new car loan offers across leading banks and NBFCs, matches you to the lowest rate your profile qualifies for, and handles the paperwork so you drive home faster. It is completely free for you.',
            'bullets' => array('Up to 100% on-road finance', 'Low interest rates', 'Tenure up to 7 years', 'Quick approval & disbursal', 'Minimal paperwork', 'New & electric cars'),
            'compare' => false,
            'faq' => array(
                'How much car loan can I get?' => 'Many lenders finance up to 90–100% of the on-road price, depending on the car, your income and credit profile. Share your details for an indicative amount — free.',
                'What is the tenure for a car loan?' => 'Car loans typically run up to 7 years. A longer tenure lowers your EMI but increases total interest; we help you pick the right balance.',
                'What documents are needed for a car loan?' => 'Usually KYC, income proof (salary slips or ITR), bank statements and the car quotation. We guide you through the exact list for the lender you qualify for.',
                'Is LoanPt free?' => 'Yes — our service is free to you. Lenders may charge their own processing fee, shown transparently.',
            ),
        ),
        'used-car-loan' => array(
            'title' => 'Used Car Loan — Finance a Pre-Owned Car at a Low Rate',
            'h1'    => 'Used Car Loan — Finance Your <em>Pre-Owned Car</em>',
            'meta'  => 'Compare used car loan (pre-owned car finance) offers from leading banks & NBFCs — competitive rates, quick approval and minimal paperwork. Check eligibility free with LoanPt.',
            'product' => 'Used Car Loan',
            'intro' => 'Buying a pre-owned car? A used car loan finances your second-hand vehicle with an easy EMI, so you keep your savings intact. LoanPt compares used car loan offers across leading banks and NBFCs, matches you to a competitive rate based on the car and your profile, and handles the paperwork end to end. It is completely free for you.',
            'bullets' => array('Finance pre-owned cars', 'Competitive interest rates', 'Quick approval', 'Flexible tenure', 'Minimal paperwork', 'Dealer or private seller'),
            'compare' => false,
            'faq' => array(
                'Can I get a loan for a used car?' => 'Yes — many banks and NBFCs finance pre-owned cars, from a dealer or a private seller, based on the car\'s age, valuation and your profile. We find who offers you the best deal.',
                'How much of the used car price is financed?' => 'Typically a large share of the car\'s valuation, depending on its age and condition and your profile. Share details for an indicative amount — free.',
                'What interest rate will I get on a used car loan?' => 'It is usually a little higher than a new car loan because the vehicle is older, and depends on the lender and your profile. We pull competitive offers and never promise a fixed rate upfront.',
                'What documents are needed?' => 'Usually KYC, income proof, bank statements and the vehicle documents and valuation. We guide you through the exact list.',
            ),
        ),
        'two-wheeler-loan' => array(
            'title' => 'Two-Wheeler Loan — Bike & Scooter Finance, Low EMI',
            'h1'    => 'Two-Wheeler Loan — Ride Your <em>New Bike</em> Home',
            'meta'  => 'Compare two-wheeler loan offers for bikes & scooters from leading banks & NBFCs — up to 100% finance, low EMI and quick approval. Check eligibility free with LoanPt.',
            'product' => 'Two-Wheeler Loan',
            'intro' => 'A two-wheeler loan helps you buy your new bike or scooter now and pay in easy EMIs, often with up to 100% of the on-road price financed. LoanPt compares two-wheeler loan offers across leading banks and NBFCs, matches you to a competitive rate, and keeps the paperwork minimal so you ride home faster. It is completely free for you.',
            'bullets' => array('Up to 100% finance', 'Low, easy EMI', 'Quick approval', 'Minimal paperwork', 'Bikes, scooters & EVs', 'Flexible tenure'),
            'compare' => false,
            'faq' => array(
                'How much two-wheeler loan can I get?' => 'Many lenders finance up to 85–100% of the on-road price, depending on the vehicle and your profile. Share details for an indicative amount — free.',
                'Who is eligible for a two-wheeler loan?' => 'Salaried and self-employed applicants with a steady income can qualify, often with simple documentation. We match you to the right lender.',
                'What documents are needed?' => 'Usually KYC, income proof and the vehicle quotation. We guide you through the exact list for the lender you qualify for.',
                'Is LoanPt free?' => 'Yes — our service is free to you. Lenders may charge their own processing fee, shown transparently.',
            ),
        ),
        'gold-loan' => array(
            'title' => 'Gold Loan — Instant Funds Against Your Gold, Low Rate',
            'h1'    => 'Gold Loan — Instant Funds Against Your <em>Gold</em>',
            'meta'  => 'Compare gold loan offers from leading banks & NBFCs — high value per gram, low interest and same-day disbursal with minimal paperwork. Check with LoanPt — free.',
            'product' => 'Gold Loan',
            'intro' => 'A gold loan lets you borrow against your gold jewellery or coins and get funds quickly — often the same day — while your gold stays safely stored with the lender and comes back to you on repayment. Because it is secured, the rate is low and the paperwork minimal. LoanPt compares gold loan offers across leading banks and NBFCs so you get the most value per gram at a competitive rate. It is completely free for you.',
            'bullets' => array('Funds the same day', 'High value per gram', 'Low interest (secured)', 'Minimal paperwork', 'Flexible repayment', 'Gold stored safely'),
            'compare' => false,
            'faq' => array(
                'How much can I borrow against my gold?' => 'Lenders fund a large share of your gold\'s value (per RBI norms, usually up to 75% of the value), based on its purity and weight. Share details for an indicative amount — free.',
                'How fast is a gold loan disbursed?' => 'Gold loans are among the fastest — often disbursed the same day, with minimal paperwork, since the loan is secured by your gold.',
                'Is my gold safe?' => 'Yes — your gold is stored securely by the lender in a sealed, insured vault and returned to you once the loan is repaid.',
                'What documents are needed?' => 'Usually just KYC (ID and address proof). We guide you through the exact list for the lender you qualify for.',
            ),
        ),
        'education-loan' => array(
            'title' => 'Education Loan — Fund Studies in India & Abroad',
            'h1'    => 'Education Loan — Fund Your <em>Studies</em>, India or Abroad',
            'meta'  => 'Compare education loan offers for studies in India and abroad from leading banks & NBFCs — high amount, long tenure and repayment after your course. Check eligibility free with LoanPt.',
            'product' => 'Education Loan',
            'intro' => 'An education loan funds tuition and living costs for higher studies in India or abroad, with repayment that usually starts after your course (a moratorium period). LoanPt compares education loan offers across leading banks and NBFCs, matches you to a lender comfortable with your course and institute, and handles the paperwork end to end. It is completely free for you.',
            'bullets' => array('Studies in India & abroad', 'Covers tuition & living costs', 'Long repayment tenure', 'Repayment after course', 'Secured & unsecured options', 'Tax benefit (Sec 80E)'),
            'compare' => false,
            'faq' => array(
                'What does an education loan cover?' => 'Tuition fees plus related costs — exam and library fees, books, equipment, and often living expenses and travel for studies abroad. We help you find a lender that covers your needs.',
                'When do I start repaying an education loan?' => 'Most have a moratorium — you start full EMIs after your course ends (plus a short grace period), though simple interest may apply during study. We explain the exact terms.',
                'Do I need collateral for an education loan?' => 'Smaller loans are often unsecured; larger amounts (especially for studying abroad) may need collateral or a co-applicant. We find the best fit for your case.',
                'Is there a tax benefit on education loans?' => 'Yes — the interest paid is deductible under Section 80E of the Income Tax Act for up to 8 years. We can point you to the details.',
            ),
        ),
    );
    return array_merge($base, loanpt_city_defs(), loanpt_biz_city_defs(), loanpt_lap_city_defs(), loanpt_car_city_defs(), loanpt_gold_city_defs(), loanpt_keyword_defs(), loanpt_bank_defs());
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
        'mumbai'        => array('Mumbai', 'Looking for a personal loan in Mumbai? From professionals in BKC, Andheri and Lower Parel to residents across the suburbs and Navi Mumbai, LoanPt compares personal loan offers from every major bank and NBFC and matches you to the lowest rate your profile qualifies for — paperwork handled, at zero cost to you.'),
        'bangalore'     => array('Bengaluru', 'Need a personal loan in Bengaluru? Whether you work in the Whitefield, Electronic City or Outer Ring Road tech corridors or live anywhere across the city, LoanPt compares offers from leading banks and NBFCs, finds your best rate, and manages the process end to end — completely free.'),
        'hyderabad'     => array('Hyderabad', 'Searching for a personal loan in Hyderabad? For professionals across HITEC City, Gachibowli and the wider metro, LoanPt compares personal loan offers from top banks and NBFCs, matches you to a competitive rate, and handles the documentation — at no cost to you.'),
        'chennai'       => array('Chennai', 'Looking for a personal loan in Chennai? From the OMR IT corridor and Guindy to residents across the city, LoanPt compares offers from every major bank and NBFC, secures you the lowest rate you qualify for, and manages everything — free of charge.'),
        'pune'          => array('Pune', 'Need a personal loan in Pune? Whether you are in Hinjewadi, Kharadi or anywhere across the city and PCMC, LoanPt compares personal loan offers from leading banks and NBFCs, finds your best rate, and handles the paperwork — at zero cost to you.'),
        'kolkata'       => array('Kolkata', 'For a personal loan in Kolkata, LoanPt compares offers from all the major banks and NBFCs so you do not have to. From Salt Lake and New Town to residents across the city, we match you to the lowest rate your profile qualifies for and manage the process end to end — completely free.'),
        'ahmedabad'     => array('Ahmedabad', 'Looking for a personal loan in Ahmedabad? LoanPt helps salaried and self-employed applicants across SG Highway, Prahlad Nagar and the wider city compare offers from leading banks and NBFCs, secure a competitive rate, and get funds with minimal paperwork — at no cost to you.'),
        'jaipur'        => array('Jaipur', 'Need a personal loan in Jaipur? From professionals in Malviya Nagar and C-Scheme to residents across the Pink City, LoanPt compares personal loan offers from top banks and NBFCs, matches you to a competitive rate, and handles the documentation — free of charge.'),
        'lucknow'       => array('Lucknow', 'Searching for a personal loan in Lucknow? Whether you are in Gomti Nagar, Hazratganj or anywhere across the city, LoanPt compares offers from every major bank and NBFC, finds you the best rate for your profile, and manages the whole process — at zero cost to you.'),
        'chandigarh'    => array('Chandigarh', 'Looking for a personal loan in Chandigarh? For residents and professionals across the city and the wider Tricity (Mohali, Panchkula), LoanPt compares personal loan offers from leading banks and NBFCs, secures your best rate, and handles the paperwork — completely free.'),
        'indore'        => array('Indore', 'Need a personal loan in Indore? From the Vijay Nagar commercial belt to residents across the city, LoanPt compares offers from top banks and NBFCs, matches you to a competitive rate, and manages the process end to end — at no cost to you.'),
        'surat'         => array('Surat', 'Looking for a personal loan in Surat? Whether you are in the textile and diamond trade or salaried across the city, LoanPt compares personal loan offers from leading banks and NBFCs, finds your best rate, and handles everything — free of charge.'),
        'bhopal'        => array('Bhopal', 'Need a personal loan in Bhopal? From the MP Nagar hub to residents across the city, LoanPt compares offers from every major bank and NBFC, secures the lowest rate you qualify for, and manages the paperwork — at zero cost to you.'),
        'patna'         => array('Patna', 'Searching for a personal loan in Patna? LoanPt helps salaried and self-employed applicants across Boring Road, Kankarbagh and the wider city compare offers from leading banks and NBFCs, secure a competitive rate, and get funds fast — completely free.'),
        'nagpur'        => array('Nagpur', 'Looking for a personal loan in Nagpur? From professionals across the city commercial and residential areas, LoanPt compares personal loan offers from top banks and NBFCs, matches you to your best rate, and handles the documentation — at no cost to you.'),
    );
    $out = array();
    foreach ($cities as $cslug => $c) {
        $name = $c[0];
        $out['personal-loan-' . $cslug] = array(
            'title'   => 'Personal Loan in ' . $name . ' — Compare & Apply at the Lowest Rate',
            'h1'      => 'Personal Loan in <em>' . $name . '</em> — Compare Offers from Every Bank',
            'meta'    => 'Compare personal loan offers in ' . $name . ' from HDFC, Kotak, ICICI, Axis, Bajaj & more. Check eligibility free, get the lowest rate with minimal paperwork. Apply with LoanPt — zero cost.',
            'product' => 'Personal Loan',
            'city'    => $name,
            'intro'   => $c[1],
            'bullets' => $bullets,
            'compare' => true,
            'faq'     => array(
                'Can I get a personal loan in ' . $name . '?' => 'Yes — we work with banks and NBFCs that lend across ' . $name . ' and nearby areas. Share your details and our team finds your best option, free.',
                'Who is eligible for a personal loan?' => 'Typically salaried or self-employed applicants with a steady income and a reasonable credit score. We check your profile against multiple banks and tell you the best fit.',
                'What documents do I need?' => 'Usually ID & address proof, PAN, and recent salary slips or bank statements. We guide you through the exact list for the bank you qualify for.',
                'What interest rate will I get?' => 'It depends on the bank, your income and credit profile, so the lender decides it. We pull competitive partner-bank offers and never promise a fixed rate upfront.',
            ),
        );
    }
    return $out;
}

/** Business-loan city landing pages — unique content per city (SEO). */
function loanpt_biz_city_defs() {
    $bullets = array('Collateral-free options', 'Working capital & term loans', 'Flexible tenure', 'Quick disbursal', 'Minimal paperwork', 'For self-employed & businesses');
    $cities = array(
        'delhi'     => array('Delhi', 'Looking for a business loan in Delhi? From traders and MSMEs in the wholesale markets to growing companies across the city, LoanPt compares unsecured business-loan and working-capital offers from leading banks and NBFCs, matches you to the right lender, and handles the paperwork — free of charge.'),
        'mumbai'    => array('Mumbai', 'Need a business loan in Mumbai? For businesses across BKC, Andheri and the wider metro, LoanPt compares working-capital and term-loan offers from top banks and NBFCs, finds a lender comfortable with your profile, and manages the process end to end — at zero cost to you.'),
        'bangalore' => array('Bengaluru', 'Searching for a business loan in Bengaluru? Whether you run a startup, shop or growing firm, LoanPt compares unsecured business-loan offers from leading banks and NBFCs, matches you to the right lender, and handles the documentation — completely free.'),
        'hyderabad' => array('Hyderabad', 'Looking for a business loan in Hyderabad? From HITEC City firms to traders across the city, LoanPt compares working-capital and business-loan offers from top banks and NBFCs, finds your best fit, and manages the paperwork — at no cost to you.'),
        'pune'      => array('Pune', 'Need a business loan in Pune? For MSMEs and growing businesses across the city and PCMC, LoanPt compares unsecured business-loan offers from leading banks and NBFCs, matches you to the right lender, and handles everything — free of charge.'),
        'ahmedabad' => array('Ahmedabad', 'Looking for a business loan in Ahmedabad? For traders and manufacturers across the city commercial hubs, LoanPt compares working-capital and term-loan offers from top banks and NBFCs, finds a lender for your profile, and manages the process — at zero cost to you.'),
        'surat'     => array('Surat', 'Need a business loan in Surat? Whether you are in textiles, diamonds or trade, LoanPt compares unsecured business-loan and working-capital offers from leading banks and NBFCs, matches you to the right lender, and handles the paperwork — completely free.'),
        'jaipur'    => array('Jaipur', 'Searching for a business loan in Jaipur? For businesses and traders across the city, LoanPt compares business-loan offers from top banks and NBFCs, finds your best fit, and manages the documentation — at no cost to you.'),
    );
    $out = array();
    foreach ($cities as $cslug => $c) {
        $name = $c[0];
        $out['business-loan-' . $cslug] = array(
            'title'   => 'Business Loan in ' . $name . ' — Compare & Apply, Collateral-Free Options',
            'h1'      => 'Business Loan in <em>' . $name . '</em> — Fund Your Growth',
            'meta'    => 'Compare business loan & working-capital offers in ' . $name . ' from leading banks & NBFCs. Collateral-free options, quick disbursal. Apply with LoanPt — free.',
            'product' => 'Business Loan',
            'city'    => $name,
            'intro'   => $c[1],
            'bullets' => $bullets,
            'compare' => false,
            'faq'     => array(
                'Can I get a business loan in ' . $name . '?' => 'Yes — we work with banks and NBFCs that lend to businesses across ' . $name . ' and nearby areas. Share your details and our team finds your best option, free.',
                'Who can get a business loan?' => 'Self-employed professionals, proprietors, partnerships and companies with a running business and reasonable financials. We match you to lenders comfortable with your profile.',
                'What documents are needed?' => 'Usually KYC, business proof (GST / registration), bank statements and ITR. We tell you the exact list for the lender you qualify for.',
                'Is collateral required?' => 'Many business loans are unsecured up to a limit based on your profile; larger amounts may need security. We find the best fit for you.',
            ),
        );
    }
    return $out;
}

/** Loan-against-property city landing pages — unique content per city (SEO). */
function loanpt_lap_city_defs() {
    $bullets = array('Loan up to ₹5 Crore+', 'Lower rate (secured)', 'Tenure up to 15–20 years', 'Residential, commercial or plot', 'Funds for any purpose', 'Balance transfer & top-up');
    $cities = array(
        'delhi'      => array('Delhi', 'Need a loan against property in Delhi? Whether you own a home in South Delhi, a shop in a commercial hub or a plot on the outskirts, LoanPt compares LAP offers from leading banks and NBFCs, matches you to the lowest rate your property and profile qualify for, and handles the paperwork end to end — at zero cost to you.'),
        'mumbai'     => array('Mumbai', 'Looking for a loan against property in Mumbai? From flats across the suburbs to commercial space in BKC and Andheri, LoanPt helps you unlock your property\'s value — comparing LAP offers across top banks and NBFCs, securing a competitive rate and managing the process end to end, free of charge.'),
        'noida'      => array('Noida', 'Need a loan against property in Noida? Whether you own residential property in the city sectors or commercial space along the Expressway, LoanPt compares LAP offers from leading banks and NBFCs, finds you a competitive rate, and handles the documentation — at zero cost to you.'),
        'gurugram'   => array('Gurugram', 'Searching for a loan against property in Gurugram (Gurgaon)? From homes in the condominium belt to commercial units in Cyber City and Udyog Vihar, LoanPt compares LAP offers from top banks and NBFCs, matches you to the lowest rate you qualify for, and manages the paperwork — free of charge.'),
        'bangalore'  => array('Bengaluru', 'Need a loan against property in Bengaluru? Whether you own a home in Whitefield or Electronic City or commercial space along the Outer Ring Road, LoanPt compares LAP offers from leading banks and NBFCs, finds your best rate, and handles the process end to end — completely free.'),
        'hyderabad'  => array('Hyderabad', 'Looking for a loan against property in Hyderabad? From residential property across the metro to commercial space in HITEC City and Gachibowli, LoanPt compares LAP offers from top banks and NBFCs, secures you a competitive rate, and manages the documentation — at no cost to you.'),
        'chennai'    => array('Chennai', 'Need a loan against property in Chennai? Whether you own a home in the suburbs or commercial property along the OMR IT corridor, LoanPt compares LAP offers from leading banks and NBFCs, matches you to the lowest rate you qualify for, and handles everything — free of charge.'),
        'pune'       => array('Pune', 'Looking for a loan against property in Pune? From homes across the city and PCMC to commercial units in Hinjewadi and Kharadi, LoanPt compares LAP offers from leading banks and NBFCs, finds your best rate, and manages the paperwork — at zero cost to you.'),
        'kolkata'    => array('Kolkata', 'Need a loan against property in Kolkata? Whether you own residential property in Salt Lake and New Town or commercial space across the city, LoanPt compares LAP offers from top banks and NBFCs, secures a competitive rate, and handles the documentation — completely free.'),
        'ahmedabad'  => array('Ahmedabad', 'Searching for a loan against property in Ahmedabad? From homes along SG Highway to commercial units across the city, LoanPt compares LAP offers from leading banks and NBFCs, matches you to a competitive rate, and manages the process — at no cost to you.'),
        'jaipur'     => array('Jaipur', 'Need a loan against property in Jaipur? Whether you own a home in Malviya Nagar or commercial property across the Pink City, LoanPt compares LAP offers from top banks and NBFCs, finds your best rate, and handles the documentation — free of charge.'),
        'lucknow'    => array('Lucknow', 'Looking for a loan against property in Lucknow? From residential property in Gomti Nagar to shops and commercial space across the city, LoanPt compares LAP offers from leading banks and NBFCs, secures a competitive rate, and manages the paperwork — at zero cost to you.'),
        'indore'     => array('Indore', 'Need a loan against property in Indore? Whether you own a home or commercial property around the Vijay Nagar belt, LoanPt compares LAP offers from top banks and NBFCs, matches you to a competitive rate, and handles the process end to end — at no cost to you.'),
        'kanpur'     => array('Kanpur', 'Searching for a loan against property in Kanpur? From residential property across the city to commercial and industrial units, LoanPt compares LAP offers from leading banks and NBFCs, finds your best rate, and manages the documentation — completely free.'),
        'varanasi'   => array('Varanasi', 'Need a loan against property in Varanasi? Whether you own a home or a shop in the city, LoanPt compares LAP offers from banks and NBFCs that lend across Varanasi, secures you a competitive rate, and handles the paperwork — free of charge.'),
        'patna'      => array('Patna', 'Looking for a loan against property in Patna? From homes in Boring Road and Kankarbagh to commercial space across the city, LoanPt compares LAP offers from leading banks and NBFCs, matches you to a competitive rate, and manages the process — at zero cost to you.'),
        'nagpur'     => array('Nagpur', 'Need a loan against property in Nagpur? Whether you own residential or commercial property across the city, LoanPt compares LAP offers from top banks and NBFCs, finds your best rate, and handles the documentation — at no cost to you.'),
        'chandigarh' => array('Chandigarh', 'Searching for a loan against property in Chandigarh? For homeowners and businesses across the city and the wider Tricity (Mohali, Panchkula), LoanPt compares LAP offers from leading banks and NBFCs, secures your best rate, and manages the paperwork — completely free.'),
    );
    $out = array();
    foreach ($cities as $cslug => $c) {
        $name = $c[0];
        $out['loan-against-property-' . $cslug] = array(
            'title'   => 'Loan Against Property in ' . $name . ' (LAP) — Compare at the Lowest Rate',
            'h1'      => 'Loan Against Property in <em>' . $name . '</em> — Big Funds, Lower Rate',
            'meta'    => 'Compare loan against property (LAP) offers in ' . $name . ' from leading banks & NBFCs — high amount, low rate and long tenure against your residential or commercial property. Apply with LoanPt — free.',
            'product' => 'Loan Against Property',
            'city'    => $name,
            'intro'   => $c[1],
            'bullets' => $bullets,
            'compare' => false,
            'faq'     => array(
                'Can I get a loan against property in ' . $name . '?' => 'Yes — we work with banks and NBFCs that offer LAP across ' . $name . ' and nearby areas, for residential, commercial and industrial property. Share your details and our team finds your best option, free.',
                'How much loan can I get against my property?' => 'Typically up to 60–70% of the property\'s market value, depending on the property type, your income and the lender. Share your details for an indicative amount — free.',
                'Is a loan against property cheaper than a personal loan?' => 'Usually yes. Because it is backed by your property, a LAP generally carries a lower interest rate and a longer tenure than an unsecured personal loan — though the final rate depends on the property and your profile.',
                'What documents are needed for a LAP?' => 'Usually KYC, income proof (salary slips or ITR), bank statements and the property documents. We guide you through the exact list for the lender you qualify for.',
            ),
        );
    }
    return $out;
}

/** Car-loan city landing pages — unique content per city (SEO). */
function loanpt_car_city_defs() {
    $bullets = array('Up to 100% on-road finance', 'Low interest rates', 'Tenure up to 7 years', 'Quick approval & disbursal', 'Minimal paperwork', 'New & electric cars');
    $cities = array(
        'delhi'      => array('Delhi', 'Looking for a car loan in Delhi? Whether you are buying from a showroom in South Delhi or anywhere across the NCR, LoanPt compares new car loan offers from leading banks and NBFCs, finances up to 100% of the on-road price, and matches you to the lowest rate you qualify for — at zero cost to you.'),
        'mumbai'     => array('Mumbai', 'Need a car loan in Mumbai? From the suburbs to South Mumbai, LoanPt compares new car loan offers from top banks and NBFCs, finds you a competitive rate with up to 100% on-road finance, and handles the paperwork so you drive home faster — free of charge.'),
        'noida'      => array('Noida', 'Searching for a car loan in Noida? LoanPt compares new car loan offers from leading banks and NBFCs for buyers across the city and Greater Noida, finances up to 100% of the on-road price, and matches you to your best rate — at zero cost to you.'),
        'gurugram'   => array('Gurugram', 'Looking for a car loan in Gurugram (Gurgaon)? LoanPt compares new car loan offers from top banks and NBFCs for buyers across the city, secures up to 100% on-road finance at a competitive rate, and keeps the paperwork minimal — free of charge.'),
        'bangalore'  => array('Bengaluru', 'Need a car loan in Bengaluru? Whether you buy in Whitefield, Electronic City or anywhere across the city, LoanPt compares new car loan offers from leading banks and NBFCs, finds your best rate with up to 100% finance, and handles everything — completely free.'),
        'hyderabad'  => array('Hyderabad', 'Looking for a car loan in Hyderabad? LoanPt compares new car loan offers from top banks and NBFCs for buyers across HITEC City, Gachibowli and the wider metro, finances up to 100% of the on-road price, and matches you to a competitive rate — at no cost to you.'),
        'chennai'    => array('Chennai', 'Need a car loan in Chennai? From the OMR corridor to anywhere across the city, LoanPt compares new car loan offers from leading banks and NBFCs, finds your best rate with up to 100% finance, and manages the paperwork — free of charge.'),
        'pune'       => array('Pune', 'Searching for a car loan in Pune? LoanPt compares new car loan offers from top banks and NBFCs for buyers across the city and PCMC, secures up to 100% on-road finance at a competitive rate, and handles everything — at zero cost to you.'),
        'kolkata'    => array('Kolkata', 'Looking for a car loan in Kolkata? LoanPt compares new car loan offers from leading banks and NBFCs for buyers across the city, finances up to 100% of the on-road price, and matches you to your best rate — completely free.'),
        'ahmedabad'  => array('Ahmedabad', 'Need a car loan in Ahmedabad? LoanPt compares new car loan offers from top banks and NBFCs for buyers along SG Highway and across the city, finds a competitive rate with up to 100% finance, and manages the paperwork — at no cost to you.'),
        'jaipur'     => array('Jaipur', 'Looking for a car loan in Jaipur? LoanPt compares new car loan offers from leading banks and NBFCs for buyers across the Pink City, finances up to 100% of the on-road price, and matches you to your best rate — free of charge.'),
        'lucknow'    => array('Lucknow', 'Need a car loan in Lucknow? From Gomti Nagar to anywhere across the city, LoanPt compares new car loan offers from top banks and NBFCs, secures up to 100% on-road finance at a competitive rate, and handles the paperwork — at zero cost to you.'),
        'indore'     => array('Indore', 'Searching for a car loan in Indore? LoanPt compares new car loan offers from leading banks and NBFCs for buyers across the city, finances up to 100% of the on-road price, and matches you to your best rate — completely free.'),
        'chandigarh' => array('Chandigarh', 'Looking for a car loan in Chandigarh? For buyers across the city and the wider Tricity (Mohali, Panchkula), LoanPt compares new car loan offers from top banks and NBFCs, finds a competitive rate with up to 100% finance, and manages everything — free of charge.'),
        'nagpur'     => array('Nagpur', 'Need a car loan in Nagpur? LoanPt compares new car loan offers from leading banks and NBFCs for buyers across the city, finances up to 100% of the on-road price, and matches you to your best rate — at no cost to you.'),
        'ghaziabad'  => array('Ghaziabad', 'Looking for a car loan in Ghaziabad? LoanPt compares new car loan offers from top banks and NBFCs for buyers across Indirapuram, Vaishali and the wider city, secures up to 100% on-road finance at a competitive rate, and keeps the paperwork minimal — at zero cost to you.'),
    );
    $out = array();
    foreach ($cities as $cslug => $c) {
        $name = $c[0];
        $out['car-loan-' . $cslug] = array(
            'title'   => 'Car Loan in ' . $name . ' — New Car Finance at the Lowest Rate',
            'h1'      => 'Car Loan in <em>' . $name . '</em> — Drive Home Your New Car',
            'meta'    => 'Compare new car loan offers in ' . $name . ' from leading banks & NBFCs — up to 100% on-road finance, low interest and quick approval. Check eligibility free with LoanPt.',
            'product' => 'Car Loan',
            'city'    => $name,
            'intro'   => $c[1],
            'bullets' => $bullets,
            'compare' => false,
            'faq'     => array(
                'Can I get a car loan in ' . $name . '?' => 'Yes — we work with banks and NBFCs that finance new cars across ' . $name . ' and nearby areas. Share your details and our team finds your best option, free.',
                'How much car loan can I get?' => 'Many lenders finance up to 90–100% of the on-road price, depending on the car, your income and credit profile. Share your details for an indicative amount — free.',
                'What is the tenure for a car loan?' => 'Car loans typically run up to 7 years. A longer tenure lowers your EMI but increases total interest; we help you pick the right balance.',
                'What documents are needed for a car loan?' => 'Usually KYC, income proof (salary slips or ITR), bank statements and the car quotation. We guide you through the exact list for the lender you qualify for.',
            ),
        );
    }
    return $out;
}

/** Gold-loan city landing pages — unique content per city (SEO). */
function loanpt_gold_city_defs() {
    $bullets = array('Funds the same day', 'High value per gram', 'Low interest (secured)', 'Minimal paperwork', 'Flexible repayment', 'Gold stored safely');
    $cities = array(
        'delhi'         => array('Delhi', 'Need a gold loan in Delhi? LoanPt compares gold loan offers from leading banks and NBFCs across the city, so you get the most value per gram at a low rate with same-day disbursal — your gold stays safely stored and comes back on repayment. It is completely free for you.'),
        'mumbai'        => array('Mumbai', 'Looking for a gold loan in Mumbai? From the suburbs to South Mumbai, LoanPt compares gold loan offers from top banks and NBFCs, gets you a high value per gram at a competitive rate with same-day funds, and keeps your gold stored securely — free of charge.'),
        'bangalore'     => array('Bengaluru', 'Need a gold loan in Bengaluru? LoanPt compares gold loan offers from leading banks and NBFCs across the city, so you get quick, same-day funds against your gold at a low rate — safely stored and returned on repayment, at zero cost to you.'),
        'hyderabad'     => array('Hyderabad', 'Looking for a gold loan in Hyderabad? LoanPt compares gold loan offers from top banks and NBFCs across the metro, getting you a high value per gram at a competitive rate with same-day disbursal — your gold stored securely, free of charge.'),
        'chennai'       => array('Chennai', 'Need a gold loan in Chennai? LoanPt compares gold loan offers from leading banks and NBFCs across the city, so you get the most per gram at a low rate with same-day funds — gold stored safely and returned on repayment, at no cost to you.'),
        'pune'          => array('Pune', 'Looking for a gold loan in Pune? LoanPt compares gold loan offers from top banks and NBFCs across the city and PCMC, getting you quick same-day funds against your gold at a competitive rate — safely stored, free of charge.'),
        'kolkata'       => array('Kolkata', 'Need a gold loan in Kolkata? LoanPt compares gold loan offers from leading banks and NBFCs across the city, so you get a high value per gram at a low rate with same-day disbursal — your gold stored securely, completely free.'),
        'ahmedabad'     => array('Ahmedabad', 'Looking for a gold loan in Ahmedabad? LoanPt compares gold loan offers from top banks and NBFCs across the city, getting you the most per gram at a competitive rate with same-day funds — gold stored safely, at no cost to you.'),
        'jaipur'        => array('Jaipur', 'Need a gold loan in Jaipur? LoanPt compares gold loan offers from leading banks and NBFCs across the Pink City, so you get quick same-day funds against your gold at a low rate — safely stored and returned on repayment, free of charge.'),
        'lucknow'       => array('Lucknow', 'Looking for a gold loan in Lucknow? LoanPt compares gold loan offers from top banks and NBFCs across the city, getting you a high value per gram at a competitive rate with same-day disbursal — your gold stored securely, at zero cost to you.'),
        'coimbatore'    => array('Coimbatore', 'Need a gold loan in Coimbatore? LoanPt compares gold loan offers from leading banks and NBFCs across the city, so you get the most value per gram at a low rate with same-day funds — gold stored safely and returned on repayment, completely free.'),
        'kochi'         => array('Kochi', 'Looking for a gold loan in Kochi? LoanPt compares gold loan offers from top banks and NBFCs across the city, getting you quick same-day funds against your gold at a competitive rate — safely stored, free of charge.'),
        'madurai'       => array('Madurai', 'Need a gold loan in Madurai? LoanPt compares gold loan offers from leading banks and NBFCs across the city, so you get a high value per gram at a low rate with same-day disbursal — your gold stored securely, at no cost to you.'),
        'vijayawada'    => array('Vijayawada', 'Looking for a gold loan in Vijayawada? LoanPt compares gold loan offers from top banks and NBFCs across the city, getting you the most per gram at a competitive rate with same-day funds — gold stored safely, free of charge.'),
        'visakhapatnam' => array('Visakhapatnam', 'Need a gold loan in Visakhapatnam? LoanPt compares gold loan offers from leading banks and NBFCs across the city, so you get quick same-day funds against your gold at a low rate — safely stored and returned on repayment, at zero cost to you.'),
        'nagpur'        => array('Nagpur', 'Looking for a gold loan in Nagpur? LoanPt compares gold loan offers from top banks and NBFCs across the city, getting you a high value per gram at a competitive rate with same-day disbursal — your gold stored securely, completely free.'),
    );
    $out = array();
    foreach ($cities as $cslug => $c) {
        $name = $c[0];
        $out['gold-loan-' . $cslug] = array(
            'title'   => 'Gold Loan in ' . $name . ' — Instant Funds Against Your Gold',
            'h1'      => 'Gold Loan in <em>' . $name . '</em> — Instant Funds Against Gold',
            'meta'    => 'Compare gold loan offers in ' . $name . ' from leading banks & NBFCs — high value per gram, low interest and same-day disbursal with minimal paperwork. Check with LoanPt — free.',
            'product' => 'Gold Loan',
            'city'    => $name,
            'intro'   => $c[1],
            'bullets' => $bullets,
            'compare' => false,
            'faq'     => array(
                'Can I get a gold loan in ' . $name . '?' => 'Yes — we work with banks and NBFCs that offer gold loans across ' . $name . ' and nearby areas, with quick same-day disbursal. Share your details and our team finds your best option, free.',
                'How much can I borrow against my gold?' => 'Lenders fund a large share of your gold\'s value (per RBI norms, usually up to 75% of the value), based on its purity and weight. Share details for an indicative amount — free.',
                'How fast is a gold loan disbursed?' => 'Gold loans are among the fastest — often disbursed the same day, with minimal paperwork, since the loan is secured by your gold.',
                'Is my gold safe?' => 'Yes — your gold is stored securely by the lender in a sealed, insured vault and returned to you once the loan is repaid.',
            ),
        );
    }
    return $out;
}

/** High-intent keyword landing pages (search-intent modifiers) — unique content per page (SEO). */
function loanpt_keyword_defs() {
    return array(
        'urgent-personal-loan' => array(
            'title' => 'Urgent Personal Loan — Get Funds Fast, Same-Day Options',
            'h1'    => 'Urgent Personal Loan — Funds When You <em>Need Them Fast</em>',
            'meta'  => 'Need an urgent personal loan? Compare quick, same-day personal loan offers from leading banks & NBFCs with fast approval and minimal documents. Check eligibility free — LoanPt.',
            'product' => 'Personal Loan',
            'intro' => 'When an emergency hits — a hospital bill, an urgent repair or a sudden expense — you need funds fast, not a long wait. LoanPt connects you with the banks and NBFCs that offer the quickest personal loan journeys, with an instant eligibility check, minimal documents, and same-day to 24–48 hour disbursal for eligible applicants. Share your details and our team moves on it right away. It is completely free for you.',
            'bullets' => array('Quick eligibility check', 'Same-day / 24–48 hr disbursal*', 'Minimal documents', 'Collateral-free', 'Apply online', 'Fixed EMI'),
            'compare' => true,
            'faq' => array(
                'How fast can I get an urgent personal loan?' => 'For eligible applicants with clean documents, some lenders disburse the same day or within 24–48 hours. We match you to the fastest option for your profile.',
                'What helps me get a quick approval?' => 'Keep your PAN, address proof, latest salary slips and bank statement ready, and make sure your name and details match across them. Clean, matching paperwork speeds things up the most.',
                'Can I get an urgent loan with an average credit score?' => 'Sometimes — a few lenders consider a fair score with strong income proof, though it may take a little longer. We check several banks to find who can approve you quickly.',
                'Is LoanPt free?' => 'Yes — our service is free to you. Lenders may charge their own processing fee, shown transparently.',
            ),
        ),
        'instant-personal-loan' => array(
            'title' => 'Instant Personal Loan — Quick Online Approval & Disbursal',
            'h1'    => 'Instant Personal Loan — <em>Quick Approval</em>, Fast Disbursal',
            'meta'  => 'Apply for an instant personal loan online — quick digital approval, minimal paperwork and fast disbursal from leading banks & NBFCs. Check eligibility free with LoanPt.',
            'product' => 'Personal Loan',
            'intro' => 'An instant personal loan uses a bank\'s digital journey to approve and disburse funds fast — often with just a few documents and a fully online application. LoanPt compares the banks and NBFCs with the quickest instant-loan processes, matches you to the best rate your profile qualifies for, and guides you from application to disbursal. It is completely free for you.',
            'bullets' => array('Fully online application', 'Quick digital approval', 'Minimal documents', 'Fast disbursal', 'Collateral-free', 'Fixed, predictable EMI'),
            'compare' => true,
            'faq' => array(
                'What is an instant personal loan?' => 'It is a personal loan with a fast, mostly digital approval and disbursal process — you apply online, share a few documents, and eligible applicants receive funds quickly.',
                'Who is eligible for an instant personal loan?' => 'Typically salaried or self-employed applicants with a steady income and a reasonable credit score. We check your profile across multiple banks and tell you the best fit — free.',
                'How much can I get through an instant loan?' => 'It depends on your income, credit profile and the lender. Share your details for an indicative amount — free, with no impact on your credit score.',
                'Is LoanPt free?' => 'Yes — our service is free to you. Lenders may charge their own processing fee, shown transparently.',
            ),
        ),
        'zero-processing-fee-personal-loan' => array(
            'title' => 'Zero / Low Processing Fee Personal Loan — Save on Charges',
            'h1'    => 'Zero &amp; Low Processing Fee <em>Personal Loan</em>',
            'meta'  => 'Looking for a zero or low processing fee personal loan? Compare offers with minimal charges from leading banks & NBFCs and keep more of your loan. All fees shown upfront — free with LoanPt.',
            'product' => 'Personal Loan',
            'intro' => 'The processing fee on a personal loan can quietly add thousands to your cost. LoanPt helps you compare offers with zero or low processing fees from leading banks and NBFCs, and shows every charge transparently so there are no surprises. We weigh the fee against the interest rate to find the option that costs you the least overall, and handle the paperwork. It is completely free for you.',
            'bullets' => array('Zero / low processing-fee offers*', 'Every charge shown upfront', 'Lowest effective cost', 'No hidden fees', 'Compare every bank', 'Collateral-free'),
            'compare' => true,
            'faq' => array(
                'Can I really get a personal loan with zero processing fee?' => 'Some banks and NBFCs run zero or reduced processing-fee offers from time to time, often for select profiles or amounts. We check who has the best offer right now and show every charge transparently — we never hide a fee.',
                'What charges should I watch for on a personal loan?' => 'Mainly the processing fee, plus any GST on it, documentation charges and prepayment or foreclosure charges. We lay out the full cost so you compare the true, effective rate — not just the headline number.',
                'Does a zero fee mean a higher interest rate?' => 'Not always, but sometimes a zero-fee offer carries a slightly higher rate, or the other way round. We compare the total cost so you pick what is genuinely cheapest for you.',
                'Is LoanPt free?' => 'Yes — our service is free to you. Any lender fees are shown transparently before you proceed.',
            ),
        ),
        'personal-loan-delhi-ncr' => array(
            'title' => 'Personal Loan in Delhi NCR — Compare & Apply at the Lowest Rate',
            'h1'    => 'Personal Loan in <em>Delhi NCR</em> — Compare Every Bank',
            'meta'  => 'Compare personal loan offers across Delhi NCR — Delhi, Noida, Gurugram, Ghaziabad, Faridabad & Greater Noida — from HDFC, ICICI, Axis, Bajaj & more. Check eligibility free with LoanPt.',
            'product' => 'Personal Loan',
            'intro' => 'Looking for a personal loan anywhere in Delhi NCR? Whether you are in Delhi, Noida, Gurugram, Ghaziabad, Faridabad or Greater Noida, LoanPt compares personal loan offers from every major bank and NBFC and matches you to the lowest rate your profile qualifies for — with minimal paperwork and at zero cost to you. Use the city links below to get offers specific to where you are.',
            'bullets' => array('Loan up to ₹50 Lakh+', 'Tenure up to 84 months', 'Minimal documents', 'Quick disbursal', 'Fixed EMI', 'No collateral needed'),
            'compare' => true,
            'faq' => array(
                'Can I get a personal loan anywhere in Delhi NCR?' => 'Yes — we work with banks and NBFCs that lend across all of NCR, including Delhi, Noida, Gurugram, Ghaziabad, Faridabad and Greater Noida. Share your details and our team finds your best option, free.',
                'Who is eligible for a personal loan in NCR?' => 'Typically salaried or self-employed applicants with a steady income and a reasonable credit score. We check your profile against multiple banks and tell you the best fit.',
                'What documents do I need?' => 'Usually ID & address proof, PAN, and recent salary slips or bank statements. We guide you through the exact list for the bank you qualify for.',
                'What interest rate will I get?' => 'It depends on the bank, your income and credit profile, so the lender decides it. We pull competitive partner-bank offers and never promise a fixed rate upfront.',
            ),
        ),
        'low-interest-personal-loan' => array(
            'title' => 'Low Interest Personal Loan — Compare the Lowest Rates',
            'h1'    => 'Low Interest <em>Personal Loan</em> — the Lowest Rates',
            'meta'  => 'Compare low interest personal loan offers from leading banks & NBFCs and get the lowest rate your profile qualifies for. Check eligibility free with LoanPt — zero cost.',
            'product' => 'Personal Loan',
            'intro' => 'Even a slightly lower interest rate can save you thousands over your loan tenure. LoanPt compares personal loan rates across leading banks and NBFCs and matches you to the lowest rate your income and credit profile qualify for — then shows the full cost, including fees, so you compare the true rate rather than just the headline number. It is completely free for you.',
            'bullets' => array('Lowest rate for your profile', 'Compare every bank & NBFC', 'Full cost, including fees', 'A better CIBIL = a lower rate', 'Minimal paperwork', 'Collateral-free'),
            'compare' => true,
            'faq' => array(
                'How do I get the lowest interest rate on a personal loan?' => 'A higher credit score (ideally 750+), stable income, a lower existing EMI burden and a clean repayment history all help you qualify for a lower rate. We compare banks to find your best one.',
                'What is a good personal loan interest rate?' => 'Rates vary by lender, product and profile, so there is no single number — the best rate is the lowest one you personally qualify for. We pull competitive partner-bank offers and never promise a fixed rate upfront.',
                'Does checking offers affect my credit score?' => 'Comparing offers and checking your eligibility with us does not affect your score. Only a lender\'s hard enquiry, when you formally apply, has a small, temporary effect.',
                'Is LoanPt free?' => 'Yes — our service is free to you. Lenders may charge their own processing fee, shown transparently.',
            ),
        ),
        'personal-loan-for-salaried' => array(
            'title' => 'Personal Loan for Salaried Employees — Lowest Rate, Quick Approval',
            'h1'    => 'Personal Loan for <em>Salaried</em> Employees',
            'meta'  => 'Compare personal loan offers for salaried employees from leading banks & NBFCs — the lowest rate, quick approval and minimal documents. Check eligibility free with LoanPt.',
            'product' => 'Personal Loan',
            'intro' => 'If you are salaried, lenders can often approve your personal loan quickly on the strength of your salary slips and bank statement. LoanPt compares personal loan offers for salaried professionals across leading banks and NBFCs, matches you to the lowest rate your profile qualifies for, and handles the paperwork end to end. It is completely free for you.',
            'bullets' => array('For salaried professionals', 'Lowest rate for your profile', 'Approval on salary slips', 'Quick disbursal', 'Minimal documents', 'Collateral-free'),
            'compare' => true,
            'faq' => array(
                'What is the eligibility for a salaried personal loan?' => 'Lenders look at your monthly salary, employer, total experience, credit score and existing EMIs. A steady job and a score around 750+ get the best offers. We check your fit across banks — free.',
                'What documents do salaried applicants need?' => 'Usually ID & address proof, PAN, the last 3 months\' salary slips and 3–6 months\' bank statements. We guide you through the exact list for the bank you qualify for.',
                'How much personal loan can a salaried person get?' => 'Often several times your monthly salary, depending on your income, existing obligations and the lender. Share your details for an indicative amount — free.',
                'Is LoanPt free?' => 'Yes — our service is free to you. Lenders may charge their own processing fee, shown transparently.',
            ),
        ),
        'personal-loan-for-self-employed' => array(
            'title' => 'Personal Loan for Self-Employed — Compare Offers & Apply',
            'h1'    => 'Personal Loan for the <em>Self-Employed</em>',
            'meta'  => 'Compare personal loan offers for self-employed professionals and business owners from leading banks & NBFCs — competitive rates and flexible documents. Check free with LoanPt.',
            'product' => 'Personal Loan',
            'intro' => 'Self-employed? Lenders assess your personal loan on your business income, bank statements and ITR rather than a salary slip. LoanPt compares personal loan offers for self-employed professionals, proprietors and business owners across leading banks and NBFCs, matches you to a lender comfortable with your profile, and handles the paperwork. It is completely free for you.',
            'bullets' => array('For self-employed & business owners', 'Assessed on ITR & bank statements', 'Competitive rates', 'Flexible documentation', 'Quick disbursal', 'Collateral-free options'),
            'compare' => true,
            'faq' => array(
                'Can a self-employed person get a personal loan?' => 'Yes — with a running business, reasonable financials and a decent credit score, self-employed applicants qualify with many banks and NBFCs. We match you to lenders comfortable with your profile.',
                'What documents does a self-employed applicant need?' => 'Usually KYC, the last 2 years\' ITR with computation, 6–12 months\' bank statements, and business proof (GST / registration). We tell you the exact list for your lender.',
                'How is eligibility decided for the self-employed?' => 'Lenders look at your business income and stability, bank-statement inflows, ITR, existing obligations and credit score. We help you present the strongest profile.',
                'Is LoanPt free?' => 'Yes — our service is free to you. Lenders may charge their own processing fee, shown transparently.',
            ),
        ),
        'personal-loan-minimal-documents' => array(
            'title' => 'Personal Loan with Minimal Documents — Quick & Paperless',
            'h1'    => 'Personal Loan with <em>Minimal Documents</em>',
            'meta'  => 'Get a personal loan with minimal documents — a quick, mostly paperless journey from leading banks & NBFCs for eligible applicants. Check eligibility free with LoanPt.',
            'product' => 'Personal Loan',
            'intro' => 'Dreading the paperwork? Many banks and NBFCs now offer a near-paperless personal loan — a quick digital journey where eligible applicants submit just a few documents, often a PAN, address proof and a bank statement. LoanPt matches you to the lenders with the simplest document requirements for your profile and guides you through a fast application. It is completely free for you.',
            'bullets' => array('Few documents needed', 'Mostly paperless journey', 'Quick approval', 'For eligible applicants*', 'Collateral-free', 'Fixed EMI'),
            'compare' => true,
            'faq' => array(
                'Can I get a personal loan with minimal documents?' => 'Yes — for eligible applicants, many lenders keep it to a few essentials like PAN, address proof and a bank statement, with a mostly digital process. We match you to the simplest option for your profile.',
                'Is a completely no-document personal loan possible?' => 'No genuine lender gives a loan with zero documents — at least KYC and some income evidence are always required. Be cautious of anyone promising a loan with no documents at all; it is usually a scam. We only work with legitimate banks and NBFCs.',
                'What are the minimum documents usually required?' => 'Typically PAN and address proof (KYC), plus a recent salary slip or bank statement as income proof. We guide you through the exact short list for your lender.',
                'Is LoanPt free?' => 'Yes — our service is free to you. Lenders may charge their own processing fee, shown transparently.',
            ),
        ),
        'personal-loan-low-cibil' => array(
            'title' => 'Personal Loan for Low CIBIL Score — Options & How to Qualify',
            'h1'    => 'Personal Loan for a <em>Low CIBIL Score</em>',
            'meta'  => 'Have a low CIBIL score? See your personal loan options, how lenders decide, and practical steps to qualify and improve your score. Honest guidance from LoanPt — free.',
            'product' => 'Personal Loan',
            'intro' => 'A low credit score makes a personal loan harder — but not always impossible. Some lenders consider a fair score when your income is steady and your other obligations are low, though usually at a higher rate. LoanPt checks multiple banks and NBFCs to see who may approve you, gives you honest guidance, and shows simple steps to improve your score for a better rate. It is completely free for you.',
            'bullets' => array('Options for a fair / low score', 'Multiple lenders checked for you', 'Honest, no false promises', 'Steps to improve your score', 'Strong income can help', 'No cost to check'),
            'compare' => false,
            'faq' => array(
                'Can I get a personal loan with a low CIBIL score?' => 'Sometimes — some lenders consider a fair score (around 650–750) when your income is steady and existing EMIs are low, usually at a higher rate. Below 650 it is harder, but we check who may still approve you.',
                'How can I improve my chances of approval?' => 'Show stable income, keep existing EMIs and card usage low, add a co-applicant if possible, and apply only where you realistically qualify — each rejected application hurts your score. We help you apply smartly.',
                'How do I raise a low CIBIL score?' => 'Pay every EMI and card bill on time, keep card usage under 30% of the limit, fix any errors on your report, and avoid multiple applications at once. Most people see improvement in 4–6 months.',
                'Is LoanPt free?' => 'Yes — our service is free to you. We give honest guidance and never charge you for it.',
            ),
        ),
    );
}

/** Bank-wise landing pages (bank x product) — high-intent SEO, honest DSA framing. */
function loanpt_bank_defs() {
    $banks = array(
        'hdfc'  => array('HDFC Bank', 'one of India\'s largest private banks, known for quick processing and competitive rates'),
        'sbi'   => array('SBI', 'India\'s largest public-sector bank (State Bank of India), known for among the lowest rates and nationwide reach'),
        'icici' => array('ICICI Bank', 'a leading private bank with fast, largely digital loan journeys'),
        'axis'  => array('Axis Bank', 'a major private bank with flexible loan options'),
        'kotak' => array('Kotak Mahindra Bank', 'a private bank known for competitive rates and quick approvals'),
        'bajaj' => array('Bajaj Finserv', 'a leading NBFC known for high loan amounts and fast disbursal'),
        'idfc'  => array('IDFC First Bank', 'a new-age private bank with competitive loan rates'),
    );
    $products = array(
        'personal-loan' => array('Personal Loan', 'Personal Loan', true,
            array('Loan up to ₹40 Lakh+', 'Competitive interest rate', 'Minimal documents', 'Quick disbursal', 'Fixed EMI', 'No collateral'),
            'ID & address proof, PAN, and recent salary slips or bank statements'),
        'home-loan' => array('Home Loan', 'Home Loan', false,
            array('Low interest rate', 'Tenure up to 30 years', 'High loan amount', 'Balance transfer & top-up', 'Minimal paperwork', 'Fully managed'),
            'KYC, income proof (salary slips or ITR), bank statements and property documents'),
        'business-loan' => array('Business Loan', 'Business Loan', false,
            array('Collateral-free options', 'Working capital & term loans', 'Flexible tenure', 'Quick disbursal', 'Minimal paperwork', 'For self-employed & businesses'),
            'KYC, business proof (GST / registration), bank statements and ITR'),
    );
    $out = array();
    foreach ($banks as $bslug => $b) {
        $name = $b[0]; $blurb = $b[1];
        foreach ($products as $pslug => $p) {
            $plabel = $p[0]; $prod = $p[1]; $cmp = $p[2]; $bullets = $p[3]; $docs = $p[4];
            $pl = strtolower($plabel);
            $out[$bslug . '-' . $pslug] = array(
                'title'   => $name . ' ' . $plabel . ' — Compare Rate & Apply via LoanPt',
                'h1'      => $name . ' <em>' . $plabel . '</em>',
                'meta'    => 'Compare ' . $name . ' ' . $plabel . ' offers with every other bank & NBFC and get the best rate your profile qualifies for. Apply free with LoanPt — a loan facilitator, not the bank.',
                'product' => $prod,
                'intro'   => 'Planning to take a ' . $pl . ' from ' . $name . '? ' . $name . ' is ' . $blurb . '. LoanPt helps you compare ' . $name . '\'s ' . $pl . ' offer against every other major bank and NBFC, finds the best rate your profile qualifies for, and handles the paperwork — completely free. We are a loan facilitator (DSA), not the bank.',
                'bullets' => $bullets,
                'compare' => $cmp,
                'faq'     => array(
                    'Can LoanPt help me get a ' . $plabel . ' from ' . $name . '?' => 'Yes — LoanPt is a loan facilitator that helps you apply for a ' . $pl . ' from ' . $name . ' and other leading lenders. We compare offers and match you to the best rate your profile qualifies for, free. Final approval and terms are decided by the bank.',
                    'What is the interest rate on a ' . $name . ' ' . $plabel . '?' => 'It depends on your income, credit profile and the bank\'s current offers, so ' . $name . ' decides the final rate. We pull competitive partner offers and never promise a fixed rate upfront.',
                    'What documents does ' . $name . ' need?' => 'Usually ' . $docs . '. We guide you through the exact list for your profile.',
                    'Is LoanPt free to use?' => 'Yes — our service is free to you. Lenders may charge their own processing fee, shown transparently.',
                ),
            );
        }
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
        // Descriptive admin title ("Personal Loan in Mumbai"), not just the product.
        $pt = isset($d['city']) ? ($d['product'] . ' in ' . $d['city']) : $d['product'];
        $existing = get_page_by_path($slug);
        if (!$existing) {
            wp_insert_post(array(
                'post_title'   => $pt,
                'post_name'    => $slug,
                'post_status'  => 'publish',
                'post_type'    => 'page',
                'post_content' => 'LoanPt ' . $pt . ' landing page.',
                'page_template'=> 'tpl-landing.php',
                'meta_input'   => array('_wp_page_template' => 'tpl-landing.php'),
            ));
        } else {
            update_post_meta($existing->ID, '_wp_page_template', 'tpl-landing.php');
            if ($existing->post_title !== $pt) {
                wp_update_post(array('ID' => $existing->ID, 'post_title' => $pt));
            }
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

/* ---------- Blog + Eligibility Quiz + Customer Login + Legal ---------- */
define('LOANPT_BLOG_VER', '3');

/** Full HTML body for the Privacy Policy page. */
function loanpt_privacy_body() {
    return <<<'HTML'
<p>LoanPt (&ldquo;LoanPt&rdquo;, &ldquo;we&rdquo;, &ldquo;us&rdquo; or &ldquo;our&rdquo;) respects your privacy and is committed to protecting your personal data. This Privacy Policy explains what information we collect when you use our website or app, how we use it, and the choices you have. LoanPt is a loan facilitation service (a DSA / referral partner) and is not a bank or a lender.</p>
<h2>1. Who we are</h2>
<p>LoanPt helps salaried and self-employed individuals in India compare and apply for personal loans, overdraft and balance-transfer products from partner banks and NBFCs. You can reach us at <a href="mailto:connect@loanpt.com">connect@loanpt.com</a> or <a href="tel:+919625913455">9625913455</a>.</p>
<h2>2. Information we collect</h2>
<ul>
<li><strong>Details you give us:</strong> your name, mobile number, email, city, employment type, income range, and the loan product and amount you are interested in.</li>
<li><strong>Google sign-in details:</strong> if you log in with Google, we receive your name and verified email address from Google. We never receive your Google password.</li>
<li><strong>Application documents:</strong> if you choose to apply, documents you upload (such as ID, address or income proof) to process your loan application.</li>
<li><strong>Technical data:</strong> basic device and usage information needed to run and secure our website and app.</li>
</ul>
<h2>3. How we use your information</h2>
<ul>
<li>To understand your requirement and match you with suitable loan offers from partner banks and NBFCs;</li>
<li>To contact you about your enquiry or application by call, SMS, WhatsApp or email;</li>
<li>To process and track your loan application and share updates with you;</li>
<li>To improve our services and keep them secure.</li>
</ul>
<h2>4. Sharing your information</h2>
<p>To help you get a loan, we share the information you provide with partner banks and NBFCs so they can assess and process your application. We may also share data with service providers who help us operate (for example SMS, email or hosting providers), under appropriate confidentiality obligations. <strong>We do not sell your personal data to anyone.</strong></p>
<h2>5. Google Sign-In</h2>
<p>When you sign in with Google, we use Google&rsquo;s secure authentication only to verify your identity and create or access your LoanPt account. We request only your basic profile (name and email). We do not post anything to your Google account and do not access your contacts, files or other Google data.</p>
<h2>6. Data security</h2>
<p>We use reasonable technical and organisational measures to protect your information, and sensitive documents are stored securely. However, no method of transmission over the internet is completely secure, and we cannot guarantee absolute security. <strong>We will never ask you for your OTP, card number, CVV, net-banking password or account password.</strong></p>
<h2>7. How long we keep your data</h2>
<p>We keep your information for as long as needed to provide our services and to meet legal, regulatory and record-keeping requirements, after which it is deleted or anonymised.</p>
<h2>8. Your rights</h2>
<p>You may ask us to access, correct or delete your personal data, or to stop contacting you, by writing to <a href="mailto:connect@loanpt.com">connect@loanpt.com</a>. We will act on your request in line with applicable law, including India&rsquo;s Digital Personal Data Protection Act, 2023.</p>
<h2>9. Cookies</h2>
<p>Our website uses only the minimal cookies and local storage needed to function (for example, to keep you signed in). We do not use them to collect sensitive personal data.</p>
<h2>10. Children</h2>
<p>Our services are intended for individuals aged 18 and above. We do not knowingly collect data from minors.</p>
<h2>11. Changes to this policy</h2>
<p>We may update this Privacy Policy from time to time. The latest version will always be available on this page with its &ldquo;Last updated&rdquo; date.</p>
<h2>12. Contact us</h2>
<p>For any question about this policy or your data, email <a href="mailto:connect@loanpt.com">connect@loanpt.com</a> or call <a href="tel:+919625913455">9625913455</a>.</p>
HTML;
}

/** Full HTML body for the Terms &amp; Conditions page. */
function loanpt_terms_body() {
    return <<<'HTML'
<p>These Terms &amp; Conditions (&ldquo;Terms&rdquo;) govern your use of the LoanPt website and app and the services we provide. By using our services or signing in, you agree to these Terms. Please read them carefully.</p>
<h2>1. About our service</h2>
<p>LoanPt is a loan facilitation service (a DSA / referral partner). <strong>We are not a bank, NBFC or lender.</strong> We help you compare loan products and connect you with partner banks and NBFCs. All loans are sanctioned and disbursed solely at the discretion of the respective lender, subject to their eligibility criteria, documentation and approval.</p>
<h2>2. No guarantee of approval or rate</h2>
<p>We do not guarantee loan approval, any particular loan amount, interest rate or processing time. Interest rates and features shown on our website are indicative and subject to change by the lender. The final terms are decided by the lender.</p>
<h2>3. Eligibility</h2>
<p>You must be at least 18 years old and a resident of India to use our services.</p>
<h2>4. Our service is free to you</h2>
<p>LoanPt does not charge you for comparing offers or applying through us — we are compensated by the lender. Lenders may charge their own fees (such as a processing fee), which are shown to you by the lender and are your responsibility if you choose to proceed.</p>
<h2>5. Accurate information</h2>
<p>You agree to provide true, current and complete information. Providing false information may lead to rejection of your application by the lender, and we are not responsible for such outcomes.</p>
<h2>6. Your account &amp; Google Sign-In</h2>
<p>You may create an account using your mobile number and OTP, or by signing in with Google. You are responsible for keeping access to your account secure. <strong>We will never ask you for your OTP, card details or passwords</strong> — never share these with anyone claiming to be from LoanPt.</p>
<h2>7. Acceptable use</h2>
<p>You agree not to misuse our services, submit fraudulent information, or use them for any unlawful purpose.</p>
<h2>8. Third-party lenders</h2>
<p>Once you proceed with a lender, the lender&rsquo;s own terms, policies and agreements apply to your loan. LoanPt is not a party to the loan contract between you and the lender.</p>
<h2>9. Limitation of liability</h2>
<p>Our services are provided on an &ldquo;as is&rdquo; basis. To the extent permitted by law, LoanPt is not liable for any loss arising from a lender&rsquo;s decision, a delay in processing, or your reliance on indicative information. Our role is limited to facilitation.</p>
<h2>10. Intellectual property</h2>
<p>The LoanPt name, logo and website content are our property and may not be copied or used without permission.</p>
<h2>11. Changes to these Terms</h2>
<p>We may update these Terms from time to time. Continued use of our services after an update means you accept the revised Terms.</p>
<h2>12. Governing law</h2>
<p>These Terms are governed by the laws of India, and any disputes are subject to the jurisdiction of the courts of India.</p>
<h2>13. Contact us</h2>
<p>Questions about these Terms? Email <a href="mailto:connect@loanpt.com">connect@loanpt.com</a> or call <a href="tel:+919625913455">9625913455</a>.</p>
HTML;
}

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
        'privacy-policy' => array(
            'h1'      => 'Privacy Policy',
            'title'   => 'Privacy Policy — How LoanPt Protects Your Data',
            'meta'    => 'How LoanPt collects, uses and protects your personal data. We never sell your data and never ask for OTP, card or password details.',
            'tpl'     => 'tpl-legal.php',
            'intro'   => 'Your privacy matters to us. This policy explains what we collect, how we use it, and the choices you have.',
            'updated' => 'November 2026',
            'body'    => loanpt_privacy_body(),
        ),
        'terms' => array(
            'h1'      => 'Terms & Conditions',
            'title'   => 'Terms & Conditions — LoanPt Loan Facilitation Service',
            'meta'    => 'The terms governing your use of LoanPt. We are a loan facilitation service (DSA), not a lender, and never charge you or ask for OTP, card or password details.',
            'tpl'     => 'tpl-legal.php',
            'intro'   => 'The simple terms that govern your use of LoanPt and our services.',
            'updated' => 'November 2026',
            'body'    => loanpt_terms_body(),
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

/* ---------- Loan calculators (EMI tools) — lead magnets ---------- */
define('LOANPT_CALC_VER', '2');

/** EMI calculator pages, keyed by slug. amt/rate/ten = [min, max, default, step]. */
function loanpt_calc_defs() {
    $faq_common = function ($p) {
        return array(
            'How is the ' . $p . ' EMI calculated?' => 'EMI depends on three things — the loan amount, the interest rate and the tenure — using the standard formula EMI = P x r x (1+r)^n / ((1+r)^n - 1), where r is the monthly rate and n is the number of months. Our calculator works it out instantly as you move the sliders.',
            'Does a longer tenure reduce my EMI?' => 'Yes — a longer tenure lowers the monthly EMI, but you pay more total interest over the life of the loan. A shorter tenure means a higher EMI but less interest overall. Try both on the calculator to find your balance.',
            'Is the calculated EMI final?' => 'No — it is an indicative figure based on the rate you enter. Your actual rate, amount and EMI are decided by the lender after approval. Share your details and our team finds you the lowest rate across every bank — free.',
        );
    };
    return array(
        'personal-loan-emi-calculator' => array(
            'title' => 'Personal Loan EMI Calculator — Calculate Your Monthly EMI Free',
            'h1'    => 'Personal Loan <em>EMI Calculator</em>',
            'meta'  => 'Free personal loan EMI calculator — work out your monthly EMI by loan amount, interest rate and tenure, instantly. Then get the lowest rate across every bank with LoanPt.',
            'product' => 'Personal Loan',
            'intro' => 'Work out your personal loan EMI in seconds. Move the sliders for your loan amount, interest rate and tenure to see your monthly EMI, total interest and total payable — then let LoanPt find you the lowest rate across every bank. Free, with no sign-up.',
            'amt' => array(50000, 5000000, 500000, 10000),
            'rate' => array(9, 24, 11, 0.25),
            'ten' => array(6, 84, 36, 6),
            'faq' => $faq_common('personal loan') + array(
                'What interest rate should I use?' => 'Personal loan rates typically start around 10-11% p.a. and vary by lender and profile. Use a rate near that to estimate, then let us find you the lowest actual rate — free.',
            ),
        ),
        'home-loan-emi-calculator' => array(
            'title' => 'Home Loan EMI Calculator — Calculate Your Monthly EMI Free',
            'h1'    => 'Home Loan <em>EMI Calculator</em>',
            'meta'  => 'Free home loan EMI calculator — see your monthly EMI by loan amount, interest rate and tenure (up to 30 years). Then get the lowest home loan rate with LoanPt.',
            'product' => 'Home Loan',
            'intro' => 'Planning a home loan? Move the sliders for your loan amount, interest rate and tenure to see your monthly EMI instantly — home loans offer tenures up to 30 years to keep the EMI comfortable. Then let LoanPt find you the lowest rate across every bank. Free.',
            'amt' => array(500000, 50000000, 5000000, 100000),
            'rate' => array(7.5, 12, 8.5, 0.1),
            'ten' => array(12, 360, 240, 12),
            'faq' => $faq_common('home loan') + array(
                'How long can a home loan tenure be?' => 'Home loans offer long tenures — up to 30 years — which keeps the EMI low. A longer tenure reduces your EMI but increases total interest; we help you pick the right balance.',
            ),
        ),
        'business-loan-emi-calculator' => array(
            'title' => 'Business Loan EMI Calculator — Calculate Your Monthly EMI Free',
            'h1'    => 'Business Loan <em>EMI Calculator</em>',
            'meta'  => 'Free business loan EMI calculator — work out your monthly EMI by amount, rate and tenure. Then get the best working-capital or term-loan offer with LoanPt.',
            'product' => 'Business Loan',
            'intro' => 'See what your business loan will cost each month. Move the sliders for amount, interest rate and tenure to get your EMI, total interest and total payable — then let LoanPt match you to the right lender at a competitive rate. Free.',
            'amt' => array(100000, 10000000, 1000000, 50000),
            'rate' => array(11, 26, 16, 0.25),
            'ten' => array(6, 60, 36, 6),
            'faq' => $faq_common('business loan') + array(
                'What rate applies to a business loan?' => 'Unsecured business loan rates usually start around 14-16% p.a. and depend on your business profile and lender. Use a rate near that to estimate, then we find your best actual offer — free.',
            ),
        ),
        'loan-against-property-emi-calculator' => array(
            'title' => 'Loan Against Property EMI Calculator — Free LAP EMI Calc',
            'h1'    => 'Loan Against Property <em>EMI Calculator</em>',
            'meta'  => 'Free loan against property (LAP) EMI calculator — see your monthly EMI by amount, rate and tenure. Then get the lowest LAP rate across every bank with LoanPt.',
            'product' => 'Loan Against Property',
            'intro' => 'Work out your loan against property (LAP) EMI in seconds. Because a LAP is secured by your property, it usually comes at a lower rate and a longer tenure — move the sliders to see your EMI, then let LoanPt find you the lowest rate. Free.',
            'amt' => array(500000, 50000000, 3000000, 100000),
            'rate' => array(8.5, 14, 10.5, 0.1),
            'ten' => array(12, 240, 120, 12),
            'faq' => $faq_common('loan against property') + array(
                'Why is a LAP EMI lower than a personal loan?' => 'Because a loan against property is secured by your property, it usually carries a lower interest rate and a longer tenure than an unsecured personal loan — so the EMI is lower for the same amount. We find you the best LAP rate, free.',
            ),
        ),
        'car-loan-emi-calculator' => array(
            'title' => 'Car Loan EMI Calculator — Calculate Your Monthly EMI Free',
            'h1'    => 'Car Loan <em>EMI Calculator</em>',
            'meta'  => 'Free car loan EMI calculator — work out your monthly EMI by loan amount, interest rate and tenure. Then get the lowest car loan rate with LoanPt.',
            'product' => 'Car Loan',
            'intro' => 'Buying a car? Move the sliders for your loan amount, interest rate and tenure to see your monthly EMI, total interest and total payable — then let LoanPt find you the lowest car loan rate across every bank. Free.',
            'amt' => array(100000, 5000000, 800000, 25000),
            'rate' => array(8.5, 16, 9.5, 0.25),
            'ten' => array(12, 84, 60, 6),
            'faq' => $faq_common('car loan') + array(
                'How much of the car price can I finance?' => 'Many lenders finance up to 90-100% of the on-road price. Enter your loan amount and rate to see the EMI, then we find you the lowest car loan rate — free.',
            ),
        ),
        'gold-loan-emi-calculator' => array(
            'title' => 'Gold Loan EMI Calculator — Calculate Your Monthly EMI Free',
            'h1'    => 'Gold Loan <em>EMI Calculator</em>',
            'meta'  => 'Free gold loan EMI calculator — see your monthly EMI by loan amount, rate and tenure. Then get the best value per gram and lowest rate with LoanPt.',
            'product' => 'Gold Loan',
            'intro' => 'Borrowing against gold? Move the sliders for your loan amount, interest rate and tenure to see your monthly EMI instantly — then let LoanPt get you the most value per gram at a competitive rate, with same-day disbursal. Free.',
            'amt' => array(20000, 2500000, 200000, 10000),
            'rate' => array(8.5, 24, 12, 0.5),
            'ten' => array(3, 36, 12, 3),
            'faq' => $faq_common('gold loan') + array(
                'How is a gold loan EMI different?' => 'Gold loans are short-tenure and secured by your gold, so the EMI covers a smaller amount over a shorter period. Some gold loans also allow interest-only or bullet repayment — we explain the options and find your best rate, free.',
            ),
        ),
    );
}

/** SEO meta for the /calculators/ hub page. */
function loanpt_calc_hub_meta() {
    return array(
        'title' => 'Loan Calculators — Free EMI & Eligibility Tools',
        'meta'  => 'Free loan calculators from LoanPt — personal loan, home loan, business loan, loan against property, car and gold loan EMI calculators, plus eligibility. Plan your loan and get the best rate.',
    );
}

/** Non-EMI tool calculators (prepayment, balance transfer, eligibility, SIP, FD, GST). */
function loanpt_tool_defs() {
    return array(
        'loan-prepayment-calculator' => array(
            'type' => 'prepay', 'product' => 'Personal Loan', 'short' => 'Prepayment',
            'title' => 'Loan Prepayment Calculator — See Interest Saved & Tenure Cut',
            'h1'    => 'Loan Prepayment <em>Calculator</em>',
            'heading' => 'Loan Prepayment Calculator',
            'meta'  => 'Free loan prepayment / part-payment calculator — see how much interest you save and how many months you cut by paying extra. Then get a lower rate with LoanPt.',
            'intro' => 'Thinking of prepaying your loan? See exactly how much interest you save and how many months you shave off — just enter your loan and the amount you want to prepay. A lower interest rate saves you even more; let LoanPt find you one. Free.',
            'cta' => 'Get a lower rate',
            'disc' => 'This is an indicative estimate assuming your EMI stays the same and the prepayment is made now. Actual savings depend on your lender\'s terms. LoanPt is a loan facilitator, not a lender.',
            'inputs' => array(
                array('amount', 'Loan amount', 50000, 10000000, 1000000, 50000, 'money'),
                array('rate', 'Interest rate (p.a.)', 8, 24, 12, 0.25, 'pct'),
                array('tenure', 'Tenure', 6, 360, 60, 6, 'months'),
                array('prepay', 'Prepayment amount', 10000, 5000000, 200000, 10000, 'money'),
            ),
            'faq' => array(
                'How does prepaying a loan save me money?' => 'Prepaying reduces your outstanding principal, so less interest builds up on the remaining balance. If you keep the EMI the same, the loan closes sooner and you save on total interest — this calculator shows exactly how much.',
                'Should I reduce my EMI or my tenure when I prepay?' => 'Reducing the tenure (keeping the EMI the same) usually saves more total interest, which is what this calculator shows. Reducing the EMI eases monthly cash-flow instead. We can help you decide.',
                'Are there prepayment charges?' => 'Floating-rate personal and home loans to individuals usually have no prepayment charge, but some loans do. Check your loan agreement — and we can help you move to a loan with better terms, free.',
            ),
        ),
        'balance-transfer-savings-calculator' => array(
            'type' => 'bt', 'product' => 'Balance Transfer', 'short' => 'Balance Transfer',
            'title' => 'Balance Transfer Savings Calculator — See How Much You Save',
            'h1'    => 'Balance Transfer <em>Savings Calculator</em>',
            'heading' => 'Balance Transfer Savings Calculator',
            'meta'  => 'Free balance transfer calculator — see how much you save by moving your loan to a lower rate: a lower EMI and total interest saved. Then transfer with LoanPt, free.',
            'intro' => 'Paying a high rate on your loan? See how much a balance transfer to a lower rate saves you — both your monthly EMI and the total interest over the remaining tenure. Enter your numbers, then let LoanPt find you the lowest rate and manage the switch. Free.',
            'cta' => 'Transfer & save',
            'disc' => 'This is an indicative estimate assuming the same remaining tenure. Actual savings depend on the lender, any processing fee and your profile. LoanPt is a loan facilitator, not a lender.',
            'inputs' => array(
                array('amount', 'Outstanding loan amount', 50000, 10000000, 800000, 50000, 'money'),
                array('crate', 'Current interest rate', 10, 30, 16, 0.25, 'pct'),
                array('nrate', 'New interest rate', 8, 24, 11, 0.25, 'pct'),
                array('tenure', 'Remaining tenure', 6, 300, 48, 6, 'months'),
            ),
            'faq' => array(
                'What is a loan balance transfer?' => 'It means moving your existing loan\'s outstanding balance to a new lender offering a lower interest rate, so your EMI and total interest come down. This calculator shows your likely saving.',
                'Is a balance transfer always worth it?' => 'Usually when the new rate is meaningfully lower and you still have a good chunk of tenure left. Factor in any processing fee on the new loan — we help you check if it truly saves you money.',
                'Can I get extra funds during a transfer?' => 'Often yes — many lenders offer a top-up over the transferred amount, subject to eligibility. We arrange both the transfer and the top-up, free.',
            ),
        ),
        'personal-loan-eligibility-calculator' => array(
            'type' => 'eligibility', 'product' => 'Personal Loan', 'short' => 'PL Eligibility', 'cfg' => array('foir' => 0.5),
            'title' => 'Personal Loan Eligibility Calculator — Check Your Limit Free',
            'h1'    => 'Personal Loan <em>Eligibility Calculator</em>',
            'heading' => 'Personal Loan Eligibility Calculator',
            'meta'  => 'Free personal loan eligibility calculator — estimate how much personal loan you can get from your income and existing EMIs. Then get the lowest rate with LoanPt.',
            'intro' => 'See how much personal loan you may be eligible for in seconds. Enter your monthly income, existing EMIs, rate and tenure for an indicative amount — then let LoanPt find you the lowest rate across every bank. Free, with no impact on your credit score.',
            'cta' => 'Get this loan',
            'inputs' => array(
                array('income', 'Monthly income', 15000, 1000000, 50000, 5000, 'money'),
                array('emi', 'Existing monthly EMIs', 0, 500000, 0, 1000, 'money'),
                array('rate', 'Interest rate (p.a.)', 9, 24, 13, 0.25, 'pct'),
                array('tenure', 'Tenure', 6, 84, 48, 6, 'months'),
            ),
            'faq' => array(
                'How is personal loan eligibility calculated?' => 'Lenders cap your total EMIs at a share of your income (the FOIR, often around 50%). Your eligible loan is what the remaining EMI capacity can support at the given rate and tenure — which is what this calculator estimates.',
                'How can I increase my loan eligibility?' => 'A higher income, fewer existing EMIs, a longer tenure and a better credit score all raise your eligibility. We check multiple banks to find who offers you the most.',
                'Does checking eligibility affect my credit score?' => 'No — using this calculator and checking your options with us does not affect your score. Only a lender\'s hard enquiry, when you formally apply, has a small, temporary effect.',
            ),
        ),
        'home-loan-eligibility-calculator' => array(
            'type' => 'eligibility', 'product' => 'Home Loan', 'short' => 'Home Eligibility', 'cfg' => array('foir' => 0.55),
            'title' => 'Home Loan Eligibility Calculator — How Much Can You Borrow?',
            'h1'    => 'Home Loan <em>Eligibility Calculator</em>',
            'heading' => 'Home Loan Eligibility Calculator',
            'meta'  => 'Free home loan eligibility calculator — estimate how much home loan you can get from your income, existing EMIs, rate and tenure. Then get the lowest rate with LoanPt.',
            'intro' => 'Wondering how big a home loan you can get? Enter your monthly income, any existing EMIs, the rate and tenure to see an indicative eligible amount — then let LoanPt find you the lowest rate across every bank. Free, with no impact on your credit score.',
            'cta' => 'Get this loan',
            'inputs' => array(
                array('income', 'Monthly income', 20000, 2000000, 80000, 5000, 'money'),
                array('emi', 'Existing monthly EMIs', 0, 1000000, 0, 1000, 'money'),
                array('rate', 'Interest rate (p.a.)', 7.5, 12, 8.5, 0.1, 'pct'),
                array('tenure', 'Tenure', 12, 360, 240, 12, 'months'),
            ),
            'faq' => array(
                'How much home loan am I eligible for?' => 'It depends mainly on your income and existing EMIs (lenders cap EMIs at a share of income), plus the property value — lenders fund up to 75-90% of it. This calculator estimates the income-based amount; share details for a precise figure.',
                'What raises my home loan eligibility?' => 'Higher income, fewer existing EMIs, a longer tenure (up to 30 years), adding a co-applicant, and a better credit score all increase it. We help you structure the strongest application.',
                'Is this the final sanctioned amount?' => 'No — it is an indicative estimate. The lender decides the final amount after assessing your income, the property and your credit profile. We find you the lender who offers the most at the lowest rate.',
            ),
        ),
        'business-loan-eligibility-calculator' => array(
            'type' => 'eligibility', 'product' => 'Business Loan', 'short' => 'Business Eligibility', 'cfg' => array('foir' => 0.5),
            'title' => 'Business Loan Eligibility Calculator — How Much Can You Get?',
            'h1'    => 'Business Loan <em>Eligibility Calculator</em>',
            'heading' => 'Business Loan Eligibility Calculator',
            'meta'  => 'Free business loan eligibility calculator — estimate how much business loan you can get from your income and existing EMIs. Then get the best offer with LoanPt.',
            'intro' => 'See how much business loan you may qualify for. Enter your monthly business income, existing EMIs, rate and tenure for an indicative amount — then let LoanPt match you to the right lender at a competitive rate. Free.',
            'cta' => 'Get this loan',
            'inputs' => array(
                array('income', 'Monthly business income', 30000, 2000000, 150000, 10000, 'money'),
                array('emi', 'Existing monthly EMIs', 0, 1000000, 0, 5000, 'money'),
                array('rate', 'Interest rate (p.a.)', 11, 26, 16, 0.25, 'pct'),
                array('tenure', 'Tenure', 6, 60, 36, 6, 'months'),
            ),
            'faq' => array(
                'How is business loan eligibility decided?' => 'Lenders look at your business income and stability, bank-statement inflows, ITR, existing obligations and credit profile. This calculator gives an income-based estimate; the lender decides the final amount.',
                'What documents improve my chances?' => 'Clean bank statements, up-to-date ITR, GST filings and business proof all help. We match you to lenders comfortable with your profile and tell you the exact list.',
                'Can a new business get a loan?' => 'Lenders usually want a running business with some vintage (often 1-3 years) and reasonable financials. We find who is most likely to approve your profile, free.',
            ),
        ),
        'sip-calculator' => array(
            'type' => 'sip', 'product' => 'Personal Loan', 'short' => 'SIP',
            'title' => 'SIP Calculator — Estimate Your Mutual Fund Returns',
            'h1'    => 'SIP <em>Calculator</em>',
            'heading' => 'SIP Calculator',
            'meta'  => 'Free SIP calculator — estimate the maturity value of your monthly mutual fund SIP by amount, expected return and duration. Plan your money with LoanPt.',
            'intro' => 'Planning a monthly SIP? See the estimated maturity value of your investment — enter your monthly amount, expected annual return and how many years you will invest. A simple way to plan your wealth.',
            'lead_head' => 'Need funds for a goal? Get a loan at the best rate',
            'cta' => 'Explore a loan',
            'disc' => 'This is an indicative projection using a constant assumed return. Mutual fund returns are market-linked and not guaranteed — actual returns will vary. LoanPt is a loan facilitator, not an investment advisor.',
            'inputs' => array(
                array('monthly', 'Monthly investment', 500, 200000, 10000, 500, 'money'),
                array('rate', 'Expected return (p.a.)', 1, 30, 12, 0.5, 'pct'),
                array('years', 'Investment period', 1, 40, 10, 1, 'years'),
            ),
            'faq' => array(
                'What is a SIP?' => 'A Systematic Investment Plan (SIP) is investing a fixed amount in a mutual fund every month. Over time, compounding and rupee-cost averaging can build real wealth. This calculator projects the maturity value.',
                'Are SIP returns guaranteed?' => 'No — mutual funds are market-linked, so returns vary and are not guaranteed. The calculator uses an assumed return to give an estimate, not a promise.',
                'What return should I assume?' => 'Equity mutual funds have historically delivered around 10-14% p.a. over the long term, though past performance does not guarantee future returns. Use a conservative figure to plan.',
            ),
        ),
        'fd-calculator' => array(
            'type' => 'fd', 'product' => 'Personal Loan', 'short' => 'FD',
            'title' => 'FD Calculator — Fixed Deposit Maturity & Interest',
            'h1'    => 'FD <em>Calculator</em>',
            'heading' => 'Fixed Deposit (FD) Calculator',
            'meta'  => 'Free fixed deposit (FD) calculator — see your FD maturity value and interest earned by principal, rate and tenure (quarterly compounding). Plan your savings with LoanPt.',
            'intro' => 'See what your fixed deposit grows to. Enter your deposit amount, interest rate and tenure to get the maturity value and total interest earned, with quarterly compounding. A quick way to plan your savings.',
            'lead_head' => 'Need funds now? Get a loan at the best rate',
            'cta' => 'Explore a loan',
            'disc' => 'This is an indicative estimate using quarterly compounding. Actual FD returns depend on the bank and are subject to TDS. LoanPt is a loan facilitator, not a deposit-taking institution.',
            'inputs' => array(
                array('amount', 'Deposit amount', 1000, 10000000, 100000, 1000, 'money'),
                array('rate', 'Interest rate (p.a.)', 1, 12, 7, 0.1, 'pct'),
                array('years', 'Tenure', 1, 20, 5, 1, 'years'),
            ),
            'faq' => array(
                'How is FD maturity calculated?' => 'Most banks compound FD interest quarterly. The maturity value is the principal grown at the quarterly rate over the tenure — this calculator does it for you.',
                'Is FD interest taxable?' => 'Yes — FD interest is taxable as per your income slab, and banks deduct TDS above a threshold. The calculator shows the gross interest before tax.',
                'FD or a loan — which suits me?' => 'An FD grows your savings; a loan funds a need now. If you need funds, breaking an FD may cost you — a loan at a good rate can be smarter. We help you compare, free.',
            ),
        ),
        'gst-calculator' => array(
            'type' => 'gst', 'product' => 'Business Loan', 'short' => 'GST',
            'title' => 'GST Calculator — Add & Work Out GST Instantly',
            'h1'    => 'GST <em>Calculator</em>',
            'heading' => 'GST Calculator',
            'meta'  => 'Free GST calculator — add GST to an amount and see the GST value and total. Quick for invoices and pricing. For business funding, LoanPt finds your best loan.',
            'intro' => 'Quickly work out GST on any amount. Enter the base amount and the GST rate to see the GST value and the total including GST — handy for invoices and pricing. Running a business? LoanPt can fund your growth too.',
            'lead_head' => 'Growing your business? Get funding at the best rate',
            'cta' => 'Explore business funding',
            'disc' => 'This adds GST to the amount you enter. GST slabs in India are 0%, 5%, 12%, 18% and 28%. LoanPt is a loan facilitator, not a tax advisor.',
            'inputs' => array(
                array('amount', 'Amount (before GST)', 100, 10000000, 10000, 100, 'money'),
                array('gst', 'GST rate', 0, 28, 18, 1, 'pct'),
            ),
            'faq' => array(
                'How do I calculate GST on an amount?' => 'GST = amount x rate / 100, and the total is the amount plus the GST. For example, 18% GST on 10,000 is 1,800, for a total of 11,800. This calculator does it instantly.',
                'What are the GST slabs in India?' => 'The main GST rates are 0%, 5%, 12%, 18% and 28%, depending on the goods or service. Pick the rate that applies to yours.',
                'Can LoanPt help fund my business?' => 'Yes — we arrange business loans, working capital and loan against property for business owners from leading banks and NBFCs at competitive rates. It is free to you.',
            ),
        ),
    );
}

/** Auto-create the calculator pages + hub (idempotent, version-guarded). */
add_action('init', function () {
    if (get_option('loanpt_calc_ver') === LOANPT_CALC_VER) return;
    foreach (loanpt_calc_defs() as $slug => $d) {
        $existing = get_page_by_path($slug);
        if (!$existing) {
            wp_insert_post(array(
                'post_title'    => $d['product'] . ' EMI Calculator',
                'post_name'     => $slug,
                'post_status'   => 'publish',
                'post_type'     => 'page',
                'post_content'  => 'LoanPt ' . $d['product'] . ' EMI Calculator.',
                'page_template'  => 'tpl-calc.php',
                'meta_input'    => array('_wp_page_template' => 'tpl-calc.php'),
            ));
        } else {
            update_post_meta($existing->ID, '_wp_page_template', 'tpl-calc.php');
        }
    }
    foreach (loanpt_tool_defs() as $slug => $d) {
        $existing = get_page_by_path($slug);
        if (!$existing) {
            wp_insert_post(array(
                'post_title'    => $d['heading'],
                'post_name'     => $slug,
                'post_status'   => 'publish',
                'post_type'     => 'page',
                'post_content'  => 'LoanPt ' . $d['heading'] . '.',
                'page_template'  => 'tpl-tool.php',
                'meta_input'    => array('_wp_page_template' => 'tpl-tool.php'),
            ));
        } else {
            update_post_meta($existing->ID, '_wp_page_template', 'tpl-tool.php');
        }
    }
    $hub = get_page_by_path('calculators');
    if (!$hub) {
        wp_insert_post(array(
            'post_title'    => 'Loan Calculators',
            'post_name'     => 'calculators',
            'post_status'   => 'publish',
            'post_type'     => 'page',
            'post_content'  => 'LoanPt loan calculators.',
            'page_template'  => 'tpl-calc-hub.php',
            'meta_input'    => array('_wp_page_template' => 'tpl-calc-hub.php'),
        ));
    } else {
        update_post_meta($hub->ID, '_wp_page_template', 'tpl-calc-hub.php');
    }
    update_option('loanpt_calc_ver', LOANPT_CALC_VER);
}, 23);

/** Per-page SEO for calculators: meta description + FAQ schema. */
add_action('wp_head', function () {
    if (!is_page()) return;
    $slug = get_post_field('post_name', get_queried_object_id());
    if ($slug === 'calculators') {
        $h = loanpt_calc_hub_meta();
        echo '<meta name="description" content="' . esc_attr($h['meta']) . '">' . "\n";
        return;
    }
    $calc = array_merge(loanpt_calc_defs(), loanpt_tool_defs());
    if (isset($calc[$slug])) {
        $d = $calc[$slug];
        echo '<meta name="description" content="' . esc_attr($d['meta']) . '">' . "\n";
        $items = array();
        foreach ($d['faq'] as $q => $a) {
            $items[] = array('@type' => 'Question', 'name' => $q, 'acceptedAnswer' => array('@type' => 'Answer', 'text' => $a));
        }
        echo '<script type="application/ld+json">' . wp_json_encode(array('@context' => 'https://schema.org', '@type' => 'FAQPage', 'mainEntity' => $items)) . '</script>' . "\n";
    }
}, 6);

/** Unique <title> for calculator pages + hub. */
add_filter('document_title_parts', function ($parts) {
    if (!is_page()) return $parts;
    $slug = get_post_field('post_name', get_queried_object_id());
    if ($slug === 'calculators') {
        $h = loanpt_calc_hub_meta();
        $parts['title'] = $h['title'];
        unset($parts['tagline']);
        return $parts;
    }
    $calc = array_merge(loanpt_calc_defs(), loanpt_tool_defs());
    if (isset($calc[$slug])) {
        $parts['title'] = $calc[$slug]['title'];
        unset($parts['tagline']);
    }
    return $parts;
});
