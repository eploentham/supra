<?php require_once("inc/init.php"); ?>
<?php
session_start();
if (!isset($_SESSION['bn_user_staff_name'])) {
    //header("location: #login.php");
    $_SESSION['bn_page'] ="hospitalAdd.php";
    echo "<script>window.location.assign('#login.php');</script>";
}
//$custId="-";
$hoCode="";
if(isset($_GET["hospId"])){
    $hoId = $_GET["hospId"];
}else{
    $hoId="";
}
$hoProvName1="";
$hoAmpName1="";
$hoDisName1="";
$hoEmail="";
$oProv1 = $oProv;
$conn = mysqli_connect($hostDB,$userDB,$passDB,$databaseName);
mysqli_set_charset($conn, "UTF8");
$sql="Select ho.*, prov.prov_name, amp.amphur_name, dis.district_name "
        ."From b_hospital ho "
        ."Left Join provinces prov on ho.prov_id = prov.prov_id "
        ."Left join amphures amp on ho.amphur_id = amp.amphur_id "
        ."Left Join districts dis on ho.district_id = dis.district_id "
        ."Where hosp_id = '".$hoId."' ";
//echo "<script> alert('aaaaa'); </script>";
//$rComp = mysqli_query($conn,"Select * From b_company Where comp_id = '1' ");
//if ($rComp=mysqli_query($conn,$sql)){
if ($rComp=mysqli_query($conn,$sql) or die(mysqli_error($conn))){
    $aHosp = mysqli_fetch_array($rComp);
    $hoId = $aHosp["hosp_id"];
    $hoCode = ($aHosp["hosp_code"]);
    $hoNameT = ($aHosp["hosp_name_t"]);
    $hoAddress = ($aHosp["hosp_address_t"]);
    $hoTele = ($aHosp["tele"]);
    $hoEmail = $aHosp["email"];
    $hoZipcode = ($aHosp["zipcode"]);
    $hoProvId = ($aHosp["prov_id"]);
    $hoProvName = ($aHosp["prov_name"]);
    $hoAmpName = ($aHosp["amphur_name"]);
    $hoDisName = ($aHosp["district_name"]);
    $hoAmphurId = ($aHosp["amphur_id"]);
    $hoDistrictId = ($aHosp["district_id"]);
    $hoTaxId = ($aHosp["tax_id"]);
    $hoContactName1 = ($aHosp["contact_name1"]);
    $hoContactTel1 = ($aHosp["contact_tel1"]);
    $hoContactName2 = ($aHosp["contact_name2"]);
    $hoContactTel2 = ($aHosp["contact_tel2"]);
    if(isset($hoProvId)){
        $cnt=1;
        $bb = strval($aHosp["prov_id"]);
        $aa = '<option selected value='.$bb.">".$hoProvName."</option>";
        $oProv1 = str_replace("selected=''", "", $oProv1);
        $oProv1 = str_replace('<option value='.$bb.">".$hoProvName."</option>", $aa, $oProv1,$cnt);
        
    }
    if(isset($hoAmpName)){
        $hoAmpName1 = "<option value='0' disabled=''>เลือกอำเภอ</option>";
        $hoAmpName1 .= "<option selected='true' value='".$hoAmphurId."'>".$hoAmpName."</option>";
    }else{
        $hoAmpName1 = $oProv;
    }
    if(isset($hoDisName)){
        $hoDisName1 = "<option value='0' disabled=''>เลือกตำบล</option>";
        $hoDisName1 .= "<option selected='true' value='".$hoDistrictId."'>".$hoDisName."</option>";
    }else{
        $hoDisName1 = $oProv;
    }
}else{
    echo mysqli_error($conn);
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

<div class="alert alert-block alert-success" id="hospAlert">
    <a class="close" data-dismiss="alert" href="#">×</a>
    <h4 class="alert-heading"><i class="fa fa-check-square-o"></i> Check validation!</h4>
    <p id="hospVali">
            You may also check the form validation by clicking on the form action button. Please try and see the results below!
    </p>
</div>

<!-- widget grid -->
<section id="widget-grid" class="">
    <!-- START ROW -->
    <div class="row">
        <!-- NEW COL START -->
        <article class="col-sm-12 col-md-12 col-lg-6">
            <!-- Widget ID (each widget will need unique ID)-->
            <div class="jarviswidget" id="wid-id-4" data-widget-editbutton="false" data-widget-custombutton="false">
                <!-- widget options:
                        usage: <div class="jarviswidget" id="wid-id-0" data-widget-editbutton="false">

                        data-widget-colorbutton="false"	
                        data-widget-editbutton="false"
                        data-widget-togglebutton="false"
                        data-widget-deletebutton="false"
                        data-widget-fullscreenbutton="false"
                        data-widget-custombutton="false"
                        data-widget-collapsed="true" 
                        data-widget-sortable="false"

                -->
                <header>
                    <span class="widget-icon"> <i class="fa fa-edit"></i> </span>
                    <h2>รายละเอียด โรงพยาบาล </h2>				

                </header>

                <!-- widget div-->
                <div>

                        <!-- widget edit box -->
                    <div class="jarviswidget-editbox">
                            <!-- This area used as dropdown edit box -->
                    </div>
                    <!-- end widget edit box -->

                    <!-- widget content -->
                    <div class="widget-body no-padding">

                        <form action="" id="smart-form-register" class="smart-form">
                            <fieldset>
                                <div class="row">
                                    <section class="col col-4">
                                        <label class="label">code</label>
                                        <label class="input"> <i class="icon-append fa fa-lock"></i>
                                            <input type="text" name="hoCode" id="hoCode" placeholder="รหัส1" value="<?php echo $hoCode;?>">
                                            <b class="tooltip tooltip-bottom-right">Don't forget your password</b> </label>
                                    </section>
                                    <section class="col col-8">
                                        <label class="label">ชื่อโรงพยาบาล</label>
                                        <label class="input"> <i class="icon-append fa fa-user"></i>
                                            <input type="text" name="hoNameT" id="hoNameT" value="<?php echo $hoNameT;?>" placeholder="ชื่อโรงพยาบาล">
                                            <input type="hidden" name="hoId" id="hoId" value="<?php echo $hoId;?>">
                                            <b class="tooltip tooltip-bottom-right">Needed to enter the website</b> </label>
                                    </section>
                                </div>
                                

                                <section >
                                    <label class="label">ที่อยู่</label>
                                    <label class="input"> <i class="icon-append fa fa-envelope-o"></i>
                                        <input type="text" name="hoAddress" id="hoAddress" value="<?php echo $hoAddress;?>" placeholder="ที่อยู่ บ้านเลขที่ ซอย ถนน">
                                        <b class="tooltip tooltip-bottom-right">Needed to verify your account</b> </label>
                                </section >
                                <div class="row">
                                    <section class="col col-6">
                                        <label class="label">ตำบล</label>
                                        <label class="select">
                                            <select name="hoDistrict" id="hoDistrict">
                                                <?php echo $hoDisName1;?>
                                            </select> <i></i> </label>
                                    </section>
                                    <section class="col col-6">
                                        <label class="label">อำเภอ</label>
                                        <label class="select">
                                            <select name="hoAmphur" id="hoAmphur">
                                                <?php echo $hoAmpName1;?>
                                            </select> <i></i> </label>
                                    </section>
                                </div>
                                
                                <div class="row">
                                    <section class="col col-6">
                                        <label class="label">จังหวัด</label>
                                        <label class="select">
                                            <select name="hoProv" id="hoProv">
                                                <?php echo $oProv1;?>
                                            </select> <i></i> </label>
                                    </section>

                                    <section class="col col-6">
                                        <label class="label">รหัสไปรษณีย์</label>
                                        <label class="input"> <i class="icon-append fa fa-lock"></i>
                                            <input type="text" name="hoZipcode" id="hoZipcode" placeholder="รหัสไปรษณีย์" value="<?php echo $hoZipcode;?>">
                                            <b class="tooltip tooltip-bottom-right">Don't forget your password</b> </label>
                                    </section>
                                </div>
                                
                                <div class="row">
                                    <section class="col col-4">
                                        <label class="label">โทรศัพท์</label>
                                        <label class="input"> <i class="icon-prepend fa fa-phone"></i>
                                            <input type="tel" name="hoTele" id="hoTele" placeholder="Phone" data-mask="(999) 999-9999" value="<?php echo $hoTele;?>"></label>
                                    </section>
                                    <section class="col col-4">
                                        <label class="label">Email</label>
                                        <label class="input"> <i class="icon-append fa fa-envelope-o"></i>
                                            <input type="email" name="hoEmail" id="hoEmail" placeholder="Email" value="<?php echo $hoEmail;?>">
                                            <b class="tooltip tooltip-bottom-right">Needed to verify your account</b> </label>
                                    </section >
                                    <section class="col col-4">
                                        <label class="label">เลขที่ผู้เสียภาษี</label>
                                        <label class="input"> <i class="icon-append fa fa-envelope-o"></i>
                                            <input type="text" name="hoTaxId" id="hoTaxId" placeholder="เลขที่ผู้เสียภาษี" value="<?php echo $hoTaxId;?>">
                                            <b class="tooltip tooltip-bottom-right">Needed to verify your account</b> </label>
                                    </section >
                                </div>
                                <div class="row">
                                    <section class="col col-3">
                                        <label class="label">ชื่อผู้ติดต่อ1</label>
                                        <label class="input"> <i class="icon-prepend fa fa-phone"></i>
                                            <input type="text" name="hoContactName1" id="hoContactName1" placeholder="ชื่อผู้ติดต่อ1"  value="<?php echo $hoContactName1;?>"></label>
                                    </section>
                                    <section class="col col-3">
                                        <label class="label">เบอร์ผู้ติดต่อ1</label>
                                        <label class="input"> <i class="icon-append fa fa-envelope-o"></i>
                                            <input type="tel" name="hoContactTel1" id="hoContactTel1" placeholder="เบอร์ผู้ติดต่อ1" data-mask="(999) 999-9999" value="<?php echo $hoContactTel1;?>">
                                            <b class="tooltip tooltip-bottom-right">Needed to verify your account</b> </label>
                                    </section >                                
                                    <section class="col col-3">
                                        <label class="label">ชื่อผู้ติดต่อ2</label>
                                        <label class="input"> <i class="icon-prepend fa fa-phone"></i>
                                            <input type="text" name="hoContactName2" id="hoContactName2" placeholder="ชื่อผู้ติดต่อ2"  value="<?php echo $hoContactName2;?>"></label>
                                    </section>
                                    <section class="col col-3">
                                        <label class="label">เบอร์ผู้ติดต่อ2</label>
                                        <label class="input"> <i class="icon-append fa fa-envelope-o"></i>
                                            <input type="tel" name="hoContactTel2" id="hoContactTel2" placeholder="เบอร์ผู้ติดต่อ2" data-mask="(999) 999-9999" value="<?php echo $hoContactTel2;?>">
                                            <b class="tooltip tooltip-bottom-right">Needed to verify your account</b> </label>
                                    </section >
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
                    <!-- end widget content -->
                </div>
                        <!-- end widget div -->
            </div>
            <!-- end widget -->				
        </article>
        <!-- END COL -->
    </div>
    <!-- END ROW -->
</section>
<!-- end widget grid -->

		
<!-- SCRIPTS ON PAGE EVENT -->
<script type="text/javascript">
	
	/* DO NOT REMOVE : GLOBAL FUNCTIONS!
	 *
	 * pageSetUp(); WILL CALL THE FOLLOWING FUNCTIONS
	 *
	 * // activate tooltips
	 * $("[rel=tooltip]").tooltip();
	 *
	 * // activate popovers
	 * $("[rel=popover]").popover();
	 *
	 * // activate popovers with hover states
	 * $("[rel=popover-hover]").popover({ trigger: "hover" });
	 *
	 * // activate inline charts
	 * runAllCharts();
	 *
	 * // setup widgets
	 * setup_widgets_desktop();
	 *
	 * // run form elements
	 * runAllForms();
	 *
	 ********************************
	 *
	 * pageSetUp() is needed whenever you load a page.
	 * It initializes and checks for all basic elements of the page
	 * and makes rendering easier.
	 *
	 */

	pageSetUp();
	
	
	// PAGE RELATED SCRIPTS

	// pagefunction
	
	var pagefunction = function() {
						
		var $registerForm = $("#smart-form-register").validate({

			// Rules for form validation
			rules : {
                            compName : {
                                required : true
                            },
                            email : {
                                required : true,
                                email : true
                            },
                            password : {
                                required : true,
                                minlength : 3,
                                maxlength : 20
                            },
                            passwordConfirm : {
                                required : true,
                                minlength : 3,
                                maxlength : 20,
                                equalTo : '#password'
                            },
                            firstname : {
                                required : true
                            },
                            lastname : {
                                required : true
                            },
                            compType : {
                                required : true
                            },
                            terms : {
                                required : true
                            }
			},

			// Messages for form validation
			messages : {
                            login : {
                                required : 'Please enter your login'
                            },
                            email : {
                                required : 'Please enter your email address',
                                email : 'Please enter a VALID email address'
                            },
                            password : {
                                required : 'Please enter your password'
                            },
                            passwordConfirm : {
                                required : 'Please enter your password one more time',
                                equalTo : 'Please enter the same password as above'
                            },
                            firstname : {
                                required : 'Please select your first name'
                            },
                            lastname : {
                                required : 'Please select your last name'
                            },
                            compType : {
                                required : 'Please select your gender'
                            },
                            terms : {
                                required : 'You must agree with Terms and Conditions'
                            }
			},

			// Do not change code below
			errorPlacement : function(error, element) {
				error.insertAfter(element.parent());
			}
		});
			
		// START AND FINISH DATE
		$('#startdate').datepicker({
                    dateFormat : 'dd.mm.yy',
                    prevText : '<i class="fa fa-chevron-left"></i>',
                    nextText : '<i class="fa fa-chevron-right"></i>',
                    onSelect : function(selectedDate) {
                            $('#finishdate').datepicker('option', 'minDate', selectedDate);
                    }
		});
		
		$('#finishdate').datepicker({
                    dateFormat : 'dd.mm.yy',
                    prevText : '<i class="fa fa-chevron-left"></i>',
                    nextText : '<i class="fa fa-chevron-right"></i>',
                    onSelect : function(selectedDate) {
                            $('#startdate').datepicker('option', 'maxDate', selectedDate);
                    }
		});
		
	};
	
	// end pagefunction
	
	// Load form valisation dependency 
	loadScript("js/plugin/jquery-form/jquery-form.min.js", pagefunction);
        $("#hospAlert").hide();
        $("#uiLoading").hide();
        $("#hoProv").change(getAmphur);
        $("#hoAmphur").change(getDistrict);
        $("#hoDistrict").change(getZipcode);
        $("#btnSave").click(saveHospital);
        
        function getAmphur(){
            //alert("aaaa");
            $("#hoAmphur").empty();
            $.ajax({ 
                type: 'GET', url: 'getAmphur.php', contentType: "application/json", dataType: 'text', data: { 'prov_id': $("#hoProv").val(), 'flagPage':"amphur" }, 
                success: function (data) {
                    //alert('bbbbb');
                    var json_obj = $.parseJSON(data);
                    //alert('bbbbb '+json_obj.length);
                    toAppend = "<option value='0' selected='' disabled=''>เลือกอำเภอ</option>";
                    for (var i in json_obj)
                    {
                        if(json_obj[i].amphur_name==null) {
                            //alert('ddddd ');
                        }
                        toAppend += '<option value="'+json_obj[i].amphur_id+'">'+json_obj[i].amphur_name+'</option>';
                        //
                    }
                    $("#hoAmphur").append(toAppend);
                    $("#hoAmphur").selectpicker('refresh');
                }
            });
        }
        function getDistrict(){
            //alert("aaaa"+$("#cAmphur").val());
            $("#hoDistrict").empty();
            $.ajax({ 
                type: 'GET', url: 'getAmphur.php', contentType: "application/json", dataType: 'text', data: { 'amphur_id': $("#hoAmphur").val(), 'flagPage':"district" }, 
                success: function (data) {
                    //alert('bbbbb');
                    var json_obj = $.parseJSON(data);
                    //alert('bbbbb '+json_obj.length);
                    toAppend = "<option value='0' selected='' disabled=''>เลือกตำบล</option>";
                    for (var i in json_obj)
                    {
                        if(json_obj[i].district_name==null) {
                            //alert('ddddd ');
                        }
                        toAppend += '<option value="'+json_obj[i].district_id+'">'+json_obj[i].district_name+'</option>';
                        //
                    }
                    $("#hoDistrict").append(toAppend);
                    $("#hoDistrict").selectpicker('refresh');
                }
            });
        }
        function getZipcode(){
            //alert("aaaa"+$("#cAmphur").val());
            //$("#cDistrict").empty();
            $.ajax({ 
                type: 'GET', url: 'getAmphur.php', contentType: "application/json", dataType: 'text', data: { 'district_id': $("#hoDistrict").val(), 'flagPage':"zipcode" }, 
                success: function (data) {
                    //alert('bbbbb');
                    var json_obj = $.parseJSON(data);
//                    alert('bbbbb '+json_obj.length);
//                    alert('ccccc '+$("#cDistrict").val());
                    //$("#cZipcode").val("aaaa");
                    for (var i in json_obj){
                        if(json_obj[i].zipcode!=null) {
                            $("#hoZipcode").val(json_obj[i].zipcode);
                        }
                    }
                }
            });
        }
        function saveHospital(){
//            alert('aaaaa');
            $("#uiLoading").show();
            $("#loading").addClass("fa-spin");
            $("#btnSave").prop("disabled", true);
            $.ajax({ 
                type: 'GET', url: 'saveData.php', contentType: "application/json", dataType: 'text', 
                data: { 'hosp_id': $("#hoId").val()
                    ,'hosp_code': $("#hoCode").val()
//                    ,'hosp_code': "aaa"
                    ,'hosp_name_t': $("#hoNameT").val()
                    ,'hosp_address_t': $("#hoAddress").val()
                    ,'tele': $("#hoTele").val()
                    ,'email': $("#hoEmail").val()
                    ,'tax_id': $("#hoTaxId").val()
                    ,'prov_id': $("#hoProv").val()
                    ,'amphur_id': $("#hoAmphur").val()
                    ,'district_id': $("#hoDistrict").val()
                    ,'zipcode': $("#hoZipcode").val()
                    ,'contact_name1': $("#hoContactName1").val()
                    ,'contact_tel1': $("#hoContactTel1").val()
                    ,'contact_name2': $("#hoContactName2").val()
                    ,'contact_tel2': $("#hoContactTel2").val()
                    ,'flagPage': "hospital" }, 
                success: function (data) {
//                    alert('bbbbb'+data);
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
