
<?php

include 'config.php';

$message = "";

$username = "admin";
$password = "LifeCare@123";
$full_name = "Clinic Administrator";
$email = "admin@example.com";

$sql = "SELECT id FROM admins WHERE username = ? LIMIT 1";
$stmt = mysqli_prepare($conn, $sql);

mysqli_stmt_bind_param($stmt, "s", $username);
mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);

if (mysqli_num_rows($result) > 0) {

    $message = "Admin account already exists. Please use the existing account.";

} else {

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $insert_sql = "INSERT INTO admins
                   (username, password, full_name, email)
                   VALUES (?, ?, ?, ?)";

    $insert_stmt = mysqli_prepare($conn, $insert_sql);

    mysqli_stmt_bind_param(
        $insert_stmt,
        "ssss",
        $username,
        $hashed_password,
        $full_name,
        $email
    );

    if (mysqli_stmt_execute($insert_stmt)) {
        $message = "Admin account created successfully!";
    } else {
        $message = "Unable to create admin account.";
    }

    mysqli_stmt_close($insert_stmt);
}

mysqli_stmt_close($stmt);
mysqli_close($conn);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Admin Account</title>
</head>
<body>

    <h2><?php echo htmlspecialchars($message); ?></h2>

    <?php if (strpos($message, "created successfully") !== false): ?>
        <p><strong>Username:</strong> admin</p>
        <p><strong>Password:</strong> LifeCare@123</p>
    <?php endif; ?>

    <p>
        <a href="login.php">Go to Admin Login</a>
    </p>

</body>
</html>
