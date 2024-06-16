<?php 

require_once "../connection.php";

$idnum = $_POST["idnum"];
$tname = $_POST["tname"];

$resultset = Database::search("SELECT `status` FROM `$tname` WHERE `id_num` = '".$idnum."'");
$userCount = $resultset->num_rows;
if ($userCount == 1) {
$userDetails = $resultset->fetch_assoc();

$status = $userDetails["status"];
if($status == 1){
Database::iud("UPDATE `$tname` SET `status` = '2' WHERE `id_num` = '$idnum'");
echo "blocked";
}else{

Database::iud("UPDATE `$tname` SET `status` = '1' WHERE `id_num` = '$idnum'");
echo "unblocked";

}
}
?>