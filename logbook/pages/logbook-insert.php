<?php/*
      * This PHP script performs the actual MySQL database insert with the data gathered from either
      * the logbook-input.php or logbook-mobile-input.php scripts.  Following the insert, a result
      * message is shown, requiring the user to acknowledge the result, and sending the user back
      * to the appropriate input page.
      */
    
    /*
     * First we will set the page_title variable, perform the necessary require() calls, create a
     * Mobile_Detect instance, and call the logbook_header() method to output the appropriate HTML
     * header information.
     */
    $page_title = "Logbook System Data Insert";
    require('../include/logbook-include.php');
    require('../include/Mobile_Detect.php');
    $detect = new Mobile_Detect;

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
     */
    $insert_line = "`Date`='$_POST[date]', ";
    $insert_line .= "`Aircraft-Model`='$_POST[aircraft_model]', ";
    $insert_line .= "`Aircraft-Flight-Ident`='$_POST[ident]', ";
    $insert_line .= "`From`='$_POST[from]', ";
    $insert_line .= "`To`='$_POST[to]', ";
    $insert_line .= "`Total-Time`=$_POST[total_time]";
    if ($_POST[sel_time] != '') { $insert_line .= ", `SEL`=$_POST[sel_time]"; }
    if ($_POST[mel_time] != '') { $insert_line .= ", `MEL`=$_POST[mel_time]"; }
    if ($_POST[complex_time] != '') { $insert_line .= ", `Complex`=$_POST[complex_time]"; }
    if ($_POST[turbine_time] != '') { $insert_line .= ", `Turbine`=$_POST[turbine_time]"; }
    if ($_POST[high_perf] != '') { $insert_line .= ", `High-Performance`=$_POST[high_perf]"; }
    if ($_POST[tail_wheel] != '') { $insert_line .= ", `Tail-Wheel`=$_POST[tail_wheel]"; }
    if ($_POST[actual] != '') { $insert_line .= ", `Instrument-Actual`=$_POST[actual]"; }
    if ($_POST[simulated] != '') { $insert_line .= ", `Instrument-Simulated`=$_POST[simulated]"; }
    if ($_POST[approaches] != '') { $insert_line .= ", `Instrument-Approaches`=$_POST[approaches]"; }
    if ($_POST[simulator] != '') { $insert_line .= ", `Aircraft-Simulator-PCATD`=$_POST[simulator]"; }
    if ($_POST[lndgs_day] != '') { $insert_line .= ", `Landings-Day`=$_POST[lndgs_day]"; }
    if ($_POST[lndgs_night] != '') { $insert_line .= ", `Landings-Night`=$_POST[lndgs_night]"; }
    if ($_POST[training_rcvd] != '') { $insert_line .= ", `Flight-Training-Received`=$_POST[training_rcvd]"; }
    if ($_POST[cross_cntry] != '') { $insert_line .= ", `Cross-Country`=$_POST[cross_cntry]"; }
    if ($_POST[night] != '') { $insert_line .= ", `Night`=$_POST[night]"; }
    if ($_POST[solo] != '') { $insert_line .= ", `Solo`=$_POST[solo]"; }
    if ($_POST[pic] != '') { $insert_line .= ", `PIC`=$_POST[pic]"; }
    if ($_POST[sic] != '') { $insert_line .= ", `SIC`=$_POST[sic]"; }
    if ($_POST[instructor] != '') { $insert_line .= ", `Instruction-Given`=$_POST[instructor]"; }
    if ($_POST[realtime] != '') { $insert_line .= ", `RealTime`=$_POST[realtime]"; }

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
 * This next commented-out section is for an incomplete additional "package" that is/was meant to provide
 * a simple display tool for the user's expected schedule information.  While this part of the system is
 * currently unavailable, it is preffered to keep this "stub" for later inclusion.
 */
    //
    // Now set up the Schedule Update stuff
    //
/*
    if(($result) && ($_POST[idx] != "")) {
        $db_db = mysql_select_db("sched");

        // Setup the LOGBOOK DETAILS INSERT function
        $insert_line = "UPDATE sched.15996_legs SET ";
        $insert_line .= "`out`='$_POST[out_time]', `in`='$_POST[in_time]' ";
        $insert_line .= "WHERE `idx`='$_POST[idx]'";

    $result = mysql_query("$insert_line", $db_cnx);
    }

    if($result) {
        $_POST['txfr'] = 1;
        $result->free();
        $dbConn->close();
        header('Location: logbook-input.php', true, 307);
    }
*/
    
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

    /*
     * Here we do a simple test for mobile or standard device, and create the form's "ACTION" information
     * accordingly.
     */
    if($detect->isMobile()) {
        /*
         * Do this for a mobile device access.
         */
        echo "<FORM NAME=\"LogbookPostForm\" METHOD=\"post\" ACTION=\"$server_root/pages/logbook-mobile-device-input.php\">\n";
    }
    else {
        /*
         * Do this for a "standard" desktop/laptop system and browser.
         */
        echo "<FORM NAME=\"LogbookPostForm\" METHOD=\"post\" ACTION=\"$server_root/pages/logbook-input.php\">\n";
    }
    
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
