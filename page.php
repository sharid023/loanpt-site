<?php if (!defined('ABSPATH')) exit; get_header(); ?>
<section>
  <div class="wrap" style="max-width:860px">
    <?php while (have_posts()): the_post(); ?>
      <article style="background:#fff;border:1px solid var(--line);border-radius:16px;padding:30px">
        <h1 style="font-size:34px;margin-bottom:16px"><?php the_title(); ?></h1>
        <div style="line-height:1.75"><?php the_content(); ?></div>
      </article>
    <?php endwhile; ?>
    <div class="ctaband" style="margin-top:24px">
      <h2>Get your best loan offer</h2>
      <p>Free eligibility check — our team calls you back.</p>
      <a class="btn" href="<?php echo esc_url(home_url('/#apply')); ?>">Apply now &rarr;</a>
    </div>
  </div>
</section>
<?php get_footer(); ?>
