<?php
session_start();
$login = $_POST["login"];
$psswrd = $_POST["password"];
$psswrd = hash('tiger160,4', $psswrd);

include(__DIR__ . '/connect.php');
  
$sql = "SELECT * FROM kanjiuser WHERE username = ? AND psswrd = ?";
$sql = $conn->prepare($sql);
$sql->bind_param('ss', $login, $psswrd);
$sql->execute();                             // Execute the prepared SQL statement.
$result = $sql->get_result();                // Get the result set from the prepared statement.
$user = $result->fetch_array(MYSQLI_ASSOC);  // Fetch data and save it into an array.

$result->close();                            // Free the memory associated with the result.
$sql->close();
$conn->close();

if (empty($user)) {
    echo(null);
}
else {

    $_SESSION['username'] = $user['username'];
    $_SESSION['profilepicture'] = $user['profilepicture'];
    $_SESSION['pet'] = $user['pet'];

    echo($user['username']);
    
}

?>