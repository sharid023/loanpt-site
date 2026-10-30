<?php if (!defined('ABSPATH')) exit; get_header(); ?>
<section>
  <div class="wrap" style="max-width:800px">
    <?php if (have_posts()): while (have_posts()): the_post(); ?>
      <article style="background:#fff;border:1px solid var(--line);border-radius:16px;padding:28px;margin-bottom:20px">
        <h1 style="font-size:30px;margin-bottom:6px"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
        <div style="color:var(--muted);font-size:13px;margin-bottom:14px"><?php echo esc_html(get_the_date()); ?></div>
        <div style="line-height:1.75"><?php the_content(); ?></div>
      </article>
    <?php endwhile; the_posts_pagination(); else: ?>
      <div class="sec-head"><h2>Nothing here yet</h2><p>Add pages &amp; posts from wp-admin to grow your SEO content.</p></div>
    <?php endif; ?>
  </div>
</section>
<?php get_footer(); ?>
