<?php
session_start();
require_once('class.user.php');
$user = new USER();

if(isset($_POST['btn-signup']))
{
	$uname = htmlspecialchars(strip_tags($_POST['txt_uname']));
	$umail = htmlspecialchars(strip_tags($_POST['txt_umail']));
	$ualamat = htmlspecialchars(strip_tags($_POST['txt_ualamat']));
	$upass = htmlspecialchars(strip_tags($_POST['txt_upass']));
	
	if($uname=="")	{
		$error[] = "provide username !";	
	}
	else if($umail=="")	{
		$error[] = "provide email id !";	
	}
	else if(!filter_var($umail, FILTER_VALIDATE_EMAIL))	{
	    $error[] = 'Please enter a valid email address !';
	}
	else if($upass=="")	{
		$error[] = "provide password !";
	}
	else if(strlen($upass) < 6){
		$error[] = "Password must be atleast 6 characters";	
	}
	else
	{
		try
		{
			$stmt = $user->runQuery("SELECT userName, userEmail FROM users WHERE userName=:uname OR userEmail=:umail");
			$stmt->execute(array(':uname'=>$uname, ':umail'=>$umail));
			$row=$stmt->fetch(PDO::FETCH_ASSOC);
				
			if($row['userName']==$uname) {
				$error[] = "sorry username already taken !";
			}
			else if($row['userEmail']==$umail) {
				$error[] = "sorry email id already taken !";
			}
			else
			{
				if($user->register($uname,$umail,$upass,$ualamat)){	
					$user->redirect('index.php?joined');
				}
			}
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}	
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Buku Tamu KTI: Sign up</title>
<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
<link href="bootstrap/css/bootstrap-theme.min.css" rel="stylesheet" media="screen">
<link rel="stylesheet" href="style.css" type="text/css"  />
</head>
<body>

<div class="signin-form">

<div class="container">
    	
        <form method="post" class="form-signin">
            <h2 class="form-signin-heading">Registrasi Buku Tamu Undangan</h2><hr />
            <?php
			if(isset($error))
			{
			 	foreach($error as $error)
			 	{
					 ?>
                     <div class="alert alert-danger">
                        <i class="glyphicon glyphicon-warning-sign"></i> &nbsp; <?php echo $error; ?>
                     </div>
                     <?php
				}
			}
			else if(isset($_GET['joined']))
			{
				 ?>
                 <div class="alert alert-info">
                      <i class="glyphicon glyphicon-log-in"></i> &nbsp; Successfully registered <a href='login.php'>login</a> here
                 </div>
                 <?php
			}
			?>
            <div class="form-group">
            <input type="text" class="form-control" name="txt_uname" placeholder="Masukkan Username" value="<?php if(isset($error)){echo $uname;}?>" maxlength="50"/>
            </div>

            <div class="form-group">
            <input type="text" class="form-control" name="txt_umail" placeholder="Masukkan E-Mail ID" value="<?php if(isset($error)){echo $umail;}?>" maxlength="60"/>
            </div>

            <div class="form-group">
            <input type="text" class="form-control" name="txt_ualamat" placeholder="Masukkan Alamat"/>
            </div>

            <div class="form-group">
            	<input type="password" class="form-control" name="txt_upass" placeholder="Masukkan Password" />
            </div>

            <div class="clearfix"></div><hr />
            <div class="form-group">
            	<button type="submit" class="btn btn-primary" name="btn-signup">
                	<i class="glyphicon glyphicon-open-file"></i>&nbsp;Registrasi
                </button>
            </div>
            <br />
            <label>sudah punya akun ! <a href="login.php">Masuk</a></label>
            <br>
        </form>
       </div>
</div>

</div>

</body>
</html>