<img src="/phpmotors/images/site/logo.png" alt="PHP Motors logo">

<?php    
    if(isset($_SESSION['loggedin'])) {
        if($_SESSION['loggedin']) {
            echo "<a href='/phpmotors/accounts/'><span>Welcome ". $_SESSION['clientData']['clientFirstname']."</span></a>";
            echo "<h3><a href='/phpmotors/accounts/index.php?action=".urlencode("Logout")."' title='Logout of your account'>Logout</a></h3>";
        }
    } else {
            require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/library/variables.php';
            echo $accountLink; 
    }
    
?>