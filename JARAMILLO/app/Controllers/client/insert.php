<?php
include("../../config/config.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $clientName = $_REQUEST['client_name'];
  $clientIdentification = $_REQUEST['client_document'];
  $clientEmail = $_REQUEST['client_email'];
  $clientPhone = $_REQUEST['client_cellphone'];
  $clientAddress = $_REQUEST['client_address'];
  $clientPass = password_hash($_REQUEST['client_password'],PASSWORD_DEFAULT);




  $statusId = $_REQUEST['Status_id'];
  $documentTypeId = $_REQUEST['DocumentType_id'];

  $array = getValuesForSql([$clientName,$clientIdentification,$clientEmail,$clientPhone,$clientAddress,$documentTypeId,$statusId,2,$clientPass]);
  
  $stmt = $connect->prepare("call insert_client ($array)");
  $stmt->execute();
  echo "New records created successfully";
  $stmt->close();
  $connect->close();
  header('Location: ../../view/client/index.php');
  exit;
}

function getValuesForSql(array $data) : string {
  return '"'. implode('", "', $data) . '"';
}