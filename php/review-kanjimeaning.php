<div class="centered-container">
<h3 style="z-index: 3; position: relative;">Co oznacza ten symbol?</h3>
<br>
<div id="kanji-kanji"><?php echo($currentkanji); ?></div>
<br><br><br><br>
<input type="text" id="textbox-review" class="hideonsubmit" autocomplete="off"><span id="correctmeanings" class="hiddenuntilsubmit" style="line-height: 22px;"></span>
<br><br><br><br>
<button class="hideonsubmit" onclick="ReviewSubmitMeaning('<?php echo($currentkanjiallmeanings); ?>', '<?php echo($currentkanji); ?>')">Zatwierdź</button><button class="hiddenuntilsubmit" onclick="ReviewContinue()">Kontynuuj</button>
</div>