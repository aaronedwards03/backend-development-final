<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>PHP Motors Login</title>
    <link rel="stylesheet" href="../css/styles.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Aldrich&family=Roboto+Mono&display=swap" rel="stylesheet">  
</head>

<body>
    <header>
        
    <?php require $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/header.php'; ?> 
    </header>

    <nav>
    <?php 
    echo $navList; ?> 
    </nav>

    <main>
        <h1>Sign in</h1>
        <?php
            if (isset($_SESSION['message'])) {
                echo $_SESSION['message'];
                unset($_SESSION['message']);
            }
            if (isset($message)) {
                echo $message;
            }
        ?>
        <form method="post" action="../accounts/">
            <label for="username">Email</label>
            <input type="email" id="username" name="username" <?php if(isset($username)){echo "value='$username'";} ?> required>

            <label for="password">Password</label>
            <span><br>Minimum 8 characters including: <br> 1 uppercase<br> 1 lowercase<br>1 special character</span>
            <input type="password" name="password" id="password" required pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" required>

            <input type="submit" value="Sign-in">
            <input type="hidden" name="action" value="Login">

            <?php echo $registrationLink; ?> 
        </form>
        
    </main>

    <footer>
    <?php require $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?> 
    </footer>
</body>

</html>