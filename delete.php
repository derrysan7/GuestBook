<?php
  require_once("session.php");
  require_once("permvaliduser.php");
?>
<?php
require_once("class.user.php");
$auth_user = new USER();
  $userIdloggedin = $_SESSION['user_session'];
  
  $stmt = $auth_user->runQuery("SELECT * FROM users WHERE userId=:userId");
  $stmt->execute(array(":userId"=>$userIdloggedin));
  
  $userRow=$stmt->fetch(PDO::FETCH_ASSOC);

include_once 'dbconfigcrud.php';
include_once 'class.crud.php';


$crud = new crud($DB_con);
if(isset($_POST['btn-del']))
{
 $userId = $_GET['delete_id'];
    if ($userRow['userId'] != $userId){
        $crud->delete($userId);
        header("Location: delete.php?deleted"); 
    } else {
      exit("Delete Error! User is logged in");
    }
}

?>

<?php include_once 'header.php'; ?>

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
     <strong>Sure !</strong> to remove the following record ? 
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
         <th>#</th>
         <th>Username</th>
         <th>Email</th>
         <th>Full Name</th>
         <th>Permission</th>
         </tr>
         <?php
         $stmt = $DB_con->prepare("SELECT * FROM users WHERE userId=:userId");
         $stmt->execute(array(":userId"=>$_GET['delete_id']));
         while($row=$stmt->fetch(PDO::FETCH_BOTH))
          {
          if($row['kodePermission']==1){
            $namaPermission = "Super Admin";
          } else{
            $namaPermission = "Author";
          }

         
             ?>
             <tr>
             <td><?php print($row['userId']); ?></td>
             <td><?php print($row['userName']); ?></td>
             <td><?php print($row['userEmail']); ?></td>
             <td><?php print($row['fullname']); ?></td>
             <td><?php print($namaPermission); ?></td>
             </tr>
             <?php
         }
         ?>
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
    <input type="hidden" name="id" value="<?php echo $row['userId']; ?>" />
    <button class="btn btn-large btn-primary" type="submit" name="btn-del"><i class="glyphicon glyphicon-trash"></i> &nbsp; YES</button>
    <a href="listuser.php" class="btn btn-large btn-success"><i class="glyphicon glyphicon-backward"></i> &nbsp; NO</a>
    </form>  
 <?php
}
else
{
 ?>
    <a href="listuser.php" class="btn btn-large btn-success"><i class="glyphicon glyphicon-backward"></i> &nbsp; Back to index</a>
    <?php
}
?>
</p>
</div> 
<?php include_once 'footer.php'; ?>