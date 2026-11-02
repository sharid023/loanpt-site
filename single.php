<?php if (!defined('ABSPATH')) exit; get_header(); ?>
<section><div class="wrap" style="max-width:780px">
  <?php while (have_posts()): the_post(); ?>
    <a href="<?php echo esc_url(home_url('/blog/')); ?>" style="color:var(--mint2);font-weight:700;font-size:14px">&larr; All articles</a>
    <article>
      <div class="kicker" style="margin-top:18px"><?php echo esc_html(get_the_date()); ?> &middot; <?php echo esc_html(max(1, ceil(str_word_count(wp_strip_all_tags(get_the_content())) / 200))); ?> min read</div>
      <h1 style="font-size:40px;margin:10px 0 20px;line-height:1.12"><?php the_title(); ?></h1>
      <?php if (has_post_thumbnail()): ?>
        <div style="border-radius:16px;overflow:hidden;margin-bottom:26px;border:1px solid var(--line)"><?php the_post_thumbnail('large', array('style' => 'width:100%;display:block;height:auto')); ?></div>
      <?php endif; ?>
      <div class="post-body"><?php the_content(); ?></div>
    </article>
    <div class="ctaband" style="margin-top:36px">
      <h2>Need a loan?</h2><p>Compare offers from every bank &amp; check your eligibility free.</p>
      <a class="btn" href="<?php echo esc_url(home_url('/#apply')); ?>">Get my best offer &rarr;</a>
    </div>
  <?php endwhile; ?>
</div></section>
<?php get_footer(); ?>
