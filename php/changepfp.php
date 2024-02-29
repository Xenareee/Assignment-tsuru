<?php
session_start();
$pfp = $_POST["pfp"];

include(__DIR__ . '/connect.php');
  
$sql = "UPDATE `kanjiuser` SET `profilepicture`= ? WHERE username = ?";
$sql = $conn->prepare($sql);
$sql->bind_param('is', $pfp, $_SESSION['username']);
$sql->execute();

$sql->close();
$conn->close();

$_SESSION['profilepicture'] = $pfp;

?>