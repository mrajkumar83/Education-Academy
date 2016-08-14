<?php
$step = '2';
$path = '.';

$title = 'Books';
$css = array('styles.css', 'miscpages.css', 'jquery.dataTables_themeroller.css', 'jquery-ui-1.8.4.custom.css', 'list.css');
$js = array('list.js', 'jquery.metadata.js', 'jquery.dataTables.min.js');
require_once('includes/common.php');

$db = new Query();
// it has to be with the branch for time being do it
//$user = $db->fetchRecord(' tb_users ', ' user_branch ', ' user_id = "' . $_SESSION['UID'] . '"');
$cond = (isset($UTYPE) && $UTYPE == 'SA') ? NULL : ' book_category = category_id ';//$user->user_branch
$books = $db->fetchAllRecord(' tb_lib_books, tb_lib_categories ', ' book_id, book_name, category_name, book_status ', $cond, NULL, null, NULL, 0, 'All');
?>
<div id="main">
    <div id="sts"></div>
    <div class="top-bar"><h1>Manage Books</h1></div>
    <table cellpadding="0" cellspacing="0" border="0" class="display" id="grid-data" width="100%">
        <thead>
		<th>Books Name</th>
        <th>Category Name</th>
        <th>Status</th>
        <th>Action</th>
        </thead>
        <tbody>
            <?php
            $row = 0;
            while ($data = mysql_fetch_object($books)) {
                $class = ($row % 2) ? 'even' : 'odd';
                echo '<tr class="', $class, '">', "\n\t";
                echo '<td>', $data->book_name, '</td>', "\n";
				echo '<td>', $data->category_name, '</td>', "\n";
                echo '<td class="center">', ($data->book_status == 'A' ? '' : 'In-'), 'Active</td>';
                echo '<td class="center"><a href="book.php?op=E&amp;id=', $data->book_id, '" title="Edit Books" alt="Edit Books"><div class="img edit"></div></a>&nbsp;';
                echo '<a href="../admin/logic/lib_book_logic.php?op=D&amp;id=', $data->book_id, '" title="Delete books" alt="Delete books"><div class="img delete"></div></a>';
                
                echo '</td></tr>', "\n";
                $row++;
            }
            ?>
        </tbody>
    </table>
</div>
</body>
</html>

