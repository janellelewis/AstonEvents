<?php
if (empty($_SERVER['PH_AUTH_USER'] && ($_SERVER['PHP_AUTH_PW'])){
header("WWW-Authenticate: Basic realm=\"Private Area\"");
header("HTTP/1.0 401 Unauthorized");
echo "Please enter credentials on login page";
exit;

}
/**	}else {
if (($_SERVER['PHP_AUTH_USER'] !== $username && ($_SERVER['PHP_AUTH_PW'] == $password))){
print "You are trying to access a restricted area - Please go back";
}else{
header("WWW-Authenticate: Basic realm=\"Private Area\"");
header("HTTP/1.0 401 Unauthorized");
echo "Your credentials were incorrect - Please enter actual credentials";
}
exit;**/

?>