<?php require_once("inc/init.php"); ?>
<?php
session_start();
if (!isset($_SESSION['bn_user_staff_name'])) {
    //header("location: #login.php");
    $_SESSION['bn_page'] ="compBranchAdd.php";
    echo "<script>window.location.assign('#login.php');</script>";
}
$brId="";
if(isset($_GET["branchId"])){
    $brId = $_GET["branchId"];
}else{
    $brId="";
}
//$databaseName="at_healthcare";
//$userDB="root";
//$passDB="";
//
//$userDB="athealtcare";
//$passDB="Srb!g302";
//
//$hostDB="mysql-5.5.chaiyohosting.com:3306";
$conn = mysqli_connect($hostDB,$userDB,$passDB,$databaseName);
if(!$conn){
    echo mysqli_error();
    return;
}
mysqli_set_charset($conn, "UTF8");
$sql="Select * From b_branch Where branch_id = '".$brId."'";

if ($rComp=mysqli_query($conn,$sql)){
    $aComp = mysqli_fetch_array($rComp);
    $brId = $aComp["branch_id"];
    $brCode = strval($aComp["branch_code"]);
    $brName = strval($aComp["branch_name"]);
    $brAddress = strval($aComp["branch_address"]);
    $brTele = strval($aComp["tele"]);

}

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

<div class="alert alert-block alert-success">
    <a class="close" data-dismiss="alert" href="#">×</a>
    <h4 class="alert-heading"><i class="fa fa-check-square-o"></i> Check validation!</h4>
    <p>
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
                            <header>ข้อมูล สาขา</header>
                            <fieldset>
                                <section >
                                    <label class="label">ชื่อสาขา</label>
                                    <label class="input"> <i class="icon-append fa fa-user"></i>
                                        <input type="text" name="brName" id="brName" placeholder="ชื่อบริษัท" value="<?php echo $brName?>">
                                        <input type="hidden" name="brId" id="brId" value="<?php echo $_GET["branchId"];?>">
                                        <input type="hidden" name="brCode" id="brCode" value="<?php echo $brCode;?>">
                                            <b class="tooltip tooltip-bottom-right">Needed to enter the website</b> </label>
                                </section>

                                <section >
                                    <label class="label">ที่อยู่</label>
                                    <label class="input"> <i class="icon-append fa fa-envelope-o"></i>
                                        <input type="text" name="brAddress" id="brAddress" placeholder="ที่อยู่ บ้านเลขที่ ซอย ถนน" value="<?php echo $brAddress?>">
                                            <b class="tooltip tooltip-bottom-right">Needed to verify your account</b> </label>
                                </section >                               
                                
                                <section>
                                    <label class="label">โทรศัพท์</label>
                                    <label class="input"> <i class="icon-prepend fa fa-phone"></i>
                                        <input type="tel" name="brTele" id="brTele" placeholder="Phone" data-mask="(999) 999-9999" value="<?php echo $brTele?>"></label>
                                </section>

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

        $("#btnSave").click(saveBranch);
//        function getAmphur(){
//            alert("aaaa");
//        }
        
        function saveBranch(){
            //alert('aaaaa');
            $.ajax({ 
                type: 'GET', url: 'saveData.php', contentType: "application/json", dataType: 'text', 
                data: { 'branch_id': $("#brId").val()
                    ,'branch_code': $("#brCode").val()
                    ,'branch_name': $("#brName").val()
                    ,'branch_address': $("#brAddress").val()
                    ,'tele': $("#brTele").val()
                    ,'flagPage': "branch" }, 
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