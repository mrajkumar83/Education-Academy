<?php
$step = '2';
$path = '.';
$title = 'Edit Profile';
$css = array('styles.css', 'jquery.datepick.css');
$js = array('staff.js');
require_once('includes/common.php');
$id = $UID;
$role = $db->fetchAllRecord(' tb_roles ', ' role_id,role_name,role_status ', ' role_status = "A" ', NULL, null, NULL, 0, 'All');
$branch = $db->fetchAllRecord(' tb_branches ', ' branch_id,branch_name ', NULL, NULL, null, NULL, 0, 'All');

$pagefrom = 'profile';
$img = $path . '/img/profile_noimg.jpg';
//$utype = isset($utype) ? $utype : 'SD';
$utype1 = $UTYPE;
$staff_fname = '';
$staff_lname = '';
$staff_phno = '';
$staff_mobile = '';
$staff_email = '';
$staff_semail = '';
$staff_address = '';
$user_role = '';
$user_branch = '';

$data = $db->fetchRecord(' tb_users AS u LEFT JOIN tb_staff_details AS i on u.user_id = i.staff_id ', ' * ', 'u.user_id="' . $id . '"');

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

if (isset($utype1) && $utype1 == "AD") {
    $data1 = $db->fetchRecord(' tb_branches ', ' * ', 'branch_id="' . $data->user_branch . '"');
    $user_branch_name = $data1->branch_name;
}
$img = (($data->staff_photo != '') && file_exists('./photos/' . $data->staff_photo)) ? './photos/' . $data->staff_photo : $img;
$user_status = $data->user_status;

$errDiv = '';
if (isset($Err)) {
    switch ($Err) {
        case 'D':
            $errDiv = '<div class="complsory">Duplicate entery of UserName OR Email.</div>';
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
    require_once('./templates/adminprofile.php');
?>
</div>
</body>
</html>