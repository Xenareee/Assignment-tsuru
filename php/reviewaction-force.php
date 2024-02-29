<?php
session_start();
// get this user's kanji progress and beginner kanji
    //     $kanjiprogress
    //     $kanjiprogresssymbols
    //     $beginnerkanji
    //     $availablekanji
include(__DIR__ . '/refresh-kanjiprogress.php');
// connect
include(__DIR__ . '/connect.php');

// pick 5 kanji to force
$appendedstring = "";

if (count($kanjiprogresssymbols) <= 5) {

    for ($i = 0; $i < (count($kanjiprogresssymbols)-1); $i++) {
        $appendedstring = $appendedstring . '"' . $kanjiprogresssymbols[$i] . '", ';
    }

    $appendedstring = $appendedstring . '"' . $kanjiprogresssymbols[count($kanjiprogresssymbols)-1] . '"';

}
else {

    for ($i = 0; $i < 4; $i++) {
        $appendedstring = $appendedstring . '"' . $kanjiprogresssymbols[$i] . '", ';
    }

    $appendedstring = $appendedstring . '"' . $kanjiprogresssymbols[4] . '"';

}

//echo($appendedstring);

$sql = "UPDATE kanjiprogress SET nextreview = 0 WHERE username = ? AND kanji IN (" . $appendedstring . ")";
$sql = $conn->prepare($sql);
$sql->bind_param('s', $_SESSION["username"]);
$sql->execute();                             // Execute the prepared SQL statement.

$sql->close();
$conn->close();

?>