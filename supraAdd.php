<?php require_once("inc/init.php"); ?>
<?php
session_start();
include 'UUID.php';
if (!isset($_SESSION['bn_user_staff_name'])) {
    //header("location: #login.php");
    $_SESSION['bn_page'] ="supraAdd.php";
    echo "<script>window.location.assign('#login.php');</script>";
}
//$custId="-";
$supId="";
$supraDoc="";
$supSupraDate="";
$supInputDate="";
$brId="";
$hospId="";
$supHN="";
$supPatID="";
$supPatName="";
$supPatSurname="";
$patAge="";
$supDoctor="";
$paidT="";
$remark="";
$supraTypeId="";
$supPaid="";
$supHosp="";
$supId="";
$supBranch="";
$supFlagNew="";
$branchCode="";
$supContactNameHosp="";
$supContactTelHosp="";
$supContactNamePat="";
$supContactTelPat="";
$supPatSex="";
$supPatStaff="";
$supPatSex1="";
$statusCar="";
$statusCar1="";
$supStatusTravel="";
$supStatusTravel1="";
$supDiseased1="";
$supDiseased2 ="";
$supDiseased3 ="";
$supDiseased4 ="";
$supDrg ="";
$supOnTop ="";
$reason="";
if(isset($_GET["supraId"])){
    $supId = $_GET["supraId"];
    $supFlagNew = "old";
    //$reRecId="aa";
    $backColor="style='background-color:white; '";
}else{
    $supId = UUID::v4();
    $supFlagNew = "new";
    $backColor="style='background-color:yellow; '";
}

$conn = mysqli_connect($hostDB,$userDB,$passDB,$databaseName);
mysqli_set_charset($conn, "UTF8");
$sql="Select sup.*, br.branch_name "
        ."From t_supra sup "
        ."Left Join b_branch br on br.branch_code = sup.branch_code "
        ."Where sup.supra_id = '".$supId."' ";
//echo "<script> alert('aaaaa'); </script>";
//$rComp = mysqli_query($conn,"Select * From b_company Where comp_id = '1' ");
//if ($rComp=mysqli_query($conn,$sql)){
if ($rComp=mysqli_query($conn,$sql) or die(mysqli_error($conn))){
    while($row = mysqli_fetch_array($rComp)){
        $supId = $row["supra_id"];
        $supraDoc = ($row["supra_doc"]);
        $supSupraDate = ($row["supra_date"]);
        $supInputDate = ($row["input_date"]);
        $supSupraDate = substr($supSupraDate,strlen($supSupraDate)-2)."-".substr($supSupraDate,5,2)."-".substr($supSupraDate,0,4);
        $supInputDate = substr($supInputDate,strlen($supInputDate)-2)."-".substr($supInputDate,5,2)."-".substr($supInputDate,0,4);
        $branchCode = ($row["branch_code"]);
        $hospId = ($row["hosp_id"]);
        $supHN = ($row["hn"]);
        $supPatID = ($row["pat_id"]);
        $supPatName = ($row["pat_name"]);
        $supPatSurname = ($row["pat_surname"]);
        $patAge = ($row["pat_age"]);
        $supDoctor = ($row["doctor_name"]);
        $paidT = ($row["paid_type_name"]);
        $remark = ($row["remark"]);
        $supraTypeId = ($row["supra_type_id"]);
        $supPaid = ($row["paid"]);
        $supHosp = ($row["hosp_id"]);
        $supBranch = ($row["branch_name"]);
        $supContactNameHosp = $row["contact_name_hosp"];
        $supContactTelHosp = $row["contact_tele_hosp"];
        $supContactNamePat = $row["contact_name_pat"];
        $supContactTelPat = $row["contact_tele_pat"];
        $supPatSex = $row["pat_sex"];
        $supPatStaff = $row["pat_staff"];
        $statusCar = $row["status_car"];//diseased1
        $supDiseased1 = $row["diseased1"];//diseased1
        $supDiseased2 = $row["diseased2"];//diseased1
        $supDiseased3 = $row["diseased3"];//diseased1
        $supDiseased4 = $row["diseased4"];//diseased1
        $supDrg = $row["drg"];
        $supOnTop = $row["on_top"];
        $supStatusTravel = $row["status_travel"];
        $reason = $row["reason"];
        if($supPatSex==="M"){
            $supPatSex1="true";
        }else{
            $supPatSex1="false";
        }
        if($statusCar==="1"){
            $statusCar1="true";
        }else{
            $statusCar1="false";
        }
        if($supStatusTravel==="1"){
            $supStatusTravel1="true";
        }else{
            $supStatusTravel1="false";
        }
    }
    //$aHosp = mysqli_fetch_array($rComp);
    
}else{
    echo mysqli_error($conn);
}
$sql="Select * From b_branch Where active = '1' Order By branch_name";
//$result = mysqli_query($conn,"Select * From f_company_type Where active = '1' Order By comp_type_code");
//if ($result=mysqli_query($conn,$sql)){
if ($result=mysqli_query($conn,$sql) or die(mysqli_error($conn))){
    $oBranch = "<option value='0' selected='' disabled=''>เลือก สาขา</option>";
    while($row = mysqli_fetch_array($result)){
        if($branchCode===$row["branch_code"]){
            $oBranch .= '<option selected value='.trim($row["branch_code"]).'>'.$row["branch_name"].'</option>';
        }else{
            $oBranch .= '<option value='.trim($row["branch_code"]).'>'.$row["branch_name"].'</option>';
        }
    }
}else{
    echo mysqli_error($conn);
}
$sql="Select * From b_hospital Where active = '1' Order By hosp_name_t";
//$result = mysqli_query($conn,"Select * From f_company_type Where active = '1' Order By comp_type_code");
if ($result=mysqli_query($conn,$sql)){
    $oHosp = "<option value='0' selected='' disabled=''>เลือก โรงพยาบาล</option>";
    while($row = mysqli_fetch_assoc($result)){
        if($hospId===$row["hosp_id"]){
            $oHosp .= '<option selected value='.$row["hosp_id"].'>'.$row["hosp_name_t"].'</option>';
        }else{
            $oHosp .= '<option value='.$row["hosp_id"].'>'.$row["hosp_name_t"].'</option>';
        }
    }
}
$sql="Select distinct doctor_name From t_supra Where active = '1'";
$autoDoctor = array();
if ($result=mysqli_query($conn,$sql)){
    while($row = mysqli_fetch_array($result)){
        //$autoDoctor .= $row['doctor_name'];
        array_push($autoDoctor,$row['doctor_name']);
        //$data[] = $row['skill'];
    }
    //$autoDoctor = substr($autoDoctor,0, strlen($autoDoctor)-1);
}
$sql="Select distinct pat_staff From t_supra Where active = '1'";
$autoStaff = array();
if ($result=mysqli_query($conn,$sql)){
    while($row = mysqli_fetch_array($result)){
        //$autoDoctor .= $row['doctor_name'];
        array_push($autoStaff,$row['pat_staff']);
        //$data[] = $row['skill'];
    }
    //$autoDoctor = substr($autoDoctor,0, strlen($autoDoctor)-1);
}
$rComp->free();
mysqli_close($conn);
?>
<div class="row">
	<div class="col-xs-12 col-sm-9 col-md-9 col-lg-9">
            <h1 class="page-title txt-color-blueDark">

                <!-- PAGE HEADER -->
                <i class="fa-fw fa fa-pencil-square-o"></i> 
                        Forms
                <span>>  
                        Form Layouts
                </span>
            </h1>
	</div>
	
	<div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
		
            <!-- Button trigger modal -->
            <a href="ajax/modal-content/model-content-2.html" data-toggle="modal" data-target="#remoteModal" class="btn btn-success btn-lg pull-right header-btn hidden-mobile">
                <i class="fa fa-circle-arrow-up fa-lg"></i> 
                Launch form modal
            </a>

            <!-- MODAL PLACE HOLDER -->
            <div class="modal fade" id="remoteModal" tabindex="-1" role="dialog" aria-labelledby="remoteModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content"></div>
                </div>
            </div>
            <!-- END MODAL -->
		
	</div>
</div>
<div class="alert alert-block alert-success" id="supAlert">
    <a class="close" data-dismiss="alert" href="#">×</a>
    <h4 class="alert-heading"><i class="fa fa-check-square-o"></i> Check validation!</h4>
    <p id="supVali">
            You may also check the form validation by clicking on the form action button. Please try and see the results below!
    </p>
</div>
<section id="widget-grid" class="">
    <div class="row">
        <article class="col-sm-12 col-md-12 col-lg-6">
            <div class="jarviswidget" id="wid-id-4" data-widget-editbutton="false" data-widget-custombutton="false">
                <header>
                    <span class="widget-icon"> <i class="fa fa-edit"></i> </span>
                    <h2>รายละเอียด ใบส่งตัวผู้ป่วย </h2>	
                </header>
                <div>
                    <div class="widget-body no-padding">
                        <form action="" id="smart-form-register" class="smart-form">
                            <fieldset>
                                <div class="row">
                                    <section class="col col-4">
                                        <label class="label">เลขที่เอกสาร</label>
                                        <label class="input"> <i class="icon-append fa fa-lock"></i>
                                            <input type="text" name="supraDoc" id="supraDoc" placeholder="เลขที่เอกสาร" value="<?php echo $supraDoc;?>">
                                            <input type="hidden" name="supId" id="supId" value="<?php echo $supId;?>">
                                            <input type="hidden" name="supFlagNew" id="supFlagNew" value="<?php echo $supFlagNew;?>">
                                            <b class="tooltip tooltip-bottom-right">Don't forget your password</b> </label>
                                    </section>
                                    <section class="col col-4">
                                        <label class="label">วันที่ป้อน</label>
                                        <label class="input"> <i class="icon-append fa fa-user"></i>
                                            <input type="text" name="supInputDate" id="supInputDate" value="<?php echo $supInputDate;?>" placeholder="วันที่ป้อน" class="datepicker" data-date-format="dd/mm/yyyy">
                                    </section>
                                    <section class="col col-4">
                                        <label class="label">วันที่สงตัว</label>
                                        <label class="input"> <i class="icon-append fa fa-user"></i>
                                            <input type="text" name="supSupraDate" id="supSupraDate" value="<?php echo $supSupraDate;?>" placeholder="วันที่สงตัว" class="datepicker" data-date-format="dd/mm/yyyy">
                                    </section>
                                </div>
                                <div class="row">
                                    <section class="col col-2">
                                        <label class="label">HN</label>
                                        <label class="input"> <i class="icon-append fa fa-user"></i>
                                            <input type="text" name="supHN" id="supHN" value="<?php echo $supHN;?>" placeholder="HN">
                                    </section>
                                    <section class="col col-3">
                                        <label class="label">เลขบัตรประชาชน</label>
                                        <label class="input"> <i class="icon-append fa fa-user"></i>
                                            <input type="text" name="supPatID" id="supPatID" value="<?php echo $supPatID;?>" placeholder="เลขบัตรประชาชน">
                                    </section>
                                    <section class="col col-1">
                                        <label class="label">&nbsp;</label>
                                        <!--<button type="button" id="btnSearchHn" class="btn btn-primary">...</button>-->
                                        <ul class="demo-btns">
                                            <li id="btnSearchHn">
                                                <a href="javascript:void(0);" class="btn bg-color-blue txt-color-white"><i id="loadingSearch" class="fa fa-gear fa-2x fa-spin"></i></a>
                                            </li>
                                        </ul>
                                    </section>
                                    <section class="col col-3">
                                        <label class="label">สิทธิ</label>
                                        <label class="select">
                                            <select name="supPaidT" id="supPaidT">
                                                <option value="0" disabled="disabled">เลือกประเภท สิทธิ</option>
                                                <option value="2210028">ปกส บางนา1</option>
                                                <option value="2211006">ปกส บางนา2</option>
                                                <option value="2211041">ปกส บางนา5</option>
                                            </select> <i></i> </label>
                                    </section>
                                    <section class="col col-3">
                                        <label class="label">ประเภท</label>
                                        <label class="select">
                                            <select name="supType" id="supType">
                                                <option value="0" disabled="disabled">เลือกประเภท ส่งตัว</option>
                                                <option value="ส่งตัว">ส่งตัว</option>
                                                <option value="Follow up">Follow up</option>
                                            </select> <i></i> </label>
                                    </section>
                                </div>
                                <div class="row">
                                    <section class="col col-5">
                                        <label class="label">ชื่อผู้ป่วย</label>
                                        <label class="input"> <i class="icon-append fa fa-user"></i>
                                            <input type="text" name="supPatName" id="supPatName" value="<?php echo $supPatName;?>" placeholder="ชื่อผู้ป่วย">
                                    </section>
                                    <section class="col col-5">
                                        <label class="label">นามสกุล</label>
                                        <label class="input"> <i class="icon-append fa fa-user"></i>
                                            <input type="text" name="supPatSurname" id="supPatSurname" value="<?php echo $supPatSurname;?>" placeholder="นามสกุล">
                                    </section>

                                    <section class="col col-2">
                                        <label class="label">&nbsp;</label>
                                        <label class="toggle state-error"><input type="checkbox" name="supPatSex" id="supPatSex" <?php echo $supPatSex1;?>><i data-swchon-text=" ชาย" data-swchoff-text=" หญิง"></i>เพศ</label>
                                    </section>
                                </div>
                                <div class="row">
                                    <section class="col col-5">
                                        <label class="label">โรงพยาบาลที่ส่งตัว</label>
                                        <label class="select">
                                            <select name="supBranch" id="supBranch">
                                                <?php echo $oBranch;?>
                                            </select> <i></i> </label>
                                    </section>
                                    <section class="col col-5">
                                        <label class="label">โรงพยาบาลที่รับ (Supra)</label>
                                        <label class="select">
                                            <select name="supHosp" id="supHosp">
                                                <?php echo $oHosp;?>
                                            </select> <i></i> </label>
                                    </section>
                                    <section class="col col-2">
                                        <label class="label">อายุ</label>
                                        <label class="input"> <i class="icon-append fa fa-user"></i>
                                            <input type="number" name="patAge" id="patAge" step="any" value="<?php echo $patAge;?>" placeholder="อายุ">
                                    </section>
                                </div>
                                <div class="row">
                                    <section class="col col-6">
                                        <label class="label">แพทย์ผู้ส่งตัว</label>
                                        <label class="input"> 
                                            <input type="text" name="supDoctor" id="supDoctor" value="<?php echo $supDoctor;?>" placeholder="แพทย์ผู้ส่งตัว">
                                            <div id="log" class="font-xs margin-top-10 text-danger"></div>
                                    </section>
                                    
                                    <section class="col col-3">
                                        <label class="label">&nbsp;</label>
                                        <label class="toggle state-error"><input type="checkbox" name="chkStatusCar" id="chkStatusCar" <?php echo $statusCar1;?> ><i data-swchon-text=" ผู้ส่ง" data-swchoff-text=" ผู้รับ"></i>รถรับส่ง</label>
                                    </section>
                                    <section class="col col-3">
                                        <label class="label">&nbsp;</label>
                                        <label class="toggle state-error"><input type="checkbox" name="chkStatusTravel" id="chkStatusTravel" <?php echo $supStatusTravel;?> ><i data-swchon-text=" ผู้ป่วยเดินทางเอง" data-swchoff-text=" โรงพยาบาลไปส่ง"></i>การเดินทาง</label>
                                    </section>
                                </div>
                                <div class="row">
                                    <section class="col col-6">
                                        <label class="label">ชื่อผู้ติดต่อ (Supra)</label>
                                        <label class="input"> <i class="icon-append fa fa-user"></i>
                                            <input type="text" name="supContactNameHosp" id="supContactNameHosp" value="<?php echo $supContactNameHosp;?>" placeholder="ชื่อผู้ติดต่อ (Supra)">
                                    </section>
                                    <section class="col col-4">
                                        <label class="label">เบอร์ผู้ติดต่อ (Supra)</label>
                                        <label class="input"> <i class="icon-append fa fa-user"></i>
                                            <input type="number" name="supContactTelHosp" id="supContactTelHosp"  value="<?php echo $supContactTelHosp;?>" placeholder="เบอร์ผู้ติดต่อ (Supra)">
                                    </section>
                                </div>
                                <div class="row">
                                    <section class="col col-6">
                                        <label class="label">ชื่อผู้ติดต่อ (ผู้ป่วย)</label>
                                        <label class="input"> <i class="icon-append fa fa-user"></i>
                                            <input type="text" name="supContactNamePat" id="supContactNamePat" value="<?php echo $supContactNamePat;?>" placeholder="แพทย์ผู้ส่งตัว">
                                    </section>
                                    <section class="col col-4">
                                        <label class="label">เบอร์ผู้ติดต่อ (ผู้ป่วย)</label>
                                        <label class="input"> <i class="icon-append fa fa-user"></i>
                                            <input type="number" name="supContactTelPat" id="supContactTelPat"  value="<?php echo $supContactTelPat;?>" placeholder="เบอร์ผู้ติดต่อ (ผู้ป่วย)">
                                    </section>
                                </div>
                                <div class="row">
                                    <section class="col col-5">
                                        <label class="label">เจ้าหน้าที่ผู้รับผิดชอบ</label>
                                        <label class="input"> <i class="icon-append fa fa-user"></i>
                                            <input type="text" name="supPatStaff" id="supPatStaff" value="<?php echo $supPatStaff;?>" placeholder="เจ้าหน้าที่ผู้รับผิดชอบ">
                                    </section>
                                    <section class="col col-3">
                                        <label class="label">เหตุผลการส่งตัว</label>
                                        <label class="select"><select name="supReason" id="supReason">
                                                <option value="1">การวินิจฉัย</option>
                                                <option value="2">รักษาจนเสร็จ</option>
                                                <option value="3">ขอทราบผล</option>
                                                <option value="4">รักษาเบื้องต้น</option>
                                                <option value="5">อื่นๆ</option>
                                            </select> <i></i> </label>
                                    </section>
                                    <section class="col col-4">
                                        <label class="label">&nbsp;</label>
                                        <label class="input"> <i class="icon-append fa fa-user"></i>
                                            <input type="text" name="supContactTelPat" id="supContactTelPat" value="<?php echo $supContactTelPat;?>" placeholder="เหตุผลการส่งตัว อื่นๆ">
                                    </section>
                                </div>
                                <div class="row">
                                    <section class="col col-6">
                                        <label class="label">โรค 1.</label>
                                        <label class="input"> <i class="icon-append fa fa-user"></i>
                                            <input type="text" name="supDiseased1" id="supDiseased1" value="<?php echo $supDiseased1;?>" placeholder="โรค 1.">
                                    </section>
                                    <section class="col col-6">
                                        <label class="label">โรค 2.</label>
                                        <label class="input"> <i class="icon-append fa fa-user"></i>
                                            <input type="text" name="supDiseased2" id="supDiseased2" value="<?php echo $supDiseased2;?>" placeholder="โรค 2.">
                                    </section>
                                </div>
                                <div class="row">
                                    <section class="col col-6">
                                        <label class="label">โรค 3.</label>
                                        <label class="input"> <i class="icon-append fa fa-user"></i>
                                            <input type="text" name="supDiseased3" id="supDiseased3" value="<?php echo $supDiseased3;?>" placeholder="โรค 1.">
                                    </section>
                                    <section class="col col-6">
                                        <label class="label">โรค 4.</label>
                                        <label class="input"> <i class="icon-append fa fa-user"></i>
                                            <input type="text" name="supDiseased4" id="supDiseased4" value="<?php echo $supDiseased4;?>" placeholder="โรค 2.">
                                    </section>
                                </div>
                                <div class="row">
                                    <section class="col col-8">
                                        <label class="label">หมายเหตุ</label>
                                        <label class="input"> <i class="icon-append fa fa-user"></i>
                                            <input type="text" name="remark" id="remark" value="<?php echo $remark;?>" placeholder="หมายเหตุ">
                                    </section>
                                    <section class="col col-2">    
                                        <label class="label">&nbsp;</label>
                                        <label class="toggle state-error"><input type="checkbox" name="chkSupraVoid" checked="true" id="chkSupraVoid"><i data-swchon-text="ใช้งาน" data-swchoff-text="ยกเลิก"></i>สถานะ</label>
                                    </section>
                                    <section class="col col-2" >    
                                        <label class="label">&nbsp;&nbsp;</label>
                                        <button type="button" id="btnSupraVoid" class="btn btn-primary btn-sm">ต้องการยกเลิก</button>
                                    </section>
                                </div>
                                <div class="row" id="divDrg">
                                    <section class="col col-4">
                                        <label class="label">ค่ารักษาพยาบาล</label>
                                        <label class="input"> <i class="icon-append fa fa-user"></i>
                                            <input type="number" name="supPaid" id="supPaid" step=any value="<?php echo $supPaid;?>" placeholder="ค่ารักษาพยาบาล">
                                    </section>
                                    <section class="col col-4">
                                        <label class="label">DRG</label>
                                        <label class="input"> <i class="icon-append fa fa-user"></i>
                                            <input type="text" name="supDrg" id="supDrg" value="<?php echo $supDrg;?>" placeholder="DRG">
                                    </section>
                                    <section class="col col-4">
                                        <label class="label">on TOP</label>
                                        <label class="input"> <i class="icon-append fa fa-user"></i>
                                            <input type="text" name="supOnTop" id="supOnTop" value="<?php echo $supOnTop;?>" placeholder="on TOP">
                                    </section>
                                </div>
                            </fieldset>
                            <footer>
                                <div class="row">
                                    <section class="col col-3 ">
                                        <button type="button" id="btnSave" class="btn btn-primary">
                                                บันทึกข้อมูล
                                        </button>
                                    </section>
                                    <section class="col col-3 ">
                                        <button type="button" id="btnPrint" class="btn btn-primary">
                                                Print
                                        </button>
                                    </section>
                                    <section class="col col-3 ">
                                        <ul class="demo-btns">
                                            <li id="uiLoading">
                                                <a href="javascript:void(0);" class="btn bg-color-blue txt-color-white"><i id="loading" class="fa fa-gear fa-2x fa-spin"></i></a>
                                            </li>
                                        </ul>
                                    </section>
                                </div>
                            </footer>
                        </form>
                    </div>
                </div>
            </div>
        </article>
    </div>
</section>
<script>
  $( function() {//$autoDoctor
    var availableTags =  <?php echo json_encode($autoDoctor); ?>;
    $( "#supDoctor" ).autocomplete({
      source: availableTags
    });
  } );
  $( function() {//$autoStaff
    var availableTags =  <?php echo json_encode($autoStaff); ?>;
    $( "#supPatStaff" ).autocomplete({
      source: availableTags
    });
  } );
</script>
<script type="text/javascript">
    $(document).ready(function() {
        pageSetUp();
        $("#uiLoading").hide();
        $("#supAlert").hide();
        // START AND FINISH DATE
        $('#supInputDate').datepicker({
            dateFormat : 'dd.mm.yy',
            prevText : '<i class="fa fa-chevron-left"></i>',
            nextText : '<i class="fa fa-chevron-right"></i>',
            onSelect : function(selectedDate) {
                $('#supInputDate').datepicker('option', 'minDate', selectedDate);
            }
        });
        loadScript("js/plugin/jquery-form/jquery-form.min.js", pagefunction);
        <?php
            echo "var supraTypeId = \"" . $supraTypeId . "\";";        
            echo "var paidT = \"" . $paidT . "\";";
        ?>
        //$('.supType option[value='+supraTypeId+']').attr('selected','selected');
        //alert(supraTypeId);
        $("#supType").val(supraTypeId);
        $("#supPaidT").val(paidT);
        $('.datepicker').datepicker({
            format: 'dd/mm/yyyy',
            startDate: '-3d'
        });
        $("#supPatSex").prop("checked", <?php echo $supPatSex1?>);
        $("#chkStatusCar").prop("checked", <?php echo $statusCar1?>);
        $("#chkStatusTravel").prop("checked", <?php echo $supStatusTravel1?>);
        $("#supReason").val(<?php echo $reason?>);
        $("#btnSave").click(saveSupra);
        $("#btnSearchHn").click(getHN);
        //$("#divDrg").hide();
        $("#chkSupraVoid").click(checkBtnVoid);
        $("#btnSupraVoid").click(voidSupra);
        $("#loadingSearch").removeClass("fa-spin");
        hideBtnVoid();
        function checkBtnVoid(){
            if($("#chkSupraVoid").is(':checked'))
                $("#btnSupraVoid").hide();  // checked
            else
                $("#btnSupraVoid").show();  // unchecked
//            $("#btnGoVoid").show();
        }
        function hideBtnVoid(){
            $("#btnSupraVoid").hide();
        }
        function voidSupra(){
            $("#uiLoading").show();
            $("#loading").addClass("fa-spin");
            //$("#veAmphur").empty();
            $.confirm({
                title: 'ต้องการยกเลิก สินค้า!',
                content: 'ยกเลิก เลขที่เอกสาร '+$("#supraDoc").val()+' ชื่อผู้ป่วย '+$("#supPatName").val()+' '+$("#supPatSurname").val(),
                buttons: {
                    confirm: function () {
                        //$.alert("hello222 "+td.attr("id"));
                        voidSupra1();
                        //voidStock();
                    },
                    cancel: function () {
                        $.alert('Canceled!');
                    }
                }
            });
        }
        function voidSupra1(){
            //$.alert("hello222 "+$("#veId").val());
            $.ajax({ 
                type: 'GET', url: 'saveData.php', contentType: "application/json", dataType: 'text', data: { 'sup_id': $("#supId").val(), 'flagPage':"void_supra" }, 
                success: function (data) {
//                    alert('bbbbb'+data);
                    var json_obj = $.parseJSON(data);
                    $("#loading").removeClass("fa-spin");
                    $("#uiLoading").hide();
                    $("#supVali").empty();
                    for (var i in json_obj)
                    {
//                        $.alert({
//                            title: 'Save Data',
//                            content: 'ยกเลิกข้อมูลเรียบร้อย',
//                        });
                        window.location.assign('#supraView.php');
                    }
                }
            });
        }
//        $("#supDoctor").autocomplete({
//            source : function(request, response) {
////                alert("bbbb");
//                $.ajax({
//                    type: 'GET',  url : "getAmphur.php", contentType: "application/json", dataType : "text",
//                    data : {
//                        featureClass : "P",
//                        style : "full",
//                        maxRows : 12,
//                        flagPage: "searchDoctor",
//                        name_startsWith : request.term
//                    },
//                    success : function(data) {
////                       alert("aaaa"+data);
//                       //var json_obj = $.parseJSON(data);
//                       //alert("aaaa"+json_obj);
//                        response($.map(data, function(item) {
//                            return {
//                                    label : item.name ,value : item.name
//                            }
//                        }));
//                    }
//                });
//            },
//            minLength : 2,
//            select : function(event, ui) {
//                    log(ui.item ? "Selected: " + ui.item.label : "Nothing selected, input was " + this.value);
//            }
//        });
    });
    
    
    function saveSupra(){
        if($("#supInputDate").val()==""){
            $.alert({
                title: 'Validate Data',
                content: 'วันที่ป้อน ไม่มีค่า',
            });
            $("#supAlert").show();
            $("#supVali").empty();
            $("#supVali").append("วันที่ป้อน ไม่มีค่า");
            return;
        }
        if($("#supSupraDate").val()==""){
            $.alert({
                title: 'Validate Data',
                content: 'วันที่สงตัว ไม่มีค่า',
            });
            $("#supAlert").show();
            $("#supVali").empty();
            $("#supVali").append("วันที่สงตัว ไม่มีค่า");
            return;
        }
        var suppatSex = "", statusCar="", statusTravel="";
        
        if($("#supPatSex").is(':checked')){
            suppatSex = "M";
        }else{
            suppatSex = "F";
        }
        if($("#chkStatusCar").is(':checked')){
            statusCar = "1";
        }else{
            statusCar = "0";
        }
        if($("#chkStatusTravel").is(':checked')){
            statusTravel = "1";
        }else{
            statusTravel = "0";
        }
        $("#uiLoading").show();
        $("#loading").addClass("fa-spin");
        $.ajax({
            type: 'GET', url: 'saveData.php', contentType: "application/json", dataType: 'text', 
            data: { 'supra_id': $("#supId").val()
                ,'supra_doc': $("#supraDoc").val()
                ,'input_date': $("#supInputDate").val()
                ,'supra_date': $("#supSupraDate").val()
                ,'hn': $("#supHN").val()
                ,'pat_id': $("#supPatID").val()
                ,'paid_type_name': $("#supPaidT").val()
                ,'supra_type_id': $("#supType").val()
                ,'pat_name': $("#supPatName").val()
                ,'pat_surname': $("#supPatSurname").val()
                ,'branch_id': $("#supBranch").val()
                ,'hosp_id': $("#supHosp").val()
                ,'doctor_name': $("#supDoctor").val()
                ,'paid': $("#supPaid").val()
                ,'remark': $("#remark").val()
                ,'contact_name_hosp': $("#supContactNameHosp").val()
                ,'contact_tel_hosp': $("#supContactTelHosp").val()
                ,'contact_name_pat': $("#supContactNamePat").val()
                ,'contact_tel_pat': $("#supContactTelPat").val()
                ,'pat_sex': suppatSex
                ,'status_car': statusCar
                ,'status_travel': statusTravel
                ,'pat_age': $("#patAge").val()
                ,'reason': $("#supReason").val()
                ,'pat_staff': $("#supPatStaff").val()
                ,'diseased1': $("#supDiseased1").val()
                ,'diseased2': $("#supDiseased2").val()
                ,'diseased3': $("#supDiseased3").val()
                ,'diseased4': $("#supDiseased4").val()
                ,'drg': $("#supDrg").val()
                ,'on_top': $("#supOnTop").val()
                ,'flag_new': $("#supFlagNew").val()
                ,'flagPage': "supra" }, 
            success: function (data) {
                //alert('bbbbb'+data);
                var json_obj = $.parseJSON(data);
                for (var i in json_obj){
                    //alert("aaaa "+json_obj[i].success);
                    $.alert({
                        title: 'Save Data',
                        content: 'บันทึกข้อมูลเรียบร้อย',
                    });
                    $("#loading").removeClass("fa-spin");
                    $("#uiLoading").hide();
                    $("#supVali").empty();
                    $("#supVali").append("บันทึกข้อมูลเรียบร้อย");
                    $("#btnSave").prop("disabled", true);
                }
//                    alert('bbbbb '+json_obj.length);
//                    alert('ccccc '+$("#cDistrict").val());
                //$("#cZipcode").val("aaaa");
            }
        });
    }
    function getHN(){
        //alert('aaaaa');
        $("#loadingSearch").addClass("fa-spin");
        $.ajax({
            type: 'GET', url: 'getAmphur.php', contentType: "application/json", dataType: 'text', 
            data: { 'pat_id': $("#supPatID").val(),'hn': $("#supHN").val(),'flagPage': "get_hn" }, 
            success: function (data) {
//                alert('bbbbb'+data);
                var json_obj = $.parseJSON(data);
                for (var i in json_obj){
                    $("#supPatName").val(json_obj[i].pname+' '+json_obj[i].fname);
                    $("#supPatSurname").val(json_obj[i].lname);
                    $("#patAge").val(json_obj[i].age);
                    $("#supPaidT").val(json_obj[i].hosp_code);
                    if(json_obj[i].hosp_code==="2210028"){
                        $("#supBranch").val("000");
                    }else if(json_obj[i].hosp_code==="2211006"){
                        $("#supBranch").val("001");
                    }else if(json_obj[i].hosp_code==="2211041"){
                        $("#supBranch").val("002");
                    }
                    if(json_obj[i].pname==="นาง"){
                        //alert("aaaaa");
                        $("#supPatSex").attr('checked', false);                        
                    }else if(json_obj[i].pname==="นาย"){
                        //alert("bbbb");
                        $("#supPatSex").attr('checked', true);                        
                    }
                    $("#supHN").val(json_obj[i].hn);
                    $("#supPatID").val(json_obj[i].id);
                    $("#loadingSearch").removeClass("fa-spin");
                }
//                    alert('bbbbb '+json_obj.length);
//                    alert('ccccc '+$("#cDistrict").val());
                //$("#cZipcode").val("aaaa");
            }
        });
    }
    
</script>