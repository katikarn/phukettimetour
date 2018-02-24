<?php
session_start();
include("inc/connectionToMysql.php");
include("registerUserController.php");
/////////////////////////////////////////////////////////
//initilize the page
require_once("inc/init.php");

//require UI configuration (nav, ribbon, etc.)
require_once("inc/config.ui.php");

/*---------------- PHP Custom Scripts ---------

YOU CAN SET CONFIGURATION VARIABLES HERE BEFORE IT GOES TO NAV, RIBBON, ETC.
E.G. $page_title = "Custom Title" */

$page_title = "User Management";

/* ---------------- END PHP Custom Scripts ------------- */

//include header
//you can add your custom css in $page_css array.
//Note: all css files are inside css/ folder
$page_css[] = "your_style.css";
include("inc/header.php");

//include left panel (navigation)
//follow the tree in inc/config.ui.php
$page_nav["Setup"]["sub"]["User Management"]["active"] = true;
include("inc/nav.php");

?>
<!-- ==========================CONTENT STARTS HERE ========================== -->
<!-- MAIN PANEL -->
<style>
	.right{
		float: right;
	}
	.white{
	    color: #fff;
	}
	input{
	    margin-bottom: 15px;
		border-radius: 5px;
		border: 1px solid #ccc!important;
	}
	input[type="search"], input[type="text"]
	{
		width:100%
	}
	
	input[type="checkbox"]{
		margin-left: 10px;
	}
	#main{
		font-weight: bold;
	}
	.header{
		font-weight: bold;
		margin-left: 10px;
	}
	#m1s{
		margin-top: 10px
	}
	.modal-header, .modal-header button{
		background-color: cornflowerblue;
		font-weight: bold;
		color: #fff;
		font-size: 20px
	}
	.modal-bold{
		font-size: 15px;
		font-weight: bold;
	}
	.footer{
		text-align: center;
		margin-top: 15px;
	}
	textarea{
		resize:none;
	}
	@media (min-width: 768px){
		.modal-Adduser {
			width: 500px;
		}
	}
	
</style>
<div id="main" role="main">

	 <?php
		//configure ribbon (breadcrumbs) array("name"=>"url"), leave url empty if no url
		//$breadcrumbs["New Crumb"] => "http://url.com"
		$breadcrumbs["Management"] = "";
		include("inc/ribbon.php");
	?>

	<!--MAIN CONTENT -->
	<div id="content">

		<!-- row -->
		<div class="row">
			
			<!-- col -->
			<div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
				<h1 class="header">
					<!-- PAGE HEADER -->
					USER 
				</h1>
			</div>
			<!-- end col -->
			
			<!-- right side of the page with the sparkline graphs -->
			<!-- col -->
			<div class="col-xs-12 col-sm-5 col-md-5 col-lg-8">
				<!-- sparks 
				<ul id="sparks">
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
				 end sparks -->
			</div>
			<!-- end col -->
			
		</div>
		<!-- end row -->

		<!--
			The ID "widget-grid" will start to initialize all widgets below 
			You do not need to use widgets if you dont want to. Simply remove 
			the <section></section> and you can use wells or panels instead 
			-->

		<!-- widget grid -->
		<section id="widget-grid" class="">

			<!-- row -->
			<div class="row">
				
				<!-- NEW WIDGET START -->
				<article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
						<div>
							<div class="col-sm-4 col-md-4">
								Keywoard<br/>
								<input type="search" name="googlesearch">
							</div>
							<div class="col-sm-4 col-md-4 white" style="padding-top: 15px;">
								<div class="right">
								<input type="checkbox" name="vehicle" value="">
									<span style="background-color: #5dc156;">Active</span>
								<input type="checkbox" name="vehicle" value="">
									<span style="background-color: #6dd0ca;">Inactive</span>
								<input type="checkbox" name="vehicle" value="">
									<span style="background-color: #ffba42;">Cancel</span>
								</div>
							</div>
							<div class="col-sm-4 col-md-4">
								<button class="btn btn-primary right" id="m1s" data-toggle="modal" data-target="#myModal">Add new</button>
							</div>
						</div>
						
			
						<table id="jqgrid"></table>
						<div id="pjqgrid"></div>
						
						<br>
						<!-- <a href="javascript:void(0)" id="m1">Get Selected id's</a><br>
						<a href="javascript:void(0)" id="m1s">Select(Unselect) row 13</a> -->

				</article>
				<!-- WIDGET END -->
				
			</div>

			<!-- end row -->

		</section>
		<!-- end widget grid -->

	</div>
	<!-- END MAIN CONTENT -->

</div>
<!-- END MAIN PANEL -->
<!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-Adduser">
    
      <!-- Modal content-->
	  
      <div class="modal-content">
	  <form action='user-management.php' method='post' >
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          General Info
        </div>
        <div class="modal-body">
		<div class="row">
			<div class="col-sm-12 col-md-4 modal-bold">
			Status <font color="red"> *</font>
			</div>
			<div class="col-sm-12 col-md-8 white">
				<input type="radio" name="status" value="A" id="StatusA" required>
					<label style="background-color: #5dc156;" for="StatusA">Active</label>
				<input type="radio" name="status" value="I" id="StatusI">
					<label style="background-color: #6dd0ca;" for="StatusI">Inactive</label>
				<input type="radio" name="status" value="C" id="Statusc">
					<label style="background-color: #ffba42;" for="Statusc">Cancel</label>
			</div>
			<div class="col-sm-12 col-md-4 modal-bold">
			Type <font color="red"> *</font>
			</div>
			<div class="col-sm-12 col-md-8">
				<input type="radio" name="type" value="S" id="typeS" required>
					<label for="typeS">Staf</label>
				<input type="radio" name="type" value="M" id="typeM">
					<label for="typeM">Manager</label>
				<input type="radio" name="type" value="A" id="typeA">
					<label for="typeA">Admin</label>
			</div>
			<div class="col-sm-12 col-md-4 modal-bold">
			Username <font color="red">*</font>
			</div>
			<div class="col-sm-12 col-md-8">
				<input type="text" name="username" value="" required>
			</div>
			<div class="col-sm-12 col-md-4 modal-bold">
			Password <font color="red">*</font>
			</div>
			<div class="col-sm-12 col-md-8">
				<input type="text" name="password" value="" required>
			</div>
			<div class="col-sm-12 col-md-4 modal-bold">
			Email <font color="red">*</font>
			</div>
			<div class="col-sm-12 col-md-8">
				<input type="Email" name="email" value="" required>
			</div>
			<div class="col-sm-12 col-md-4 modal-bold">
			Remark
			</div>
			<div class="col-sm-8 col-md-8">
				<textarea name="Text1" cols="40" rows="5"></textarea>
			</div>
			<div class="col-md-12 footer">
				<button type="submit" name="submitAddUser" class="btn btn-info">Save</button>
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div></div>
        </div>
	  </form>
      </div>
      
    </div>
  </div>

<!-- ==========================CONTENT ENDS HERE ========================== -->

<!-- PAGE FOOTER -->
<?php
	// include page footer
	include("inc/footer.php");
?>
<!-- END PAGE FOOTER -->

<?php 
	//include required scripts
	include("inc/scripts.php"); 
?>

<!-- PAGE RELATED PLUGIN(S) 
<script src="..."></script>-->

<script src="<?php echo ASSETS_URL; ?>/js/plugin/jqgrid/jquery.jqGrid.min.js"></script>
<script src="<?php echo ASSETS_URL; ?>/js/plugin/jqgrid/grid.locale-en.min.js"></script>

<script type="text/javascript">
	$(document).ready(function() {

		var jqgrid_data = [{
			id : 1,
			date : "2007-10-01",
			name : "test",
			total : "210.00"
		}, {
			id : 2,
			date : "2007-10-02",
			name : "test2",
			total : "320.00"
		}, {
			id : 3,
			date : "2007-09-01",
			name : "test3",
			total : "430.00"
		}, {
			id : 4,
			date : "2007-10-04",
			name : "test",
			total : "210.00"
		}, {
			id : 5,
			date : "2007-10-05",
			name : "test2",
			total : "320.00"
		}, {
			id : "6",
			date : "2007-09-06",
			name : "test3",
			total : "430.00"
		}, {
			id : "7",
			date : "2007-10-04",
			name : "test",
			total : "210.00"
		}, {
			id : "8",
			date : "2007-10-03",
			name : "test2",
			total : "320.00"
		}, {
			id : "9",
			date : "2007-09-01",
			name : "test3",
			total : "430.00"
		}, {
			id : "10",
			date : "2007-10-01",
			name : "test",
			total : "210.00"
		}, {
			id : "11",
			date : "2007-10-02",
			name : "test2",
			total : "320.00"
		}, {
			id : "12",
			date : "2007-09-01",
			name : "test3",
			total : "430.00"
		}, {
			id : "13",
			date : "2007-10-04",
			name : "test",
			total : "210.00"
		}, {
			id : "14",
			date : "2007-10-05",
			name : "test2",
			total : "320.00"
		}, {
			id : "15",
			date : "2007-09-06",
			name : "test3",
			total : "430.00"
		}, {
			id : "16",
			date : "2007-10-04",
			name : "test",
			total : "210.00"
		}, {
			id : "17",
			date : "2007-10-03",
			name : "test2",
			total : "320.00"
		}, {
			id : "18",
			date : "2007-09-01",
			name : "test3",
			total : "430.00"
		}];

		jQuery("#jqgrid").jqGrid({
			data : jqgrid_data,
			datatype : "local",
			height : 'auto',
			colNames : ['Username', 'Email', 'Type', 'Status', ''],
			colModel : [
				{ name : 'act', index:'act', sortable:false },
				{ name : 'id', index : 'id' }, 
				{ name : 'date', index : 'date', editable : true }, 
				{ name : 'name', index : 'name', editable : true }, 
				{ name : 'total', index : 'total', align : "right", editable : true }],
			rowNum : 10,
			rowList : [10, 20, 30],
			pager : '#pjqgrid',
			sortname : 'id',
			toolbarfilter: true,
			viewrecords : true,
			sortorder : "asc",
			gridComplete: function(){
				var ids = jQuery("#jqgrid").jqGrid('getDataIDs');
				for(var i=0;i < ids.length;i++){
					var cl = ids[i];
					be = "<button class='btn btn-xs btn-default' data-original-title='Edit Row' onclick=\"jQuery('#jqgrid').editRow('"+cl+"');\"><i class='fa fa-pencil'></i></button>"; 
					se = "<button class='btn btn-xs btn-default' data-original-title='Save Row' onclick=\"jQuery('#jqgrid').saveRow('"+cl+"');\"><i class='fa fa-save'></i></button>";
					ca = "<button class='btn btn-xs btn-default' data-original-title='Cancel' onclick=\"jQuery('#jqgrid').restoreRow('"+cl+"');\"><i class='fa fa-times'></i></button>";  
					//ce = "<button class='btn btn-xs btn-default' onclick=\"jQuery('#jqgrid').restoreRow('"+cl+"');\"><i class='fa fa-times'></i></button>"; 
					//jQuery("#jqgrid").jqGrid('setRowData',ids[i],{act:be+se+ce});
					jQuery("#jqgrid").jqGrid('setRowData',ids[i],{act:be+se+ca});
				}	
			},
			editurl : "dummy.html",
			//caption : "SmartAmind jQgrid Skin",
			multiselect : true,
			autowidth : true,

			});
			jQuery("#jqgrid").jqGrid('navGrid', "#pjqgrid", {
				edit : false,
				add : false,
				del : true
			});
			jQuery("#jqgrid").jqGrid('inlineNav', "#pjqgrid");
			/* Add tooltips */
			$('.navtable .ui-pg-button').tooltip({
				container : 'body'
			});

			jQuery("#m1").click(function() {
				var s;
				s = jQuery("#jqgrid").jqGrid('getGridParam', 'selarrrow');
				alert(s);
			});
			jQuery("#m1s").click(function() {
				jQuery("#jqgrid").jqGrid('setSelection', "13");
			});
			
			// remove classes
			$(".ui-jqgrid").removeClass("ui-widget ui-widget-content");
		    $(".ui-jqgrid-view").children().removeClass("ui-widget-header ui-state-default");
		    $(".ui-jqgrid-labels, .ui-search-toolbar").children().removeClass("ui-state-default ui-th-column ui-th-ltr");
		    $(".ui-jqgrid-pager").removeClass("ui-state-default");
		    $(".ui-jqgrid").removeClass("ui-widget-content");
		    
		    // add classes
		    $(".ui-jqgrid-htable").addClass("table table-bordered table-hover");
		    $(".ui-jqgrid-btable").addClass("table table-bordered table-striped");
		   
		   
		    $(".ui-pg-div").removeClass().addClass("btn btn-sm btn-primary");
		    $(".ui-icon.ui-icon-plus").removeClass().addClass("fa fa-plus");
		    $(".ui-icon.ui-icon-pencil").removeClass().addClass("fa fa-pencil");
		    $(".ui-icon.ui-icon-trash").removeClass().addClass("fa fa-trash-o");
		    $(".ui-icon.ui-icon-search").removeClass().addClass("fa fa-search");
		    $(".ui-icon.ui-icon-refresh").removeClass().addClass("fa fa-refresh");
		    $(".ui-icon.ui-icon-disk").removeClass().addClass("fa fa-save").parent(".btn-primary").removeClass("btn-primary").addClass("btn-success");
		    $(".ui-icon.ui-icon-cancel").removeClass().addClass("fa fa-times").parent(".btn-primary").removeClass("btn-primary").addClass("btn-danger");
		  
			$( ".ui-icon.ui-icon-seek-prev" ).wrap( "<div class='btn btn-sm btn-default'></div>" );
			$(".ui-icon.ui-icon-seek-prev").removeClass().addClass("fa fa-backward");
			
			$( ".ui-icon.ui-icon-seek-first" ).wrap( "<div class='btn btn-sm btn-default'></div>" );
		  	$(".ui-icon.ui-icon-seek-first").removeClass().addClass("fa fa-fast-backward");		  	

		  	$( ".ui-icon.ui-icon-seek-next" ).wrap( "<div class='btn btn-sm btn-default'></div>" );
		  	$(".ui-icon.ui-icon-seek-next").removeClass().addClass("fa fa-forward");
		  	
		  	$( ".ui-icon.ui-icon-seek-end" ).wrap( "<div class='btn btn-sm btn-default'></div>" );
		  	$(".ui-icon.ui-icon-seek-end").removeClass().addClass("fa fa-fast-forward");
	  
	})

	$(window).on('resize.jqGrid', function () {
		$("#jqgrid").jqGrid( 'setGridWidth', $("#content").width() );
	})

</script>


<?php 
	//include footer
	include("inc/google-analytics.php"); 
?>