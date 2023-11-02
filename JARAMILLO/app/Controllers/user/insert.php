<?php
include("../../config/config.php");

if ($_SERVER["REQUEST_METHOD"] == "GET") {
  $userName = $_REQUEST['User_name'];
  $userLastName = $_REQUEST['User_lastName'];
  $userDocument = $_REQUEST['User_document'];
  $userEmail = $_REQUEST['User_email'];
  $userCellphone = $_REQUEST['User_cellphone'];
  $userBirthdate = $_REQUEST['User_birthdate'];

  $userUser = $_REQUEST['User_user'];
  $userPassword =password_hash($_REQUEST['User_password'], PASSWORD_DEFAULT) ;

  $statusId = $_REQUEST['Status_id'];
  $documentTypeId = $_REQUEST['DocumentType_id'];
  $genderTypeId = $_REQUEST['GenderType_id'];

  $stmt = $connect->prepare("INSERT INTO user 
  (User_name, 
  User_lastName, 
  User_document,
  User_email,
  User_cellphone,
  User_birthdate,
  User_user,
  User_password,
  Status_id,
  DocumentType_id,
  GenderType_id) VALUES 
  (?,?,?,?,?,?,?,?,?,?,?)");
  $stmt->bind_param("ssssssssiii",$userName,$userLastName,$userDocument,$userEmail,$userCellphone,  $userBirthdate,$userUser,$userPassword,$statusId,$documentTypeId,$genderTypeId);

  $stmt->execute();
  echo "New records created successfully";
  $stmt->close();
  $connect->close();
  header('Location: ../../view/user/');
  exit;
}
