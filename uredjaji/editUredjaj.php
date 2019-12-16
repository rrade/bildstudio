<?php
include '../include/head.php';
include '../include/navigation.php';

//include 'page_akcije/deletePage.php';

?>

<?php
      $id = $_GET['id'];
      $queryEdit=getPageDetails($_GET['id']);
      $row = $queryEdit->fetchAll();
      $name1= $row == NULL ? "" : $row[0]['Name'];
      $typeName= $row == NULL ? "" : $row[0]['typeName'];    
?>

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <?php
            if($_GET['id'] == 0){
                $titleUpdateSave='Dodavanje novog uredjaja';
                $display= 'none';
                $disabled = '';
                $name='newSave';
            }else{
               $titleUpdateSave = 'Edituj uredjaj - '.$name1;
               $display= 'inline';
               $name='editSave';
               $disabled = 'disabled';
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
    <form action="uredjajiActions.php" method="POST" onsubmit="submitForm(event)">
      <div class="card-body">
        <div class="form-group">
          <label for="inputName">Naziv uredjaja</label>
          <input type="text" id="naziv" class="form-control" name="title" value="<?=$name1?>" required>
        </div>
        <div class="form-group">
          <label for="inputName">Tip Uedjaja</label>
          <select <?=$disabled?> class="form-control" id="roditelji" name="roditelji" onchange="getPropertiesOfType()"
            required>
            <option value="">--SELECT--</option>
          <?php
            $queryTip = getAllTypes();
            $rowqueryTip = $queryTip->fetchAll();
            for($k = 0; $k < count($rowqueryTip); $k++){
          ?>
            <option <?= $typeName == $rowqueryTip[$k]['Name']?'selected':'';?> value="<?= $rowqueryTip[$k]['id']?>">
              <?= $rowqueryTip[$k]['Name']?></option>
            <?php
                    }
                    ?>
          </select>
        </div>
        <div id="osobineTipa">
        </div>
        <?php
               for($i=0;$i<count($row);$i++) {
                ?>
        <div class="form-group">
          <label for="inputClientCompany"><?= $row[$i]['property']?></label>
          <input type="text" id="<?= $row[$i]['propertyId']?>" class="form-control" name="<?= $row[$i]['propertyId']?>"
            value="<?= $row[$i]['propertyValue'];?>">
        </div>
        <?php
                }
                ?>
        <a href="uredjajiActions.php?id=<?=$_GET['id']?>&action=delete" style="display:<?=$display?>"
          class="btn btn-danger">Delete</a>
        <input type="submit" class="btn btn-success" name="<?=$name?>" value="Save">
        <input type="hidden" name="id" id="id" value="<?=$id?>">
        <input type="hidden" name="brojac" id="brojac" value="<?=count($row)?>">
    </form>
  </div>
  <!-- /.card-body -->
</div>

<script type="text/javascript">
  function submitForm(event) {
    //sprijecavamo link da nas odvede na sledecu stranicu
    event.preventDefault();
    var fd = {};
    var osobineNiz = {};
    var id = $('#id').val();
    var roditelj = $('#roditelji').val();
    if (id == 0) {
      action = "save";
    } else {
      action = "edit";
    }
    //ovo je napravljeno kako bi mogli poslati akciji samo jedan parametar kao sto je trazeno u zadatku
    //prvo pokupimo sve vrijednosti forme i smjestimo ih u niz
    var data = $("form").serializeArray();
    // prolazimo kroz taj niz 
    data.forEach(function (item, index) {
      //provjeravamo da li je name atribut u htmlu broj, ako nije upisujemo njegovu vrijednost u fd objekat
      if (isNaN(item.name)) {
        fd[item.name] = item.value;
        //ako nije upisujemo ga osobineNiz objekat
      } else {
        osobineNiz[item.name] = item.value;
      }
    });
    // pusujemo u objekat fd objekat osobineNiz
    fd["osobineNiz"] = osobineNiz;
    //pravimo JSON od fd-a
    var json = JSON.stringify(fd);
    var formData = new FormData();
    //u zavisnosti od toga da li je akcija edit ili save saljemo json u uredjajiActions.php
    formData.append(action, json);
    $.ajax({
      method: 'post',
      url: 'uredjajiActions.php',
      contentType: false,
      data: formData,
      processData: false,
      success: function (response) {
        if (response == "ok") {
          alert("Uspjesno izmjenjen/napravljen uredjaj");
        } else {
          alert("Doslo je do greske. Pokusajte ponovo.");
        }
      }
    });
  }
//ova funkcija sluzi da pokupimo sve vrijednosti odredjenog tipa kao i vrijednosti osobina tog tipa
  function getPropertiesOfType() {
    var id = $('#roditelji').val();
    $.ajax({
      method: 'get',
      url: 'allPropertiesOfType.php',
      contentType: false,
      // i to preko id-a koji saljemo uz url
      data: 'id=' + id,
      processData: false,
      success: function (response) {
        var objResponse = JSON.parse(response);
        //kako u html-u ne bismo u slucaju promjene tipa nadogradili polja jedna ispod drugih ovdje ih prvo obrisemo pa nadogradimo nova
        $(".osobineTipa").remove();
        //za niz koji dobijemo iz allPropertiesOfType.php prolazimo i za svaku vrijednost upisujemo u html koji je u nastavku predstavljen
        jQuery.each(objResponse, function (key, value) {
          $('#osobineTipa').append('<div class="form-group osobineTipa"><label for="inputName">' + value +
            '</label><input type="text" id="' + key + '" class="form-control" name="' + key +
            '" value="" reqired></div> <input type="hidden" id="Osobina' + key + '" value="' + key + '">');
        });

      }
    });
  }
</script>
<?php
include '../include/scripts.php';

?>