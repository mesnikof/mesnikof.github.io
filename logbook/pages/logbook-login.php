<?php
$page_title = "Logbook System Login";
require('../include/logbook-include.php');
$h_name = $GLOBALS['web_svr'];
$d_base = "logbook";

if(isset($_POST['u_name']) && isset($_POST['p_word'])) {
    $u_name = $_POST['u_name'];
    $p_word = $_POST['p_word'];
    
    $db_conn = new mysqli("$h_name", "$u_name", "$p_word", "$d_base");
    
    if(mysqli_connect_errno()) {
        echo 'Login/Database Connection failed:'.mysqli_connect_error();
        exit();
    }
    else {
        //header('Location: logbook-login2.php', true, 307);
        header('Location: logbook-home.php', true, 307);
        exit();
    }
}
else {
?>
<!DOCTYPE html>
<HTML>
<HEAD>
<TITLE>Logbook System Login</title>
</head>
<BODY BGCOLOR="#9999AA">
<CENTER>
<H1>
VHF Recording - Logbook System<BR>
<HR WIDTH="50%" SIZE="8" COLOR="#0000FF"><BR>
Please login...<BR><BR>
</H1>
    
<FORM METHOD="post" action="logbook-login.php">
    <P><LABEL FOR="u_name">Username:</label>
    <INPUT TYPE="text" name="u_name" id="u_name" size="25" /><p>
    <P><LABEL FOR="p_word">Password:</label>
    <INPUT TYPE="password" name="p_word" id="p_word" size="25" /></p>
    <BUTTON TYPE="submit" name="submit">Log In</button>
</form>

<BR><BR>
<?php
logbook_footer();
exit();
}
?>

