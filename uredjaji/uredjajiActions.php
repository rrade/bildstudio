<?php
$root = $_SERVER['DOCUMENT_ROOT']."/bildstudio_test";
include "$root/include/connect.php";

// get_object_vars($_POST['edit'])

   

if(isset($_GET['id']) && !empty($_GET['id'])){
    $id = $_GET['id'];

    $query = $connect->prepare("DELETE FROM device_property_values WHERE DeviceId = :id");
    if ($query->execute(array(":id" => $id))){
        $query1 = $connect->prepare("DELETE FROM devices WHERE id = :id");
       if($query1->execute(array(":id" => $id))){
           header("Location: list_uredjaji.php?success= Uspjesno ste obrisali uredjaj!");
       }   
       else{
           header("Location: list_uredjaji.php?error=Ooopps! Doslo je do greske pri brisanju uredjaja!");
       }

    }
    else{
        header("Location: list_uredjaji.php?error=Ooopps! Doslo je do greske pri brisanju uredjaja!");
    
    }
    
}

if(isset($_POST['edit']) && !empty($_POST['edit'])) {
    $edit = json_decode($_POST['edit']);
    $query7 = $connect->prepare("UPDATE devices SET Name = :ime WHERE id = :id");
    $query7->execute(array(
            ":ime"=> $edit->title,
            ":id"=> $edit->id
        ));
    foreach($edit->osobineNiz as $key => $value){
        
    $query6 = $connect->prepare("UPDATE device_property_values SET  Vrijednost = :osobina  WHERE DeviceTypePropertyId = :propertyId AND DeviceId = :id");
    $query6->execute(array(
            ":osobina"=> $value,
            ":propertyId"=>$key,
            ":id"=> $edit->id
        ));
       
    }
    
    if ($query6 && $query7){
        echo "ok";
    }
    else{
        echo "err";
    }
    }
    


if(isset($_POST['save']) && !empty($_POST['save'])) {
    $save = json_decode($_POST['save']);
    
        $query3 = $connect->prepare("INSERT INTO devices (Name, DeviceTypeId)                                  
                                     VALUES (:ime, :tip)");
        $query3->execute(array(
            ":ime"=> $save->title,
            ":tip"=>$save->roditelji
        ));
        $query4 = $connect->prepare("SELECT id 
                                    FROM devices 
                                    WHERE Name = :ime 
                                    AND DeviceTypeId = :tip");
        $query4->execute(array(
            ":ime"=> $save->title,
            ":tip"=>$save->roditelji
        ));
        $row4 = $query4->fetch();

        foreach($save->osobineNiz as $key=> $value)
        
        $query = $connect->prepare("INSERT INTO device_property_values (DeviceTypePropertyId, DeviceId, Vrijednost)                                   VALUES (:osobinaId, :id, :vrijednost)");
        $query->execute(array(
            ":osobinaId"=>$key,
            ":id"=> $row4['id'],
            ":vrijednost"=>$value
        ));

        if ($query3 && $query4 && $query){
            echo "ok";
         }
        else{
            echo "err";
    }
}

 

?>