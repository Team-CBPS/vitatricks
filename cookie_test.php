<?php
setcookie("httpCookie","yes",time()+0x500000);
echo("<script> document.cookie = 'jsCookie=yes;  expires=Wed, 21 Dec 2022 12:00:00 UTC;';</script>");

echo("I see... <br>");
print_r($_COOKIE);

echo("<br><br>I set a cookie via HTTP and JS!");
?>