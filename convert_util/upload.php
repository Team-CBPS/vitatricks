<?php
include("convert.php");

if(isset($_POST["g-recaptcha-response"]))
{
	$url = 'https://www.google.com/recaptcha/api/siteverify';
	$data = array(
		'secret' => '6LfbwrcZAAAAAAeA9rNiEDilcmeVMH5sjNaYoGIa',
		'response' => $_POST["g-recaptcha-response"]
	);
	$options = array(
		'http' => array (
			'method' => 'POST',
			'content' => http_build_query($data)
		)
	);
	$context  = stream_context_create($options);
	$verify = file_get_contents($url, false, $context);
	$captcha_success=json_decode($verify);
	if ($captcha_success->success==false) {
		echo "Recaptcha was not solved successfully.";
		die();
	} else if ($captcha_success->success==true) {
		if(strcmp($captcha_success->hostname,"vitatricks.xyz") !== 0)
		{
			echo("Recaptcha returned incorrect hostname.");
			die();	
		}
	}
}
else
{
	echo("No recaptcha response data sent.");
	die();
}

$uploadPath = $_FILES["fileUpload"]["name"];
$ext = pathinfo($uploadPath, PATHINFO_EXTENSION);

//ESCAPE ESSCAPPPEEE!
$ext = str_replace(".","",$ext);
$ext = str_replace("/","",$ext);
$ext = str_replace("*","",$ext);
$ext = addslashes($ext);

$uploadPath = (string)(time()).".".$ext;

$target_dir = "/home/web/public_html/vitatricks.xyz/convertjob/";
$target_file = $target_dir . basename($uploadPath);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

if(isset($_POST["continueTo"]))
{
	$continueTo = $_POST["continueTo"];
	if($continueTo == "fromAt9")
	{
		if($ext == "at9")
		{
			move_uploaded_file($_FILES["fileUpload"]["tmp_name"], $target_file);
			$flac_file = to_flac($target_file);
			header("Location: ".$flac_file);
		}
		else
		{
			echo("Not an AT9 File.");
		}
	}
	else if($continueTo == "toAt9")
	{	if($ext == "mp3" || $ext == "ogg" || $ext == "wav" || $ext == "flac")
		{
			move_uploaded_file($_FILES["fileUpload"]["tmp_name"], $target_file);
			$at9_file = to_at9($target_file);
			header("Location: ".$at9_file);
		}
		else
		{
			echo("Not a OGG, WAV, or FLAC File.");
		}
	}
	else
	{
		echo("Unkown Action!");
	}

}
?>
