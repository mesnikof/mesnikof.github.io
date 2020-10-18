<?php
    $page_title = "Logbook System Data Input";
    require('../include/logbook-include.php');

    logbook_header();
?>

<SCRIPT LANGUAGE="javascript">
var rt_help = "Use this button to clear the form entry data.";

function set_idx() {
    return true
}

function set_model() {
    pa_27 = "PA27"
    document.LogbookEntryForm.aircraft_model.value = document.LogbookEntryForm.model_sel.options[document.LogbookEntryForm.model_sel.selectedIndex].text
    if (document.LogbookEntryForm.aircraft_model.value == pa_27) {
        document.LogbookEntryForm.ident.value = "N790AC"
    }
    return true
}

function set_from() {
    document.LogbookEntryForm.from.value = document.LogbookEntryForm.from_sel.options[document.LogbookEntryForm.from_sel.selectedIndex].text
    return true
}

function set_to() {
    document.LogbookEntryForm.to.value = document.LogbookEntryForm.to_sel.options[document.LogbookEntryForm.to_sel.selectedIndex].text
    return true
}

function auto_tab(current, next) {
    if (current.getAttribute&&current.value.length == current.getAttribute("maxlength")) {
        next.focus();
    }
    return true
}

function f_total_time() {
    crj_9 = "CRJ9"
    crj_7 = "CRJ7"
    cl_65 = "CL65"
    pa_27 = "PA27"
    if (document.LogbookEntryForm.aircraft_model.value == cl_65) {
        document.LogbookEntryForm.mel_time.value = document.LogbookEntryForm.total_time.value
        document.LogbookEntryForm.complex_time.value = document.LogbookEntryForm.total_time.value
        document.LogbookEntryForm.turbine_time.value = document.LogbookEntryForm.total_time.value
        document.LogbookEntryForm.high_perf.value = document.LogbookEntryForm.total_time.value
        document.LogbookEntryForm.cross_cntry.value = document.LogbookEntryForm.total_time.value
        document.LogbookEntryForm.pic.value = document.LogbookEntryForm.total_time.value
        return true
    }
    if (document.LogbookEntryForm.aircraft_model.value == crj_9) {
        document.LogbookEntryForm.mel_time.value = document.LogbookEntryForm.total_time.value
        document.LogbookEntryForm.complex_time.value = document.LogbookEntryForm.total_time.value
        document.LogbookEntryForm.turbine_time.value = document.LogbookEntryForm.total_time.value
        document.LogbookEntryForm.high_perf.value = document.LogbookEntryForm.total_time.value
        document.LogbookEntryForm.cross_cntry.value = document.LogbookEntryForm.total_time.value
        document.LogbookEntryForm.pic.value = document.LogbookEntryForm.total_time.value
        return true
    }
    if (document.LogbookEntryForm.aircraft_model.value == crj_7) {
        document.LogbookEntryForm.mel_time.value = document.LogbookEntryForm.total_time.value
        document.LogbookEntryForm.complex_time.value = document.LogbookEntryForm.total_time.value
        document.LogbookEntryForm.turbine_time.value = document.LogbookEntryForm.total_time.value
        document.LogbookEntryForm.high_perf.value = document.LogbookEntryForm.total_time.value
        document.LogbookEntryForm.cross_cntry.value = document.LogbookEntryForm.total_time.value
        document.LogbookEntryForm.pic.value = document.LogbookEntryForm.total_time.value
        return true
    }
    if (document.LogbookEntryForm.aircraft_model.value == pa_27) {
        document.LogbookEntryForm.mel_time.value = document.LogbookEntryForm.total_time.value
        document.LogbookEntryForm.complex_time.value = document.LogbookEntryForm.total_time.value
        document.LogbookEntryForm.high_perf.value = document.LogbookEntryForm.total_time.value
        document.LogbookEntryForm.pic.value = document.LogbookEntryForm.total_time.value
        return true
    }
    return true
}

function set_flt_num() {
    document.LogbookEntryForm.ident.value = document.LogbookEntryForm.flt_num_sel.options[document.LogbookEntryForm.flt_num_sel.selectedIndex].text
    document.LogbookEntryForm.from.value = document.LogbookEntryForm.from_sel.options[document.LogbookEntryForm.flt_num_sel.selectedIndex].text
    document.LogbookEntryForm.to.value = document.LogbookEntryForm.to_sel.options[document.LogbookEntryForm.flt_num_sel.selectedIndex].text
    document.LogbookEntryForm.idx.value = document.LogbookEntryForm.idx_sel.options[document.LogbookEntryForm.flt_num_sel.selectedIndex].text
    return true
}

function change_date() {
    document.LogbookEntryForm.transfer_date.value = document.LogbookEntryForm.date.value;
    return true;
}

function set_times() {
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
</head>

<?php
if(!isset($_POST['u_name']) || !isset($_POST['p_word'])) {
    echo "<H1>401: Unauthorised Access<BR></h1>\n</center>\n</body>\n</html>\n";
    exit();
}
    
$u_name = $_POST['u_name'];
$p_word = $_POST['p_word'];
$h_name = $GLOBALS['web_svr'];
$d_base = "logbook";
    
$ttxfr = $_POST['txfr'];

$dbConn = new mysqli("$h_name", "$u_name", "$p_word", "$d_base");
if(mysqli_connect_errno()) {
    echo 'Login/Database Connection failed:'.mysqli_connect_error();
    exit();
}
$GLOBALS['db_conn'] = $dbConn;

$cur_date = date("Y-m-d", time());

echo "<BODY BGCOLOR=\"#C0C0FF\" LINK=\"#2000FF\" ALINK=\"#2000FF\" VLINK=\"#2000FF\">\n<CENTER>\n";

/* Use schedule stuff when it is activated
    if($_POST[transfer_date]) {
        $transfer_date = $_POST[transfer_date];
        $query = "SELECT * FROM sched.all_legs,sched.15996_legs WHERE ";
        $query .= "(sched.15996_legs.date='$transfer_date' OR ";
        $query .= "sched.15996_legs.date=('$transfer_date' - INTERVAL 1 DAY) OR ";
        $query .= "sched.15996_legs.date=('$transfer_date' - INTERVAL 2 DAY) OR ";
        $query .= "sched.15996_legs.date=('$transfer_date' - INTERVAL 3 DAY)) AND ";
        $query .= "sched.all_legs.idx=sched.15996_legs.idx ";
        $query .= "ORDER BY sched.all_legs.idx";
        $result = mysql_query("$query");
        if(!$result) {
            echo "</SELECT>";
            echo "<BR><BR> Query Failed!!! <BR><BR>" , mysql_error();
        }
        else {
            $target_date = strtok($transfer_date, "-");
            $target_date = strtok("-");
            $target_date = strtok("-");
            $cntr = 0;
            while(list($all_idx[$cntr],$all_trip[$cntr],$all_month[$cntr],$all_day[$cntr],$all_flight[$cntr],$all_from[$cntr],$all_to[$cntr],$all_out[$cntr],$all_in[$cntr],$usr_idx[$cntr],$usr_date[$cntr],$usr_out[$cntr],$usr_in[$cntr]) = mysql_fetch_row($result)) {
                if($usr_out[$cntr] == "") {
                    $usr_out[$cntr] = "NULL";
                }
                if($usr_in[$cntr] == "") {
                    $usr_in[$cntr] = "NULL";
                }
                $test_date = strtok(($usr_date[$cntr]), "-");
                $test_date = strtok("-");
                $test_date = strtok("-");
                $test_date = ($test_date + (($all_day[$cntr]) - 1));
                if($target_date == $test_date) {
                    $cntr++;
                }
            }
            mysql_free_result($result);
        }
    }
    else {
        $transfer_date = $cur_date;
    }
*/

if($_POST[transfer_date]) {
    $transfer_date = $_POST[transfer_date];
}
else {
    $transfer_date = $cur_date;
}

logbook_menu();
    
echo "<FONT color=\"blue\">\n<H1>The Logbook Entry Posting Page</H1></font>\n\n";
echo "<HR ALIGN=\"center\">\n\n<H3>Use this page to manually enter new logbook entries in the Flight Logbook database.<BR>\n</H3>\n\n";

echo "<FORM NAME=\"LogbookEntryForm\" METHOD=\"post\" CLASS=\"formItem\" ACTION=\"$server_root/pages/logbook-insert.php\">\n";
echo " <INPUT TYPE=\"hidden\" NAME=\"u_name\" id=\"u_name\" value=\"$u_name\" />\n";
echo " <INPUT TYPE=\"hidden\" NAME=\"p_word\" id=\"p_word\" value=\"$p_word\" />\n";
echo " <INPUT TYPE=\"hidden\" NAME=\"txfr\" VALUE=\"1\">\n";
echo " <INPUT TYPE=\"hidden\" NAME=\"transfer_date\" VALUE=\"$transfer_date\">\n";
echo " <INPUT TYPE=\"hidden\" NAME=\"out_time\" VALUE=\"NULL\">\n";
echo " <INPUT TYPE=\"hidden\" NAME=\"in_time\" VALUE=\"NULL\">\n";

echo " <TABLE BORDER=\"3\" WIDTH=\"100%\" CELLPADDING=\"5\" COLS=\"7\" BGCOLOR=\"#C0FFC0\">\n <TR>\n";
echo "  <TD ALIGN=\"center\" WIDTH=\"14%\"><INPUT TYPE=\"submit\" VALUE=\"Submit Entry\" TABINDEX=\"3\"><BR></TD>\n";
if($ttxfr == 1) {
    echo "  <TD ALIGN=\"center\" WIDTH=\"14%\"><FONT COLOR=\"#00FF00\">Last Query Passed $ttxfr</FONT><BR></TD>\n";
}
elseif($ttxfr == 0) {
    echo "  <TD ALIGN=\"center\" WIDTH=\"14%\"><FONT COLOR=\"#FF0000\">Last Query Failed $ttxfr</FONT><BR></TD>\n";
}
else {
    echo "  <TD ALIGN=\"center\" WIDTH=\"14%\">$ttxfr<BR></TD>\n";
}
echo "  <TD ALIGN=\"center\" WIDTH=\"14%\"><BR></TD>\n  <TD ALIGN=\"center\" WIDTH=\"14%\"><BR></TD>\n  <TD ALIGN=\"center\" WIDTH=\"14%\"><BR></TD>\n";
echo "  <TD ALIGN=\"center\" WIDTH=\"14%\"><B>Date:</B><BR><INPUT TYPE=\"text\" NAME=\"date\" SIZE=\"10\" VALUE=\"$transfer_date\" onChange=\"change_date()\"><BR></TD>\n";
echo "  <TD ALIGN=\"center\" WIDTH=\"16%\"><B>Aircraft Model:</B><BR><INPUT TYPE=\"text\" NAME=\"aircraft_model\" VALUE=\"CRJ9\" SIZE=\"8\"><BR>\n";
echo "   <SELECT NAME=\"model_sel\" SIZE=\"1\" onChange=\"set_model()\">\n";

    $selectQry = "SELECT DISTINCT `Aircraft-Model` FROM details ORDER BY `Aircraft-Model`";
    $result = $dbConn->query($selectQry);
    if($result->num_rows > 0) {
        while($row = $result->fetch_row()) {
            print("    <OPTION> $row[0] </OPTION>\n");
        }
    }
    $result->close();
?>
  </TD>
 </TR>

 <TR>
  <TD ALIGN="center"><B>Aircraft/Flight Number:</B><BR><INPUT TYPE="text" NAME="ident" SIZE="8" TABINDEX="1"><BR>
   <SELECT NAME="flt_num_sel" SIZE="1" onChange="set_flt_num()">
<?php
    for($cntr2 = 0; $cntr2 < $cntr; $cntr2++) {
        print("    <OPTION> $all_flight[$cntr2] </OPTION>\n");
    }
?>
  </TD>
  <TD ALIGN="center"><B>From:</B><BR><INPUT TYPE="text" NAME="from" SIZE="12" TABINDEX="1"><BR>
   <SELECT NAME="from_sel" SIZE="1" onChange="set_from()">
<?php
    if($_POST[txfr] == 1) {
        for($cntr2 = 0; $cntr2 < $cntr; $cntr2++) {
            print("    <OPTION> $all_from[$cntr2] </OPTION>\n");
        }
    }
    else {
        $selectQry = "SELECT DISTINCT `From` FROM details ORDER BY `From`";
        $result = $dbConn->query($selectQry);
        if($result->num_rows > 0) {
            while($row = $result->fetch_row()) {
                print("    <OPTION> $row[0] </OPTION>\n");
            }
        }
        $result->close();
    }
?>
  </TD>
  <TD ALIGN="center"><B>To:</B><BR><INPUT TYPE="text" NAME="to" SIZE="12" TABINDEX="1"><BR>
   <SELECT NAME="to_sel" SIZE="1" onChange="set_to()">
<?php
    if($_POST[txfr] == 1) {
        for($cntr2 = 0; $cntr2 < $cntr; $cntr2++) {
            print("    <OPTION> $all_to[$cntr2] </OPTION>\n");
        }
    }
    else {
        $selectQry = "SELECT DISTINCT `To` FROM details ORDER BY `To`";
        $result = $dbConn->query($selectQry);
        if($result->num_rows > 0) {
            while($row = $result->fetch_row()) {
                print("    <OPTION> $row[0] </OPTION>\n");
            }
        }
        $result->close();
    }
?>
  </TD>
  <TD ALIGN="center"><B>Out Time:</B><BR><INPUT TYPE="text" NAME="out_time_hours" MAXLENGTH="2" SIZE="2" TABINDEX="1" onKeyUp="auto_tab(this, document.LogbookEntryForm.out_time_minutes)">
   <INPUT TYPE="text" NAME="out_time_minutes" MAXLENGTH="2" SIZE="2" TABINDEX="1" onKeyUp="auto_tab(this, document.LogbookEntryForm.in_time_hours)">
   <INPUT TYPE="text" NAME="out_time_seconds" MAXLENGTH="2" SIZE="2" VALUE="00" READONLY><BR>
  </TD>
  <TD ALIGN="center"><B>In Time:</B><BR><INPUT TYPE="text" NAME="in_time_hours" MAXLENGTH="2" SIZE="2" TABINDEX="1" onKeyUp="auto_tab(this, document.LogbookEntryForm.in_time_minutes)">
   <INPUT TYPE="text" NAME="in_time_minutes" MAXLENGTH="2" SIZE="2" TABINDEX="1" onChange="set_times()">
   <INPUT TYPE="text" NAME="in_time_seconds" MAXLENGTH="2" SIZE="2" VALUE="00" READONLY><BR>
  </TD>
  <TD ALIGN="center"><B>Total Time:</B><BR><INPUT TYPE="text" NAME="total_time" SIZE="8" onChange="f_total_time()"><BR></TD>
  <TD ALIGN="center"><B>RealTime:</B><BR><INPUT TYPE="text" NAME="realtime" SIZE="10"><BR></TD>
 </TR>

 <TR>
  <TD ALIGN="center"><B>Instrument-Actual:</B><BR><INPUT TYPE="text" NAME="actual" SIZE="8" TABINDEX="2"><BR></TD>
  <TD ALIGN="center"><B>Instrument-Approaches:</B><BR><INPUT TYPE="text" NAME="approaches" SIZE="8" TABINDEX="2"><BR></TD>
  <TD ALIGN="center"><B>Night:</B><BR><INPUT TYPE="text" NAME="night" SIZE="8" TABINDEX="2"><BR></TD>
  <TD ALIGN="center"><B>Cross-Country:</B><BR><INPUT TYPE="text" NAME="cross_cntry" SIZE="8"><BR></TD>
  <TD ALIGN="center"><BR></TD>
  <TD ALIGN="center"><B>Landings-Day:</B><BR><INPUT TYPE="text" NAME="lndgs_day" SIZE="8" TABINDEX="2"><BR></TD>
  <TD ALIGN="center"><B>Landings-Night:</B><BR><INPUT TYPE="text" NAME="lndgs_night" SIZE="8" TABINDEX="2"><BR></TD>
 </TR>

 <TR>
  <TD ALIGN="center" COLSPAN="7"><HR ALIGN="center" SIZE="3"></TD>
 </TR>

 <TR>
  <TD ALIGN="center"><B>PIC:</B><BR><INPUT TYPE="text" NAME="pic" SIZE="8"><BR></TD>
  <TD ALIGN="center"><B>SIC:</B><BR><INPUT TYPE="text" NAME="sic" SIZE="8"><BR></TD>
  <TD ALIGN="center"><BR></TD>
  <TD ALIGN="center"><BR></TD>
  <TD ALIGN="center"><BR></TD>
  <TD ALIGN="center"><BR></TD>
  <TD ALIGN="center"><BR></TD>
 </TR>

 <TR>
  <TD ALIGN="center"><B>SEL:</B><BR><INPUT TYPE="text" NAME="sel_time" SIZE="8"><BR></TD>
  <TD ALIGN="center"><B>MEL:</B><BR><INPUT TYPE="text" NAME="mel_time" SIZE="8"><BR></TD>
  <TD ALIGN="center"><BR></TD>
  <TD ALIGN="center"><B>Complex:</B><BR><INPUT TYPE="text" NAME="complex_time" SIZE="8"><BR></TD>
  <TD ALIGN="center"><B>Turbine:</B><BR><INPUT TYPE="text" NAME="turbine_time" SIZE="8"><BR></TD>
  <TD ALIGN="center"><B>High-Performance:</B><BR><INPUT TYPE="text" NAME="high_perf" SIZE="8"><BR></TD>
  <TD ALIGN="center"><B>Tail-Wheel:</B><BR><INPUT TYPE="text" NAME="tail_wheel" SIZE="8"><BR></TD>
 </TR>

 <TR>
  <TD ALIGN="center" COLSPAN="7"><HR ALIGN="center" SIZE="3"></TD>
 </TR>

 <TR>
  <TD ALIGN="center"><B>Flight Training - Received:</B><BR><INPUT TYPE="text" NAME="training_rcvd" SIZE="8"><BR></TD>
  <TD ALIGN="center"><B>Aircraft Simulator/PCATD:</B><BR><INPUT TYPE="text" NAME="simulator" SIZE="8"><BR></TD>
  <TD ALIGN="center"><B>Instrument-Simulated:</B><BR><INPUT TYPE="text" NAME="simulated" SIZE="8"><BR></TD>
  <TD ALIGN="center"><BR></TD>
  <TD ALIGN="center"><B>Solo:</B><BR><INPUT TYPE="text" NAME="solo" SIZE="8"><BR></TD>
  <TD ALIGN="center"><B>Instruction - Given:</B><BR><INPUT TYPE="text" NAME="instructor" SIZE="8"><BR></TD>
  <TD ALIGN="center">
<?php
    if($_POST[txfr] == 1) {
        print("   <INPUT TYPE=\"hidden\" NAME=\"idx\" SIZE=\"7\"><BR>\n");
        print("    <SELECT NAME=\"idx_sel\" SIZE=\"1\" onChange=\"set_idx()\">\n");
        for($cntr2 = 0; $cntr2 < $cntr; $cntr2++) {
            print("     <OPTION> $all_idx[$cntr2] </OPTION>\n");
        }
    }
?>
  </TD>
 </TR>
</table>
<BR>

<INPUT TYPE="reset" VALUE="Clear Data" OnMouseOver="makeItVisible(rt_help)" onMouseOut="theTip.hide()">
<BR>

</form>
</center>

<?php
    logbook_footer();
    exit();
?>
