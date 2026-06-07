<?php session_start(); ?>
    <!DOCTYPE html>
    <html lang="zh-Hant">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>VTC Sign In / 登入</title>
        <style>
            * {
                box-sizing: border-box;
                margin: 0;
                padding: 0;
                font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
            }

            body,
            html {
                height: 100%;
                background-color: #ffffff;
                overflow-x: hidden;
            }

            /* 使用傳統 Table-cell 布局確保舊型與環境相容性，且不使用 flex 避免跑版 */
            .wrapper {
                display: table;
                width: 100%;
                height: 100%;
                table-layout: fixed;
            }

            .row {
                display: table-row;
            }

            /* 左側大圖視覺區 */
            .visual-side {
                display: table-cell;
                width: 75%;
                position: relative;
                vertical-align: middle;

                background: linear-gradient(115deg, #fbc5d8 0%, #fef4cf 30%, #bbfed9 70%, #95dfd0 100%);
                background-size: cover;
            }

            /* 模擬圖中的浮動圖片與設計元素（這裡用區塊示意，可自行替換成 img 標籤） */
            .visual-container {
                width: 100%;
                height: 100%;
                position: relative;
                padding: 40px;
            }

            .center-title {
                position: absolute;
                top: 25%;
                left: 55%;
                text-align: center;
                color: #555555;
            }

            .center-title h1 {
                font-size: 38px;
                font-weight: bold;
                letter-spacing: 2px;
                margin-bottom: 5px;
            }

            .center-title h2 {
                font-size: 28px;
                font-weight: 500;
                letter-spacing: 5px;
            }

            /* 右側登入表單區 */
            .login-side {
                display: table-cell;
                width: 25%;
                background-color: #ffffff;
                vertical-align: top;
                padding: 60px 35px 30px 35px;
                position: relative;
                box-shadow: -5px 0 15px rgba(0, 0, 0, 0.05);
            }

            .logo-container {
                margin-bottom: 40px;
            }

            .logo-text {
                font-size: 32px;
                font-weight: bold;
                font-style: italic;
                color: #0d47a1;
            }

            .logo-text span {
                color: #ff9100;
            }

            .instruction-text {
                font-size: 11px;
                color: #333333;
                line-height: 1.5;
                margin-bottom: 20px;
            }

            /* 表單樣式 */
            .form-group {
                margin-bottom: 12px;
            }

            .input-field {
                width: 100%;
                padding: 6px 10px;
                font-size: 12px;
                border: 1px solid #ababab;
                color: #333333;
                outline: none;
            }

            .input-field:focus {
                border-color: #4a90e2;
            }

            .btn-signin {
                background-color: #0066cc;
                color: #ffffff;
                border: none;
                padding: 6px 18px;
                font-size: 12px;
                cursor: pointer;
                margin-top: 10px;
                margin-bottom: 25px;
            }

            .btn-signin:hover {
                background-color: #0052a3;
            }

            /* 連結樣式 */
            .links-group {
                font-size: 11px;
                margin-bottom: 20px;
            }

            .links-group a {
                color: #0066cc;
                text-decoration: none;
            }

            .links-group a:hover {
                text-decoration: underline;
            }

            .help-text {
                font-size: 11px;
                color: #333333;
                line-height: 1.5;
            }

            .help-text a {
                color: #0066cc;
                text-decoration: none;
            }

            /* 頁尾樣式 */
            .form-footer {
                position: absolute;
                bottom: 20px;
                left: 35px;
                right: 35px;
                font-size: 10px;
                color: #666666;
                text-align: left;
            }

            .form-footer a {
                color: #333333;
                text-decoration: none;
                margin-right: 8px;
            }

            .form-footer a:hover {
                text-decoration: underline;
            }

            /* 響應式斷點：當螢幕太小時自動切換為單欄 */
            @media (max-width: 1024px) {

                .wrapper,
                .row {
                    display: block;
                }

                .visual-side {
                    display: none;
                }

                .login-side {
                    display: block;
                    width: 100%;
                    height: 100%;
                    padding-top: 100px;
                }
            }
        </style>
    </head>

    <body>

        <div class="wrapper">
            <div class="row">

                <div class="visual-side">
                    <div class="visual-container">
                        <div class="center-title">
                            <h1>SIGN IN</h1>
                            <h2>登入</h2>
                        </div>

                    </div>
                </div>

                <div class="login-side">

                    <div class="logo-container">
                        <img src="/vtc/image/logo-default.png" alt="VTC logo">
                    </div>

                    <div class="instruction-text">
                        Please logon by your CNA email address and Password<br>
                        請輸入你的 CNA 電郵地址及密碼登入
                    </div>

                    <form action="functions.php?op=checkLogin" method="POST">
                        <div class="form-group">
                            <input type="text" name="email" class="input-field" placeholder="someone@vtc.edu.hk or studentno@stu.vtc.edu.hk" required>
                        </div>

                        <div class="form-group">
                            <input type="password" name="password" class="input-field" placeholder="Password" required>
                        </div>

                        <button type="submit" class="btn-signin">Sign in</button>
                    </form>

                    <div class="links-group">
                        <a href="/vtc/online system/moodle/Forgot_your_password.php">Forgot your password?</a>
                        &nbsp;&nbsp;&nbsp;
                        <a href="/vtc/online system/moodle/Change_password.php">Change password</a>
                    </div>

                    <div class="help-text">
                        Please contact ITO Helpdesk (Email: <a href="mailto:ito-helpdesk@vtc.edu.hk">ito-helpdesk@vtc.edu.hk</a>) if you have any further questions.
                    </div>

                    <div class="form-footer">
                        <a href="#">Email & CNA Services Portal</a>
                        <a href="#">Privacy</a>
                        <a href="#">Contact</a>
                    </div>

                </div>

            </div>
        </div>

    </body>

    </html>