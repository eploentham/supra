<?php
require_once("inc/init.php");
session_start();
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
//$objConnect = mysql_connect("http://tossakan.com",'tossakan_payroll','payroll');
//$databaseName="at_healthcare";
//$userDB="root";
//$passDB="";
//$hostDB="localhost";
$conn = mysqli_connect($hostDB,$userDB,$passDB,$databaseName);
mysqli_set_charset($conn, "UTF8");

$resultArray = array();
if($_GET['flagPage']=="amphur"){
    $sql="Select * From amphures Where prov_id = '".$_GET['prov_id']."'  Order By amphur_code";
    if ($result=mysqli_query($conn,$sql)){
        $ok="";
        $err="";
        if(!$result){
            $ok="0";
            $err= mysql_error();
            $tmp = array();
            $tmp["error"] = $err;
            $tmp["sql"] = $sql;
            array_push($resultArray,$tmp);
        }else{
            $ok="1";
            $tmp = array();
            $tmp["sql"] = $sql;
            array_push($resultArray,$tmp);
            while($row = mysqli_fetch_array($result)){        
                $tmp["amphur_id"] = $row["amphur_id"];
                $tmp["amphur_name"] = $row["amphur_name"];
                array_push($resultArray,$tmp);
            }
        }
        $result->free();
    }
}else if($_GET['flagPage']=="district"){
    $sql="Select d.*, z.zipcode From districts d Left Join zipcodes z On d.district_code = z.district_code Where d.amphur_id = '".$_GET['amphur_id']."' Order By d.district_code";
    if ($result=mysqli_query($conn,$sql)){
        $ok="";
        $err="";
        if(!$result){
            $ok="0";
            $err= mysqli_error();
            $tmp = array();
            $tmp["error"] = $err;
            $tmp["sql"] = $sql;
            array_push($resultArray,$tmp);
        }else{
            $ok="1";
            $tmp = array();
            $tmp["sql"] = $sql;
            array_push($resultArray,$tmp);
            while($row = mysqli_fetch_array($result)){        
                $tmp["district_id"] = $row["district_id"];
                $tmp["district_name"] = $row["district_name"];
                $tmp["zipcode"] = $row["zipcode"];
                array_push($resultArray,$tmp);
            }
        }
        $result->free();
    }
}else if($_GET['flagPage']=="zipcode"){
    $sql="Select z.zipcode From zipcodes z Left Join districts d On z.district_code = d.district_code Where district_id = '".$_GET['district_id']."' ";
    if ($result=mysqli_query($conn,$sql)){
        $ok="";
        $err="";
        if(!$result){
            $ok="0";
            $err= mysqli_error();
            $tmp = array();
            $tmp["error"] = $err;
            $tmp["sql"] = $sql;
            array_push($resultArray,$tmp);
        }else{
            $ok="1";
            $tmp = array();
            $tmp["sql"] = $sql;
            array_push($resultArray,$tmp);
            while($row = mysqli_fetch_array($result)){
                $tmp["zipcode"] = $row["zipcode"];
                array_push($resultArray,$tmp);
            }
        }
        $result->free();
    }
}else if($_GET['flagPage']=="searchDoctor"){
    $sql="Select * From provinces ";
    if ($result=mysqli_query($conn,$sql)){
        $ok="";
        $err="";
        if(!$result){
            $ok="0";
            $err= mysql_error();
            $tmp = array();
            $tmp["error"] = $err;
            $tmp["sql"] = $sql;
            array_push($resultArray,$tmp);
        }else{
            $ok="1";
            $tmp = array();
            //$tmp["sql"] = $sql;
            //array_push($resultArray,$tmp);
            while($row = mysqli_fetch_array($result)){        
                //$tmp["label"] = $row["prov_id"];
                //$tmp["value"] = $row["prov_name"];
                $tmp["name"] = $row["name"];
//                $tmp["adminName1"] = $row["adminName1"];
//                $tmp["countryName"] = $row["countryName"];
                array_push($resultArray,$tmp);
            }
        }
        $result->free();
    }
}else if($_GET['flagPage']=="login"){
    //$sql="Select * From b_staff Where staff_username = '".$_GET['user_name']."' and active = '1' and staff_password = '".$_GET['password']."' ";
    $sql="Select * From b_staff  ";
    //$result = mysqli_query($con, $SQL)or die(mysqli_error($connection));
    //$result = mysqli_query($con,$Query) or die(mysqli_error());  
    if ($result=mysqli_query($conn,$sql) or die(mysqli_error($conn))){
        if(!$result){
            $ok="0";
            $err= mysqli_error();
            $tmp = array();
            $tmp["error"] = $err;
            $tmp["sql"] = $sql;
            $tmp["success"] = $ok;
            array_push($resultArray,$tmp);
        }else{
            $ok="1";
            $tmp = array();
            $tmp["sql"] = $sql;
            $tmp["success"] = $ok;
            $num_rows = mysqli_num_rows($result);
            $tmp["rows"] = $num_rows;
            //$tmp["database"] = $databaseName;
            //$tmp["host"] = $hostDB;
            array_push($resultArray,$tmp);
            while($row = mysqli_fetch_array($result)){
                $tmp["staff_name_t"] = $row["staff_name_t"];
                $tmp["staff_lastname_t"] = $row["staff_lastname_t"];
                $_SESSION['bn_user_staff_name'] = $tmp["staff_name_t"]."".$tmp["staff_lastname_t"];
                //$_SESSION['at_user'] = "";
                //$tmp["price"] = $row["price"];
                //$tmp["unit_id"] = $row["unit_id"];
                array_push($resultArray,$tmp);
            }
        }
        $result->free();
    }else{
        //echo($query.' '.mysqli_error()
    }
}else if($_GET['flagPage']=="drawSearch"){
    $draDate1=substr($_GET["draw_date1"],strlen($_GET["draw_date1"])-4)."-".substr($_GET["draw_date1"],3,2)."-".substr($_GET["draw_date1"],0,2);
    $draDate2=substr($_GET["draw_date2"],strlen($_GET["draw_date2"])-4)."-".substr($_GET["draw_date2"],3,2)."-".substr($_GET["draw_date2"],0,2);
    $sql="Select draw_id,draw_doc, ifnull(description,'-') as description From t_goods_draw Where draw_date >= '".$draDate1."' and draw_date <= '".$draDate2."'  Order By draw_doc";
    if ($result=mysqli_query($conn,$sql) or die(mysqli_error($conn))){
        $ok="";
        $err="";
        if(!$result){
            $ok="0";
            $err= mysql_error();
            $tmp = array();
            $tmp["error"] = $err;
            $tmp["sql"] = $sql;
            array_push($resultArray,$tmp);
        }else{
            $ok="1";
            $tmp = array();
            //$tmp["sql"] = $sql;
            //array_push($resultArray,$tmp);
            while($row = mysqli_fetch_array($result)){   
                $tmp["draw_id"] = $row["draw_id"];
                $tmp["draw_doc"] = $row["draw_doc"];
                $tmp["description"] = $row["description"];
                array_push($resultArray,$tmp);
            }
        }
        $result->free();
    }else{
        
    }
}else if($_GET['flagPage']=="gen_rec"){
    $sql = "Select count(1) as cnt From t_goods_rec ";
    if ($result=mysqli_query($conn,$sql) or die(mysqli_error($conn))){
        $ok="";
        $err="";
        if(!$result){
            $ok="0";
            $err= mysql_error();
            $tmp = array();
            $tmp["error"] = $err;
            $tmp["sql"] = $sql;
            array_push($resultArray,$tmp);
        }else{
            $year = date("Y");
            $year = substr($year, 2);
            $ok="1";
            $tmp = array();
            $tmp["sql"] = $sql;
            $cnt="";
            array_push($resultArray,$tmp);
            while($row = mysqli_fetch_array($result)){
                if(is_null($row["cnt"])){
                    $cnt = "0";
                }else{
                    $cnt = $row["cnt"];
                }
                $cnt = intval($cnt)+1;
                $cnt = "00000".$cnt;
            }
            $doc = "RE".$year. substr($cnt, strlen($cnt)-5);
            $tmp["doc"] = $doc;
            array_push($resultArray,$tmp);
        }
        $result->free();
    }
}

mysqli_close($conn);

header('Content-Type: application/json');
echo json_encode($resultArray);
?>