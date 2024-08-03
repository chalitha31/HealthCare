<?php
require_once "../connection.php";

$eqId = $_GET["eqid"];
$upQty = $_GET["upQty"];
$status = $_GET["status"];

$equResultSet = Database::search("SELECT id,name, quantity, purchase_date,avalable_quantity FROM mlt_equipments WHERE id =  '".$eqId."'");
$numRow = $equResultSet->num_rows;

if($numRow > 0){
$Data = $equResultSet->fetch_assoc();

if($status == "update"){

$cuurent_qty = $Data["avalable_quantity"];
if($cuurent_qty < $upQty){

    Database::iud("UPDATE `mlt_equipments` SET `avalable_quantity` = '0' WHERE `id` = '".$eqId."'");

}else{
$newQty = $cuurent_qty - $upQty;
    Database::iud("UPDATE `mlt_equipments` SET `avalable_quantity` = '".$newQty."' WHERE `id` = '".$eqId."'");

}
echo "success";
}else{

// remove table
Database::iud("UPDATE `mlt_equipments` SET `view` = '0' WHERE `id` = '".$eqId."'");

echo "Item Removed Successfully";
}


}


?>