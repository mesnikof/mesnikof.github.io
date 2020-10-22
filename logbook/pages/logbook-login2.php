<?php
/*
 * "logbook-login2.php"
 *
 * This PHP script is primarily a test platform for login security/authentication change
 * testing for the logbook system.  Currently, other than some of the basic variables
 * and function calls common to most of the PHP scripts in the logbook system, it contains
 * no other functionality.
 *
 * It remains part of the system as a test unit for future updates and modifications.
 */
$page_title = "Logbook System Login2";
require('../include/logbook-include.php');
    
logbook_header();
echo "</head>\n\n";
    
echo "<BODY BGCOLOR=\"#DCFFDC\" LINK=\"#8000FF\" ALINK=\"#8000FF\" VLINK=\"#8000FF\">\n\n";
echo "<CENTER>\n\n";
    
if(!isset($_POST['u_name']) || !isset($_POST['p_word'])) {
    echo "<H1>401: Unauthorised Access<BR></h1>\n</center>\n</body>\n</html>\n";
    exit();
}
    
logbook_menu();

logbook_footer();
exit();
?>
