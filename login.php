<?php
$is_invalid = false;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $mysqli = require __DIR__ . "/database.php";
    $sql = sprintf("SELECT * FROM admin
    WHERE email = '%s'",
    $mysqli->real_escape_string($_POST["email"]));

    $result = $mysqli->query($sql);

    $user = $result->fetch_assoc();

    if ($user) {
        if (password_verify($_POST["password"], $user["password_hash"])){
     
      
           header("Location: index.php");
           exit;
        }
    }
    $is_invalid = true;
}
?>
<!DOCTYPE html>
<html>
<head>


    <title> Log In </title>
    <meta charset="UTF-8">
     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
</head>
<body>
    <br>
    <br>
    <br>
    <br>
    <h1> Login </h1> <br>
<?php if ($is_invalid): ?>
    <em>Invalid login</em>
    <?php endif; ?>

    <form method="post">  
        <label for="email">Email:</label>
        <input type="email" id="email" name="email">

        <label for="password">Password:</label>
        <input type="password" id="password" name="password">

        <br> <button> Login </button>
        <div class="signup">
        <p> Don't have an account? <a href="process-signup.php">Signup</a></p>
</div>
</form>
</body>

</html>
