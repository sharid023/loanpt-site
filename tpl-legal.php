<?php
/* Template Name: LoanPt Legal */
if (!defined('ABSPATH')) exit;
get_header();
$slug = get_post_field('post_name', get_queried_object_id());
$pages = loanpt_tool_pages();
$d = isset($pages[$slug]) ? $pages[$slug] : null;
?>
<section class="hero" style="padding:0"><div class="wrap" style="display:block;padding:44px 18px 32px">
  <span class="eyebrow">LoanPt — Credit in Pocket</span>
  <h1 style="margin:14px 0 8px"><?php echo esc_html($d['h1'] ?? get_the_title()); ?></h1>
  <?php if (!empty($d['intro'])): ?><p class="lead" style="max-width:62ch"><?php echo esc_html($d['intro']); ?></p><?php endif; ?>
  <?php if (!empty($d['updated'])): ?><p style="color:#bfe6d4;font-size:13px;margin-top:12px">Last updated: <?php echo esc_html($d['updated']); ?></p><?php endif; ?>
</div></section>
<section><div class="wrap" style="max-width:820px">
  <div class="post-body"><?php echo $d && !empty($d['body']) ? $d['body'] : apply_filters('the_content', get_post_field('post_content', get_queried_object_id())); ?></div>
  <div class="ctaband" style="margin-top:38px">
    <h2>Questions about your data or our service?</h2>
    <p>We're happy to help — reach our team anytime.</p>
    <a class="btn" href="<?php echo esc_url(home_url('/contact/')); ?>">Contact us &rarr;</a>
  </div>
</div></section>
<?php get_footer(); ?>
