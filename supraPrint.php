<?php
require_once("inc/init.php"); 
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$hostDB="mysql-5.5.chaiyohosting.com";
$userDB="bangna1";
$passDB="yzJ62r!1";
$databaseName="bangna";
$supraId="";
$sex="";
$age="";
$diseased1="";
$diseased2="";
$doctorName="";
$staff="";
$reason="";
$now = getdate();
$curDate1 = date("d-m-Y");
$curTime = date("H:i");
$curMonth = getMonthName(date("m"));
$curYear = date("Y");
$curDate = date("d");
$year1 = intval($curYear)+543;
$txtDate = "วันที่ ".$curDate." ".$curMonth." ".$year1." เวลา ".$curTime." น.";
$txtDate1 = "วันที่ ".$curDate." ".$curMonth." ".$year1;
function getMonthName($monthId){
    if($monthId==="01"){
        return "มกราคม";
    }else if($monthId==="02"){
        return "กุมภาพันธ์";
    }else if($monthId==="03"){
        return "มีนาคม";
    }else if($monthId==="04"){
        return "เมษายน";
    }else if($monthId==="05"){
        return "พฤษภาคม";
    }else if($monthId==="06"){
        return "มิถุนายน";
    }else if($monthId==="07"){
        return "กรกฎาคม";
    }else if($monthId==="08"){
        return "สิงหาคม";
    }else if($monthId==="09"){
        return "กันยายน";
    }else if($monthId==="10"){
        return "ตุลาคม";
    }else if($monthId==="11"){
        return "พฤศจิกายน";
    }else if($monthId==="12"){
        return "ธันวาคม";
    } 
}
if(isset($_GET["supra_id"])){
    $supraId = $_GET["supra_id"];
}else{
    $supraId = "";
}
$where="Where sup.supra_id = '".$supraId."'  ";
$conn = mysqli_connect($hostDB,$userDB,$passDB,$databaseName);
mysqli_set_charset($conn, "UTF8");
$sql="Select sup.*, br.branch_name, hosp.hosp_name_t  "
    ."From t_supra sup "
    ."Left Join b_branch br on br.branch_code = sup.branch_code "
    ."Left Join b_hospital hosp on hosp.hosp_id = sup.hosp_id  $where";
if ($rComp=mysqli_query($conn,$sql)){
    while($aRec = mysqli_fetch_array($rComp)){
        $doc=$aRec["supra_doc"];
        $dateInput = $aRec["input_date"];
        $br = "ผู้ส่ง  ".$aRec["branch_name"];
        $br1 = $aRec["branch_name"];
        if($aRec["branch_code"]==="000"){
            $brCode= "รหัสโรงพยาบาล  11592";
        }else if($aRec["branch_code"]==="001"){
            $brCode= "รหัสโรงพยาบาล  11772";
        }else if($aRec["branch_code"]==="002"){
            $brCode= "รหัสโรงพยาบาล  24036";
        }else{
            $brCode= "รหัสโรงพยาบาล  ".$aRec["branch_code"];
        }
        
        $hosp = "ผู้รับ  ".$aRec["hosp_name_t"];
        $name = "ชื่อ – สกุล ".$aRec["pat_name"]." ".$aRec["pat_surname"];
        $hn = "HN  ".$aRec["hn"];
        $id = "เลขที่บัตรประชาชน  ".$aRec["pat_id"];
        $sex = $aRec["pat_sex"];
        $age = "อายุ ".$aRec["pat_age"]." ปี";
        $diseased1 = is_null($aRec["diseased1"])? "":$aRec["diseased1"];
        $diseased2 = is_null($aRec["diseased2"])? "":$aRec["diseased2"];
        $doctorName = is_null($aRec["doctor_name"])? "":$aRec["doctor_name"];
        $staff = is_null($aRec["pat_staff"])? "":$aRec["pat_staff"];
        $reason = is_null($aRec["reason"])? "":$aRec["reason"];
        $remark = is_null($aRec["remark"])? "":$aRec["remark"];
    }
}
//$paid='<table width="100%"><tr></tr><td class="tdliner"><img src="img/checked.jpg" alt="me" >&nbsp;ประกันสังคม &nbsp;'.$br1.'</td><td class="tdliner"><img src="img/unchecked.jpg" alt="me" >&nbsp;กองทุน – บริษัท</td><td><img src="img/unchecked.jpg" alt="me" >&nbsp;ทั่วไป</td></tr>'
//        . '<tr><td class="tdliner"><img src="img/unchecked.jpg" alt="me" >&nbsp;พรบ..............................</td><td class="tdliner"><img src="img/unchecked.jpg" alt="me" >&nbsp;ประกันสุขภาพ.........................</td><td><img src="img/unchecked.jpg" alt="me" >&nbsp;อื่น ๆ.........................</td></tr></table>';
$paid='<table width="100%"><tr><td ><img src="img/checked.jpg" alt="me" >&nbsp;ประกันสังคม &nbsp;'.$br1.'</td><td ><img src="img/unchecked.jpg" alt="me" >&nbsp;กองทุน – บริษัท</td><td><img src="img/unchecked.jpg" alt="me" >&nbsp;ทั่วไป</td></tr>'
        . '<tr><td ><img src="img/unchecked.jpg" alt="me" >&nbsp;พรบ..............................</td><td ><img src="img/unchecked.jpg" alt="me" >&nbsp;ประกันสุขภาพ.........................</td><td><img src="img/unchecked.jpg" alt="me" >&nbsp;อื่น ๆ.........................</td></tr></table>';
if(trim($sex)==="M"){
    $sex='เพศ &nbsp;<img src="img/checked.jpg" alt="me" >&nbsp;ชาย &nbsp;<img src="img/unchecked.jpg" alt="me" >&nbsp;หญิง ';
}else{
    $sex='เพศ &nbsp;<img src="img/unchecked.jpg" alt="me" >&nbsp;ชาย &nbsp;<img src="img/checked.jpg" alt="me" >&nbsp;หญิง ';
}
if(strlen($diseased1)>0){
    $diseased1 = "โรค     1. ".$diseased1;
}else{
    $diseased1 = "โรค     1. .............................................";
}
if(strlen($diseased2)>0){
    $diseased2 = "โรค     2. ".$diseased2;
}else{
    $diseased2 = "โรค     2. .............................................";
}
if(strlen($doctorName)>0){
    $doctorName = "แพทย์ผู้ส่ง  ".$doctorName;
}else{
    $doctorName = "แพทย์ผู้ส่ง  .............................................";
}
if(strlen($staff)>0){
    $staff = "เจ้าหน้าที่ผู้รับผิดชอบการติดต่อ  ".$staff;
}else{
    $staff = "เจ้าหน้าที่ผู้รับผิดชอบการติดต่อ  .............................................";
}
if(strlen($reason)>0){
    if($reason==="1"){
        $reason = '<table width="100%"><tr><td colspan="3">เหตุผลในการส่งตัวเพื่อ</td></tr>'
            . '<tr><td><img src="img/checked.jpg" alt="me" >&nbsp;การวินิจฉัย &nbsp;</td><td><img src="img/unchecked.jpg" alt="me" >&nbsp;รักษาจนเสร็จ</td><td><img src="img/unchecked.jpg" alt="me" >&nbsp;ขอทราบผล</td></tr>'
            . '<tr><td><img src="img/unchecked.jpg" alt="me" >&nbsp;รักษาเบื้องต้น</td><td><img src="img/unchecked.jpg" alt="me" >&nbsp;อื่นๆ</td><td>&nbsp;</td></tr></table>';
    }else if($reason==="2"){
        $reason = '<table width="100%"><tr><td colspan="3">เหตุผลในการส่งตัวเพื่อ</td></tr>'
            . '<tr><td><img src="img/unchecked.jpg" alt="me" >&nbsp;การวินิจฉัย &nbsp;</td><td><img src="img/unchecked.jpg" alt="me" >&nbsp;รักษาจนเสร็จ</td><td><img src="img/unchecked.jpg" alt="me" >&nbsp;ขอทราบผล</td></tr>'
            . '<tr><td><img src="img/unchecked.jpg" alt="me" >&nbsp;รักษาเบื้องต้น</td><td><img src="img/unchecked.jpg" alt="me" >&nbsp;อื่นๆ</td><td>&nbsp;</td></tr></table>';
    }else if($reason==="3"){
        $reason = '<table width="100%"><tr><td colspan="3">เหตุผลในการส่งตัวเพื่อ</td></tr>'
            . '<tr><td><img src="img/unchecked.jpg" alt="me" >&nbsp;การวินิจฉัย &nbsp;</td><td><img src="img/unchecked.jpg" alt="me" >&nbsp;รักษาจนเสร็จ</td><td><img src="img/checked.jpg" alt="me" >&nbsp;ขอทราบผล</td></tr>'
            . '<tr><td><img src="img/unchecked.jpg" alt="me" >&nbsp;รักษาเบื้องต้น</td><td><img src="img/unchecked.jpg" alt="me" >&nbsp;อื่นๆ</td><td>&nbsp;</td></tr></table>';
    }else if($reason==="4"){
        $reason = '<table width="100%"><tr><td colspan="3">เหตุผลในการส่งตัวเพื่อ</td></tr>'
            . '<tr><td><img src="img/unchecked.jpg" alt="me" >&nbsp;การวินิจฉัย &nbsp;</td><td><img src="img/unchecked.jpg" alt="me" >&nbsp;รักษาจนเสร็จ</td><td><img src="img/unchecked.jpg" alt="me" >&nbsp;ขอทราบผล</td></tr>'
            . '<tr><td><img src="img/checked.jpg" alt="me" >&nbsp;รักษาเบื้องต้น</td><td><img src="img/unchecked.jpg" alt="me" >&nbsp;อื่นๆ</td><td>&nbsp;</td></tr></table>';
    }else if($reason==="5"){
        $reason = '<table width="100%"><tr><td colspan="3">เหตุผลในการส่งตัวเพื่อ</td></tr>'
            . '<tr><td><img src="img/unchecked.jpg" alt="me" >&nbsp;การวินิจฉัย &nbsp;</td><td><img src="img/unchecked.jpg" alt="me" >&nbsp;รักษาจนเสร็จ</td><td><img src="img/unchecked.jpg" alt="me" >&nbsp;ขอทราบผล</td></tr>'
            . '<tr><td><img src="img/unchecked.jpg" alt="me" >&nbsp;รักษาเบื้องต้น</td><td><img src="img/checked.jpg" alt="me" >&nbsp;อื่นๆ</td><td>&nbsp;</td></tr></table>';
    }else{
        $reason="error";
    }
    
}else{
    $reason = '<table width="100%"><tr><td colspan="3">เหตุผลในการส่งตัวเพื่อ</td></tr>'
        . '<tr><td>&nbsp;การวินิจฉัย &nbsp;</td><td><img src="img/unchecked.jpg" alt="me" >&nbsp;รักษาจนเสร็จ</td><td>&nbsp;ขอทราบผล</td></tr>'
        . '<tr><td><img src="img/unchecked.jpg" alt="me" >&nbsp;รักษาเบื้องต้น</td><td><img src="img/unchecked.jpg" alt="me" >&nbsp;อื่นๆ</td><td>&nbsp;</td></tr></table>';
}
$rComp->free();
mysqli_close($conn);
?>

  <style type="text/css">
    @media print {
        @page {
          size: A4;
          margin: 5mm;
          margin-left: 10mm
        }
        .colorful { color: black !important;}
        html, body {
          width: 1024px;
        }
        body {
          margin: 0 auto;
          background-color: #fff;
        }
        header{
            background-image: none;
        }
        .demo activate, .page-footer, .demo,.breadcrumb{
            display: none !important;
        }
        .tdTimes {font-family: 'times new roman'; font-size-adjust: 1;}
        .tdTimes1 {font-family: 'times new roman'; font-size-adjust: 0.68;}
        
        #Header, #Footer { display: none !important; }
        #header, #Footer,#left-panel,#shortcut,#smart-fixed-header, #smart-fixed-navigation,#smart-fixed-ribbon,#smart-fixed-footer,#smart-fixed-container,#smart-rtl { display: none !important; }
        .footer,
        #non-printable { display: none !important; }
        .header,
        #non-printable { display: none !important; }
        #aa{display: table !important;}
        
    }
    * {
        padding: 0;
        margin: 0;
      }
    .name { margin: auto; align-content: flex-end; width: 30%; border: 0px solid #fff; padding: 10px;}
    .hn { margin: auto; align-content: flex-end; width: 15%; border: 0px solid #fff; padding: 10px;}
    .header-print .topbar-v1 {
	background: #fff;
	border-top: solid 1px #f0f0f0;
	border-bottom: solid 1px #f0f0f0;
        margin: 0;
    }
    .tdlineb{
        border-bottom: solid 1px #000;
        padding: 0;
        margin: 0;
        border-collapse: collapse;
        border: display;
    }
    .tdlinet{
        border-top:solid 1px #000;
        padding: 0;
        margin: 0;
        border-collapse: collapse;
        border: display;
    }
    .tdlinel{
        border-left:solid 1px #000;
        border-collapse: collapse;
        padding: 0;
        margin: 0;
        border: display;
    }
    .tdliner{
        border-right:solid 2px #000;
        border-collapse: collapse;
        padding: 0;
        margin: 0;
        border: display;
    }
    .trborder{
        border-left:solid 1px #000;
    }
    .tr1{
        border:solid 1px #000;
        
    }
    .trb{
        border-bottom: solid 1px #000;
    }
    .tdp{
        padding: 5px;
    }
</style>
  


<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <table class="header-print topbar-v1">
                <tr><td><img src="img/logo-b.png" alt="me" ></td>
                    <td><table><tr><td class="tdTimes">โรงพยาบาลทั่วไปขนาดใหญ่ บางนา 5 </td></tr>
                    <tr><td class="tdTimes1">BANGNA 5 GENERAL HOSPITAL</td></tr>
                    <tr><td class="tdTimes1">55 หมู่ 4 ถ.เทพารักษ์ กม.10 ต.บางพลีใหญ่ อ.บางพลี จ.สมุทรปราการ 10540 Tel. 02138-1155-65 Fax.02138-1166</td></tr></table></td>
                </tr>
            </table>
        </div>
    </div><br>
    <div class="row">
        <div class="col col-sm-12">
            <table class="table table-striped table-bordered table-hover responsive"  width="100%">
                <tbody>
                    <tr><td align="center" class="padding-5"><h2>ใบรับรองการส่งตัวผู้ป่วยไปตรวจนอกสถานที่</h2></td></tr>
                </tbody>
            </table>
        </div>
    </div><br>
    <div class="row">
        <div class="col col-sm-12">
            <table class="table table-striped table-bordered table-hover responsive"  width="100%">
                <tbody>
                    <tr><td align="left"><?php echo 'เลขที่ '.$doc;?></td><td align="right"><?php echo $txtDate1;?></td></tr>
                </tbody>
            </table>
        </div>
    </div><br>
    <div class="row">
        <div class="col col-sm-12">
            <h3 class="tdTimes1">รพ. / สถานที่รับ</h3>
        </div>
    </div>
    <div class="row">
        <div class="col col-sm-12">
            <table class="header-print topbar-v1 tr1"  width="100%" id="aa" >
                <tbody>
                    <tr><td ><?php echo $br;?></td><td colspan="2" ><?php echo $brCode;?></td></tr>
                    <tr class="trb"><td colspan="3" ><?php echo $hosp;?></td></tr>
                    <tr ><td colspan="3" ><?php echo $paid;?></td></tr>
                </tbody>
            </table>
        </div>
    </div><br>
    <div class="row">
        <div class="col col-sm-12">
            <h3 class="tdTimes1">สำหรับผู้ส่ง</h3>
        </div>
    </div>
    <div class="row">
        <div class="col col-sm-12">
            <table class="table table-striped table-bordered table-hover responsive tr1"  width="100%" border="1">
                <tbody>
                    <tr class="trb"><td class="name"><?php echo $name;?></td><td class="hn"><?php echo $hn;?></td><td class="hn">AN - </td></tr>
                    <tr><td class="name"><?php echo $id;?></td><td class="hn"><?php echo $sex;?></td><td class="hn"><?php echo $age;?></td></tr>
                </tbody>
            </table>
        </div>
    </div><br>
    <table  width="100%">
        <tr><td align="left"><?php echo $diseased1;?></td><td align="right"><?php echo $diseased2;?></td></tr>
    </table>
    <br>
    <div class="row">
        <div class="col col-sm-12 tdTimes1">
            <?php echo $doctorName;?>
        </div>
    </div><br>
    <div class="row">
        <div class="col col-sm-12 tdTimes1">
            <?php echo $reason;?>
        </div>
    </div><br><br>
    <table width="100%" class="tdTimes1">
        <tr>
            <td colspan="2" align="left">ข้อกำหนดและความต้องการของผู้ส่ง</td>
        </tr>
        <tr>
            <td colspan="2" align="left"><?php echo $remark;?></td>
        </tr>
        <tr>
            <td colspan="2" align="left">ผู้รับโปรดแจ้งผู้ส่งเมื่อวงเงินการรักษาเกิน...................................................	บาท</td>
        </tr>
        <tr>
            <td colspan="2" align=""left>กรณีผู้ป่วยในผู้รับโปรดแจ้งผู้ส่งเป็นประจำทุกวัน</td>
        </tr>
        <tr>
            <td align="left"><table>
                    <tr><td><b>หมายเหตุ : กรณีผู้ป่วยใช้สิทธิประกันสังคมทางโรงพยาบาล</b></td></tr>
                    <tr><td><b>จะรับผิดชอบค่ารักษาตามสิทธิ์ยกเว้นยานอกบัญชียาหลัก</b></td></tr>
                    <tr><td>&nbsp;</td></tr>
                    <tr><td>&nbsp;</td></tr>
                </table>
            </td>
            <td align="right">
                <table>
                    <tr><td>&nbsp;</td></tr>
                    <tr><td>ลงชื่อ................................................................</td></tr>
                    <tr><td align="center">( นายแพทย์อรรถสิทธ์    ทองปลาเค้า )</td></tr>
                    <tr><td align="center">ผู้อำนวยการโรงพยาบาลบางนา 5</td></tr>
                </table>
            </td>
        </tr>
    </table>
    <br><br><br>
    <div class="row">
        <div class="col col-sm-12">สำหรับผู้ประสานงานติดต่อ</div>
    </div>
    <table width="100%">
        <tr>
            <td align="top" width="50%">
                <table class="tr1">
                    <tr class="trb"><td class="tdp">ผู้ส่ง (ให้ลงข้อมูลผู้รับผิดชอบการติดต่อ)</td></tr>
                    <tr class="trb"><td class="tdp">ชื่อ – สกุล  นายวุฒินันท์ ธัมมาภิรักษ์กุล</td></tr>
                    <tr class="trb"><td class="tdp">ตำแหน่ง  เจ้าหน้าที่ประกันสังคม    แผนก  ประกันสังคม</td></tr>
                    <tr class="trb"><td class="tdp"><?php echo $txtDate;?></td></tr>
                    <tr class="trb"><td class="tdp">ได้ติดต่อเบื้องต้นแล้วกับ</td></tr>
                    <tr class="trb"><td class="tdp">ชื่อ – สกุล.........................................................................................</td></tr>
                    <tr class="trb"><td class="tdp">
                        <table><tr><td class="tdp"><img src="img/unchecked.jpg" alt="me" class="tdp">จะมีใบส่งตัวผู้ป่วย</td><td class="tdp"><img src="img/unchecked.jpg" alt="me" class="tdp">จะมีจดหมายส่งตัว</td><td></td></tr>
                        <!--<tr><td><span class="glyphicon glyphicon-unchecked" >FAX</span></td><td><span class="glyphicon glyphicon-unchecked" >โทรศัพท์ </span></td><td><span class="glyphicon glyphicon-unchecked" >อื่นๆ........................ </span></td></tr></table></td></tr>-->
                            <tr><td class="tdp"><img src="img/unchecked.jpg" alt="me" class="tdp">FAX<img src="img/unchecked.jpg" alt="me" class="tdp">โทรศัพท์ </td><td class="tdp"><img src="img/unchecked.jpg" alt="me" class="tdp">อื่นๆ........................ </td></tr></table></td></tr>
                        
                    
                </table>
            </td>
            <td align="top" width="50%">
                <table class="tr1" align="right">
                    <tr class="trb"><td class="tdp">ผู้รับ (ให้ลงข้อมูลผู้รับผิดชอบการติดต่อ)</td></tr>
                    <tr class="trb"><td class="tdp">ชื่อ – สกุล......................................................................................</td></tr>
                    <tr class="trb"><td class="tdp">ตำแหน่ง..............................................แผนก.................................</td></tr>
                    <tr class="trb"><td class="tdp">วันที่..................................................เวลา........................ น.</td></tr>
                    <tr class="trb"><td class="tdp">ให้ผู้ส่งดำเนินการได้ทันที</td></tr>
                    <tr class="trb"><td class="tdp">ผู้รับจะติดต่อกลับไปภายในวันที่....................................</td></tr>
                    <tr ><td class="tdp"><img src="img/unchecked.jpg" alt="me" class="tdp">โทรศัพท์&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="img/unchecked.jpg" alt="me" class="tdp">อื่นๆ..................................</td></tr>
                    <tr border="0"><td>&nbsp;</td></tr>
                    <tr border="0"><td>&nbsp;</td></tr>
                    <tr border="0"><td>&nbsp;</td></tr>
                </table>
            </td>
        </tr>
    </table>
</div>
