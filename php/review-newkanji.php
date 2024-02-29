<?php 
include(__DIR__ . '/connect.php');

// check if this kanji already has progress
$sql = "SELECT * FROM kanjiprogress WHERE username = ? AND kanji = ?";
$sql = $conn->prepare($sql);
$sql->bind_param('ss', $_SESSION["username"], $currentkanji);
$sql->execute();                             // Execute the prepared SQL statement.
$result = $sql->get_result();                // Get the result set from the prepared statement.
$progress = $result->fetch_array(MYSQLI_ASSOC);  // Fetch data and save it into an array.

$result->close();                            // Free the memory associated with the result.
$sql->close();

// if it doesn't, create it.
if (empty($progress)) {

    $sql = "INSERT INTO kanjiprogress (`kanji`, `username`, `progress`, `nextreview`) VALUES (?, ?, '0', '0');";
    $sql = $conn->prepare($sql);
    $sql->bind_param('ss', $currentkanji, $_SESSION["username"]);
    $sql->execute();                             // Execute the prepared SQL statement.
    $sql->close();
}

$conn->close();

?><div class="centered-container">
<h1 style="z-index: 3; position: relative;" class="notfirst">Nowe kanji!</h1>
<br>
<div style="position: relative; display: inline-block;"><div id="kanji-kanji"><?php echo($currentkanji); ?></div><div id="newkanji-effect"></div></div>
<div id="kanji-meaning" style="z-index: 3; position: relative;"><?php echo($currentkanjimeaning); ?></div>
<br><br>
<div style="z-index: 3; position: relative;"><?php echo($currentkanjidesc); ?></div>
<br><br><br><br>
<button onclick="ReviewContinue()">Kontynuuj</button>
</div>