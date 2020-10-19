<?php
//ini_set('display_errors', 'On');
//error_reporting(E_ALL);

    $page_title = "Michael's LogBook Last 60 Days";
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
    
    echo "<FONT color=\"blue\">\n<H1>Logbook Data Page</h1>\n</font>\n\n";
    echo "<HR>\n\n<H2>The <U>Last 60 Days</u> of Logbook Data</h2>\n\n";

    $line_count = 0;
    $result_row = 1;
    //$page_totals[0] = 0;
    
    $selectQry = "SELECT * FROM logbook.details WHERE DATE_SUB(CURDATE(),INTERVAL 60 DAY) <= Date ORDER BY Date";
    $result = $dbConn->query($selectQry);
    
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
            
            $result_row++;
            
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
    }

    $result->close();
    logbook_footer();
    exit();
?>
