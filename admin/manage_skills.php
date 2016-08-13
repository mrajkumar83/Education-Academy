<?php
$step = '2';
$path = '.';

$title = 'Call Status';
$css = array('styles.css', 'miscpages.css', 'jquery.dataTables_themeroller.css', 'jquery-ui-1.8.4.custom.css', 'list.css');
$js = array('list.js', 'jquery.metadata.js', 'jquery.dataTables.min.js');
require_once('includes/common.php');

$db = new Query();
$skills = $db->fetchAllRecord(' tb_skills ', ' skill_id,skill_name,skill_status ', NULL, NULL, null, NULL, 0, 'All');

?>
<div id="main">
    <div id="sts"></div>
    <div class="top-bar"><h1>Manage Skills</h1></div>
    <table cellpadding="0" cellspacing="0" border="0" class="display" id="grid-data" width="100%">
        <thead>
        <th>Skill Name</th>
        <th>Status</th>
        <th>Action</th>
        </thead>
        <tbody>
            <?php
            $row = 0;
            while ($data = mysql_fetch_object($skills)) {
                $class = ($row % 2) ? 'even' : 'odd';
                echo '<tr class="', $class, '">', "\n\t";
                echo '<td>', $data->skill_name, '</td>', "\n";
                echo '<td>', ($data->skill_status == 'A' ? '' : 'In-'), 'Active</td>', "\n";
                echo '<td class="center"><a href="skill.php?op=E&amp;id=', $data->skill_id, '" title="Edit Skill" alt="Edit Skill"><div class="img edit"></div></a>&nbsp;';
                echo '<a href="./logic/skill_logic.php?op=D&amp;id=', $data->skill_id, '" title="Delete Skill" alt="Delete Skill"><div class="img delete"></div></a>';
                echo '</td></tr>', "\n";
                $row++;
            }
            ?>
        </tbody>
    </table>
</div>
</body>
</html>

