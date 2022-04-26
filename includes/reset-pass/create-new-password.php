<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Send Reset Password Link with Expiry Time in PHP MySQL</title>
    <!-- CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <div class="card">
            <div class="card-header text-center">
                Send Reset Password Link with Expiry Time in PHP MySQL
            </div>
            <div class="card-body">
                <?php
                $selector = $_GET["selector"];
                $validator = $_GET["validator"];
                if (empty($selector) || empty($validator)) {
                    //code ..
                    echo "We couldn't validate your request";
                } else {
                    if (ctype_xdigit($selector) !== false && ctype_xdigit($validator) !== false) {
                ?>
                        <form action="includes/reset-pass/reset-password.inc.php" method="post">
                            <input type="hidden" name="selector" value="<?php echo $selector; ?>">
                            <input type="hidden" name="selector" value="<?php echo $validator; ?>">
                            <input type="password" name="pwd" id="pwd" placeholder="Insert a new Password..">
                            <input type="password" name="pwd-repeat" id="pwd-repeat" placeholder="Repeat new password.">
                            <input type="submit" value="Reset Password" name="reset-password-submit">
                        </form>
                <?php
                    }
                }
                ?>
            </div>
        </div>
    </div>

</body>

</html>