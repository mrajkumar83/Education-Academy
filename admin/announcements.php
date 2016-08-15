<?php
$step = '2';
$path = '.';
$title = 'Add Announcement';
$css = array('styles.css', 'jquery-ui-1.10.3.custom.css');
$js = array('announcement.js', 'datepicker/js/jquery-1.9.1.js', 'datepicker/js/jquery-ui-1.10.3.custom.js', 'announcement-date.js');
require_once('includes/common.php');

$db = new Query();
$id = (isset($id) && $id > 0) ? $id : '';
$op = (isset($op) && $op != '') ? $op : 'A';
$announcement_name = '';
$announcement_status = 'A';
$announcement_date = '';
$announcement_content = '';

if ($op == 'E' && $id > 0) {
    $data = $db->fetchRecord(' tb_announcements ', ' announcement_title, announcement_content, DATE_FORMAT(announcement_date, "%m/%e/%Y") announcement_date, announcement_status ', ' announcement_id="' . $id . '"');
    $announcement_title = $data->announcement_title;
	$announcement_content = $data->announcement_content;
	$announcement_date = $data->announcement_date;
    $announcement_status = $data->announcement_status;
    $title = 'Edit Announcement Category';
}
?>
<div id="main">
    <div class="top-bar"><h1><?php echo $title; ?></h1></div>
    <?php require_once('templates/announcements.tpl.php'); ?>
</div>
</body>
</html>