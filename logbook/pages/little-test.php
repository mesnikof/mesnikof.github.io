<?php
    /*
     * "little-test.php"
     *
     * This PHP script is not, strictly speaking, a part of the logbook system.  It is, as the
     * filename implies, a small test unit, allowing for the developer to test either existing/updated
     * PHP script actions after maintenance/update coding has taken place, or to perfrom similar
     * testing on new functionality prior to inclusion in the logbook system.  This file is used to
     * allow for the easy inclusion of the "require"ed include script information.
     *
     * The file IS included as part of the logbook package so as to make system migration a simpler
     * process.
     *
     * No additional commenting is included as it is assumed that this file will be changed repeatedly
     * and is only for the developers' non-production use.
     */
    require('../include/logbook-include.php');

    logbook_header();
    echo "</head>\n\n";
 
    echo "<BODY BGCOLOR=\"#DCFFDC\" LINK=\"#8000FF\" ALINK=\"#8000FF\" VLINK=\"#8000FF\">\n\n";
    echo "<CENTER>\n\n";
    
    logbook_menu();

    $line_count = 0;
    $result_row = 1;

    $dbUser = "********";
    $password = "********";
    $database = "logbook";

    $dbConn = new mysqli($sql_svr,$dbUser,$password,$database);

    if($dbConn->connect_error)
    {
        die("Database Connection Error, Error No.: ".$dbConn->connect_errno." | ".$dbConn->connect_error);
    }

    $dbConn->get_charset();
    
    $dbConn->client_version;

    $selectQry = "SELECT * FROM details ORDER BY Date";
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
