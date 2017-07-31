<?php 
//session_start();
require_once("inc/init.php"); 
//if (!isset($_SESSION['at_user_staff_name'])) {
//    //header("location: #login.php");
//    $_SESSION['at_page'] ="company.php";
//    echo "<script>window.location.assign('#login.php');</script>";
//}
$conn = mysqli_connect($hostDB,$userDB,$passDB,$databaseName);
if(!$conn){
    echo mysqli_error($conn);
    echo "<script>alert(".mysql_error().");</script>";
    return;
}
mysqli_set_charset($conn, "UTF8");
//$sql="Select * From goods Where active = '1' ";
//$result = mysqli_query($conn,$sql);
//if($result){
//    while($row = mysqli_fetch_array($result)){
//        $brName="<a href='#poPrRequestAdd.php?unitId=".$row["dept_name"]."'>".$row["pr_date"]."</a>";
//        $trCust .= "<tr><td>".$brName."</td></tr>";
//    }
//}

$result->free();
mysqli_close($conn);
?>
<div class="row">
    <div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
        <h1 class="page-title txt-color-blueDark">
            <i class="fa fa-pencil-square-o fa-fw "></i> 
                Forms
            <span>> 
                Dropzone
            </span>
        </h1>
    </div>
	<div class="col-xs-12 col-sm-5 col-md-5 col-lg-8">
		<ul id="sparks" class="">
			<li class="sparks-info">
				<h5> My Income <span class="txt-color-blue">$47,171</span></h5>
				<div class="sparkline txt-color-blue hidden-mobile hidden-md hidden-sm">
					1300, 1877, 2500, 2577, 2000, 2100, 3000, 2700, 3631, 2471, 2700, 3631, 2471
				</div>
			</li>
			<li class="sparks-info">
				<h5> Site Traffic <span class="txt-color-purple"><i class="fa fa-arrow-circle-up" data-rel="bootstrap-tooltip" title="Increased"></i>&nbsp;45%</span></h5>
				<div class="sparkline txt-color-purple hidden-mobile hidden-md hidden-sm">
					110,150,300,130,400,240,220,310,220,300, 270, 210
				</div>
			</li>
			<li class="sparks-info">
				<h5> Site Orders <span class="txt-color-greenDark"><i class="fa fa-shopping-cart"></i>&nbsp;2447</span></h5>
				<div class="sparkline txt-color-greenDark hidden-mobile hidden-md hidden-sm">
					110,150,300,130,400,240,220,310,220,300, 270, 210
				</div>
			</li>
		</ul>
	</div>
</div>

<!-- widget grid -->
<section id="widget-grid" class="">
	<!-- row -->
	<div class="row">

		<!-- NEW WIDGET START -->
		<article class="col-sm-12">

			<!-- Widget ID (each widget will need unique ID)-->
			<div class="jarviswidget jarviswidget-color-blueLight" id="wid-id-0" data-widget-editbutton="false">
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
					<span class="widget-icon"> <i class="fa fa-cloud"></i> </span>
					<h2>วางFile Excel </h2>

				</header>

				<!-- widget div-->
                                <div class="row">
                                    <div class="col col-lg-12">
                                        <div class="col col-lg-6">
                                            <!-- widget edit box -->
                                            <div class="jarviswidget-editbox">
                                                    <!-- This area used as dropdown edit box -->

                                            </div>
                                            <!-- end widget edit box -->

                                            <!-- widget content -->
                                            <div class="widget-body col col-lg-12">
                                                <form action="upload.php" class="dropzone" id="mydropzone">
                                                    <!--<input type="hidden" name="cboBranch1" id="cboBranch1" value="2">
                                                    <input type="hidden" name="cboYear1" id="cboYear1" value="2017">
                                                    <input type="hidden" name="cboMonth1" id="cboMonth1" value="3">
                                                    <input type="hidden" name="cboPeriod1" id="cboPeriod1" value="4">-->
                                                </form>
                                            </div>
                                        </div>
                                        <div class="col col-lg-6">
                                        <form action="" id="smart-form-register" class="smart-form">
                                        <fieldset>
                                            <div class="row">
                                                <div class="col col-lg-12">
                                                    <section class="col col-3">
                                                        <label class="label">สาขา</label>
                                                        <label class="select" id="goType1">
                                                            <select id="cboBranch">
                                                                <option value="1">บางนา1</option>
                                                                <option value="2">บางนา2</option>
                                                                <option value="5">บางนา5</option>
                                                            </select> <i></i> </label>
                                                    </section>
                                                    <section class="col col-3">
                                                        <label class="label">ประจำปี</label>
                                                        <label class="select" id="goType1">
                                                            <select id="cboYear">
                                                                <option value="2016">2016</option>
                                                                <option value="2017">2017</option>
                                                                <option value="2018">2018</option>
                                                                <option value="2019">2019</option>
                                                            </select> <i></i> </label>
                                                    </section>
                                                    <section class="col col-3">
                                                        <label class="label">เดือน</label>
                                                        <label class="select" id="goType1">
                                                            <select id="cboMonth">
                                                                <option value="1">มกราคม</option>
                                                                <option value="2">กุมภาพันธ์</option>
                                                                <option value="3">มีนาคม</option>
                                                                <option value="4">เมษายน</option>
                                                                <option value="5">พฤษภาคม</option>
                                                                <option value="6">มิถุนายน</option>
                                                                <option value="7">กรกฎาคม</option>
                                                                <option value="8">สิงหาคม</option>
                                                                <option value="9">กันยายน</option>
                                                                <option value="10">ตุลาคม</option>
                                                                <option value="11">พฤศจิกายน</option>
                                                                <option value="12">ธันวาคม</option>
                                                            </select> <i></i> </label>
                                                    </section>
                                                    <section class="col col-3">
                                                        <label class="label">งวด</label>
                                                        <label class="select" id="goType1">
                                                            <select id="cboPeriod">
                                                                <option value="1">งวดต้นเดือน</option>
                                                                <option value="2">งวดสิ้นเดือน</option>
                                                            </select> <i></i> </label>
                                                    </section>

                                                </div>
                                                
                                            </div>
                                            <div class="row">
                                                <div class="bar-holder">
                                                    <div class="progress" id="progressBar">
                                                            <div class="progress-bar bg-color-teal" data-transitiongoal="25"></div>
                                                    </div>
                                                </div>                                                
                                                
                                            </div>
                                            <footer>
                                                <div class="row">
                                                    <section class="col col-3 ">
                                                        <button type="button" id="btnImport" class="btn btn-labeled btn-primary btn-lg">
                                                            อ่านข้อมูล
                                                        </button>
                                                    </section>

                                                    <section class="col col-3 ">
                                                        <ul class="demo-btns">
                                                            <li>
                                                                <a href="javascript:void(0);" class="btn bg-color-blue txt-color-white"><i id="loading" class="fa fa-gear fa-2x fa-spin"></i></a>
                                                            </li>
                                                        </ul>
                                                    </section>
                                                    <div class="alert alert-block alert-success col col-6"  id="compAlert">
                                                        <a class="close" data-dismiss="alert" href="#">×</a>
                                                        <h4 class="alert-heading"><i class="fa fa-check-square-o"></i> Check validation!</h4>
                                                        <p id="compVali">
                                                                You may also check the form validation by clicking on the form action button. Please try and see the results below!
                                                        </p>
                                                    </div>
                                                </div>
                                            </footer>
                                        </fieldset>
                                        </form>
                                        </div>
                                    </div>
					<!-- end widget content -->

				</div>
				<!-- end widget div -->
			</div>
			<!-- end widget -->

		</article>
		<!-- WIDGET END -->

	</div>

	<!-- end row -->

	<!-- row -->

	<div class="row">

		<style>
			.s2 {
				color: #D14;
			}

			.c1 {
				color: #998;
				font-style: italic;
			}

			.mi {
				color: #099;
			}
		</style>

		

	</div>

	<!-- end row -->

</section>
<!-- end widget grid -->

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
	
	/*
	 * ALL PAGE RELATED SCRIPTS CAN GO BELOW HERE
	 * eg alert("my home function");
	 * 
	 * var pagefunction = function() {
	 *   ...
	 * }
	 * loadScript("js/plugin/_PLUGIN_NAME_.js", pagefunction);
	 * 
	 */

	// PAGE RELATED SCRIPTS
	// pagefunction
	var pagefunction = function() {
            // Fill all progress bars with animation
            $('.progress-bar').progressbar({
                    display_text : 'fill'
            });
                
            Dropzone.autoDiscover = false;
            $("#mydropzone").dropzone({
                    //url: "/file/post",
                    addRemoveLinks : true,
                    maxFilesize: 15,
                    dictDefaultMessage: '<span class="text-center"><span class="font-lg visible-xs-block visible-sm-block visible-lg-block"><span class="font-lg"><i class="fa fa-caret-right text-danger"></i> Drop files <span class="font-xs">to upload</span></span><span>&nbsp&nbsp<h4 class="display-inline"> (Or Click)</h4></span>',
                    dictResponseError: 'Error uploading file!'
            });
	};
	// end pagefunction
	// run pagefunction on load
	loadScript("js/plugin/dropzone/dropzone.min.js", pagefunction);
        loadScript("js/plugin/bootstrap-progressbar/bootstrap-progressbar.min.js", pagefunction);
        $("#btnImport").click(readExcel);
        $("#loading").removeClass("fa-spin");
        $("#reAlert").hide();
        $("#compAlert").hide();
        function readExcel(){
//            alert("111");
            $("#loading").addClass("fa-spin");
            $.ajax({
                type: 'GET', url: 'readTextHn.php', contentType: "application/json", dataType: 'text'
                , data: {  'flagPage':"readTextHn"
                    , 'month_id':$("#cboMonth").val(), 'year_id':$("#cboYear").val(), 'period_id':$("#cboPeriod").val(),'branch_id':$("#cboBranch").val()}
                , success: function (data) {
                    alert('bbbbb'+data);
                    var json_obj = $.parseJSON(data);
                    
                    for (var i in json_obj)
                    {
                        if(json_obj[i].success===1){
                            $("#compAlert").removeClass("alert alert-block alert-danger");
                            $("#compAlert").addClass("alert alert-block alert-success");
                            $("#compAlert").empty();
                            $("#compAlert").append(" บันทึกข้อมูลเรียบร้อย "+json_obj[i].row_cnt+" "+json_obj[i].patient_cnt);
                            $("#compAlert").show();
                            $("#loading").removeClass("fa-spin");
                            
                            $("#btnImport").prop("disabled", true);
                        }else{
                            $("#compAlert").removeClass("alert alert-block alert-success");
                            $("#compAlert").addClass("alert alert-block alert-danger");
                            $("#compAlert").empty();
                            $("#compAlert").append(json_obj[i].row_cnt);
                            $("#compAlert").show();
                            $("#loading").removeClass("fa-spin");
                            
                            $("#btnImport").prop("disabled", true);
                        }
                    }
                }
            });
        }
        
</script>
