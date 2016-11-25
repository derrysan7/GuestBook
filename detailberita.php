<?php
  require_once("sessionview.php");
?>
<?php
include_once 'dbconfigcrud.php';
include_once 'class.crud.view.php';

$page=1; include_once 'header2.php';

if(isset($_GET['detail_id']))
{
 $id = $_GET['detail_id'];
 extract($crud->getID($id)); 
}

?>
<link rel="stylesheet" href="homeberita.css" type="text/css"/>

<div class="clearfix"></div><br />

<div style="height:auto;background-color:white;margin-top:-22px;">    
<div class="container">
    <div class ="col-md-8" style="margin-bottom:50px;margin-top:70px;">
        <h1><?php echo $judul ?></h1>
        <h5>Posted on <?php echo $tanggaldib ?></h5>
        <h5>By <?php echo $namapen ?></h5>
        <br>
            
            <?php
            if ($gambar != 'placeholder.png'){ ?>
            <p>
            <img src="user_images/<?php echo $gambar; ?>" style="width: 100%;" />
            </p>
            <?php
            }
            ?>
             
        <br>
        <?php echo $deskripsi ?>

    </div>
  
</div>

<?php include_once 'footer.php'; ?>