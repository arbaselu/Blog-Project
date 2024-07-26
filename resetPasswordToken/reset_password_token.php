<?php
session_start();
require_once '../backend/config.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Style/resetPasswordStyle.css">
    <title>Reset Password</title>
</head>
<body>
    <div class="form-container">
        <h1>Reset Password</h1>
        <form class="form" action="<?php echo htmlspecialchars($_SERVER['REQUEST_URI']); ?>" method="POST">
            <input type="hidden" name="token" value="<?php echo htmlspecialchars($_GET['token']); ?>">
            <input type="password" name="new_password" class="input" placeholder="New Password" required>
            <input type="password" name="confirm_password" class="input" placeholder="Confirm Password" required>
            <button type="submit" name="submit-login" class="form-btn">Reset Password</button>
            <!-- Display error or success message -->
            <p class="error"><?php if(isset($_SESSION['check'])) echo $_SESSION['check']; ?></p>
        </form>
    </div>
</body>
</html>

<?php
// Check if the form has been submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $token = $_POST['token'];
    $newPassword = $_POST['new_password'];
    $confirmPassword = $_POST['confirm_password'];

    // Verify that both password fields match
    if ($newPassword !== $confirmPassword) {
        $_SESSION['check'] = "Passwords do not match.";
    } else {
        // Verify the token in the database
        $stmt = $connect->prepare("SELECT id FROM users WHERE reset_token = ? AND reset_token_expiry > ?");
        $stmt->execute([$token, time()]);
        $user = $stmt->fetch();

        if ($user) {
            // Update the user's password
            $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
            $stmt = $connect->prepare("UPDATE users SET password = ?, reset_token = NULL, reset_token_expiry = NULL WHERE id = ?");
            $stmt->execute([$hashedPassword, $user['id']]);

            // Set success message and redirect
            $_SESSION['check'] = "Password has been successfully reset!";
            header('Location: ../login.php'); // Redirect to login page or another page as needed
            exit();
        } else {
            // Invalid or expired token
            $_SESSION['check'] = "Invalid or expired token.";
        }
    }
}
?>



