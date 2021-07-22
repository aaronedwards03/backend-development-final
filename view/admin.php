<?php
if (!$_SESSION['loggedin']) {
   header('Location: /phpmotors/index.php');
}
?><!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Admin</title>
    <link rel="stylesheet" href="../css/styles.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Aldrich&family=Roboto+Mono&display=swap" rel="stylesheet">  
</head>

<body>
    <header>
    <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/header.php'; ?> 
    </header>

    <nav>
    <?php echo $navList; ?>
    </nav>

    <main>
        <h1>Logged in as: <?php echo $_SESSION['clientData']['clientFirstname'].' '.$_SESSION['clientData']['clientLastname'] ?></h1>
        <?php
          if (isset($_SESSION['message'])) {
            echo $_SESSION['message'];
            unset($_SESSION['message']);
        } 
        if (isset($message)) {
          echo $message;
        } 
        ?>
        <ul class="client-info"><?php
          $displayInfo = "<li>First Name: ".$_SESSION['clientData']['clientFirstname']."</li>";
          $displayInfo .= "<li>Last Name: ".$_SESSION['clientData']['clientLastname']."</li>";
          $displayInfo .= "<li>Email: ".$_SESSION['clientData']['clientEmail']."</li>";
          echo $displayInfo;
        ?></ul>
        <?php echo "<p><a href='/phpmotors/accounts/index.php?action=".urlencode("update")."' title='Update your account information'>Update Account Information</a></p>"?>
        <?php
          if ($_SESSION['clientData']['clientLevel'] > 1) {
            $adminLink = "<h3>Admin Inventory Link:</h3>";
            $adminLink .= "<p>Use this link to access the inventory and update/add/delete records</p>";
            $adminLink .= "<a href='../vehicles/'><p>Add Classification or Vehicle</p></a>";
            echo $adminLink;
          }
          ?>
        <?php if(isset($displayClientReviews)) {
                echo $displayClientReviews;
              } 
        ?>
        
    </main>

    <footer>
    <?php require $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?> 
    </footer>
</body>

</html>