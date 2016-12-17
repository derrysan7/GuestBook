<?php
  require_once("session.php");
?>
<?php
require_once("class.user.php");
$auth_user = new USER();
$userIdloggedin = $_SESSION['user_session'];

$stmt = $auth_user->runQuery("SELECT * FROM users WHERE userId=:userId");
$stmt->execute(array(":userId"=>$userIdloggedin));

$userRow=$stmt->fetch(PDO::FETCH_ASSOC);

include_once 'dbconfigcrud.php';
include_once 'class.crud.tamu.php';

$crud = new crud($DB_con);

if(isset($_POST['btn-update']))
{
    if ($_POST['csrf-token'] == $_SESSION['token']){
        $id = $_GET['edit_id'];
        extract($crud->getID($id));
        if ($userRow['userId'] == $userId){

                $tnama = htmlspecialchars($_POST['txt_nama']);
                $temail = htmlspecialchars($_POST['txt_email']);
                $talamat = htmlspecialchars($_POST['txt_alamat']);
                $tucapan = htmlspecialchars($_POST['txt_ucapan']);

                 if($crud->update($id,$tnama,$temail,$talamat,$tucapan))
                 {
                  $msg = "<div class='alert alert-info'>
                    <strong>Success!</strong> Record was updated successfully <a href='listtamu.php'>HOME</a>!
                    </div>";
                 }
                 else
                 {
                  $msg = "<div class='alert alert-warning'>
                    <strong>Failed!</strong> ERROR while updating record !
                    </div>";
                 }

        }else {
            exit("Edit Error! Wrong Author");
        }
    }exit("Error! Wrong Token");
}

if(isset($_GET['edit_id']))
{
 $id = $_GET['edit_id'];
 extract($crud->getID($id)); 
}

?>
<?php include_once 'header.php'; ?>

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

    <?php
    if(isset($errMSG)){
        ?>
        <div class="alert alert-danger">
          <span class="glyphicon glyphicon-info-sign"></span> &nbsp; <?php echo $errMSG; ?>
        </div>
        <?php
    }
    ?>
    <form method="post">

            <input type="edit" name="csrf-token" value="<?php echo $_SESSION['token'] ?>">
            <div class="col-xs-8">
                <label>Nama</label>          
                <input type='text' name='txt_nama' class='form-control' maxlength="50" value='<?php echo $tamuNama ?>' required>
            </div>

            <div class="col-xs-8">
                <label>Email</label>          
                <input type='text' name='txt_email' class='form-control' maxlength="60" value='<?php echo $tamuEmail ?>' required>
            </div>

            <div class="col-xs-8">
                <label>Alamat</label>          
                <input type='text' name='txt_alamat' class='form-control' value='<?php echo $tamuAlamat ?>' required>
            </div>

            <div class="col-md-8">
                <label>Ucapan Selamat</label>
                <textarea class="form-control" rows="20"  wrap="hard" cols="80" name="txt_ucapan" id="deskripsi" name="txt_deskripsi" required><?php echo $tamuUcapan ?></textarea>
            </div>

            <div class="col-xs-8">
                <label>Username Penulis</label>
                <br>
                <input type='text' name='txt_namapenulis' class='form-control' value='<?php echo $usernamepenulis ?>' readonly>
            </div>

        <div class="col-xs-8">
            <button type="submit" class="btn btn-primary" name="btn-update">
            <span class="glyphicon glyphicon-edit"></span>  Update this Record
            </button>
            <a href="listtamu.php" class="btn btn-large btn-success"><i class="glyphicon glyphicon-backward"></i> &nbsp; CANCEL</a>
        </div>

    </form>
  
</div>

<?php include_once 'footer.php'; ?>