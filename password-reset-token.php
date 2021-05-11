<?php
if (isset($_POST['password-reset-token']) && isset($_POST['email'])) {
    include("includes/config.php");
    $selector = bin2hex(random_bytes(8));
    $token = random_bytes(32);

    $url = "http://localhost/Projects/Program/slotify/create-new-password.php?selector=" . $selector . "&validator=" . bin2hex($token) . "";

    $expires = date("U") + 1800;

    $userEmail = $_POST['email'];
    $sql = "DELETE FROM pwdRest WHERE pwdResetEmail=?";
    $stmt = mysqli_stmt_init($con);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        echo "Failed statement error";
        exit();
    } else {
        mysqli_stmt_bind_param($stmt, "s", $userEmail);
        mysqli_stmt_execute($stmt);
    }
    $sql = "INSERT INTO pwdRest(pwdResetEmail,pwdResetSelector,pwdResetToekn,pwdResetExpires) VALUES(?,?,?,?)";
    $stmt = mysqli_stmt_init($con);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        echo "Failed statement error";
        exit();
    } else {
        $hashToken = password_hash($token, PASSWORD_DEFAULT);
        mysqli_stmt_bind_param($stmt, "ssss", $userEmail, $selector, $hashToken, $expires);
        mysqli_stmt_execute($stmt);
    }
    mysqli_stmt_close($stmt);
    mysqli_close($con);
    $to = $userEmail;
    $subject = "Resset your password for slotify";
    $message = "<p>We receitved a password reset request.The link to reset your password is below if you did not make this request, your can ignore this email</p>";
    $message .= "<p>Here is your password reset lik: <br />";
    $message .= "<a href='{$url}'>{$url}</a></p>";
    $headers = "From: slotify <funnypicture23@gmail.com>\r\n";
    $headers .= "Reply-To: funnypicture23@gmail.com\r\n";
    $headers .= "Content-type: text/html\r\n";

    mail($to, $subject, $message, $headers);
    header("Location: forget-password.php?reset=success");
} else {
    header("location: register.php");
}
