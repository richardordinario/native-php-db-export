<?php
include "connection.php";

if(isset($_GET["id"])) {
    $courseId = $_GET["id"];
    $courseId = htmlspecialchars($courseId);

    echo "<br>";
    echo "<button>Export</button>";
    echo "<script>
        document.querySelector('button').addEventListener('click', function() {
            window.location.href = 'export_csv.php?id=$courseId';
        });
    </script>";

    $sql = "SELECT users.email, users.firstname, users.lastname, users.level_type, users.level, courses.title, course_progress.created_at, course_progress.progress FROM course_progress 
        JOIN users ON course_progress.user_id = users.id 
        JOIN courses ON course_progress.course_id = courses.id 
        WHERE course_progress.course_id = $courseId AND course_progress.progress = 100 
        ORDER BY course_progress.created_at ASC";

    $result = $conn->query($sql);
    
    if($result->num_rows > 0) {
    
    echo "<table>";
    echo "<tr>";
    echo "<th>Course</th>";
    echo "<th>Email</th>";
    echo "<th>First Name</th>";
    echo "<th>Last Name</th>";
    echo "<th>Level</th>";
    echo "<th>Institution</th>";
    echo "<th>Progress</th>";
    echo "<th>Date</th>";
    echo "<tr>";
    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['title']. "</td>";
        echo "<td>" . $row['email']. "</td>";
        echo "<td>" . $row['firstname']. "</td>";
        echo "<td>" . $row['lastname']. "</td>";
        echo "<td>" . $row['level']. "</td>";
        echo "<td>" . $row['level_type']. "</td>";
        echo "<td>" . $row['progress']. "</td>";
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