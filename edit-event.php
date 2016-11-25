<?php
require_once("session.php");
require_once("permvalidcontent.php");
?>
<?php
include_once 'dbconfigcrud.php';
include_once 'class.crud.event.php';

$crud = new crud($DB_con);

if(isset($_POST['btn-update']))
{
  $id = $_GET['edit_id'];
  $name = $_POST['txt_name'];
  $startdate = $_POST['dt_start'];
  $enddate = $_POST['dt_end'];
  $starttime = $_POST['tm_start'];
  $endtime = $_POST['tm_end'];
  $color = $_POST['label_color'];
  $url = $_POST['txt_url'];
  //break
  // if (!empty($imgFile)) {
  //
  //         $upload_dir = 'user_images/'; // upload directory
  //
  //         $imgExt = strtolower(pathinfo($imgFile,PATHINFO_EXTENSION)); // get image extension
  //
  //         // valid image extensions
  //         $valid_extensions = array('jpeg', 'jpg', 'png', 'gif'); // valid extensions
  //
  //         // rename uploading image using random generator
  //         $userpic = rand(1000,1000000).".".$imgExt;
  //
  //         // allow valid image file formats
  //         if(in_array($imgExt, $valid_extensions)){
  //             // Check file size '5MB'
  //             if($imgSize < 5000000)              {
  //                 move_uploaded_file($tmp_dir,$upload_dir.$userpic);
  //             }
  //             else{
  //                 $errMSG = "Sorry, your file is too large.";
  //             }
  //         }
  //         else{
  //             $errMSG = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
  //         }
  //
  // }
  //
  if(!isset($errMSG))
  {
      if($crud->update($id,$name,$startdate,$enddate,$starttime,$endtime,$color,$url))
      {
        $msg = "<div class='alert alert-info'>
          <strong>Success!</strong> Record was updated successfully <a href='listevent.php'>HOME</a>!
          </div>";
       }
       else
       {
        $msg = "<div class='alert alert-warning'>
          <strong>Failed!</strong> ERROR while updating record !
          </div>";
      }
  }
  //break
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
      <span class="glyphicon glyphicon-info-sign"></span> <strong><?php echo $errMSG; ?></strong>
    </div>
    <?php
  }
  ?>

  <form method="post" enctype="multipart/form-data">

    <div class="col-xs-8">
      <label>Event</label>
      <input type='text' name='txt_name' class='form-control' value="<?php echo $name?>" required>
    </div>

    <div class="col-md-12">
      <div class="col-md-4">
        <label>Date Start</label>
        <input type='date' name='dt_start' class='form-control' value="<?php echo $startdate?>" required>
      </div>
      <div class="col-md-4">
        <label>Date End</label>
        <input type='date' name='dt_end' class='form-control' value="<?php echo $enddate?>" required>
      </div>
    </div>

    <div class="col-md-12">
      <div class="col-md-4">
        <label>Time Start</label>
        <input type='time' name='tm_start' class='form-control' value="<?php echo $starttime?>" required>
      </div>
      <div class="col-md-4">
        <label>Time End</label>
        <input type='time' name='tm_end' class='form-control' value="<?php echo $endtime?>" >
      </div>
    </div>

    <div class="col-xs-8">
      <label>Select label color </label>
      <input class="input-group" type="color" name="label_color" value="<?php echo $color?>"/>
    </div>

    <div class="col-xs-8">
      <label>URL</label>
      <input type='text' name='txt_url' class='form-control' value="<?php echo $url?>">
    </div>

    <div class="col-xs-8">
      <button type="submit" class="btn btn-primary" name="btn-update">
        <span class="glyphicon glyphicon-plus"></span> Update Event
      </button>
      <a href="listevent.php" class="btn btn-large btn-success">
        <i class="glyphicon glyphicon-backward"></i> &nbsp; Back to index</a>
    </div>


  </form>


</div>

<?php include_once 'footer.php'; ?>