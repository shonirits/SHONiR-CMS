<?php echo view('backend/'.$cc['backend_theme'].'/common/page_start'); ?>
  <head>
  <?php echo view('backend/'.$cc['backend_theme'].'/common/head');?>
  </head>
  <body><?php echo view('backend/'.$cc['backend_theme'].'/common/body_start');?>
  <?php echo view('backend/'.$cc['backend_theme'].'/common/header');?>
  <div class="container">
          <div class="row align-items-start">
          <div class="row">
          <div class="col-8 p-3">
           <h1>Natives<h1>
           </div>
           <div class="col-4 p-3 text-end">
           <a href="<?php echo $cc['base_url'].'Natives/add'; ?>" class="btn btn-success">Add</a> <button type="button" id="filters" name="filters" class="btn btn-info">Filters</button>
           </div>
           </div>
           <div class="<?php echo ($query)?'show':'hide'?>" id="filters_zone">
           <div class="row">
           <div class="col-6 p-3">
           <form name="filter_frm" id="filter_frm" action="<?php echo $cc['base_url'].'Natives/list?query='.$query.'&order='.$order.'&sort='.$sort.'&limit='.$limit; ?>" method="GET" role="form">
           <div class="input-group mb-3">
            <input type="text" class="form-control" name="query" id="query" placeholder="Type keyword..." value="<?php echo $query; ?>" aria-label="Type keyword..." aria-describedby="search">
            <button class="btn btn-secondary" type="submit" id="search"><i class="fa-solid fa-magnifying-glass"></i></button>
          </div>
          </form> 
           </div>
           <div class="col-2 p-3">
           <select class="form-select" aria-label="order" name="order" id="order">
            <option value="">Order By</option>
            <?php foreach($order_list as $key => $value){?>
            <option value="<?php echo $key; ?>" <?php echo ($order == $key)?'selected':''; ?>><?php echo $value; ?></option>
            <?php }?>
           </select>
           </div>
           <div class="col-2 p-3">
           <select class="form-select" aria-label="sort" name="sort" id="sort">
           <option value="">Sorting By</option>
           <?php foreach($sort_list as $key => $value){?>
            <option value="<?php echo $key; ?>" <?php echo ($sort == $key)?'selected':''; ?>><?php echo $value; ?></option>
            <?php }?>
           </select>
           </div>
           <div class="col-2 p-3">
           <select class="form-select" aria-label="limit" name="limit" id="limit">
            <option value="">Show Records</option>
            <?php foreach($limit_list as $key => $value){?>
            <option value="<?php echo $key; ?>" <?php echo ($limit == $key)?'selected':''; ?>><?php echo $value; ?></option>
            <?php }?>
           </select>
           </div>
           </div>      
           </div>     
           <?php if($pagination){ ?>
           <div class="row">

           <table class="table table-striped table-bordered  table-hover">

           <thead>
              <tr>
                <th scope="col" class="text-center align-middle">ID</th>
                <th scope="col" class="align-middle">Title<br><small>Name</small><br><small class="text-body-secondary">Today Views-Today Hits-Lifetime View-Lifetime Hits-Votes-Rating-Scores-Likes</small></th>
                <th scope="col" class="text-center align-middle">Items</th>
                <th scope="col" class="text-center align-middle">Status</th>
                <th scope="col" class="text-center align-middle">Featured</th>
                <th scope="col" class="text-center align-middle">Searchable</th>
                <th scope="col" class="text-center align-middle">Listed</th>
                <th scope="col" class="text-center align-middle">Published</th>
                <th scope="col" class="text-center align-middle">Action</th>
              </tr>
          </thead>
          <tbody class="table-group-divider">
          <?php  foreach ($pagination['result'] as $row)
                    { ?>
            <tr>
              <th scope="row" class="text-center align-middle"><?php echo $row['native_id']; ?></th>
              <td class="align-middle"><?php echo $row['title'].'<br><small>'.$row['name'].'</small><br><small class="text-body-secondary">'.$row['today_views'].'-'.$row['today_hits'].'-'.$row['lifetime_views'].'-'.$row['lifetime_hits'].'-'.$row['votes'].'-'.$row['ratings'].'-'.$row['scores'].'-'.$row['likes'].'</small>'; ?></td>
               <td class="text-center align-middle"><?php echo $row['items']; ?></td>
              <td class="text-center align-middle"><?php echo ($row['status'] == 1)?'<i class="fa-solid fa-check text-success"></i>':'<i class="fa-solid fa-xmark text-danger"></i>'; ?></td>
              <td class="text-center align-middle"><?php echo ($row['featured'] == 1)?'<i class="fa-solid fa-check text-success"></i>':'<i class="fa-solid fa-xmark text-danger"></i>'; ?></td>
              <td class="text-center align-middle"><?php echo ($row['searchable'] == 1)?'<i class="fa-solid fa-check text-success"></i>':'<i class="fa-solid fa-xmark text-danger"></i>'; ?></td>
              <td class="text-center align-middle"><?php echo ($row['listed'] == 1)?'<i class="fa-solid fa-check text-success"></i>':'<i class="fa-solid fa-xmark text-danger"></i>'; ?></td>
              <td class="text-center align-middle"><?php echo date('Y-m-d H:i:s', $row['published_time']); ?></td>
              <td class="text-center align-middle"><a href="<?php echo $cc['base_url'].'Natives/edit?id='.$row['native_id']; ?>" data-bs-toggle="tooltip" data-bs-original-title="Edit" title="Edit" ><i class="fa-solid fa-pen-to-square"></i></a> <a href="javascript:confirm_fnc('Cancel', '', '', 'Delete', '<?php echo $cc['base_url'].'Natives/delete?id='.$row['native_id']; ?>', '', 'Delete Record ID# <?php echo $row['native_id']; ?>', 'Are you sure you want to delete record id# <b><?php echo $row['native_id']; ?></b>, title: <b><?php echo html2text_fnc($row['title']); ?></b>?');" data-bs-toggle="tooltip" data-bs-original-title="Delete" title="Delete" ><i class="fa-solid fa-trash-can"></i></a></td>
            </tr>
            <?php } ?>
          </tbody>
          </table>

          </div>
          
          <div class="row">
          <div class="col-8 p-3">
          <?php echo $pagination['pager']; ?>
           </div>
           <div class="col-4 p-3 text-end">
           <?php echo $pagination['start'].' - '.$pagination['end'].' Of '.$pagination['total_records'].' Records, Total Pages: '.$pagination['total_pages']; ?>
           </div>
          </div>
          <?php }else{
            echo '<div class="text-bg-danger p-3">The requested record was not found</div>';
          } ?>

          </div>
          </div>
  <?php echo view('backend/'.$cc['backend_theme'].'/common/footer');?>
  <script>
  var order = '<?php echo $order; ?>';
  var sort = '<?php echo $sort; ?>';
  var limit = '<?php echo $limit; ?>';
  var query = '<?php echo $query; ?>';
  var url = base_url+'Natives/list';
</script>
<?php echo view('backend/'.$cc['backend_theme'].'/common/body_end');?>
</body>
<?php echo view('backend/'.$cc['backend_theme'].'/common/page_end');?>