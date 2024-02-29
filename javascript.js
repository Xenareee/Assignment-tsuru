$(document).ready(function() {

    //alert("Ready!");
    //console.log("test");

});

function MainPage() {
    window.location.href = window.location.pathname + "?page=home";
};

function Redirect(subpage) {
    window.location.href = window.location.pathname + "?page=" + subpage;
};




function resettest() {

    $.ajax({
        url: "php/reset.php",    //the page containing php script
        type: "post",    //request type,
        //data: { "func": "abc" },
        success: function (result) {
            //console.log(result);
            document.getElementById("testnumber").innerHTML = result;
        }
    });

    //alert("reset!");

};


function printtesttable() {

    $.ajax({
        url: "php/print-testtable.php",    //the page containing php script
        type: "post",    //request type,
        success: function (result) {

            var resultcontainer = document.getElementById("tableresult");

            if (!resultcontainer) {

                var mydiv = document.createElement('div');
                mydiv.id = "tableresult";
                resultcontainer = mydiv;
                document.getElementById("article").appendChild(mydiv);
            }

            resultcontainer.innerHTML = result;
        }
    });

    //alert("reset!");

};


function LogIn() {

    var login = document.getElementById("textbox-username").value;
    var password = document.getElementById("textbox-password").value;
    var warnings = [];
    var warningdiv = document.getElementById("warnings");

    // check if they're correct
    if (login.length < 1) {
        warnings[warnings.length] = "Nazwa użytkownika nie może być pusta.";
    }
    else if (login.length > 20) {
        warnings[warnings.length] = "Nazwa użytkownika nie może mieć więcej niż 20 znaków.";
    }
    if (!/^[A-Za-z0-9]*$/.test(login)) {
        warnings[warnings.length] = "Nazwa użytkownika może zawierać tylko litery i liczby, bez znaków specjalnych.";
    }

    if (password.length < 1) {
        warnings[warnings.length] = "Hasło nie może być puste.";
    }
    else if (password.length > 20) {
        warnings[warnings.length] = "Hasło nie może mieć więcej niż 20 znaków.";
    }
    if (!/^[A-Za-z0-9]*$/.test(password)) {
        warnings[warnings.length] = "Hasło może zawierać tylko litery i liczby, bez znaków specjalnych.";
    }

    // if there are warnings, show them
    if (warnings.length > 0) {

        warningdiv.innerHTML = "⚠<br>";

        for (let i = 0; i < warnings.length; i++) {
            warningdiv.innerHTML += warnings[i] + '<br>';
        }

        warningdiv.style.display = "block";
    }
    // if they're correct
    else {

        

        $.ajax({
            url: "php/login.php",
            type: "post",
            data: { "login": login, "password": password },
            success: function (result) {
                
                if (result) {
                    // alert('logged in.')
                    warningdiv.style.display = "none";
                    MainPage();
                }
                else {
                    // alert('no such user.');
                    warningdiv.style.display = "block";
                    warningdiv.innerHTML = "ℹ<br>Nie istnieje taki użytkownik lub podane hasło jest nieprawidłowe.";
                }
            }
        });

    }
};



function LogOut() {

    $.ajax({
        url: "php/logout.php",
        type: "post",
        success: function () {
            MainPage();
        }
    });

};


function SignIn() {

    var login = document.getElementById("textbox-username").value;
    var password = document.getElementById("textbox-password").value;
    var password2 = document.getElementById("textbox-password2").value;
    var warnings = [];
    var warningdiv = document.getElementById("warnings");

    // check if they're correct
    if (login.length < 1) {
        warnings[warnings.length] = "Nazwa użytkownika nie może być pusta.";
    }
    else if (login.length > 20) {
        warnings[warnings.length] = "Nazwa użytkownika nie może mieć więcej niż 20 znaków.";
    }
    if (!/^[A-Za-z0-9]*$/.test(login)) {
        warnings[warnings.length] = "Nazwa użytkownika może zawierać tylko litery i liczby, bez znaków specjalnych.";
    }

    if (password == password2) {
        if (password.length < 1) {
            warnings[warnings.length] = "Hasło nie może być puste.";
        }
        else if (password.length > 20) {
            warnings[warnings.length] = "Hasło nie może mieć więcej niż 20 znaków.";
        }
        if (!/^[A-Za-z0-9]*$/.test(password)) {
            warnings[warnings.length] = "Hasło może zawierać tylko litery i liczby, bez znaków specjalnych.";
        }

        if (password2.length < 1) {
            warnings[warnings.length] = "Hasło nie może być puste.";
        }
        else if (password2.length > 20) {
            warnings[warnings.length] = "Hasło nie może mieć więcej niż 20 znaków.";
        }
        if (!/^[A-Za-z0-9]*$/.test(password2)) {
            warnings[warnings.length] = "Hasło może zawierać tylko litery i liczby, bez znaków specjalnych.";
        }
    }
    else {
        warnings[warnings.length] = "Hasła nie są identyczne.";
    }
    

    // if there are warnings, show them
    if (warnings.length > 0) {

        warningdiv.innerHTML = "⚠<br>";

        for (let i = 0; i < warnings.length; i++) {
            warningdiv.innerHTML += warnings[i] + '<br>';
        }

        warningdiv.style.display = "block";
    }
    // if they're correct
    else {

        $.ajax({
            url: "php/signin.php",
            type: "post",
            data: { "login": login, "password": password },
            success: function (result) {

                if (result) {
                    //alert('signed in.')
                    warningdiv.style.display = "none";
                    MainPage();
                }
                else {
                    //alert('username taken.');
                    warningdiv.style.display = "block";
                    warningdiv.innerHTML = "ℹ<br>Ta nazwa użytkownika jest zajęta.";
                }
            }
        });

    }
};







function ChangeProfilePicture() {

    var currentnumbercontainer = document.getElementById("choosepfp-currentnumber");
    var currentnumber = currentnumbercontainer.innerHTML;

    $.ajax({
        url: "php/changepfp.php",
        type: "post",
        data: { "pfp": currentnumber },
        success: function () {
            Redirect('account');
        }
    });

};


function UpdateProfilePicture(number) {

    picturediv = document.getElementById("accountpage-profilepicture");
    picturediv.style.backgroundImage = "url(images/profilepicture" + String(number).padStart(2, '0') + ".png)";

};

function PreviousProfilePicture() {

    var currentnumbercontainer = document.getElementById("choosepfp-currentnumber");
    var currentnumber = parseInt(currentnumbercontainer.innerHTML);

    if (currentnumber <= 1) {
        currentnumber = 10;
    }
    else {
        currentnumber--;
    }

    currentnumbercontainer.innerHTML = currentnumber;
    UpdateProfilePicture(currentnumber);

};


function NextProfilePicture() {

    var currentnumbercontainer = document.getElementById("choosepfp-currentnumber");
    var currentnumber = parseInt(currentnumbercontainer.innerHTML);

    if (currentnumber >= 10) {
        currentnumber = 1;
    }
    else {
        currentnumber++;
    }

    currentnumbercontainer.innerHTML = currentnumber;
    UpdateProfilePicture(currentnumber);

};







function UpdateSubmit(correct) {

    elementsToShow = document.getElementsByClassName("hiddenuntilsubmit");
    elementsToHide = document.getElementsByClassName("hideonsubmit");

    for (let i = 0; i < elementsToShow.length; i++) {
        elementsToShow[i].style.display = "initial";
    }

    for (let i = 0; i < elementsToHide.length; i++) {
        elementsToHide[i].style.display = "none";
    }

    if (correct) {
        console.log("correct!");
    }
    else {
        console.log("wrong!");
    }

};

function ReviewSubmitMeaning(correctanswers, kanji) {

    givenAnswer = document.getElementById("textbox-review").value;
    //alert(givenAnswer);
    correctanswerssplit = correctanswers.split(', ');
    divToAlter = document.getElementById("correctmeanings");

    correct = false;
    for (let i = 0; i < correctanswerssplit.length; i++) {
        if (correctanswerssplit[i].toLowerCase() == givenAnswer.toLowerCase()) {
            correct = true;
        }
    }

    if (givenAnswer.length == 0) {
        givenAnswer = "(brak odpowiedzi)";
    }

    if (correct) {
        divToAlter.innerHTML = correctanswers + ' <span style="opacity: 50%;">✔</span>';
        divToAlter.classList.add("correct");
    }
    else {
        divToAlter.innerHTML = '<span class="incorrect">' + givenAnswer + ' <span style="opacity: 50%;">✖</span></span><br>↓<br>' + correctanswers;
    }

    $.ajax({
        url: "php/reviewaction-updateresults.php",
        type: "post",
        data: { "kanji": kanji, "correct": correct, "type": "meaning"},
        success: function (result) {
            //alert(result);
        }
    });

    UpdateSubmit(correct);

};

function ReviewSubmitSymbol(chosenSymbol, correctSymbol) {

    divToAlter = document.getElementById("answer");

    if (chosenSymbol == correctSymbol) {
        correct = true;
        divToAlter.innerHTML = correctSymbol + ' <span style="opacity: 50%;">✔</span>';
        divToAlter.classList.add("correct");
    }
    else {
        correct = false;
        divToAlter.innerHTML = '<span class="incorrect">' + chosenSymbol + ' <span style="opacity: 50%;">✖</span></span><br>↓<br>' + correctSymbol;
    }

    $.ajax({
        url: "php/reviewaction-updateresults.php",
        type: "post",
        data: { "kanji": correctSymbol, "correct": correct, "type": "symbol" },
        success: function (result) {
            //alert(result);
        }
    });

    UpdateSubmit(correct);

};


function ReviewContinue() {
    Redirect("review");
};



function ForceReview() {

    $.ajax({
        url: "php/reviewaction-force.php",
        type: "post",
        //data: { "kanji": correctSymbol, "correct": correct, "type": "symbol" },
        success: function (result) {
            //alert(result);
        }
    });

    Redirect("review");

};


function Search() {

    searchTerm = document.getElementById("textbox-search").value.toLowerCase();
    document.getElementById("search-results-container").innerHTML = "";
    document.getElementById("search-results-total").innerHTML = "";
    licznikSlowo = "wyników";

    if (searchTerm == "" || searchTerm == "," || searchTerm == ", " || searchTerm == " ") {

        document.getElementById("search-results-total").innerHTML = "Proszę wpisać litery lub znak.";
    }
    else {

        $.ajax({
            url: "php/action-search.php",
            type: "post",
            data: { "searchterm": searchTerm },
            success: function (result) {
                //alert(result);
                result = result.split("#####");

                document.getElementById("search-results-container").innerHTML = result[0];

                if (parseInt(result[1]) == 1) {
                    licznikSlowo = "wynik";
                }
                else if (parseInt(result[1].slice(-1)) > 1 && parseInt(result[1].slice(-1)) < 5) {
                    licznikSlowo = "wyniki";
                }

                document.getElementById("search-results-total").innerHTML = "Znaleziono " + result[1] + " " + licznikSlowo + ".";
            }
        });
    }

};