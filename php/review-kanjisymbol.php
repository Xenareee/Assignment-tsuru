<?php
// get the list of all kanji.
//     $kanjidata
include('php/refresh-kanjidata.php');

// pick 5 random ones + current kanji
$pickedkanji = [];
$pickedkanji[] = $currentkanji;

//remove currentkanji so it cannot be picked again
for ($i = 0; $i < count($kanjidata); $i++) {
    if ($kanjidata[$i]["kanji"] == $currentkanji) {
        unset($kanjidata[$i]);
        $kanjidata = array_values($kanjidata);
        break;
    }
}

for ($i = 0; $i < 5; $i++) {
    $tempkey = rand(0, count($kanjidata) - 1);
    $pickedkanji[] = $kanjidata[$tempkey]["kanji"];
    unset($kanjidata[$tempkey]);
    $kanjidata = array_values($kanjidata);
}

unset($kanjidata);
unset($tempkey);

shuffle($pickedkanji);

?><div class="centered-container">
<h3 style="z-index: 3; position: relative;">Który symbol znaczy <span style="color: #eb60cd;"><?php echo($currentkanjimeaning); ?></span>?</h3>
<br><br><br><br>
<button class="kanjitile hideonsubmit" onclick="ReviewSubmitSymbol('<?php echo($pickedkanji[0]); ?>', '<?php echo($currentkanji); ?>')"><?php echo($pickedkanji[0]); ?></button>
<button class="kanjitile hideonsubmit" onclick="ReviewSubmitSymbol('<?php echo($pickedkanji[1]); ?>', '<?php echo($currentkanji); ?>')"><?php echo($pickedkanji[1]); ?></button>
<button class="kanjitile hideonsubmit" onclick="ReviewSubmitSymbol('<?php echo($pickedkanji[2]); ?>', '<?php echo($currentkanji); ?>')"><?php echo($pickedkanji[2]); ?></button>
<button class="kanjitile hideonsubmit" onclick="ReviewSubmitSymbol('<?php echo($pickedkanji[3]); ?>', '<?php echo($currentkanji); ?>')"><?php echo($pickedkanji[3]); ?></button>
<button class="kanjitile hideonsubmit" onclick="ReviewSubmitSymbol('<?php echo($pickedkanji[4]); ?>', '<?php echo($currentkanji); ?>')"><?php echo($pickedkanji[4]); ?></button>
<button class="kanjitile hideonsubmit" onclick="ReviewSubmitSymbol('<?php echo($pickedkanji[5]); ?>', '<?php echo($currentkanji); ?>')"><?php echo($pickedkanji[5]); ?></button>
<span id="answer" class="hiddenuntilsubmit" style="font-size: 60px; line-height: 80px;"></span>
<br><br><br><br><br class="hideonsubmit">
<button class="hiddenuntilsubmit" onclick="ReviewContinue()">Kontynuuj</button>
</div>