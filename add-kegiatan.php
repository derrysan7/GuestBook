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
include_once 'class.crud.kegiatan.php';

$crud = new crud($DB_con);

if(isset($_POST['btn-save']))
{
    $buserid = $_POST['txt_userid'];
    $bjudul = $_POST['txt_judul'];
    $bdeskripsi = $_POST['txt_deskripsi'];
    $bnamapen = $_POST['txt_namapen'];

    $imgFile = $_FILES['user_image']['name'];
    $tmp_dir = $_FILES['user_image']['tmp_name'];
    $imgSize = $_FILES['user_image']['size'];

    if (!empty($imgFile)) {

        $upload_dir = 'user_images_kegiatan/'; // upload directory

        $imgExt = strtolower(pathinfo($imgFile,PATHINFO_EXTENSION)); // get image extension
    
        // valid image extensions
        $valid_extensions = array('jpeg', 'jpg', 'png', 'gif'); // valid extensions
    
        // rename uploading image using random generator
        $userpic = rand(1000,1000000).".".$imgExt;
            
        // allow valid image file formats
        if(in_array($imgExt, $valid_extensions)){           
            // Check file size '5MB'
            if($imgSize < 5000000)              {
                move_uploaded_file($tmp_dir,$upload_dir.$userpic);
            }
            else{
                $errMSG = "Sorry, your file is too large.";
            }
        }
        else{
            $errMSG = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";        
        }
        
    }


    if(!isset($errMSG))
    {
        if($crud->create($buserid,$bjudul,$bdeskripsi,$userpic,$bnamapen))
        {
        header("Location: add-kegiatan.php?inserted");
        }
        else
        {
        header("Location: add-kegiatan.php?failure");
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
    <strong>SUCCESS!</strong>kegiatan was inserted successfully <a href="listkegiatan.php">HOME</a>!
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
  
    <form method="post" enctype="multipart/form-data">
        <div class="col-xs-8">
            <label>Gambar (JPEG, JPG, PNG, GIF)</label>          
            <input class="input-group" type="file" name="user_image" accept="image/*" />
        </div>

        <div class="col-xs-8">
            <label>Judul</label>          
            <input type='text' name='txt_judul' class='form-control' required>
        </div>

        <div class="col-md-8">
        <label>Deskripsi</label>
        <textarea class="form-control" rows="40"  wrap="hard" cols="80" name="txt_deskripsi" id="deskripsi" name="txt_deskripsi" required></textarea>
        </div>
        
        <div class="col-xs-8">
            <label>Author ID</label>
            <br>
            <input type='text' name='txt_userid' class='form-control' value='<?php echo $userRow['userId'] ?>' readonly>
        </div>

        <div class="col-xs-8">
            <label>Nama Penulis</label>
            <br>
            <input type='text' name='txt_namapen' class='form-control' value='<?php echo $userRow['fullname'] ?>' readonly>
        </div>
        <br>

        <div class="col-xs-8">
            <button type="submit" class="btn btn-primary" name="btn-save">
                <span class="glyphicon glyphicon-plus"></span> Create New Record
            </button>  
            <a href="listkegiatan.php" class="btn btn-large btn-success"><i class="glyphicon glyphicon-backward"></i> &nbsp; Back to index</a>
        </div>

    </form>
     
     
</div>

<?php include_once 'footer.php'; ?>