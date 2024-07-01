<?php
if (!isAdmin()) {
    require SCRIPTBASE . 'om.admin/auth/login.php';
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin | Dashboard</title>
    <link rel="stylesheet" type="text/css" href="/om.admin/css/dashboard.css" />
</head>

<body>
    <section class="dashboard">
        <?php require dirname(__DIR__) . "/components/nav.php" ?>
        <main class="dashboard-main">
            <?php require dirname(__DIR__) . "/components/header.php" ?>
            <section></section>
        </main>
    </section>
    <script src="/om.admin/js/dashboard.js"></script>
</body>

</html>