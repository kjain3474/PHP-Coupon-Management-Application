<?php ob_start();
  require_once(realpath($_SERVER["DOCUMENT_ROOT"]).'\includes\load.php');
  if (!$session->isUserLoggedIn(true)) { redirect('index.php', false);}
?>

 <?php

	header("Access-Control-Allow-Origin: *");
	header('Content-Type: application/json');
	
    $query ="SELECT nCouponID, cLabel, cMerchant, aCategoriesV2, cNetwork, aTypes, dtStartDate, dtEndDate, cStatus, cDescription from coupon";
    $data = [];
    if($results = find_by_sql($query))
    {
        $data = $results;
    }

    echo json_encode($data);
  
 ?>
