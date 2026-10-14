<?php
session_start();
include('include/config.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kada Hardware</title>

    <!-- Boxicons CDN Link -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>

    <!-- ASSETS CSS FILES -->
    <link href="assets/css/toastr.min.css" rel="stylesheet">
    <link href="assets/css/main.css" rel="stylesheet">

</head>
<body>
    <!-- ======= Header ======= -->
    <header>
        <div class="logo">KADA HARDWARE<span>.</span></div>

    </header><!-- End Header -->


    <!-- ======= SIGN IN / SIGN UP SECTION ======= -->
    <section>
        <div class="container">
            <div class="forms-container">
            <?php include('message.php');?>
                <div class="signin-signup">
                    <form action="include/server.php" method="POST" class="sign-in-form">
                        <h2 class="title">Sign in</h2>

                        <div class="input-field">
                            <i class="bx bxs-user"></i>
                            <input type="text" name="uname" placeholder="Username" required/>
                        </div>
                        

                        <div class="input-field">
                            <i class="bx bxs-lock-alt"></i>
                            <input type="password" name="pass" placeholder="Password" required/>
                        </div>

                        <div class="remember-forgot">
                            <label><input type="checkbox" name="">Remember me.</label>
                        </div>

                        <input type="submit" name="signInSubmit" value="Login" class="btn solid" />

                        <p class="signup-text">Don't have an account? <a href="#" class="sign-up-btn">Sign up.</a></p>
                    </form>

                    <form action="include/server.php" method="POST" class="sign-up-form">
                        <h2 class="title">Sign up</h2>

                        <div class="input-field">
                            <i class="bx bxs-user"></i>
                            <input type="text" name="uname" placeholder="Username" required/>
                        </div>

                        <div class="input-field">
                            <i class="bx bxs-envelope"></i>
                            <input type="email" name="email" placeholder="Email" required/>
                        </div>

                        <div class="input-field">
                            <i class="bx bxs-phone"></i>
                            <input type="text" name="phone" placeholder="+64" required/>
                        </div>

                        <div class="input-field">
                            <i class="bx bxs-lock-alt"></i>
                            <input type="password" name="pass" placeholder="Password" required/>
                        </div>

                        <div class="input-field">
                            <i class="bx bxs-lock-alt"></i>
                            <input type="password" name="cpass" placeholder="Confirm Password" required/>
                        </div>

                        <input type="submit" name="signUp" class="btn" value="Sign up" />

                        <p class="signup-text">Already have an account? <a href="#" class="sign-in-btn">Sign in.</a></p>
                    </form>
                </div>
            </div>
            
            <div class="panels-container">
                <div class="panel left-panel">
                    <img src="assets/img/programming.svg" class="image" alt="" />
                </div>
                <div class="panel right-panel">
                    <img src="assets/img/3.png" class="image" alt="" />
                </div>
            </div>
        </div>
    </section><!-- End Header -->

    
    <!-- ASSETS JS FILES -->
    <script src="assets/js/main.js"></script>
    <script>
        const sign_in_btn = document.querySelector(".sign-in-btn");
        const sign_up_btn = document.querySelector(".sign-up-btn");
        const container = document.querySelector(".container");
            
        sign_up_btn.addEventListener("click", () => {
        container.classList.add("sign-up-mode");
        });
            
        sign_in_btn.addEventListener("click", () => {
        container.classList.remove("sign-up-mode");
        });
    </script>
</body>
</html>