<?php
  require_once("session.php");
  require_once("permvalidcontent.php");
?>
<?php
include_once 'dbconfigcrud.php';
include_once 'class.crud.struktur.php';

$crud = new crud($DB_con);
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
            <h1 align="center">Susunan Pengurus HMSI</h1>
            <h2>Badan Pengurus Harian</h2>
            <a href="add-struktur.php" class="btn btn-large btn-success"><i class="glyphicon glyphicon-plus"></i> &nbsp; Add Records</a>
          </div>

          <div class="clearfix"></div><br />

          <div class="container">
                <table class='table table-bordered table-responsive'>
                     <tr>
                     <th class="col-sm-1">#</th>
                     <th class="col-sm-1">Urutan</th>
                     <th class="col-sm-4">Nama</th>
                     <th class="col-sm-2">Divisi</th>
                     <th class="col-sm-2">Jabatan</th>
                     <th colspan="2" align="center" class="col-sm-1">Actions</th>
                     </tr>
                     <?php
                  $query = "SELECT * FROM struktur WHERE divisi_ang = 'Badan Pengurus Harian' ORDER BY urutan";       
                  $crud->dataview($query);
                  ?>
                 
                </table>                         
          </div>

          <div class="container">
            <h2>Sosial Kemahasiswaan</h2>
            <a href="add-struktur.php" class="btn btn-large btn-success"><i class="glyphicon glyphicon-plus"></i> &nbsp; Add Records</a>
          </div>

          <div class="clearfix"></div><br />

          <div class="container">
                <table class='table table-bordered table-responsive'>
                     <tr>
                     <th class="col-sm-1">#</th>
                     <th class="col-sm-1">Urutan</th>
                     <th class="col-sm-4">Nama</th>
                     <th class="col-sm-2">Divisi</th>
                     <th class="col-sm-2">Jabatan</th>
                     <th colspan="2" align="center" class="col-sm-1">Actions</th>
                     </tr>
                     <?php
                  $query = "SELECT * FROM struktur WHERE divisi_ang = 'Sosial Kemahasiswaan' ORDER BY urutan";       
                  $crud->dataview($query);
                  ?>
                 
                </table>                         
          </div>

          <div class="container">
            <h2>Humas</h2>
            <a href="add-struktur.php" class="btn btn-large btn-success"><i class="glyphicon glyphicon-plus"></i> &nbsp; Add Records</a>
          </div>

          <div class="clearfix"></div><br />

          <div class="container">
                <table class='table table-bordered table-responsive'>
                     <tr>
                     <th class="col-sm-1">#</th>
                     <th class="col-sm-1">Urutan</th>
                     <th class="col-sm-4">Nama</th>
                     <th class="col-sm-2">Divisi</th>
                     <th class="col-sm-2">Jabatan</th>
                     <th colspan="2" align="center" class="col-sm-1">Actions</th>
                     </tr>
                     <?php
                  $query = "SELECT * FROM struktur WHERE divisi_ang = 'Humas' ORDER BY urutan";       
                  $crud->dataview($query);
                  ?>
                 
                </table>                         
          </div>

          <div class="container">
            <h2>Riset dan Inovasi</h2>
            <a href="add-struktur.php" class="btn btn-large btn-success"><i class="glyphicon glyphicon-plus"></i> &nbsp; Add Records</a>
          </div>

          <div class="clearfix"></div><br />

          <div class="container">
                <table class='table table-bordered table-responsive'>
                     <tr>
                     <th class="col-sm-1">#</th>
                     <th class="col-sm-1">Urutan</th>
                     <th class="col-sm-4">Nama</th>
                     <th class="col-sm-2">Divisi</th>
                     <th class="col-sm-2">Jabatan</th>
                     <th colspan="2" align="center" class="col-sm-1">Actions</th>
                     </tr>
                     <?php
                  $query = "SELECT * FROM struktur WHERE divisi_ang = 'Riset dan Inovasi' ORDER BY urutan";       
                  $crud->dataview($query);
                  ?>
                 
                </table>                         
          </div>

          <div class="container">
            <h2>Pendidikan</h2>
            <a href="add-struktur.php" class="btn btn-large btn-success"><i class="glyphicon glyphicon-plus"></i> &nbsp; Add Records</a>
          </div>

          <div class="clearfix"></div><br />

          <div class="container">
                <table class='table table-bordered table-responsive'>
                     <tr>
                     <th class="col-sm-1">#</th>
                     <th class="col-sm-1">Urutan</th>
                     <th class="col-sm-4">Nama</th>
                     <th class="col-sm-2">Divisi</th>
                     <th class="col-sm-2">Jabatan</th>
                     <th colspan="2" align="center" class="col-sm-1">Actions</th>
                     </tr>
                     <?php
                  $query = "SELECT * FROM struktur WHERE divisi_ang = 'Pendidikan' ORDER BY urutan";       
                  $crud->dataview($query);
                  ?>
                 
                </table>                         
          </div>
    </div>
  </div>
</div>



<?php include_once 'footer.php'; ?>