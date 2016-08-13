<?php
$step = '2';
$path = '.';

$title = 'Resume';
$css = array('styles.css', 'miscpages.css', 'jquery.dataTables_themeroller.css', 'jquery-ui-1.8.4.custom.css', 'list.css');
$js = array('list.js', 'jquery.metadata.js', 'jquery.dataTables.min.js');
require_once('includes/common.php');

$db = new Query();
$resume = $db->fetchAllRecord(' tb_resume ', ' resume_id,resume_name,resume_doc,resume_status ', NULL, NULL, null, NULL, 0, 'All');
?>
<div id="main">
    <div id="sts"></div>
    <div class="top-bar"><h1>Manage Resume</h1></div>
    <table cellpadding="0" cellspacing="0" border="0" class="display" id="grid-data" width="100%">
        <thead>
        <th>Resume Name</th>
        <th>Status</th>
        <th>Action</th>
        </thead>
        <tbody>
            <?php
            $row = 0;
            while ($data = mysql_fetch_object($resume)) {

                if (isset($data->resume_name) && $data->resume_doc) {
                    $file = 'resumes/' . $data->resume_doc;
                    if (file_exists($file)) {
                        $class = ($row % 2) ? 'even' : 'odd';
                        echo '<tr class="', $class, '">', "\n\t";
                        echo '<td>', $data->resume_name, '</td>', "\n";
                        echo '<td class="center">', ($data->resume_status == 'A' ? '' : 'In-'), 'Active</td>';
                        echo '<td class="center"><a href="resume.php?op=E&amp;id=', $data->resume_id, '" title="Edit Resume" alt="Edit Resume"><div class="img edit"></div></a>&nbsp;';
                        echo '<a href="../admin/logic/resume_logic.php?op=D&amp;id=', $data->resume_id, '" title="Delete Resume" alt="Delete Resume"><div class="img delete"></div></a>';
                        echo '</td></tr>', "\n";
                        $row++;
                    }
                }
            }
            ?>
        </tbody>
    </table>
</div>
</body>
</html>

