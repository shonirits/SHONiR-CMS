<?php
//print_r($Categories_Tree);
?><!doctype html>
<html lang="en">
  <head>
<?php require_once('common/head.php');?>
<title><?php echo $SHONiR_Main['meta_title'] ?></title>
<meta name="description" content="<?php echo $SHONiR_Main['meta_description'] ?>">
<meta name="keywords" content="<?php echo $SHONiR_Main['meta_keyword'] ?>" />
</head>
<body><?php require_once('common/start.php');?>
<?php include('includes/header.php');?>
<?php include('includes/banners.php');?>

<!-- content starts here -->
<div class="container t-homepage">
<div class="row heading">
<div class="col-md-12 col-12">
<h1><?php echo $SHONiR_Main['name'] ?></h1>
<hr>
</div>
  </div>
<div class="row details">
  <div class="col-md-12">
    <p><?php echo $SHONiR_Main['description'] ?></p>
  </div>
</div>
    <div class="row grid">
    <?php if(isset($homepage_one) && is_array($homepage_one)){ ?>
        <div class="col-md-6 no-padd no-marg shine item"><?php echo ($homepage_one[0]['link'])?'<a target="_blank" href="'.SHONiR_BASE.'Go/Br/'.$homepage_one[0]['banner_id'].'">':''; ?><figure><img class="img-fluid" src="<?php echo SHONiR_CDN_IMG.'media/uploads/'.$homepage_one[0]['image'] ?>"  alt="<?php echo $homepage_one[0]['name'] ?>"></figure><?php echo ($homepage_one[0]['link'])?'</a>':''; ?></div>
        <?php }?>
        <?php if(isset($homepage_two) && is_array($homepage_two)){ ?>
        <div class="col-md-6 no-padd no-marg shine item"><?php echo ($homepage_two[0]['link'])?'<a target="_blank" href="'.SHONiR_BASE.'Go/Br/'.$homepage_two[0]['banner_id'].'">':''; ?><figure><img class="img-fluid" src="<?php echo SHONiR_CDN_IMG.'media/uploads/'.$homepage_two[0]['image'] ?>"  alt="<?php echo $homepage_two[0]['name'] ?>"></figure><?php echo ($homepage_two[0]['link'])?'</a>':''; ?></div>
        <?php }?>
    </div><?php if(isset($homepage_three) && is_array($homepage_three)){ ?>
    <div class="row grid">
        <div class="col-md-12 no-padd no-marg shine item">
        <?php echo ($homepage_three[0]['link'])?'<a target="_blank" href="'.SHONiR_BASE.'Go/Br/'.$homepage_three[0]['banner_id'].'">':''; ?><figure><img class="img-fluid" src="<?php echo SHONiR_CDN_IMG.'media/uploads/'.$homepage_three[0]['image'] ?>"  alt="<?php echo $homepage_three[0]['name'] ?>"></figure><?php echo ($homepage_three[0]['link'])?'</a>':''; ?>
    </div>  </div><?php }?>
    <div class="row grid">
    <?php if(isset($homepage_four) && is_array($homepage_four)){ ?>
        <div class="col-md-4 col-12 no-padd no-marg shine item"><?php echo ($homepage_four[0]['link'])?'<a target="_blank" href="'.SHONiR_BASE.'Go/Br/'.$homepage_four[0]['banner_id'].'">':''; ?><figure><img class="img-fluid" src="<?php echo SHONiR_CDN_IMG.'media/uploads/'.$homepage_four[0]['image'] ?>"  alt="<?php echo $homepage_four[0]['name'] ?>"></figure><?php echo ($homepage_four[0]['link'])?'</a>':''; ?></div>
        <?php }?>
        <?php if(isset($homepage_five) && is_array($homepage_five)){ ?>
        <div class="col-md-4 col-12 no-padd no-marg shine item"><?php echo ($homepage_five[0]['link'])?'<a target="_blank" href="'.SHONiR_BASE.'Go/Br/'.$homepage_five[0]['banner_id'].'">':''; ?><figure><img class="img-fluid" src="<?php echo SHONiR_CDN_IMG.'media/uploads/'.$homepage_five[0]['image'] ?>"  alt="<?php echo $homepage_five[0]['name'] ?>"></figure><?php echo ($homepage_five[0]['link'])?'</a>':''; ?></div>
        <?php }?>
        <?php if(isset($homepage_six) && is_array($homepage_six)){ ?>
        <div class="col-md-4 col-12 no-padd no-marg shine item"><?php echo ($homepage_six[0]['link'])?'<a target="_blank" href="'.SHONiR_BASE.'Go/Br/'.$homepage_six[0]['banner_id'].'">':''; ?><figure><img class="img-fluid" src="<?php echo SHONiR_CDN_IMG.'media/uploads/'.$homepage_six[0]['image'] ?>"  alt="<?php echo $homepage_six[0]['name'] ?>"></figure><?php echo ($homepage_six[0]['link'])?'</a>':''; ?></div>
        <?php }?>
    </div>
   
</div>
<!-- content ends here -->

<?php include('includes/footer.php');?>
<?php require_once('common/end.php');?>
</body>
</html><?php
require_once('common/clear.php'); ?>
