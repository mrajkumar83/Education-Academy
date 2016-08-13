<?php
$db = new Query();

function store_data($myfile, $hr_id, $hr_intr_date, $att_batch_id, $att_branch) {
    if (isset($myfile) && $myfile != '') {
        $file_ext = get_file_extension($myfile);
        switch ($file_ext) {
            case 'xls' : require_once('../classes/excel_reader2.php');
                $data = new Spreadsheet_Excel_Reader("../hrremarks/" . $myfile);
                $data->storeRemarks($hr_intr_date, $hr_id, $att_batch_id, $att_branch, true, true);
                //echo "xls";

                break;
            case 'xlsx':require_once('../classes/xlsxreader.php');
                $xlsx = new XLSXReader("../hrremarks/" . $myfile);
                $sheetNames = $xlsx->getSheetNames();
                foreach ($sheetNames as $sheetName) {
                    $sheet = $xlsx->getSheet($sheetName);
                    array2Table($sheet->getData(), $hr_intr_date, $hr_id, $att_batch_id, $att_branch);
                }
                //echo "<br>xlsx";
                break;
        }
    }
}

function array2Table($data, $hr_intr_date, $hr_id, $att_batch_id, $att_branch) {
    global $db;
    if (isset($data) && is_array($data) && count($data)) {
        $i = 0;
        foreach ($data as $row) {
            if ($i >= 1) {
                if(escape($row[0]) != '')
                {
                    $student_info = $db->fetchRecord(' tb_users ', ' user_id, user_fullname ', ' user_name="'.escape($row[0]).'"  AND user_branch="'.$att_branch.'" ');
                    if($db->getRowCount() > 0){
                        $fields = ' hr_id="'.$hr_id.'",student_username="'.escape($row[0]).'",student_id="'.$student_info->user_id.'",student_name="'.$student_info->user_fullname.'",Remark="'.escape($row[1]).'",mock_rating="'.escape($row[2]).'",date="'.$hr_intr_date.'",batch_id="'.$att_batch_id.'",branch_id="'.$att_branch.'" ';
                        $db->storeDetails('tb_hr_remarks', $fields); 
                    }                                      
                }                
            }
            $i++;
        }
    }
}

function debug($data) {
    echo '<pre>';
    print_r($data);
    echo '</pre>';
}

function escape($string) {
    return htmlspecialchars($string, ENT_QUOTES);
}

function get_file_extension($file_name) {
    return substr(strrchr($file_name, '.'), 1);
}