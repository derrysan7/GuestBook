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

if(isset($_POST['btn-save']))
{
            $tuserid = $_POST['txt_userid'];
            $tusernamepenulis = $_POST['txt_namapenulis'];
            $tnama = htmlspecialchars($_POST['txt_nama']);
            $temail = htmlspecialchars($_POST['txt_email']);
            $talamat = htmlspecialchars($_POST['txt_alamat']);
            $tucapan = htmlspecialchars($_POST['txt_ucapan']);

            if(!isset($errMSG))
            {
                if($crud->create($tuserid,$tusernamepenulis,$tnama,$temail,$talamat,$tucapan))
                {
                header("Location: add-tamu.php?inserted");
                }
                else
                {
                header("Location: add-tamu.php?failure");
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
    <strong>SUCCESS!</strong>tamu was inserted successfully <a href="listtamu.php">HOME</a>!
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
    <?php
    if(isset($errMSG)){
            ?>
            <div class="alert alert-danger">
                <span class="glyphicon glyphicon-info-sign"></span> <strong><?php echo $errMSG; ?></strong>
            </div>
            <?php
    }
    ?> 
  
    <form method="post">

            <div class="col-xs-8">
                <label>Nama</label>          
                <input type='text' name='txt_nama' class='form-control' maxlength="50" required>
            </div>

            <div class="col-xs-8">
                <label>Email</label>          
                <input type='text' name='txt_email' class='form-control' maxlength="60" required>
            </div>

            <div class="col-xs-8">
                <label>Alamat</label>          
                <input type='text' name='txt_alamat' class='form-control' value='<?php echo $userRow['alamat'] ?>' required>
            </div>

            <div class="col-md-8">
                <label>Ucapan Selamat</label>
                <textarea class="form-control" rows="20"  wrap="hard" cols="80" name="txt_ucapan" id="deskripsi" name="txt_deskripsi" required><?php echo $deskripsi ?></textarea>
            </div>

            <div class="col-xs-8">
                <label>ID Penulis</label>
                <br>
                <input type='text' name='txt_userid' class='form-control' value='<?php echo $userRow['userId'] ?>' readonly>
            </div>

            <div class="col-xs-8">
                <label>Username Penulis</label>
                <br>
                <input type='text' name='txt_namapenulis' class='form-control' value='<?php echo $userRow['userName'] ?>' readonly>
            </div>

        <div class="col-xs-8">
            <button type="submit" class="btn btn-primary" name="btn-save">
                <span class="glyphicon glyphicon-plus"></span> Create New Record
            </button>  
            <a href="listtamu.php" class="btn btn-large btn-success"><i class="glyphicon glyphicon-backward"></i> &nbsp; Back to index</a>
        </div>

    </form>
     
     
</div>

<?php include_once 'footer.php'; ?>