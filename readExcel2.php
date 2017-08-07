<?php
session_start();
require_once("inc/init.php");
require_once 'Classes/PHPExcel.php';

/** PHPExcel_IOFactory - Reader */
include 'Classes/PHPExcel/IOFactory.php';
$conn = mysqli_connect($hostDB,$userDB,$passDB,$databaseName);
//if(!$conn){
//    echo mysqli_error($conn);
//    echo "<script>alert(".mysqli_error($conn).");</script>";
//    return;
//}
mysqli_set_charset($conn, "UTF8");
if (isset($_SESSION['bn_supra_excel'])) {
    if (file_exists($_SESSION['bn_supra_excel'])) {
        $inputFileName = $_SESSION['bn_supra_excel'];
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
//$inputFileName = "uploads/11111.xlsx";  
$inputFileType = PHPExcel_IOFactory::identify($inputFileName);  
$objReader = PHPExcel_IOFactory::createReader($inputFileType);  
$objReader->setReadDataOnly(true);  
$objPHPExcel = $objReader->load($inputFileName);  

//$objWorksheet = $objPHPExcel->setActiveSheetIndex(0);
$objWorksheet = $objPHPExcel->getActiveSheet();
$highestRow = $objWorksheet->getHighestRow();
$highestColumn = $objWorksheet->getHighestColumn();

$headingsArray = $objWorksheet->rangeToArray('A1:'.$highestColumn.'1',null, true, true, true);
$headingsArray = $headingsArray[1];

$r = -1;
$col=0;
$namedDataArray = array();
for ($row = 2; $row <= $highestRow; ++$row) {
    $dataRow = $objWorksheet->rangeToArray('A'.$row.':'.$highestColumn.$row,null, true, true, true);
//    if ((isset($dataRow[$row]['A'])) && ($dataRow[$row]['A'] > '')) {
        ++$r;
        $col=0;
        foreach($headingsArray as $columnKey => $columnHeading) {
            $col++;
//            $namedDataArray[$r][$columnHeading] = $dataRow[$row][$columnKey];
            $namedDataArray[$r][$col] = $dataRow[$row][$columnKey];
        }
//    }
}

$sql="";
$row1=0;
$doc="";
$docold="";
$labDate="";
$labDateOld="";
$hn="";
$hnOld="";
$type="";
$typeOld="";
$name="";
$nameOld="";
$cnt=0;
$rowCnt=0;
foreach ($namedDataArray as $result) {
    $row1++;
    $rowCnt++;

    $sql = "Insert Into hn_t_data(data_id, branch_id, month_id, year_id, period_id"
            .", row1, id, id1, full_name"
            .", fname, lname, hosp_code, date_start, date_end"
            .", date_birthday, date_create) "
            ."Values(UUID(), '".$_GET["branch_id"]."','".$_GET["month_id"]."','".$_GET["year_id"]."','".$_GET["period_id"]."' "
            .", '".$row1."', '".$result[0]."', '".$result[1]."', '".$result[5]."', '"
            .$result[2]." ".$result[3]."' ".", '".$result[4]."', '".$result[6]."', '".$result[8]."', '".$result[9]."', '".$result[10].", now())";
    if ($result=mysqli_query($conn,$sql) or die(mysqli_error($conn))){
//        if($rowCnt==100){
//            echo "100";
//        }
//        if($rowCnt==200){
//            echo "200";
//        }
//        if($rowCnt==300){
//            echo "300";
//        }
//        if($rowCnt==400){
//            echo "400";
//        }
    }
}

//$result->free();
mysqli_close($conn);

header('Content-Type: application/json');
$response = array();
$resultArray = array();
$response["success"] = 1;
$response["message"] = "success";
$response["row_cnt"] = $rowCnt;
$response["patient_cnt"] = $cnt;
array_push($resultArray,$response);
echo json_encode($resultArray);
//$sheetData = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);

?>
