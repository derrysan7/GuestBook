<?php
  require_once("session.php");
  require_once("permvalidcontent.php");
?>
<?php
require_once("class.user.php");
$auth_user = new USER();
$userIdloggedin = $_SESSION['user_session'];

$stmt = $auth_user->runQuery("SELECT * FROM users WHERE userId=:userId");
$stmt->execute(array(":userId"=>$userIdloggedin));

$userRow=$stmt->fetch(PDO::FETCH_ASSOC);

include_once 'dbconfigcrud.php';
include_once 'class.crud.berita.php';

$crud = new crud($DB_con);

if(isset($_GET['delete_id']))
{
 $id = $_GET['delete_id'];
 extract($crud->getID($id)); 
}

if(isset($_POST['btn-del']))
{
  if ($userRow['userId'] == $userId){
     $id_del = $_GET['delete_id'];
     if ($gambar != 'placeholder.png'){
      unlink("user_images/".$gambar);
      } 
     $crud->delete($id_del);
     header("Location: delete-berita.php?deleted"); 
  }else {
        exit("Delete Error! Wrong Author");
  }
}

?>

<?php include_once 'header.php'; ?>
<link rel="stylesheet" href="styleberita.css" type="text/css">

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
           <th class="col-sm-2">Tanggal Dibuat</th>
           <th class="col-sm-3">Judul</th>
           <th class="col-sm-2">Nama Penulis</th>
         </tr>
             <tr>
                <td><?php echo $id ?></td>
                <td><?php echo $tanggaldib ?></td>
                <td><?php echo $judul ?></td>
                <td><?php echo $namapen ?></td>
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
    <a href="listberita.php" class="btn btn-large btn-success"><i class="glyphicon glyphicon-backward"></i> &nbsp; NO</a>
    </form>  
 <?php
}
else
{
 ?>
    <a href="listberita.php" class="btn btn-large btn-success"><i class="glyphicon glyphicon-backward"></i> &nbsp; Back to index</a>
    <?php
}
?>
</p>
</div> 
<?php include_once 'footer.php'; ?>