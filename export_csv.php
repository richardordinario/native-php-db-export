<?php
include "connection.php";

if(isset($_GET["id"])) {
    $courseId = $_GET["id"];
    $courseId = htmlspecialchars($courseId);

    $sql = "SELECT users.email, courses.title, course_progress.created_at, course_progress.progress FROM course_progress 
        JOIN users ON course_progress.user_id = users.id 
        JOIN courses ON course_progress.course_id = courses.id 
        WHERE course_progress.course_id = $courseId AND course_progress.progress = 100 
        ORDER BY course_progress.created_at ASC";

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
    } else {
        echo "<br>No results found.";
    }

    $conn->close();

}
?>