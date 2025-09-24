<?php
function to_at9(string $path)
{	
	$ext = pathinfo($path, PATHINFO_EXTENSION);
	$newName = "/home/web/convert/".(string)(time()).".".$ext;
	rename($path,$newName);
	
	exec("/home/web/convert/convert_to_at9.sh ".escapeshellarg($newName));
	if(!file_exists($newName.".at9"))
	{
		if(file_exists($path))
			delete($path);
		if(file_exists($newName))
			delete($newName);
		echo("Error Converting to AT9.");
	}
	else
	{
		if(file_exists($path))
			delete($path);
		if(file_exists($newName))
			delete($newName);
		
		$name = "/convertjob/".(string)(time()).".at9";
		rename($newName.".at9","/home/web/public_html/vitatricks.xyz".$name);
		return $name;
	}
}

function to_flac(string $path)
{
	$newName = "/home/web/convert/".(string)(time()).".at9";
	rename($path,$newName);
	exec("/home/web/convert/convert_to_flac.sh ".escapeshellarg($newName));
	if(!file_exists($newName.".flac"))
	{
		if(file_exists($path))
			delete($path);
		if(file_exists($newName))
			delete($newName);

		echo("Error Converting to FLAC.");
	}
	else
	{
		if(file_exists($path))
			delete($path);
		if(file_exists($newName))
			delete($newName);

		$name = "/convertjob/".(string)(time()).".flac";
		rename($newName.".flac".$ext,"/home/web/public_html/vitatricks.xyz".$name);
		return $name;
	}
}
?>
