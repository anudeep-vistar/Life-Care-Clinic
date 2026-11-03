
<?php
session_start();
include 'config.php';

$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $username = trim($_POST['username'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    $sql = "SELECT id, username, email, password, full_name
            FROM admins
            WHERE username = ? AND email = ?
            LIMIT 1";

    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "ss", $username, $email);
        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);
        $admin = mysqli_fetch_assoc($result);

        if ($admin && password_verify($password, $admin['password'])) {

            session_regenerate_id(true);

            $_SESSION['admin_id'] = $admin['id'];
            $_SESSION['admin_username'] = $admin['username'];
            $_SESSION['admin_name'] = $admin['full_name'] ?: $admin['username'];

            header("Location: ../dashboard.php");
            exit;

        } else {
            $error = "Username, Gmail or password is incorrect.";
        }

        mysqli_stmt_close($stmt);
    } else {
        $error = "Database query failed.";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>LifeCare Clinic | Admin Login</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

    <style>
        * {
            padding: 0;
            margin: 0;
            box-sizing: border-box;
        }

        body {
            min-height: 100vh;
            background: linear-gradient(135deg, #071b35, #083778, #1769a6);
           font-family: 'Inter', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 25px;
            overflow-x: hidden;
        }

        /* Background Shapes */

        .background {
            width: 430px;
            height: 560px;
            position: absolute;
            max-width: 90%;
        }

        .shape {
            position: absolute;
            height: 190px;
            width: 190px;
            border-radius: 50%;
            filter: blur(1px);
        }

        .shape:first-child {
            background: linear-gradient(135deg, #4db8ff, #083778);
            top: -65px;
            left: -65px;
        }

        .shape:last-child {
            background: linear-gradient(135deg, #6dd5c7, #2b8cba);
            bottom: -55px;
            right: -55px;
        }

        /* Login Box */

        .login-box {
            width: 430px;
            max-width: 100%;
            position: relative;
            z-index: 1;
            padding: 35px 38px;
            background: rgba(255, 255, 255, 0.12);
            border: 1px solid rgba(255, 255, 255, 0.25);
            border-radius: 20px;
            backdrop-filter: blur(18px);
            -webkit-backdrop-filter: blur(18px);
            box-shadow: 0 20px 55px rgba(0, 0, 0, 0.25);
        }

        /* Logo */

        
        .login-box h2 {
            color: #ffffff;
            text-align: center;
            font-size: 27px;
            font-weight: 600;
            margin-bottom: 5px;
        }

        .subtitle {
            text-align: center;
            color: #d9eaff;
            font-size: 15px;
            margin-bottom: 25px;
        }

        /* Form Fields */

        .form-group {
            margin-bottom: 17px;
        }

        .form-group label {
            display: block;
            color: #ffffff;
            font-size: 15px;
            font-weight: 500;
            margin-bottom: 8px;
        }

        .input-box {
            display: flex;
            align-items: center;
            gap: 12px;
            height: 48px;
            padding: 0 13px;
            background: rgba(255, 255, 255, 0.10);
            border: 1px solid rgba(255, 255, 255, 0.23);
            border-radius: 8px;
            transition: 0.3s;
        }

        .input-box:focus-within {
            border-color: #ffffff;
            background: rgba(255, 255, 255, 0.17);
            box-shadow: 0 0 0 3px rgba(255, 255, 255, 0.08);
        }

        .input-box i {
            color: #d5e8ff;
            font-size: 15px;
        }

        .input-box input {
            width: 100%;
            height: 100%;
            background: transparent;
            border: none;
            outline: none;
            color: #ffffff;
            font-family: inherit;
            font-size: 15px;
        }

        .input-box input::placeholder {
            color: #d0ddef;
        }

        /* Login Button */

        .login-btn {
            width: 100%;
            height: 48px;
            margin-top: 8px;
            border: none;
            border-radius: 8px;
            background: #ffffff;
            color: #083778;
            font-family: inherit;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: 0.3s;
        }

        .login-btn:hover {
            background: #dcecff;
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
        }

        .login-btn i {
            margin-left: 8px;
        }

        /* Footer */

        .secure-text {
            text-align: center;
            color: #d5e8ff;
            font-size: 12px;
            margin-top: 20px;
        }

        .secure-text i {
            margin-right: 5px;
            color: #8ff0c2;
        }

        .back-home {
            text-align: center;
            margin-top: 15px;
        }

        .back-home a {
            color: #ffffff;
            font-size: 11px;
            text-decoration: none;
        }

        .back-home a:hover {
            text-decoration: underline;
        }

        /* Mobile */

        @media (max-width: 480px) {
            body {
                padding: 18px;
            }

            .login-box {
                padding: 30px 23px;
            }

            .background {
                width: 310px;
                height: 490px;
            }

            .shape {
                width: 130px;
                height: 130px;
            }

            .login-box h2 {
                font-size: 24px;
            }
        }
    </style>
</head>

<body>

    <div class="background">
        <div class="shape"></div>
        <div class="shape"></div>
    </div>

    <div class="login-box">

       
        <h2>LifeCare Clinic</h2>

        <p class="subtitle">Admin Panel Login</p>

        <form action="" method="POST">

            <!-- Username -->
            <div class="form-group">
                <label for="username">Username</label>

                <div class="input-box">
                    <i class="fa-solid fa-user"></i>

                    <input
                        type="text"
                        id="username"
                        name="username"
                        placeholder="Enter your username"
                        autocomplete="username"
                        required
                    >
                </div>
            </div>

            <!-- Gmail -->
            <div class="form-group">
                <label for="email">Gmail Address</label>

                <div class="input-box">
                    <i class="fa-solid fa-envelope"></i>

                    <input
                        type="email"
                        id="email"
                        name="email"
                        placeholder="Enter your Gmail address"
                        autocomplete="email"
                        required
                    >
                </div>
            </div>

            <!-- Password -->
            <div class="form-group">
                <label for="password">Password</label>

                <div class="input-box">
                    <i class="fa-solid fa-lock"></i>

                    <input
                        type="password"
                        id="password"
                        name="password"
                        placeholder="Enter your password"
                        autocomplete="current-password"
                        required
                    >
                </div>
            </div>

            <button type="submit" class="login-btn">
                Login to Dashboard
                <i class="fa-solid fa-arrow-right"></i>
            </button>

        </form>

        <p class="secure-text">
            <i class="fa-solid fa-shield-halved"></i>
            Secure access for authorized administrators
        </p>

        <div class="back-home">
            <a href="../index.php">
                <i class="fa-solid fa-arrow-left"></i>
                Back to Website
            </a>
        </div>

    </div>

</body>
</html>
