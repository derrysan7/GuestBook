<?php
  require_once("session.php");
  require_once("permvalidcontent.php");
?>
<?php
include_once 'dbconfigcrud.php';
include_once 'class.crud.struktur.php';

$crud = new crud($DB_con);

if(isset($_POST['btn-save']))
{
    $burutan = $_POST['txt_urutan'];
    $bnama_ang = $_POST['txt_namaang'];
    $bdivisi_ang = $_POST['drop_divisi'];
    $bjabatan_ang = $_POST['txt_jabatanang'];

    $imgFile = $_FILES['user_image']['name'];
    $tmp_dir = $_FILES['user_image']['tmp_name'];
    $imgSize = $_FILES['user_image']['size'];

    if (!empty($imgFile)) {

            $upload_dir = 'user_images_struktur/'; // upload directory
    
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
        if($crud->create($burutan,$bnama_ang,$bdivisi_ang,$bjabatan_ang,$userpic))
        {
        header("Location: add-struktur.php?inserted");
        }
        else
        {
        header("Location: add-struktur.php?failure");
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
    <strong>SUCCESS!</strong>Organization Member was inserted successfully <a href="liststruktur.php">HOME</a>!
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
                <label>Urutan</label>          
                <input type='text' name='txt_urutan' class='form-control' required>
            </div>

            <div class="col-xs-8">
                <label>Foto Anggota (JPEG, JPG, PNG, GIF)</label>          
                <input class="input-group" type="file" name="user_image" accept="image/*" />
            </div>

            <div class="col-xs-8">
                <label>Nama</label>          
                <input type='text' name='txt_namaang' class='form-control' required>
            </div>

            <div class="col-xs-8">
                <label>Divisi</label>
                <select class="form-control" name="drop_divisi" required>
                  <option selected disabled>Pilih Divisi</option>
                  <option>Badan Pengurus Harian</option>
                  <option>Sosial Kemahasiswaan</option>
                  <option>Humas</option>
                  <option>Riset dan Inovasi</option>
                  <option>Pendidikan</option>
                 </select>
            </div>

            <div class="col-xs-8">
                <label>Jabatan</label>
                <input type='text' name='txt_jabatanang' class='form-control' required>
            </div>
            <br>

        <div class="col-xs-8">
            <button type="submit" class="btn btn-primary" name="btn-save">
                <span class="glyphicon glyphicon-plus"></span> Create New Record
            </button>  
            <a href="liststruktur.php" class="btn btn-large btn-success"><i class="glyphicon glyphicon-backward"></i> &nbsp; Back to index</a>
        </div>

</form>
     
     
</div>

<?php include_once 'footer.php'; ?>