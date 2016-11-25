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
if(isset($_POST['btn-update']))
{
 $userId = $_GET['edit_id'];
  if ($userRow['userId'] != $userId){
      $uname = strip_tags($_POST['userName']);
      $umail = strip_tags($_POST['userEmail']);
      $ufullname = strip_tags($_POST['fullname']);
      $uperm = strip_tags($_POST['permission']);
   
     if($crud->update($userId,$uname,$umail,$ufullname,$uperm))
     {
      $msg = "<div class='alert alert-info'>
        <strong>WOW!</strong> Record was updated successfully <a href='listuser.php'>HOME</a>!
        </div>";
     }
     else
     {
      $msg = "<div class='alert alert-warning'>
        <strong>SORRY!</strong> ERROR while updating record !
        </div>";
     }
    }else {
        exit("Edit Error! User is logged in");
    }
}

if(isset($_GET['edit_id']))
{
 $userId = $_GET['edit_id'];
 extract($crud->getID($userId)); 
}

?>
<?php include_once 'header.php'; ?>

<?php
if ($kodePermission == 1){
    $namaPermission = "Super Admin";
} else {
    $namaPermission = "Author";
}
?>
<div class="clearfix"></div>

<div class="container">
<?php
if(isset($msg))
{
 echo $msg;
}
?>
</div>

<div class="clearfix"></div><br />

<div class="container">
  
     <form method='post'>
 
    <table class='table table-bordered'>
 
        <tr>
            <td>Username</td>
            <td><input type='text' name='userName' class='form-control' value="<?php echo $userName; ?>" required></td>
        </tr>
 
        <tr>
            <td>Email</td>
            <td><input type='text' name='userEmail' class='form-control' value="<?php echo $userEmail; ?>" required></td>
        </tr>

        <tr>
            <td>Full Name</td>
            <td><input type='text' name='fullname' class='form-control' value="<?php echo $fullname; ?>" required></td>
        </tr>
 
        <tr>
            <td>Permission</td>
            <td><select class="form-control" name="permission" required>
              <option value="Super Admin" <?php if($namaPermission=="Super Admin") echo 'selected="selected"'; ?>>Super Admin</option>
              <option value="Author" <?php if($namaPermission=="Author") echo 'selected="selected"'; ?>>Author</option>
             </select></td>
        </tr>
 
        <tr>
            <td colspan="2">
                <button type="submit" class="btn btn-primary" name="btn-update">
       <span class="glyphicon glyphicon-edit"></span>  Update this Record
    </button>
                <a href="listuser.php" class="btn btn-large btn-success"><i class="glyphicon glyphicon-backward"></i> &nbsp; CANCEL</a>
            </td>
        </tr>
 
    </table>
</form>
     
     
</div>

<?php include_once 'footer.php'; ?>