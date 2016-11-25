<?php
  require_once("session.php");
?>
<?php
require_once("permvaliduser.php");
include_once 'dbconfigcrud.php';
include_once 'class.crud.php';

$crud = new crud($DB_con);
?>
<?php include_once 'header.php'; ?>

<div class="clearfix"></div>

<div class="container">
<a href="add-data.php" class="btn btn-large btn-info"><i class="glyphicon glyphicon-plus"></i> &nbsp; Add Records</a>
</div>

<div class="clearfix"></div><br />

<div class="container">
     <table class='table table-bordered table-responsive'>
     <tr>
     <th>#</th>
     <th>Username</th>
     <th>Email</th>
     <th>Full Name</th>
     <th>Permission</th>
     <th colspan="2" align="center">Actions</th>
     </tr>
     <?php
  $query = "SELECT * FROM users";       
  $records_per_page=5;
  $newquery = $crud->paging($query,$records_per_page);
  $crud->dataview($newquery);
  ?>
    <tr>
        <td colspan="8" align="center">
    <div class="pagination-wrap">
            <?php $crud->paginglink($query,$records_per_page); ?>
         </div>
        </td>
    </tr>
 
</table>
   
       
</div>

<?php include_once 'footer.php'; ?>