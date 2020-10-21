<?php
/*
 * "logbook-include.php"
 *
 * This file is the primary PHP inclusion file for the Logbook web site.
 *
 * It should be called via a "require('../include/logbook-include.php);" call in every .PHP
 * file in the web site.
 *
 * It also uses the "require" instruction to include several sub-files as well.
 *
 * Note: the "require" instruction will cause a failure and returned error message if the file
 *       is not found.
 *
 * Note: Everything here should be made platform-non-specific so that this entire project's
 *       directory structure can be moved easily from server to server.
 *
 * TODO: Add function(s) that perform the authentication tasks so as to remove the repeated
 *       code in each of the logbook system's PHP scripts.
 *
 * TODO: Create some sort of MySQL "session" to eliminate the need to repeatedly pass the
 *       uname and pword information back and forth.
 */
    
/*
 * These are the "require"d files.  Their individual data is explained within those files.
 */
require('../include/logbook-servers.php');
require('../include/logbook-printout-headers.php');
require('../include/logbook-menu.php');

/*
 * Define the "server_root" variable, making the Logbook system server-non-specific.
 */
$server_root = "https://";
$server_root .= $_SERVER['SERVER_NAME'];
$server_root .= "/logbook";

/*
 * The "logbook_header()" function automates the page header information, including defining the
 * server_root and page_title global variables for each page.
 *
 * Nothing special here, mainly just output via "echo" of the necessary HTML information.
 */
function logbook_header() {
    $server_root = $GLOBALS['server_root'];
    $page_title = $GLOBALS['page_title'];
    echo "<HTML>\n<HEAD>\n";
    echo "<META HTTP-EQUIV=\"Content-Type\" content=\"text/html; charset=iso-8859-1\">\n";
    echo "<BASE HREF=\"$server_root/\">\n";
    echo "<TITLE>$page_title</title>\n";
    echo "<SCRIPT LANGUAGE=\"JavaScript\" SRC=\"$server_root/include/logbook-tips.js\"></script>\n";
}

/*
 * The "logbook_footer()" function automates the page footer information, including defining the last
 * access time through use of the "getlastmod()" method, feeding the "date()" method to generate the
 * format we want.
 *
 * The rest is once again just "echo" instructions outputting the necessary HTML.
 */
function logbook_footer() {
    echo "<CENTER>\n<HR WIDTH=\"50%\" SIZE=\"8\" COLOR=\"#0000FF\">\n<BR>\n<FONT COLOR=\"#000000\">\n";
    echo "<ADDRESS>This page was last modified<BR>\n";

    $time = getlastmod();
    $fmt_date = date("D, F d, Y  H:i", $time);
    print("$fmt_date");
    
    echo "<BR>VHF Recording<BR>Logbook Web\n";
    echo "</address>\n</font>\n</center>\n<BR>\n</body>\n</html>\n";
}
?>
