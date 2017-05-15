<?php

//configure constants
//$conn = mysqli_connect("localhost",'at_healthcare','bangna','cy!C51x3');
$databaseName="at_healthcare";
$hostDB="localhost";
$userDB="root";
$passDB="";
session_start();
//ob_start();
//$_SESSION['at_healthcare.user']="";

//$userDB="athealtcare";
//$passDB="Srb!g302";
//$hostDB="mysql-5.5.chaiyohosting.com";
$acompType = array();
$conn = mysqli_connect($hostDB,$userDB,$passDB,$databaseName);
mysqli_set_charset($conn, "UTF8");
$sql="Select * From f_company_type Where active = '1' Order By comp_type_code";
//$result = mysqli_query($conn,"Select * From f_company_type Where active = '1' Order By comp_type_code");
if ($result=mysqli_query($conn,$sql)){
    $oComp = "<option value='0' selected='' disabled=''>ประเภทบริษัท</option>";
    while($row = mysqli_fetch_array($result)){
        $oComp .= '<option value='.$row["comp_type_code"].'>'.$row["comp_type_name_t"].'</option>';
    }
}
$sql="Select * From provinces Order By prov_code";
//$result = mysqli_query($conn,"Select * From f_company_type Where active = '1' Order By comp_type_code");
if ($result=mysqli_query($conn,$sql)){
    $oProv = "<option value='0' selected='' disabled=''>เลือกจังหวัด</option>";
    while($row = mysqli_fetch_array($result)){
        $oProv .= '<option value='.$row["prov_id"].'>'.$row["prov_name"].'</option>';
    }
}
//$sql="Select * From amphurs Order By prov_id, amphur_code";
////$result = mysqli_query($conn,"Select * From f_company_type Where active = '1' Order By comp_type_code");
//if ($result=mysqli_query($conn,$sql)){
//    $oAmphur = "<option value='0' selected='' disabled=''>เลือกอำเภอ</option>";
//    while($row = mysqli_fetch_array($result)){
//        $oAmphur .= '<option value='.$row["amphur_code"].'>'.$row["amphur_name"].'</option>';
//    }
//}
mysqli_close($conn);

$directory = realpath(dirname(__FILE__));
$document_root = realpath($_SERVER['DOCUMENT_ROOT']);
$base_url = ( isset($_SERVER['HTTPS']) && $_SERVER['HTTPS']=='on' ? 'https' : 'http' ) . '://' .
    $_SERVER['HTTP_HOST'];
if(strpos($directory, $document_root)===0) {
    $base_url .= str_replace(DIRECTORY_SEPARATOR, '/', substr($directory, strlen($document_root)));
}
$base_url = str_replace("inc","",$base_url);
$userLogin = "";
defined("APP_URL") ? null : define("APP_URL", str_replace("/lib", "", $base_url));
//Assets URL, location of your css, img, js, etc. files
defined("ASSETS_URL") ? null : define("ASSETS_URL", APP_URL);


//require library files
//require_once("util.php");

require_once("func.global.php");

require_once("smartui/class.smartutil.php");
require_once("smartui/class.smartui.php");

// smart UI plugins
require_once("smartui/class.smartui-widget.php");
require_once("smartui/class.smartui-datatable.php");
require_once("smartui/class.smartui-button.php");
require_once("smartui/class.smartui-tab.php");
require_once("smartui/class.smartui-accordion.php");
require_once("smartui/class.smartui-carousel.php");
require_once("smartui/class.smartui-smartform.php");
require_once("smartui/class.smartui-nav.php");

SmartUI::$icon_source = 'fa';

// register our UI plugins
SmartUI::register('widget', 'Widget');
SmartUI::register('datatable', 'DataTable');
SmartUI::register('button', 'Button');
SmartUI::register('tab', 'Tab');
SmartUI::register('accordion', 'Accordion');
SmartUI::register('carousel', 'Carousel');
SmartUI::register('smartform', 'SmartForm');
SmartUI::register('nav', 'Nav');

require_once("class.html-indent.php");
require_once("class.parsedown.php");

?>