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
$branchId="";
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
        ."Left Join b_branch br on br.branch_id = sup.branch_id "
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
        $branchId = ($row["branch_id"]);
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
        if($branchId===$row["branch_id"]){
            $oBranch .= '<option selected value='.$row["branch_id"].'>'.$row["branch_name"].'</option>';
        }else{
            $oBranch .= '<option value='.$row["branch_id"].'>'.$row["branch_name"].'</option>';
        }
    }
}else{
    echo mysqli_error($conn);
}
$sql="Select * From b_hospital Where active = '1' Order By hosp_name_t";
//$result = mysqli_query($conn,"Select * From f_company_type Where active = '1' Order By comp_type_code");
if ($result=mysqli_query($conn,$sql)){
    $oHosp = "<option value='0' selected='' disabled=''>เลือก โรงพยาบาล</option>";
    while($row = mysqli_fetch_array($result)){
        if($hospId===$row["hosp_id"]){
            $oHosp .= '<option selected value='.$row["hosp_id"].'>'.$row["hosp_name_t"].'</option>';
        }else{
            $oHosp .= '<option value='.$row["hosp_id"].'>'.$row["hosp_name_t"].'</option>';
        }
    }
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
                    <h2>รายละเอียด Supra </h2>	
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
                                    <section class="col col-3">
                                        <label class="label">HN</label>
                                        <label class="input"> <i class="icon-append fa fa-user"></i>
                                            <input type="text" name="supHN" id="supHN" value="<?php echo $supHN;?>" placeholder="HN">
                                    </section>
                                    <section class="col col-3">
                                        <label class="label">เลขบัตรประชาชน</label>
                                        <label class="input"> <i class="icon-append fa fa-user"></i>
                                            <input type="text" name="supPatID" id="supPatID" value="<?php echo $supPatID;?>" placeholder="เลขบัตรประชาชน">
                                    </section>
                                    <section class="col col-3">
                                        <label class="label">สิทธิ</label>
                                        <label class="select">
                                            <select name="supPaidT" id="supPaidT">
                                                <option value="0" disabled="disabled">เลือกประเภท สิทธิ</option>
                                                <option value="ปกส บางนา1">ปกส บางนา1</option>
                                                <option value="ปกส บางนา2">ปกส บางนา2</option>
                                                <option value="ปกส บางนา5">ปกส บางนา5</option>
                                            </select> <i></i> </label>
                                    </section>
                                    <section class="col col-3">
                                        <label class="label">ประเภท</label>
                                        <label class="select">
                                            <select name="supSupT" id="supType">
                                                <option value="0" disabled="disabled">เลือกประเภท ส่งตัว</option>
                                                <option value="ส่งตัว">ส่งตัว</option>
                                                <option value="Follow up">Follow up</option>
                                            </select> <i></i> </label>
                                    </section>
                                </div>
                                <div class="row">
                                    <section class="col col-6">
                                        <label class="label">ชื่อผู้ป่วย</label>
                                        <label class="input"> <i class="icon-append fa fa-user"></i>
                                            <input type="text" name="supPatName" id="supPatName" value="<?php echo $supPatName;?>" placeholder="ชื่อผู้ป่วย">
                                    </section>
                                    <section class="col col-6">
                                        <label class="label">นามสกุล</label>
                                        <label class="input"> <i class="icon-append fa fa-user"></i>
                                            <input type="text" name="supPatSurname" id="supPatSurname" value="<?php echo $supPatSurname;?>" placeholder="นามสกุล">
                                    </section>
                                </div>
                                <div class="row">
                                    <section class="col col-6">
                                        <label class="label">โรงพยาบาลที่ส่งตัว</label>
                                        <label class="select">
                                            <select name="supBranch" id="supBranch">
                                                <?php echo $oBranch;?>
                                            </select> <i></i> </label>
                                    </section>
                                    <section class="col col-6">
                                        <label class="label">โรงพยาบาลที่รับ (Supra)</label>
                                        <label class="select">
                                            <select name="supHosp" id="supHosp">
                                                <?php echo $oHosp;?>
                                            </select> <i></i> </label>
                                    </section>
                                </div>
                                <div class="row">
                                    <section class="col col-6">
                                        <label class="label">แพทย์ผู้ส่งตัว</label>
                                        <label class="input"> <i class="icon-append fa fa-user"></i>
                                            <input type="text" name="supDoctor" id="supDoctor" value="<?php echo $supDoctor;?>" placeholder="แพทย์ผู้ส่งตัว">
                                    </section>
                                    <section class="col col-4">
                                        <label class="label">ค่ารักษาพยาบาล</label>
                                        <label class="input"> <i class="icon-append fa fa-user"></i>
                                            <input type="number" name="supPaid" id="supPaid" step=any value="<?php echo $supPaid;?>" placeholder="ค่ารักษาพยาบาล">
                                    </section>
                                </div>
                                <div class="row">
                                    <section class="col col-6">
                                        <label class="label">ชื่อผู้ติดต่อ (ผู้ป่วย)</label>
                                        <label class="input"> <i class="icon-append fa fa-user"></i>
                                            <input type="text" name="supContactNameHosp" id="supContactNameHosp" value="<?php echo $supContactNameHosp;?>" placeholder="ชื่อผู้ติดต่อ (ผู้ป่วย)">
                                    </section>
                                    <section class="col col-4">
                                        <label class="label">เบอร์ผู้ติดต่อ (ผู้ป่วย)</label>
                                        <label class="input"> <i class="icon-append fa fa-user"></i>
                                            <input type="number" name="supContactTelHosp" id="supContactTelHosp" step=any value="<?php echo $supContactTelHosp;?>" placeholder="เบอร์ผู้ติดต่อ (ผู้ป่วย)">
                                    </section>
                                </div>
                                <div class="row">
                                    <section class="col col-6">
                                        <label class="label">ชื่อผู้ติดต่อ (Supra)</label>
                                        <label class="input"> <i class="icon-append fa fa-user"></i>
                                            <input type="text" name="supContactNamePat" id="supContactNamePat" value="<?php echo $supContactNamePat;?>" placeholder="แพทย์ผู้ส่งตัว">
                                    </section>
                                    <section class="col col-4">
                                        <label class="label">เบอร์ผู้ติดต่อ (Supra)</label>
                                        <label class="input"> <i class="icon-append fa fa-user"></i>
                                            <input type="number" name="supContactTelPat" id="supContactTelPat" step=any value="<?php echo $supContactTelPat;?>" placeholder="ค่ารักษาพยาบาล">
                                    </section>
                                </div>
                                <div class="row">
                                    <section class="col col-8">
                                        <label class="label">หมายเหตุ</label>
                                        <label class="input"> <i class="icon-append fa fa-user"></i>
                                            <input type="text" name="remark" id="remark" value="<?php echo $remark;?>" placeholder="หมายเหตุ">
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
<script type="text/javascript">
    pageSetUp();
    $("#uiLoading").hide();
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
    
    $('.datepicker').datepicker({
        format: 'dd/mm/yyyy',
        startDate: '-3d'
    });
    $("#btnSave").click(saveSupra);
    function saveSupra(){
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
                }
//                    alert('bbbbb '+json_obj.length);
//                    alert('ccccc '+$("#cDistrict").val());
                //$("#cZipcode").val("aaaa");
            }
        });
    }
</script>