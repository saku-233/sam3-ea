<?php include 'functions.php';
session_start();
?> 
<!DOCTYPE html>
<html lang="zh-Hant">
    <head>
        <title>CAS Login</title>
    </head>
    <body>
        <h1>staff Login</h1>
        <form method="post" action="functions.php?op=staffLogin">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required><br><br>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required><br><br>
            <input type="submit" value="Login">
        </form>
    </body>
</html>
