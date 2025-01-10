<?php

$token = $_GET["token"];

$token_hash = hash("sha256", $token);

$mysqli = require __DIR__ . "/database.php";

$sql = "SELECT * FROM users
        WHERE reset_password_token = ?";

$stmt = $mysqli->prepare($sql);

$stmt->bind_param("s", $token_hash);

$stmt->execute();

$result = $stmt->get_result();

$user = $result->fetch_assoc();

if ($user === null) {
    die("token not found");
}

if (strtotime($user["token_expiration"]) <= time()) {
    die("token has expired");
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Reset Password</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
</head>
<header>
    <a href="../frontend/login.html">
        <img src="../images/main_logo.png" width="105px">
    </a>
</header>
<body>

    <h1>Επαναφορά κωδικού</h1>

    <form method="post" action="process-reset-password.php">

        <input type="hidden" name="token" value="<?= htmlspecialchars($token) ?>">

        <label for="password">Νέος κωδικός</label>
        <input type="password" id="password" name="password">

        <label for="password_confirmation">Επιβεβαίωση κωδικού</label>
        <input type="password" id="password_confirmation"
               name="password_confirmation">

        <button>Υποβολή</button>
    </form>

</body>
</html>