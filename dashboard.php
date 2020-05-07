<?php ob_start();
  $page_title = 'All Coupons';
  require_once('includes/load.php');
?>

<?php
// Checkin What level user has permission to view this page
 page_require_level(2);

// $cURLConnection = curl_init();

// curl_setopt($cURLConnection, CURLOPT_URL, 'http://localhost:80/api/coupons/getList.php');
// curl_setopt( $cURLConnection, CURLOPT_CUSTOMREQUEST, 'GET' );
// curl_setopt($cURLConnection, CURLOPT_RETURNTRANSFER, true);
// curl_setopt($cURLConnection, CURLOPT_HTTPHEADER,
//     array(
//         'Content-Type:application/json'
//     )
//   );

// $phoneList = curl_exec($cURLConnection);

// echo $phoneList;
// curl_close($cURLConnection);


 $all_coupons = get_all_coupons();


?>

<?php include_once('layouts/header.php'); ?>
<div class="row">
   <div class="col-md-12">
     <?php echo display_msg($msg); ?>
   </div>
</div>

<div class="row">
  <div class="col-md-12">
    <div class="panel panel-default">
      <div class="panel-heading clearfix">
        <strong>
          <span class="glyphicon glyphicon-th"></span>
          <span>Coupon List</span>
       </strong>
      </div>
     <div class="panel-body">
      <table class="table table-bordered table-striped">
        <thead>
          <tr>
            <th class="text-center" style="width: 1%;">#</th>
            <th class="text-center" style="width: 3%;">Coupon Id</th>
            <th class="text-center" style="width: 6%;">Coupon Name</th>
            <th class="text-center" style="width: 3%;">Merchant</th>
            <th class="text-center" style="width: 2%;">Category</th>
            <th class="text-center" style="width: 3%;">Network</th>
            <th class="text-center" style="width: 1%;">Types</th>
            <th class="text-center" style="width: 3%;">Start Date</th>
            <th class="text-center" style="width: 3%;">End Date</th>
            <th class="text-center" style="width: 3%;">Status</th>
            <th class="text-center" style="width: 3%;">Edit</th>
          </tr>
        </thead>
        <tbody>

        <?php foreach($all_coupons as $a_coupon): ?>
          <tr>
           <td class="text-center"><?php echo count_id();?></td>
           <td class="text-center"><?php echo remove_junk(ucwords($a_coupon['nCouponID']))?></td>
           <td class="text-center"><?php echo (ucwords($a_coupon['cLabel']))?></td>
           <td class="text-center"><?php echo remove_junk(ucwords($a_coupon['cMerchant']))?></td>
           <td class="text-center"><?php echo get_categories($a_coupon['aCategoriesV2'])?></td>
           <td class="text-center"><?php echo remove_junk(ucwords($a_coupon['cNetwork']))?></td>
           <td class="text-center"><?php echo remove_junk(clean_type_field($a_coupon['aTypes']))?></td>
           <td class="text-center"><?php echo (read_date($a_coupon['dtStartDate']))?></td>
           <td class="text-center"><?php echo (read_date($a_coupon['dtEndDate']))?></td>
           <td class="text-center">
           <?php if($a_coupon['cStatus'] === 'active'): ?>
            <span class="label label-success"><?php echo "New"; ?></span>
          <?php else: ?>
            <span class="label label-danger"><?php echo "Old"; ?></span>
          <?php endif;?>
           </td>
           <td class="text-center">
             <div class="btn-group">
                <a href="edit_coupon.php?id=<?php echo (int)$a_coupon['nCouponID'];?>" class="btn btn-xs btn-warning" data-toggle="tooltip" title="Edit">
                 <?php echo "Start Writing"; ?>
               </a>
            </div>
           </td>
          </tr>
        <?php endforeach;?>


       </tbody>
     </table>
     </div>
    </div>
  </div>
</div>
<?php include_once('layouts/footer.php'); ?>
