<?php 
    if($kanjiprevious) {
        echo('<a href="index.php?page=kanji&kanji=' . $kanjiprevious . '" style="float: left; margin-bottom: 10px;">◀ ' . $kanjiprevious . '</a>');
    }
    if ($kanjinext) {
        echo('<a href="index.php?page=kanji&kanji=' . $kanjinext . '" style="float: right; margin-bottom: 10px;">' . $kanjinext . ' ▶</a>');
    }   
?>
<div id="kanjilinks-separator"></div>
<div id="sidelinks">
    <?php
    echo('<a class="buttonlink wanikanilink" href="https://www.wanikani.com/kanji/' . $kanji . '" target="_blank"><button>' . $kanji . ' w WaniKani</button></a>');
    echo('<br><br>');
    echo('<a class="buttonlink jisholink" href="https://jisho.org/search/' . $kanji . '%20%23kanji" target="_blank"><button>' . $kanji . ' w Jisho.org</button></a>');
    ?>
</div><!--


--><div id="kanji-kanji"><?php echo($kanji); ?></div>
<div id="kanji-meaning"><?php echo($kanjimeaning); ?></div>
<br>
<div id="kanji-description"><?php echo($kanjidesc); ?></div>
<br><br><br><br><?php

if (isset($_SESSION['username'])) {

    echo('<div id="kanjilinks-separator" style="clear: both;"></div>');
    echo('<h4>Twój postęp</h3>');
    
    // get this user's kanji progress and beginner kanji
        //     $kanjiprogress
        //     $kanjiprogresssymbols
        //     $beginnerkanji
        //     $availablekanji
    include('php/refresh-kanjiprogress.php');

    //echo('<script>alert("' . array_search($kanji, $kanjiprogresssymbols) . '");</script>');

    // find progress for this kanji
    $found = false;
    for ($i = 0; $i < count($kanjiprogress); $i++) {

        if ($kanjiprogress[$i]['kanji'] == $kanji) {
            $found = true;
            $progress = $kanjiprogress[$i];
        }

    }

    if (!$found) {
        echo('<div id="kanji-progress">Ten symbol kanji jeszcze czeka na swoją kolej!</div>');
    }
    else {

        $razy = "razy";

        if ($progress['progress'] == 0) {
            $rank = "Świeżak";
        }
        else if ($progress['progress'] == 1) {
            $razy = "raz";
            $rank = "Początkujący";
        }
        else if ($progress['progress'] > 1 && $progress['progress'] < 5) {
            $rank = "Początkujący";
        }
        else if ($progress['progress'] > 4 && $progress['progress'] < 8) {
            $rank = "Obeznany";
        }
        else if ($progress['progress'] > 7 && $progress['progress'] < 10) {
            $rank = "Weteran";
        }
        else if ($progress['progress'] > 9) {
            $rank = "Mistrz";
        }

        $seconds = $progress['nextreview'];
         // przelicz 
        include('php/refresh-secondstoduration.php');

        echo('<div id="kanji-progress">' . $rank . ' <span></span> Odpowiedziano poprawnie ' . $progress['progress'] . ' ' . $razy . ' z rzędu <span></span> następna powtórka za ' . $duration . '</div>');
    }
    
    
}



?>

<br><br>