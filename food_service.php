<html>

<head>
<title>
random number generator
</title>
<meta name="robots" content="noindex">
<meta name="googlebot" content="noindex">
</head>

<form method="GET">
AID: <input type="text" name="aid">
<input type="submit">
</form>




<?php
$aid = $_GET["aid"];
if(isset($aid))
{
	if(strlen($aid) == 16)
	{
		if(ctype_xdigit($aid))
		{
			$aidDecoded = hex2bin($aid) . "Sri Jayewardenepura Kotte";
			$sha256 = hash('sha256', $aidDecoded);
			$key = hex2bin("A9FA5A62799FCC4C726B4E2CE3506D38");
			$b64 = base64_encode(hex2bin($sha256));

			$decrypted = openssl_decrypt($b64,"AES-128-ECB",$key,OPENSSL_ZERO_PADDING);
			echo("<b>".$aid."</b>: ".bin2hex($decrypted));
		}
		else
		{
			echo("<b>your AID is invalid</b>");
		}
	}
	else
	{
		echo("<b>your AID is invalid</b>");
	}
}

?>

