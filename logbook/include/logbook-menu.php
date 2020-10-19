<?php
function logbook_menu() {
?>
<SCRIPT LANGUAGE="javascript">
// Add the button bar help strings
var bal_logbook_data = "Accesses a page with the basic logbook data totals.";
var bal_logbook_entry = "Go to the Logbook Data Entry page.";
var bal_logbook_dump = "Dump the logbook data in .csv format for transfer.";
var bal_logbook_showall = "Display all the logbook entries.";
var bal_logbook_last30 = "Display the last 30 days of logbook entries.";
var bal_logbook_home = "Go back to the Logbbok Home Page.";
</script>
<?php
    $server_root = $GLOBALS['server_root'];

    if(isset($_POST['u_name']) && isset($_POST['p_word'])) {
        $u_name = $_POST['u_name'];
        $p_word = $_POST['p_word'];
    }

    echo "  <FORM METHOD=\"post\" action=\"$server_root/pages/logbook-input.php\">\n";
    echo "  <INPUT TYPE=\"hidden\" name=\"u_name\" id=\"u_name\" value=\"$u_name\" />\n";
    echo "  <INPUT TYPE=\"hidden\" name=\"p_word\" id=\"p_word\" value=\"$p_word\" />\n\n";

    echo "\n<FONT COLOR=\"orange\">\n\n";
    echo "<TABLE BORDER=\"1\" HEIGHT=\"80\" WIDTH=\"90%\" CELLPADDING=\"2\">\n<TR>\n\n";
    echo " <TD ALIGN=\"center\">\n  <BR>\n";
    echo "  <A onMouseOver=\"makeItVisible(bal_logbook_data)\" onMouseOut=\"theTip.hide()\">\n";
    echo "  <INPUT TYPE=\"submit\" name=\"show_data\" value=\"Show Logbook Data\" formaction=\"$server_root/pages/logbook-data.php\"><BR>\n";
    echo "  <IMG BORDER=\"0\" ALIGN=\"center\" HEIGHT=\"35\" SRC=\"$server_root/images/clock.gif\">\n  <BR><BR>\n  </a>\n </td>\n\n";

    echo " <TD ALIGN=\"center\">\n  <BR>\n";
    echo "  <A onMouseOver=\"makeItVisible(bal_logbook_entry)\" onMouseOut=\"theTip.hide()\">\n";
    echo "  <INPUT TYPE=\"submit\" name=\"input_data\" value=\"Input Logbook Data\" formaction=\"$server_root/pages/logbook-input.php\"><BR>\n";
    echo "  <IMG BORDER=\"0\" ALIGN=\"center\" HEIGHT=\"35\" SRC=\"$server_root/images/clock.gif\">\n  <BR><BR>\n  </a>\n </td>\n\n";
    
    echo " <TD ALIGN=\"center\">\n  <BR>\n";
    echo "  <A onMouseOver=\"makeItVisible(bal_logbook_last30)\" onMouseOut=\"theTip.hide()\">\n";
    echo "  <INPUT TYPE=\"submit\" name=\"last_30\" value=\"Show Last 30 Days\" formaction=\"$server_root/pages/logbook-last30.php\"><BR>\n";
    echo "  <IMG BORDER=\"0\" ALIGN=\"center\" HEIGHT=\"35\" SRC=\"$server_root/images/clock.gif\">\n  <BR><BR>\n  </a>\n </td>\n\n";
    
    echo " <TD ALIGN=\"center\">\n  <BR>\n";
    echo "  <A onMouseOver=\"makeItVisible(bal_logbook_last30)\" onMouseOut=\"theTip.hide()\">\n";
    echo "  <INPUT TYPE=\"submit\" name=\"last_60\" value=\"Show Last 60 Days\" formaction=\"$server_root/pages/logbook-last60.php\"><BR>\n";
    echo "  <IMG BORDER=\"0\" ALIGN=\"center\" HEIGHT=\"35\" SRC=\"$server_root/images/clock.gif\">\n  <BR><BR>\n  </a>\n </td>\n\n";
    
    echo " <TD ALIGN=\"center\">\n";
    echo "  <A HREF=\"$server_root/pages/logbook-showall.php\" TARGET=\"_parent\" onMouseOver=\"makeItVisible(bal_logbook_showall)\" onMouseOut=\"theTip.hide()\">\n";
    echo "  <U>Show Logbook Data</u><BR>\n  <IMG BORDER=\"0\" ALIGN=\"center\" HEIGHT=\"35\" SRC=\"$server_root/images/book1.gif\">\n  </a>\n </td>\n\n";

    echo " <TD ALIGN=\"center\">\n  <BR>\n";
    echo "  <A onMouseOver=\"makeItVisible(bal_logbook_dump)\" onMouseOut=\"theTip.hide()\">\n";
    echo "  <INPUT TYPE=\"submit\" name=\"full_dump\" value=\"Dump Logbook Data\" formaction=\"$server_root/pages/logbook-dump.php\"><BR>\n";
    echo "  <IMG BORDER=\"0\" ALIGN=\"center\" HEIGHT=\"35\" SRC=\"$server_root/images/book.gif\">\n  <BR><BR>\n  </a>\n </td>\n\n";

    echo " <TD ALIGN=\"center\">\n  <BR>\n";
    echo "  <A onMouseOver=\"makeItVisible(bal_logbook_home)\" onMouseOut=\"theTip.hide()\">\n";
    echo "  <INPUT TYPE=\"submit\" name=\"logbook_home\" value=\"Logbook Home\" formaction=\"$server_root/pages/logbook-home.php\"><BR>\n";
    echo "  <IMG BORDER=\"0\" ALIGN=\"center\" HEIGHT=\"35\" SRC=\"$server_root/images/arc002.gif\">\n  <BR><BR>\n  </a>\n </td>\n\n";

    echo "</tr>\n</table>\n</font>\n</form>\n<BR>\n";

    echo "<A HREF=\"$server_root/index.html\">\n";
    echo "<IMG BORDER=\"0\" ALT=\"LOGBOOK LOGO - Go to the Logbook Homepage\" ALIGN=\"center\" SRC=\"$server_root/images/compaq_ix.gif\"><BR>\n";
    echo "</A>\n\n";
}
?>
