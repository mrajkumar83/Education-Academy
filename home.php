<?php
$path = './admin/';
require_once($path . 'common/configure.php');
require_once($path . 'classes/Database.class.php');
require_once($path . 'classes/Query.class.php');
require_once($path . 'common/sess.php');

$db = new Query();

$img = $path . 'img/profile_noimg.jpg';
if ($UTYPE == 'SD' || $UTYPE == 'GS' || $UTYPE == 'ES') {
    $data = $db->fetchRecord(' tb_student_details ', ' CONCAT(std_fname, " ",std_lname) AS fullname, std_photo ', ' std_id="' . $UID . '" ');        
    if (isset($data->std_photo) && $data->std_photo != '' && file_exists($path .'photos/' . $data->std_photo))
        $img = $path . 'photos/' . $data->std_photo;
}
else {
    $data = $db->fetchRecord(' tb_staff_details ', ' CONCAT(staff_fname, " ",staff_lname) AS fullname, staff_photo ', ' staff_id="' . $UID . '" ');        
    if (isset($data->staff_photo) && $data->staff_photo != '' && file_exists($path .'photos/' . $data->staff_photo))
        $img = $path . 'photos/' . $data->staff_photo;

    $permissions = array("C" => "Counselor", "F" => "Finance", "O" => "Operational", "H" => "HR" , "B" => "Business Development");
}
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
 <title>ABC for JAVA & TESTING</title>
 <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
 <link rel="shortcut icon" href="admin/img/favicon.ico" type="image/x-icon">
 <link rel="stylesheet" type="text/css" href="./admin/css/styles.css">
 <script type="text/javascript" src="./admin/js/jquery.min.js"></script>
 <script type="text/javascript" src="./admin/js/common.js"></script>
 <script language="javascript" type="text/javascript">
     window.history.forward();
  </script> 
</head>
<body>
    <div class="content">
        <div class="header">
            <div class="logo"></div>
            <div class="header-right">
		Welcome&nbsp;<a href="home.php"><?php echo $data->fullname;?>&nbsp;<img src="<?php echo $img;?>" width="27" height="27" alt="sarktechnologies" title="<?php echo $data->fullname;?>"> </a>
            </div>
        </div>

        <div class="nav-contleft"></div>		
        <ul class="nav">
            <li class="leftMenuActive"><a target="frame1" href="admin/index.php"><span><span>Home</span></span></a></li>
            <?php
            if ($UTYPE == 'AD') {
                echo '<li><a target="frame1" href="admin/admin.php"><span><span>Admin</span></span></a></li>';
            }
            if ($UTYPE == 'SA') {
                echo '<li><a target="frame1" href="admin/super_admin.php"><span><span>Super Admin</span></span></a></li>';
            }
            if ($UTYPE == 'SF') {
                switch ($_SESSION['UROLE_PERMISSION']) {
                    case 'C': $page_name = 'counselor.php';break;
                    case 'H': $page_name = 'hr.php';break;
                    case 'O': $page_name = 'operations.php';break;
                    case 'F': $page_name = 'finance.php';break;
					case 'B': $page_name = 'bdevelopment.php';break;
                }
                echo '<li><a target="frame1" href="admin/' . $page_name . '"><span><span>' . $permissions[$_SESSION['UROLE_PERMISSION']] . '</span></span></a></li>';
            } elseif ($UTYPE == "SD") {// || $UTYPE == "ES"
                ?>
                <li><a target="frame1" href="admin/studentdet.php"><span><span>Student</span></span></a></li>
            <?php } ?>

            <li class="right"><a href="logout.php">Logout</a></li>
        </ul>
        <div class="nav-contright"></div>
        <iframe src="admin/index.php" name="frame1" id="frame1" class="main-frame" frameborder="0"></iframe>
        <div class="nav-contleft"></div><div class="footer"> Copyright &copy; <?php echo date('Y'); ?>  All Rights Reserved</div><div class="nav-contright"></div>
    </div>
</body>
</html>
