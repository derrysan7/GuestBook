<?php
  require_once("session.php");
  require_once("permvaliduser.php");
  require_once('class.user.php');
    $user = new USER();
?>
<?php
include_once 'dbconfigcrud.php';
include_once 'class.crud.php';

$crud = new crud($DB_con);
if(isset($_POST['btn-save']))
{
    $uname = strip_tags($_POST['txt_uname']);
    $umail = strip_tags($_POST['txt_umail']);
    $upass = strip_tags($_POST['txt_upass']);
    $ufullname = strip_tags($_POST['txt_ufullname']);
    $uperm = strip_tags($_POST['drop_perm']);

    if($uname=="")  {
        $error[] = "provide username !";    
    }
    else if($umail=="") {
        $error[] = "provide email id !";    
    }
    else if(!filter_var($umail, FILTER_VALIDATE_EMAIL)) {
        $error[] = 'Please enter a valid email address !';
    }
    else if($upass=="") {
        $error[] = "provide password !";
    }
    else if(strlen($upass) < 6){
        $error[] = "Password must be atleast 6 characters"; 
    }
    else
    {
        try
        {
            $stmt = $user->runQuery("SELECT userName, userEmail FROM users WHERE userName=:uname OR userEmail=:umail");
            $stmt->execute(array(':uname'=>$uname, ':umail'=>$umail));
            $row=$stmt->fetch(PDO::FETCH_ASSOC);
                
            if($row['userName']==$uname) {
                $error[] = "sorry username already taken !";
            }
            else if($row['userEmail']==$umail) {
                $error[] = "sorry email id already taken !";
            }
            else
            {
                if($crud->create($uname,$umail,$upass,$ufullname,$uperm))
                 {
                  header("Location: add-data.php?inserted");
                 }
                 else
                 {
                  header("Location: add-data.php?failure");
                 }
            }
        }
        catch(PDOException $e)
        {
            echo $e->getMessage();
        }
    }   
 

}

?>

<?php include_once 'header.php'; ?>
<div class="clearfix"></div>

<?php
if(isset($_GET['inserted']))
{
 ?>
    <div class="container">
 <div class="alert alert-info">
    <strong>SUCCESS!</strong>User Record was inserted successfully <a href="listuser.php">HOME</a>!
 </div>
 </div>
    <?php
}
else if(isset($_GET['failure']))
{
 ?>
    <div class="container">
 <div class="alert alert-warning">
    <strong>FAILED!</strong> ERROR while inserting record !
 </div>
 </div>
    <?php
}
?>

<div class="clearfix"></div><br />

<div class="container">

  
  <form method='post'>
            <?php
            if(isset($error))
            {
                foreach($error as $error)
                {
                     ?>
                     <div class="alert alert-danger">
                        <i class="glyphicon glyphicon-warning-sign"></i> &nbsp; <?php echo $error; ?>
                     </div>
                     <?php
                }
            }
            else if(isset($_GET['joined']))
            {
                 ?>
                 <div class="alert alert-info">
                      <i class="glyphicon glyphicon-log-in"></i> &nbsp; Successfully registered <a href='index.php'>login</a> here
                 </div>
                 <?php
            }
            ?>
 
    <table class='table table-bordered'>
 
        <tr>
            <td>Username</td>
            <td><input type='text' name='txt_uname' class='form-control' value="<?php if(isset($error)){echo $uname;}?>" required></td>
        </tr>
 
        <tr>
            <td>Email</td>
            <td><input type='text' name='txt_umail' class='form-control' value="<?php if(isset($error)){echo $umail;}?>" required></td>
        </tr>
 
        <tr>
            <td>Password</td>
            <td><input type='password' name='txt_upass' class='form-control' required></td>
        </tr>
        
        <tr>
            <td>Full Name</td>
            <td><input type='text' name='txt_ufullname' class='form-control' required></td>
        </tr>

        <tr>
            <td>Permission</td>
            <td><select class="form-control" name="drop_perm" required>
              <option selected disabled>Select permission</option>
              <option>Super Admin</option>
              <option>Author</option>
             </select></td>
        </tr>
 
        <tr>
            <td colspan="2">
            <button type="submit" class="btn btn-primary" name="btn-save">
      <span class="glyphicon glyphicon-plus"></span> Create New Record
   </button>  
            <a href="listuser.php" class="btn btn-large btn-success"><i class="glyphicon glyphicon-backward"></i> &nbsp; Back to index</a>
            </td>
        </tr>
 
    </table>
</form>
     
     
</div>

<?php include_once 'footer.php'; ?>