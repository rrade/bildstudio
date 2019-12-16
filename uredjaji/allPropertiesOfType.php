<?php
$root = $_SERVER['DOCUMENT_ROOT']."/bildstudio_test";
include "$root/include/connect.php";


if(isset($_GET['id']) && !empty($_GET['id'])){
    $id=$_GET['id'];

    $query=$connect->prepare("SELECT id, Name FROM device_type_property WHERE DeviceTypeId = :id");
    $query->execute(array(":id" => $id));
    $properties = array();
    while ($row = $query->fetch()) {
        $id = $row['id'];
        $properties[$id] = $row['Name'];
    }
    print_r(json_encode($properties));
}



?>