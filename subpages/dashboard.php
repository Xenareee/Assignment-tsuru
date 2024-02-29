<?php
// reset review queues
$_SESSION['priorityqueue'] = [];
$_SESSION['reviewqueue'] = [];
$_SESSION['meaningresults'] = [];
$_SESSION['symbolresults'] = [];

// get the list of all kanji.
//     $kanjidata
include('php/refresh-kanjidata.php');
// get this user's kanji progress and beginner kanji
//     $kanjiprogress
//     $kanjiprogresssymbols
//     $beginnerkanji
//     $availablekanji
include('php/refresh-kanjiprogress.php');

?><h1>Mój panel</h1>
<br>
<div id="dashboard-review-container" class="panel"><?php

if (count($availablekanji) > 0) { 
    echo('<div class="tsuru1"></div>');
}
else if (count($beginnerkanji) < 5) {
    echo('<div class="tsuru3"></div>');
}
else {
    echo('<div class="tsuru2"></div>');
}

echo('<h3>Powtórki</h3>');



if (count($availablekanji) > 0) {
    echo('<span class="pink">' . count($availablekanji) . '</span> ');
    if (count($availablekanji) == 1) {
        echo('znak');
    }
    else if (count($availablekanji) > 1 && count($availablekanji) < 1) {
        echo('znaki');
    }
    else {
        echo('znaków');
    }
    echo(' czeka na powtórkę!');
    echo('<br><br>');
    echo('<a class="buttonlink" href="index.php?page=review"><button>Powtórz ' . min(5, count($availablekanji)) . '</button></a>');
    echo('<div style="clear: both;"></div>');
}
else if (count($beginnerkanji) < 5) {
    echo('Nowe kanji dostępne do nauki!');
    echo('<br><br>');
    echo('<a class="buttonlink" href="index.php?page=review"><button>Rozpocznij</button></a>');
    echo('<div style="clear: both;"></div>');
}
else {

    // znajdź najbliższy review
    $seconds = 100000000000000;

    for ($i = 0; $i < count($kanjiprogress); $i++) {

        if (intval($kanjiprogress[$i]['nextreview']) < $seconds) {
            $seconds = intval($kanjiprogress[$i]['nextreview']);
        }

    }

    // przelicz 
    include('php/refresh-secondstoduration.php');


    echo('<span class="pink"><b>Na razie powtórki się skónczyły.</b></span>');
    echo('<br><br>');
    echo('Następna powtórka dostepna za <span class="pink">' . $duration . '</span>');
    echo('<br>');
    echo('<small><a href="index.php?page=explore-srs">Dlaczego muszę czekać?</a></small>');
    echo('<br><br>');
    echo('<button onclick="ForceReview()">Powtórz 5 mimo to</button>');
    echo('<div style="clear: both;"></div>');
}

?></div><!--



--><br>
<div id="dashboard-stats-container" class="panel"><?php

$newkanji = 0;
$beginnerkanji = 0;
$goodkanji = 0;
$greatkanji = 0;
$masterkanji = 0;

// get how many kanji there are of each level
for ($i = 0; $i < count($kanjiprogress); $i++) {

    if ($kanjiprogress[$i]['progress'] == 0) {
        $newkanji++;
    }
    else if ($kanjiprogress[$i]['progress'] > 0 && $kanjiprogress[$i]['progress'] < 5) {
        $beginnerkanji++;
    }
    else if ($kanjiprogress[$i]['progress'] > 4 && $kanjiprogress[$i]['progress'] < 8) {
        $goodkanji++;
    }
    else if ($kanjiprogress[$i]['progress'] > 7 && $kanjiprogress[$i]['progress'] < 10) {
        $greatkanji++;
    }
    else if ($kanjiprogress[$i]['progress'] > 9) {
        $masterkanji++;
    }
}

// dummy values
//$newkanji = 2;
//$beginnerkanji = 3;
//$goodkanji = 4;
//$greatkanji = 10;
//$masterkanji = 1;

$newpercent = $newkanji / count($kanjidata) * 100;
$beginnerpercent = $newpercent + $beginnerkanji / count($kanjidata) * 100;
$goodpercent = $beginnerpercent + $goodkanji / count($kanjidata) * 100;
$greatpercent = $goodpercent + $greatkanji / count($kanjidata) * 100;
$masterpercent = $greatpercent + $masterkanji / count($kanjidata) * 100;

//$smooth = 0.3;
$smooth = 0;


echo('<h3>Statystyki</h3>');

echo('<div id="stats-bar"><div id="review-results-bar-inside" style="width: ' . (count($kanjiprogress) / count($kanjidata) * 100) . '%"></div></div>');
echo('<br>');
echo('Poznane kanji: <span class="pink">' . count($kanjiprogress) . '</span>/' . count($kanjidata) . ' (<span class="pink">' . floor(count($kanjiprogress) / count($kanjidata) * 100) . '%</span>)');
echo('<br><br>');
echo('<div id="stats-plot-container">');
    echo('<div id="stats-plot" style="background: radial-gradient(#463195 20%, transparent 21%), conic-gradient(#db3c94 ' . $newpercent . '%, #9e34ff ' . $newpercent + $smooth . '%, #9e34ff ' . $beginnerpercent . '%, #465cf3 ' . $beginnerpercent + $smooth . '%, #465cf3 ' . $goodpercent . '%, #27c4f3 ' . $goodpercent + $smooth . '%, #27c4f3 ' . $greatpercent . '%, #27f3b2 ' . $greatpercent + $smooth . '%, #27f3b2 ' . $masterpercent - $smooth . '%, #463195 ' . $masterpercent . '%);"></div>');
    echo('<div id="stats-plot-legend">');
        echo('<span class="legend-entry"><span class="colorswatch" style="background: #db3c94;"></span> Nowe (' . $newkanji . ')</span>');
        echo('<span class="legend-entry" style="animation-delay: 0.1s;"><span class="colorswatch" style="background: #9e34ff;"></span> Początkujący (' . $beginnerkanji . ')</span>');
        echo('<span class="legend-entry" style="animation-delay: 0.2s;"><span class="colorswatch" style="background: #465cf3;"></span> Obeznany (' . $goodkanji . ')</span>');
        echo('<span class="legend-entry" style="animation-delay: 0.3s;"><span class="colorswatch" style="background: #27c4f3;"></span> Weteran (' . $greatkanji . ')</span>');
        echo('<span class="legend-entry" style="animation-delay: 0.4s;"><span class="colorswatch" style="background: #27f3b2;"></span> Mistrz (' . $masterkanji . ')</span>');
        echo('<span class="legend-entry" style="animation-delay: 0.5s;"><span class="colorswatch" style="background: #463195;"></span> Nierozpoczęte (' . (count($kanjidata) - count($kanjiprogress)) . ')</span>');
    echo('</div>');
echo('</div>');

?></div>
<br><br>