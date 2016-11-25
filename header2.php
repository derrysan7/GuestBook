<?php
	require_once("class.user.php");
	$auth_user = new USER();

  include_once 'dbconfigcrud.php';
  include_once 'class.crud.view.php';

  $crud = new crud($DB_con);

  error_reporting(0);

  if ($_SESSION['user_session']!=""){
      $userId = $_SESSION['user_session'];
      
      $stmt = $auth_user->runQuery("SELECT * FROM users WHERE userId=:userId");
      $stmt->execute(array(":userId"=>$userId));
      
      $userRow=$stmt->fetch(PDO::FETCH_ASSOC);
      $viewcrudLabel=$auth_user->crudLabel($userRow['kodePermission']);
      $crudLink=$auth_user->crudLink($userRow['kodePermission']);
      $userinfo="yes";
      $signinbutton="none";
  } else{
      $userinfo="none";
      $signinbutton="yes";
  }

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>HMSI UKDW</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- <meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> -->
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet"> 
    <link href="css/font-face.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="http://www.w3schools.com/lib/w3.css">
    <!-- Carousel -->
    <link rel="stylesheet" href="css/carousel.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="js/monthly.js"></script>
    <script type="text/javascript" src="js/script.js"></script>

    <link rel="stylesheet" href="css/monthly.css">
    <link rel="stylesheet" href="style.css" type="text/css"  />

    <!-- JS -->
    <script type="text/javascript">
      $(document).ready(function() {
        $('.carousel').carousel({interval: 4000});
      });
      $(document).ready(function($){
      var nav = $('#mainNav');
          $(window).scroll(function () {
              if ($(this).scrollTop() > 620) {
                  nav.addClass("f-nav");
              } else {
                  nav.removeClass("f-nav");
              }
          });
      });
      $("#myCarousel").carousel();
    </script>
    <style>
      body,
      html {
        height: 100%;
      }
      
      .f-nav {
        z-index: 9999;
        position: fixed;
        left: 0;
        top: 0;
        width: 100%;
      }
      
      a:hover {
        text-decoration: none;
      }
    </style>
</head>

<body>

          <div id="myCarousel" class="carousel" data-ride="carousel">
              <div class="carousel-inner" role="listbox">
                  <?php
                      $query = "SELECT * FROM berita_carousel";
                      $crud->dataviewhomecarousel($query);
                  ?>
              </div>
          </div>
                  <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
                    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                  </a>
                  <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
                    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                  </a>
          

        <div class="w3-container">
          <a href="home.php">
            <img src="imagenav/logoHMSI.png" class="img-responsive" alt="logoHMSI" style="width:150px;height:150px;margin:auto">
            <div style="color:black;font-weight:bold">
              <h1>Himpunan Mahasiswa Sistem Informasi</h1>
              <h4>Universitas Kristen Duta Wacana</h4>
            </div>
          </a>

        </div>

<div id="mainNav">
    <nav class="navbar navbar-inverse" style="border-radius:0; text-align: center; margin-bottom:0px;">
    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
    </button>
    <a class="navbar-brand visible-xs" href="http://www.ukdw.ac.id">HMSI UKDW</a>
      <div class="container-fluid navbar-collapse collapse" id="navbar">
        
        <!--EMPTY-->
        <div class="col-md-2">
          &nbsp;
        </div>
        
        <!--HOME-->
        <div class="navbar-header col-md-2">
          <ul class="nav navbar-nav">
            <li class="<?php if ($page == '1'){ echo 'active'; } ?>"><a href="home.php">HOME</a></li>
        </div>
        
        <!--KEGIATAN-->
        <ul class="nav navbar-nav  col-md-2">
          <li class="<?php if ($page == '2'){ echo 'active'; } ?>"><a href="kegiatan.php">KEGIATAN</a></li>
        </ul>
        <div class="navbar-header col-md-2">
          <ul class="nav navbar-nav">
            <li class="dropdown">
              <a class="dropdown-toggle" data-toggle="dropdown" href="#">ABOUT<span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="visimisi.php">VISI & MISI</a></li>
                <li><a href="struktur.php">STRUKTUR ORGANISASI</a></li>
              </ul>
            </li>
        </div>
        
        <!--CONTACT-->
        <div class="navbar-header col-md-2">
          <ul class="nav navbar-nav">
            <li class="<?php if ($page == '5'){ echo 'active'; } ?>"><a href="kontak.php">CONTACT US</a></li>
          </ul>
        </div>
        
        <!--ADMIN-->
         <div class="col-md-2">
           <ul class="nav navbar-nav navbar-right" style="display:<?php echo $userinfo ?>;">
            <li class="dropdown">
              <a class="dropdown-toggle" data-toggle="dropdown" href="#"> 
                  <?php echo $userRow['userEmail']; ?>
                  <span class="glyphicon glyphicon-cog">
              </a>
              <ul class="dropdown-menu">
                <li><a href="<?php echo $crudLink ?>"><?php echo $viewcrudLabel ?></a></li>
                <li><a href="logout.php?logout=true">LOG OUT</a></li>
              </ul>
            </li>
          </ul>
        </div>
      </div>
    </nav>
  </div>
