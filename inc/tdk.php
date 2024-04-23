<?php $url = strtok($_SERVER['REQUEST_URI'], '?'); ?>
  <?php
    $title = '';
    $desc = '';
  ?>
<?php if($url == "/html/"): ?>
  <?php
    $title = 'LegulusGreen';
    $desc = 'LegulusGreen';
  ?>
<?php endif; ?>

<?php
  if($title) {
    $title = $title;
  } else {
    $title ='LegulusGreen';
  }
  if($desc) {
    $desc = $desc;
  } else {
    $desc ='LegulusGreen';
  }
  $key ='';
  $site_name = "LegulusGreen";
  $ogimage = '';
?>

<title><?php echo $title;?></title>
<meta name="description" content="<?php echo $desc;?>" />
<meta name="keyword" content="<?php echo $key;?>" />
<meta property="og:title" content="<?php echo $title;?>" />
<meta property="og:type" content="website" />
<meta property="og:url" content="<?php echo (empty($_SERVER['HTTPS']) ? 'http://' : 'https://') . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];?>" />
<meta property="og:image" content="<?php echo $ogimage;?>" />
<meta property="og:site_name" content="<?php echo $title;?>" />
<meta property="og:description" content="<?php echo $desc;?>" />