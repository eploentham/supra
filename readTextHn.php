<meta charset="utf-8">
<?php
session_start();
require_once("inc/init.php");



$conn = mysqli_connect($hostDB,$userDB,$passDB,$databaseName);
//if(!$conn){
//    echo mysqli_error($conn);
//    echo "<script>alert(".mysqli_error($conn).");</script>";
//    return;
//}
$inputFileName="";
mysqli_set_charset($conn, "UTF8");
if (isset($_SESSION['bn_hn_text'])) {
    if (file_exists($_SESSION['bn_hn_text'])) {
        $inputFileName = $_SESSION['bn_hn_text'];
    }else{
        header('Content-Type: application/json');
        $response = array();
        $resultArray = array();
        $response["success"] = 0;
        $response["message"] = "Error non found File name";
        $response["row_cnt"] = $rowCnt;
        $response["patient_cnt"] = $cnt;
        array_push($resultArray,$response);
        echo json_encode($resultArray);
        return;
    }
}else{
    header('Content-Type: application/json');
    $response = array();
    $resultArray = array();
    $response["success"] = 0;
    $response["message"] = "Error File upload";
    $response["row_cnt"] = 0;
    $response["patient_cnt"] = 0;
    array_push($resultArray,$response);
    echo json_encode($resultArray);
    return;
}
$row1=0;
$myfile = fopen($inputFileName, "r") or die("Unable to open file!");
$id="";
$id1="";
$read="";
$name="";
$sql="Delete from hn_t_data";
if ($result=mysqli_query($conn,$sql) or die(mysqli_error($conn))){

}
while(!feof($myfile)) {
    $read = fgets($myfile);
    $row1++;
    $id = substr($read,0, 13);
    $id1 = substr($read,13, 13);
    $pname = substr($read,26, 15);
    //$pname = iconv("UTF-8", "ISO-8859-1", $read);
    //$pname = mb_detect_encoding($pname, "ASCII, UTF-8, UNICODE");
    //$pname = mb_convert_encoding($pname, 'UTF-8','ASCII');
    //$pname = mb_detect_encoding($pname);
    $name = substr($read,51, 30);
    $lname = substr($read,71, 30);
    $codeHosp = substr($read,103, 7);
    
    //$name = iconv('MS-ANSI', 'UTF-8', $name);
    //$name = utf8_encode($name);
    $sql = "Insert Into hn_t_data(data_id, branch_id, month_id, year_id, period_id"
            .", row1, id, full_name"
            .", id1, hosp_code, date_create) "
            ."Values(UUID(), '".$_GET["branch_id"]."','".$_GET["month_id"]."','".$_GET["year_id"]."','".$_GET["period_id"]."' "
            .", '".$row1."', '".$id."', '".trim($pname)."', '".$id1."', '".$codeHosp."', now())";
    if ($result=mysqli_query($conn,$sql) or die(mysqli_error($conn))){

    }
}
fclose($myfile);

//$result->free();
mysqli_close($conn);

header('Content-Type: application/json');
$response = array();
$resultArray = array();
$response["success"] = 1;
$response["message"] = "success";
$response["row_cnt"] = $row1;
//$response["patient_cnt"] = $cnt;
array_push($resultArray,$response);
echo json_encode($resultArray);
//$sheetData = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);

?>
