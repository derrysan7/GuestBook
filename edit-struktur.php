<?php
  require_once("session.php");
  require_once("permvalidcontent.php");
?>
<?php
include_once 'dbconfigcrud.php';
include_once 'class.crud.struktur.php';

$crud = new crud($DB_con);

if(isset($_POST['btn-update']))
{
    $id = $_GET['edit_id'];
    extract($crud->getID($id));
    $burutan = $_POST['txt_urutan'];
    $bnama_ang = $_POST['txt_namaang'];
    $bjabatan_ang = $_POST['txt_jabatanang'];
    $imgFile = $_FILES['user_image']['name'];
    $tmp_dir = $_FILES['user_image']['tmp_name'];
    $imgSize = $_FILES['user_image']['size'];

        if($imgFile)
    {
        $upload_dir = 'user_images_struktur/'; // upload directory   
        $imgExt = strtolower(pathinfo($imgFile,PATHINFO_EXTENSION)); // get image extension
        $valid_extensions = array('jpeg', 'jpg', 'png', 'gif'); // valid extensions
        $userpic = rand(1000,1000000).".".$imgExt;
        if(in_array($imgExt, $valid_extensions))
        {           
            if($imgSize < 5000000)
            {
                unlink($upload_dir.$gambar);
                move_uploaded_file($tmp_dir,$upload_dir.$userpic);
            }
            else
            {
                $errMSG = "Sorry, your file is too large it should be less then 5MB";
            }
        }
        else
        {
            $errMSG = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";        
        }   
    }
    else
    {
        // if no image selected the old image remain as it is.
        $userpic = $gambar; // old image from database
    } 

    if(!isset($errMSG))
    {
         if($crud->update($id,$burutan,$bnama_ang,$bjabatan_ang,$userpic))
         {
          $msg = "<div class='alert alert-info'>
            <strong>Success!</strong> Record was updated successfully <a href='liststruktur.php'>HOME</a>!
            </div>";
         }
         else
         {
          $msg = "<div class='alert alert-warning'>
            <strong>Failed!</strong> ERROR while updating record !
            </div>";
         }
    }
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
  
     <form method="post" enctype="multipart/form-data">

            <div class="col-xs-8">
                <label>Urutan</label>          
                <input type='text' name='txt_urutan' class='form-control' value="<?php echo $urutan ?>" required>
            </div>

            <div class="col-xs-8">
                <label>Foto Anggota (JPEG, JPG, PNG, GIF)</label>
                <p><img src="user_images_struktur/<?php echo $gambar; ?>" height="150" width="150" /></p>          
                <input class="input-group" type="file" name="user_image" accept="image/*" />
            </div>

            <div class="col-xs-8">
                <label>Nama Anggota</label>          
                <input type='text' name='txt_namaang' class='form-control' value="<?php echo $nama_ang ?>" required>
            </div>
            

            <div class="col-xs-8">
                <label>Jabatan Anggota</label>
                <br>
                <input type='text' name='txt_jabatanang' class='form-control' value="<?php echo $jabatan_ang ?>" required>
            </div>
            <br>
            <div class="col-xs-8">
                <button type="submit" class="btn btn-primary" name="btn-update">
                <span class="glyphicon glyphicon-edit"></span>  Update this Record
                </button>
                <a href="liststruktur.php" class="btn btn-large btn-success"><i class="glyphicon glyphicon-backward"></i> &nbsp; CANCEL</a>
            </div>
 
</form>
     
     
</div>

<?php include_once 'footer.php'; ?>