<?php
include '../include/head.php';
include '../include/navigation.php';
//include 'page_akcije/deletePage.php';
?>
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Uredjaji</h1>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <div class="card-tools  p-3">
    <form method="GET">
      <div class="input-group input-group-sm" style="width: 300px;">
      <?php
      if(isset($_GET['table_search'])){
        $val=$_GET['table_search'];
      }
      else{
        $val='';
      }
      ?>
        <input type="text" name="table_search" class="form-control float-right" value="<?=$val?>"
          placeholder="Search">

        <div class="input-group-append">
          <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
        </div>
      </div>
    </form>
  </div>

  <a href="editUredjaj.php?id=0" class="float-right btn btn-primary">Novi unos</a>

  <div class="card-body">
    <table class="table table-bordered">
      <thead>
        <tr>
          <th>Naziv Uredjaja</th>
          <th>Tip</th>
          <th style="width: 40px"></th>
        </tr>
      </thead>
      <tbody>

        <?php
        if(isset($_GET['table_search'])){
          $search = $_GET['table_search'];
        }
        else{
          $search= '';
        }

        if(!isset($_GET['page'])){
          $page=1;
        }
        else {
          $page=$_GET['page'];
        }
        //prikazivanje uredjaja u tabeli po nazivu uredjaja i nazivu tipa
    $pagesQuery = getAllPages($page,$search);
    while($row=$pagesQuery->fetch()){
    ?>
        <tr>
          <td>
            <?= $row['Name'];?>
          </td>
          <td>
            <?= $row["typeName"];?>
          </td>
          <td>
            <a href="editUredjaj.php?id=<?= $row['id'];?>" class="btn btn-warning">Edit</a>
            <a href="uredjajiActions.php?id=<?= $row['id'];?>&action=delete" class="btn btn-danger">Delete</a>
          </td>
        </tr>



        <?php
    }
    ?>
      </tbody>
    </table>
    <div class="card-footer clearfix">
      <ul class="pagination pagination-sm m-0 float-right">
        <?php
        //paginacija
                  if($page > 1){
                    if($search != ''){
                      ?>
        <li class="page-item"><a class="page-link"
            href="http://localhost/bildstudio_test/uredjaji/list_uredjaji.php?page=<?=$page-1?>&table_search=<?= $search?>">&laquo;</a>
        </li>
        <?php
                    }
                    else{
                    ?>
        <li class="page-item"><a class="page-link"
            href="http://localhost/bildstudio_test/uredjaji/list_uredjaji.php?page=<?=$page-1?>">&laquo;</a></li>
        <?php
                    }
                  }
                    ?>
        <?php
    $rowPages=numberOfPages($search);
    $Ukupanbroj= $rowPages->rowCount();
    $broj= ceil($Ukupanbroj/5);
    for($i=1;$i<=$broj;$i++){
    ?>
        <?php
                    if($search != ''){
                      ?>
        <li class="page-item"><a class="page-link"
            href="http://localhost/bildstudio_test/uredjaji/list_uredjaji.php?page=<?=$i?>&table_search=<?= $search?>"><?= $i?></a>
        </li>
        <?php
                    }
                    else{
                    ?>
        <li class="page-item"><a class="page-link"
            href="http://localhost/bildstudio_test/uredjaji/list_uredjaji.php?page=<?=$i?>"><?= $i?></a></li>
        <?php
                    }
                    ?>

        <?php
    }
    ?>
        <?php
        if($page < $broj){
          if($search != ''){
          ?>
        <li class="page-item"><a class="page-link"
            href="http://localhost/bildstudio_test/uredjaji/list_uredjaji.php?page=<?=$page+1?>&table_search=<?= $search?>">&raquo;</a>
        </li>
        <?php
                    }
                    else{
                    ?>
        <li class="page-item"><a class="page-link"
            href="http://localhost/bildstudio_test/uredjaji/list_uredjaji.php?page=<?=$page+1?>">&raquo;</a></li>
        <?php
                    }
                  }
                    ?>

      </ul>
    </div>
  </div>
</div>

<?php
include '../include/scripts.php';

?>