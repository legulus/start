<?php get_header(); ?>
<?php get_template_part('/inc/header'); ?>
<main id="page-top" class="page-notfound l-main bg-blue">
  <!-- hero -->
  <section id="hero" class="hero -blue">
    <div class="hero__body">
      <p class="hero__en">404</p>
      <h1 class="hero__heading">PAGE NOT FOUND</h1>
    </div>
  </section>
  <!-- hero end -->
  <div class="breadcrumb">
    <div class="l-inner">
      <ul class="breadcrumb__list">
        <li class="breadcrumb__item"><a class="breadcrumb__anc" href="<?php echo home_url(); ?>/">TOP</a></li>
        <li class="breadcrumb__item">404</li>
      </ul>
    </div>
  </div>
  <!-- 404 -->
  <section class="notfound">
    <div class="l-inner">
      <p class="notfound__lead">大変申し訳ございませんが、<br class="visible-sm">お探しのページが見つかりませんでした。<br>指定されたページは削除されたか、<br class="visible-sm">移動した可能性があります。</p>
      <div class="notfound__btnarea">
        <a href="<?php echo home_url(); ?>/" class="btn -black -arrow">トップページ</a>
      </div>
    </div>
  </section>
</main>
<?php get_template_part('/inc/cv'); ?>
<?php get_template_part('/inc/footer'); ?>
<?php get_footer(); ?>