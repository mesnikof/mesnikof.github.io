<?php
/*
 * This PHP script performs the actual MySQL database insert with the data gathered from the
 * logbook-mobile-input.php script.  Following the insert, a result message is shown, requiring
 * the user to acknowledge the result, and sending the user back to the appropriate input page.
 *
 * It is necessary two have separate versions of the insert scripts as the mobile version needs
 * to do more data manipulation based upon user selections from the mobile impt page.  The
 * "standard" version does many of these calculations/manipulations prior to sending the data.
 * This is a limitation of the mobile device.  It would be possible to have all of this
 * functionality in a single PHP insert script, forking what to do based upon what source data
 * is provided, but the file would be overly large and cumbersome, and thus difficult to
 * maintain.  While some of the functionality is duplicate (such as the actual SQL calls), it
 * is primarily fixed activities which are highly unlikely to change in the future.
 */
    
/*
 * First we will set the page_title variable and perform the necessary require() calls,
 * then call the logbook_header() method to output the appropriate HTML
 * header information.
 */
$page_title = "Logbook System Data Insert";
require('../include/logbook-include.php');

logbook_header();

/*
 * Now check for the existence of authentication data.  If it is not there exit with an
 * appropriate message to the user.
 */
if(!isset($_POST['u_name']) || !isset($_POST['p_word'])) {
    echo "<H1>401: Unauthorised Access<BR></h1>\n</center>\n</body>\n</html>\n";
    exit();
}
    
/*
 * Now define some needed local variables from the GLOBAL and POST variables.
 */
$server_root = $GLOBALS['server_root'];

$u_name = $_POST['u_name'];
$p_word = $_POST['p_word'];
$h_name = $GLOBALS['web_svr'];
$d_base = "logbook";
    
/*
 * Create the database connection via the MySQL connector library method.  This also serves
 * as user authentication.  Display an appropriate error message if this fails and exit the
 * script.  If it succeeds, pass the connection info back to the GLOBAL variable.
 */
$dbConn = new mysqli("$h_name", "$u_name", "$p_word", "$d_base");
if(mysqli_connect_errno()) {
    echo 'Login/Database Connection failed:'.mysqli_connect_error();
    exit();
}
$GLOBALS['db_conn'] = $dbConn;
    
/*
 * Setup the LOGBOOK DETAILS INSERT function.  Some data items are required, others are checked
 * for existence.  If they exist add them to the input string, otherwise ignore them (leaving
 * them "null" for MySQL purposes).
 *
 * Note: This takes advantage of the PHP ability to simply build a buffer as necessary.  Short
 * of some impossibly (for our purposes) long string, no buffer under- or over-run is possible.
 *
 * Based upon the "radio button" selections ("type of aircraft" and "type of activity") we will
 * load some of the data items and leave others blank.
 *
 * Finally, we do the data manipulations of the time information here, calculating the elapsed
 * flight time and converting minutes to tenths-of-hours per FAA requirements.
 */
$insert_line = "`Date`='$_POST[date]', ";
    
if ($_POST[a_c] == 9) { $insert_line .= "`Aircraft-Model`=`CRJ9`, "; }
if ($_POST[a_c] == 7) { $insert_line .= "`Aircraft-Model`=`CRJ7`, "; }
if ($_POST[a_c] == 2) { $insert_line .= "`Aircraft-Model`=`CL65`, "; }
    
$insert_line .= "`Aircraft-Flight-Ident`='$_POST[ident]', ";
$insert_line .= "`From`='$_POST[from]', ";
$insert_line .= "`To`='$_POST[to]', ";
    
/*
 * Here we will calculate the elapsed time.  The basic time object will be used for the
 * "realtime" SQL entry.  This will be further converted into a simple "hours.tenths"
 * for the other entries per FAA requirements.
 */
$o_time = new DateTime('$_POST[out_time_hours]:$_POST[out_time_minutes]:00');
$i_time = new DateTime('$_POST[in_time_hours]:$_POST[in_time_minutes]:00');
$realtime = $o_time->diff($i_time);
$hours = $realtime->format('H');

/*
 * Convert minutes to tenths of an hour.  Use modulus to determine whether to round up.
 */
$tenths = intdiv(($realtime->format('i'), 6);
if (($realtime->format('i') % 6) > 0) { $tenths = $tenths + 1; }

$total_time = "$hours";
$total_time .= ".";
if ($tenths < 10) { $total_time .= "0"; }
$total_time .= "$tenths";
    
$insert_line .= "`Total-Time`=$total_time";
$insert_line .= ", `MEL`=$total_time";
$insert_line .= ", `Complex`=$total_time";
$insert_line .= ", `Turbine`=$total_time";
$insert_line .= ", `High-Performance`=$total_time";
$insert_line .= ", `Cross-Country`=$total_time";

if ($_POST[actual] != '') { $insert_line .= ", `Instrument-Actual`=$_POST[actual]"; }
if ($_POST[approaches] != '') { $insert_line .= ", `Instrument-Approaches`=$_POST[approaches]"; }

if ($_POST[lndgs_day] != '') { $insert_line .= ", `Landings-Day`=$_POST[lndgs_day]"; }
if ($_POST[lndgs_night] != '') { $insert_line .= ", `Landings-Night`=$_POST[lndgs_night]"; }

if ($_POST[night] != '') { $insert_line .= ", `Night`=$_POST[night]"; }

if ($_POST[f_opt] == 'std') { $insert_line .= ", `PIC`=$total_time"; }

if (($_POST[f_opt] == 'oe_c') ||
    ($_POST[f_opt] == 'oe_n')) {
    $insert_line .= ", `PIC`=$total_time";
    $insert_line .= ", `Instruction-Given`=$total_time"; }
                 
if ($_POST[f_opt] == 'lc') {
    $insert_line .= ", `SIC`=$total_time";
    $insert_line .= ", `Instruction-Given`=$total_time"; }

if ($_POST[f_opt] == 'fo') { $insert_line .= ", `SIC`=$total_time"; }

$insert_line .= ", `RealTime`=$realtime";

/*
 * Prepend the SQL syntax to the insert string and run the query via the MySQL connector
 * connection->query() method call.  Store the result for testing.
 */
$full_insert_line = "INSERT INTO details SET ";
$full_insert_line .= $insert_line;
$result = $dbConn->query($full_insert_line);
  
/*
 * If the first insertion worked, rebuild the query string by prepending a different query instruction.
 * This is required for certain functionality of the logbook system, requireing two similar, but
 * slightly different tables, details and airline.
 *
 * Once again, run the insert using the same query method call, again storing the result for testing.
 */
if($result) {
    // Setup the LOGBOOK AIRLINE  INSERT function
    $full_insert_line = "INSERT INTO airline SET ";
    $full_insert_line .= $insert_line;
    $result = $dbConn->query($full_insert_line);
}

/*
 * Having performed the actual insertion function, display the page's information.
 * This mainly consists of a single form, showing either a success or failure message in a button that
 * effectively provides a required user action to continue.
 *
 * This section also defines several POST variables such as authentication data and date information to
 * "preload" the next input page.  As this entire system utilizes SSL, this data can be considered
 * relatively secure
 */
echo "</head>\n\n<BODY BGCOLOR=\"#C0C0FF\" LINK=\"#2000FF\" ALINK=\"#2000FF\" VLINK=\"#2000FF\">\n<CENTER>\n\n";

echo "<FONT color=\"blue\">\n<H1>The Logbook Entry Posting Page</H1>\n</FONT COLOR>\n\n";
echo "<HR ALIGN=\"center\">\n\n";

echo "<FORM NAME=\"LogbookPostForm\" METHOD=\"post\" ACTION=\"$server_root/pages/logbook-mobile-device-input.php\">\n";
    
echo " <INPUT TYPE=\"hidden\" NAME=\"transfer_date\" VALUE=\"$_POST[date]\">\n";
echo " <INPUT TYPE=\"hidden\" NAME=\"u_name\" id=\"u_name\" value=\"$u_name\" />\n";
echo " <INPUT TYPE=\"hidden\" NAME=\"p_word\" id=\"p_word\" value=\"$p_word\" />\n";

/*
 * Now test the result.  Display success or failure messages.
 *
 * Note: while there is only one result variable, since the two inserts cascade, and the second only takes
 * place if the first was successful, this works logically.
 */
if(!$result) {
    echo " <INPUT TYPE=\"hidden\" NAME=\"txfr\" id=\"txfr\" value=\"0\" />\n";
    echo "<INPUT TYPE=\"submit\" VALUE=\"Query Failed\"<BR><BR>\n";
    echo mysql_error();
}
else {
    echo " <INPUT TYPE=\"hidden\" NAME=\"txfr\" id=\"txfr\" value=\"1\" />\n";
    echo "<INPUT TYPE=\"submit\" VALUE=\"Query Passed\"<BR><BR>\n";
}
echo "\n</form>\n</center>\n\n";

/*
 * Finally, do the usual logbook_footer() and exit() methods to complete the script.
 */
logbook_footer();
exit();
?>

