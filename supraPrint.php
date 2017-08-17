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
$curDate = date("d-m-Y");
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
        $brCode= "รหัสโรงพยาบาล  ".$aRec["branch_code"];
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
        //$hosp = $sql;<i class="glyphicon glyphicon-glyphicon-unchecked"></i>
    }
}
$paid='<table width="100%"><tr></tr><td class="tdliner"><img src="img/checked.png" alt="me" >&nbsp;ประกันสังคม &nbsp;'.$br1.'</td><td class="tdliner"><img src="img/unchecked.png" alt="me" >&nbsp;กองทุน – บริษัท</td><td><img src="img/unchecked.png" alt="me" >&nbsp;ทั่วไป</td></tr><tr><td class="tdliner"><img src="img/unchecked.png" alt="me" >&nbsp;พรบ..............................</td><td class="tdliner"><img src="img/unchecked.png" alt="me" >&nbsp;ประกันสุขภาพ.........................</td><td><img src="img/unchecked.png" alt="me" >&nbsp;อื่น ๆ.........................</td></tr></table>';
if(trim($sex)==="M"){
    $sex='เพศ &nbsp;<img src="img/checked.png" alt="me" >&nbsp;ชาย &nbsp;<img src="img/unchecked.png" alt="me" >&nbsp;หญิง ';
}else{
    $sex='เพศ &nbsp;<img src="img/unchecked.png" alt="me" >&nbsp;ชาย &nbsp;<img src="img/checked.png" alt="me" >&nbsp;หญิง ';
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
            . '<tr><td><img src="img/checked.jpg" alt="me" >&nbsp;การวินิจฉัย &nbsp;</td><td><img src="img/unchecked.png" alt="me" >&nbsp;รักษาจนเสร็จ</td><td><img src="img/unchecked.png" alt="me" >&nbsp;ขอทราบผล</td></tr>'
            . '<tr><td><img src="img/unchecked.jpg" alt="me" >&nbsp;รักษาเบื้องต้น</td><td><img src="img/unchecked.png" alt="me" >&nbsp;อื่นๆ</td><td>&nbsp;</td></tr></table>';
    }else if($reason==="2"){
        $reason = '<table width="100%"><tr><td colspan="3">เหตุผลในการส่งตัวเพื่อ</td></tr>'
            . '<tr><td><img src="img/unchecked.jpg" alt="me" >&nbsp;การวินิจฉัย &nbsp;</td><td><img src="img/unchecked.png" alt="me" >&nbsp;รักษาจนเสร็จ</td><td><img src="img/unchecked.png" alt="me" >&nbsp;ขอทราบผล</td></tr>'
            . '<tr><td><img src="img/unchecked.jpg" alt="me" >&nbsp;รักษาเบื้องต้น</td><td><img src="img/unchecked.png" alt="me" >&nbsp;อื่นๆ</td><td>&nbsp;</td></tr></table>';
    }else if($reason==="3"){
        $reason = '<table width="100%"><tr><td colspan="3">เหตุผลในการส่งตัวเพื่อ</td></tr>'
            . '<tr><td><img src="img/unchecked.jpg" alt="me" >&nbsp;การวินิจฉัย &nbsp;</td><td><img src="img/unchecked.png" alt="me" >&nbsp;รักษาจนเสร็จ</td><td><img src="img/checked.png" alt="me" >&nbsp;ขอทราบผล</td></tr>'
            . '<tr><td><img src="img/unchecked.jpg" alt="me" >&nbsp;รักษาเบื้องต้น</td><td><img src="img/unchecked.png" alt="me" >&nbsp;อื่นๆ</td><td>&nbsp;</td></tr></table>';
    }else if($reason==="4"){
        $reason = '<table width="100%"><tr><td colspan="3">เหตุผลในการส่งตัวเพื่อ</td></tr>'
            . '<tr><td><img src="img/unchecked.jpg" alt="me" >&nbsp;การวินิจฉัย &nbsp;</td><td><img src="img/unchecked.png" alt="me" >&nbsp;รักษาจนเสร็จ</td><td><img src="img/unchecked.png" alt="me" >&nbsp;ขอทราบผล</td></tr>'
            . '<tr><td><img src="img/checked.jpg" alt="me" >&nbsp;รักษาเบื้องต้น</td><td><img src="img/unchecked.png" alt="me" >&nbsp;อื่นๆ</td><td>&nbsp;</td></tr></table>';
    }else if($reason==="5"){
        $reason = '<table width="100%"><tr><td colspan="3">เหตุผลในการส่งตัวเพื่อ</td></tr>'
            . '<tr><td><img src="img/unchecked.jpg" alt="me" >&nbsp;การวินิจฉัย &nbsp;</td><td><img src="img/unchecked.png" alt="me" >&nbsp;รักษาจนเสร็จ</td><td><img src="img/unchecked.png" alt="me" >&nbsp;ขอทราบผล</td></tr>'
            . '<tr><td><img src="img/unchecked.jpg" alt="me" >&nbsp;รักษาเบื้องต้น</td><td><img src="img/checked.png" alt="me" >&nbsp;อื่นๆ</td><td>&nbsp;</td></tr></table>';
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
        .tdTimes1 {font-family: 'times new roman'; font-size-adjust: 0.58;}
        
        #Header, #Footer { display: none !important; }
        #header, #Footer,#left-panel,#shortcut,#smart-fixed-header, #smart-fixed-navigation,#smart-fixed-ribbon,#smart-fixed-footer,#smart-fixed-container,#smart-rtl { display: none !important; }
        .footer,
        #non-printable { display: none !important; }
        .header,
        #non-printable { display: none !important; }
        #aa{display: table !important;}
        
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
    }
    .tdlinet{
        border-top:solid 1px #000;
    }
    .tdlinel{
        border-left:solid 1px #000;
    }
    .tdliner{
        border-right:solid 1px #000;
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
                    <tr><td align="center" class="padding-5">ใบรับรองการส่งตัวผู้ป่วยไปตรวจนอกสถานที่</td></tr>
                </tbody>
            </table>
        </div>
    </div><br>
    <div class="row">
        <div class="col col-sm-12">
            <table class="table table-striped table-bordered table-hover responsive"  width="100%">
                <tbody>
                    <tr><td align="left"><?php echo 'เลขที่ '.$doc;?></td><td align="right"><?php echo 'วันที่ '.$curDate;?></td></tr>
                </tbody>
            </table>
        </div>
    </div><br>
    <div class="row">
        <div class="col col-sm-12">
            <h4>รพ. / สถานที่รับ</h4>
        </div>
    </div>
    <div class="row">
        <div class="col col-sm-12">
            <table class="header-print topbar-v1"  width="100%" id="aa" >
                <tbody>
                    <tr><td class="tdlinel tdlineb tdlinet"><?php echo $br;?></td><td colspan="2" class="tdlineb tdlinet tdlinel tdliner"><?php echo $brCode;?></td></tr>
                    <tr><td colspan="3" class="tdlinel tdlineb tdliner"><?php echo $hosp;?></td></tr>
                    <tr><td colspan="3" class="tdlinel tdlineb tdliner"><?php echo $paid;?></td></tr>
                </tbody>
            </table>
        </div>
    </div><br>
    <div class="row">
        <div class="col col-sm-12">
            <h4>สำหรับผู้ส่ง</h4>
        </div>
    </div>
    <div class="row">
        <div class="col col-sm-12">
            <table class="table table-striped table-bordered table-hover responsive"  width="100%" border="1">
                <tbody>
                    <tr><td class="name"><?php echo $name;?></td><td class="hn"><?php echo $hn;?></td><td class="hn">AN - </td></tr>
                    <tr><td class="name"><?php echo $id;?></td><td class="hn"><?php echo $sex;?></td><td class="hn"><?php echo $age;?></td></tr>
                </tbody>
            </table>
        </div>
    </div><br>
    <table>
        <tr><td align="left"><?php echo $diseased1;?></td><td align="left"><?php echo $diseased2;?></td></tr>
    </table>

    <div class="row">
        <div class="col col-sm-12">
            <?php echo $reason;?>
        </div>
    </div><br>
    <table width="100%">
        <tr>
            <td colspan="2" align="left">ข้อกำหนดและความต้องการของผู้ส่ง</td>
        </tr>
        <tr>
            <td colspan="2" align="left">ต้องการส่งผู้ป่วยโดยคาดว่าจะถึงผู้รับ	     วันที่ 25-28 สิงหาคม 2560 เวลา09.30-10.00 น.           โดยรถพยาบาล</td>
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
    <br>
    <div class="row">
        <div class="col col-sm-12">สำหรับผู้ประสานงานติดต่อ</div>
    </div>
    <table width="100%">
        <tr>
            <td align="top" width="50%">
                <table border="1">
                    <tr><td>ผู้ส่ง (ให้ลงข้อมูลผู้รับผิดชอบการติดต่อ)</td></tr>
                    <tr><td>ชื่อ – สกุล  นายวุฒินันท์ ธัมมาภิรักษ์กุล</td></tr>
                    <tr><td>ตำแหน่ง  เจ้าหน้าที่ประกันสังคม    แผนก  ประกันสังคม</td></tr>
                    <tr><td>วันที่ 15 สิงหาคม 2560     เวลา10.50 น.</td></tr>
                    <tr><td>ได้ติดต่อเบื้องต้นแล้วกับ</td></tr>
                    <tr><td>ชื่อ – สกุล.........................................................................................</td></tr>
                    <tr><td>
                        <table><tr><td><img src="img/unchecked.png" alt="me" >จะมีใบส่งตัวผู้ป่วย</td><td><img src="img/unchecked.png" alt="me" >จะมีจดหมายส่งตัว</td><td></td></tr>
                        <!--<tr><td><span class="glyphicon glyphicon-unchecked" >FAX</span></td><td><span class="glyphicon glyphicon-unchecked" >โทรศัพท์ </span></td><td><span class="glyphicon glyphicon-unchecked" >อื่นๆ........................ </span></td></tr></table></td></tr>-->
                            <tr><td><img src="img/unchecked.png" alt="me" >FAX<img src="img/unchecked.png" alt="me" >โทรศัพท์ </td><td><img src="img/unchecked.png" alt="me" >อื่นๆ........................ </td></tr></table></td></tr>
                        
                    
                </table>
            </td>
            <td align="top" width="50%">
                <table border="1" align="right">
                    <tr><td>ผู้รับ (ให้ลงข้อมูลผู้รับผิดชอบการติดต่อ)</td></tr>
                    <tr><td>ชื่อ – สกุล......................................................................................</td></tr>
                    <tr><td>ตำแหน่ง..............................................แผนก.................................</td></tr>
                    <tr><td>วันที่..................................................เวลา........................ น.</td></tr>
                    <tr><td>ให้ผู้ส่งดำเนินการได้ทันที</td></tr>
                    <tr><td>ผู้รับจะติดต่อกลับไปภายในวันที่....................................</td></tr>
                    <tr><td><img src="img/unchecked.png" alt="me" >โทรศัพท์<img src="img/unchecked.png" alt="me" >อื่นๆ..................................</td></tr>
                    <tr border="0"><td>&nbsp;</td></tr>
                    <tr border="0"><td>&nbsp;</td></tr>
                </table>
            </td>
        </tr>
    </table>
</div>
