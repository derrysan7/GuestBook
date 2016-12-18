<?php

require_once('dbconfig.php');

class USER
{	

	private $conn;
	
	public function __construct()
	{
		$database = new Database();
		$db = $database->dbConnection();
		$this->conn = $db;
    }
	
	public function runQuery($sql)
	{
		$stmt = $this->conn->prepare($sql);
		return $stmt;
	}

	public function lastID()
	{
	$stmt = $this->conn->lastInsertId();
	return $stmt;
	}
	
	public function register($uname,$umail,$upass,$ualamat,$utokencode)
	{
		try
		{
			$new_password = password_hash($upass, PASSWORD_DEFAULT);
			
			$stmt = $this->conn->prepare("INSERT INTO users(userName,userEmail,userPass,alamat,tokenCode) 
		                                               VALUES(:uname, :umail, :upass, :ualamat,:active_code)");
												  
			$stmt->bindparam(":uname", $uname);
			$stmt->bindparam(":umail", $umail);
			$stmt->bindparam(":upass", $new_password);
			$stmt->bindparam(":ualamat", $ualamat);	
			$stmt->bindparam(":active_code",$utokencode);							  
				
			$stmt->execute();	
			
			return $stmt;	
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}				
	}
	
	
	public function doLogin($uname,$umail,$upass)
	{
		try
		{
			$stmt = $this->conn->prepare("SELECT * FROM users WHERE userName=:uname OR userEmail=:umail ");
			$stmt->execute(array(':uname'=>$uname, ':umail'=>$umail));
			$userRow=$stmt->fetch(PDO::FETCH_ASSOC);
			if($stmt->rowCount() == 1)
			{
				if($userRow['userStatus']=="Y")
				{
					if(password_verify($upass, $userRow['userPass']))
					{
						$_SESSION['user_session'] = $userRow['userId'];
						return true;
					}
					else
					{
						return false;
					}
				}
				else
				{
					header("Location: login.php?inactive");
					exit;
				}	
			}
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}

	public function antiforgerytoken()
	{
		if (!isset($_SESSION['token'])) {
		    $tokenforge = bin2hex(openssl_random_pseudo_bytes(16));
		    $_SESSION['token'] = $tokenforge;
		}
		else
		{
		    $tokenforge = $_SESSION['token'];
		}
	}
	
	public function is_loggedin()
	{
		if(isset($_SESSION['user_session']))
		{
			return true;
		}
	}
	
	public function redirect($url)
	{
		header("Location: $url");
	}
	
	public function doLogout()
	{
		session_destroy();
		unset($_SESSION['user_session']);
		return true;
	}

	public function update_pass($userId,$upass)
	   {
	    try
	    {
	      $new_password = password_hash($upass, PASSWORD_DEFAULT);

	     $stmt=$this->conn->prepare("UPDATE users SET userPass=:upass WHERE userId=:userId");
	     $stmt->bindparam(":upass", $new_password);
	     $stmt->bindparam(":userId",$userId);
	     $stmt->execute();
	     
	     return true; 
	    }
	    catch(PDOException $e)
	    {
	     echo $e->getMessage(); 
	     return false;
	    }
	   }

	 function send_mail($email,$message,$subject)
	  {           
	    require_once('mailer/class.phpmailer.php');
	    $mail = new PHPMailer();
	    $mail->IsSMTP(); 
	    $mail->SMTPDebug  = 0;
	    $mail->SMTPAuth   = true;
	    $mail->SMTPSecure = "ssl";
	    $mail->Host       = "smtp.gmail.com";
	    $mail->Port       = 465; 
	    $mail->AddAddress($email);
	    $mail->Username="cobahmsi@gmail.com";
	    $mail->Password="rpl1uyee";
	    $mail->SetFrom('cobahmsi@gmail.com','Wedding Admin');
	    $mail->AddReplyTo("cobahmsi@gmail.com","Wedding Admin");
	    $mail->Subject = $subject;
	    $mail->MsgHTML($message);
	    $mail->Send();
	  }


}
?>