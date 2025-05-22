<?php
session_start();
require_once '../../src/config/pfe_DB.php';

// Inscription
if (isset($_POST['register'])) {
  $first_name = $_POST['first_name'] ?? '';
  $last_name = $_POST['last_name'] ?? '';
  $email = $_POST['email'] ?? '';
  $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

  $stmt = $pdo->prepare("INSERT INTO client (first_name, last_name, email, password) VALUES (?, ?, ?, ?)");
  $stmt->execute([$first_name, $last_name, $email, $password]);

  echo "<script>alert('Compte créé avec succès !');</script>";
}

// Connexion
if (isset($_POST['login'])) {
  $email = $_POST['email'] ?? '';
  $password = $_POST['password'] ?? '';

  $stmt = $pdo->prepare("SELECT * FROM client WHERE email = ?");
  $stmt->execute([$email]);
  $user = $stmt->fetch();

  if ($user && password_verify($password, $user['password'])) {
      $_SESSION['user'] = $user;
      header('Location: dashboard.php'); // page protégée
      exit;
  } else {
      echo "<script>alert('Email ou mot de passe incorrect');</script>";
  }
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>SignIn&SignUp</title>
    <link rel="stylesheet" type="text/css" href="../css/login.css" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer"/>

    <script
      crossorigin="anonymous"
    ></script>

  </head>
  <body>
    <div class="container">
      <div class="forms-container">
        <div class="signin-signup">
          <form action="" method="POST" class="sign-in-form">
            <h2 class="title">Sign In</h2>
            <div class="input-field">
              <i class="fas fa-envelope"></i>
              <input type="email" placeholder="Email" name="email" required />
            </div>
            <div class="input-field">
              <i class="fas fa-lock"></i>
              <input type="password" placeholder="Password" name="password" required />
            </div>
            <input type="submit" value="Login" name="login" class="btn solid" />

            <p class="social-text">Or Sign in with social platforms</p>
            <div class="social-media">
              <a href="#" class="social-icon">
                <i class="fab fa-facebook-f"></i>
              </a>
              <a href="#" class="social-icon">
                <i class="fab fa-twitter"></i>
              </a>
              <a href="#" class="social-icon">
                <i class="fab fa-google"></i>
              </a>
              <a href="#" class="social-icon">
                <i class="fab fa-linkedin-in"></i>
              </a>
            </div>
          </form>


          <form action="" method="POST" class="sign-up-form">
            <h2 class="title">Sign Up</h2>

            <div class="input-field">
              <i class="fas fa-user"></i>
              <input type="text" placeholder="First Name" name="first_name" required />
            </div>
            <div class="input-field">
              <i class="fas fa-user"></i>
              <input type="text" placeholder="Last name" name="last_name" required />
            </div>
            <div class="input-field">
              <i class="fas fa-envelope"></i>
              <input type="email" placeholder="Email" name="email" required />
            </div>
            <div class="input-field">
              <i class="fas fa-lock"></i>
              <input type="password" placeholder="Password" name="password" required />
            </div>
            <input type="submit" value="Sign Up" name="register" class="btn solid" />

            <p class="social-text">Or Sign up with social platforms</p>
            <div class="social-media">
              <a href="#" class="social-icon">
                <i class="fab fa-facebook-f"></i>
              </a>
              <a href="#" class="social-icon">
                <i class="fab fa-twitter"></i>
              </a>
              <a href="#" class="social-icon">
                <i class="fab fa-google"></i>
              </a>
              <a href="#" class="social-icon">
                <i class="fab fa-linkedin-in"></i>
              </a>
            </div>
          </form>
        </div>
      </div>
      <div class="panels-container">

        <div class="panel left-panel">
            <div class="content">
                <h3>New here?</h3>
                <p>if you dont have an account just click the SIGN UP button and create one and welcom to our family </p>

                <button class="btn transparent" id="sign-up-btn">Sign Up</button>
            </div>
            <img src="./img/log.png" class="image" alt="">
        </div>

        <div class="panel right-panel">
            <div class="content">
                <h3>One of us?</h3>
                <p>You already have an account just click the SING IN button and Login with your account</p>
                <button class="btn transparent" id="sign-in-btn">Sign In</button>
            </div>
            <img src="./img/register.png" class="image" alt="">
        </div>
      </div>
    </div>

    <script src="../../src/js/login.js"></script>
  </body>
</html>
