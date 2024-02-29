<div style="text-align: center; padding-top: 2px;">
<h2 class="pink">Koniec!</h2>
<h3>Twoje wyniki:</h3>
<?php 
$total = 0;
$correcttotal = 0;
$totalkanji = [];
$totalkanjipassed = [];

for ($i = 0; $i < count(array_keys($_SESSION['meaningresults'])); $i++) {

    $currentkanji = array_keys($_SESSION['meaningresults'])[$i];

    $total++;
    $totalkanji[] = $currentkanji;

    if ($_SESSION['meaningresults'][$currentkanji] == "true") {
        $correcttotal++;
        $totalkanjipassed[] = $currentkanji;
    }
}
for ($i = 0; $i < count(array_keys($_SESSION['symbolresults'])); $i++) {

    $currentkanji = array_keys($_SESSION['symbolresults'])[$i];

    $total++;
    //$totalkanji[] = $currentkanji;

    if ($_SESSION['symbolresults'][$currentkanji] == "true") {
        $correcttotal++;
    }
    else {
        // if symbol was wrong, remove it from the array
        if (array_search($currentkanji, $totalkanjipassed)) {
            unset($totalkanjipassed[array_search($currentkanji, $totalkanjipassed)]);
        $totalkanjipassed = array_values($totalkanjipassed);
        }
    }

}

?>
<div id="review-results-bar"><div id="review-results-bar-inside" style="width: <?php echo($correcttotal / $total * 100) ?>%"></div></div>
<br>
Poprawne odpowiedzi: <span class="pink"><?php echo($correcttotal / $total * 100) ?>%</span>
<br><br><br>
<?php

for ($i = 0; $i < count($totalkanjipassed); $i++) {
    echo('<div class="kanji-kanji">' . $totalkanjipassed[$i] . '</div>');

    // zmień progress na +1, i dodaj czas.
    $updateprogresskanji = $totalkanjipassed[$i];
    $updateprogressmode = "add";
    include(__DIR__ . '/reviewaction-updateprogress.php');
}
echo("<br><br>");
echo('Dobrze znane znaki kanji: <span class="pink">' . count($totalkanjipassed) . '</span>');
echo('<br><small style="opacity: 50%;"><i>te znaki pojawią się po dłuższej przerwie niż dotychczas</i></small>');

echo("<br><br><br>");

for ($i = 0; $i < count($totalkanji); $i++) {
    if (array_search($totalkanji[$i], $totalkanjipassed) === array_search("#", $totalkanjipassed)) {
        echo('<div class="kanji-kanji">' . $totalkanji[$i] . '</div>');

        // zmień progress na 1 i dodaj czas
        $updateprogresskanji = $totalkanji[$i];
        $updateprogressmode = "reset";
        include(__DIR__ . '/reviewaction-updateprogress.php');
    }  
}
echo("<br><br>");
echo('Gorzej znane znaki kanji: <span class="pink">' . count($totalkanji) - count($totalkanjipassed) . '</span>');
echo('<br><small style="opacity: 50%;"><i>te znaki pojawią się po krótszej przerwie niż dotychczas</i></small>');

?>
<br><br><br><br>
<a class="buttonlink" href="index.php?page=dashboard"><button>Wróć do strony głównej</button></a>
</div>