<!DOCTYPE html>
<html lang="ja">

<head>
  <?php get_template_part('inc/tag/tag-head'); ?>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="format-detection" content="telephone=no">
  <?php wp_head(); ?>
  <?php get_template_part('inc/tdk'); ?>

  <link rel="apple-touch-icon" sizes="192x192" href="<?php echo get_template_directory_uri(); ?>/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="<?php echo get_template_directory_uri(); ?>/favicon-32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="<?php echo get_template_directory_uri(); ?>/favicon-16.png">
  <link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/favicon.ico">

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Lato&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/fonts/icon/style.css">
  <?php $url = $_SERVER['REQUEST_URI']; ?>

  <?php if(strpos($url, "form-contact.php") !== false):?>
  <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/css/contact-confirm.css">

  <?php elseif(is_front_page() && is_home()):?>
  <link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.css">
  <link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick-theme.css">
  <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/css/top.css">

  <?php elseif(is_404()):?>
  <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/css/404.css">

  <?php elseif(get_post_type() == 'post' || get_query_var('post_type') == 'post' || $post_type == 'post'):?>
    <?php if(is_single()):?>
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/libs/fancybox/jquery.fancybox.min.css">
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/css/news-single.css">
    <?php elseif(is_post_type_archive()):?>
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/css/news.css">
    <?php else:?>
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/css/news-category.css">
    <?php endif; ?>

  <?php elseif(get_post_type() == 'column' || get_query_var('post_type') == 'column' || $post_type == 'column'):?>
    <?php if(is_single()):?>
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/libs/fancybox/jquery.fancybox.min.css">
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/css/column-single.css">
    <?php elseif(is_post_type_archive()):?>
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/css/column.css">
    <?php else:?>
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/css/column-category.css">
    <?php endif; ?>

  <?php else: ?>
  <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/css/404.css">

  <?php endif; ?>
  
  <script src="https://cdn.onesignal.com/sdks/web/v16/OneSignalSDK.page.js" defer></script>
  <script>
    window.OneSignalDeferred = window.OneSignalDeferred || [];
    OneSignalDeferred.push(function(OneSignal) {
      OneSignal.init({
        appId: "3fa94e02-8170-4648-a38d-2dd98d39993f",
        safari_web_id: "web.onesignal.auto.4d0b3421-6847-4c4b-a531-b4bcf634e4d8",
        notifyButton: {
          enable: true,
        },
      });
    });
  </script>

</head>

<body>
  <?php get_template_part('inc/tag/tag-body'); ?>