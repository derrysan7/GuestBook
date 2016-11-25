<?php

class crud
{
 private $db; 
 
 function __construct($DB_con)
 {
  $this->db = $DB_con;
 }
 
 
 public function getID($id)
 {
  $stmt = $this->db->prepare("SELECT * FROM berita WHERE id=:id");
  $stmt->execute(array(":id"=>$id));
  $editRow=$stmt->fetch(PDO::FETCH_ASSOC);
  return $editRow;
 }

  public function getID_kegiatan($id)
 {
  $stmt = $this->db->prepare("SELECT * FROM kegiatan WHERE id=:id");
  $stmt->execute(array(":id"=>$id));
  $editRow=$stmt->fetch(PDO::FETCH_ASSOC);
  return $editRow;
 }
 
 /* paging */
 
 public function dataview($query)
 {
  $stmt = $this->db->prepare($query);
  $stmt->execute();
 
  if($stmt->rowCount()>0)
  {
   while($row=$stmt->fetch(PDO::FETCH_ASSOC))
   {
    
    ?>
                <tr>
                <td><?php print($row['id']); ?></td>
                <td><?php print($row['tanggaldib']); ?></td>
                <td><?php print($row['judul']); ?></td>
                <td><?php print($row['namapen']); ?></td>
                <td align="center">
                <a href="edit-berita.php?edit_id=<?php print($row['id']); ?>"><i class="glyphicon glyphicon-edit"></i></a>
                </td>
                <td align="center">
                <a href="delete-berita.php?delete_id=<?php print($row['id']); ?>"><i class="glyphicon glyphicon-remove-circle"></i></a>
                </td>
                </tr>
                <?php
   }
  }
  else
  {
   ?>
            <tr>
            <td>Nothing here...</td>
            </tr>
            <?php
  }
  
 }

 
 public function getID_carousel($id)
 {
  $stmt = $this->db->prepare("SELECT * FROM berita_carousel WHERE id=:id");
  $stmt->execute(array(":id"=>$id));
  $editRow=$stmt->fetch(PDO::FETCH_ASSOC);
  return $editRow;
 }
 
 public function dataview_carousel($query)
 {
  $stmt = $this->db->prepare($query);
  $stmt->execute();
 
  if($stmt->rowCount()>0)
  {
   while($row=$stmt->fetch(PDO::FETCH_ASSOC))
   {
    
    ?>
                <tr>
                <td><?php print($row['id']); ?></td>
                <td><?php print($row['judul']); ?></td>
                <td><?php print($row['deskripsi']); ?></td>
                <td><?php print($row['gambar']); ?></td>
                <td align="center">
                <a href="edit-berita-carousel.php?edit_id=<?php print($row['id']); ?>"><i class="glyphicon glyphicon-edit"></i></a>
                </td>
                <td align="center">
                <a href="delete-berita-carousel.php?delete_id=<?php print($row['id']); ?>"><i class="glyphicon glyphicon-remove-circle"></i></a>
                </td>
                </tr>
                <?php
   }
  }
  else
  {
   ?>
            <tr>
            <td>Nothing here...</td>
            </tr>
            <?php
  }
  
 }
 
 public function getID_sidelink($id)
 {
  $stmt = $this->db->prepare("SELECT * FROM berita_sidelink WHERE id=:id");
  $stmt->execute(array(":id"=>$id));
  $editRow=$stmt->fetch(PDO::FETCH_ASSOC);
  return $editRow;
 }
 
 
 public function dataview_sidelink($query)
 {
  $stmt = $this->db->prepare($query);
  $stmt->execute();
 
  if($stmt->rowCount()>0)
  {
   while($row=$stmt->fetch(PDO::FETCH_ASSOC))
   {
    
    ?>
                <tr>
                <td><?php print($row['id']); ?></td>
                <td><?php print($row['url']); ?></td>
                <td><?php print($row['gambar']); ?></td>
                <td align="center">
                <a href="edit-berita-sidelink.php?edit_id=<?php print($row['id']); ?>"><i class="glyphicon glyphicon-edit"></i></a>
                </td>
                <td align="center">
                <a href="delete-berita-sidelink.php?delete_id=<?php print($row['id']); ?>"><i class="glyphicon glyphicon-remove-circle"></i></a>
                </td>
                </tr>
                <?php
   }
  }
  else
  {
   ?>
            <tr>
            <td>Nothing here...</td>
            </tr>
            <?php
  }
  
 }


public function dataviewhomeberita($query)
 {
  $stmt = $this->db->prepare($query);
  $stmt->execute();
 
  if($stmt->rowCount()>0)
  {
   while($row=$stmt->fetch(PDO::FETCH_ASSOC))
   {
    
    ?>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div>
                    <a href="detailberita.php?detail_id=<?php print($row['id']); ?>"><h3><?php print($row['judul']); ?></h3></a>
                    </div>
                    <h5> By <?php print($row['namapen']); ?></h5>
                    <h5>Published <?php print($row['tanggaldib']); ?></h5>
                </div>
                <div class="panel-body fixed-panel" >
                    <div class="float-left">
                          <img class="" src="user_images/<?php echo ($row['gambar']) ?>" style="width:150px;padding-bottom: 15px;" />
                    </div>
                    <div class="col-md-9 module fadecustom"><p> <?php print($row['deskripsi']); ?></p>
                    </div>
                </div>
            </div>
                <?php
   }
  }
  else
  {
   ?>
            
            <p>Nothing here...</p>
            <?php
  }
  
 }

 public function dataviewhomesidelink($query)
 {
  $isFirst = true;
  $stmt = $this->db->prepare($query);
  $stmt->execute();
 
  if($stmt->rowCount()>0)
  {
   while($row=$stmt->fetch(PDO::FETCH_ASSOC))
   if ($isFirst == true){
    
    ?>

     <div class="btn btn-info w3-card-4">
          <a href="<?php echo ($row['url']) ?>">
          <img src="user_images_berita_sidelink/<?php echo ($row['gambar']) ?>" class="float-left"/>
          </a>
      </div>
      <br/><br/>
    <?php
    $isFirst = false;
    } else {        
    ?>
      <div class="btn btn-warning w3-card-4" >
          <a href="<?php echo ($row['url']) ?>">
          <img src="user_images_berita_sidelink/<?php echo ($row['gambar']) ?>" class="float-left"/>
          </a>
      </div>
      <br/><br/>
    <?php
    $isFirst = true;
    }
  }
  else
  {
    ?>
            
            <p>Nothing here...</p>
            <?php
  }
  
 }

 public function dataviewhomecarousel($query)
 {
  $isFirst = true;
  $stmt = $this->db->prepare($query);
  $stmt->execute();
 
  if($stmt->rowCount()>0)
  {
 
   while($row=$stmt->fetch(PDO::FETCH_ASSOC))
    if ($isFirst == true){
    ?>
        <div class="item active" style="background-size: cover;">
        <img src="user_images_berita_carousel/<?php echo ($row['gambar']) ?>" alt="pic">
      </div>
    <?php
    $isFirst = false;
    } else {        
    ?>
       <div class="item" style="background-size: cover;">
        <img src="user_images_berita_carousel/<?php echo ($row['gambar']) ?>" alt="pic">
      </div>     
           
    <?php
    }

  }
  else
  {
    ?>
            
            <p>Nothing here...</p>
            <?php
  }
  
 }

 public function dataviewkegiatanlistkegiatan($query)
 {
  $stmt = $this->db->prepare($query);
  $stmt->execute();
 
  if($stmt->rowCount()>0)
  {
   while($row=$stmt->fetch(PDO::FETCH_ASSOC))
   {
    
    ?>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div>
                    <a href="detailkegiatan.php?detail_id=<?php print($row['id']); ?>"><h3><?php print($row['judul']); ?></h3></a>
                    </div>
                    <h5> By <?php print($row['namapen']); ?></h5>
                    <h5>Published <?php print($row['tanggaldib']); ?></h5>
                </div>
                <div class="panel-body fixed-panel" >
                    <div class="float-left">
                        <img class="float responsive" src="user_images_kegiatan/<?php echo ($row['gambar']) ?>" style="width:150px;padding-bottom: 15px;" />
                    </div>
                    <div class="col-md-9 module fadecustom"><p> <?php print($row['deskripsi']); ?></p>
                    </div>
                </div>
            </div>
                <?php
   }
  }
  else
  {
   ?>
            
            <p>Nothing here...</p>
            <?php
  }
  
 }

 
 public function paging($query,$records_per_page)
 {
  $starting_position=0;
  if(isset($_GET["page_no"]))
  {
   $starting_position=($_GET["page_no"]-1)*$records_per_page;
  }
  $query2=$query." limit $starting_position,$records_per_page";
  return $query2;
 }
 
 public function paginglink($query,$records_per_page)
 {
  
  $self = $_SERVER['PHP_SELF'];
  
  $stmt = $this->db->prepare($query);
  $stmt->execute();
  
  $total_no_of_records = $stmt->rowCount();
  
  if($total_no_of_records > 0)
  {
   ?><ul class="pagination"><?php
   $total_no_of_pages=ceil($total_no_of_records/$records_per_page);
   $current_page=1;
     if(isset($_GET["page_no"]))
     {
      $current_page=$_GET["page_no"];
     }
     if($current_page!=1)
     {
      $previous =$current_page-1;
      echo "<li><a href='".$self."?page_no=1'>First</a></li>";
      echo "<li><a href='".$self."?page_no=".$previous."'>Previous</a></li>";
     }
   for($i=1;$i<=$total_no_of_pages;$i++)
   {
      if($i==$current_page)
      {
       echo "<li><a href='".$self."?page_no=".$i."' style='color:red;'>".$i."</a></li>";
      }
      else
      {
       echo "<li><a href='".$self."?page_no=".$i."'>".$i."</a></li>";
      }
   }
     if($current_page!=$total_no_of_pages)
     {
      $next=$current_page+1;
      echo "<li><a href='".$self."?page_no=".$next."'>Next</a></li>";
      echo "<li><a href='".$self."?page_no=".$total_no_of_pages."'>Last</a></li>";
     }
   ?></ul><?php
  }
 }
 
 /* paging */
 
}