<?php
session_start();
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE username=? AND email=?");
    $stmt->bind_param("ss", $username, $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $token = substr(str_shuffle("0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 6);
        $expiry = date("Y-m-d H:i:s", time() + 3600);

        $update = $conn->prepare("UPDATE users SET reset_token=?, token_expiry=? WHERE username=? AND email=?");
        $update->bind_param("ssss", $token, $expiry, $username, $email);
        $update->execute();

        echo "<p>Your reset code is: <strong>$token</strong></p>";
    } else {
        echo "<p>User not found with given credentials.</p>";
    }
}
?>
