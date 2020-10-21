<?php
/*
 * "logbook-menu.php"
 *
 * This script contains the php function that creates the "menu bar" shown across the top of almost
 * every "interaction" page in the logbook system.  This does not include the mobile interaction
 * pages, nor does it inslude the "display only" pages such as "logbook-dump".
 *
 * A significant amount of the menu's capabilities use javascript for functionality, as all the
 * "dynamic" functionality takes place within the user's browser, beyond the scope of PHP.  As such,
 * we go in and out of PHP within this script file when extensive blocks of javascript need to be
 * written to the user's browser.  The reason for not using a "pure" HTML/javascript file is the
 * need to dynamically create some of the vairables and links based upon session-specific data.
 */
    
function logbook_menu() {
/*
 * This is the single, primary PHP method contained in the script.
 *
 * After defining the function name we immediately exit PHP to output a block of javascript code.
 *
 * This code contains the variables which contain the "help" strings displayed when a user
 * does a "mouse-over" of the items in the menu bar.
 */
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
/*
 * We return to PHP to create the bulk of the menu bar.
 *
 * First we make sure to create and load the srver_root, u_name, and p_word variables to be
 * certain that this data is avilable to the functionality built into the menu bar.
 *
 * This MAY be redundant.  These variables may have already been loaded earlier in the different
 * pages, so this is merely to be certain of this information's availablility.  For future
 * update, this should be checked, and made to take place in a single location for ease of
 * future maintenance.
 *
 * Note: While each of the menu item's creation code is very similar, there are subtle differences
 * from item to item, precluding the use of a global style sheet.  While it does make each item's
 * code somewhat "messier", it is currently necessary.
 *
 * TO-DO: Make the variable creation/loading a single location shared by all.
 * TO-DO: Set up MySQL "sessions" with a session ID so as to stop having to pass the uname/pword
 *        data back and forth for every page.
 */
    $server_root = $GLOBALS['server_root'];

    if(isset($_POST['u_name']) && isset($_POST['p_word'])) {
        $u_name = $_POST['u_name'];
        $p_word = $_POST['p_word'];
    }

    /*
     * The menu itself is create using an HTML "table" to create the desired alignment.  Within
     * ech table "cell" we define an icon/button, a link location (the web-page/PHP-script to
     * execute, and a "balloon" pop-up help text to display on "mouse over".  This last takes
     * place using javascrip functions defind in the "logbook-tips.js" file.
     */
    
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

    return; // End of function logbook_menu()
}
?>
