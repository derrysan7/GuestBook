<?php

class crud
{
 private $db;

 function __construct($DB_con)
 {
  $this->db = $DB_con;
 }

 public function create($name,$startdate,$enddate,$starttime,
 $endtime,$color,$url)
 {
  try
  {
   $stmt = $this->db->prepare("INSERT INTO `kalender`(`name`, `startdate`,
     `enddate`, `starttime`, `endtime`, `color`, `url`)
      VALUES(:name,:startdate,:enddate,:starttime,:endtime,:color,:url)");
   $stmt->bindparam(":name", $name);
   $stmt->bindparam(":startdate", $startdate);
   $stmt->bindparam(":enddate", $enddate);
   $stmt->bindparam(":starttime", $starttime);
   $stmt->bindparam(":endtime", $endtime);
   $stmt->bindparam(":color", $color);
   $stmt->bindparam(":url", $url);
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
  $stmt = $this->db->prepare("SELECT * FROM kalender WHERE id=:id");
  $stmt->execute(array(":id"=>$id));
  $editRow=$stmt->fetch(PDO::FETCH_ASSOC);
  return $editRow;
 }



 public function update($id,$name,$startdate,$enddate,$starttime,
 $endtime,$color,$url)
 {
  try
  {
   $stmt=$this->db->prepare("UPDATE kalender SET name=:name,
                                              startdate=:startdate,
                                              enddate=:enddate,
                                              starttime=:starttime,
                                              endtime=:endtime,
                                              color=:color,
                                              url=:url
             WHERE id=:id ");
   $stmt->bindparam(":id",$id);
   $stmt->bindparam(":name", $name);
   $stmt->bindparam(":startdate", $startdate);
   $stmt->bindparam(":enddate", $enddate);
   $stmt->bindparam(":starttime", $starttime);
   $stmt->bindparam(":endtime", $endtime);
   $stmt->bindparam(":color", $color);
   $stmt->bindparam(":url", $url);
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
  $stmt = $this->db->prepare("DELETE FROM kalender WHERE id=:id");
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
                <td><?php print($row['id']); ?></td>
                <td><?php print($row['name']); ?></td>
                <td><?php print($row['startdate']); ?></td>
                <td><?php print($row['enddate']); ?></td>
                <td><?php print($row['starttime']); ?></td>
                <td><?php print($row['endtime']); ?></td>
                <td><?php print($row['color']); ?></td>
                <td width="10"><?php print($row['url']); ?></td>
                <td align="center">
                <a href="edit-event.php?edit_id=<?php print($row['id']); ?>"><i class="glyphicon glyphicon-edit"></i></a>
                </td>
                <td align="center">
                <a href="delete-event.php?delete_id=<?php print($row['id']); ?>"><i class="glyphicon glyphicon-remove-circle"></i></a>
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
