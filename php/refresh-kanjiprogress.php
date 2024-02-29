<?php
include(__DIR__ . '/connect.php');

// get the list of all kanji.
$sql = "SELECT * FROM kanjiprogress WHERE username = ? ORDER BY progress";
$sql = $conn->prepare($sql);
$sql->bind_param('s', $_SESSION["username"]);
$sql->execute();                        
$result = $sql->get_result();              

$kanjiprogress = [];

while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
    $kanjiprogress[] = $row;
}

unset($row);
$sql->close();
$result->close();
$conn->close();

// get kanji names
$kanjiprogresssymbols = [];

for ($i = 0; $i < count($kanjiprogress); $i++) {
    $kanjiprogresssymbols[] = $kanjiprogress[$i]['kanji'];
}

// get kanji below level 5 and available ones
$beginnerkanji = [];
$availablekanji = [];

for ($i = 0; $i < count($kanjiprogress); $i++) {

    if ($kanjiprogress[$i]['progress'] < 5) {
        $beginnerkanji[] = $kanjiprogress[$i];
    }
    if ($kanjiprogress[$i]['nextreview'] <= time()) {
        $availablekanji[] = $kanjiprogress[$i];
    }

}

?>