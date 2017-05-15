<?php require_once("inc/init.php"); ?>
<?php
session_start();
if (!isset($_SESSION['bn_user_staff_name'])) {
    //header("location: #login.php");
    $_SESSION['bn_page'] ="supraAdd.php";
    echo "<script>window.location.assign('#login.php');</script>";
}
//$custId="-";
$hoCode="";
if(isset($_GET["supraId"])){
    $suId = $_GET["supraId"];
}else{
    $suId="";
}
$conn = mysqli_connect($hostDB,$userDB,$passDB,$databaseName);
mysqli_set_charset($conn, "UTF8");
$sql="Select * From t_supra Where supra_id = '".$suId."' ";
//echo "<script> alert('aaaaa'); </script>";
//$rComp = mysqli_query($conn,"Select * From b_company Where comp_id = '1' ");
if ($rComp=mysqli_query($conn,$sql)){
    $aHosp = mysqli_fetch_array($rComp);
    $hoId = $aHosp["hosp_id"];
    $hoCode = strval($aHosp["hosp_code"]);
    $hoNameT = strval($aHosp["hosp_name_t"]);
    $hoAddress = strval($aHosp["hosp_address_t"]);
    $hoTele = strval($aHosp["tele"]);
    $hoEmail = strval($aHosp["email"]);
    $hoTaxId = strval($aHosp["tax_id"]);
}

mysqli_close($conn);
?>