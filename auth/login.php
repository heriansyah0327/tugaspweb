<?php
    include("../lib/connection.php");
    session_start();

    if (isset($_SESSION["role"])) {
        if ($_SESSION["role"] == "author") {
            header("Location: /spiral/dashboard/author/index.php");
            exit();
        } else if ($_SESSION["role"] == "admin") {
            header("Location: /spiral/dashboard/admin/index.php");
            exit();
        }
    }

    $previousPage = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '/home.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome back - Sign In</title>
    <link rel="stylesheet" href="loginn.css"/>
    <script type="text/javascript" src="login.js" defer></script> 
    <script type="text/javascript" src="script.js" defer></script> 
</head>
<body>
    <header class="header" id="navbar">
      <div class="logo">
        <img src="/spiral/img/removebg.png" alt="Spiral Logo" class="logo-img" />
        <h1 onclick="window.location.href='/spiral/home.php'" style="cursor:pointer;">Spiral</h1>
      </div>

      <button
        class="dashboard-button hover-me"
        onclick="window.location.href='/spiral/home.php'">
        Home
      </button>
    </header>
    <nav class="navbar">
      <strong><span>Login</span></strong>
      <button id="open-sidebar" onclick="openSidebar()">
            <svg xmlns="http://www.w3.org/2000/svg" height="40px" viewBox="0 -960 960 960" width="40px" fill="#c9c9c9">
                <path
                    d="M165.13-254.62q-10.68 0-17.9-7.26-7.23-7.26-7.23-18t7.23-17.86q7.22-7.13 17.9-7.13h629.74q10.68 0 17.9 7.26 7.23 7.26 7.23 18t-7.23 17.87q-7.22 7.12-17.9 7.12H165.13Zm0-200.25q-10.68 0-17.9-7.27-7.23-7.26-7.23-17.99 0-10.74 7.23-17.87 7.22-7.13 17.9-7.13h629.74q10.68 0 17.9 7.27 7.23 7.26 7.23 17.99 0 10.74-7.23 17.87-7.22 7.13-17.9 7.13H165.13Zm0-200.26q-10.68 0-17.9-7.26-7.23-7.26-7.23-18t7.23-17.87q7.22-7.12 17.9-7.12h629.74q10.68 0 17.9 7.26 7.23 7.26 7.23 18t-7.23 17.86q-7.22 7.13-17.9 7.13H165.13Z" />
            </svg>
        </button>
    </nav>

    <main>
      <div class="card">
        <div class="back-button">
        <a href="/spiral/home.php"><span>&larr;</span></a>
        </div>

        <h1>Sign In</h1>
        <p class="subtitle">
          Hey, enter your details to login to your account.
        </p>

        <form action="login.php" method="post" name="form_login" class="login-form">
          <div class="input-group">
            <img src="/spiral/img/username.png" alt="username" class="input-icon" />
            <input type="text" id="username" name="username" placeholder="Username" />
          </div>

          <div class="input-group">
            <img src="/spiral/img/password.png" alt="password" class="input-icon" />
            <input type="password" id="password" name="password" placeholder="Password" />
            <img src="/spiral/img/eye.png" alt="show password" class="toggle-password" />
          </div>

          <button type="submit" name="submit" >Sign In</button>

          <p class="register-text">
            Don't have an account?
            <a href="/spiral/auth/register.php">Register now!</a>
          </p>
        </form>
      </div>
    </main>

    <footer>
      <p>&copy; 2024 Spiral - All Right Reserved.</p>
    </footer>

    <?php
        if(isset($_POST["submit"])) {
            $username = mysqli_real_escape_string($conn, $_POST['username']);
            $password = hash("sha256", $_POST["password"]);

            $result = mysqli_query($conn,"SELECT * FROM users WHERE username='$username' AND password='$password'");

            if ($result->num_rows > 0) {
                $row = mysqli_fetch_assoc($result);
                $_SESSION["id"] = $row["id"];
                $_SESSION["nama"] = $row["nama"];
                $_SESSION["role"] = $row["role"];

                if ($_SESSION["role"] == "admin") {
                    header("Location: /spiral/Blogpage/index.php");
                }
                else if ($_SESSION["role"] == "author") {
                    header("Location: /spiral/Blogpage/index.php");
                }
            }
            else {
                echo "<script>alert('Username atau password Anda salah. Silakan coba lagi!')</script>";
            }
        } 
    ?>
</body>
</html>