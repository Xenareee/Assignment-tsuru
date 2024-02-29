<?php
session_start();
$login = $_POST["login"];
$psswrd = $_POST["password"];
$psswrd = hash('tiger160,4', $psswrd);

include(__DIR__ . '/connect.php');
  
$sql = "SELECT * FROM kanjiuser WHERE username = ?";
$sql = $conn->prepare($sql);
$sql->bind_param('s', $login);
$sql->execute();                             // Execute the prepared SQL statement.
$result = $sql->get_result();                // Get the result set from the prepared statement.
$user = $result->fetch_array(MYSQLI_ASSOC);  // Fetch data and save it into an array.

$result->close();                            // Free the memory associated with the result.
$sql->close();

// if there's no such user, create it
if (empty($user)) {

    // insert user
    $sql = "INSERT INTO kanjiuser (username, psswrd) VALUES (?,?)";
    $sql = $conn->prepare($sql);
    $sql->bind_param('ss', $login, $psswrd);
    
    $sql->execute();

    //$result->close();
    $sql->close();

    // get default data
    $sql = "SELECT * FROM kanjiuser WHERE username = ?";
    $sql = $conn->prepare($sql);
    $sql->bind_param('s', $login);
    
    $sql->execute();
    $result = $sql->get_result();
    $user = $result->fetch_array(MYSQLI_ASSOC);

    $result->close();
    $sql->close();

    // log in in session
    $_SESSION['username'] = $user['username'];
    $_SESSION['profilepicture'] = $user['profilepicture'];
    $_SESSION['pet'] = $user['pet'];

    echo($user['username']);

}
// otherwise show that the user exists
else {
    echo(null);
}

$conn->close();

?>