<?php
if (!$_SESSION['loggedin']) {
   header('Location: /phpmotors/index.php');
}
?><!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>PHP Motors Account Update</title>
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
        <h1>Account Update</h1>
        
        <h3>Modify your First Name, Last Name, or Email address</h3>
        <?php
          if (isset($messageUpdateAccount)) {
            echo $messageUpdateAccount;
        } 
        ?>
        <form method="post" action="/phpmotors/accounts/index.php">
            <label for="clientFirstname">First Name</label>
            <input type="text" name="clientFirstname" id="clientFirstname" <?php if(isset($clientFirstname)){echo "value='$clientFirstname'";} else { echo "value='".$_SESSION['clientData']['clientFirstname']."'"; }  ?> required>
        
            <label for="clientLastname">Last Name</label>
            <input type="text" name="clientLastname" id="clientLastname" <?php if(isset($clientLastname)){echo "value='$clientLastname'";} else { echo "value='".$_SESSION['clientData']['clientLastname']."'"; } ?> required>
        
            <label for="clientEmail">Email</label>
            <input type="email" name="clientEmail" id="clientEmail" <?php if(isset($clientEmail)){echo "value='$clientEmail'";} else { echo "value='".$_SESSION['clientData']['clientEmail']."'"; } ?> required>

            <input type="submit" value="Update Account" name="submit">
            <input type="hidden" name="action" value="updateAccount">
            <input type="hidden" name="clientId" value="<?php echo $_SESSION['clientData']['clientId']; ?> ">
        </form>

        <h3>Change your password</h3>
        <?php
          if (isset($messageChangePassword)) {
            echo $messageChangePassword;
        } 
        ?>
        <form method="post" action="/phpmotors/accounts/index.php">
            <label for="password">Change Password</label>
            <span><br>Minimum 8 characters including: <br> 1 uppercase<br> 1 lowercase<br>1 special character</span>
            <input type="password" name="clientPassword" id="password" required pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$">

            <input type="submit" value="Change Password" name="submit">
            <input type="hidden" name="action" value="changePassword">
            <input type="hidden" name="clientId" value="<?php echo $_SESSION['clientData']['clientId']; ?> ">
        </form>
    </main>

    <footer>
    <?php require $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?> 
    </footer>
</body>

</html>