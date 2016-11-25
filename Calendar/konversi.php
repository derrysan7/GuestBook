<?php
//Koneksi database MySQL
$koneksi = mysqli_connect("localhost","adminhmsi","12345","dbtest")
    or die("Error ".mysqli_error($koneksi));
//Mengambil data pada table dari database MySQL
$sql = "select * from kalender";
$result = mysqli_query($koneksi, $sql)
    or die("Error in Selecting " . mysqli_error($koneksi));
//Membuat array
$eventhmsi = array();
while($row =mysqli_fetch_assoc($result))
{
  $eventhmsi[] = $row;
}

$jsontext='{"monthly":'.json_encode($eventhmsi,JSON_PRETTY_PRINT)."}";


//write to json file
    $fp = fopen('events.json', 'w');
    // print_r( $eventhmsi);
    fwrite($fp, $jsontext);
    fclose($fp);

//close the db connection
mysqli_close($koneksi);
?>
