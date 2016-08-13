<?php
$step = '2';
$path = '.';
$title = 'Registration';
$css = array('styles.css');
$js = array('staff.js');

require_once('includes/common.php');
require_once("common/generate_password.php");

$role = $db->fetchAllRecord(' tb_roles ', ' role_id,role_name,role_status ', ' role_status = "A" ', NULL, null, NULL, 0, 'All');
$branch = $db->fetchAllRecord(' tb_branches ', ' branch_id,branch_name ', NULL, NULL, null, NULL, 0, 'All');

///// Variables //////
$utype1 = $UTYPE;
$pagefrom = '';
$id = (isset($id) && $id > 0) ? $id : '';
$op = (isset($op) && $op != '') ? $op : 'ADD';
$staff_fname = '';
$staff_lname = '';
$staff_phno = '';
$staff_mobile = '';
$staff_email = '';
$staff_semail = '';
$staff_address = '';
$role_permission = 'C';
$user_name = '';
$user_password = '';
$user_role = '';
$user_branch = '';
$user_status = '';
$user_name = generate_username(6);
$user_password = generate_password(6);

$img = $path . '/img/profile_noimg.jpg';
$utype = isset($utype) ? $utype : 'SD';

if ($op == 'E' && $id > 0) {
    $data = $db->fetchRecord(' tb_users AS u LEFT JOIN tb_staff_details AS i on i.staff_id = u.user_id ', ' * ', 'u.user_id="' . $id . '"');

    $op = 'Edit';
    $staff_fname = $data->staff_fname;
    $staff_lname = $data->staff_lname;
    $staff_phno = ($data->staff_phno > 0) ? $data->staff_phno : '';
    $staff_mobile = ($data->staff_mobile > 0) ? $data->staff_mobile : '';
    $staff_email = $data->staff_email;
    $staff_semail = $data->staff_semail;
    $staff_address = $data->staff_address;
    $user_role = $data->user_role;
    $user_branch = $data->user_branch;
    $role_permission = $data->role_permission;
    $data->staff_photo;
    $img = (($data->staff_photo != '') && file_exists('photos/' . $data->staff_photo)) ? 'photos/' . $data->staff_photo : $img;
    $user_status = $data->user_status;
}
$title = ($op == 'Edit') ? 'Edit ' : 'Add ';

switch ($UTYPE) {
    case 'SA':
        $title .= 'Staff';
        break;
    case 'AD':
        $title .= 'Staff';
        $utype = 'SF';
        break;
    case 'SF':
        $title .= 'Student';
        break;
}
$errDiv = '';
if (isset($Err)) {
    switch ($Err) {
        case 'D':
            $errDiv = '<div class="complsory">Duplicate entry of UserName OR Email.</div>';
            break;

        case 'S':
            $errDiv = '<div class="complsory">Image size is more.</div>';
            break;
    }
}
?> 
<div id="main">
    <div class="top-bar"><h1><?php echo $title; ?></h1></div>
<?php
echo $errDiv;
require_once('./templates/staff.php');
?>
</div>
</body>
</html>