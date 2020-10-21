<?php
/*
 * "logbook-printout-headears.php"
 *
 * This PHP script conatins three functions, each of which simply outputs a set of HTML
 * "table header" information.  This is used repeatedly in several of the PHP scripts that
 * make up the logbook system.
 *
 * Each of these functions simply uses the "echo" instruction to output the desired HTML
 * format information.  Everything is contained within PHP as use is made of the PHP variable
 * data to create the specific content.
 *
 * The PHP and HTML are very straightforward, and should be understandable without additional
 * explanation.  The input arguments for each function are a PHP "array" variable, which is
 * then "extracted" during the function execution.
 *
 * Note: The outpu format is meant to mimic a popular "standard" pilot logbook that is
 * considered acceptable for use by the FAA.  As a pilot's logbook is considered a legal
 * document, this output needs to be in a format the FAA considers proper for submission
 * should this become necessary.
 */
function page_totals_header($page_totals) {
    echo "  <TR>\n    <TH ALIGN=\"center\" COLSPAN=\"23\"><SMALL>Totals This Page</SMALL></TH>\n  </TR>\n";
    echo "  <TR>\n    <TD COLSPAN=\"5\">&nbsp</TD>\n";
    echo "    <TD ALIGN=\"right\">$page_totals[0]</TD>\n";
    echo "    <TD ALIGN=\"right\">$page_totals[1]</TD>\n";
    echo "    <TD ALIGN=\"right\">$page_totals[2]</TD>\n";
    echo "    <TD ALIGN=\"right\">$page_totals[3]</TD>\n";
    echo "    <TD ALIGN=\"right\">$page_totals[4]</TD>\n";
    echo "    <TD ALIGN=\"right\">$page_totals[5]</TD>\n";
    echo "    <TD ALIGN=\"right\">$page_totals[6]</TD>\n";
    echo "    <TD ALIGN=\"center\">$page_totals[7]</TD>\n";
    echo "    <TD ALIGN=\"right\">$page_totals[8]</TD>\n";
    echo "    <TD ALIGN=\"center\">$page_totals[9]</TD>\n";
    echo "    <TD ALIGN=\"center\">$page_totals[10]</TD>\n";
    echo "    <TD ALIGN=\"right\">$page_totals[11]</TD>\n";
    echo "    <TD ALIGN=\"right\">$page_totals[12]</TD>\n";
    echo "    <TD ALIGN=\"right\">$page_totals[13]</TD>\n";
    echo "    <TD ALIGN=\"right\">$page_totals[14]</TD>\n";
    echo "    <TD ALIGN=\"right\">$page_totals[15]</TD>\n";
    echo "    <TD ALIGN=\"right\">$page_totals[16]</TD>\n";
    echo "    <TD ALIGN=\"right\">$page_totals[17]</TD>\n";
    echo "  </TR>\n";
 }
 
function grand_totals_header($grand_totals) {
    echo "  <TR>\n    <TH ALIGN=\"center\" COLSPAN=\"23\"><SMALL>Grand Totals</SMALL></TH>\n  </TR>\n";
    echo "  <TR>\n    <TD COLSPAN=\"5\">&nbsp</TD>\n";
    echo "    <TD ALIGN=\"right\">$grand_totals[0]</TD>\n";
    echo "    <TD ALIGN=\"right\">$grand_totals[1]</TD>\n";
    echo "    <TD ALIGN=\"right\">$grand_totals[2]</TD>\n";
    echo "    <TD ALIGN=\"right\">$grand_totals[3]</TD>\n";
    echo "    <TD ALIGN=\"right\">$grand_totals[4]</TD>\n";
    echo "    <TD ALIGN=\"right\">$grand_totals[5]</TD>\n";
    echo "    <TD ALIGN=\"right\">$grand_totals[6]</TD>\n";
    echo "    <TD ALIGN=\"center\">$grand_totals[7]</TD>\n";
    echo "    <TD ALIGN=\"right\">$grand_totals[8]</TD>\n";
    echo "    <TD ALIGN=\"center\">$grand_totals[9]</TD>\n";
    echo "    <TD ALIGN=\"center\">$grand_totals[10]</TD>\n";
    echo "    <TD ALIGN=\"right\">$grand_totals[11]</TD>\n";
    echo "    <TD ALIGN=\"right\">$grand_totals[12]</TD>\n";
    echo "    <TD ALIGN=\"right\">$grand_totals[13]</TD>\n";
    echo "    <TD ALIGN=\"right\">$grand_totals[14]</TD>\n";
    echo "    <TD ALIGN=\"right\">$grand_totals[15]</TD>\n";
    echo "    <TD ALIGN=\"right\">$grand_totals[16]</TD>\n";
    echo "    <TD ALIGN=\"right\">$grand_totals[17]</TD>\n";
    echo "  </TR>\n";
}

function top_page_headers() {
//    echo "<P STYLE=\"page-break-before: always\">\n";
    echo "<TABLE  style=\"page-break-before: always\" BORDER=\"1\" WIDTH=\"98%\" CELLPADDING=\"1\" BGCOLOR=\"#C0C0FF\">\n";
    echo "  <TR>\n";
    echo "    <TH COLSPAN=\"3\" ALIGN=\"center\">&nbsp</TH>\n";
    echo "    <TH COLSPAN=\"2\" ALIGN=\"center\">Route of Flight</TH>\n";
    echo "    <TH>&nbsp</TH>\n";
    echo "    <TH COLSPAN=\"4\" ALIGN=\"center\">Aircraft Category and Class</TH>\n";
    echo "    <TH COLSPAN=\"3\" ALIGN=\"center\">Instrument</TH>\n";
    echo "    <TH>&nbsp</TH>\n";
    echo "    <TH COLSPAN=\"2\" ALIGN=\"center\">Landings</TH>\n";
    echo "    <TH COLSPAN=\"8\" ALIGN=\"center\">Type of Pilot Experience/Training</TH>\n";
    echo "  </TR>\n";
    echo "  <TR>\n";
    echo "    <TH><SMALL>Date</SMALL></TH>\n";
    echo "    <TH><SMALL>Aircraft<BR>Model</SMALL></TH>\n";
    echo "    <TH><SMALL>Aircraft<BR>Flight<BR>Ident</SMALL></TH>\n";
    echo "    <TH><SMALL>From</SMALL></TH>\n";
    echo "    <TH><SMALL>To</SMALL></TH>\n";
    echo "    <TH><SMALL>Total<BR>Time</SMALL></TH>\n";
    echo "    <TH><SMALL>SEL</SMALL></TH>\n";
    echo "    <TH><SMALL>MEL</SMALL></TH>\n";
    echo "    <TH><SMALL>Complex</SMALL></TH>\n";
    echo "    <TH><SMALL>Turbine</SMALL></TH>\n";
    echo "    <TH><SMALL>Instrument<BR>Actual</SMALL></TH>\n";
    echo "    <TH><SMALL>Instrument<BR>Simulated</SMALL></TH>\n";
    echo "    <TH><SMALL>Instrument<BR>Approaches</SMALL></TH>\n";
    echo "    <TH><SMALL>Aircraft<BR>Simulator<BR>PCATD</SMALL></TH>\n";
    echo "    <TH><SMALL>Landings<BR>Day</SMALL></TH>\n";
    echo "    <TH><SMALL>Landings<BR>Night</SMALL></TH>\n";
    echo "    <TH><SMALL>Flight<BR>Training<BR>Received</SMALL></TH>\n";
    echo "    <TH><SMALL>Cross<BR>Country</SMALL></TH>\n";
    echo "    <TH><SMALL>Night</SMALL></TH>\n";
    echo "    <TH><SMALL>Solo</SMALL></TH>\n";
    echo "    <TH><SMALL>PIC</SMALL></TH>\n";
    echo "    <TH><SMALL>SIC</SMALL></TH>\n";
    echo "    <TH><SMALL>Instruction<BR>Given</SMALL></TH>\n";
    echo "  </TR>\n";
}
?>
