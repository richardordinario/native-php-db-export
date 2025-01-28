<?php
include "connection.php";

if(isset($_GET["id"])) {
    $certId = $_GET["id"];
    $certId = htmlspecialchars($certId);


    $sql = "SELECT users.email, users.firstname, users.lastname, users.level_type, users.level, user_certificates.created_at FROM user_certificates 
        JOIN users ON user_certificates.user_id = users.id 
        WHERE user_certificates.certificate_id = $certId 
        ORDER BY user_certificates.created_at ASC";

    $result = $conn->query($sql);
    
    if($result->num_rows > 0) {
    
    while($row = $result->fetch_assoc()) {
        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename=data.csv');

        $output = fopen('php://output', 'w');

        $columns = $result->fetch_fields();
        $header = [];
        foreach ($columns as $col) {
            $header[] = $col->name;
        }
        fputcsv($output, $header);
        while ($row = $result->fetch_assoc()) {
            fputcsv($output, $row);
        }

        fclose($output);
    }
        echo "<table>";
    } else {
        echo "<br>No results found.";
    }

    $conn->close();

}
?>