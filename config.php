<?php 

$db = new mysqli('localhost','root','','url_s');

function generateRandomString($length = 10) {
    $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
/*
if(mysqli_errno($db)){
	echo "conection failed";
}else{
	echo "connect Success";
}
*/

if(isset($_GET['code'])){
//select code from database
//echo $_GET['code'];

	$result = '';

	$result = $db->prepare("SELECT * FROM urls WHERE short_url=?");

	$result->bind_param("s",$_GET['code']);
	
	$result->execute();

	$goto = $result->get_result()->fetch_array();
	if($goto){
		header("Location: $goto[1]");
	}else{
	echo "";
	}

	

}



?>