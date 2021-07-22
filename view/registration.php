<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>PHP Motors Register</title>
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
        <h1>Register</h1>
        <?php
            if (isset($message)) {
                echo $message;
            } 
        ?>
        <form method="post" action="/phpmotors/accounts/index.php">
            <label for="clientFirstname">First Name</label>
            <input type="text" name="clientFirstname" id="fname" <?php if(isset($clientFirstname)){echo "value='$clientFirstname'";}  ?> required>
        
            <label for="clientLastName">Last Name</label>
            <input type="text" name="clientLastname" id="lname" <?php if(isset($clientLastname)){echo "value='$clientLastname'";}  ?> required>
        
            <label for="clientEmail">Email</label>
            <input type="email" name="clientEmail" id="email" <?php if(isset($clientEmail)){echo "value='$clientEmail'";}  ?> required>
        
            <label for="password">Password</label>
            <span><br>Minimum 8 characters including: <br> 1 uppercase<br> 1 lowercase<br>1 special character</span>
            <input type="password" name="clientPassword" id="password" required pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$">

            <input type="submit" name="submit" id="regbtn" value="Register">
            <!-- Add the action name - value pair -->
            <input type="hidden" name="action" value="register">
        </form>
    </main>

    <footer>
    <?php require $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?> 
    </footer>
</body>

</html>