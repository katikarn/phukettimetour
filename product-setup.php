<?php 
	session_start();
	include("inc/connectionToMysql.php");
	include("registerUserController.php");
/////////////////////////////////////////////////////////
	//initilize the page
	require_once ("inc/init.php");
	
	//require UI configuration (nav, ribbon, etc.)
	require_once ("inc/config.ui.php");
	
	/*---------------- PHP Custom Scripts ---------
		
		YOU CAN SET CONFIGURATION VARIABLES HERE BEFORE IT GOES TO NAV, RIBBON, ETC.
	E.G. $page_title = "Custom Title" */
	
	$page_title = "Product Setup";
	
	/* ---------------- END PHP Custom Scripts ------------- */
	include("inc/loginDataBase.php");
	//include header
	//you can add your custom css in $page_css array.
	//Note: all css files are inside css/ folder
	$page_css[] = "your_style.css";
	include ("inc/header.php");
	
	//include left panel (navigation)
	//follow the tree in inc/config.ui.php
	$page_nav["Setup"]["sub"]["Product Setup"]["active"] = true;
	include ("inc/nav.php");
?>
<style>
	.header{
		font-weight:bold;
		margin-top: 6px;
	}
	
	.row{
		margin-bottom:10px;
	}
	
	#dt_basic{
		margin-top: 0px !important;
	}
	
	.filterbar{
		// float: right;
		margin-top: 20px;
		text-align: center;
		white-space: nowrap;
	}
	
	.status label{
		color:#fff;
		margin-right: 20px;
		border-radius: 4px;
		border: 1px solid #ccc;
		padding: 2px;
	}
	
	label, .mr-20{
		margin-right:	20px;
	}
	
	.modal-header{
		background-color: royalblue;
		color: #fff;
	}
	
	.center{
		text-align:	center;
	}
	
	input[type=text], select, input[type=email], textarea{
		width: 100%;
		padding: 5px;
		margin: 8px 0px;
		border: 1px solid #ccc;
		border-radius: 4px;
	}
	
	textarea{
		resize:none;
	}

	.sectionHead
	{
	    width: 100%;
	    font-weight: bolder;
	    font-size: 15px;
	    margin-bottom: 11px;
	}

	.madalContent{
		border-left: 7px solid #3276b1;
	    border-radius: 5px;
	    display: flow-root;
	    background-color: #fafafa;
	    margin-bottom: 10px;
	    padding: 5px 0px;
    	box-shadow: 2px 2px #eee;
	}
}
	
</style>
<!-- ==========================CONTENT STARTS HERE ========================== -->
<!-- MAIN PANEL -->
<div id="main" role="main">
	
	<?php
		//configure ribbon (breadcrumbs) array("name"=>"url"), leave url empty if no url
		//$breadcrumbs["New Crumb"] => "http://url.com"
		$breadcrumbs["Tables"] = "";
		include("inc/ribbon.php");
	?>
	
	<!-- MAIN CONTENT -->
	<div id="content">
		
		<div class="row">
			<div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
				<h1 class="header">
					Product
				</h1>
			</div>
			<div class="col-xs-12 col-sm-5 col-md-5 col-lg-8">
				
			</div>
		</div>
		
		<!-- widget grid -->
		<section id="widget-grid" class="">
			
			<!-- row -->
			<div class="row">
				
				<!-- NEW WIDGET START -->
				<article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

					<div class="row header">
						<div class="col-sm-4 col-md-4">
							Keywoard<br/>
							<input id="column3_search" type="text" name="googlesearch">
						</div>
						<div class="col-xs-8 col-sm-4 col-md-6 status" style="padding-top: 5px;">
							<div class="filterbar">
							<input type="checkbox" name="vehicle" id="StatusA" value="">
								<label for="StatusA" style="background-color: #5dc156;">Active</label>
							<input type="checkbox" name="vehicle" id="StatusI" value="">
								<label for="StatusI" style="background-color: #6dd0ca;">Inactive</label>
							<input type="checkbox" name="vehicle" id="StatusC" value="">
								<label for="StatusC" style="background-color: #ffba42;">Cancel</label>
							</div>
						</div>
						<div class="col-xs-4 col-sm-4 col-md-2 filterbar">
							<button class="btn btn-primary" id="m1s" data-toggle="modal" data-target="#myModal">Add new</button>
						</div>
					</div>

					<div class="jarviswidget jarviswidget-color-darken" id="wid-id-0" data-widget-editbutton="false">
						<div>
						
							<!-- widget content -->
							<div class="widget-body no-padding">
								
						        <table id="dt_basic" class="table table-striped table-bordered table-hover" style="margin-top:0px" width="100%">
									<thead>			                
										<tr class="header">
											<th data-hide="phone">ID</th>
											<th data-class="expand">Name</th>
											<th data-hide="phone">Supplier</th>
											<th data-hide="phone">Type</th>
											<th>Status</th>
											<!-- <th data-hide="phone,tablet"><i class="fa fa-fw fa-map-marker txt-color-blue hidden-md hidden-sm hidden-xs"></i> Zip</th> -->
											<!-- <th data-hide="phone,tablet">City</th> -->
											<!-- <th data-hide="phone,tablet"><i class="fa fa-fw fa-calendar txt-color-blue hidden-md hidden-sm hidden-xs"></i> Date</th> -->
										</tr>
									</thead>
									<tbody>
										<?PHP
											$sql = "SELECT `userid`, `username`, `email`, `password`, `type`, `status`,
												   `createdatetime`, `createby`, `updatedatetime`, `updateby` FROM `user` ";
												$result = mysqli_query($conn ,$sql);
												if(mysqli_num_rows($result) > 0){
													//show data for each row
												while($row = mysqli_fetch_assoc($result)){
													if($row['status'] == 'A'){
														$statusUser = '<font color="green">Active</font>';
													}else if($row['status'] == 'I'){
														$statusUser = 'Inactive';
													}else if($row['status'] == 'C'){
														$statusUser = '<font color="red">Cancel</font>';
													}
												 if($row['type'] == 'S'){
														$typeUser = 'Staf';
													}else if($row['type'] == 'M'){
														$typeUser = 'Manager';
													}else if($row['type'] == 'A'){
														$typeUser = 'Admin';
												 }?>
												<tr>
													 <td><?=$row['username']?></td>
													 <td><?=$row['email']?></td>
													 <td><?=$typeUser?></td>
													  <td><?=$typeUser?></td>
													 <td><?=$statusUser?></td>
												</tr>
												<?PHP
												}}
										?>
								
									</tbody>
								</table>								
							</div>					
						</div>
					</div>
				</article>
			</div>
		</section>		
	</div>
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
          <h4 class="header">Product</h4>
        </div>
        <div class="modal-body">
		<div class="row" style="margin">
			<div class="sectionHead">General Info</div>
			<div class="card-block madalContent">
				<div class="col-sm-4 col-md-4 header">
				Status <font color="red"> *</font>
				</div>
				<div class="col-sm-8 col-md-8 status">
					<input type="radio" name="status" value="A" id="m_StatusA" required>
						<label style="background-color: #5dc156;" for="m_StatusA">Active</label>
					<input type="radio" name="status" value="I" id="m_StatusI">
						<label style="background-color: #6dd0ca;" for="m_StatusI">Inactive</label>
					<input type="radio" name="status" value="C" id="m_Statusc">
						<label style="background-color: #ffba42;" for="m_Statusc">Cancel</label>
				</div>
				<div class="col-sm-12 col-md-4 header">
					Name <font color="red">*</font>
				</div>
				<div class="col-sm-12 col-md-8">
					<input type="text" name="agentName" value="" required>
				</div>
				<div class="col-sm-12 col-md-4 header">
					Supplier <font color="red">*</font>
				</div>
				<div class="col-sm-12 col-md-8">
					<input type="text" name="username" value="" required>
				</div>
				<div class="col-xs-4 col-sm-4 col-md-4 header">
					Type <font color="red">*</font>
				</div>
				<div class="col-xs-8 col-sm-8 col-md-8">
					<input type="radio" name="priceType" value="Normat" id="p_TypeN" required>
						<label for="p_TypeN">Ticket</label>
					<input type="radio" name="priceType" value="Special" id="p_TypeS">
						<label for="p_TypeS">Day Trip</label>
					<input type="radio" name="priceType" value="Normat" id="p_TypeN" required>
						<label for="p_TypeN">Car</label>
				</div>
				<div class="col-sm-12 col-md-4 header">
					Detail
				</div>
				<div class="col-sm-12 col-md-8">
					<textarea name="Text1" cols="40" rows="5"></textarea>
				</div>	
			</div>
			<div class="sectionHead" >Finance</div>
			<div class="card-block madalContent">
				<div class="col-sm-12 col-md-4 header">
					Cost Price <font color="red"> *</font>
				</div>
				<div class="col-sm-12 col-md-8">
					<input type="text" name="maxCredit" value="" required>
				</div>
				<div class="col-sm-12 col-md-4 header">
					Normal Price <font color="red">*</font>
				</div>
				<div class="col-sm-12 col-md-8">
					<input type="text" name="creditTerm" value="" required> 
				</div>
				<div class="col-sm-12 col-md-4 header">
					Sales Price1<font color="red">*</font>
				</div>
				<div class="col-sm-12 col-md-8">
					<input type="text" name="creditTerm" value="" required> 
				</div>
				<div class="col-sm-12 col-md-4 header">
					Sales Price2<font color="red">*</font>
				</div>
				<div class="col-sm-12 col-md-8">
					<input type="text" name="creditTerm" value="" required> 
				</div>				
			</div>
			<div class="sectionHead">Tricket Info</div>
			<div class="card-block madalContent">
				<div class="col-xs-4 col-sm-4 col-md-4 header">
					Seat Type <font color="red">*</font>
				</div>
				<div class="col-xs-8 col-sm-8 col-md-8">
					<input type="radio" name="priceType" value="Normat" id="p_TypeN" required>
						<label for="p_TypeN">Open</label>
					<input type="radio" name="priceType" value="Special" id="p_TypeS">
						<label for="p_TypeS">Close</label>
				</div>
				<div class="col-xs-4 col-sm-4 col-md-4 header">
					Ticket Type <font color="red">*</font>
				</div>
				<div class="col-xs-8 col-sm-8 col-md-8">
					<input type="radio" name="priceType" value="Normat" id="p_TypeN" required>
						<label for="p_TypeN">Same Price</label>
					<input type="radio" name="priceType" value="Special" id="p_TypeS">
						<label for="p_TypeS">Adult</label>
					<input type="radio" name="priceType" value="Normat" id="p_TypeN" required>
						<label for="p_TypeN">Chident</label>
					<input type="radio" name="priceType" value="Special" id="p_TypeS">
						<label for="p_TypeS">Senier</label>
				</div>
				<div class="col-sm-12 col-md-4 header">
				Show Time <font color="red">*</font>
				</div>
				<div class="col-sm-12 col-md-8">
					<input type="text" name="conatactName" value="">
				</div>
			</div>
			<div class="sectionHead">Day Trip Info</div>
			<div class="card-block madalContent">
				<div class="col-xs-4 col-sm-4 col-md-4 header">
					Free pickup <font color="red">*</font>
				</div>
				<div class="col-xs-8 col-sm-8 col-md-8">
					<input type="radio" name="priceType" value="Normat" id="p_TypeN" required>
						<label for="p_TypeN">Yes</label>
					<input type="radio" name="priceType" value="Special" id="p_TypeS">
						<label for="p_TypeS">No</label>
				</div>
				<div class="col-sm-12 col-md-4 header">
				Min <font color="red">*</font>
				</div>
				<div class="col-sm-12 col-md-8">
					<input type="text" name="conatactName" value="">
				</div>
				<div class="col-sm-12 col-md-4 header">
				Max <font color="red">*</font>
				</div>
				<div class="col-sm-12 col-md-8">
					<input type="text" name="conatactName" value="">
				</div>
				<div class="col-sm-12 col-md-4 header">
				Detail <font color="red">*</font>
				</div>
				<div class="col-sm-8 col-md-8">
					<textarea name="Text1" cols="40" rows="5"></textarea>
				</div>
			</div>
			<div class="sectionHead">Car Info</div>
			<div class="card-block madalContent">
				<div class="col-sm-12 col-md-4 header">
				Car Type <font color="red">*</font>
				</div>
				<div class="col-sm-12 col-md-8">
					<input type="text" name="conatactName" value="">
				</div>
				<div class="col-sm-12 col-md-4 header">
				Max Seat <font color="red">*</font>
				</div>
				<div class="col-sm-12 col-md-8">
					<input type="text" name="conatactName" value="">
				</div>
			</div>
			
			<div class="col-md-12 center">
				<button type="submit" name="submitAddUser" class="btn btn-info mr-20">Save</button>
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div></div>
        </div>
	  </form>
      </div>
      
    </div>
  </div>
	<!-- ==========================CONTENT ENDS HERE ========================== -->

	<!-- PAGE FOOTER -->
	<?php // include page footer
	include ("inc/footer.php");
	?>
	<!-- END PAGE FOOTER -->

	<?php //include required scripts
	include ("inc/scripts.php");
	?>

	<!-- PAGE RELATED PLUGIN(S) -->
	<script src="<?php echo ASSETS_URL; ?>/js/plugin/datatables/jquery.dataTables.min.js"></script>
	<script src="<?php echo ASSETS_URL; ?>/js/plugin/datatables/dataTables.colVis.min.js"></script>
	<script src="<?php echo ASSETS_URL; ?>/js/plugin/datatables/dataTables.tableTools.min.js"></script>
	<script src="<?php echo ASSETS_URL; ?>/js/plugin/datatables/dataTables.bootstrap.min.js"></script>
	<script src="<?php echo ASSETS_URL; ?>/js/plugin/datatable-responsive/datatables.responsive.min.js"></script>

	<script type="text/javascript">

	// DO NOT REMOVE : GLOBAL FUNCTIONS!

	$(document).ready(function() {

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
		
		var breakpointDefinition = {
			tablet : 1024,
			phone : 480
		};
		
		$('#dt_basic').dataTable({
			"sDom": 
			"t"+
			"<'dt-toolbar-footer'<'col-sm-6 col-xs-12 hidden-xs'i><'col-xs-12 col-sm-6'p>>",
			"autoWidth" : true,
			"preDrawCallback" : function() {
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
		/* Custom Search box*/
		var table_dtbasic = $('#dt_basic').DataTable();

		$( "#column3_search" ).keyup(function() {
		  //alert( "Handler for .keyup() called." );
			table_dtbasic.search( this.value ).draw();
		});
	});

	/* END BASIC */


	</script>

	<?php
	//include footer
	include ("inc/google-analytics.php");
	?>																														