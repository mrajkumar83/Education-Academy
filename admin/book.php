<?php
$step = '2';
$path = '.';
$title = 'Add Books';
$css = array('styles.css', 'jquery-ui-1.10.3.custom.css');
$js = array('books.js', 'datepicker/js/jquery-1.9.1.js', 'datepicker/js/jquery-ui-1.10.3.custom.js');
require_once('includes/common.php');

$db = new Query();

$lib_categories = $db->fetchAllRecord('tb_lib_categories ', ' category_id,category_name ', ' category_status="A" AND category_createdby = "' . $_SESSION['UID'] . '" ', NULL, 'category_name', NULL, NULL, 'All');

$id = (isset($id) && $id > 0) ? $id : '';
$op = (isset($op) && $op != '') ? $op : 'A';
$book_name = '';
$book_category = '0';
$book_price = '0.0';
$book_stock = '1';
$book_status = 'A';

if ($op == 'E' && $id > 0) {
    $data = $db->fetchRecord(' tb_lib_books ', ' * ', ' book_id="' . $id . '"');
    $book_name = $data->book_name;
    $book_category = $data->book_category;
    $book_price = $data->book_price;
    $book_stock = $data->book_stock;
	$book_status = $data->book_status;
    $pageTitle = 'Edit Book';
}
?>
<div id="main">
    <div class="top-bar"><h1><?php echo $title; ?></h1></div>
    <?php require_once('templates/lib_book.php');?>
</div>
</body>
</html>

