<?php
include(__DIR__ . '/connect.php');

// 0: 1h
// 1: 6h
// 2: 12h
// 3: 24h
// 4: 3d
// 5: tydzień
// 6: 2tyg
// 7: 30dni
// 8: 2mies
// 9: 6mies
// 10: rok
//        0    1      2      3       4       5       6        7        8         9        10
$delays = [3600, 21600, 43200, 86400, 259200, 604800, 1209600, 2592000, 5184000, 15811200, 31536000];

if ($updateprogressmode == "reset") {

    // get the kanji's progress value first
    $sql = "SELECT * FROM kanjiprogress WHERE username = ? AND kanji = ?";
    $sql = $conn->prepare($sql);
    $sql->bind_param('ss', $_SESSION["username"], $updateprogresskanji);
    $sql->execute();                             // Execute the prepared SQL statement.
    $result = $sql->get_result();                // Get the result set from the prepared statement.
    $progress = $result->fetch_array(MYSQLI_ASSOC);  // Fetch data and save it into an array.
    $result->close();                            // Free the memory associated with the result.
    $sql->close();

    $targetprogress = min(1, intval($progress['progress']));
    $targettime = time() + $delays[min(10, $targetprogress)];

    unset($progress);
}
else {

    // get the kanji's progress value first
    $sql = "SELECT * FROM kanjiprogress WHERE username = ? AND kanji = ?";
    $sql = $conn->prepare($sql);
    $sql->bind_param('ss', $_SESSION["username"], $updateprogresskanji);
    $sql->execute();                             // Execute the prepared SQL statement.
    $result = $sql->get_result();                // Get the result set from the prepared statement.
    $progress = $result->fetch_array(MYSQLI_ASSOC);  // Fetch data and save it into an array.
    $result->close();                            // Free the memory associated with the result.
    $sql->close();

    $targetprogress = intval($progress['progress']) + 1;
    $targettime = time() + $delays[min(10, $targetprogress)];

    unset($progress);
}

// set the values
$sql = "UPDATE kanjiprogress SET progress = ?, nextreview = ? WHERE username = ? AND kanji = ?";
$sql = $conn->prepare($sql);
$sql->bind_param('iiss', $targetprogress, $targettime, $_SESSION["username"], $updateprogresskanji);
$sql->execute();                             // Execute the prepared SQL statement.

$sql->close();
$conn->close();

?>