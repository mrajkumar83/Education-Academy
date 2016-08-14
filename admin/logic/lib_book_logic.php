<?php
require_once('../common/sess.php');
require_once('../common/configure.php');
require_once('../classes/Database.class.php');
require_once('../classes/Query.class.php');

$db = new Query();
$id = (isset($id)) ? $id : 0;
$sts = '';
if(!isset($op) || $op != 'D')
    $fields = ' book_name="' . htmlspecialchars(trim($book_name)) . '", book_category="'.$book_category.'",book_price="'.$book_price.'", book_stock="'.$book_stock.'", book_status="'.$book_status.'" ';

switch ($op) {
    case 'A':
        $fields .=' , book_createdby = "' . $_SESSION['UID'] . '", book_createddate = "' . date(DATE_TIME_FORMAT) . '"';
        $store = $db->storeDetails('tb_lib_books', $fields);
        $id = $db->newRowId;

        break;
    case 'E':
        $fields .=' , 	book_modifiedby = "' . $_SESSION['UID'] . '", book_modifieddate = "' . date(DATE_TIME_FORMAT) . '"';
        $db->storeDetails('tb_lib_books', $fields, ' WHERE book_id = "' . $id . '"');
        break;

    case 'D':
        $db->delData('tb_lib_books', ' book_id="' . $id . '"');
        break;
}
header('Location: ../manage_library_books.php?sts=' . $sts);
exit;