<?php
    $page_title = "Michael's LogBook Last 30 Days";
    require('../include/logbook-include.php');
    
    logbook_header();
    
    echo "</head>\n\n";
    echo "<BODY BGCOLOR=\"#C0C0FF\" LINK=\"#2000FF\" ALINK=\"#2000FF\" VLINK=\"#2000FF\">\n<CENTER>\n\n";
    
    if(!isset($_POST['u_name']) || !isset($_POST['p_word'])) {
        echo "<H1>401: Unauthorised Access<BR></h1>\n</center>\n</body>\n</html>\n";
        exit();
    }
    
    logbook_menu();
    
    $u_name = $_POST['u_name'];
    $p_word = $_POST['p_word'];
    $h_name = $GLOBALS['web_svr'];
    $d_base = "logbook";
    
    $dbConn = new mysqli("$h_name", "$u_name", "$p_word", "$d_base");
    if(mysqli_connect_errno()) {
        echo 'Login/Database Connection failed:'.mysqli_connect_error();
        exit();
    }
    $GLOBALS['db_conn'] = $dbConn;
    
    $cur_date = date("Y-m-d", time());
    $transfer_date = $cur_date;
    
    echo "<FONT color=\"blue\">\n<H1>Logbook Data Home Page</h1>\n</font>\n\n";
    echo "<HR>\n\n<H2>The <U>Current</U> Airline Logbook Totals</H2>\n\n";
    
    $selectQry = "SELECT ";
    $selectQry .= "SUM(`Total-Time`),SUM(`SEL`),SUM(`MEL`),SUM(`Complex`),SUM(`Turbine`),";
    $selectQry .= "SUM(`High-Performance`),SUM(`Tail-Wheel`),FORMAT(SUM(`Instrument-Actual`),1),";
    $selectQry .= "SUM(`Instrument-Simulated`),SUM(`Instrument-Approaches`),SUM(`Aircraft-Simulator-PCATD`),";
    $selectQry .= "SUM(`Landings-Day`),SUM(`Landings-Night`),SUM(`Flight-Training-Received`),";
    $selectQry .= "SUM(`Cross-Country`),SUM(`Night`),SUM(`Solo`),SUM(`PIC`),SUM(`SIC`),SUM(`Instruction-Given`) ";
    $selectQry .= "FROM details";

    $result = $dbConn->query($selectQry);
    
    
    
    

    echo "<TABLE BORDER=\"2\" WIDTH\"98%\" CELLPADDING=\"1\" BGCOLOR=\"#FFC0C0\">\n";
    echo " <TR>\n  <TD WIDTH=\"100%\">\n   <CENTER><H3>Overall Logbook Data</H3><BR>\n";
    echo "   <TABLE BORDER=\"3\" WIDTH=\"98%\" CELLPADDING=\"0\" COLS=\"6\">\n";

    if($result->num_rows > 0) {
        $data_line = $result->fetch_row();
        $total_time = $data_line[0];
        $SEL = $data_line[1];
        $MEL = $data_line[2];
        $complex = $data_line[3];
        $turbine = $data_line[4];
        $high_perf = $data_line[5];
        $tail_wheel = $data_line[6];
        $inst_actual = $data_line[7];
        $inst_sim = $data_line[8];
        $inst_appr = $data_line[9];
        $simulator = $data_line[10];
        $lndgs_day = $data_line[11];
        $lndgs_night = $data_line[12];
        $training_rcvd = $data_line[13];
        $cross_country = $data_line[14];
        $night = $data_line[15];
        $solo = $data_line[16];
        $PIC = $data_line[17];
        $SIC = $data_line[18];
        $instruct_given = $data_line[19];
    }
    else {
        echo "</TABLE>\n";
        echo "<BR><BR> Query Failed!!! <BR><BR>" , mysql_error();
    }
    $result->close();
?>

<FORM METHOD="POST" ACTION="null">
<TR>
  <TD ALIGN="CENTER"><B>Total Time:<BR><INPUT TYPE="TEXT" SIZE="6" VALUE="<?php echo "$total_time"; ?>" READONLY></B><BR></TD>
  <TD ALIGN="CENTER"><B>SEL:<BR><INPUT TYPE="TEXT" SIZE="6" VALUE="<?php echo "$SEL"; ?>" READONLY></B><BR></TD>
  <TD ALIGN="CENTER"><B>MEL:<BR><INPUT TYPE="TEXT" SIZE="6" VALUE="<?php echo "$MEL"; ?>" READONLY></B><BR></TD>
  <TD ALIGN="CENTER"><BR></TD>
  <TD ALIGN="CENTER"><B>PIC:<BR><INPUT TYPE="TEXT" SIZE="6" VALUE="<?php echo "$PIC"; ?>" READONLY></B><BR></TD>
  <TD ALIGN="CENTER"><B>SIC:<BR><INPUT TYPE="TEXT" SIZE="6" VALUE="<?php echo "$SIC"; ?>" READONLY></B><BR></TD>
</TR>
<TR>
  <TD ALIGN="CENTER"><BR></TD>
  <TD ALIGN="CENTER"><B>Complex:<BR><INPUT TYPE="TEXT" SIZE="6" VALUE="<?php echo "$complex"; ?>" READONLY></B><BR></TD>
  <TD ALIGN="CENTER"><B>Turbine:<BR><INPUT TYPE="TEXT" SIZE="6" VALUE="<?php echo "$turbine"; ?>" READONLY></B><BR></TD>
  <TD ALIGN="CENTER"><B>High-Performance:<BR><INPUT TYPE="TEXT" SIZE="6" VALUE="<?php echo "$high_perf"; ?>" READONLY></B><BR></TD>
  <TD ALIGN="CENTER"><B>Tail-Wheel:<BR><INPUT TYPE="TEXT" SIZE="6" VALUE="<?php echo "$tail_wheel"; ?>" READONLY></B><BR></TD>
  <TD ALIGN="CENTER"><BR></TD>
</TR>
<TR>
  <TD ALIGN="CENTER"><B>Instrument-Actual:<BR><INPUT TYPE="TEXT" SIZE="6" VALUE="<?php echo "$inst_actual"; ?>" READONLY></B><BR></TD>
  <TD ALIGN="CENTER"><B>Instrument-Simulated:<BR><INPUT TYPE="TEXT" SIZE="6" VALUE="<?php echo "$inst_sim"; ?>" READONLY></B><BR></TD>
  <TD ALIGN="CENTER"><B>Instrument-Approaches:<BR><INPUT TYPE="TEXT" SIZE="6" VALUE="<?php echo "$inst_appr"; ?>" READONLY></B><BR></TD>
  <TD ALIGN="CENTER"><BR></TD>
  <TD ALIGN="CENTER"><B>Landings-Day:<BR><INPUT TYPE="TEXT" SIZE="6" VALUE="<?php echo "$lndgs_day"; ?>" READONLY></B><BR></TD>
  <TD ALIGN="CENTER"><B>Landings-Night:<BR><INPUT TYPE="TEXT" SIZE="6" VALUE="<?php echo "$lndgs_night"; ?>" READONLY></B><BR></TD>
</TR>
<TR>
  <TD ALIGN="CENTER"><BR></TD>
  <TD ALIGN="CENTER"><BR></TD>
  <TD ALIGN="CENTER"><B>Cross-Country:<BR><INPUT TYPE="TEXT" SIZE="6" VALUE="<?php echo "$cross_country"; ?>" READONLY></B><BR></TD>
  <TD ALIGN="CENTER"><B>Night:<BR><INPUT TYPE="TEXT" SIZE="6" VALUE="<?php echo "$night"; ?>" READONLY></B><BR></TD>
  <TD ALIGN="CENTER"><BR></TD>
  <TD ALIGN="CENTER"><BR></TD>
</TR>
<TR>
  <TD ALIGN="CENTER"><B>Solo:<BR><INPUT TYPE="TEXT" SIZE="6" VALUE="<?php echo "$solo"; ?>" READONLY></B><BR></TD>
  <TD ALIGN="CENTER" COLSPAN="2"><B>Flight Training Received:<BR><INPUT TYPE="TEXT" SIZE="6" VALUE="<?php echo "$training_rcvd"; ?>" READONLY></B><BR></TD>
  <TD ALIGN="CENTER" COLSPAN="2"><B>Aircraft Simulator/PCATD:<BR><INPUT TYPE="TEXT" SIZE="6" VALUE="<?php echo "$simulator"; ?>" READONLY></B><BR></TD>
  <TD ALIGN="CENTER"><B>Instruction Given:<BR><INPUT TYPE="TEXT" SIZE="6" VALUE="<?php echo "$instruct_given"; ?>" READONLY></B><BR></TD>
</TR>
</TABLE>
</FORM>

<BR>

<H3>Time-Dependant Totals</H3>

<TABLE BORDER="3" WIDTH="98%" CELLPADDING="0" COLS="6">

<?php
    $query = "SELECT SUM(`Total-Time`) FROM details WHERE DATE_SUB(CURDATE(),INTERVAL 6 DAY) <= `Date`";
    if (!$result = $dbConn->query($query)) {
        // Oh no! The query failed.
        echo "Sorry, the website is experiencing problems.";
        // Again, do not do this on a public site, but we'll show you how
        // to get the error information
        echo "Error: Our query failed to execute and here is why: \n";
        echo "Query: " . $query . "\n";
        echo "Errno: " . $mysqli->errno . "\n";
        echo "Error: " . $mysqli->error . "\n";
        exit;
    }
    if($result->num_rows > 0) {
        $data_line = $result->fetch_row();
        $total_time_7 = $data_line[0];
    }
    else {
        $total_time_7 = "";
    }
    $result->close();

    $query = "SELECT `RealTime` FROM `details` ";
    $query .= "WHERE ((DATE_SUB(CURDATE(),INTERVAL 6 DAY) <= `Date`) ";
    $query .= "AND (`Aircraft-Model`=\"CL65\" OR `Aircraft-Model`=\"CRJ9\" OR `Aircraft-Model`=\"CRJ7\"))";
    if (!$result = $dbConn->query($query)) {
        // Oh no! The query failed.
        echo "Sorry, the website is experiencing problems.";
        // Again, do not do this on a public site, but we'll show you how
        // to get the error information
        echo "Error: Our query failed to execute and here is why: \n";
        echo "Query: " . $query . "\n";
        echo "Errno: " . $mysqli->errno . "\n";
        echo "Error: " . $mysqli->error . "\n";
        exit;
    }
    if($result->num_rows > 0) {
        while($data_line = $result->fetch_row()) {
            $hour_token = strtok($data_line[0], ':');
            $minute_token = strtok(':');
            $hour_total = $hour_total + $hour_token;
            $minute_total = $minute_total + $minute_token;
        }
        $real_time_7m = $minute_total % 60;
        $carry = ($minute_total - $real_time_7m) / 60;
        $real_time_7h = $hour_total + $carry;
        $real_time_7s = "00";
    }
    else {
        $real_time_7m = "";
        $real_time_7h = "";
        $real_time_7s = "";
    }
    $result->close();

    $hour_token = 0;
    $hour_total = 0;
    $minute_token = 0;
    $minute_total = 0;
    $carry = 0;
    
    $query = "SELECT `RealTime` FROM `details` ";
    $query .= "WHERE ((DATE_FORMAT(CURDATE(),\"%m\") = DATE_FORMAT(`Date`,\"%m\")) ";
    $query .= "AND (`Aircraft-Model`=\"CL65\" OR `Aircraft-Model`=\"CRJ9\" OR `Aircraft-Model`=\"CRJ7\"))";
    if (!$result = $dbConn->query($query)) {
        // Oh no! The query failed.
        echo "Sorry, the website is experiencing problems.";
        // Again, do not do this on a public site, but we'll show you how
        // to get the error information
        echo "Error: Our query failed to execute and here is why: \n";
        echo "Query: " . $query . "\n";
        echo "Errno: " . $mysqli->errno . "\n";
        echo "Error: " . $mysqli->error . "\n";
        exit;
    }
    if($result->num_rows > 0) {
        while($data_line = $result->fetch_row()) {
            $hour_token = strtok($data_line[0], ':');
            $minute_token = strtok(':');
            $hour_total = $hour_total + $hour_token;
            $minute_total = $minute_total + $minute_token;
        }
        $real_time_mm = $minute_total % 60;
        $carry = ($minute_total - $real_time_mm) / 60;
        $real_time_mh = $hour_total + $carry;
        $real_time_ms = "00";
    }
    else {
        $real_time_mm = "";
        $real_time_mh = "";
        $real_time_ms = "";
    }
    $result->close();

    $query = "SELECT SUM(`Total-Time`) FROM `details` WHERE DATE_SUB(CURDATE(),INTERVAL 30 DAY) <= `Date`";
    if (!$result = $dbConn->query($query)) {
        // Oh no! The query failed.
        echo "Sorry, the website is experiencing problems.";
        // Again, do not do this on a public site, but we'll show you how
        // to get the error information
        echo "Error: Our query failed to execute and here is why: \n";
        echo "Query: " . $query . "\n";
        echo "Errno: " . $mysqli->errno . "\n";
        echo "Error: " . $mysqli->error . "\n";
        exit;
    }
    if($result->num_rows > 0) {
        $data_line = $result->fetch_row();
        $total_time_30 = $data_line[0];
    }
    else {
        $total_time_30 = "";
    }
    $result->close();

    $hour_token = 0;
    $hour_total = 0;
    $minute_token = 0;
    $minute_total = 0;
    $carry = 0;
    
    $query = "SELECT `RealTime` FROM `details` ";
    $query .= "WHERE ((DATE_SUB(CURDATE(),INTERVAL 30 DAY) <= `Date`) ";
    $query .= "AND (`Aircraft-Model`=\"CL65\" OR `Aircraft-Model`=\"CRJ9\" OR `Aircraft-Model`=\"CRJ7\"))";
    if (!$result = $dbConn->query($query)) {
        // Oh no! The query failed.
        echo "Sorry, the website is experiencing problems.";
        // Again, do not do this on a public site, but we'll show you how
        // to get the error information
        echo "Error: Our query failed to execute and here is why: \n";
        echo "Query: " . $query . "\n";
        echo "Errno: " . $mysqli->errno . "\n";
        echo "Error: " . $mysqli->error . "\n";
        exit;
    }
    if($result->num_rows > 0) {
        while($data_line = $result->fetch_row()) {
            $hour_token = strtok($data_line[0], ':');
            $minute_token = strtok(':');
            $hour_total = $hour_total + $hour_token;
            $minute_total = $minute_total + $minute_token;
        }
        $real_time_30m = $minute_total % 60;
        $carry = ($minute_total - $real_time_30m) / 60;
        $real_time_30h = $hour_total + $carry;
        $real_time_30s = "00";
    }
    else {
        $real_time_30m = "";
        $real_time_30h = "";
        $real_time_30s = "";
    }
    $result->close();
    
    $query = "SELECT SUM(`Total-Time`) FROM `details` WHERE DATE_SUB(CURDATE(),INTERVAL 90 DAY) <= `Date`";
    if (!$result = $dbConn->query($query)) {
        // Oh no! The query failed.
        echo "Sorry, the website is experiencing problems.";
        // Again, do not do this on a public site, but we'll show you how
        // to get the error information
        echo "Error: Our query failed to execute and here is why: \n";
        echo "Query: " . $query . "\n";
        echo "Errno: " . $mysqli->errno . "\n";
        echo "Error: " . $mysqli->error . "\n";
        exit;
    }
    if($result->num_rows > 0) {
        $data_line = $result->fetch_row();
        $total_time_90 = $data_line[0];
    }
    else {
        $total_time_90 = "";
    }
    $result->close();
    
    $hour_token = 0;
    $hour_total = 0;
    $minute_token = 0;
    $minute_total = 0;
    $carry = 0;
    
    $query = "SELECT `RealTime` FROM `details` ";
    $query .= "WHERE ((DATE_SUB(CURDATE(),INTERVAL 90 DAY) <= `Date`) ";
    $query .= "AND (`Aircraft-Model`=\"CL65\" OR `Aircraft-Model`=\"CRJ9\" OR `Aircraft-Model`=\"CRJ7\"))";
    if (!$result = $dbConn->query($query)) {
        // Oh no! The query failed.
        echo "Sorry, the website is experiencing problems.";
        // Again, do not do this on a public site, but we'll show you how
        // to get the error information
        echo "Error: Our query failed to execute and here is why: \n";
        echo "Query: " . $query . "\n";
        echo "Errno: " . $mysqli->errno . "\n";
        echo "Error: " . $mysqli->error . "\n";
        exit;
    }
    if($result->num_rows > 0) {
        while($data_line = $result->fetch_row()) {
            $hour_token = strtok($data_line[0], ':');
            $minute_token = strtok(':');
            $hour_total = $hour_total + $hour_token;
            $minute_total = $minute_total + $minute_token;
        }
        $real_time_90m = $minute_total % 60;
        $carry = ($minute_total - $real_time_90m) / 60;
        $real_time_90h = $hour_total + $carry;
        $real_time_90s = "00";
    }
    else {
        $real_time_90m = "";
        $real_time_90h = "";
        $real_time_90s = "";
    }
    $result->close();

    $query = "SELECT SUM(`Total-Time`) FROM `details` WHERE DATE_SUB(CURDATE(),INTERVAL 180 DAY) <= `Date`";
    if (!$result = $dbConn->query($query)) {
        // Oh no! The query failed.
        echo "Sorry, the website is experiencing problems.";
        // Again, do not do this on a public site, but we'll show you how
        // to get the error information
        echo "Error: Our query failed to execute and here is why: \n";
        echo "Query: " . $query . "\n";
        echo "Errno: " . $mysqli->errno . "\n";
        echo "Error: " . $mysqli->error . "\n";
        exit;
    }
    if($result->num_rows > 0) {
        $data_line = $result->fetch_row();
        $total_time_180 = $data_line[0];
    }
    else {
        $total_time_180 = "";
    }
    $result->close();

    $hour_token = 0;
    $hour_total = 0;
    $minute_token = 0;
    $minute_total = 0;
    $carry = 0;
    
    $query = "SELECT `RealTime` FROM `details` ";
    $query .= "WHERE ((DATE_SUB(CURDATE(),INTERVAL 180 DAY) <= `Date`) ";
    $query .= "AND (`Aircraft-Model`=\"CL65\" OR `Aircraft-Model`=\"CRJ9\" OR `Aircraft-Model`=\"CRJ7\"))";
    if (!$result = $dbConn->query($query)) {
        // Oh no! The query failed.
        echo "Sorry, the website is experiencing problems.";
        // Again, do not do this on a public site, but we'll show you how
        // to get the error information
        echo "Error: Our query failed to execute and here is why: \n";
        echo "Query: " . $query . "\n";
        echo "Errno: " . $mysqli->errno . "\n";
        echo "Error: " . $mysqli->error . "\n";
        exit;
    }
    if($result->num_rows > 0) {
        while($data_line = $result->fetch_row()) {
            $hour_token = strtok($data_line[0], ':');
            $minute_token = strtok(':');
            $hour_total = $hour_total + $hour_token;
            $minute_total = $minute_total + $minute_token;
        }
        $real_time_180m = $minute_total % 60;
        $carry = ($minute_total - $real_time_180m) / 60;
        $real_time_180h = $hour_total + $carry;
        $real_time_180s = "00";
    }
    else {
        $real_time_180m = "";
        $real_time_180h = "";
        $real_time_180s = "";
    }
    $result->close();

    $query = "SELECT SUM(`Total-Time`) FROM `details` WHERE DATE_SUB(CURDATE(),INTERVAL 365 DAY) <= `Date`";
    if (!$result = $dbConn->query($query)) {
        // Oh no! The query failed.
        echo "Sorry, the website is experiencing problems.";
        // Again, do not do this on a public site, but we'll show you how
        // to get the error information
        echo "Error: Our query failed to execute and here is why: \n";
        echo "Query: " . $query . "\n";
        echo "Errno: " . $mysqli->errno . "\n";
        echo "Error: " . $mysqli->error . "\n";
        exit;
    }
    if($result->num_rows > 0) {
        $data_line = $result->fetch_row();
        $total_time_365 = $data_line[0];
    }
    else {
        $total_time_365 = "";
    }
    $result->close();

    $hour_token = 0;
    $hour_total = 0;
    $minute_token = 0;
    $minute_total = 0;
    $carry = 0;
    
    $query = "SELECT `RealTime` FROM `details` ";
    $query .= "WHERE ((DATE_SUB(CURDATE(),INTERVAL 365 DAY) <= `Date`) ";
    $query .= "AND (`Aircraft-Model`=\"CL65\" OR `Aircraft-Model`=\"CRJ9\" OR `Aircraft-Model`=\"CRJ7\"))";
    if (!$result = $dbConn->query($query)) {
        // Oh no! The query failed.
        echo "Sorry, the website is experiencing problems.";
        // Again, do not do this on a public site, but we'll show you how
        // to get the error information
        echo "Error: Our query failed to execute and here is why: \n";
        echo "Query: " . $query . "\n";
        echo "Errno: " . $mysqli->errno . "\n";
        echo "Error: " . $mysqli->error . "\n";
        exit;
    }
    if($result->num_rows > 0) {
        while($data_line = $result->fetch_row()) {
            $hour_token = strtok($data_line[0], ':');
            $minute_token = strtok(':');
            $hour_total = $hour_total + $hour_token;
            $minute_total = $minute_total + $minute_token;
        }
        $real_time_365m = $minute_total % 60;
        $carry = ($minute_total - $real_time_365m) / 60;
        $real_time_365h = $hour_total + $carry;
        $real_time_365s = "00";
    }
    else {
        $real_time_365m = "";
        $real_time_365h = "";
        $real_time_365s = "";
    }
    $result->close();
?>

<FORM METHOD="POST" ACTION="null">
<TR>
<TD ALIGN="CENTER"><B>PIC:<BR><INPUT TYPE="TEXT" SIZE="10" VALUE="<?php echo "$total_time_7"; ?>" READONLY></B><BR></TD>
<TD ALIGN="CENTER"><B>Current Calender Month:<BR>&nbsp;</TD>
<TD ALIGN="CENTER"><B>Last 30 Days:<BR><INPUT TYPE="TEXT" SIZE="10" VALUE="<?php echo "$total_time_30"; ?>" READONLY></B><BR></TD>
<TD ALIGN="CENTER"><B>Last 90 Days:<BR><INPUT TYPE="TEXT" SIZE="10" VALUE="<?php echo "$total_time_90"; ?>" READONLY></B><BR></TD>
<TD ALIGN="CENTER"><B>Last 180 Days:<BR><INPUT TYPE="TEXT" SIZE="10" VALUE="<?php echo "$total_time_180"; ?>" READONLY></B><BR></TD>
<TD ALIGN="CENTER"><B>Last 365 Days:<BR><INPUT TYPE="TEXT" SIZE="10" VALUE="<?php echo "$total_time_365"; ?>" READONLY></B><BR></TD>
</TR>
<TR>
<TD ALIGN="CENTER"><INPUT TYPE="TEXT" SIZE="10" VALUE="<?php printf("%d:%02d:%02d",$real_time_7h,$real_time_7m,$real_time_7s); ?>" READONLY></B><BR></TD>
<TD ALIGN="CENTER"><INPUT TYPE="TEXT" SIZE="10" VALUE="<?php printf("%d:%02d:%02d",$real_time_mh,$real_time_mm,$real_time_ms); ?>" READONLY></B><BR></TD>
<TD ALIGN="CENTER"><INPUT TYPE="TEXT" SIZE="10" VALUE="<?php printf("%d:%02d:%02d",$real_time_30h,$real_time_30m,$real_time_30s); ?>" READONLY></B><BR></TD>
<TD ALIGN="CENTER"><INPUT TYPE="TEXT" SIZE="10" VALUE="<?php printf("%d:%02d:%02d",$real_time_90h,$real_time_90m,$real_time_90s); ?>" READONLY></B><BR></TD>
<TD ALIGN="CENTER"><INPUT TYPE="TEXT" SIZE="10" VALUE="<?php printf("%d:%02d:%02d",$real_time_180h,$real_time_180m,$real_time_180s); ?>" READONLY></B><BR></TD>
<TD ALIGN="CENTER"><INPUT TYPE="TEXT" SIZE="10" VALUE="<?php printf("%d:%02d:%02d",$real_time_365h,$real_time_365m,$real_time_365s); ?>" READONLY></B><BR></TD>
</TR>
</FORM>
</TABLE>

<BR><BR>

<H3>Special Totals</H3>

<TABLE BORDER="3" WIDTH="98%" CELLPADDING="0" COLS="6">

<?php
    $query = "SELECT SUM(`PIC`) FROM `details` WHERE (`Turbine` > 0)";
    if (!$result = $dbConn->query($query)) {
        // Oh no! The query failed.
        echo "Sorry, the website is experiencing problems.";
        // Again, do not do this on a public site, but we'll show you how
        // to get the error information
        echo "Error: Our query failed to execute and here is why: \n";
        echo "Query: " . $query . "\n";
        echo "Errno: " . $mysqli->errno . "\n";
        echo "Error: " . $mysqli->error . "\n";
        exit;
    }
    if($result) {
        $data_line = $result->fetch_row();
        $turbine_pic = $data_line[0];
    }
    else {
        $turbine_pic = "";
    }
    $result->close();

    $query = "SELECT SUM(`Night`) FROM `details` WHERE ((`Turbine` > 0) AND (`PIC` > 0))";
    if (!$result = $dbConn->query($query)) {
        // Oh no! The query failed.
        echo "Sorry, the website is experiencing problems.";
        // Again, do not do this on a public site, but we'll show you how
        // to get the error information
        echo "Error: Our query failed to execute and here is why: \n";
        echo "Query: " . $query . "\n";
        echo "Errno: " . $mysqli->errno . "\n";
        echo "Error: " . $mysqli->error . "\n";
        exit;
    }
    if($result) {
        $data_line = $result->fetch_row();
        $night_turbine_pic = $data_line[0];
    }
    else {
        $night_turbine_pic = "";
    }
    $result->close();

    $query = "SELECT SUM(`SIC`) FROM `details` WHERE (`Turbine` > 0)";
    if (!$result = $dbConn->query($query)) {
        // Oh no! The query failed.
        echo "Sorry, the website is experiencing problems.";
        // Again, do not do this on a public site, but we'll show you how
        // to get the error information
        echo "Error: Our query failed to execute and here is why: \n";
        echo "Query: " . $query . "\n";
        echo "Errno: " . $mysqli->errno . "\n";
        echo "Error: " . $mysqli->error . "\n";
        exit;
    }
    if($result) {
        $data_line = $result->fetch_row();
        $turbine_sic = $data_line[0];
    }
    else {
        $turbine_sic = "";
    }
    $result->close();

    $query = "SELECT SUM(`Night`) FROM `details` WHERE ((`Turbine` > 0) AND (`SIC` > 0))";
    if (!$result = $dbConn->query($query)) {
        // Oh no! The query failed.
        echo "Sorry, the website is experiencing problems.";
        // Again, do not do this on a public site, but we'll show you how
        // to get the error information
        echo "Error: Our query failed to execute and here is why: \n";
        echo "Query: " . $query . "\n";
        echo "Errno: " . $mysqli->errno . "\n";
        echo "Error: " . $mysqli->error . "\n";
        exit;
    }
    if($result) {
        $data_line = $result->fetch_row();
        $night_turbine_sic = $data_line[0];
    }
    else {
        $night_turbine_sic = "";
    }
    $result->close();
?>

<FORM METHOD="POST" ACTION="null">
<TR>
<TD ALIGN="CENTER"><B>Turbine PIC:<BR><INPUT TYPE="TEXT" SIZE="10" VALUE="<?php echo "$turbine_pic"; ?>" READONLY></B><BR></TD>
<TD ALIGN="CENTER"><B>Night Turbine PIC:<BR><INPUT TYPE="TEXT" SIZE="10" VALUE="<?php echo "$night_turbine_pic"; ?>" READONLY></B><BR></TD>
<TD ALIGN="CENTER"><B>Turbine SIC:<BR><INPUT TYPE="TEXT" SIZE="10" VALUE="<?php echo "$turbine_sic"; ?>" READONLY></B><BR></TD>
<TD ALIGN="CENTER"><B>Night Turbine SIC:<BR><INPUT TYPE="TEXT" SIZE="10" VALUE="<?php echo "$night_turbine_sic"; ?>" READONLY></B><BR></TD>
<TD ALIGN="CENTER"><B>Last 180 Days:<BR><INPUT TYPE="TEXT" SIZE="10" VALUE="<?php echo "$total_time_180"; ?>" READONLY></B><BR></TD>
<TD ALIGN="CENTER"><B>Last 365 Days:<BR><INPUT TYPE="TEXT" SIZE="10" VALUE="<?php echo "$total_time_365"; ?>" READONLY></B><BR></TD>
</TR>
</FORM>
</TABLE>

<BR><BR>

</TABLE> <!-- The overall table -->

<?php
    logbook_footer();
    exit();
?>
