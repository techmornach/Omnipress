<html>

<head>
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="/om.admin/css/login.css" />
</head>

<body>
    <header class="head">
        <h1>OMNIPRESS</h1>
        <p>Website and content management creator</p>
    </header>
    <main>

        <form action="../om.incs/login.php?redirect=<?php echo $_SERVER['PHP_SELF']; ?>" method="post" class="form" id="login">
            <h3>Admin Panel</h3>
            <div class="form-section">
                <div class="form-input">
                    <input type="email" name="email" placeholder="Email">
                </div>
                <div class="form-input">
                    <input type="password" name="password" placeholder="Password">
                </div>
                <button type="submit" class="submit-button">Login</button>
                <p>
                    <button id="forgot-password-button" class="link">forgot password?</button>
                </p>

            </div>
            <div class="hidden error">
                <p><?php
                    ini_set('display_errors', 1);
                    ini_set('display_startup_errors', 1);
                    error_reporting(E_ALL);

                    if (isset($_REQUEST['login_msg'])) {
                        require '../om.incs/login-codes.php';
                        $login_msg = $_REQUEST['login_msg'];
                        if (isset($login_msg_codes[$login_msg])) {
                            echo '<p>' . $login_msg_codes[$login_msg] . '</p>' . '
            <script>
              document.querySelector(".error").setAttribute("class", "showerror error");
                  window.setTimeout(() => {
      document.querySelector(".error").setAttribute("class", "hidden error");
    }, 6000)
              </script>';
                        }
                    }
                    ?></p>
            </div>
        </form>
        <form action="../om.incs/password-reminder.php?redirect=<?php echo $_SERVER['PHP_SELF']; ?>" method="post" class="form" id="forgot-password">
            <h3>Forgot Password</h3>
            <div class="form-section">
                <div class="form-input">
                    <input type="email" name="email" placeholder="Email">
                </div>
                <button type="submit" class="submit-button">Submit</button>
                <p>
                    <button id="login-button" class="link">back to login</button>
                </p>
            </div>

        </form>
    </main>

    <script src="/om.admin/js/login.js"></script>
</body>

</html>