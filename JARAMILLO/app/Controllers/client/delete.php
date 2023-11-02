<?php
include("../../config/config.php");

if ($_SERVER["REQUEST_METHOD"] == "GET") {
  $clientId  = $_REQUEST['Client_id'];
  $deleteId=$_REQUEST['Delete_id'];
  if($deleteId==0){
    $statusId = 2;
    $stmt = $connect->prepare("UPDATE client SET Status_id=? WHERE Client_id=?"); 
    $stmt->bind_param("ii",$statusId,$clientId);
  }else{
   
  $stmt = $connect->prepare("DELETE FROM client WHERE Client_id=?"); 
  $stmt->bind_param("i",$clientId);
  }
  

  $stmt->execute();
  echo "New records created successfully";
  $stmt->close();
  $connect->close();
  header('Location: ../../view/client/view.php');
  exit;


  
}
