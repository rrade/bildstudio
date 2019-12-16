<?php
$root = $_SERVER['DOCUMENT_ROOT']."/bildstudio_test";


function getAllPages($page, $search) {
    global $connect;
    $offset = ($page-1) * 5;
    $query = $connect->prepare("SELECT d.id, d.Name, dt.Name typeName, dtp.Name osobina, dpv.Vrijednost ValOsobina  
                                FROM devices d
                                LEFT JOIN device_types dt ON dt.id = d.DeviceTypeId 
                                LEFT JOIN device_type_property dtp ON dtp.DeviceTypeId = dt.id
                                LEFT JOIN device_property_values dpv ON dpv.DeviceId = d.id
                                WHERE d.Name LIKE '%$search%' OR dt.Name LIKE '%$search%' OR dpv.Vrijednost LIKE '%$search%'
                                GROUP BY d.id
                                LIMIT 5
                                OFFSET $offset");
    $query->execute();
    return $query;

}
function numberOfPages($search) {
    global $connect;
    $query = $connect->prepare("SELECT d.id, d.Name, dt.Name typeName, dtp.Name osobina, dpv.Vrijednost ValOsobina 
                                FROM devices d
                                LEFT JOIN device_types dt ON dt.id = d.DeviceTypeId
                                LEFT JOIN device_type_property dtp ON dtp.DeviceTypeId = dt.id
                                LEFT JOIN device_property_values dpv ON dpv.DeviceId = d.id
                                WHERE d.Name LIKE '%$search%' OR dt.Name LIKE '%$search%' OR dpv.Vrijednost LIKE '%$search%'
                                GROUP BY d.id");
    $query->execute();
    return $query;
}

function getPageDetails($id) {
    global $connect;

     $query = $connect->prepare("SELECT d.id, d.Name, dt.Name typeName, dtp.Name property, dtp.id propertyId, dpv.Vrijednost propertyValue
                                FROM devices d
                                LEFT JOIN device_types dt ON dt.id = d.DeviceTypeId 
                                LEFT JOIN device_type_property dtp ON dtp.DeviceTypeId = d.DeviceTypeId
                                LEFT JOIN device_property_values dpv ON dpv.DeviceTypePropertyId = dtp.id AND dpv.DeviceId = d.id
                                WHERE d.id = :id");
    $query->execute(array(":id" => $id));
    return $query;
}

function getAllNullParents() {
    global $connect;

    $query = $connect->prepare("SELECT * FROM device_types 
                              WHERE ParentId IS NULL");
    $query->execute();
    return $query;
}
function getChildren($id) {
     global $connect;

    $query = $connect->prepare("SELECT * FROM device_types 
                              WHERE ParentId = :id");
    $query->execute(array(":id" => $id));
    return $query;
}
function showAllChildren($id){
     
    $queryChildren = getChildren($id);
    while($row1=$queryChildren->fetch()){
    $name = $row1['Name'];
    $id1 = $row1['id'];
    echo "<ul class='nested'><li><a href='edit_tip_details.php?id=$id1'>$name</a></li>";
      showAllChildren($row1['id']);
    }
    echo"</ul>";
    
}
function getTipDetails($id){
    global $connect;

    $query = $connect->prepare("SELECT dt.Name, dt.id, dtp.Name Osobina, dtp.id OsobinaId, dtp.DeviceTypeId
                                FROM device_types dt
                                LEFT JOIN device_type_property dtp ON dt.id=dtp.DeviceTypeId 
                                WHERE dtp.DeviceTypeId= :id");
    $query->execute(array(":id" => $id));
    return $query;
}
function getAllTypes(){
     global $connect;

    $query = $connect->prepare("SELECT Name, id FROM device_types");
    $query->execute();
    return $query;
}
?>
