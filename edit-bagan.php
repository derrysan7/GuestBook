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
    extract($crud->getID_bagan($id));
    $imgFile = $_FILES['user_image']['name'];
    $tmp_dir = $_FILES['user_image']['tmp_name'];
    $imgSize = $_FILES['user_image']['size'];

    if($imgFile)
    {
        $upload_dir = 'user_images_bagan/'; // upload directory   
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
         if($crud->update_bagan($id,$userpic))
         {
          $msg = "<div class='alert alert-info'>
            <strong>Success!</strong> Record was updated successfully</a>!
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
 extract($crud->getID_bagan($id)); 
}

?>
<?php include_once 'header.php'; ?>
<link rel="stylesheet" href="styleberita.css" type="text/css">
<link href="bootstrap/css/navbar-fixed-side.css" rel="stylesheet" />

<div class="clearfix"></div>

<div class="container-fluid">
  <div class="row">
    <div class="col-sm-3 col-lg-2">
      <nav class="navbar navbar-default navbar-fixed-side">
              <ul class="nav navbar-nav">
                  <li>
                    <a href="crud_berita_utama.php">Home</a>
                  </li>
                  <li>
                    <a href="crud_kegiatan_utama.php">Kegiatan</a>
                  </li>
                  <li>
                    <a href="edit-visimisi.php?edit_id=1">Visi dan Misi</a>
                  </li>
                  <li class="active">
                    <a href="crud_struktur_utama.php">Struktur Organisasi</a>
                  </li>
                </ul>
      </nav>
    </div>
    <div class="col-sm-9 col-lg-10">
      <div class="container">
            <?php
            if(isset($msg))
            {
             echo $msg;
            }
            ?>
            </div>

            <div class="clearfix"></div><br />

            <div class="container" style="margin-top: -40px;">

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
                        <h2>Bagan Organisasi</h2>
                        <br>
                            <label>Gambar (JPEG, JPG, PNG, GIF)</label><br>
                            <div class="col-xs-12">
                                <p><img src="user_images_bagan/<?php echo $gambar; ?>" style="width: 100%;" /></p>     
                            </div>     
                            <input class="input-group" type="file" name="user_image" accept="image/*" />
                        </div>
                        <br>
                        <div class="col-xs-8">
                            <button type="submit" class="btn btn-primary" name="btn-update">
                            <span class="glyphicon glyphicon-edit"></span>  Update this Record
                            </button>
                            <a href="crud_struktur_utama.php" class="btn btn-large btn-success"><i class="glyphicon glyphicon-backward"></i> &nbsp; Back to index</a>
                        </div>             
                </form>

            </div>
    </div>
  </div>
</div>

<?php include_once 'footer.php'; ?>