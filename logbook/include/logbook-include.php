<?php
require('../include/logbook-servers.php');
require('../include/logbook-printout-headers.php');
require('../include/logbook-menu.php');

$server_root = "https://";
$server_root .= $_SERVER['SERVER_NAME'];
$server_root .= "/logbook";

function logbook_header() {
    $server_root = $GLOBALS['server_root'];
    $page_title = $GLOBALS['page_title'];
    echo "<HTML>\n<HEAD>\n";
    echo "<META HTTP-EQUIV=\"Content-Type\" content=\"text/html; charset=iso-8859-1\">\n";
    echo "<BASE HREF=\"$server_root/\">\n";
    echo "<TITLE>$page_title</title>\n";
    echo "<SCRIPT LANGUAGE=\"JavaScript\" SRC=\"$server_root/include/logbook-tips.js\"></script>\n";
}

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
