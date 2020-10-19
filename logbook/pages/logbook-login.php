<?php
/*
 * This is the initial Logbook system page.  It is called automatically via redirection
 * from the index.html page.
 *
 * The PHP file is "self-calling". The username/password entry on this page uses the
 * "post" method to recall this page with the entered data.  This data is then
 * authenticated using the MySQL database users table.
 *
 * Upon failure to authenticate an appropriate error message is displayed to the user.
 *
 * Upon success, the user's browser is tested with the Mobile_Detect tool.  If access
 * from a mobile device is detected, the user is redirected to the mobile input PHP
 * page.  Otherwise, the user is sent to the standard logbook-home.php page.  Both of
 * these actions take place via the "header()" method.
 */
    
/*
 * First, we will define the page_title variable.  Then we will perform the "require()"
 * functions to access the include files.  A new Mobile_Detect object is instantiated
 * for later use.  Finally, we will set the h_name and d_base variables for later use.
 */
$page_title = "Logbook System Login";
require('../include/logbook-include.php');
require('../include/Mobile_Detect.php');
$detect = new Mobile_Detect;
$h_name = $GLOBALS['web_svr'];
$d_base = "logbook";

/*
 * This is the main branching point.  On initial entry into the logbook system the u_name
 * and p_word POST variables should be empty.  If either is empty (!isset), the
 * authentication steps are bypassed correctly, and the page displays the entry forms for
 * this information.  This activity is described below.
 *
 * For here, assuming both of these variables are set (the second pass through this file),
 * the authentication is performed, and activity commences based upon the user's browser
 * and platform.
 */
if(isset($_POST['u_name']) && isset($_POST['p_word'])) {
    /*
     * If the data is available, load it into local variables for actioning.
     */
    $u_name = $_POST['u_name'];
    $p_word = $_POST['p_word'];
    
    /*
     * Attempt to create a database connection using the provided username/password info.
     *
     * Note: This is a method from the MySQL connector libraries.
     */
    $db_conn = new mysqli("$h_name", "$u_name", "$p_word", "$d_base");
    
    /*
     * If the connection fails, authentication has likely failed.  Send the user an
     * appropriate message.
     *
     * Note: It COULD be a "plain" CONNECTION failure, but for now we will ignore that case.
     */
    if(mysqli_connect_errno()) {
        echo 'Login/Database Connection failed:'.mysqli_connect_error();
        
        // The use of the exit() call here is appropriate to end the PHP script.
        exit();
    }
    else {
        /*
         * Otherwise, on success, perform a test for access from a mobile device via the
         * Mobile_Detect library calls.  Branch as appropriate.
         *
         * This version of the Mobile_Detect call returns true for phones and tablets, and
         * false for everything else.
         */
        if($detect->isMobile()) {
            /*
             * Do this for a mobile device access.
             */
            header('Location: logbook-mobile-device-input.php', true, 307);
        }
        else {
            /*
             * Do this for a "standard" desktop/laptop system and browser.
             *
             * Note: The commented-out alternate action is vestigial for now, but may be used again
             * in the future, so leave it here for now.
             */
            //header('Location: logbook-login2.php', true, 307);
            header('Location: logbook-home.php', true, 307);
        }
        
        // The use of the exit() call here is appropriate to end the PHP script.
        exit();
    }
}

/*
 * This is the "first pass" section for this file.  If the username and password were not found
 * to have been set we get to this point.  Here, we exit the PHP interpreter to display the
 * "pure" HTML code that shows the username/password input form.  When "Enter" is selected the
 * form calls this same file via a "post" method.
 *
 * No commenting is placed withing the HTML code.  It should be relatively self-explanatory.
 */
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
/*
 * Finally, the logbook_footer() method is called to print the "standard" website and update
 * information for this page.  This is followed by the exit() call to end the PHP script.
 */
logbook_footer();
exit();
}
?>

