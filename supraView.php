<?php require_once("inc/init.php"); ?>
<?php
session_start();
if (!isset($_SESSION['bn_user_staff_name'])) {
    //header("location: #login.php");
    $_SESSION['bn_page'] ="supraView.php";
    echo "<script>window.location.assign('#login.php');</script>";
}
$trCust="";
$supraDate="";
$cboYear=$_GET["cboYear"];
$whereYear="";
if($cboYear!=""){
    $whereYear = " and sup.year_id = '".$cboYear."' ";
}
$conn = mysqli_connect($hostDB,$userDB,$passDB,$databaseName);
mysqli_set_charset($conn, "UTF8");
$sql="Select sup.*, br.branch_name, ho.hosp_name_t "
    ."From t_supra sup "
    ."Left Join b_hospital ho on ho.hosp_id = sup.hosp_id "
    ."Left Join b_branch br on br.branch_code = sup.branch_code "
    ."Where sup.active = '1' ".$whereYear
    ." Order By sup.supra_date desc ";
//$result = mysqli_query($conn,$sql);
//echo $sql;
if ($result=mysqli_query($conn,$sql) or die(mysqli_error($conn))){
//if($result){
    while($row = mysqli_fetch_array($result)){
        $supraDate = ($row["supra_date"]);
        $supraDate = substr($supraDate,strlen($supraDate)-2)."-".substr($supraDate,5,2)."-".substr($supraDate,0,4);
        $name="";
        $surname = "";
        if($row["pat_name"]===""){
            $name = "";
        }else{
            $name = $row["pat_name"];
        }
        if($row["pat_surname"]===""){
            $surname = "";
        }else{
            $surname = $row["pat_surname"];
        }
        if($name==="" && $surname===""){
            $name = "ไม่มี ชื่อ-นามสกุล";
        }else{
            $name .= " ".$surname;
        }
        $brName="<a href='#supraAdd.php?supraId=".$row["supra_id"]."'>".$name."</a>";
        
//        $trCust .= "<tr><td>".$row["supra_doc"]."</td><td>".$row["supra_date"]."</td><td>".$brName."</td><td>".$row["hn"]."</td><td>".$row["branch_name"]
//            ."</td><td>".$row["hosp_name_t"]."</td><td>".$row["contact_name_hosp"]." ".$row["contact_tele_hosp"]."</td><td>".$row["contact_name_pat"]." ".$row["contact_tele_pat"]
//            ."</td><td>".$row["remark"]."</td><td>".$row["paid"]."</td><td>".$row["doctor_name"]."</td></tr>";
        $trCust .= "<tr><td>".$row["supra_doc"]."</td><td>".$row["supra_date"]."</td><td>".$brName."</td><td>".$row["hn"]."</td><td>".$row["branch_name"]
            ."</td><td>".$row["hosp_name_t"]."</td><td>".$row["remark"]."</td><td>".$row["paid"]."</td><td>".$row["doctor_name"]."</td></tr>";
    }
}else{
    //echo $sql;
    echo mysqli_error($conn);
    
}
$yearId="";
$sql="Select distinct sup.year_id "
    ."From t_supra sup "
    ." "
    ."Where sup.active = '1' "
    ."Order By sup.year_id desc";
//$result = mysqli_query($conn,$sql);
if ($result=mysqli_query($conn,$sql) or die(mysqli_error($conn))){
    while($row = mysqli_fetch_array($result)){
        if($cboYear===$row["year_id"]){
            $yearId .= "<option selected value=".$row["year_id"].">".$row["year_id"]."</option>";
        }else{
            $yearId .= "<option value=".$row["year_id"].">".$row["year_id"]."</option>";
        }
    }
}
$result->free();
mysqli_close($conn);

?>
<div class="row">
    <div class="col-xs-12 col-sm-7 col-md-7 col-lg-2">
        <h1 class="page-title txt-color-blueDark">
            <i class="fa fa-table fa-fw "></i> 
                    Table 
            <span>> 
                    Data Tables
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
            <form class="smart-form">
                <fieldset>
                    <section class="col col-6">
                        <label class="txt-color-blue">ประจำปี</label>
                        <label class="select" id="goType1">
                        <select id="cboYear">
                            <?php echo $yearId;?>
                        </select> <i></i> </label>
                    </section>
                    <section class="col col-6">
                        
                    </section>
                </fieldset>
            </form>  
            <!-- NEW WIDGET START -->
            <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <!-- Widget ID (each widget will need unique ID)-->
                <div class="jarviswidget jarviswidget-color-darken" id="wid-id-0" data-widget-editbutton="false">
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
                        <span class="widget-icon"> <i class="fa fa-table"></i> </span>
                        <h2>Standard Data Tables </h2>
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
                            <table id="dt_basic" class="table table-striped table-bordered table-hover" width="100%">
                                <thead>
                                    <tr>
                                        <th data-hide="phone">Code</th>
                                        <th data-class="expand"><i class="fa fa-fw fa-user text-muted hidden-md hidden-sm hidden-xs"></i> วันที่</th>
                                        <th data-hide="phone"><i class="fa fa-fw fa-phone text-muted hidden-md hidden-sm hidden-xs"></i> ชื่อผู้ป่วย</th>
                                        <th>HN</th>
                                        <th data-hide="phone,tablet"><i class="fa fa-fw fa-map-marker txt-color-blue hidden-md hidden-sm hidden-xs"></i> โรงพยาบาลที่ส่งตัว</th>
                                        <th data-hide="phone,tablet">โรงพยาบาลที่รับ (Supra)</th>
                                        <!--<th data-hide="phone,tablet"><i class="fa fa-fw fa-calendar txt-color-blue hidden-md hidden-sm hidden-xs"></i> ชื่อผู้ติดต่อ โรงพยาบาล</th>
                                        <th data-hide="phone,tablet"><i class="fa fa-fw fa-calendar txt-color-blue hidden-md hidden-sm hidden-xs"></i> ชื่อผู้ติดต่อ โรงพยาบาล (Supra)</th>-->
                                        <th data-hide="phone,tablet"><i class="fa fa-fw fa-calendar txt-color-blue hidden-md hidden-sm hidden-xs"></i> หมายเหตุ</th>
                                        <th data-hide="phone,tablet"><i class="fa fa-fw fa-calendar txt-color-blue hidden-md hidden-sm hidden-xs"></i> ค่าใช้จ่าย</th>
                                        <th data-hide="phone,tablet"><i class="fa fa-fw fa-calendar txt-color-blue hidden-md hidden-sm hidden-xs"></i> แพทย์ผู้ส่งตัว</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php echo $trCust;?>
                                </tbody>
                            </table>
                        </div>
                        <!-- end widget content -->
                    </div>
                    <!-- end widget div -->
                </div>
                    <!-- end widget -->
                <footer>
                    <button type="button" class="btn btn-primary" id="btnSupAdd">
                                เพิ่ม Supra
                    </button>
                    
                              
                    
                        
                    <section class="col col-3"></section>
                </footer>
            </article>
            <!-- WIDGET END -->
	</div>
	<!-- end row -->
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
		//console.log("cleared");
		
		/* // DOM Position key index //
		
			l - Length changing (dropdown)
			f - Filtering input (search)
			t - The Table! (datatable)
			i - Information (records)
			p - Pagination (paging)
			r - pRocessing 
			< and > - div elements
			<"#id" and > - div with an id
			<"class" and > - div with a class
			<"#id.class" and > - div with an id and class
			
			Also see: http://legacy.datatables.net/usage/features
		*/	

		/* BASIC ;*/
			var responsiveHelper_dt_basic = undefined;
			var responsiveHelper_datatable_fixed_column = undefined;
			var responsiveHelper_datatable_col_reorder = undefined;
			var responsiveHelper_datatable_tabletools = undefined;
			
			var breakpointDefinition = {
				tablet : 1024,
				phone : 480
			};

			$('#dt_basic').dataTable({
				"sDom": "<'dt-toolbar'<'col-xs-12 col-sm-6'f><'col-sm-6 col-xs-12 hidden-xs'l>r>"+
					"t"+
					"<'dt-toolbar-footer'<'col-sm-6 col-xs-12 hidden-xs'i><'col-xs-12 col-sm-6'p>>",
				"autoWidth" : true,
				"preDrawCallback" : function(){
                                    // Initialize the responsive datatables helper once.
                                    if (!responsiveHelper_dt_basic) {
                                            responsiveHelper_dt_basic = new ResponsiveDatatablesHelper($('#dt_basic'), breakpointDefinition);
                                    }
				},
				"rowCallback" : function(nRow) {
					responsiveHelper_dt_basic.createExpandIcon(nRow);
				},
				"drawCallback" : function(oSettings) {
					responsiveHelper_dt_basic.respond();
				}
			});

		/* END BASIC */
		
		/* COLUMN FILTER  */
	    var otable = $('#datatable_fixed_column').DataTable({
	    	//"bFilter": false,
	    	//"bInfo": false,
	    	//"bLengthChange": false
	    	//"bAutoWidth": false,
	    	//"bPaginate": false,
	    	//"bStateSave": true // saves sort state using localStorage
			"sDom": "<'dt-toolbar'<'col-xs-12 col-sm-6 hidden-xs'f><'col-sm-6 col-xs-12 hidden-xs'<'toolbar'>>r>"+
					"t"+
					"<'dt-toolbar-footer'<'col-sm-6 col-xs-12 hidden-xs'i><'col-xs-12 col-sm-6'p>>",
			"autoWidth" : true,
			"preDrawCallback" : function() {
				// Initialize the responsive datatables helper once.
				if (!responsiveHelper_datatable_fixed_column) {
					responsiveHelper_datatable_fixed_column = new ResponsiveDatatablesHelper($('#datatable_fixed_column'), breakpointDefinition);
				}
			},
			"rowCallback" : function(nRow) {
				responsiveHelper_datatable_fixed_column.createExpandIcon(nRow);
			},
			"drawCallback" : function(oSettings) {
				responsiveHelper_datatable_fixed_column.respond();
			}
		
	    });
	    
	    // custom toolbar
	    $("div.toolbar").html('<div class="text-right"><img src="img/logo.png" alt="SmartAdmin" style="width: 111px; margin-top: 3px; margin-right: 10px;"></div>');
	    	   
	    // Apply the filter
	    $("#datatable_fixed_column thead th input[type=text]").on( 'keyup change', function () {
	    	
	        otable
	            .column( $(this).parent().index()+':visible' )
	            .search( this.value )
	            .draw();
	            
	    });
	    /* END COLUMN FILTER */   
    
		/* COLUMN SHOW - HIDE */
		$('#datatable_col_reorder').dataTable({
			"sDom": "<'dt-toolbar'<'col-xs-12 col-sm-6'f><'col-sm-6 col-xs-6 hidden-xs'C>r>"+
					"t"+
					"<'dt-toolbar-footer'<'col-sm-6 col-xs-12 hidden-xs'i><'col-sm-6 col-xs-12'p>>",
			"autoWidth" : true,
			"preDrawCallback" : function() {
				// Initialize the responsive datatables helper once.
				if (!responsiveHelper_datatable_col_reorder) {
					responsiveHelper_datatable_col_reorder = new ResponsiveDatatablesHelper($('#datatable_col_reorder'), breakpointDefinition);
				}
			},
			"rowCallback" : function(nRow) {
				responsiveHelper_datatable_col_reorder.createExpandIcon(nRow);
			},
			"drawCallback" : function(oSettings) {
				responsiveHelper_datatable_col_reorder.respond();
			}			
		});
		
		/* END COLUMN SHOW - HIDE */

		/* TABLETOOLS */
		$('#datatable_tabletools').dataTable({
			
			// Tabletools options: 
			//   https://datatables.net/extensions/tabletools/button_options
			"sDom": "<'dt-toolbar'<'col-xs-12 col-sm-6'f><'col-sm-6 col-xs-6 hidden-xs'T>r>"+
					"t"+
					"<'dt-toolbar-footer'<'col-sm-6 col-xs-12 hidden-xs'i><'col-sm-6 col-xs-12'p>>",
	        "oTableTools": {
	        	 "aButtons": [
	             "copy",
	             "csv",
	             "xls",
	                {
	                    "sExtends": "pdf",
	                    "sTitle": "SmartAdmin_PDF",
	                    "sPdfMessage": "SmartAdmin PDF Export",
	                    "sPdfSize": "letter"
	                },
	             	{
                    	"sExtends": "print",
                    	"sMessage": "Generated by SmartAdmin <i>(press Esc to close)</i>"
                	}
	             ],
	            "sSwfPath": "js/plugin/datatables/swf/copy_csv_xls_pdf.swf"
	        },
                    "autoWidth" : true,
                    "preDrawCallback" : function() {
                            // Initialize the responsive datatables helper once.
                            if (!responsiveHelper_datatable_tabletools) {
                                    responsiveHelper_datatable_tabletools = new ResponsiveDatatablesHelper($('#datatable_tabletools'), breakpointDefinition);
                            }
                    },
                    "rowCallback" : function(nRow) {
                            responsiveHelper_datatable_tabletools.createExpandIcon(nRow);
                    },
                    "drawCallback" : function(oSettings) {
                            responsiveHelper_datatable_tabletools.respond();
                    }
		});
		
		/* END TABLETOOLS */

	};
	// load related plugins	
	loadScript("js/plugin/datatables/jquery.dataTables.min.js", function(){
            loadScript("js/plugin/datatables/dataTables.colVis.min.js", function(){
                loadScript("js/plugin/datatables/dataTables.tableTools.min.js", function(){
                    loadScript("js/plugin/datatables/dataTables.bootstrap.min.js", function(){
                        loadScript("js/plugin/datatable-responsive/datatables.responsive.min.js", pagefunction)
                    });
                });
            });
	});
        $("#btnSupAdd").click(showSupraAdd);
        $("#cboYear").change(refreshPage);
        function showSupraAdd(){
            //alert("aaaa");
            window.location.assign('#supraAdd.php');
        }
        function refreshPage(){
            location.assign('#supraView.php?cboYear='+$("#cboYear").val());
        }
</script>