<?php
include("../../config/config.php");

if ($_SERVER["REQUEST_METHOD"] == "GET") {
  $userId = $_REQUEST['User_id'];
  $deleteId=$_REQUEST['Delete_id'];
  if($deleteId==0){
    $statusId = 2;
    $stmt = $connect->prepare("UPDATE user SET Status_id=? WHERE User_id=?"); 
    $stmt->bind_param("ii",$statusId,$userId);
  }else{
   
  $stmt = $connect->prepare("DELETE FROM user WHERE User_id=?"); 
  $stmt->bind_param("i",$userId);
  }
  

  $stmt->execute();
  echo "New records created successfully";
  $stmt->close();
  $connect->close();
  header('Location: ../../view/user/view.php');
  exit;


  
}
