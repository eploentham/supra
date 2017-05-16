<?php require_once("inc/init.php"); ?>
<?php
session_start();
if (!isset($_SESSION['at_user_staff_name'])) {
    //header("location: #login.php");
    $_SESSION['at_page'] ="company.php";
    echo "<script>window.location.assign('#login.php');</script>";
}
$compId="-";
if(isset($_GET["compId"])){
    $compId = $_GET["compId"];
}
//$databaseName="at_healthcare";
//$userDB="root";
//$passDB="";
//
//$userDB="athealtcare";
//$passDB="Srb!g302";
//
//$hostDB="mysql-5.5.chaiyohosting.com";
$conn = mysqli_connect($hostDB,$userDB,$passDB,$databaseName);
if(!$conn){
    echo mysqli_error();
    echo "<script>alert(".mysql_error().");</script>";
    return;
}
mysqli_set_charset($conn, "UTF8");
$sql="Select * From b_company  ";
//echo "<script> alert('aaaaa'); </script>";
//$rComp = mysqli_query($conn,"Select * From b_company Where comp_id = '1' ");
if ($rComp=mysqli_query($conn,$sql)){
    $aComp = mysqli_fetch_array($rComp);
    $compId = $aComp["comp_id"];
    $bb = strval($aComp["prov_id"]);
    $oProv = str_replace("selected=''", "", $oProv);
    //$pos = strpos($oProv, "<option value='".$aComp["prov_id"]);
    $aa = '<option selected value='.$bb;
    $oProv = str_replace('<option value='.$bb, $aa, $oProv);
//    echo "<script> alert('".$aa."'); </script>";
//    if($pos===true){
//        echo "<script> alert('aaaaa'); </script>";
//        $aa = "<option selected='' value='".$aComp["prov_id"];
//        $oProv = str_replace("<option value='".$aComp["prov_id"], $aa, $oProv);
//    }
}

//while($row = mysqli_fetch_array($result)){
//    $tmp = array();
//    $tmp["comp_type_code"] = $row["comp_type_code"];
//    $tmp["comp_type_name_t"] = $row["comp_type_name_t"];
//    array_push($acompType,$tmp);
//}

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

<div class="alert alert-block alert-success"  id="compAlert">
	<a class="close" data-dismiss="alert" href="#">×</a>
	<h4 class="alert-heading"><i class="fa fa-check-square-o"></i> Check validation!</h4>
	<p id="compVali">
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
                    <h2>Registration form </h2>				

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
                            <header>ข้อมูล บริษัท</header>
                            <fieldset>
                                <div class="row">
                                    <section  class="col col-4">
                                        <label class="label">ประเภทบริษัท</label>
                                        <label class="select">
                                            <select name="compType" id="compType">
                                                    <?php echo $oComp;?>
                                            </select> <i></i> </label>
                                    </section>
                                    <section  class="col col-8">
                                        <label class="label">ชื่อบริษัท</label>
                                        <label class="input"> <i class="icon-append fa fa-user"></i>
                                            <input type="text" name="compNameT" id="compNameT" placeholder="ชื่อบริษัท" value="<?php echo $aComp["comp_name_t"]?>">
                                            <input type="hidden" name="compId" id="compId" value="<?php echo $compId;?>">
                                            <input type="hidden" name="compCode" id="compCode" value="100">
                                                <b class="tooltip tooltip-bottom-right">Needed to enter the website</b> </label>
                                    </section>
                                </div>
                                

                                <section >
                                    <label class="label">ที่อยู่</label>
                                    <label class="input"> <i class="icon-append fa fa-envelope-o"></i>
                                        <input type="text" name="compAddress" id="compAddress" placeholder="ที่อยู่ บ้านเลขที่ ซอย ถนน" value="<?php echo $aComp["comp_address_t"]?>">
                                            <b class="tooltip tooltip-bottom-right">Needed to verify your account</b> </label>
                                </section >
                                <div class="row">
                                    <section class="col col-6">
                                        <label class="label">ตำบล</label>
                                        <label class="select">
                                            <select name="cDistrict" id="cDistrict">
                                                    <?php echo $oComp;?>
                                            </select> <i></i> </label>
                                    </section>
                                    <section class="col col-6">
                                        <label class="label">อำเภอ</label>
                                        <label class="select">
                                            <select name="cAmphur" id="cAmphur">
                                                <?php echo $oComp;?>
                                            </select> <i></i> </label>
                                    </section>
                                </div>
                                
                                <div class="row">
                                    <section class="col col-6">
                                        <label class="label">จังหวัด</label>
                                        <label class="select">
                                            <select name="cProv" id="cProv">
                                                <?php echo $oProv;?>
                                            </select> <i></i> </label>
                                    </section>

                                    <section class="col col-6">
                                        <label class="label">รหัสไปรษณีย์</label>
                                        <label class="input"> <i class="icon-append fa fa-lock"></i>
                                                <input type="text" name="cZipcode" placeholder="รหัสไปรษณีย์" id="cZipcode" value="<?php echo $aComp["zipcode"]?>">
                                                <b class="tooltip tooltip-bottom-right">Don't forget your password</b> </label>
                                    </section>
                                </div>
                                
                                <div class="row">
                                    <section class="col col-4">
                                        <label class="label">โทรศัพท์</label>
                                        <label class="input"> <i class="icon-prepend fa fa-phone"></i>
                                            <input type="tel" name="tele" id="tele" placeholder="Phone" data-mask="(999) 999-9999" value="<?php echo $aComp["tele"]?>"></label>
                                    </section>
                                    <section class="col col-4">
                                        <label class="label">Email</label>
                                        <label class="input"> <i class="icon-prepend fa fa-phone"></i>
                                            <input type="email" name="email" id="email" placeholder="Phone" value="<?php echo $aComp["email"]?>"></label>
                                    </section>

                                    <section class="col col-4">
                                        <label class="label">เลขที่ผู้เสียภาษี</label>
                                        <label class="input"> <i class="icon-append fa fa-envelope-o"></i>
                                            <input type="text" name="taxid" id="taxid" placeholder="เลขที่ผู้เสียภาษี" value="<?php echo $aComp["tax_id"]?>">
                                                <b class="tooltip tooltip-bottom-right">Needed to verify your account</b> </label>
                                    </section >
                                </div>
                                
                            </fieldset>
                            
                            <footer>
                                <button type="button" id="btnSave" class="btn btn-primary">บันทึกข้อมูล</button>
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
<section id="widget-grid" class="">
    <!-- START ROW -->
    <div class="row">
        <!-- NEW COL START -->
        <article class="col-sm-12 col-md-12 col-lg-6">
            <!-- Widget ID (each widget will need unique ID)-->
            <div class="jarviswidget" id="wid-id-4" data-widget-editbutton="false" data-widget-custombutton="false">

                <header>
                    <span class="widget-icon"> <i class="fa fa-edit"></i> </span>
                    <h2>Flow Control </h2>				

                </header>
                <div>
                <div class="jarviswidget-editbox">
                                <!-- This area used as dropdown edit box -->

                </div>
                <div class="widget-body no-padding">
                    <form action="" id="smart-form-register1" class="smart-form">
                        
                        <fieldset>
                            <div class="row">
                                <section class="col col-8">
                                    <div >
                                        
                                        <span class="onoffswitch">
                                                <input type="checkbox" name="chkRecEmail" class="onoffswitch-checkbox" id="chkRecEmail">
                                                <label class="onoffswitch-label" for="chkRecEmail"> 
                                                        <span class="onoffswitch-inner" data-swchon-text="ON" data-swchoff-text="OFF"></span> 
                                                        <span class="onoffswitch-switch"></span> </label> 
                                        </span>
                                        <label class="onoffswitch-title">&nbsp;<i class="fa fa-location-arrow"></i> เมื่อป้อน รับเข้าสินค้า เรียบร้อย ให้ส่ง email ไปที่ </label>
                                        
                                    </div>
                                </section>
                                <section class="col col-4">
                                    <label class="input"> <i class="icon-append fa fa-lock"></i>
                                                <input type="text" name="cZipcode" placeholder="รหัสไปรษณีย์" id="cZipcode" value="<?php echo $aComp["zipcode"]?>"></label>
                                </section>
                                
                            </div>
                            <div class="row">
                                <section class="col col-8">
                                    <div >
                                        
                                        <span class="onoffswitch">
                                                <input type="checkbox" name="chkPurchaseEmail" class="onoffswitch-checkbox" id="chkPurchaseEmail">
                                                <label class="onoffswitch-label" for="chkPurchaseEmail"> 
                                                        <span class="onoffswitch-inner" data-swchon-text="ON" data-swchoff-text="OFF"></span> 
                                                        <span class="onoffswitch-switch"></span> </label> 
                                        </span>
                                        <label class="onoffswitch-title">&nbsp;<i class="fa fa-location-arrow"></i>&nbsp;เมื่อจำนวนสินค้าคงเหลือน้อยกว่าที่กำหนด ให้ส่ง email ไปที่ </label>
                                        
                                    </div>
                                </section>
                                <section class="col col-4">
                                    <label class="input"> <i class="icon-append fa fa-lock"></i>
                                                <input type="text" name="cZipcode" placeholder="รหัสไปรษณีย์" id="cZipcode" value="<?php echo $aComp["zipcode"]?>"></label>
                                </section>
                                
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>
            </div>
            
            
        </article>
    </div>
</section>
		
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
        $("#compAlert").hide();
        $("#cProv").change(getAmphur);
        $("#cAmphur").change(getDistrict);
        $("#cDistrict").change(getZipcode);
        $("#btnSave").click(saveComp);
        //$("#alert").hide();
//        function getAmphur(){
//            alert("aaaa");
//        }
        function getAmphur(){
            //alert("aaaa");
            $("#cAmphur").empty();
            $.ajax({ 
                type: 'GET', url: 'getAmphur.php', contentType: "application/json", dataType: 'text', data: { 'prov_id': $("#cProv").val(), 'flagPage':"amphur" }, 
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
                    $("#cAmphur").append(toAppend);
                    $("#cAmphur").selectpicker('refresh');
                }
            });
        }
        function getDistrict(){
            //alert("aaaa"+$("#cAmphur").val());
            $("#cDistrict").empty();
            $.ajax({ 
                type: 'GET', url: 'getAmphur.php', contentType: "application/json", dataType: 'text', data: { 'amphur_id': $("#cAmphur").val(), 'flagPage':"district" }, 
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
                    $("#cDistrict").append(toAppend);
                    $("#cDistrict").selectpicker('refresh');
                }
            });
        }
        function getZipcode(){
            //alert("aaaa"+$("#cAmphur").val());
            //$("#cDistrict").empty();
            $.ajax({ 
                type: 'GET', url: 'getAmphur.php', contentType: "application/json", dataType: 'text', data: { 'district_id': $("#cDistrict").val(), 'flagPage':"zipcode" }, 
                success: function (data) {
                    //alert('bbbbb');
                    var json_obj = $.parseJSON(data);
//                    alert('bbbbb '+json_obj.length);
//                    alert('ccccc '+$("#cDistrict").val());
                    //$("#cZipcode").val("aaaa");
                    for (var i in json_obj){
                        if(json_obj[i].zipcode!=null) {
                            $("#cZipcode").val(json_obj[i].zipcode);
                        }
                    }
                }
            });
        }
        function saveComp(){
            //alert('aaaaa');
            $.ajax({ 
                type: 'GET', url: 'saveData.php', contentType: "application/json", dataType: 'text', 
                data: { 'comp_id': $("#compId").val()
                    ,'comp_code': $("#compCode").val()
                    ,'comp_name_t': $("#compNameT").val()
                    ,'comp_address_t': $("#compAddress").val()
                    ,'tele': $("#tele").val()
                    ,'email': $("#email").val()
                    ,'tax_id': $("#taxid").val()
                    ,'prov_id': $("#cProv").val()
                    ,'amphur_id': $("#cAmphur").val()
                    ,'district_id': $("#cDistrict").val()
                    ,'zipcode': $("#cZipcode").val()
                    ,'flagPage': "company" }, 
                success: function (data) {
                    //alert('bbbbb'+data);
                    var json_obj = $.parseJSON(data);
                    for (var i in json_obj){
                        //alert("aaaa "+json_obj[i].success);
                        $.alert({
                            title: 'Save Data',
                            content: 'บันทึกข้อมูลเรียบร้อย',
                        });
                    }
//                    alert('bbbbb '+json_obj.length);
//                    alert('ccccc '+$("#cDistrict").val());
                    //$("#cZipcode").val("aaaa");
                }
            });
        }
</script>
