<?php 
require_once('config.php');
?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Url Shorter</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<body>
	
	<div class="container">
		<div class="row">
			<div class="col-md-4">
			<?php 

if(isset($_POST['submit']) && $_POST['url-shorter'] != ""){

//generate shor link;

$title = generateRandomString();

//add https:// to user input

if(substr($_POST['url-shorter'],0,8) != 'https://'){
	
	$url = 'https://'.$_POST['url-shorter'];
}else{
	$url = $_POST['url-shorter'];
}

	//insert link into our database

	$result ="";
	$result = $db->prepare("INSERT INTO urls VALUES('',?,?)");

	$result->bind_param("ss",$url,$title);
	
	$result->execute();
	echo "<p class='alert alert-success text-center'>Your short Url is down below</p>";
	$result = $db->prepare("SELECT * FROM urls WHERE short_url=?");

	$result->bind_param("s",$title);
	
	$result->execute();

	$goto = $result->get_result()->fetch_array();
	//print_r($goto[2]);
	 $surl ='http://localhost/url/'.$goto[2];
	 echo 'Your Shot Url -  '. $surl;
}else{
	$error = 'Please enter an url to shoren';
	echo $error;
}
			?>
				<form action="" method="post">
				<div class="form-group">
					<label for="url">Url</label>
					<input type="text" class="form-control" name="url-shorter">
					<p>Please Do not Provide https:// in front of you link</p>
				</div>
				<input type="submit" name="submit" placeholder="Paste the link to shorten.....">
				</form>
			</div>
			
		</div>
	</div>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</body>
</html>