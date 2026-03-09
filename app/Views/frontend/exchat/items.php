<?php echo view('frontend/'.$cc['frontend_theme'].'/common/page_start'); ?>
  <head>
  <?php echo view('frontend/'.$cc['frontend_theme'].'/common/head');?>
   </head>
  <body id="body"><?php echo view('frontend/'.$cc['frontend_theme'].'/common/body_start');?>
  <?php echo view('frontend/'.$cc['frontend_theme'].'/common/header');?>
  <?php echo view('frontend/'.$cc['frontend_theme'].'/common/hero_slide');?>


   <!-- Theme Breadcrumb Start
================================================== -->

  <section class="container-fluid t-breadcrumb">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="content">
					<h1 class="page-name"><?php echo $content['title'];?></h1>
                  <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo $cc['base_url'];?>">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page"><?php echo $content['name'];?></li>
          </ol>
        </nav>
				</div>
			</div>
		</div>
	</div>
</section>

<!-- Theme Breadcrumb End
================================================== -->

  <!-- Theme Content Start
================================================== -->

<section class="container-fluid t-content t-items_list">

<div class="container">
  <?php if($pagination){ ?>
		<div class="row items">
      <?php  foreach ($pagination['result'] as $row)
                    { ?>
      <div class="item-zone">
			<div class="product-item" data-rating="<?php echo $row['ratings']; ?>" id="<?php echo 'item_'.$row['item_id'].'_zone';?>">
                <div class="product-thumb">
                    <?php echo ($row['price'] < $row['price_previous'] && $cc['badge_sale'] == 'TRUE')?'<span class="bage sale">Sale</span>':''; ?>                       
                    <?php echo ($row['newbie'] && $cc['badge_newbie'] == 'TRUE')?'<span class="bage newbie">New</span>':''; ?>                 
                    <?php echo ($row['featured'] && $cc['badge_featured'] == 'TRUE')?'<span class="bage featured">Featured</span>':''; ?>
                    <img class="img-responsive" data-src="<?php echo $cc['img_url'].display_image_fnc('webp-'.$cc['medium_image_width'].'x'.$cc['medium_image_height'], $row['upload_file']); ?>" alt="<?php echo $row['name']; ?>" />
                    <?php if($cc['ratings'] == 'TRUE'){ ?>
                    <div class="preview-meta">
                        <div class="star-rating">
                            <i class="fa-regular fa-star"></i>
                            <i class="fa-regular fa-star"></i>
                            <i class="fa-regular fa-star"></i>
                            <i class="fa-regular fa-star"></i>
                            <i class="fa-regular fa-star"></i>
                        </div>
                        <?php } ?>
                        <ul>
                            <li>
                                <a href="javascript:void(0);" onclick="product_quick_view_fnc(<?php echo $row['item_id']; ?>, '<?php echo data2js_fnc($row['title']); ?>', '<?php echo $row['model']; ?>', '<?php echo data2js_fnc($row['spotlight']); ?>', '<?php echo $cc['img_url'].display_image_fnc('webp-'.$cc['large_image_width'].'x'.$cc['large_image_height'], $row['upload_file']); ?>', '<?php echo $cc['base_url'].slug2url_fnc('items_details', $row['item_id'], $row['slug'], $row['meta_title']); ?>', token);" data-bs-toggle="tooltip" data-placement="top" title="Quick View">
                                    <i class="fa-solid fa-magnifying-glass"></i>
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo $cc['base_url'].slug2url_fnc('items_details', $row['item_id'], $row['slug'], $row['meta_title']); ?>" data-bs-toggle="tooltip" data-placement="top" title="More Info">
                                    <i class="fa-solid fa-info"></i>
                                </a>
                            </li>
                            <li>
                                <a href="javascript:void(0);" onclick="javascript:add2cart_fnc('<?php echo $row['item_id'] ?>', token, event);" data-bs-toggle="tooltip" data-placement="top" title="Get Free Quote">
                                    <i class="fa-solid fa-basket-shopping"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="product-content">
                    <h4><a href="<?php echo $cc['base_url'].slug2url_fnc('items_details', $row['item_id'], $row['slug'], $row['meta_title']); ?>"><?php echo $row['name']; ?></a></h4>
                    <p>Model: <?php echo $row['model']; ?></p>
                </div>
            </div>
                    </div>
      <?php } ?>
		</div>
    <?php if($content['paging'] == true){ ?>
    <div class="row">
          <div class="col-8 pt-3">
          <?php echo $pagination['pager']; ?>
           </div>
           <div class="col-4 pt-3 text-end">
           <?php echo $pagination['start'].' - '.$pagination['end'].' Of '.$pagination['total_records'].' Records, Total Pages: '.$pagination['total_pages']; ?>
           </div>
          </div>
          <?php } ?>
<?php }else{
            echo '<div class="text-bg-danger p-3">The requested record was not found</div>';
          } ?>
</div>

</section>
<!-- Theme Content End
================================================== -->
  <?php echo view('frontend/'.$cc['frontend_theme'].'/common/footer');?>
<?php echo view('frontend/'.$cc['frontend_theme'].'/common/body_end');?>
</body>
<?php echo view('frontend/'.$cc['frontend_theme'].'/common/page_end');?>
<script >

</script>


