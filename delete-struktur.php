<?php
  require_once("session.php");
  require_once("permvalidcontent.php");
?>
<?php
include_once 'dbconfigcrud.php';
include_once 'class.crud.struktur.php';

$crud = new crud($DB_con);

if(isset($_GET['delete_id']))
{
 $id = $_GET['delete_id'];
 extract($crud->getID($id)); 
}

if(isset($_POST['btn-del']))
{
 $id_del = $_GET['delete_id'];
 unlink("user_images_struktur/".$gambar);
 $crud->delete($id_del);
 header("Location: delete-struktur.php?deleted"); 
}

?>

<?php include_once 'header.php'; ?>
<link rel="stylesheet" href="stylestruktur.css" type="text/css">

<div class="clearfix"></div>

<div class="container">

 <?php
 if(isset($_GET['deleted']))
 {
  ?>
        <div class="alert alert-success">
     <strong>Success!</strong> record was deleted... 
  </div>
        <?php
 }
 else
 {
  ?>
        <div class="alert alert-danger">
     <strong>Sure !</strong> remove the following record ? 
  </div>
        <?php
 }
 ?> 
</div>

<div class="clearfix"></div>

<div class="container">
  
  <?php
  if(isset($_GET['delete_id']))
  {
   ?>
         <table class='table table-bordered'>
         <tr>
           <th class="col-sm-1">#</th>
           <th class="col-sm-2">Urutan</th>
           <th class="col-sm-3">Nama Anggota</th>
           <th class="col-sm-2">Jabatan</th>
         </tr>
             <tr>
                <td><?php echo $id ?></td>
                <td><?php echo $urutan ?></td>
                <td><?php echo $nama_ang ?></td>
                <td><?php echo $jabatan_ang ?></td>
             </tr>
         </table>
         <?php
  }
  ?>
</div>

<div class="container">
<p>
<?php
if(isset($_GET['delete_id']))
{
 ?>
   <form method="post">
    <input type="hidden" name="id" value="<?php echo $id ?>" />
    <button class="btn btn-large btn-primary" type="submit" name="btn-del"><i class="glyphicon glyphicon-trash"></i> &nbsp; YES</button>
    <a href="liststruktur.php" class="btn btn-large btn-success"><i class="glyphicon glyphicon-backward"></i> &nbsp; NO</a>
    </form>  
 <?php
}
else
{
 ?>
    <a href="liststruktur.php" class="btn btn-large btn-success"><i class="glyphicon glyphicon-backward"></i> &nbsp; Back to index</a>
    <?php
}
?>
</p>
</div> 
<?php include_once 'footer.php'; ?>