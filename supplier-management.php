<?php 
	session_start();
	include('inc/auth.php');
	include("inc/connectionToMysql.php");
	include("registerSupplierController.php");
	/////////////////////////////////////////////////////////
	//initilize the page
	require_once ("inc/init.php");
	
	//require UI configuration (nav, ribbon, etc.)
	require_once ("inc/config.ui.php");
	
	/*---------------- PHP Custom Scripts ---------
		
		YOU CAN SET CONFIGURATION VARIABLES HERE BEFORE IT GOES TO NAV, RIBBON, ETC.
	E.G. $page_title = "Custom Title" */
	
	$page_title = "Supplier Management";
	
	/* ---------------- END PHP Custom Scripts ------------- */
	
	//include header
	//you can add your custom css in $page_css array.
	//Note: all css files are inside css/ folder
	$page_css[] = "your_style.css";
	include ("inc/header.php");
	
	//include left panel (navigation)
	//follow the tree in inc/config.ui.php
	$page_nav["Setup"]["sub"]["Supplier Management"]["active"] = true;
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
	
</style>
<!-- ==========================CONTENT STARTS HERE ========================== -->
<!-- MAIN PANEL -->
<div id="main" role="main">
	
	<?php
		//configure ribbon (breadcrumbs) array("name"=>"url"), leave url empty if no url
		//$breadcrumbs["New Crumb"] => "http://url.com"
		$breadcrumbs["Setup"] = "";
		include("inc/ribbon.php");
	?>
	
	<!-- MAIN CONTENT -->
	<div id="content">
		
		<div class="row">
			<div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
				<h1 class="header">
					Supplier
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
								<input type="checkbox" name="status" id="StatusA" value="Active" onclick="filterCheckbox();" checked>
								<label for="StatusA" style="background-color: #5dc156;">Active</label>
								<input type="checkbox" name="status" id="StatusI" value="Inactive" onclick="filterCheckbox();" checked>
								<label for="StatusI" style="background-color: #6dd0ca;">Inactive</label>
								<input type="checkbox" name="status" id="StatusC" value="Cancel" onclick="filterCheckbox();" checked>
								<label for="StatusC" style="background-color: #ffba42;">Cancel</label>
							</div>
						</div>
						<div class="col-xs-4 col-sm-4 col-md-2 filterbar">
							<button class="btn btn-primary" data-whatever="" id="m1s" data-toggle="modal" data-target="#myModal" >Add new</button>
						</div>
					</div>
					
					<div class="jarviswidget jarviswidget-color-darken" id="wid-id-0" data-widget-editbutton="false">
						<div>
							
							<!-- widget content -->
							<div class="widget-body no-padding">
								
						        <table id="dt_basic" class="table table-striped table-bordered table-hover" style="margin-top:0px" width="100%">
									<thead>			                
										<tr class="header">
											<th data-hide="phone">Supplier name</th>
											<th data-class="expand">Product Type</th>
											<th data-hide="phone">Tel</th>
											<th>Status</th>
											<th></th>
										</tr>
									</thead>
									<tbody>
										<?PHP
											$sql = "SELECT `supplierid`, `name`, `type`,`tel`,`status` FROM `supplier` ";
											$result = mysqli_query($conn ,$sql);
											if(mysqli_num_rows($result) > 0){
												//show data for each row
												while($row = mysqli_fetch_assoc($result)){
													$supplierName = $row['name'];
													if($row['status'] == 'A'){
														$statusSupplier = '<font color="green">Active</font>';
														}else if($row['status'] == 'I'){
														$statusSupplier = 'Inactive';
														}else if($row['status'] == 'C'){
														$statusSupplier = '<font color="red">Cancel</font>';
													}
													if($row['type'] == 'T'){
														$typeSupplier = 'Ticket';
														}else if($row['type'] == 'D'){
														$typeSupplier = 'Day Trip';
														}else if($row['type'] == 'C'){
														$typeSupplier = 'Car';
													}?>
													<tr>
														<td><?=$supplierName?></td>
														<td><?=$typeSupplier?></td>
														<td><?=$row['tel']?></td>
														<td><?=$statusSupplier?></td>
														<td><a class="btn btn-small btn-primary"
															data-toggle="modal"
															data-target="#myModal"
															data-whatever="<?=$row['supplierid']?>" >Edit</a>
														</td>
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
			<form action='supplier-management.php' method='post' >
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="header">Supplier</h4>
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
								<input type="radio" name="status" value="C" id="m_StatusC">
								<label style="background-color: #ffba42;" for="m_StatusC">Cancel</label>
							</div>
							<div class="col-sm-4 col-md-4 header">
								Type <font color="red"> *</font>
							</div>
							<div class="col-sm-8 col-md-8">
								<input type="radio" name="type" value="T" id="m_TypeT" required>
								<label for="m_TypeT">Ticket</label>
								<input type="radio" name="type" value="D" id="m_TypeD">
								<label for="m_TypeD">Day Tip</label>
								<input type="radio" name="type" value="C" id="m_TypeC">
								<label for="m_TypeC">Car</label>
							</div>
							<div class="col-sm-12 col-md-4 header">
								Destination <font color="red">*</font>
							</div>
							<div class="col-sm-12 col-md-8">
								<input type="text" id="s_Destination" name="s_Destination" value="" required>
							</div>
							<div class="col-sm-12 col-md-4 header">
								Supplier Name <font color="red">*</font>
							</div>
							<div class="col-sm-12 col-md-8">
								<input type="text" id="s_Name" name="s_Name" value="" required>
							</div>
							<div class="col-sm-12 col-md-4 header">
								Detail <font color="red">*</font>
							</div>
							<div class="col-sm-12 col-md-8">
								<textarea cols="40" rows="5" id="s_Detail" name="s_Detail"></textarea>
							</div>
							<div class="col-sm-12 col-md-4 header">
								Address
							</div>
							<div class="col-sm-12 col-md-8">
								<input type="text" id="s_Address" name="s_Address" value="" required>
							</div>
							<div class="col-sm-12 col-md-4 header">
								Tel
							</div>
							<div class="col-sm-12 col-md-8">
								<input type="text" id="s_Tel" name="s_Tel" value="" required>
							</div>
							
						</div>
						<div class="sectionHead" >Finance</div>
						<div class="card-block madalContent">
							<div class="col-xs-4 col-sm-4 col-md-4 header">
								Pay Type <font color="red">*</font>
							</div>
							<div class="col-xs-8 col-sm-8 col-md-8">
								<input type="radio" name="PayType" value="C" id="p_TypeC" required>
								<label for="p_TypeN">Credit</label>
								<input type="radio" name="PayType" value="D" id="p_TypeD">
								<label for="p_TypeS">Deposit</label>
							</div>
							<div class="col-sm-12 col-md-4 header">
								Maximum Credit <font color="red"> *</font>
							</div>
							<div class="col-sm-12 col-md-8">
								<input type="text" id="s_MaximumCredit" name="s_MaximumCredit" value="">
							</div>
							<div class="col-sm-12 col-md-4 header">
								Deposit Amount <font color="red"> *</font>
							</div>
							<div class="col-sm-12 col-md-8">
								<input type="text" id="s_DepositAmount" name="s_DepositAmount" value="">
							</div>
							
						</div>
						<div class="sectionHead">Contact - Resevation</div>
						<div class="card-block madalContent">
							<div class="col-sm-12 col-md-4 header">
								Name <font color="red">*</font>
							</div>
							<div class="col-sm-12 col-md-8">
								<input type="text" id="s_Bookingcontact" name="s_Bookingcontact" value="" required>
							</div>
							<div class="col-sm-12 col-md-4 header">
								Tel
							</div>
							<div class="col-sm-12 col-md-8">
								<input type="text" id="s_Bookingtel" name="s_Bookingtel" value="">
							</div>
							<div class="col-sm-12 col-md-4 header">
								Email
							</div>
							<div class="col-sm-12 col-md-8">
								<input type="Email" id="s_Bookingemail" name="s_Bookingemail" value="">
							</div>
							
						</div>
						<div class="sectionHead">Contract - Account</div>
						<div class="card-block madalContent">
							<div class="col-sm-12 col-md-4 header">
								Name <font color="red">*</font>
							</div>
							<div class="col-sm-12 col-md-8">
								<input type="text" id="s_Accountcontact" name="s_Accountcontact" value="" required>
							</div>
							<div class="col-sm-12 col-md-4 header">
								Tel
							</div>
							<div class="col-sm-12 col-md-8">
								<input type="text" id="s_Accounttel" name="s_Accounttel" value="">
							</div>
							<div class="col-sm-12 col-md-4 header">
								Email
							</div>
							<div class="col-sm-12 col-md-8">
								<input type="Email" id="s_Accountemail" name="s_Accountemail" value="">
							</div>
						</div>
						<div class="sectionHead">Other</div>
						<div class="card-block madalContent">
							<div class="col-sm-12 col-md-4 header">
								Close Information
							</div>
							<div class="col-sm-12 col-md-8">
								<input type="text" id="s_Closeinformation" name="s_Closeinformation" value="" required>
							</div>				
							<div class="col-sm-12 col-md-4 header">
								Note
							</div>
							<div class="col-sm-12 col-md-8">
								<textarea cols="40" rows="5" id="s_Note" name="s_Note"></textarea>
							</div>
							
						</div>
						
						<div class="col-md-12 center">
							<input type="hidden" name="supplier_id" id="supplier_id" />
							<button type="submit" name="submitAddSupplier" id="submitAddSupplier" value=""  class="btn btn-info mr-20" value="" onclick="return confirm('Do you want to save the data')">Save</button>
							<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						</div></div>
				</div>
			</form>
		</div>
		
	</div>
</div>
<!-- ==========================CONTENT ENDS HERE ========================== -->

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
	var otable;
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
		otable = $('#dt_basic').dataTable();
		$( "#column3_search" ).keyup(function() {
			//alert( "Handler for .keyup() called." );
			table_dtbasic.search( this.value ).draw();
		});
		
		$('#myModal').on('show.bs.modal', function (event) {
			var button = $(event.relatedTarget) // Button that triggered the modal
			var recipient = button.data('whatever') // Extract info from data-* attributes
			var modal = $(this);
			var dataString = 'supplier_id=' + recipient;
			console.log('dataString :'+dataString);
            $.ajax({
                
                url: "fetchEdit.php",
				type:"POST",
                data: dataString,
				dataType : 'json',
                
                success: function (data) {
					if(data != null){
						$('#m_Status' + data.status).prop('checked',true);
						$('#m_Type' + data.type).prop('checked',true);
						$('#p_Type' + data.paytype).prop('checked',true);
						$('#s_Destination').val(data.destination);  
						$('#s_Name').val(data.name);  
						$('#s_Detail').val(data.detail);  
						$('#s_Address').val(data.address);   
						$('#s_Tel').val(data.tel);
						$('#s_MaximumCredit').val(data.maximumcredit);
						//$('#s_DepositAmount').val();
						$('#s_Bookingcontact').val(data.bookingcontact);
						$('#s_Bookingtel').val(data.bookingtel);
						$('#s_Bookingemail').val(data.bookingemail);
						$('#s_Accountcontact').val(data.accountcontact);
						$('#s_Accounttel').val(data.accounttel);
						$('#s_Accountemail').val(data.accountemail);
						$('#s_Closeinformation').val(data.closeinformation);
						$('#s_Note').val(data.note);
						$('#supplier_id').val(data.supplierid);
						$('#submitAddSupplier').val("Update");  
					}else{
					
						$('#m_StatusA').prop('checked',false);
						$('#m_StatusI').prop('checked',false);
						$('#m_StatusC').prop('checked',false);
						$('#m_TypeT').prop('checked',false);
						$('#m_TypeD').prop('checked',false);
						$('#m_TypeC').prop('checked',false);
						$('#p_TypeD').prop('checked',false);
						$('#p_TypeC').prop('checked',false);
						$('#s_Destination').val('');
						$('#s_Name').val(''); 
						$('#s_Detail').val('');  
						$('#s_Address').val('');
						$('#s_Tel').val('');
						$('#s_MaximumCredit').val('');
						//$('#s_DepositAmount').val();
						$('#s_Bookingcontact').val('');
						$('#s_Bookingtel').val('');
						$('#s_Bookingemail').val('');
						$('#s_Accountcontact').val('');
						$('#s_Accounttel').val('');
						$('#s_Accountemail').val('');
						$('#s_Closeinformation').val('');
						$('#s_Note').val('');
						$('#supplier_id').val('');
						$('#submitAddSupplier').val("Insert");
					}
				},
                error: function(err) {
                    console.log('err : '+err);
					
				}
			});  
		});
	});
	
	/* END BASIC */
	function filterCheckbox(){
		
		var types = $('input:checkbox[name="status"]:checked').map(function() {
			return '^' + this.value + '\$';
		}).get().join('|');
		//filter in column 0, with an regex, no smart filtering, no inputbox,not case sensitive
		//console.log(types);
		otable.fnFilter(types, 3, true, false, false, false);
	}
	
	
</script>

<?php
	//include footer
	include ("inc/google-analytics.php");
?>																																						