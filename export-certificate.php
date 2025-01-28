<?php
include "connection.php";

if(isset($_GET["id"])) {
    $certId = $_GET["id"];
    $certId = htmlspecialchars($certId);

    echo "<br>";
    echo "<button>Export</button>";
    echo "<script>
        document.querySelector('button').addEventListener('click', function() {
            window.location.href = 'export-certificate-csv.php?id=$certId';
        });
    </script>";

    $sql = "SELECT users.email, users.firstname, users.lastname, users.level_type, users.level, user_certificates.created_at FROM user_certificates 
        JOIN users ON user_certificates.user_id = users.id 
        WHERE user_certificates.certificate_id = $certId 
        ORDER BY user_certificates.created_at ASC";

    $result = $conn->query($sql);
    
    if($result->num_rows > 0) {
    
    echo "<table>";
    echo "<tr>";
    echo "<th>Email</th>";
    echo "<th>First Name</th>";
    echo "<th>Last Name</th>";
    echo "<th>Level</th>";
    echo "<th>Institution</th>";
    echo "<th>Created At</th>";
    echo "<tr>";
    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['email']. "</td>";
        echo "<td>" . $row['firstname']. "</td>";
        echo "<td>" . $row['lastname']. "</td>";
        echo "<td>" . $row['level']. "</td>";
        echo "<td>" . $row['level_type']. "</td>";
        echo "<td>" . $row['created_at']. "</td>";
        echo "</tr>";
    }
        echo "<table>";
    } else {
        echo "<br>No results found.";
    }


  ;

}
?>