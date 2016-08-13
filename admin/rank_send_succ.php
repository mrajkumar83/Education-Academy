<?php
$step = '2';
$path = '.';
$title = 'Test';
$css = array('styles.css', 'miscpages.css', 'jquery.dataTables_themeroller.css', 'jquery-ui-1.8.4.custom.css', 'list.css');
$js = array('list.js', 'jquery.metadata.js', 'jquery.dataTables.min.js');

require_once('includes/common.php');
$cuttent_date = Date("Y-m-d");
$db = new Query();
$test = $db->fetchRecord('tb_student_results ', ' * ', ' std_result_id= "' . $id . '"  and std_test_date = "'.$cuttent_date.'" and std_attendance = "P"  ', NULL, NULL, NULL, NULL, 'All');
?>
<div id="main">
    <div id="sts"></div>
    <div class="top-bar"><h1></h1></div>
    <table cellpadding="2" cellspacing="0" align="center" border="0" width="100%">

        <tr><td height="300" align="center"><table border="1" width="40%">
                    <tr><td align="center">
                            &nbsp;&nbsp;<h3>Congratulations!</h3><br />
                            &nbsp;&nbsp;Rank Mail send to all student sucessfully.
                            <br />
                            <br />
                        </td></tr></table></td></tr>
    </table>
</div>
</body>
</html>

