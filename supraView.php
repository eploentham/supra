<?php require_once("inc/init.php"); ?>
<?php
session_start();
if (!isset($_SESSION['bn_user_staff_name'])) {
    //header("location: #login.php");
    $_SESSION['bn_page'] ="customerView.php";
    echo "<script>window.location.assign('#login.php');</script>";
}
$trCust="";
$conn = mysqli_connect($hostDB,$userDB,$passDB,$databaseName);
mysqli_set_charset($conn, "UTF8");
$sql="Select sup.*, br.branch_name, ho.hospital_name_t "
    ."From t_supra sup "
    ."Left Join b_hospital  ho on ho.hosp_id = sup.hosp_id "
    ."Left Join b_branch  br on br.branch_id = sup.branch_id "
    ."Where active = '1' ";
$result = mysqli_query($conn,$sql);
if($result){
    while($row = mysqli_fetch_array($result)){
        $brName="<a href='#supraAdd.php?supraId=".$row["supra_id"]."'>".$row["pat_name"]." ".$row["pat_surname"]."</a>";
        $trCust .= "<tr><td>".$row["supra_date"]."</td><td>".$brName."</td><td>".$row["hn"]."</td><td>".$row["branch_name"]
            ."</td><td>".$row["hospital_name_t"]."</td><td>".$row["contact_name_hosp"]."</td><td>".$row["contact_tele_hosp"]
            ."</td><td>".$row["contact_name_pat"]."</td><td>".$row["contact_tele_pat"]."</td></tr>";
    }
}
$result->free();
mysqli_close($conn);

?>
<div class="row">
	<div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
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
                                        <th data-hide="phone,tablet"><i class="fa fa-fw fa-map-marker txt-color-blue hidden-md hidden-sm hidden-xs"></i> สาขา</th>
                                        <th data-hide="phone,tablet">โรงพยาบาล</th>
                                        <th data-hide="phone,tablet"><i class="fa fa-fw fa-calendar txt-color-blue hidden-md hidden-sm hidden-xs"></i> ชื่อผู้ติดต่อ โรงพยาบาล</th>
                                        <th data-hide="phone,tablet"><i class="fa fa-fw fa-calendar txt-color-blue hidden-md hidden-sm hidden-xs"></i> เบอร์ผู้ติดต่อ โรงพยาบาล</th>
                                        <th data-hide="phone,tablet"><i class="fa fa-fw fa-calendar txt-color-blue hidden-md hidden-sm hidden-xs"></i> ชื่อผู้ติดต่อ ผู้ป่วย</th>
                                        <th data-hide="phone,tablet"><i class="fa fa-fw fa-calendar txt-color-blue hidden-md hidden-sm hidden-xs"></i> เบอร์ผู้ติดต่อ ผู้ป่วย</th>
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
                    <button type="button" class="btn btn-primary" id="btnSupraAdd">
                                เพิ่ม Supra
                    </button>
                </footer>
            </article>
            <!-- WIDGET END -->
	</div>
	<!-- end row -->
	<!-- end row -->
</section>
<!-- end widget grid -->