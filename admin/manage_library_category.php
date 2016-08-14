<?php
$step = '2';
$path = '.';

$title = 'Category';
$css = array('styles.css', 'miscpages.css', 'jquery.dataTables_themeroller.css', 'jquery-ui-1.8.4.custom.css', 'list.css');
$js = array('list.js', 'jquery.metadata.js', 'jquery.dataTables.min.js');
require_once('includes/common.php');

$db = new Query();
// it has to be with the branch for time being do it
//$user = $db->fetchRecord(' tb_users ', ' user_branch ', ' user_id = "' . $_SESSION['UID'] . '"');
$cond = (isset($UTYPE) && $UTYPE == 'SA') ? NULL : ' category_createdby = "' . $_SESSION['UID'] . '" ';//$user->user_branch
$category = $db->fetchAllRecord(' tb_lib_categories ', ' category_id, category_name, category_status ', $cond, NULL, null, NULL, 0, 'All');

function chkCategory($id)
{
    global $db;
    $category_obj = $db->fetchRecord(' tb_lib_books ', ' count(1) AS cnt ', ' book_category="'.$id.'" ');
    if($category_obj->cnt > 0)
    {
            return false;
    }  
    return true;
}
?>
<div id="main">
    <div id="sts"></div>
    <div class="top-bar"><h1>Manage Category</h1></div>
    <table cellpadding="0" cellspacing="0" border="0" class="display" id="grid-data" width="100%">
        <thead>
        <th>Category Name</th>
        <th>Status</th>
        <th>Action</th>
        </thead>
        <tbody>
            <?php
            $row = 0;
            while ($data = mysql_fetch_object($category)) {
                $class = ($row % 2) ? 'even' : 'odd';
                echo '<tr class="', $class, '">', "\n\t";
                echo '<td>', $data->category_name, '</td>', "\n";
                echo '<td class="center">', ($data->category_status == 'A' ? '' : 'In-'), 'Active</td>';
                echo '<td class="center"><a href="library_category.php?op=E&amp;id=', $data->category_id, '" title="Edit Category" alt="Edit Category"><div class="img edit"></div></a>&nbsp;';
                if(chkCategory($data->category_id)){//
                    echo '<a href="../admin/logic/lib_category_logic.php?op=D&amp;id=', $data->category_id, '" title="Delete category" alt="Delete category"><div class="img delete"></div></a>';
                }else{
                    echo '&nbsp;&nbsp;&nbsp;';
                }
                echo '</td></tr>', "\n";
                $row++;
            }
            ?>
        </tbody>
    </table>
</div>
</body>
</html>

