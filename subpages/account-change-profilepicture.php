<div class="centered-container">
<h3>Wybierz obrazek</h3>

<br><br>

<div id="choosepfp-container">
<button onclick="PreviousProfilePicture()">◀</button><?php 
echo('<div id="accountpage-profilepicture" style="background-image: url(images/profilepicture' . str_pad($_SESSION['profilepicture'], 2, "0", STR_PAD_LEFT) . '.png)"></div>');
?><button onclick="NextProfilePicture()">▶</button>
</div>
<br>
<div id="choosepfp-number"><span id="choosepfp-currentnumber"><?php echo($_SESSION['profilepicture']) ?></span>/10</div>

<br><br>

<button onclick="ChangeProfilePicture()">Zatwierdź</button>
<br><br>
<a class="buttonlink" href="index.php?page=account"><button>Anuluj</button></a>

</div>