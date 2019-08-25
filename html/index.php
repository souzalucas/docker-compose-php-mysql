<html>
<?php

echo 'Versão Atual do PHP: ' . phpversion();

$servername = "mysqlServer";
$username = "root";
$password = "root";

// Criando Conexão
$conn = new mysqli($servername, $username, $password);

// Testando Conexão
if ($conn->connect_error) {
    die("Falha na Conexão: " . $conn->connect_error);
}
echo "<br /> Conexão Bem Sucedida";
?>

</html>
