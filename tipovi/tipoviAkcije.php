<?php
$root = $_SERVER['DOCUMENT_ROOT']."/bildstudio_test";
include "$root/include/connect.php";


if(isset($_GET['id']) && !empty($_GET['id'])){
    $id = $_GET['id'];
    $query=$connect->prepare("SELECT id FROM device_types WHERE ParentId = :id");
    $query->execute(array(":id" => $id));
    $row = $query->rowCount();
    if($row == 0){
        $query1=$connect->prepare("SELECT id FROM devices WHERE DeviceTypeId = :id");
        $query1->execute(array(":id" => $id));
        $row1 = $query1->rowCount();
        if($row1 == 0){
            $query2=$connect->prepare("DELETE FROM device_type_property WHERE DeviceTypeId= :id");
            if($query2->execute(array(":id" => $id))){
                $query3=$connect->prepare("DELETE FROM device_types WHERE id = :id");
                if($query3->execute(array(":id" => $id))){
                    header("Location: tipovi_list.php?succes=Uspjesno ste obrisali tip.");
                }
                else{
                   header("Location: edit_tip_details.php?id=$id?error=Doslo je do greske pri brisanju tipa.");  
                }
            }
            else{
              header("Location: edit_tip_details.php?id=$id?error=Doslo je do greske pri brisanju tipa.");  
            }

        }
        else {
            header("Location: edit_tip_details.php?id=$id?error=Prvo izbrisite uredjaje koji koriste ovaj tip.");
        }
    }
    else {
        header("Location: edit_tip_details.php?id=$id?error=Prvo izbrisite podtipove ovog tipa.");
    }

}

if(isset($_POST['edit']) && !empty($_POST['edit'])) {
    $edit = json_decode($_POST['edit']);
    $query=$connect->prepare("UPDATE device_types
                              SET Name = :ime 
                              WHERE id = :id");
    $query->execute(array(
                        ":ime"=> $edit->naziv,
                        ":id" => $edit->id
                         ));
    foreach($edit->osobineNiz as $key => $value){
        
        $query1=$connect->prepare("UPDATE device_type_property
                            SET Name = :ime 
                            WHERE id = :id");
        $query1->execute(array(
                    ":ime"=> $value,
                    ":id" => $key
                        ));              
    }
     if ($query && $query1){
        echo "ok";
    }
    else{
        echo "err";
    }

}

if(isset($_POST['save']) && !empty($_POST['save'])) {
    $save = json_decode($_POST['save']);
    if($save->roditelj == 0){
        $query=$connect->prepare("INSERT INTO device_types (Name) 
                              VALUES (:ime)");
        $query->execute(array(
                        ":ime"=> $save->naziv
                         ));
    }
    else{
        $query=$connect->prepare("INSERT INTO device_types (Name, ParentId) 
                              VALUES (:ime, :parent)");
        $query->execute(array(
                        ":ime"=> $save->naziv,
                        ":parent" => $save->roditelj
                         ));
    }
    
    $query1=$connect->prepare("SELECT id FROM device_types ORDER BY id DESC LIMIT 1");
    $query1->execute();
    $row=$query1->fetch();
    $row['id'];
    
    foreach($save->osobineNiz as $key => $value){
        
        $query2=$connect->prepare("INSERT INTO device_type_property (Name, DeviceTypeId) 
                                  VALUES (:ime, :Deviceid)");
        $query2->execute(array(
                    ":ime"=> $value,
                    ":Deviceid" => $row['id']
                        ));              
    }
    if ($query && $query2){
        echo "ok";
    }
    else{
        echo "err";
    }
    

}


?>