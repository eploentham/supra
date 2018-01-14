<?php
require_once("inc/init.php");
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

//$databaseName="at_healthcare";
//$userDB="root";
//$passDB="";
//$hostDB="localhost";
$conn = mysqli_connect($hostDB,$userDB,$passDB,$databaseName);
mysqli_set_charset($conn, "UTF8");
$sql="";
if($_GET["flagPage"] === "company"){
    $comp_id=$_GET["comp_id"];
    $comp_code=$_GET["comp_code"];
    $comp_name_t=$_GET["comp_name_t"];
    $comp_address_t=$_GET["comp_address_t"];
    $tele=$_GET["tele"];
    $email=$_GET["email"];
    $tax_id=$_GET["tax_id"];
    $prov_id=$_GET["prov_id"];
    $amphur_id=$_GET["amphur_id"];
    $district_id=$_GET["district_id"];
    $zipcode=$_GET["zipcode"];
    if($_GET["comp_id"]==="-"){
        $sql="Insert Into b_company(comp_id, comp_code, comp_name_t, comp_address_t, tele, email, tax_id, date_create) "
                ."Values(UUID(),'".$comp_code."','".$comp_name_t."','".$comp_address_t."','".$tele."','".$email."','".$tax_id."',now())";
    }else{
        $sql="Update b_company "
                ."Set comp_code = '".$comp_code."' "
                .", comp_name_t = '".$comp_name_t."' "
                .", comp_address_t = '".$comp_address_t."' "
                .", tele = '".$tele."' "
                .", email = '".$email."' "
                .", tax_id = '".$tax_id."' "
                .", prov_id = '".$prov_id."' "
                .", amphur_id = '".$amphur_id."' "
                .", district_id = '".$district_id."' "
                .", zipcode = '".$zipcode."' "
                .", date_modi = now() "
                ."Where comp_id = '".$comp_id."'";
    }
}else if($_GET["flagPage"] === "branch"){
    $branch_id=$_GET["branch_id"];
    $branch_code=$_GET["branch_code"];
    $branch_name=$_GET["branch_name"];
    $branch_address=$_GET["branch_address"];
    $tele=$_GET["tele"];
    if(($_GET["branch_id"]==="-") || ($_GET["branch_id"]==="")){
        $sql = "Select count(1) as cnt From b_branch ";
        if ($result=mysqli_query($conn,$sql) or die(mysqli_error())){
            $ok="1";
            while($row = mysqli_fetch_array($result)){
                if(is_null($row["cnt"])){
                    $cnt = "0";
                }else{
                    $cnt = $row["cnt"];
                }
                $cnt = intval($cnt)+1;
                $cnt = "000".$cnt;
            }
            $doc = "B".$year. substr($cnt, strlen($cnt)-3);
        }
        $sql="Insert Into b_branch(branch_id, branch_code, branch_name, branch_address, tele, active, date_create) "
                ."Values(UUID(),'".$branch_code."','".$branch_name."','".$branch_address."','".$tele."','1',now())";
    }else{
        $sql="Update b_branch "
                ."Set branch_code = '".$branch_code."' "
                .", branch_name = '".$branch_name."' "
                .", branch_address = '".$branch_address."' "
                .", tele = '".$tele."' "
                .", date_modi = now() "
                ."Where branch_id = '".$branch_id."'";
    }
}else if($_GET["flagPage"] === "hospital"){
    $hosp_id=$_GET["hosp_id"];
    $hosp_code=$_GET["hosp_code"];
    $hosp_name_t=$_GET["hosp_name_t"];
    $hosp_address_t=$_GET["hosp_address_t"];
    $tele=$_GET["tele"];
    $email=$_GET["email"];
    $tax_id=$_GET["tax_id"];
    $prov_id=$_GET["prov_id"];
    $amphur_id=$_GET["amphur_id"];
    $district_id=$_GET["district_id"];
    $zipcode=$_GET["zipcode"];
    $contact_name1=$_GET["contact_name1"];
    $contact_tel1=$_GET["contact_tel1"];
    $contact_name2=$_GET["contact_name2"];
    $contact_tel2=$_GET["contact_tel2"];
    if(($_GET["hosp_id"]==="-")|| ($_GET["hosp_id"]==="")){
//        $sql = "Select count(1) as cnt From b_customer ";
//        if ($result=mysqli_query($conn,$sql) or die(mysqli_error())){
//            $ok="1";
//            while($row = mysqli_fetch_array($result)){
//                if(is_null($row["cnt"])){
//                    $cnt = "0";
//                }else{
//                    $cnt = $row["cnt"];
//                }
//                $cnt = intval($cnt)+1;
//                $cnt = "000".$cnt;
//            }
//            $doc = "C".$year. substr($cnt, strlen($cnt)-3);
//        }
        $sql="Insert Into b_hospital(hosp_id, hosp_code, hosp_name_t, hosp_address_t "
                .", tele, email, tax_id,contact_name1 "
                .", contact_tel1,contact_name2,contact_tel2,prov_id "
                .",amphur_id,district_id,zipcode, active, date_create) "
                ."Values(UUID(),'".$hosp_code."','".$hosp_name_t."','".$hosp_address_t."','"
                .$tele."','".$email."','".$tax_id."','".$contact_name1."','"
                .$contact_tel1."','".$contact_name2."','".$contact_tel2."','".$prov_id."','"
                .$amphur_id."','".$district_id."','".$zipcode."','1',now())";
    }else{
        $sql="Update b_hospital "
                ."Set hosp_code = '".$hosp_code."' "
                .", hosp_name_t = '".$hosp_name_t."' "
                .", hosp_address_t = '".$hosp_address_t."' "
                .", tele = '".$tele."' "
                .", email = '".$email."' "
                .", tax_id = '".$tax_id."' "
                .", prov_id = '".$prov_id."' "
                .", amphur_id = '".$amphur_id."' "
                .", district_id = '".$district_id."' "
                .", zipcode = '".$zipcode."' "
                .", contact_name1 = '".$contact_name1."' "
                .", contact_tel1 = '".$contact_tel1."' "
                .", contact_name2 = '".$contact_name2."' "
                .", contact_tel2 = '".$contact_tel2."' "
                .", date_modi = now() "
                ."Where hosp_id = '".$hosp_id."'";
    }
}else if($_GET["flagPage"] === "supra"){
    $yearId="";
    $monthId="";
    $supra_id=$_GET["supra_id"];
    $supra_doc=$_GET["supra_doc"];
//    $input_date=$_GET["input_date"];
//    $supra_date=$_GET["supra_date"];
    $input_date=substr($_GET["input_date"],strlen($_GET["input_date"])-4)."-".substr($_GET["input_date"],3,2)."-".substr($_GET["input_date"],0,2);
    $supra_date=substr($_GET["supra_date"],strlen($_GET["supra_date"])-4)."-".substr($_GET["supra_date"],3,2)."-".substr($_GET["supra_date"],0,2);
    $yearId = substr($_GET["supra_date"],strlen($_GET["supra_date"])-4);
    $monthId = substr($_GET["supra_date"],3,2);
    $hn=$_GET["hn"];
    $pat_id=$_GET["pat_id"];
    $paid_type_name=$_GET["paid_type_name"];
    $supra_type_id=$_GET["supra_type_id"];
    $pat_name=$_GET["pat_name"];
    $pat_surname=$_GET["pat_surname"];
    $branch_id=$_GET["branch_id"];
    $hosp_id=$_GET["hosp_id"];
    $doctor_name=$_GET["doctor_name"];
    $paid=$_GET["paid"];
    $remark=$_GET["remark"];
    $contact_name_hosp=$_GET["contact_name_hosp"];
    $contact_tel_hosp=$_GET["contact_tel_hosp"];
    $contact_name_pat=$_GET["contact_name_pat"];
    $contact_tel_pat=$_GET["contact_tel_pat"];
    $status_car=$_GET["status_car"];
    $status_travel=$_GET["status_travel"];
    $pat_sex=$_GET["pat_sex"];
    $pat_age=$_GET["pat_age"];
    $reason=$_GET["reason"];
    $pat_staff=$_GET["pat_staff"];
    $diseased1=$_GET["diseased1"];
    $diseased2=$_GET["diseased2"];
    $diseased3=$_GET["diseased3"];
    $diseased4=$_GET["diseased4"];
    $drg=$_GET["drg"];
    $on_top=$_GET["on_top"];
    $flag_new=$_GET["flag_new"];
    if(!is_numeric($paid)){
        $paid="0";
    }
    if(($_GET["flag_new"]==="-")|| ($_GET["flag_new"]==="new")){
//        $sql = "Select count(1) as cnt From b_vendor ";
//        if ($result=mysqli_query($conn,$sql) or die(mysqli_error($conn))){
//            $ok="1";
//            while($row = mysqli_fetch_array($result)){
//                if(is_null($row["cnt"])){
//                    $cnt = "0";
//                }else{
//                    $cnt = $row["cnt"];
//                }
//                $cnt = intval($cnt)+1;
//                $cnt = "000".$cnt;
//            }
//            $doc = "V".$year. substr($cnt, strlen($cnt)-3);
//        }
//    if(($_GET["vend_id"]==="-")|| ($_GET["vend_id"]==="")){
        $sql="Insert Into t_supra(supra_id, supra_doc, input_date, supra_date "
            .", hn, pat_id, paid_type_name, supra_type_id "
            .", pat_name, pat_surname, branch_code, hosp_id "
            .", doctor_name, paid, remark, contact_name_hosp"
            .", contact_tele_hosp,contact_name_pat,contact_tele_pat, status_car"
            .", pat_sex, pat_age, reason, pat_staff"
            . ", diseased1, diseased2, diseased3, diseased4"
            . ", drg, on_top, status_travel,year_id, month_id, active, date_create) "
            ."Values(UUID(),'".$supra_doc."','".$input_date."','".$supra_date."','"
            .$hn."','".$pat_id."','".$paid_type_name."','".$supra_type_id."','"
            .$pat_name."','".$pat_surname."','".$branch_id."','".$hosp_id."','"
            .$doctor_name."','".$paid."','".$remark."','".$contact_name_hosp."','"
            .$contact_tel_hosp."','".$contact_name_pat."','".$contact_tel_pat."','".$status_car."','"
            .$pat_sex."','".$pat_age."','".$reason."','".$pat_staff."','"
            .$diseased1."','".$diseased2."','".$diseased3."','".$diseased4."','"
            .$drg."','".$on_top."','".$status_travel."','".$yearId."','".$monthId."','1',now())";
    }else{
        $sql="Update t_supra "
            ."Set supra_doc = '".$supra_doc."' "
            .", input_date = '".$input_date."' "
            .", supra_date = '".$supra_date."' "
            .", hn = '".$hn."' "
            .", pat_id = '".$pat_id."' "
            .", paid_type_name = '".$paid_type_name."' "
            .", supra_type_id = '".$supra_type_id."' "
            .", pat_name = '".$pat_name."' "
            .", pat_surname = '".$pat_surname."' "
            .", branch_code = '".$branch_id."' "
            .", hosp_id = '".$hosp_id."' "
            .", doctor_name = '".$doctor_name."' "
            .", paid = ".$paid." "
            .", remark = '".$remark."' "
            .", contact_name_hosp = '".$contact_name_hosp."' "
            .", contact_tele_hosp = '".$contact_tel_hosp."' "
            .", contact_name_pat = '".$contact_name_pat."' "
            .", contact_tele_pat = '".$contact_tel_pat."' "
            .", status_car = '".$status_car."' "
            .", pat_sex = '".$pat_sex."' "
            .", pat_age = '".$pat_age."' "
            .", reason = '".$reason."' "
            .", pat_staff = '".$pat_staff."' "
            .", diseased1 = '".$diseased1."' "
            .", diseased2 = '".$diseased2."' "
            .", diseased3 = '".$diseased3."' "
            .", diseased4 = '".$diseased4."' "
            .", drg = '".$drg."' "
            .", on_top = '".$on_top."' "
            .", status_travel = '".$status_travel."' "
            .", year_id = '".$yearId."' "
            .", month_id = '".$monthId."' "
            .", date_modi = now() "
            ."Where supra_id = '".$supra_id."'";
    }
}else if($_GET["flagPage"] === "goodsType"){
    $goods_type_id=$_GET["goods_type_id"];

    $goods_type_name=$_GET["goods_type_name"];

    if(($_GET["goods_type_id"]==="-")|| ($_GET["goods_type_id"]==="")){
        $sql="Insert Into b_goods_type(goods_type_id, goods_type_name, active, date_create) "
            ."Values(UUID(),'".$goods_type_name."','1',now())";
    }else{
        $sql="Update b_goods_type "
            ."Set  "
            ." goods_type_name = '".$goods_type_name."' "                
            .", date_modi = now() "
            ."Where goods_type_id = '".$goods_type_id."'";
    }
}else if($_GET["flagPage"] === "goodsCatagory"){
    $goods_cat_id=$_GET["goods_cat_id"];
    $goods_cat_name=$_GET["goods_cat_name"];
    if(($_GET["goods_cat_id"]==="-")|| ($_GET["goods_cat_id"]==="")){
        $sql="Insert Into b_goods_catagory(goods_cat_id, goods_cat_name, active, date_create) "
            ."Values(UUID(),'".$goods_cat_name."','1',now())";
    }else{
        $sql="Update b_goods_catagory "
            ."Set  "
            ." goods_cat_name = '".$goods_cat_name."' "                
            .", date_modi = now() "
            ."Where goods_cat_id = '".$goods_cat_id."'";
    }
}else if($_GET["flagPage"] === "unit"){
    $unit_id=$_GET["unit_id"];
    $unit_name=$_GET["unit_name"];
    if(($_GET["unit_id"]==="-")|| ($_GET["unit_id"]==="")){
        $sql="Insert Into b_unit(unit_id, unit_name, active, date_create) "
            ."Values(UUID(),'".$unit_name."','1',now())";
    }else{
        $sql="Update b_unit "
            ."Set  "
            ." unit_name = '".$unit_name."' "                
            .", date_modi = now() "
            ."Where unit_id = '".$unit_id."'";
    }
}else if($_GET["flagPage"] === "goods"){
    $goods_id=$_GET["goods_id"];
    $goods_name=$_GET["goods_name"];
    $goods_name_ex=$_GET["goods_name_ex"];
    $goods_code=$_GET["goods_code"];
    $goods_code_ex=$_GET["goods_code_ex"];
    $goods_type_id= $_GET["goods_type_id"];
    $goods_cat_id= $_GET["goods_cat_id"];
    $price=$_GET["price"];
    $cost=$_GET["cost"];
    $holes=$_GET["holes"];
    $side=$_GET["side"];
    $dia_meter=$_GET["dia_meter"];
    $length=$_GET["length"];
    $unit_id=$_GET["unit_id"];
    $purchase_point=$_GET["purchase_point"];
    $purchase_period=$_GET["purchase_period"];
    $barcode=$_GET["barcode"];
    if(($_GET["goods_id"]==="-")|| ($_GET["goods_id"]==="")){
        $sql="Insert Into b_goods(goods_id, goods_code, goods_name, goods_name_ex, "
            ."price, cost, holes, side, "
            ."dia_meter, length, unit_id, goods_type_id, "
            ."goods_cat_id, goods_code_ex, purchase_point, purchase_period, "
            ."barcode, active, date_create) "
            ."Values(UUID(),'".$goods_code."','".$goods_name."','".$goods_name_ex."','"
            .$price."','".$cost."','".$holes."','".$side."','"
            .$dia_meter."','".$length."','".$unit_id."','".$goods_type_id."','"
            .$goods_cat_id."','".$goods_code_ex."',".$purchase_point.",".$purchase_period.",'"
            .$barcode."','1',now())";
    }else{
        $sql="Update b_goods "
            ."Set  "
            ." goods_code = '".$goods_code."' "
            .", goods_code_ex = '".$goods_code_ex."' "
            .", goods_name = '".$goods_name."' "
            .", goods_name_ex = '".$goods_name_ex."' "
            .", goods_type_id = '".$goods_type_id."' "
            .", goods_cat_id = '".$goods_cat_id."' "
            .", price = ".$price." "
            .", cost = ".$cost." "
            .", holes = '".$holes."' "
            .", side = '".$side."' "
            .", dia_meter = '".$dia_meter."' "
            .", length = '".$length."' "
            .", unit_id = '".$unit_id."' "
            .", purchase_point = ".$purchase_point." "
            .", purchase_period = ".$purchase_period." "
            .", barcode = '".$barcode."' "
            .", date_modi = now() "
            ."Where goods_id = '".$goods_id."'";
    }
}else if($_GET["flagPage"] === "goods_rec"){
    $rec_id=$_GET["rec_id"];
    $rec_doc=$_GET["rec_doc"];
    $inv_ex=$_GET["inv_ex"];
    $description=$_GET["description"];
    $rec_date=substr($_GET["rec_date"],strlen($_GET["rec_date"])-4)."-".substr($_GET["rec_date"],3,2)."-".substr($_GET["rec_date"],0,2);
    $inv_ex_date=substr($_GET["inv_ex_date"],strlen($_GET["inv_ex_date"])-4)."-".substr($_GET["inv_ex_date"],3,2)."-".substr($_GET["inv_ex_date"],0,2);
    $comp_id=$_GET["comp_id"];
    $vend_id=$_GET["vend_id"];
    $branch_id=$_GET["branch_id"];
    $remark=$_GET["remark"];
    $flag_new=$_GET["flag_new"];
    
    if(($_GET["flag_new"]==="-")|| ($_GET["flag_new"]==="new")){
        $sql = "Select count(1) as cnt From t_goods_rec ";
        if ($result=mysqli_query($conn,$sql) or die(mysqli_error())){
            $year = date("Y");
            $year = substr($year, 2);
            $ok="1";
            $tmp = array();
            $tmp["sql"] = $sql;
            $cnt="";
            //array_push($resultArray,$tmp);
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
        }
        $sql="Insert Into t_goods_rec(rec_id, rec_doc, inv_ex, description, "
            ."rec_date, inv_ex_date, comp_id, vend_id, "
            ."branch_id, remark, status_stock, active, date_create) "
            ."Values('".$rec_id."','".$doc."','".$inv_ex."','".$description."','"
            .$rec_date."','".$inv_ex_date."','".$comp_id."','".$vend_id."','"
            .$branch_id."','".$remark."','0','1',now())";
    }else{
        $sql="Update t_goods_rec "
            ."Set  "
            ." inv_ex = '".$inv_ex."' "
//                .", rec_doc = '".$rec_doc."' "
            .", description = '".$description."' "
            .", rec_date = '".$rec_date."' "
            .", inv_ex_date = '".$inv_ex_date."' "
            .", comp_id = '".$comp_id."' "
            .", vend_id = '".$vend_id."' "
            .", branch_id = '".$branch_id."' "
            .", remark = '".$remark."' "
            .", date_modi = now() "
            ."Where rec_id = '".$rec_id."'";
    }
}else if($_GET["flagPage"] === "goods_rec_detail"){
    $rec_detail_id=$_GET["rec_detail_id"];
    $rec_id="";
    $rec_id=$_GET["rec_id"];
    $goods_id=$_GET["goods_id"];
    $qty=$_GET["qty"];
    $price=$_GET["price"];
    $cost=$_GET["cost"];
    $amt=$_GET["amt"];
    $unit_id=$_GET["unit_id"];
    if($cost===""){
        $cost="0";
    }
    if($price===""){
        $price="0";
    }
    if($amt===""){
        $amt="0";
    }
    if(!is_numeric($amt)){
        $amt="0";
    }
    if(!is_numeric($price)){
        $price="0";
    }
    if(!is_numeric($cost)){
        $cost="0";
    }
    if(($_GET["rec_detail_id"]==="-")|| ($_GET["rec_detail_id"]==="")){
        $sql="Insert Into t_goods_rec_detail(rec_detail_id, rec_id, goods_id, price, "
            ."cost, qty, amount, unit_id, "
            ."remark, status_stock, active, date_create) "
            ."Values(UUID(),'".$rec_id."','".$goods_id."','".$price."','"
            .$cost."','".$qty."','".$amt."','".$unit_id."','"
            .$remark."','0','1',now())";
//        $sql="Insert Into t_goods_rec_detail(rec_detail_id, active, date_create) "
//                ."Values(UUID(),'1',now())";
    }else{
        $sql="Update t_goods_rec_detail "
            ."Set  "
            ." rec_id = '".$rec_id."' "
            .", goods_id = '".$goods_id."' "
            .", price = '".$price."' "
            .", cost = '".$cost."' "
            .", qty = '".$qty."' "
            .", amount = '".$amount."' "
            .", unit_id = '".$unit_id."' "
            .", remark = '".$remark."' "
            .", date_modi = now() "
            ."Where rec_detail_id = '".$rec_detail_id."'";
    }
}else if($_GET["flagPage"] === "rec_detail_void"){
    $rec_detail_id=$_GET["rec_detail_id"];
    $sql="Update t_goods_rec_detail "
        ."Set  "
        ." active = '3' "
        .", date_cancel = now() "
        ."Where rec_detail_id = '".$rec_detail_id."'";
}else if($_GET["flagPage"] === "void_vendor"){
    $vend_id=$_GET["vend_id"];
    $sql="Update b_vendor "
        ."Set  "
        ." active = '3' "
        .", date_cancel = now() "
        ."Where vend_id = '".$vend_id."'";
}else if($_GET["flagPage"] === "void_unit"){
    $unit_id=$_GET["vendor_id"];
    $sql="Update b_unit "
        ."Set  "
        ." active = '3' "
        .", date_cancel = now() "
        ."Where unit_id = '".$unit_id."'";
}else if($_GET["flagPage"] === "void_goods_type"){
    $type_id=$_GET["type_id"];
    $sql="Update b_goods_type "
        ."Set  "
        ." active = '3' "
        .", date_cancel = now() "
        ."Where goods_type_id = '".$type_id."'";
}else if($_GET["flagPage"] === "void_goods_cat"){
    $cat_id=$_GET["cat_id"];
    $sql="Update b_goods_cat "
        ."Set  "
        ." active = '3' "
        .", date_cancel = now() "
        ."Where goods_cat_id = '".$cat_id."'";
}else if($_GET["flagPage"] === "void_goods_rec"){
    $rec_id=$_GET["rec_id"];
    $sql="Update t_goods_rec "
        ."Set  "
        ." active = '3' "
        .", date_cancel = now() "
        ."Where rec_id = '".$rec_id."'";
}else if($_GET["flagPage"] === "void_goods_draw"){
    $draw_id=$_GET["draw_id"];
    $sql="Update t_goods_draw "
        ."Set  "
        ." active = '3' "
        .", date_cancel = now() "
        ."Where draw_id = '".$draw_id."'";
}else if($_GET["flagPage"] === "void_goods_return"){
    $return_id=$_GET["return_id"];
    $sql="Update t_goods_return "
        ."Set  "
        ." active = '3' "
        .", date_cancel = now() "
        ."Where return_id = '".$return_id."'";
}else if($_GET["flagPage"] === "void_supra"){
    $sup_id=$_GET["sup_id"];
    $sql="Update t_supra "
        ."Set  "
        ." active = '3' "
        .", date_cancel = now() "
        ."Where supra_id = '".$sup_id."'";
}else if($_GET["flagPage"] === "void_goods"){
    $goods_id=$_GET["goods_id"];
    $sql="Update b_goods "
        ."Set  "
        ." active = '3' "
        .", date_cancel = now() "
        ."Where goods_id = '".$goods_id."'";
}else if($_GET["flagPage"] === "aa"){
    $rec_id=$_GET["rec_id"];
    
}else if($_GET["flagPage"] === "goods_draw"){
    $draw_doc="";
    $draw_id=$_GET["draw_id"];
    $draw_doc=$_GET["draw_doc"];
    //$inv_ex=$_GET["inv_ex"];
    $description=$_GET["description"];
    $draw_date=substr($_GET["draw_date"],strlen($_GET["draw_date"])-4)."-".substr($_GET["draw_date"],3,2)."-".substr($_GET["draw_date"],0,2);
    //$inv_ex_date=$_GET["inv_ex_date"];
    $comp_id=$_GET["comp_id"];
    //$vend_id=$_GET["vend_id"];
    $branch_id_draw=$_GET["branch_id_draw"];
    $cust_id_rec=$_GET["cust_id_rec"];
    $remark=$_GET["remark"];
    $flag_new=$_GET["flag_new"];
    if(($_GET["flag_new"]==="-")|| ($_GET["flag_new"]==="new")){
        $sql = "Select count(1) as cnt From t_goods_draw ";
        if ($result=mysqli_query($conn,$sql) or die(mysqli_error())){
            $year = date("Y");
            $year = substr($year, 2);
            $ok="1";
            $tmp = array();
            $tmp["sql"] = $sql;
            $cnt="";
            //array_push($resultArray,$tmp);
            while($row = mysqli_fetch_array($result)){
                if(is_null($row["cnt"])){
                    $cnt = "0";
                }else{
                    $cnt = $row["cnt"];
                }
                $cnt = intval($cnt)+1;
                $cnt = "00000".$cnt;
            }
            $doc = "DR".$year. substr($cnt, strlen($cnt)-5);
        }
        $sql="Insert Into t_goods_draw(draw_id, draw_doc, description, "
                ."draw_date, comp_id, branch_id_draw, "
                ."cust_id_rec, remark, status_stock, active, date_create) "
                ."Values('".$draw_id."','".$doc."','".$description."','"
                .$draw_date."','".$comp_id."','".$branch_id_draw."','"
                .$cust_id_rec."','".$remark."','0','1',now())";
    }else{
        $sql="Update t_goods_draw "
                ."Set  "
                //.", inv_ex = '".$inv_ex."' "
                ." description = '".$description."' "
//                .", draw_doc = '".$draw_doc."' "
                .", draw_date = '".$draw_date."' "
                //.", inv_ex_date = '".$inv_ex_date."' "
                .", comp_id = '".$comp_id."' "
                .", branch_id_draw = '".$branch_id_draw."' "
                .", cust_id_rec = '".$cust_id_rec."' "
                .", remark = '".$remark."' "
                .", date_modi = now() "
                ."Where draw_id = '".$draw_id."'";
    }
}else if($_GET["flagPage"] === "goods_draw_detail"){
    $draw_detail_id=$_GET["draw_detail_id"];
    $draw_id="";
    $draw_id=$_GET["draw_id"];
    $goods_id=$_GET["goods_id"];
    $qty=$_GET["qty"];
    $price=$_GET["price"];
    $cost=$_GET["cost"];
    $amt=$_GET["amt"];
    $unit_id=$_GET["unit_id"];
    $hn=$_GET["hn"];
    if(!is_numeric($amt)){
        $amt="0";
    }
    if(!is_numeric($price)){
        $price="0";
    }
    if(!is_numeric($cost)){
        $cost="0";
    }
    if(($_GET["draw_detail_id"]==="-")|| ($_GET["draw_detail_id"]==="")){
        $sql="Insert Into t_goods_draw_detail(draw_detail_id, draw_id, goods_id, price, "
            ."cost, qty, amount, unit_id, "
            ."remark, hn, status_stock, active, date_create) "
            ."Values(UUID(),'".$draw_id."','".$goods_id."','".$price."','"
            .$cost."','".$qty."','".$amt."','".$unit_id."','"
            .$remark."','".$hn."','0','1',now())";
//        $sql="Insert Into t_goods_rec_detail(rec_detail_id, active, date_create) "
//                ."Values(UUID(),'1',now())";
    }else{
        $sql="Update t_goods_draw_detail "
            ."Set  "
            ." draw_id = '".$draw_id."' "
            .", goods_id = '".$goods_id."' "
            .", price = '".$price."' "
            .", cost = '".$cost."' "
            .", qty = '".$qty."' "
            .", amount = '".$amount."' "
            .", unit_id = '".$unit_id."' "
            .", remark = '".$remark."' "
            .", hn = '".$hn."' "
            .", date_modi = now() "
            ."Where draw_detail_id = '".$draw_detail_id."'";
    }
}else if($_GET["flagPage"] === "draw_detail_void"){
    $draw_detail_id=$_GET["draw_detail_id"];
    $sql="Update t_goods_draw_detail "
            ."Set  "
            ." active = '3' "
            .", date_cancel = now() "
            ."Where draw_detail_id = '".$draw_detail_id."'";
}else if($_GET["flagPage"] === "return_detail_void"){
    $ret_detail_id=$_GET["ret_detail_id"];
    $sql="Update t_goods_return_detail "
            ."Set  "
            ." active = '3' "
            .", date_cancel = now() "
            ."Where return_detail_id = '".$ret_detail_id."'";
}else if($_GET["flagPage"] === "goods_return"){
    $return_id=$_GET["return_id"];
    $return_doc=$_GET["return_doc"];
    //$inv_ex=$_GET["inv_ex"];
    $description=$_GET["description"];
    $return_date=substr($_GET["return_date"],strlen($_GET["return_date"])-4)."-".substr($_GET["return_date"],3,2)."-".substr($_GET["return_date"],0,2);
    $draw_id=$_GET["draw_id"];
    $comp_id=$_GET["comp_id"];
    $cust_id=$_GET["cust_id"];
    $branch_id=$_GET["branch_id"];
    $remark=$_GET["remark"];
    $flag_new=$_GET["flag_new"];
    if(($_GET["flag_new"]==="-")|| ($_GET["flag_new"]==="new")){
        $sql = "Select count(1) as cnt From t_goods_return ";
        if ($result=mysqli_query($conn,$sql) or die(mysqli_error())){
            $year = date("Y");
            $year = substr($year, 2);
            $ok="1";
            $tmp = array();
            $tmp["sql"] = $sql;
            $cnt="";
            //array_push($resultArray,$tmp);
            while($row = mysqli_fetch_array($result)){
                if(is_null($row["cnt"])){
                    $cnt = "0";
                }else{
                    $cnt = $row["cnt"];
                }
                $cnt = intval($cnt)+1;
                $cnt = "00000".$cnt;
            }
            $doc = "RT".$year. substr($cnt, strlen($cnt)-5);
        }
        $sql="Insert Into t_goods_return(return_id, return_doc, description,draw_id, "
                ."return_date, comp_id, cust_id_return, "
                ."branch_id, remark, status_stock, active, date_create) "
                ."Values('".$return_id."','".$doc."','".$description."','".$draw_id."','"
                .$return_date."','".$comp_id."','".$cust_id."','"
                .$branch_id."','".$remark."','0','1',now())";
    }else{
        $sql="Update t_goods_return "
                ."Set  "
                //.", inv_ex = '".$inv_ex."' "
                ." description = '".$description."' "
                .", draw_id = '".$draw_id."' "
                .", return_date = '".$return_date."' "
                //.", inv_ex_date = '".$inv_ex_date."' "
                .", comp_id = '".$comp_id."' "
                .", cust_id_return = '".$cust_id."' "
                .", branch_id = '".$branch_id."' "
                .", remark = '".$remark."' "
                .", date_modi = now() "
                ."Where return_id = '".$return_id."'";
    }
}else if($_GET["flagPage"] === "goods_return_detail"){
    $ret_detail_id=$_GET["ret_detail_id"];
    $draw_id="";
    $ret_id=$_GET["ret_id"];
    $goods_id=$_GET["goods_id"];
    $qty=$_GET["qty"];
    if(!is_numeric($qty)){
        $qty="0";
    }

//    $price=$_GET["price"];
//    $cost=$_GET["cost"];
//    $amt=$_GET["amt"];
//    $unit_id=$_GET["unit_id"];
//    $hn=$_GET["hn"];
    if(($_GET["ret_detail_id"]==="-")|| ($_GET["ret_detail_id"]==="")){
        $sql="Insert Into t_goods_return_detail(return_detail_id, return_id, goods_id, "
                ." qty, active, date_create) "
                ."Values(UUID(),'".$ret_id."','".$goods_id."','"
                .$qty."','1',now())";
//        $sql="Insert Into t_goods_rec_detail(rec_detail_id, active, date_create) "
//                ."Values(UUID(),'1',now())";
    }else{
        $sql="Update t_goods_return_detail "
                ."Set  "
                ." return_id = '".$ret_id."' "
                .", goods_id = '".$goods_id."' "                
                .", qty = '".$qty."' "                
                .", date_modi = now() "
                ."Where return_detail_id = '".$ret_detail_id."'";
    }
}
$response = array();
$resultArray = array();
$err = "";

//$result = mysqli_query($conn,$sql);
header('Content-Type: application/json');
if ($result=mysqli_query($conn,$sql) or die(mysqli_error($conn))){
    $response["success"] = 1;
    $response["message"] = "Success";
    $response["error"] = $err;
    $response["sql"] = $sql;
    array_push($resultArray,$response);
    echo json_encode($resultArray);
}else{
    $response["success"] = 0;
    $response["message"] = "Error";
    $response["error"] = mysqli_error($conn);
    $response["sql"] = $sql;
    array_push($resultArray,$response);
    echo json_encode($resultArray);
}
//echo mysql_error();
mysqli_close($conn);
?>