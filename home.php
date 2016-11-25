<?php
  require_once("sessionview.php");
?>
<?php
include_once 'konversi.php';
include_once 'dbconfigcrud.php';
include_once 'class.crud.view.php';

?>
<?php $page=1; include_once 'header2.php'; ?>
<link rel="stylesheet" href="homeberita.css" type="text/css"/>

    <div class="clearfix"></div>
    	
<div id="divbackground">    
<div class="container-fluid">
	
    <div class="container">
    <br>

        <div class="col-md-8">

        	<?php
              $query = "SELECT * FROM berita ORDER BY tanggaldib DESC";
              $records_per_page=5;
              $newquery = $crud->paging($query,$records_per_page);
              $crud->dataviewhomeberita($newquery);
          ?>
        	<div class="pagination-wrap">
                <?php $crud->paginglink($query,$records_per_page); ?>
          </div>

        </div>
        <div class="col-md-4" style="padding-bottom:30px;">
          <div style="width:100%;  display:inline-block;">
              <div class="monthly" id="mycalendar"></div>
          </div>
        </div>
        <div class="col-md-4">
          <?php
              $query = "SELECT * FROM berita_sidelink";
              $crud->dataviewhomesidelink($query);
          ?>
        </div>

    </div>

</div>
</div>

<?php include_once 'footer.php'; ?>