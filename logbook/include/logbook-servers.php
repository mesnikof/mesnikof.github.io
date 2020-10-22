<?php
/*
 * "logbook-servers.php"
 *
 * This file contains the definitions of the all-important web- and sql-server locations.
 *
 * These need to be manually edited, similar to the "my.cnf" file for a MySQL server installation,
 * to account for site-specific data.
 *
 * To-Do: Create a simple, web-displayed tool to make changes here, rather than requiring a sysadmin
 *        to perform a "manual" edit.
 */
    
/*
 * These two commented-out "echo" commands exist for reference to possible future changes.
 * Their continued existence here is not required, but will make future changes easier.
 */
//echo "  <link rel=\"shortcut icon\" href=\"http://localhost/logbook/favicon.ico\" type=\"image/vnd.microsoft.icon\" />\n";
//echo "  <link rel=\"icon\" href=\"http://localhost/logbook/favicon.ico\" type=\"image/vnd.microsoft.icon\" />\n\n";

/*
 * Here are the two server variable definitions.
 *
 * Note: For this installation they are identical, but the do NOT need to be for other installations.
 */
// The current web server hostname.
//$web_svr = "***.***.**.241";
$web_svr = "localhost";

// The current sql server
//$sql_svr = "***.***.**.241";
$sql_svr = "localhost";
?>
