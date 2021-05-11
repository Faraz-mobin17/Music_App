<?php
include("includes/config.php");
include("includes/classes/Account.php");
include("includes/classes/Constants.php");

$account = new Account($con);

include("includes/handlers/register-handler.php");
include("includes/handlers/login-handler.php");

function getInputValue($name)
{
    if (isset($_POST[$name])) {
        echo $_POST[$name];
    }
}
?>

<html>

<head>
    <title>Welcome to Slotify!</title>
    <script src="https://kit.fontawesome.com/3dee8755de.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <img class="wave" src="assets/images/wave.png">
    <div id="illustration">
        <img src="assets/images/music.svg" alt="illustration" style="max-width: 100%;">
    </div>
    <div id="bg">

        <div id="loginContainer ">
            <div id="inputContainer">
                <form id="loginForm" action="register.php" method="POST">
                    <div class="avatar-container">
                        <img src="assets/images/avatar.svg" alt="avatar image" style="width: 100%">
                    </div>
                    <h1 style="text-align: center;color: #555; font-weight: bold; font-family: 'Poppins',sans-serif;">WELCOME</h1>
                    <p>
                        <?php echo $account->getError(Constants::$loginFailed); ?>
                    <div class="input-div one">
                        <div class="i">
                            <i class="fas fa-user"></i>
                        </div>
                        <div>
                            <label for="loginUsername">Username</label>
                            <input id="loginUsername" class="input" name="loginUsername" type="text" placeholder="e.g. bartSimpson" value="<?php getInputValue('loginUsername') ?>" required>
                        </div>
                    </div>
                    </p>

                    <p>
                    <div class="input-div pass">
                        <div class="i">
                            <i class="fas fa-lock"></i>
                        </div>
                        <div>
                            <label for="loginPassword">Password</label>
                            <input id="loginPassword" class="input" name="loginPassword" type="password" placeholder="Your password" required>
                        </div>
                    </div>
                    </p>

                    <button type="submit" name="loginButton">LOGIN</button>
                    <a href="forget-password.php" class="forgot-pwd">Forgot password ?</a>
                    <div class="hasAccountText">
                        <span id="hideLogin">Don't you have an account ? Sign up here</span>
                    </div>
                </form>



                <form id="registerForm" action="register.php" method="POST">
                    <div class="avatar-container">
                        <img src="assets/images/account.svg" alt="accountimage" style="max-width: 100%;">
                    </div>
                    <h2>Create your free account</h2>
                    <p>
                        <?php echo $account->getError(Constants::$usernameCharacters); ?>
                        <?php echo $account->getError(Constants::$usernameTaken); ?>
                        <label for="username">Username</label>
                        <input id="username" class="input" name="username" type="text" placeholder="e.g. bartSimpson" value="<?php getInputValue('username') ?>" required>
                    </p>

                    <p>
                        <?php echo $account->getError(Constants::$firstNameCharacters); ?>
                        <label for="firstName">First name</label>
                        <input id="firstName" class="input" name="firstName" type="text" placeholder="e.g. Bart" value="<?php getInputValue('firstName') ?>" required>
                    </p>

                    <p>
                        <?php echo $account->getError(Constants::$lastNameCharacters); ?>
                        <label for="lastName">Last name</label>
                        <input id="lastName" class="input" name="lastName" type="text" placeholder="e.g. Simpson" value="<?php getInputValue('lastName') ?>" required>
                    </p>

                    <p>
                        <?php echo $account->getError(Constants::$emailsDoNotMatch); ?>
                        <?php echo $account->getError(Constants::$emailInvalid); ?>
                        <?php echo $account->getError(Constants::$emailTaken); ?>
                        <label for="email">Email</label>
                        <input id="email" class="input" name="email" type="email" placeholder="e.g. bart@gmail.com" value="<?php getInputValue('email') ?>" required>
                    </p>

                    <p>
                        <label for="email2">Confirm email</label>
                        <input id="email2" class="input" name="email2" type="email" placeholder="e.g. bart@gmail.com" value="<?php getInputValue('email2') ?>" required>
                    </p>

                    <p>
                        <?php echo $account->getError(Constants::$passwordsDoNoMatch); ?>
                        <?php echo $account->getError(Constants::$passwordNotAlphanumeric); ?>
                        <?php echo $account->getError(Constants::$passwordCharacters); ?>
                        <label for="password">Password</label>
                        <input id="password" class="input" name="password" type="password" placeholder="Your password" required>
                    </p>

                    <p>
                        <label for="password2">Confirm password</label>
                        <input id="password2" class="input" name="password2" type="password" placeholder="Your password" required>
                    </p>

                    <button type="submit" name="registerButton">SIGN UP</button>

                    <div class="hasAccountText">

                        <span id="hideRegister">If you have an account already Login here</span>
                    </div>
                </form>


            </div>

        </div>
        <script src="http://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
        <script src="assets/js/register.js"></script>
        <?php if (isset($_POST['registerButton'])) {
            echo '
  <script>
  $(document).ready(function(){
      
      $("#loginForm").hide();
      $("#registerForm").show();
  });
</script>
      ';
        } else {
            echo '
      <script>
        $(document).ready(function(){
            
            $("#loginForm").show();
            $("#registerForm").hide();
        });
      </script>';
        } ?>

        <script>
            const inputs = document.querySelectorAll(".input");


            function addcl() {
                let parent = this.parentNode.parentNode;
                parent.classList.add("focus");

            }

            function remcl() {
                let parent = this.parentNode.parentNode;
                if (this.value == "") {
                    parent.classList.remove("focus");
                }

            }


            inputs.forEach(input => {
                input.addEventListener("focus", addcl);
                input.addEventListener("blur", remcl);
            });
        </script>
</body>

</html>