<html>
<head>
    <title> Home </title>
    <link rel = "stylesheet" href = "../style/sidebar.css">
    <script src="https://kit.fontawesome.com/b99e675b6e.js"></script>
</head>
<body>
<input type = "checkbox" id = "check">
<label for = "check">
    <i class = "fas fa-bars" id = "btn"></i>
    <i class = "fas fa-times" id = "cancel"></i>
</label>
    <div class = "sidebar">
        <header> Sidebar </header>
        <ul>
                <li><a href = "../pages/home-page.php"><i class = "fas fa-qrcode"></i>Home</a></li>
                <li><a href = "../pages/teacher-exams.html"><i class = "fas fa-stream"></i>Exams</a></li>
                <li><a href = "../pages/questionsTeacher.html"><i class = "fas fa-stream"></i>Questions</a></li>
                <li><a href = "#"><i class = "fas fa-chalkboard-teacher"></i>Grades</a></li>
                <li><a href = "../pages/profile-setting.php"><i class="fas fa-user-cog"></i>Profile</a></li>
                <li><a href = "../pages/login.html" onclick="logout()"><i class = "fas fa-power-off"></i>Logout</a></li>
        </ul>
    </div>
    
    <section> 
        <div class = "header">Welcome to your Dashboard!</div>
        <div class = "info"> 
            <div> Upcoming exams <br>
            <table class = "content-table">
                <thead>
                    <tr>
                <?
                include 'config.php';
                $user = $_COOKIE["username"];
                $userQuery = "SELECT *
                    FROM Teachers, Exams  WHERE Teachers.tUsername=Exams.teachID = $user";
                $result = mysqli_query($conn, $userQuery);
                if (!$result) {
                    echo mysqli_error($conn);
                }
                if (mysqli_num_rows($result) == 0) {
                    print "There are no upcoming exams";
                }else { 
                    print "<th>Exam name</th><th>Course name</th><th>Exam date</th><th>Exam start</th><th>Exam finish</th>";
                    print "</tr>";
                    print "</thead>";
                    print "<tbody>";
                    while( $row = mysqli_fetch_assoc($result) ){
                        print "<tr><td>". $row['eName']. "</td><td>" . $row['eCourse'] . "</td><td>" . $row['eDate'] . "</td><td>" . $row['eStart'] . "</td><td>" . $row['eFinish'] .  "</td></tr>";		
                }
				print "</tbody>";
            }
                mysqli_close($conn); 
                ?> 
            </table> 
            </div>
            <div> Questions you uploaded <br>
            <table class = "content-table">
                <thead>
                    <tr>
                <?
                include 'config.php';
                $user = $_COOKIE["username"];
                $userQuery = "SELECT *
                    FROM Teachers, Questions  WHERE Teachers.tUsername=Questions.tID=$user ORDER BY Questions.examID ASC";
                $result = mysqli_query($conn, $userQuery);
                if (!$result) {
                    echo mysqli_error($conn);
                }
                if (mysqli_num_rows($result) == 0) {
                    print "You haven't created any questions yet";
                }else { 
                    print "<th>QuestionID</th><th>Content</th><th>Type</th><th>Answer</th><th>Score(max)</th>";
                    print "</tr>";
                    print "</thead>";
                    print "<tbody>";
                    while( $row = mysqli_fetch_assoc($result) ){
                        print "<tr><td>". $row['qID']. "</td><td>" . $row['question'] . "</td><td>" . $row['qType'] . "</td><td>" . $row['qAnswer'] . "</td><td>" . $row['qScore'] .  "</td></tr>";		
                    }
                    print "</tbody>";				
                }
                mysqli_close($conn); 
                ?>
            </table>
            </div>
        </div>
    </section>

</body>
</html>
