<header class="dashboard-header">
    <p>👋 Welcome <?php echo $_SESSION['userdata']['email'] ?></p>
    <button class="dashboard-profile-menu-button">
        <img src="/om.admin/images/profile.svg" alt="profile" width="40px" />
    </button>
    <nav class="dashboard-menu-dropdown-hidden" id="dashboard-menu-dropdown">
        <ul>
            <li><a href="/om.incs/logout.php?redirect=/om.admin" class="dropdown-item">Log out</a></li>
        </ul>
    </nav>
</header>