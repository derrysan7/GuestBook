  <?php
  require_once("class.user.php");
  $session = new USER();
  
  
  $userId = $_SESSION['user_session'];
  
  $stmt = $session->runQuery("SELECT * FROM users WHERE userId=:userId");
  $stmt->execute(array(":userId"=>$userId));
  
  $userRow=$stmt->fetch(PDO::FETCH_ASSOC);
  if($userRow['kodePermission'] == 2){
  	$session->redirect('forbidden.html');
  }

  ?>