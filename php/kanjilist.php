<div class="centered-container">
<?php

$delayaddition = 0.005;

// big fat user check
if (isset($_SESSION['username'])) {

    
    // get this user's kanji progress and beginner kanji
    //     $kanjiprogress
    //     $kanjiprogresssymbols
    //     $beginnerkanji
    //     $availablekanji
    include('php/refresh-kanjiprogress.php');

    include('php/connect.php');

    $sql = "SELECT * FROM kanji ORDER BY sortid";
    $result = $conn->query($sql);
    $conn->close();

    $delay = 0;

    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {

            // check if has progress
            if (array_search($row["kanji"], $kanjiprogresssymbols) === NULL) {
                echo('<a class="kanjitile" href="index.php?page=kanji&kanji=' . $row["kanji"] . '" style="animation-delay: ' . $delay . 's;">' . $row["kanji"] . '</a>');
                $delay = $delay + $delayaddition;
            }
            else {

                $progress = -1;
                // pick a class
                    // 0: new
                    // 1-4: beginner
                    // 5-7 good
                    // 7-8: great
                    // 10+ master
                for ($i = 0; $i < count($kanjiprogress); $i++) {
                    if ($kanjiprogress[$i]['kanji'] == $row["kanji"]) {
                        $progress = intval($kanjiprogress[$i]['progress']);
                    }
                }

                if ($progress == 0) {
                    $class = "new";
                }
                else if ($progress > 0 && $progress < 5) {
                    $class = "beginner";
                }
                else if ($progress > 4 && $progress < 8) {
                    $class = "good";
                }
                else if ($progress > 7 && $progress < 10) {
                    $class = "great";
                }
                else if ($progress > 9) {
                    $class = "master";
                }
                else {
                    $class = "kanjitile";
                }

                echo('<a class="kanjitile ' . $class . '" href="index.php?page=kanji&kanji=' . $row["kanji"] . '" style="animation-delay: ' . $delay . 's;"">' . $row["kanji"] . '</a>');
                $delay = $delay + $delayaddition;
                
            }

            

        }

    } else {
        echo "0 results";
    }

    $result->close();





}
else {

    include('php/connect.php');

    $sql = "SELECT * FROM kanji ORDER BY sortid";
    $result = $conn->query($sql);
    $conn->close();

    $delay = 0;

    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {

            echo('<a class="kanjitile" href="index.php?page=kanji&kanji=' . $row["kanji"] . '" style="animation-delay: ' . $delay . 's;">' . $row["kanji"] . '</a>');
            $delay = $delay + $delayaddition;

        }

    } else {
        echo "0 results";
    }

    $result->close();

}



?>
</div><br><br>