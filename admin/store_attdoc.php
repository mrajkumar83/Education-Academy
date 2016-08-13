<?php

$db = new Query();

function store_data($myfile, $att_doc_id, $att_date, $att_batch_id, $att_branch) {
    if (isset($myfile) && $myfile != '') {
        $file_ext = get_file_extension($myfile);
        switch ($file_ext) {
            case 'xls' : require_once('../classes/excel_reader2.php');
                $data = new Spreadsheet_Excel_Reader("../attendance/" . $myfile);
                $data->storeAttendance($att_date, $att_doc_id, $att_batch_id, $att_branch, true, true);
                break;
            
            case 'xlsx':require_once('../classes/xlsxreader.php');
                $xlsx = new XLSXReader("../attendance/" . $myfile);
                $sheetNames = $xlsx->getSheetNames();
                foreach ($sheetNames as $sheetName) {
                    $sheet = $xlsx->getSheet($sheetName);
                    array2Table($sheet->getData(), $att_date, $att_doc_id, $att_batch_id, $att_branch);
                }
                //echo "<br>xlsx";
                break;
        }
    }
}

function array2Table($data, $att_date, $att_doc_id, $att_batch_id, $att_branch) {
    global $db;
    if (isset($data) && is_array($data) && count($data)) {
        $i = 0;
        foreach ($data as $row) {
            if ($i >= 1) {
                
                if(escape($row[0]) != '')
                {
                    $student_info = $db->fetchRecord(' tb_users ', ' user_id, user_fullname ', ' user_name="'.escape($row[0]).'"  AND user_branch="'.$att_branch.'" ');
                    if($db->getRowCount() > 0){
                        $cond = NULL;
                        $att_info = $db->fetchRecord(' tb_att_details ', ' attendance_id ', ' student_id="'.$student_info->user_id.'" AND date="'.$att_date.'" AND att_batch_id="'.$att_batch_id.'" AND att_branch_id="'.$att_branch.'" ');
                        if($db->getRowCount() > 0){ $cond = ' WHERE attendance_id="'.$att_info->attendance_id.'" ';}
                       $fields = ' att_doc_id="'.$att_doc_id.'",student_username="'.escape($row[0]).'",student_id="'.$student_info->user_id.'",student_name="'.$student_info->user_fullname.'",attendance="'.escape($row[1]).'",date="'.$att_date.'",att_batch_id="'.$att_batch_id.'",att_branch_id="'.$att_branch.'" ';
                        $db->storeDetails(' tb_att_details ', $fields, $cond); 
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

?>