<?php
    $page_title = "Michael's LogBook Data Dump";
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
    
    echo "<FONT color=\"#000099\">\n<H1>Logbook Dump Page</h1>\n</font>\n\n";
    echo "<HR>\n\n<H2>The <U>Current</u> Logbook Data</h2>\n\n";

    echo "<TABLE BORDER=\"2\" WIDTH=\"98%\" CELLPADDING=\"1\" BGCOLOR=\"#FFC0C0\">\n";
    echo " <TR>\n  <TD WIDTH=\"100%\">\n";

    $query = "SELECT * FROM details ORDER BY Date";
    $result = $dbConn->query($query);
    if($result->num_rows > 0) {
        echo "<PRE>\n";
        while($row = $result->fetch_row()) {
            echo "$row[0],$row[1],$row[2],$row[3],$row[4],$row[5],$row[6],$row[7],$row[8],$row[9]";
            echo ",$row[10],$row[11],$row[12],$row[13],$row[14],$row[15],$row[16],$row[17],$row[18],$row[19]";
            echo ",$row[20],$row[21],$row[22],$row[23],$row[24],$row[25]\n";
        }
        echo "</PRE>\n";
    }
    else {
        echo "<BR><BR> Query Failed!!! <BR><BR>" , mysql_error();
    }
    $result->close();
    
    echo "  </td>\n </TR>\n</TABLE>\n\n<BR><BR>\n\n<HR>\n\n<BR><BR>\n\n";

    logbook_menu();
    
    echo "<BR><BR>\n\n";
    
    logbook_footer();
    exit();
?>
