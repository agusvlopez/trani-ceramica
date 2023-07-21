<?PHP 

$passwordProvisto = "1234";


$passwordProvistoPH = password_hash($passwordProvisto, PASSWORD_DEFAULT);


echo "<p>Password provisto ecriptado en password_hash()  (Siempre 64 caracteres): $passwordProvistoPH </p>";