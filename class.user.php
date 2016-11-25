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
	
	public function register($uname,$umail,$upass,$uperm)
	{
		try
		{
			$new_password = password_hash($upass, PASSWORD_DEFAULT);
			if($uperm == "Super Admin") {
			   $new_perm = "1";
			   }
			   else{
			   $new_perm = "2";
			 }
			
			$stmt = $this->conn->prepare("INSERT INTO users(userName,userEmail,userPass,kodePermission) 
		                                               VALUES(:uname, :umail, :upass, :uperm)");
												  
			$stmt->bindparam(":uname", $uname);
			$stmt->bindparam(":umail", $umail);
			$stmt->bindparam(":upass", $new_password);
			$stmt->bindparam(":uperm", $new_perm);										  
				
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
			$stmt = $this->conn->prepare("SELECT userId, userName, userEmail, userPass FROM users WHERE userName=:uname OR userEmail=:umail ");
			$stmt->execute(array(':uname'=>$uname, ':umail'=>$umail));
			$userRow=$stmt->fetch(PDO::FETCH_ASSOC);
			if($stmt->rowCount() == 1)
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
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
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

	public function crudLabel($permission)
	{
		if ($permission == 1)
		{
			$label = "CRUD User";
		}
		else
		{
			$label = "CRUD Content";
		}
		return $label;

	}

	public function crudLink($permission){
		if ($permission == 1)
		{
			$link = "listuser.php";
		}
		else
		{
			$link = "crud_berita_utama.php";
		}
		return $link;
	}
}
?>