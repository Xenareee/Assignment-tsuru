<?php

include(__DIR__ . '/connect.php');
  
$sql = "SELECT * FROM kanjiuser";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
// output data of each row
while($row = $result->fetch_assoc()) {
    echo("<br>username: " . $row["username"] . "<br>pet: " . $row["pet"] . "<br>profilepicture: " . $row["profilepicture"] . "<br>");
}
} else {
echo "0 results";
}

$conn->close();

?>