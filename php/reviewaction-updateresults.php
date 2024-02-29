<?php
session_start();
$passedkanji = $_POST["kanji"];
$passedcorrect = $_POST["correct"];
$passedtype = $_POST["type"];

if ($passedtype == "meaning") {
    //echo("\nMeaning results count before: " . count($_SESSION['meaningresults']));
    $_SESSION['meaningresults'][$passedkanji] = $passedcorrect;
    //echo("\nMeaning results count after: " . count($_SESSION['meaningresults']));
}
else {
    //echo("\nSymbol results count before: " . count($_SESSION['symbolresults']));
    $_SESSION['symbolresults'][$passedkanji] = $passedcorrect;
    //echo("\nSymbol results count after: " . count($_SESSION['symbolresults']));

    // remove the kanji from the queue.
    // use a for loop since queue holds all info not just the kanji
    $didremove = False;
    for ($i = 0; $i < count($_SESSION['priorityqueue']); $i++) {
        if ($_SESSION['priorityqueue'][$i]['kanji'] == $passedkanji) {

            //echo("\nremoved " . $_SESSION['priorityqueue'][$i]['kanji']);
            unset($_SESSION['priorityqueue'][$i]);
            $_SESSION['priorityqueue'] = array_values($_SESSION['priorityqueue']);
            $didremove = True;
        }
    }
    if (!$didremove) {
        for ($i = 0; $i < count($_SESSION['reviewqueue']); $i++) {
            if ($_SESSION['reviewqueue'][$i]['kanji'] == $passedkanji) {
    
                //echo("\nremoved " . $_SESSION['reviewqueue'][$i]['kanji']);
                unset($_SESSION['reviewqueue'][$i]);
                $_SESSION['reviewqueue'] = array_values($_SESSION['reviewqueue']);
                $didremove = True;
            }
        }
    }

}

?>