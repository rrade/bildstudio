<?php
include '../include/head.php';
include '../include/navigation.php';

//include 'page_akcije/deletePage.php';
?>
<?php
    if(isset($_GET['id'])) {
        $id=$_GET['id'];
        $queryEdit=getTipDetails($id);
        $row = $queryEdit->fetchAll();
    }
    else{
        header("Location: tipovi_list.php");
    }
    
    ?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <?php
            if($_GET['id'] == 0){
                $titleUpdateSave='Dodavanje novog tipa';
                $display= 'none';
                $name='newSave';
            }else{
               $titleUpdateSave = 'Edituj tip - '.$row[0]['Name'];
               $display= 'inline';
               $name='editSave';
            }
            
            ?>
                    <h1 class="m-0 text-dark"><?= $titleUpdateSave;?></h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <div class="card card-primary">
        <div class="card-header">

            <div class="card-tools">

            </div>
        </div>
        <form method="POST" onsubmit="submitForm(event)">
            <div class="card-body">
                <div class="form-group">
                    <label for="inputName">Naziv tipa</label>
                    <input type="text" id="naziv" class="form-control" name="title" value="<?=$row == NULL ? '' : $row[0]['Name']?>">
                </div>
                <?php 
                if($id==0){
                ?>
                <div class="form-group">
                <label for="inputName">Roditelj</label>
                    <select class="form-control"  id="roditelji">
                    <option value="0" selected>--Select--</option>
                    <?php
                    $queryTip = getAllTypes();
                    $rowqueryTip = $queryTip->fetchAll();
                   for($k = 0; $k < count($rowqueryTip); $k++){
                        ?>
                        <option value="<?= $rowqueryTip[$k]['id']?>"><?= $rowqueryTip[$k]['Name']?></option>
                    <?php
                    }
                    ?>
                    </select>
                </div>
                 <div class="form-group">
                    <label for="inputName">Osobina</label>
                    <input type="text" id="0" class="form-control" name="title" value="">
                    <input type="hidden" id="Osobina0" value="0">
                </div >
                <div id="novaOsobina">
                </div>
                <span class="btn btn-primary" id="addNew">+</span><br><br>
                <?php
                }

                for($i=0;$i<count($row);$i++){
                  
                ?>
                <div class="form-group">
                    <label for="inputClientCompany">Osobina <?=$i;?></label>
                    <input type="text" id="<?= $i?>" class="form-control" name="page"
                        value="<?=$row[$i]['Osobina'];?>">
                    <input type="hidden" id="<?= "Osobina".$i; ?>" value="<?= $row[$i]['OsobinaId']; ?>">
                </div>
                <?php 
              }
              ?>
              
                <input type="hidden" id="count" value="<?= count($row); ?>">
                <a href="tipoviAkcije.php?id=<?=$_GET['id']?>&action=delete" style="display:<?=$display?>"
                    class="btn btn-danger">Delete</a>
                <input type="submit" class="btn btn-success" name="<?=$name?>" value="Save">
                <input type="hidden" name="id" id="id" value="<?=$id?>">
        </form>
    </div>
    <!-- /.card-body -->
</div>
<script type="text/javascript">
    //ista funkcija kao i kod uredjaja
    function submitForm(event) {
        event.preventDefault();

        var fd = {};
        var osobineNiz = {};
        var naziv = $('#naziv').val();
        var id = $('#id').val();
        
        if (id == 0) {
            data = "save";
            var counter = brojac;
            var roditelj= $('#roditelji').val();
           
        } else {
            data = "edit";
            var counter = $('#count').val();
            var roditelj = '';
        }
        
        var i = 0;
        for (i; i < counter; i++) {
            var indexID = "Osobina"+ (i);
            var index = document.getElementById(indexID).value;
            osobineNiz[index] = document.getElementById(i).value;
        }
        fd["naziv"] = naziv;
        fd["id"] = id;
        fd["roditelj"] = roditelj;
        fd["osobineNiz"] = osobineNiz;
        

        var json = JSON.stringify(fd);
        var formData = new FormData();
        formData.append(data, json);
        $.ajax({
            method: 'post',
            url: 'tipoviAkcije.php',
            contentType: false,
            data: formData,
            processData: false,
            success: function(response){
                if (response == "ok") {
          alert("Uspjesno izmjenjen/napravljen tip");
        } else {
          alert("Doslo je do greske. Pokusajte ponovo.");
        }
            }
        });
    }

</script>
<?php
    include '../include/scripts.php';
?>