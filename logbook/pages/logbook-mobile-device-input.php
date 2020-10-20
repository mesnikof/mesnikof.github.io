<?php
/*
 * This is the new web device input PHP script.  It should only be called when the logbook system's
 * login tools determine that the user is on a mobile device (phone or tablet) via use of the
 * Mobile_Detect library function calls.
 *
 * Note: These are not included here as being unnecessary.  If we are here the determination is done.
 *
 * This PHP script is simpler than the "standard" input script in that it is assumed that anyone
 * using it is a pilot for the current company.  As such, the variety of required inputs, the range
 * of options needed, is far more limited than for a full desktop user.  This will allow for a much
 * more compact and readable screen, and much simpler input functions.
 *
 * Note: The user that gets here has already logged in to the logbook system.  The basic login page
 * is sufficiently simple that it will display without a great deal of difficulty on any mobile
 * device web browser, so changes there are not expected to be required.
 */
  
/*
 * First, as per usual, we will define the page_title variable and run the necessary require() calls,
 * after which we will call the logbook_header() method to write out the HTML page header info.
 *
 * Following those steps we will temporarily exit PHP to create a seriew of javascript functions
 * that provide "backend" functionality to such things as the radio-button set.
 */
$page_title = "Logbook System Data Input";
require('../include/logbook-include.php');
logbook_header();
?>

<SCRIPT LANGUAGE="javascript">
var rt_help = "Use this button to clear the form entry data.";

function set_idx() {
    return true
}

function change_date() {
    //
    // This function "pre-loads" the date from the "passed in" value
    //
    document.LogbookEntryForm.transfer_date.value = document.LogbookEntryForm.date.value;
    return true;
}

function set_times() {
    //
    // These functions deal with putting the user entered time values, all assumed to be in
    // "zulu" time, into their proper format for MySQL's use.  The functions also create an
    // "elapsed time" value bu subtracting "out" from "in", and finally round this into
    // tenths of an hour (per FAA requirements) rather than in minutes, where necessary.
    //
    // First set up the out_time and in_time info
    //
    document.LogbookEntryForm.out_time.value = "";
    if (document.LogbookEntryForm.out_time_hours.value < 10) {
        document.LogbookEntryForm.out_time.value = "0";
    }
    document.LogbookEntryForm.out_time.value += (document.LogbookEntryForm.out_time_hours.value);
    if (document.LogbookEntryForm.out_time_minutes.value < 10) {
        document.LogbookEntryForm.out_time.value += "0";
    }
    document.LogbookEntryForm.out_time.value += (document.LogbookEntryForm.out_time_minutes.value);
    document.LogbookEntryForm.out_time.value += "00";
    
    document.LogbookEntryForm.in_time.value = "";
    if (document.LogbookEntryForm.in_time_hours.value < 10) {
        document.LogbookEntryForm.in_time.value = "0";
    }
    document.LogbookEntryForm.in_time.value += (document.LogbookEntryForm.in_time_hours.value);
    if (document.LogbookEntryForm.in_time_minutes.value < 10) {
        document.LogbookEntryForm.in_time.value += "0";
    }
    document.LogbookEntryForm.in_time.value += (document.LogbookEntryForm.in_time_minutes.value);
    document.LogbookEntryForm.in_time.value += "00";
    
    //
    // Now set up the REALTIME info
    //
    temp_out_hour = new Number(document.LogbookEntryForm.out_time_hours.value * 60);
    temp_out_minute = new Number(document.LogbookEntryForm.out_time_minutes.value);
    temp_out_time = new Number(temp_out_hour + temp_out_minute);
    
    temp_in_hour = new Number(document.LogbookEntryForm.in_time_hours.value * 60);
    temp_in_minute = new Number(document.LogbookEntryForm.in_time_minutes.value);
    temp_in_time = new Number(temp_in_hour + temp_in_minute);
    
    temp_total_time = new Number(temp_in_time - temp_out_time);
    temp_total_minutes = new Number(temp_total_time % 60);
    temp_total_hours = new Number(temp_total_time - temp_total_minutes);
    temp_total_hours = (temp_total_hours / 60);
    
    if (temp_total_hours < 10) {
        document.LogbookEntryForm.realtime.value = "0";
        document.LogbookEntryForm.realtime.value += (temp_total_hours);
    }
    else {
        document.LogbookEntryForm.realtime.value = (temp_total_hours);
    }
    if (temp_total_minutes < 10) {
        document.LogbookEntryForm.realtime.value += "0";
        document.LogbookEntryForm.realtime.value += (temp_total_minutes);
    }
    else {
        document.LogbookEntryForm.realtime.value += (temp_total_minutes);
    }
    document.LogbookEntryForm.realtime.value += "00";
    
    //
    // Now set up the Total Time, etc. info
    //
    if (temp_total_hours < 1) {
        document.LogbookEntryForm.total_time.value = "0";
    }
    else {
        document.LogbookEntryForm.total_time.value = (temp_total_hours);
    }
    document.LogbookEntryForm.total_time.value += ".";
    temp_total_time_mod = new Number(temp_total_minutes % 6);
    temp_total_time_minutes = new Number((temp_total_minutes - temp_total_time_mod) / 6);
    if (temp_total_time_mod > 0) {
        temp_total_time_minutes += 1;
    }
    if (temp_total_time_minutes == 10) {
        temp_total_hours += 1;
        document.LogbookEntryForm.total_time.value = (temp_total_hours);
        document.LogbookEntryForm.total_time.value += ".0";
    }
    else {
        document.LogbookEntryForm.total_time.value += (temp_total_time_minutes);
    }
    
    //
    // Update the other data items
    //
    f_total_time();
    
    return true;
}
</script>

<style>
input[type='text'] { font-size: 30px; }
</style>

</head>

<?php
/*
 * We now return to the PHP script.  First we check for authorization data existance, showing
 * an error message if it is not there.
 */
if(!isset($_POST['u_name']) || !isset($_POST['p_word'])) {
    echo "<H1>401: Unauthorised Access<BR></h1>\n</center>\n</body>\n</html>\n";
    exit();
}

/*
 * Next we load the local variables with this GLOBAL and POST data.
 */
$u_name = $_POST['u_name'];
$p_word = $_POST['p_word'];
$h_name = $GLOBALS['web_svr'];
$d_base = "logbook";

/*
 * The transfered-in date data is loaded into a local variable.
 */
$ttxfr = $_POST['txfr'];

/*
 * Now create a database connection.  If this fails for any reason show an appropriate error
 * message and exit the script.  If it works, load the connection information into a GLOBAL
 * db_conn variable.
 */
$dbConn = new mysqli("$h_name", "$u_name", "$p_word", "$d_base");
if(mysqli_connect_errno()) {
    echo 'Login/Database Connection failed:'.mysqli_connect_error();
    exit();
}
$GLOBALS['db_conn'] = $dbConn;

/*
 * Get the current data (likely to be used), load it in the proper MySQL format into the
 * local cur_date variable.
 */
$cur_date = date("Y-m-d", time());

/*
 * Create a page-specific background color.  No specific reason, just for variety.
 */
echo "<BODY BGCOLOR=\"#C0C0FF\" LINK=\"#2000FF\" ALINK=\"#2000FF\" VLINK=\"#2000FF\">\n<CENTER>\n";

/*
 * Here, load the transferred-in date, if one exists, into the local transfer_date variable. If
 * it was not transferred in (perhaps first access of this session), load the current date.
 */
if($_POST[transfer_date]) {
    $transfer_date = $_POST[transfer_date];
}
else {
    $transfer_date = $cur_date;
}

/*
 * This is the real "heart" of this web form input page.  Here we will define the form to be POSTed
 * to the logbook-insert.php script for actual data insertion.  The data is loaded from a specially
 * designed table that assures readability of all the items.
 *
 * Where necessary and possible item-speific comments will follow.
 *
 * The initial few "echo"ed lines are the setup of the display, including the definition of the
 * input form and the table parameters, including several "hidden" values required for passing information
 * to the logbook-insert.php script.
 */
echo "<FONT color=\"blue\">\n<H2>The Logbook Entry Posting Page</H2></font>\n\n";

echo "<FORM NAME=\"LogbookEntryForm\" METHOD=\"post\" CLASS=\"formItem\" ACTION=\"$server_root/pages/logbook-mobile-device-insert.php\">\n";
echo " <INPUT TYPE=\"hidden\" NAME=\"u_name\" id=\"u_name\" value=\"$u_name\" />\n";
echo " <INPUT TYPE=\"hidden\" NAME=\"p_word\" id=\"p_word\" value=\"$p_word\" />\n";
echo " <INPUT TYPE=\"hidden\" NAME=\"txfr\" VALUE=\"1\">\n";
echo " <INPUT TYPE=\"hidden\" NAME=\"transfer_date\" VALUE=\"$transfer_date\">\n";
echo " <INPUT TYPE=\"hidden\" NAME=\"out_time\" VALUE=\"NULL\">\n";
echo " <INPUT TYPE=\"hidden\" NAME=\"in_time\" VALUE=\"NULL\">\n";

echo "<TABLE BORDER=\"3\" WIDTH=\"100%\" CELLPADDING=\"5\" COLS=\"2\" BGCOLOR=\"#C0FFC0\">\n";
    
echo " <TR>\n";
echo "  <TD ALIGN=\"center\" WIDTH=\"50%\"><INPUT TYPE=\"submit\" VALUE=\"Submit Entry\" style=\"font-size:30px;\"><BR></TD>\n";
echo "  <TD ALIGN=\"center\" WIDTH=\"50%\"><FONT SIZE=\"6\"><B>Flight Options</B><BR></TD>\n";
echo " </TR>\n";
    
echo " <TR>\n";
echo "  <TD ALIGN=\"center\" WIDTH=\"50%\"><FONT SIZE=\"6\"><B>Date:</B><BR><INPUT TYPE=\"text\" NAME=\"date\" SIZE=\"10\" VALUE=\"$transfer_date\" onChange=\"change_date()\"><BR></TD>\n";
echo "  <TD ALIGN=\"center\" WIDTH=\"50%\"><FONT SIZE=\"6\"><B><INPUT TYPE=\"radio\" NAME=\"a_c\" VALUE=\"9\" CHECKED>900<BR></TD>\n";
echo " </TR>\n";
    
echo " <TR>\n";
echo "  <TD ALIGN=\"center\" WIDTH=\"50%\"><FONT SIZE=\"6\"><B>Flight Number:</B><BR><INPUT TYPE=\"text\" NAME=\"ident\" SIZE=\"5\"><BR></TD>\n";
echo "  <TD ALIGN=\"center\" WIDTH=\"50%\"><FONT SIZE=\"6\"><B><INPUT TYPE=\"radio\" NAME=\"a_c\" VALUE=\"7\">700<BR></TD>\n";
echo " </TR>\n";
    
echo " <TR>\n";
echo "  <TD ALIGN=\"center\" WIDTH=\"50%\"><FONT SIZE=\"6\"><B>From:</B><BR><INPUT TYPE=\"text\" NAME=\"from\" SIZE=\"5\"><BR></TD>\n";
echo "  <TD ALIGN=\"center\" WIDTH=\"50%\"><FONT SIZE=\"6\"><B><INPUT TYPE=\"radio\" NAME=\"a_c\" VALUE=\"2\">200<BR></TD>\n";
echo " </TR>\n";
    
echo " <TR>\n";
echo " <TR>\n";
echo "  <TD ALIGN=\"center\" WIDTH=\"50%\"><FONT SIZE=\"6\"><B>To:</B><BR><INPUT TYPE=\"text\" NAME=\"to\" SIZE=\"5\"<BR></TD>\n";
echo "  <TD ALIGN=\"center\" WIDTH=\"50%\"><FONT SIZE=\"6\"><B><INPUT TYPE=\"radio\" NAME=\"f_opt\" VALUE=\"std\" CHECKED>Standard<BR></TD>\n";
echo " </TR>\n";
    
echo " <TR>\n";
echo "  <TD ALIGN=\"center\" WIDTH=\"50%\"><FONT SIZE=\"6\">\n";
echo "    <B>Out Time:</B><BR>\n<INPUT TYPE=\"text\" NAME=\"out_time_hours\" MAXLENGTH=\"2\" SIZE=\"2\">\n";
echo "    <INPUT TYPE=\"text\" NAME=\"out_time_minutes\" MAXLENGTH=\"2\" SIZE=\"2\">\n";
echo "    <INPUT TYPE=\"text\" NAME=\"out_time_seconds\" MAXLENGTH=\"2\" SIZE=\"2\" VALUE=\"00\" READONLY><BR></TD>\n";
echo "  <TD ALIGN=\"center\" WIDTH=\"50%\"><FONT SIZE=\"6\"><B><INPUT TYPE=\"radio\" NAME=\"f_opt\" VALUE=\"oe_n\">New Hire OE<BR></TD>\n";
echo " </TR>\n";
    
echo " <TR>\n";
echo "  <TD ALIGN=\"center\" WIDTH=\"50%\"><FONT SIZE=\"6\">\n";
echo "    <B>Out Time:</B><BR>\n<INPUT TYPE=\"text\" NAME=\"in_time_hours\" MAXLENGTH=\"2\" SIZE=\"2\">\n";
echo "    <INPUT TYPE=\"text\" NAME=\"in_time_minutes\" MAXLENGTH=\"2\" SIZE=\"2\">\n";
echo "    <INPUT TYPE=\"text\" NAME=\"in_time_seconds\" MAXLENGTH=\"2\" SIZE=\"2\" VALUE=\"00\" READONLY><BR></TD>\n";
echo "  <TD ALIGN=\"center\" WIDTH=\"50%\"><FONT SIZE=\"6\"><B><INPUT TYPE=\"radio\" NAME=\"f_opt\" VALUE=\"oe_c\">Captain OE<BR></TD>\n";
echo " </TR>\n";
    
echo " <TR>\n";
echo "  <TD ALIGN=\"center\" WIDTH=\"50%\"><FONT SIZE=\"6\"><B>IFR Actual:</B><BR><INPUT TYPE=\"text\" NAME=\"actual\" SIZE=\"4\"><BR><BR></TD>\n";
echo "  <TD ALIGN=\"center\" WIDTH=\"50%\"><FONT SIZE=\"6\"><B><INPUT TYPE=\"radio\" NAME=\"f_opt\" VALUE=\"lc\">Line Check<BR></TD>\n";
echo " </TR>\n";
echo " <TR>\n";
    
echo "  <TD ALIGN=\"center\" WIDTH=\"50%\"><FONT SIZE=\"6\"><B>Night:</B><BR><INPUT TYPE=\"text\" NAME=\"night\" SIZE=\"2\"><BR></TD>\n";
echo "  <TD ALIGN=\"center\" WIDTH=\"50%\"><FONT SIZE=\"6\"><B><INPUT TYPE=\"radio\" NAME=\"f_opt\" VALUE=\"fo\">FO Support<BR></TD>\n";
echo " </TR>\n";
    
echo " <TR>\n";
echo "  <TD ALIGN=\"center\" COLSPAN=\"2\" WIDTH=\"100%\">\n";
echo "   <TABLE BORDER=\"0\" WIDTH=\"100%\" CELLPADDING=\"5\" COLS=\"3\" BGCOLOR=\"#C0FFC0\">\n";
echo "    <TR>\n";
echo "     <TD ALIGN=\"center\" WIDTH=\"33%\"><FONT SIZE=\"6\"><B>IFR-Apprch:</B><BR><INPUT TYPE=\"text\" NAME=\"approaches\" SIZE=\"2\"><BR></TD>\n";
echo "     <TD ALIGN=\"center\" WIDTH=\"33%\" COLSPAN=\"2\"><FONT SIZE=\"6\"><B>Lndgs-Day:</B><BR><INPUT TYPE=\"text\" NAME=\"lndgs_day\" SIZE=\"2\"><BR></TD>\n";
echo "     <TD ALIGN=\"center\" WIDTH=\"33%\"><FONT SIZE=\"6\"><B>Lndgs-Night:</B><BR><INPUT TYPE=\"text\" NAME=\"lndgs_night\" SIZE=\"2\"><BR></TD>\n";
echo "    </TR>\n";
echo "   </TABLE>\n";
echo "  </TD>";
echo " </TR>\n";
    
echo " <TR>\n";
echo "  <TD ALIGN=\"center\" WIDTH=\"50%\"><FONT SIZE=\"6\"><B><INPUT TYPE=\"submit\" VALUE=\"Submit Entry\" style=\"font-size:30px;\"><BR></TD>\n";
echo "  <TD ALIGN=\"center\" WIDTH=\"50%\"><FONT SIZE=\"6\"><B><INPUT TYPE=\"reset\" VALUE=\"Clear Data\" style=\"font-size:30px;\"><BR></TD>\n";
echo " </TR>\n";
    
echo "</TABLE>\n\n";
echo "</FONT>\n";
echo "</FORM>\n</CENTER>\n\n";

logbook_footer();
exit();
?>
