<?php if (!defined('ABSPATH')) exit; get_header(); ?>
<?php
/* Reusable blog card (guarded so it's only declared once). */
if (!function_exists('loanpt_blog_card')) {
    function loanpt_blog_card() { ?>
      <a class="blogcard" href="<?php the_permalink(); ?>">
        <?php if (has_post_thumbnail()): ?>
          <div class="blogcard-img"><?php the_post_thumbnail('medium_large', array('loading' => 'lazy', 'alt' => the_title_attribute(array('echo' => false)))); ?></div>
        <?php else: ?>
          <div class="blogcard-img blogcard-noimg"><span aria-hidden="true">&#128220;</span></div>
        <?php endif; ?>
        <div class="blogcard-body">
          <div class="blogcard-date"><?php echo esc_html(get_the_date('M j, Y')); ?></div>
          <h3><?php the_title(); ?></h3>
          <p><?php echo esc_html(wp_trim_words(get_the_excerpt(), 20)); ?></p>
          <span class="go">Read more &rarr;</span>
        </div>
      </a>
    <?php }
}
?>

<?php if (is_home() || is_front_page()): ?>

  <section class="hero" style="padding:0"><div class="wrap" style="display:block;padding:46px 18px 34px">
    <span class="eyebrow">Learn</span>
    <h1 style="margin:14px 0 10px">LoanPt Blog</h1>
    <p class="lead" style="max-width:62ch">Simple, honest guides on personal loans, overdraft, balance transfer, credit score &amp; EMIs &mdash; written for borrowers, not bankers.</p>
  </div></section>

  <?php
  // Group posts into one section per category. A post appears once (under its
  // first-rendered category). Categories with no posts are skipped.
  $cats = get_categories(array('orderby' => 'count', 'order' => 'DESC', 'hide_empty' => true));
  $sections = array();
  $shown = array();
  foreach ($cats as $cat) {
      $q = new WP_Query(array(
          'post_type'        => 'post',
          'posts_per_page'   => 12,
          'cat'              => $cat->term_id,
          'post_status'      => 'publish',
          'post__not_in'     => $shown,
          'ignore_sticky_posts' => true,
      ));
      if (!$q->have_posts()) { wp_reset_postdata(); continue; }
      $ids = wp_list_pluck($q->posts, 'ID');
      $shown = array_merge($shown, $ids);
      $sections[] = array('cat' => $cat, 'query' => $q);
  }
  $multi = count($sections) > 1;
  if (!empty($sections)):
      foreach ($sections as $s):
          $cat = $s['cat']; $q = $s['query']; ?>
          <section class="blogsec"><div class="wrap">
            <?php if ($multi): ?>
              <div class="blogsec-head">
                <h2><?php echo esc_html($cat->name); ?></h2>
                <a class="blogsec-all" href="<?php echo esc_url(get_category_link($cat->term_id)); ?>">View all &rarr;</a>
              </div>
            <?php endif; ?>
            <div class="bloggrid">
              <?php while ($q->have_posts()): $q->the_post(); loanpt_blog_card(); endwhile; ?>
            </div>
          </div></section>
          <?php wp_reset_postdata();
      endforeach;
  else: ?>
    <section class="blogsec"><div class="wrap"><div class="sec-head"><h2>Articles coming soon</h2><p>We're writing helpful loan &amp; credit guides. Check back shortly.</p></div></div></section>
  <?php endif; ?>

<?php else: ?>

  <section class="hero" style="padding:0"><div class="wrap" style="display:block;padding:46px 18px 30px">
    <span class="eyebrow">Blog</span>
    <h1 style="margin:14px 0 8px"><?php
      if (is_category()) single_cat_title('');
      elseif (is_tag()) single_tag_title('');
      elseif (is_search()) echo 'Search: ' . esc_html(get_search_query());
      else the_archive_title();
    ?></h1>
    <?php $desc = category_description(); if ($desc) echo '<div class="lead">' . wp_kses_post($desc) . '</div>'; ?>
  </div></section>

  <section class="blogsec"><div class="wrap">
    <?php if (have_posts()): ?>
      <div class="bloggrid">
        <?php while (have_posts()): the_post(); loanpt_blog_card(); endwhile; ?>
      </div>
      <div class="blogpag"><?php the_posts_pagination(array('mid_size' => 1, 'prev_text' => '&larr; Newer', 'next_text' => 'Older &rarr;')); ?></div>
    <?php else: ?>
      <div class="sec-head"><h2>Nothing here yet</h2><p>No articles in this section yet &mdash; check back soon.</p></div>
    <?php endif; ?>
  </div></section>

<?php endif; ?>

<section style="padding-top:0"><div class="wrap"><div class="ctaband">
  <h2>Ready to find your best loan?</h2><p>Check your eligibility free &mdash; it takes less than a minute.</p>
  <a class="btn" href="<?php echo esc_url(home_url('/#apply')); ?>">Get my best offer &rarr;</a>
</div></div></section>
<?php get_footer(); ?>
