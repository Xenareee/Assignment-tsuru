<?php
// reset review queues if they're not created
if (!isset($_SESSION['priorityqueue'])) {    
    $_SESSION['priorityqueue'] = [];
}
if (!isset($_SESSION['reviewqueue'])) {    
    $_SESSION['reviewqueue'] = [];
}
if (!isset($_SESSION['meaningresults'])) {    
    $_SESSION['meaningresults'] = [];
}
if (!isset($_SESSION['symbolresults'])) {    
    $_SESSION['symbolresults'] = [];
}

//echo('<script>alert("reviewqueue count: ' . count($_SESSION['reviewqueue']) . '");</script>');

// get the list of all kanji.
//     $kanjidata
include('php/refresh-kanjidata.php');
// get this user's kanji progress and beginner kanji
//     $kanjiprogress
//     $kanjiprogresssymbols
//     $beginnerkanji
include('php/refresh-kanjiprogress.php');

// if there are less than 5 beginner kanji (if there ARE new kanji left), show a new one.
if (count($beginnerkanji) < 5 && count($kanjiprogress) < count($kanjidata)) {

    // search for the next one to learn.
    for ($i = 0; $i < count($kanjidata); $i++) {

        if (!in_array($kanjidata[$i]['kanji'], $kanjiprogresssymbols)) {
            
            $currentkanji = $kanjidata[$i]['kanji'];
            $currentkanjimeaning = explode(', ', $kanjidata[$i]['meaning'])[0];
            $currentkanjiallmeanings = $kanjidata[$i]['meaning'];
            $currentkanjidesc = $kanjidata[$i]['description'];
            break;
        }
    }

    // show a new kanji screen
    include('php/review-newkanji.php');
}


// otherwise decide what to review.
else {

    // check if priority queue is not empty.
    if (count($_SESSION['priorityqueue']) > 0) {

        // pick random kanji from the queue.
        $pickedkanji = $_SESSION['priorityqueue'][rand(0, (count($_SESSION['priorityqueue']) - 1))];

        $currentkanji = $pickedkanji['kanji'];
        $currentkanjimeaning = explode(', ', $pickedkanji['meaning'])[0];
        $currentkanjiallmeanings = $pickedkanji['meaning'];
        $currentkanjidesc = $pickedkanji['description'];

        if(isset($_SESSION['meaningresults'][$pickedkanji['kanji']])) {
            // show symbol review
            include('php/review-kanjisymbol.php');
        }
        else {
            // show meaning review
            include('php/review-kanjimeaning.php');
        }

    }

    // otherwise check the review queue.
    else if (count($_SESSION['reviewqueue']) > 0) {

        // pick random kanji from the queue.
        $pickedkanji = $_SESSION['reviewqueue'][rand(0, (count($_SESSION['reviewqueue']) - 1))];

        $currentkanji = $pickedkanji['kanji'];
        $currentkanjimeaning = explode(', ', $pickedkanji['meaning'])[0];
        $currentkanjiallmeanings = $pickedkanji['meaning'];
        $currentkanjidesc = $pickedkanji['description'];

        if(isset($_SESSION['meaningresults'][$pickedkanji['kanji']])) {
            // show symbol review
            include('php/review-kanjisymbol.php');
        }
        else {
            // show meaning review
            include('php/review-kanjimeaning.php');
        }
    }

    // if both queues are empty
    else {

        // check if there are results
        if (count($_SESSION['meaningresults']) > 0) {
            include('php/review-results.php');
        }
        // if not, create new queue
        else {

            if (count($availablekanji) > 0) {

                // pick max 5 random ones
                $picklimit = 5;
                $_SESSION['priorityqueue'] = [];
                $_SESSION['reviewqueue'] = [];
                $_SESSION['meaningresults'] = [];
                $_SESSION['symbolresults'] = [];

                if (count($availablekanji) < 5) {
                    $picklimit = count($availablekanji);
                }

                for ($i = 0; $i < $picklimit; $i++) {
                    $pickedkanjiid = rand(0, (count($availablekanji) - 1));
                    $pickedkanji = $availablekanji[$pickedkanjiid]['kanji'];

                    for ($j = 0; $j < count($kanjidata); $j++) {
                        if ($kanjidata[$j]['kanji'] == $pickedkanji) {
                            
                            $_SESSION['reviewqueue'][] = $kanjidata[$j];
                            \array_splice($availablekanji, $pickedkanjiid, 1); // remove chosen item from the pool
                            //break;
                        }
                    }
                }

                unset($picklimit);

                // redirect
                echo('<script>Redirect("review");</script>');

            }
            // if there's no kanji to review, redirect to main page.
            else {
                echo('<script>Redirect("dashboard");</script>');
            }

        }

    }




    
}


?>