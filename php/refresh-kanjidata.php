<?php
include(__DIR__ . '/connect.php');

// get the list of all kanji.
$sql = "SELECT * FROM kanji ORDER BY sortid";
$sql = $conn->prepare($sql);
$sql->execute();                        
$result = $sql->get_result();              

$kanjidata = [];

while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
    $kanjidata[] = $row;
}

unset($row);
$sql->close();
$result->close();
$conn->close();

?>