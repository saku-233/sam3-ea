<footer class="site-footer">
    <div class="footer-sidebar-indicator">
        <span class="arrow-icon">«</span>
    </div>

    <div class="footer-content">
        <p class="copyright">Copyright (c) Vocational Training Council. All rights reserved.</p>
        <div class="footer-links">
            <a href="#">Data retention summary</a>
            <a href="#">Get the mobile app</a>
        </div>
    </div>

    <div class="quick-tips-badge" id="quickTipsBadge">
        <div class="tips-icon">💡
        </div>
        <div class="tips-text">Quick Tips
        </div>
        <button class="close-tips" onclick="document.getElementById('quickTipsBadge').style.display='none'">×</button>
    </div>
</footer>

<style>
    .site-footer {
        clear: both;
        width: 100%;
        min-height: 120px;
        background-color: #2b303c !important;
        display: flex;
        align-items: stretch;
        position: relative;
        margin-top: 50px;
        border-top: 1px solid #1a1e24;
    }

    .footer-sidebar-indicator {
        width: 50px;
        background-color: #e67e22 !important;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #ffffff !important;
        cursor: pointer;
        user-select: none;
    }

    .footer-sidebar-indicator .arrow-icon {
        font-size: 16px;
        font-family: serif;
        font-weight: bold;
    }

    .footer-content {
        flex: 1;
        padding: 25px 30px !important;
        text-align: left !important;
    }

    .footer-content .copyright {
        color: #9facb6 !important;
        font-size: 13px !important;
        font-weight: normal !important;
        margin: 0 0 12px 0 !important;
        font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
    }

    .footer-content .footer-links {
        display: flex;
        flex-direction: column;
        gap: 10px;
    }

    .footer-content .footer-links a {
        color: #3498db !important;
        font-size: 13px !important;
        text-decoration: none !important;
        font-weight: normal !important;
    }

    .footer-content .footer-links a:hover {
        text-decoration: underline !important;
        color: #2980b9 !important;
    }

    .quick-tips-badge {
        position: absolute;
        right: 30px;
        bottom: 25px;
        background-color: #e67e22 !important;
        color: white !important;
        padding: 8px 12px !important;
        border-radius: 4px !important;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        gap: 2px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        min-width: 80px;
    }

    .quick-tips-badge .tips-icon {
        font-size: 20px !important;
        line-height: 1;
    }

    .quick-tips-badge .tips-text {
        font-size: 11px !important;
        font-weight: bold !important;
        white-space: nowrap;
        color: white !important;
    }

    .quick-tips-badge .close-tips {
        position: absolute;
        top: 0px;
        right: 4px;
        background: none !important;
        border: none !important;
        color: rgba(255, 255, 255, 0.7) !important;
        font-size: 14px !important;
        cursor: pointer;
    }

    .quick-tips-badge .close-tips:hover {
        color: white !important;
    }
</style>