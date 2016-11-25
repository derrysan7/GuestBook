<?php
  require_once("session.php");
  require_once("permvalidcontent.php");
?>
<?php
include_once 'dbconfigcrud.php';
include_once 'class.crud.berita.php';

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
            <div class="row">
              <div class="col-sm-8 bagancustom">
                <a href="edit-bagan.php?edit_id=1" role="button" class="btn btn-default btn-lg btn-block">Bagan Organisasi</a>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-8 anggotacustom">
                <a href="liststruktur.php" role="button" class="btn btn-default btn-lg btn-block">Anggota Organisasi</a>
              </div>
            </div>
        </div>
    </div>
  </div>
</div>



<?php include_once 'footer.php'; ?>