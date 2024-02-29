<?php

$seconds = $seconds - time();

if ($seconds < 60) {

    if ($seconds == 1) {
        $duration = $seconds . " sekundę";
    }
    else if (($seconds % 10) > 1 && ($seconds % 10) < 5) {
        $duration = $seconds . " sekundy";
    }
    else {
        $duration = $seconds . " sekund";
    }
  
}
else if ($seconds < 3600) {

    $seconds = floor($seconds / 60);

    if ($seconds == 1) {
        $duration = $seconds . " minutę";
    }
    else if (($seconds % 10) > 1 && ($seconds % 10) < 5) {
        $duration = $seconds . " minuty";
    }
    else {
        $duration = $seconds . " minut";
    }

}
else if ($seconds < 86400) {

    $seconds = floor($seconds / 3600);

    if ($seconds == 1) {
        $duration = $seconds . " godzinę";
    }
    else if (($seconds % 10) > 1 && ($seconds % 10) < 5) {
        $duration = $seconds . " godziny";
    }
    else {
        $duration = $seconds . " godzin";
    }
}
else {

    $seconds = floor($seconds / 86400);

    if ($seconds == 1) {
        $duration = $seconds . " dzień";
    }
    else {
        $duration = $seconds . " dni";
    }

}

?>