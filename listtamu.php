<?php
  require_once("session.php");
  require_once('class.user.php');
  $user = new USER();
?>
<?php
include_once 'dbconfigcrud.php';
include_once 'class.crud.tamu.php';

$crud = new crud($DB_con);
?>

<?php include_once 'header.php';?>
<link rel="stylesheet" href="styletamu.css" type="text/css">

<div class="clearfix"></div>
<div class="container-fluid">
        <div class="container">
        <h2>Daftar Tamu</h2>

        <a href="add-tamu.php" class="btn btn-large btn-success"><i class="glyphicon glyphicon-plus"></i> &nbsp; Add Records</a>
        </div>

        <div class="clearfix"></div><br />

        <div class="container">
             <table class='table table-bordered table-responsive'>
                 <tr>
                 <th class="col-sm-1">Nama Penulis</th>
                 <th class="col-sm-2">Nama</th>
                 <th class="col-sm-5">Email</th>
                 <th class="col-sm-2">Alamat</th>
                 <th colspan="2" align="center" class="col-sm-1">Actions</th>
                 </tr>
                    <?php
                      $query = "SELECT * FROM tamu";       
                      $records_per_page=5;
                      $newquery = $crud->paging($query,$records_per_page);
                      $crud->dataview($newquery);
                    ?>
                <tr>
                    <td colspan="6" align="center">
                <div class="pagination-wrap">
                        <?php $crud->paginglink($query,$records_per_page); ?>
                     </div>
                    </td>
                </tr>
         
            </table>
           
               
        </div>
</div>



<?php include_once 'footer.php'; ?>