<?php
/*
 * "logbook-last30.php"
 *
 * This PHP script performs a SQL query of the logbook data, specifically filtered to look at the last
 * 30 calendar days of data (an FAA legaility test is based upon no greater than 100 flight hours in
 * a rolling 30 day "lookback").
 *
 * The result of this query is then displayed in a defined format that mimics one of the common,
 * FAA-preferred logbook data formats.  This includes "running totals" both for each individual "page"
 * of data and for the overall totals for the entire 30 days.
 *
 * TODO: Modify the script to use the PHP MySQL session methods for authentication when the logbook
 *       system is modified to use them.
 *
 * TODO: Modify the script to use the "global" error display methods when they are enable for the logbook
 *       system.
 */

/*
 * As with all the logbook PHP scripts, define the page_title variable, use the "require()" method to
 * load the logbook system "global" methods and variables, then call the "logbook_header()" method to
 * write out the HTML header information.
 */
$page_title = "Michael's LogBook Last 30 Days";
require('../include/logbook-include.php');

logbook_header();

/*
 * Close out the HTML header, define a web page background color (just to keep things interesting).
 */
echo "</head>\n\n";
echo "<BODY BGCOLOR=\"#C0C0FF\" LINK=\"#2000FF\" ALINK=\"#2000FF\" VLINK=\"#2000FF\">\n<CENTER>\n\n";

/*
 * Check for the existence of the passed-in u_name and p_word variable data.  Show an error to the
 * usr and exit if it doesn;t exist.
 *
 * Note: This will go away when "sessions" are implemented.
 */
if(!isset($_POST['u_name']) || !isset($_POST['p_word'])) {
    echo "<H1>401: Unauthorised Access<BR></h1>\n</center>\n</body>\n</html>\n";
    exit();
}

/*
 * Show the logbook system "menu bar".
 */
logbook_menu();
 
/*
 * Create local variables with the data from the POST and GLOBAL variables, and the d_base name.
 */
$u_name = $_POST['u_name'];
$p_word = $_POST['p_word'];
$h_name = $GLOBALS['web_svr'];
$d_base = "logbook";

/*
 * Instantiate a MySQL database connection object.  Show an error to the user and exit the script
 * if this fails.  If it succeeds load the GLOBAL db_conn variable with the connection info.
 */
$dbConn = new mysqli("$h_name", "$u_name", "$p_word", "$d_base");
if(mysqli_connect_errno()) {
    echo 'Login/Database Connection failed:'.mysqli_connect_error();
    exit();
}
$GLOBALS['db_conn'] = $dbConn;
    
/*
 * Create a local cur_date variable with the current date, formatted in the proper way for MySQL
 * use.  Then load the transfer_date variable with this info for later use.
 */
$cur_date = date("Y-m-d", time());
$transfer_date = $cur_date;

/*
 * Output the page title information in a defined format.
 */
echo "<FONT color=\"blue\">\n<H1>Logbook Data Page</h1>\n</font>\n\n";
echo "<HR>\n\n<H2>The <U>Last 30 Days</u> of Logbook Data</h2>\n\n";

/*
 * Create the line_count and result_row variables.  Each of these is used for testing for EOF as we go through
 * the returned MySQL data (this does not automatically happen as it does for other systems).  Note the
 * initialization values and their difference.  This will be explained later.
 */
$line_count = 0;
$result_row = 1;

/*
 * Create and run the SQL query to get any data from the preceding 30 days.  Note: We are refereing to the dates
 * the flights occurred, not the dates the data was entered.
 *
 * For information on the MySQL connector methods, plese consult the MySQL documentation.  Here we will simply
 * expect them to work, and will not go in depth in this commenting.  The return is placed into an object we
 * call "result".
 */
$selectQry = "SELECT * FROM logbook.details WHERE DATE_SUB(CURDATE(),INTERVAL 30 DAY) <= Date ORDER BY Date";
$result = $dbConn->query($selectQry);

/*
 * Here we begin the loop that loops through each result "row" returned by the preceding MySQL query.  The first
 * test simply uses the result->num_rows() method tested against "0" to determine if we got a return.
 *
 * Assuming we did get something back, we use the result->fetch_row() method to get the returned data, ro by row.
 *
 * Here some "housekeeping" takes place for the loop.  If the line_count is "0" we print call the top_page_headers()
 * method to display the header information that is shown for each page of a "real" logbook.  line_count is
 * incremented later in the loop.  After the correct number of lines, 30 per page, this is reset to "0" so that the
 * headers are written again for each new page.
 *
 * The data is in the form of an array, the elements of which are in the order of the database table.  We then
 * get this using array[element_number] format.  Each of these, in the order we want for the line's display, is
 * then placed within an HTML table cell.  While this looks like it might be possible to be a single global
 * method call used over and over, there are subtle differences for each cell, thus they have to be created
 * separately.  Sadly, this does make this code very long.
 *
 * Finally, the returned array CAN contain elements that are NULL (the elements exist, but the data they contain
 * is NULL, this is proper functionality if the data cell in the database contains NULL).  For each of the cells
 * where a NULL might occur (some database table elements are defined as explicitly "NOT NULL") we test for the
 * NULL condition.  If this is found we create the HTML table cell with the HTML directive "&nbsp" which ensures
 * that the cell's space matches those from any rows above or below.  With out this the overall table format
 * would be corrupted.
 *
 * TODO: Explore if there is any way to create a repeatedly called method, as described above, with proper
 *       arguments, so as to cut down on the awkwardness of the output statements in this loop.
 */
if($result->num_rows > 0) {
    while($row = $result->fetch_row()) {
        if($line_count == 0) {
            top_page_headers();
        }

        echo "  <TR ";
        if(($line_count % 2) == 0) {
            echo "BGCOLOR=\"#C0C0C0\">";
        }
        else {
            echo "BGCOLOR=\"#FFFFFF\">";
        }
        echo "\n    <TD><FONT=\"-3\">$row[0]</FONT></TD>\n";
        echo "    <TD><FONT=\"-3\">$row[1]</FONT></TD>\n";
        if($row[2] == "") {
            echo "    <TD><FONT=\"-3\">&nbsp</FONT></TD>\n";
        }
        else {
            echo "    <TD><FONT=\"-3\">$row[2]</FONT></TD>\n";
        }
        if($row[3] == "") {
            echo "    <TD><FONT=\"-3\">&nbsp</FONT></TD>\n";
        }
        else {
            echo "    <TD><FONT=\"-3\">$row[3]</FONT></TD>\n";
        }
        if($row[4] == "") {
            echo "    <TD><FONT=\"-3\">&nbsp</FONT></TD>\n";
        }
        else {
            echo "    <TD><FONT=\"-3\">$row[4]</FONT></TD>\n";
        }
        /*
         * The next item is one of the time elements requires a running total to be maintained.  We
         * do the simple "+=" math to maintain this total.
         *
         * The same method is used for each of the time elements that need such a total.
         *
         * These values are stored in the page_totals[] array variable so it can be passed in
         * total to another method.
         *
         * While it is not shown here, there is a "table" (not a database table, just a
         * reference table) of which array element represents which value (Total Flight Time,
         * Instrument Flight Time, etc).
         */
        echo "    <TD ALIGN=\"right\"><FONT=\"-3\">$row[5]</FONT></TD>\n";
        $page_totals[0] += $row[5];
        if($row[6] != 0) {
            echo "    <TD ALIGN=\"right\"><FONT=\"-3\">$row[6]</FONT></TD>\n";
            $page_totals[1] += $row[6];
        }
        else {
            echo "    <TD><FONT=\"-3\">&nbsp</FONT></TD>\n";
        }
        if($row[7] != 0) {
            echo "    <TD ALIGN=\"right\"><FONT=\"-3\">$row[7]</FONT></TD>\n";
            $page_totals[2] += $row[7];
        }
        else {
            echo "    <TD><FONT=\"-3\">&nbsp</FONT></TD>\n";
        }
        if($row[8] != 0) {
            echo "    <TD ALIGN=\"right\"><FONT=\"-3\">$row[8]</FONT></TD>\n";
            $page_totals[3] += $row[8];
        }
        else {
            echo "    <TD><FONT=\"-3\">&nbsp</FONT></TD>\n";
        }
        if($row[9] != 0) {
            echo "    <TD ALIGN=\"right\"><FONT=\"-3\">$row[9]</FONT></TD>\n";
            $page_totals[4] += $row[9];
        }
        else {
            echo "    <TD><FONT=\"-3\">&nbsp</FONT></TD>\n";
        }
        if($row[12] != 0) {
            echo "    <TD ALIGN=\"right\"><FONT=\"-3\">$row[12]</FONT></TD>\n";
            $page_totals[5] += $row[12];
        }
        else {
            echo "    <TD><FONT=\"-3\">&nbsp</FONT></TD>\n";
        }
        if($row[13] != 0) {
            echo "    <TD ALIGN=\"right\"><FONT=\"-3\">$row[13]</FONT></TD>\n";
            $page_totals[6] += $row[13];
        }
        else {
            echo "    <TD><FONT=\"-3\">&nbsp</FONT></TD>\n";
        }
        if($row[14] != 0) {
            echo "    <TD ALIGN=\"center\" ALIGN=\"center\"><FONT=\"-3\">$row[14]</FONT></TD>\n";
            $page_totals[7] += $row[14];
        }
        else {
            echo "    <TD><FONT=\"-3\">&nbsp</FONT></TD>\n";
        }
        if($row[15] != 0) {
            echo "    <TD ALIGN=\"right\"><FONT=\"-3\">$row[15]</FONT></TD>\n";
            $page_totals[8] += $row[15];
        }
        else {
            echo "    <TD><FONT=\"-3\">&nbsp</FONT></TD>\n";
        }
        if($row[16] != 0) {
            echo "    <TD ALIGN=\"center\"><FONT=\"-3\">$row[16]</FONT></TD>\n";
            $page_totals[9] += $row[16];
        }
        else {
            echo "    <TD><FONT=\"-3\">&nbsp</FONT></TD>\n";
        }
        if($row[17] != 0) {
            echo "    <TD ALIGN=\"center\"><FONT=\"-3\">$row[17]</FONT></TD>\n";
            $page_totals[10] += $row[17];
        }
        else {
            echo "    <TD><FONT=\"-3\">&nbsp</FONT></TD>\n";
        }
        if($row[18] != 0) {
            echo "    <TD ALIGN=\"right\"><FONT=\"-3\">$row[18]</FONT></TD>\n";
            $page_totals[11] += $row[18];
        }
        else {
            echo "    <TD><FONT=\"-3\">&nbsp</FONT></TD>\n";
        }
        if($row[19] != 0) {
            echo "    <TD ALIGN=\"right\" ALIGN=\"right\"><FONT=\"-3\">$row[19]</FONT></TD>\n";
            $page_totals[12] += $row[19];
        }
        else {
            echo "    <TD><FONT=\"-3\">&nbsp</FONT></TD>\n";
        }
        if($row[20] != 0) {
            echo "    <TD ALIGN=\"right\"><FONT=\"-3\">$row[20]</FONT></TD>\n";
            $page_totals[13] += $row[20];
        }
        else {
            echo "    <TD><FONT=\"-3\">&nbsp</FONT></TD>\n";
        }
        if($row[21] != 0) {
            echo "    <TD ALIGN=\"right\"><FONT=\"-3\">$row[21]</FONT></TD>\n";
            $page_totals[14] += $row[21];
        }
        else {
            echo "    <TD><FONT=\"-3\">&nbsp</FONT></TD>\n";
        }
        if($row[22] != 0) {
            echo "    <TD ALIGN=\"right\"><FONT=\"-3\">$row[22]</FONT></TD>\n";
            $page_totals[15] += $row[22];
        }
        else {
            echo "    <TD><FONT=\"-3\">&nbsp</FONT></TD>\n";
        }
        if($row[23] != 0) {
            echo "    <TD ALIGN=\"right\"><FONT=\"-3\">$row[23]</FONT></TD>\n";
            $page_totals[16] += $row[23];
        }
        else {
            echo "    <TD><FONT=\"-3\">&nbsp</FONT></TD>\n";
        }
        if($row[24] != 0) {
            echo "    <TD ALIGN=\"right\"><FONT=\"-3\">$row[24]</FONT></TD>\n  </BGCOLOR></TR>\n";
            $page_totals[17] += $row[24];
        }
        else {
            echo "    <TD><FONT=\"-3\">&nbsp</FONT></TD>\n  </BGCOLOR></TR>\n";
        }
        
        /*
         * Here we have reached the end section of the loop after going through each element of the returned
         * data array.
         *
         * We have just output the "</TR>" HTML table instruction to end the displayed table row.
         *
         * Now we perform the end-of-loop tasks, including incrementing the counters, and then testing whether
         * we have reached the end of the returned database data.  If we have, we exit the loop.
         *
         * We also have to create the second set of "running totals" data.  This is due to the need for "page
         * totals" and "overall totals".  We do this by looping through the elements of the page_totals[] and
         * grand_totals[] arrays, and doing a "+=" adding the page_totals data into the grand_totals data.
         */
        $result_row++;
        
        /*
         * This is the actual loop limit test.  When we reach the end of the data we print the "Grand Totals"
         * headers and the grand totals data, followed by closing out the HTML table via "</TABLE>".
         */
        if(($line_count++ == 29) || ($result_row > $result->num_rows)) {
            page_totals_header($page_totals);
            for($loop_count = 0; $loop_count < 18; $loop_count++) {
                $grand_totals[$loop_count] += $page_totals[$loop_count];
                $page_totals[$loop_count] = null;
            }
              
            grand_totals_header($grand_totals);
               
            $line_count = 0;
                
            echo "</TABLE>\n<BR>\n";
        }
    }
} // End of the outermost "while()" loop.

/*
 * Cleanup the result data with the result->close() method, then call the logbook_footer() method to show the
 * standard footer data, and finally exit the script.
 */
$result->close();
logbook_footer();
exit();
?>
