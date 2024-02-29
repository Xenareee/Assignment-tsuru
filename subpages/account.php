<div id="accountpage-main"><?php 
echo('<div id="accountpage-profilepicture" style="background-image: url(images/profilepicture' . str_pad($_SESSION['profilepicture'], 2, "0", STR_PAD_LEFT) . '.png)"></div>');
 ?><div id="accountpage-username"><?php echo($_SESSION["username"]); ?></div></div>
<br><br>
<a class="buttonlink" href="index.php?page=account-change-profilepicture"><button>Zmień obrazek</button></a>
<br><br>
<a class="buttonlink" href="index.php?page=log-out"><button>Wyloguj się</button></a>