<?php
if (isset($_GET['kanji'])) {
    $kanji = $_GET['kanji'];
    
    include('php/connect.php');

    $sql = "SELECT * FROM kanji WHERE kanji = ?";
    $sql = $conn->prepare($sql);
    $sql->bind_param('s', $kanji);
    $sql->execute();
    $result = $sql->get_result();
    $kanjiinfo = $result->fetch_array(MYSQLI_ASSOC);

    $result->close();
    $sql->close();

    $sql = "SELECT * FROM kanji WHERE sortid = ?";
    $sql = $conn->prepare($sql);
    $parameter = $kanjiinfo['sortid'] - 1;
    $sql->bind_param('i', $parameter);
    $sql->execute();
    $result = $sql->get_result();
    $kanjipreviousinfo = $result->fetch_array(MYSQLI_ASSOC);

    $result->close();
    $sql->close();

    $sql = "SELECT * FROM kanji WHERE sortid = ?";
    $sql = $conn->prepare($sql);
    $parameter = $kanjiinfo['sortid'] + 1;
    $sql->bind_param('i', $parameter);
    $sql->execute();
    $result = $sql->get_result();
    $kanjinextinfo = $result->fetch_array(MYSQLI_ASSOC);

    $result->close();
    $sql->close();

    $conn->close();

    // display the page
    if (empty($kanjiinfo)) {
        //echo('<script>MainPage();</script>');
        include('php/kanjilist.php');
    }
    else {
        $kanjimeaning = $kanjiinfo['meaning'];
        $kanjidesc = $kanjiinfo['description'];
        $kanjireadingskun = $kanjiinfo['readingskun'];
        $kanjireadingson = $kanjiinfo['readingson'];

        if (empty($kanjipreviousinfo)) {
            $kanjiprevious = null;
        }
        else {
            $kanjiprevious = $kanjipreviousinfo['kanji'];
        }
        if (empty($kanjinextinfo)) {
            $kanjinext = null;
        }
        else {
            $kanjinext = $kanjinextinfo['kanji'];
        }
        
        include('php/kanjilayout.php');
    }

    unset($kanjiinfo);
    unset($kanjipreviousinfo);
    unset($kanjinextinfo);
}
else {
    include('php/kanjilist.php');
}
?>