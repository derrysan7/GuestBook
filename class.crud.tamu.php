<?php

class crud
{
 private $db; 
 
 function __construct($DB_con)
 {
  $this->db = $DB_con;
 }
 
 public function create($tuserid,$tusernamepenulis,$tnama,$temail,$talamat,$tucapan)
 {
  try
  {
   $stmt = $this->db->prepare("INSERT INTO tamu(userId,usernamepenulis,tamuNama,tamuEmail,tamuAlamat,tamuUcapan) 
                                                   VALUES(:tuserId,:tusernamepenulis,:ttamuNama,:ttamuEmail,:ttamuAlamat,:ttamuUcapan)");
   $stmt->bindparam(":tuserId", $tuserid);
   $stmt->bindparam(":tusernamepenulis", $tusernamepenulis);
   $stmt->bindparam(":ttamuNama", $tnama);
   $stmt->bindparam(":ttamuEmail", $temail);
   $stmt->bindparam(":ttamuAlamat", $talamat);
   $stmt->bindparam(":ttamuUcapan", $tucapan);
   $stmt->execute();
   return true;
  }
  catch(PDOException $e)
  {
   echo $e->getMessage(); 
   return false;
  }
  
 }
 
 public function getID($id)
 {
  $stmt = $this->db->prepare("SELECT * FROM tamu WHERE id=:id");
  $stmt->execute(array(":id"=>$id));
  $editRow=$stmt->fetch(PDO::FETCH_ASSOC);
  return $editRow;
 }
 
 public function update($id,$tnama,$temail,$talamat,$tucapan)
 {
  try
  {
   $stmt=$this->db->prepare("UPDATE tamu SET tamuNama=:ttamuNama,  
                                              tamuEmail=:ttamuEmail,
                                              tamuAlamat=:ttamuAlamat,
                                              tamuUcapan=:ttamuUcapan
             WHERE id=:id ");
   $stmt->bindparam(":id",$id);
   $stmt->bindparam(":ttamuNama", $tnama);
   $stmt->bindparam(":ttamuEmail", $temail);
   $stmt->bindparam(":ttamuAlamat", $talamat);
   $stmt->bindparam(":ttamuUcapan", $tucapan);
   $stmt->execute();
   
   return true; 
  }
  catch(PDOException $e)
  {
   echo $e->getMessage(); 
   return false;
  }
 }
 
 public function delete($id)
 {
  $stmt = $this->db->prepare("DELETE FROM tamu WHERE id=:id");
  $stmt->bindparam(":id",$id);
  $stmt->execute();
  return true;
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
                <td><?php print($row['usernamepenulis']); ?></td>
                <td><?php print($row['tamuNama']); ?></td>
                <td><?php print($row['tamuEmail']); ?></td>
                <td><?php print($row['tamuAlamat']); ?></td>
                <td align="center">
                <a href="edit-tamu.php?edit_id=<?php print($row['id']); ?>"><i class="glyphicon glyphicon-edit"></i></a>
                </td>
                <td align="center">
                <a href="delete-tamu.php?delete_id=<?php print($row['id']); ?>"><i class="glyphicon glyphicon-remove-circle"></i></a>
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

 public function create_carousel($bjudul,$bdeskripsi,$userpic)
 {
  try
  {
   $stmt = $this->db->prepare("INSERT INTO tamu_carousel(judul,deskripsi,gambar) 
                                                   VALUES(:bjudul,:bdeskripsi,:bgambar)");
   $stmt->bindparam(":bjudul", $bjudul);
   $stmt->bindparam(":bdeskripsi", $bdeskripsi);
   $stmt->bindparam(":bgambar", $userpic);
   $stmt->execute();
   return true;
  }
  catch(PDOException $e)
  {
   echo $e->getMessage(); 
   return false;
  }
  
 }
 
 public function getID_carousel($id)
 {
  $stmt = $this->db->prepare("SELECT * FROM tamu_carousel WHERE id=:id");
  $stmt->execute(array(":id"=>$id));
  $editRow=$stmt->fetch(PDO::FETCH_ASSOC);
  return $editRow;
 }
 
 public function update_carousel($id,$bjudul,$bdeskripsi,$userpic)
 {
  try
  {
   $stmt=$this->db->prepare("UPDATE tamu_carousel SET judul=:bjudul,  
                                              deskripsi=:bdeskripsi,
                                              gambar=:bgambar
             WHERE id=:id ");
   $stmt->bindparam(":id",$id);
   $stmt->bindparam(":bjudul", $bjudul);
   $stmt->bindparam(":bdeskripsi", $bdeskripsi);
   $stmt->bindparam(":bgambar", $userpic);
   $stmt->execute();
   
   return true; 
  }
  catch(PDOException $e)
  {
   echo $e->getMessage(); 
   return false;
  }
 }
 
 public function delete_carousel($id)
 {
  $stmt = $this->db->prepare("DELETE FROM tamu_carousel WHERE id=:id");
  $stmt->bindparam(":id",$id);
  $stmt->execute();
  return true;
 }
 
 /* paging */
 
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
                <a href="edit-tamu-carousel.php?edit_id=<?php print($row['id']); ?>"><i class="glyphicon glyphicon-edit"></i></a>
                </td>
                <td align="center">
                <a href="delete-tamu-carousel.php?delete_id=<?php print($row['id']); ?>"><i class="glyphicon glyphicon-remove-circle"></i></a>
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

  public function create_sidelink($burl,$userpic)
 {
  try
  {
   $stmt = $this->db->prepare("INSERT INTO tamu_sidelink(url,gambar) 
                                                   VALUES(:burl,:bgambar)");
   $stmt->bindparam(":burl", $burl);
   $stmt->bindparam(":bgambar", $userpic);
   $stmt->execute();
   return true;
  }
  catch(PDOException $e)
  {
   echo $e->getMessage(); 
   return false;
  }
  
 }
 
 public function getID_sidelink($id)
 {
  $stmt = $this->db->prepare("SELECT * FROM tamu_sidelink WHERE id=:id");
  $stmt->execute(array(":id"=>$id));
  $editRow=$stmt->fetch(PDO::FETCH_ASSOC);
  return $editRow;
 }
 
 public function update_sidelink($id,$burl,$userpic)
 {
  try
  {
   $stmt=$this->db->prepare("UPDATE tamu_sidelink SET url=:burl,  
                                              gambar=:bgambar
             WHERE id=:id ");
   $stmt->bindparam(":id",$id);
   $stmt->bindparam(":burl", $burl);
   $stmt->bindparam(":bgambar", $userpic);
   $stmt->execute();
   
   return true; 
  }
  catch(PDOException $e)
  {
   echo $e->getMessage(); 
   return false;
  }
 }
 
 public function delete_sidelink($id)
 {
  $stmt = $this->db->prepare("DELETE FROM tamu_sidelink WHERE id=:id");
  $stmt->bindparam(":id",$id);
  $stmt->execute();
  return true;
 }
 
 /* paging */
 
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
                <a href="edit-tamu-sidelink.php?edit_id=<?php print($row['id']); ?>"><i class="glyphicon glyphicon-edit"></i></a>
                </td>
                <td align="center">
                <a href="delete-tamu-sidelink.php?delete_id=<?php print($row['id']); ?>"><i class="glyphicon glyphicon-remove-circle"></i></a>
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