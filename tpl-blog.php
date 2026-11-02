<?php
/* Template Name: LoanPt Blog */
if (!defined('ABSPATH')) exit;
get_header();
$q = new WP_Query(array('post_type' => 'post', 'posts_per_page' => 12, 'post_status' => 'publish'));
?>
<section class="hero" style="padding:0"><div class="wrap" style="display:block;padding:48px 18px 42px">
  <span class="eyebrow">Learn</span>
  <h1 style="margin:16px 0 10px">LoanPt Blog</h1>
  <p class="lead" style="max-width:60ch">Simple, honest guides on loans, credit score, EMIs and getting the best rate — written for borrowers, not bankers.</p>
</div></section>

<section><div class="wrap">
  <?php if ($q->have_posts()): ?>
  <div class="prods" style="grid-template-columns:repeat(3,1fr)">
    <?php while ($q->have_posts()): $q->the_post(); ?>
      <a class="prod" style="text-decoration:none;display:flex;flex-direction:column" href="<?php the_permalink(); ?>">
        <?php if (has_post_thumbnail()): ?>
          <div style="border-radius:12px;overflow:hidden;margin:-6px -6px 14px"><?php the_post_thumbnail('medium_large', array('style' => 'width:100%;height:172px;object-fit:cover;display:block')); ?></div>
        <?php else: ?>
          <div class="ic">&#128218;</div>
        <?php endif; ?>
        <div class="kicker" style="font-size:12px"><?php echo esc_html(get_the_date()); ?></div>
        <h3 style="margin:8px 0 8px;font-size:19px;color:var(--green2)"><?php the_title(); ?></h3>
        <p style="flex:1;color:var(--muted);font-size:14.5px"><?php echo esc_html(wp_trim_words(get_the_excerpt(), 22)); ?></p>
        <span class="go">Read more &rarr;</span>
      </a>
    <?php endwhile; ?>
  </div>
  <?php else: ?>
    <div class="sec-head"><h2>Articles coming soon</h2><p>We're writing helpful loan &amp; credit guides. Check back shortly.</p></div>
  <?php endif; wp_reset_postdata(); ?>
</div></section>

<section style="padding-top:0"><div class="wrap"><div class="ctaband">
  <h2>Ready to find your best loan?</h2><p>Check your eligibility free — it takes less than a minute.</p>
  <a class="btn" href="<?php echo esc_url(home_url('/#apply')); ?>">Get my best offer &rarr;</a>
</div></div></section>
<?php get_footer(); ?>
