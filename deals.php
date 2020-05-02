<?php ob_start();
  $page_title = 'FMTC Coupons';
  require_once('includes/load.php');
?>

<?php
// Checkin What level user has permission to view this page
 page_require_level(2);

 $all_coupons = get_all_active_coupons();

?>

<?php include_once('layouts/header.php'); ?>
<div class="row">
   <div class="col-md-12">
     <?php echo display_msg($msg); ?>
   </div>
</div>

<div class="row">
   <div class="col-md-12">
     <h2 class="text-center">Coupons</h2>
   </div>
</div>

<div class="row">
  <div class="col-md-12">

     <div class="cards-list">
      
     <?php foreach($all_coupons as $a_coupon): ?>
      <div class="card" >
        <div class="card_image"> <img src="" alt=""/> </div>
        <div class="card_title">
          <p><?php echo (ucwords($a_coupon['cLabel']))?></p>
        </div>
        <div class="card_expiry">
          <p><span>Expiry Date: </span><?php echo (read_date($a_coupon['dtEndDate']))?></p>
          <a href="<?php echo ($a_coupon['cAffiliateURL'])?>" target="_Blank">Open</a>
        </div>
      </div>
     <?php endforeach;?>


    </div>


  </div>
</div>
<?php include_once('layouts/footer.php'); ?>
