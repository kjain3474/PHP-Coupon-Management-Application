<?php ob_start();
  $page_title = 'Edit Coupon';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
   page_require_level(2);
?>
<?php
  $e_coupon = find_by_couponid('coupon',(int)$_GET['id']);
  if(!$e_coupon){
    $session->msg("d","Coupon Doesn't Exist");
    redirect('dashboard.php', false);
  }

?>

<?php
  if(isset($_POST['update'])) {
    $req_fields = array('newCouponName','description');
    validate_fields($req_fields);
    if(empty($errors)){
             $nCouponID = (int)$e_coupon['nCouponID'];
             $cLabel = remove_junk($db->escape($_POST['newCouponName']));
             $cDescription = remove_junk($db->escape($_POST['description']));

             $db->begin();
             $sql = "SELECT * from coupon WHERE nCouponID='{$db->escape($nCouponID)}' LIMIT 1 FOR UPDATE";
             $db->query($sql);
             $sql = "UPDATE coupon SET cLabel ='{$cLabel}', cDescription ='{$cDescription}' WHERE nCouponID='{$db->escape($nCouponID)}'";
             $result = $db->query($sql);
          if($result && $db->affected_rows() === 1){
            $db->commit();
            $session->msg('s',"CouponID ".(int)$e_coupon['nCouponID']." Updated ");
            redirect('dashboard.php', false);
          } else {
            $db->commit();
            $session->msg('d',' Sorry Nothing was updated');
            redirect('edit_coupon.php?id='.(int)$e_coupon['nCouponID'], false);
          }
    } else {
      $db->rollback();
      $session->msg("d", $errors);
      redirect('edit_coupon.php?id='.(int)$e_coupon['nCouponID'],false);
    }
  }
  elseif (isset($_POST['exit'])) {
     redirect('dashboard.php', false);
  }
?>


<?php include_once('layouts/header.php'); ?>
 <div class="row">
   <div class="col-md-12"> <?php echo display_msg($msg); ?> </div>
  <div class="col-md-12">
     <div class="panel panel-default">
       <div class="panel-heading">
        <strong>
          <span class="glyphicon glyphicon-th"></span>
          Update Coupon <span class="label label-primary label-large" style="font-size: 15px"><?php echo remove_junk(($e_coupon['nCouponID'])); ?></span>
        </strong>
       </div>
       <div class="panel-body">
          <form method="post" action="edit_coupon.php?id=<?php echo (int)$e_coupon['nCouponID'];?>" class="clearfix">
            <div class="form-group">
                  <label for="CouponID" class="control-label">Coupon ID</label>
                  <input type="text" readonly class="form-control" name="CouponID" value="<?php echo remove_junk($e_coupon['nCouponID']); ?>">
            </div>
            <div class="form-group">
                  <label for="couponName" class="control-label">Original Coupon Name</label>
                  <input type="text" readonly class="form-control" name="couponName" value="<?php echo remove_junk(ucwords($e_coupon['cLabel'])); ?>">
            </div>
            <div class="form-group">
                  <label for="newCouponName" class="control-label">Revised Coupon Name</label>
                  <input type="text" class="form-control" name="newCouponName" value="<?php echo remove_junk(ucwords($e_coupon['cLabel'])); ?>">
            </div>
            <div class="form-group">
                  <label for="merchant" class="control-label">Merchant</label>
                  <input type="text" readonly class="form-control" name="merchant" value="<?php echo remove_junk(ucwords($e_coupon['cMerchant'])); ?>">
            </div>
            <div class="form-group">
                  <label for="category" class="control-label">Category</label>
                  <input type="text" readonly class="form-control" name="category" value="<?php echo get_categories($e_coupon['aCategoriesV2']); ?>">
            </div>
            <div class="form-group">
                  <label for="types" class="control-label">Types</label>
                  <input type="text" readonly class="form-control" name="types" value="<?php echo remove_junk(clean_type_field($e_coupon['aTypes'])); ?>">
            </div>
             <div class="form-group">
                  <label for="stDate" class="control-label">Start Date</label>
                  <input type="text" readonly class="form-control" name="stDate" value="<?php echo (read_date($e_coupon['dtStartDate'])); ?>">
            </div>
             <div class="form-group">
                  <label for="endDate" class="control-label">End Date</label>
                  <input type="text" readonly class="form-control" name="endDate" value="<?php echo (read_date($e_coupon['dtEndDate'])); ?>">
            </div>
            <div class="form-group">
                  <label for="description" class="control-label">Description</label>
                  <textarea rows="10" cols="30" class="form-control" name="description" ><?php echo $e_coupon['cDescription']; ?></textarea> 
            </div>


            <div class="form-group clearfix">
                    <button type="submit" name="update" class="btn btn-success" style="float: right;">Publish & Next</button>

                    <button type="submit" name="exit" id="exit" class="btn btn-danger" style="float: right; margin-right: 5px">Unlock it, I dont want to write this coupon</button>
            </div>
        </form>
       </div>
     </div>
  </div>


 </div>
<?php include_once('layouts/footer.php'); ?>
