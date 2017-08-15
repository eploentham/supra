<?php

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
$now = getdate();
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
        //$hosp = $sql;<i class="glyphicon glyphicon-glyphicon-unchecked"></i>
    }
}
$paid='<table width="100%"><tr></tr><td><span class="glyphicon glyphicon-check" >&nbsp;ประกันสังคม &nbsp;'.$br1.'</span></td><td><span class="glyphicon glyphicon-unchecked" >&nbsp;กองทุน – บริษัท</span></td><td><span class="glyphicon glyphicon-unchecked" >&nbsp;ทั่วไป</span></td></tr><tr><td><span class="glyphicon glyphicon-unchecked" aria-hidden="true">&nbsp;พรบ..............................</span></td><td><span class="glyphicon glyphicon-unchecked" aria-hidden="true">&nbsp;ประกันสุขภาพ.........................</span></td><td><span class="glyphicon glyphicon-unchecked" aria-hidden="true">&nbsp;อื่น ๆ.........................</span></td></tr></table>';


$rComp->free();
mysqli_close($conn);
?>

<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <style type="text/css">
    @media print {
        @page {
          size: A4;
          margin: 5mm;
        }
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
    
    .cnt { margin: auto; align-content: flex-end; width: 10%; border: 0px solid #fff; padding: 10px;}
    .price { margin: auto; align-content: flex-end; width: 15%; border: 0px solid #fff; padding: 10px;}
    .header-print .topbar-v1 {
	background: #fff;
	border-top: solid 1px #f0f0f0;
	border-bottom: solid 1px #f0f0f0;
        margin: 0;
    }
</style>
  
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  
</head>

<body>
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
    </div>
    <div class="row">
        <div class="col col-sm-12">
            <table class="table table-striped table-bordered table-hover responsive"  width="100%">
                <tbody>
                    <tr><td >ใบรับรองการส่งตัวผู้ป่วยไปตรวจนอกสถานที่</td></tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="col col-sm-12">
            <table class="table table-striped table-bordered table-hover responsive"  width="100%">
                <tbody>
                    <tr><td><?php echo 'เลขที่ '.$doc;?></td><td><?php echo 'วันที่ '.$now['mday'].' '.$now['mon'].' ',$now['year'];?></td></tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="col col-sm-12">
            รพ. / สถานที่รับ
        </div>
    </div>
    <div class="row">
        <div class="col col-sm-12">
            <table class="header-print topbar-v1"  width="100%" id="aa">
                <tbody>
                    <tr><td><?php echo $br;?></td><td><?php echo $brCode;?></td><td></td></tr>
                    <tr><td colspan="3"><?php echo $hosp;?></td></tr>
                    <tr><td colspan="3"><?php echo $paid;?></td></tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="col col-sm-12">
            สำหรับผู้ส่ง
        </div>
    </div>
    <div class="row">
        <div class="col col-sm-12">
            <table class="table table-striped table-bordered table-hover responsive"  width="100%">
                <tbody>
                    <tr><td><?php echo $name;?></td><td><?php echo $hn;?></td><td>AN - </td></tr>
                    <tr><td colspan="3"><?php echo $id;?></td></tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

</body>
</html>
