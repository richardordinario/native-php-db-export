<?php
include "connection.php";

$sql = "SELECT * FROM users";
$result = $conn->query($sql);

if($result->num_rows > 0) {
    echo "<table>";
    echo "<tr>";
    echo "<th>Email</th>";
    echo "<th>First Name</th>";
    echo "<th>Last Name</th>";
    echo "<tr>";
    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['firstname']. "</td>";
        echo "<td>" . $row['lastname']. "</td>";
        echo "<td>" . $row['email']. "</td>";
        echo "</tr>";
    }
    echo "<table>";
} else {
    echo "<br>No results found.";
}

$conn->close();
?>