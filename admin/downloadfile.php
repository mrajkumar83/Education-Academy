<?PHP
 	require_once('common/configure.php');	
	error_reporting(E_ALL & ~E_NOTICE);
    $filename = $_GET['filename']; // filename only
	#echo $filename;
    $downloadurl = $_GET['path']."/".$_GET['filename'];
	 #echo $downloadurl;
	 #exit;
    if (file_exists($downloadurl))
	{
        $size = filesize($downloadurl);
        header("Pragma: public");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header("Cache-Control: private",false);
        header("Content-Type: application/octet-stream");
        header("Content-Disposition: attachment; filename=\"".$filename."\";");
        header("Content-Transfer-Encoding: binary");
        header("Content-Length: ".$size);
        readfile($downloadurl);
    }
	else
	{
       echo "<br /><br /><br /><div align=\"center\"><b style=\"text-decoration: blink; color: red;\">Sorry! an error occured while downloading file.</b> <br /><b>Either the file is not uploaded or does not exists. Please try after sometime.<br />
       <span onclick=\"Javascript: history.back();\" style=\"text-decoration: underline; cursor: pointer; color: blue;\" >Go back</span></b></div>";

    } 


?>