<?php
session_start();
$searchterm = $_POST["searchterm"];
// get the list of all kanji.
//     $kanjidata
include(__DIR__ . '/refresh-kanjidata.php');

$resulttotal = 0;
  
// loop through every kanji
for ($i = 0; $i < count($kanjidata); $i++) {

    $pick = false;

    if ($kanjidata[$i]['kanji'] == $searchterm || str_contains($kanjidata[$i]['meaning'], $searchterm)) {
        $pick = true;
    }

    if ($pick) {
        echo('<a class="search-result" href="index.php?page=kanji&kanji=' . $kanjidata[$i]['kanji'] . '"><span class="search-result-kanji">' . $kanjidata[$i]['kanji'] . '</span><span class="search-result-meaning">' . $kanjidata[$i]['meaning'] . '</span></div>');
        $resulttotal++;
    }
}

echo('#####' . $resulttotal);

?>