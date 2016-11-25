<?php
  require_once("sessionview.php");
?>
<?php $page=5; include_once 'header2.php'; ?>
<script src='https://www.google.com/recaptcha/api.js'></script>
<link rel="stylesheet" href="homeberita.css" type="text/css"/>
<?php
// $errName = "";
// $errEmail = "";
// $errSubject = "";
// $errMessage = "";

if (isset($_POST["submit"])) {
	$name = $_POST['name'];
	$email = $_POST['email'];
	$message = $_POST['message'];
	$subject = $_POST['subject'];
	$human = intval($_POST['human']);
	$from = '[HMSI] Contact Us'; 
	$to = 'cobahmsi@gmail.com'; 


	$body ="From: $name\n E-Mail: $email\n Message:\n $message";
		// Check if name has been entered
	if (!$_POST['name']) {
		$errName = 'Please enter your name';
	}

		// Check if email has been entered and is valid
	if (!$_POST['email'] || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
		$errEmail = 'Please enter a valid email address';
	}

		//Check if message has been entered
	if (!$_POST['message']) {
		$errMessage = 'Please enter your message';
	}

		//Check if subject has been entered
	if (!$_POST['subject']) {
		$errSubject = 'Please enter your subject';
	}

		//Check if simple anti-bot test is correct
	if(isset($_POST['g-recaptcha-response']))
          $captcha=$_POST['g-recaptcha-response'];

        if(!$captcha){
          echo '<h2>Please check the the captcha form.</h2>';
          exit;
        }
        $response=json_decode(file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=6Ldf9wkUAAAAAKsB8-WZ7bpmyvnXvRRmssyxpMRE&response=".$captcha."&remoteip=".$_SERVER['REMOTE_ADDR']), true);
        if($response['success'] == false)
        {
          echo '<h2>Please verify that you are not a BOT.</h2>';
        }
	// If there are no errors, send the email
	if (!$errName && !$errEmail && !$errMessage) {
		if (mail ($to, $subject, $body, $from)) {
			$result='<div class="alert alert-success">Terima kasih. Pesan anda akan segera kami balas.</div>';
		} else {
			$result='<div class="alert alert-danger">Sorry there was an error sending your message. Please try again later.</div>';
		}
	}
}
?>
	<div style="height:auto;background-color:white;margin-top:0px;">  
	<div class="container">
		<div class="row">
			<div class="col-md-6 col-md-offset-3">
				<h1 class="page-header text-center">Contact Us</h1>
				<form class="form-horizontal" role="form" method="post" action="kontak.php">
					<div class="form-group">
						<label for="name" class="col-sm-2 control-label">Name</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="name" name="name" placeholder="First & Last Name" value="<?php echo htmlspecialchars($_POST['name']); ?>">
							<?php echo "<p class='text-danger'>$errName</p>";?>
						</div>
					</div>
					<div class="form-group">
						<label for="email" class="col-sm-2 control-label">Email</label>
						<div class="col-sm-10">
							<input type="email" class="form-control" id="email" name="email" placeholder="example@domain.com" value="<?php echo htmlspecialchars($_POST['email']); ?>">
							<?php echo "<p class='text-danger'>$errEmail</p>";?>
						</div>
					</div>
					<div class="form-group">
						<label for="subject" class="col-sm-2 control-label">Subject</label>
						<div class="col-sm-10">
							<input type="subject" class="form-control" id="subject" name="subject" placeholder="Input Your Subject" value="<?php echo htmlspecialchars($_POST['subject']); ?>">
							<?php echo "<p class='text-danger'>$errSubject</p>";?>
						</div>
					</div>
					<div class="form-group">
						<label for="message" class="col-sm-2 control-label">Message</label>
						<div class="col-sm-10">
							<textarea class="form-control" rows="4" name="message"><?php echo htmlspecialchars($_POST['message']);?></textarea>
							<?php echo "<p class='text-danger'>$errMessage</p>";?>
						</div>
					</div>
					
					<div class="col-sm-2"></div>
					<div class="g-recaptcha col-sm-10" data-sitekey="6Ldf9wkUAAAAAM-l8fOCKpetq9zryabcT3cp1S_i">
						
					</div>


          <div class="form-group">
          	<div class="col-sm-10 col-sm-offset-2">
          		<input id="submit" name="submit" type="submit" value="Send" class="btn btn-primary" style="margin-top:19px;">
          	</div>
          </div>
          <div class="form-group">
          	<div class="col-sm-10 col-sm-offset-2">
          		<?php echo $result; ?>	
          	</div>
          </div>
      </form> 
  </div>
</div>
</div>   
<?php include_once 'footer.php'; ?>

