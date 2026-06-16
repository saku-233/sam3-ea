<?php
// 1. 配合你實際的檔案名稱，引入頭部與樣式
include 'myportal_header.php'; 
?>

<div class="welcome-banner">
    <h1>Welcome to MyPortal, <?php echo htmlspecialchars($student_name); ?>.</h1>
    <p><?php echo $current_date; ?></p>
</div>

<div class="quick-links">
    <a href="#" class="quick-item">
        <div class="quick-icon">📅</div>
        <div class="quick-label">Timetable</div>
    </a>
    <a href="#" class="quick-item">
        <div class="quick-icon">📆</div>
        <div class="quick-label">Calendar</div>
    </a>
    <a href="#" class="quick-item">
        <div class="quick-icon">👤</div>
        <div class="quick-label">Profile</div>
    </a>
    <a href="#" class="quick-item">
        <div class="quick-icon">📥</div>
        <div class="quick-label">Document Download</div>
    </a>
    <a href="#" class="quick-item">
        <div class="quick-icon">✍️</div>
        <div class="quick-label">Credit Transfer</div>
    </a>
</div>

<div class="notice-card">
    <div class="notice-title">Update on Electronic / Communication Devices Prohibited in Examination</div>
    <div class="notice-body">
        With the evolving variety and advancement of digital tools, in order to continuously ensure the integrity of the assessment process, the types of electronic / communication devices... <span style="color:red; font-weight:bold;">smart glasses and AI-enabled devices.</span>
    </div>
</div>

<section class="service-section">
    <h2>Online Student Service</h2>
    <table class="service-table">
        <tr>
            <td class="category-name">My Academics</td>
            <td class="link-group">
                <a href="#">Timetable</a>
                <a href="#">Online Module Selection</a>
            </td>
        </tr>
        <tr>
            <td class="category-name">Student Affairs</td>
            <td class="link-group">
                <a href="#">News and Announcement</a>
                <a href="#">Calendar</a>
                <a href="#">Career Treasure</a>
                <a href="#">e-Portfolio</a>
            </td>
        </tr>
        <tr>
            <td class="category-name">Campus Life</td>
            <td class="link-group">
                <a href="#">Student Activity</a>
                <a href="#">Facility</a>
                <a href="#">Locker</a>
            </td>
        </tr>
        <tr>
            <td class="category-name">eApplication</td>
            <td class="link-group">
                <a href="#">Student Photo Upload</a>
                <a href="#">Application for Credit Transfer / Module Exemption</a>
                <a href="#">Application for YTC Tuition Fee Remission Schemes</a>
            </td>
        </tr>
    </table>
</section>

<?php 

include 'myportal_footer.php'; 
?>