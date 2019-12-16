<?php
include '../include/head.php';
include '../include/navigation.php';

//include 'page_akcije/deletePage.php';

?>
<style>
ul, #myUL {
  list-style-type: none;
}

#myUL {
  margin: 0 0 0 20%;
  padding: 0;
}

.caret {
  cursor: pointer;
  -webkit-user-select: none; /* Safari 3.1+ */
  -moz-user-select: none; /* Firefox 2+ */
  -ms-user-select: none; /* IE 10+ */
  user-select: none;
}

.caret::before {
  content: "\25B6";
  color: black;
  display: inline-block;
  margin-right: 6px;
}

.caret-down::before {
  -ms-transform: rotate(90deg); /* IE 9 */
  -webkit-transform: rotate(90deg); /* Safari */'
  transform: rotate(90deg);  
}

.nested {
  display: block;
}

</style>
<a href="edit_tip_details.php?id=0" class="btn btn-primary float-right" style="margin:5px;">Insert New Type</a>
<?php
$queryNullParent = getAllNullParents();
while($row=$queryNullParent->fetch()){
    $idNullParent = $row['id'];
?>

<ul id="myUL">
  <li><span class="caret"><a href="edit_tip_details.php?id=<?= $idNullParent?>"><?= $row['Name'];?></a></span>
   <?php
    showAllChildren($row['id']);
   ?>
  </li>
</ul>

<?php
}
include '../include/scripts.php';

?>
