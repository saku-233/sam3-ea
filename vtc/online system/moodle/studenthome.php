<?php include 'studenthome_header.php';
session_start();
?>

<body>

    <div class="wrapper">

        <aside class="sidebar">
            <a class="sidebar-item">🕒</a>
            <a class="sidebar-item">🎓</a>
            <a class="sidebar-item">📊</a>
            <a class="sidebar-item">📅</a>
        </aside>

        <main>
            <div class="content-container">

                <div class="announcement-box">
                    <h2>Moodle AY2025/26 Updates:</h2>
                    <div class="announcement-meta">by Admin User - Thursday, 4 September 2025, 2:58 PM</div>

                    <table class="announcement-table">
                        <thead>
                            <tr>
                                <th>Moodle Plugins / Integration</th>
                                <th>Moodle Plugins in AY2024/25</th>
                                <th>Substitute Solution for AY2025/26</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Anti-plagiarism Detection</td>
                                <td>Turnitin</td>
                                <td>VeriGuide</td>
                            </tr>
                            <tr>
                                <td>Learning Analytics</td>
                                <td>IntelliBoard</td>
                                <td>Moodle's built-in analytics features</td>
                            </tr>
                            <tr>
                                <td>MS Teams Integration</td>
                                <td>MS Teams Classroom and MS Teams Notification</td>
                                <td>Create MS Teams Classrooms directly in MS Teams</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="search-section">
                    <div class="search-box">
                        <input type="text" placeholder="Search courses">
                        <button>🔍</button>
                    </div>
                </div>

                <h1 class="section-title">My courses</h1>

                <div class="course-list">

                    <div class="course-card">
                        <div class="course-image">
                            <span class="placeholder-icon">🎓</span>
                        </div>
                        <div class="course-info">
                            <div>
                                <a href="#" class="course-name">DCD3303_DE_DEX_1( Art Jamming ) by YUK BIU CHAN</a>
                                <br>
                                <span class="course-teacher">Teacher: CHAN YUK BIU</span>
                            </div>
                            <a href="#" class="btn-enter">Enter this course</a>
                        </div>
                    </div>

                    <div class="course-card">
                        <div class="course-image">
                            <div style="width:100%; height:100%; background:#e67e22; display:flex; align-items:center; justify-content:center; color:white; font-weight:bold; font-size:24px;">
                                SEM 3 PROFESSIONALISM
                            </div>
                        </div>
                        <div class="course-info">
                            <div>
                                <a href="#" class="course-name">ITE4103_IT_ICT_1( IT Professionalism ) by NGA LING LI</a>
                                <br>
                                <span class="course-teacher">Teacher: LI NGA LING</span>
                            </div>
                            <a href="#" class="btn-enter">Enter this course</a>
                        </div>
                    </div>

                </div>

            </div>
        </main>
    </div>
    <?php include 'footer.php' ; ?>

</body>

</html>