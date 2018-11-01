<?php
require_once '../controller/admin_login_controller.php';

if(!isset($_SESSION)){
    session_start();
}

// Get the error message to display in this page
if (isset($_SESSION["error_message"]))
{
        $error_message = $_SESSION["error_message"];
        unset($_SESSION["error_message"]);
}

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){

        $admin_login_controller = new AdminLoginController();
        $admin_login_controller->admin_login();

        // Get the error message to display in this page
        if (isset($_SESSION["error_message"]))
        {
                $error_message = $_SESSION["error_message"];
                header("location: login.php");
        }
        else
        {
                header("location: dashboard.php");
        }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include_once('../includes/head.php'); ?>
</head>

<body>

    <?php
        if( isset($error_message) ) { ?>
                <div class="alert alert-danger homealert" role="alert" align="center">
                        <strong><?php echo $error_message ?></strong>
                </div>
    <br/>
    <?php } else { ?>
    <br/>
            <?php if( isset($info_message) ) { ?>
                <div class="alert alert-success homealert" role="alert" align="center">
                        <strong><?php echo $info_message ?></strong>
                </div>
            <?php } else if (isset($warning_message)) { ?>
                <div class="alert alert-danger homealert" role="alert" align="center" style="color:red;width:94%"><?php echo $warning_message ?>
                    </div>
            <?php } ?>
    <br/>
    <?php } ?>

    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Please Sign In</h3>
                    </div>
                    <div class="panel-body">
                        <form class="form-signin" action="login.php" method="post">
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Username" name="username" type="text" autofocus>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Password" name="password" type="password" value="">
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input name="remember" type="checkbox" value="Remember Me">Remember Me
                                    </label>
                                </div>
                                <!-- Change this to a button or input when using this as a form -->
                                <button class="btn btn-lg btn-primary btn-block btn-signin" type="submit">Login</button>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include_once('../includes/js.php'); ?>
</body>

</html>
