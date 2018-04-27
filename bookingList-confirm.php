<?php 
	session_start();
	include('inc/auth.php');
	include("inc/connectionToMysql.php");
	include("bookingList-controller.php");
	/////////////////////////////////////////////////////////
	//initilize the page
	require_once ("inc/init.php");
	
	//require UI configuration (nav, ribbon, etc.)
	require_once ("inc/config.ui.php");
	
	/*---------------- PHP Custom Scripts ---------
		
		YOU CAN SET CONFIGURATION VARIABLES HERE BEFORE IT GOES TO NAV, RIBBON, ETC.
	E.G. $page_title = "Custom Title" */
	
	$page_title = "Wait for Confirm";
	
	/* ---------------- END PHP Custom Scripts ------------- */
	
	//include header
	//you can add your custom css in $page_css array.
	//Note: all css files are inside css/ folder
	$page_css[] = "your_style.css";
	include ("inc/header.php");
	
	//include left panel (navigation)
	//follow the tree in inc/config.ui.php
	$page_nav["Booking"]["sub"]["Wait for Confirm"]["active"] = true;
	include ("inc/nav.php");	
?>

<style>
	.header{
	font-weight:bold;
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
	.error{
		color: red;
		font-weight: bold;
	}
	
</style>
<!-- ==========================CONTENT STARTS HERE ========================== -->
<!-- MAIN PANEL -->
<div id="main" role="main">
	
	<?php
		//configure ribbon (breadcrumbs) array("name"=>"url"), leave url empty if no url
		//$breadcrumbs["New Crumb"] => "http://url.com"
		$breadcrumbs["Booking"] = "";
		include("inc/ribbon.php");
	?>
	
	<!-- MAIN CONTENT -->
	<div id="content">
		
		<div class="row">
			<div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
				<h1 class="header">
					Ticket waiting for confirmation
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
					
					<!-- <div class="row header">
						<div class="col-sm-4 col-md-4">
							Keywoard<br/>
							<input id="column3_search" type="text" name="googlesearch">
						</div>
						<div class="col-xs-8 col-sm-4 col-md-6 status" style="padding-top: 5px;">
							<div class="filterbar">
								<input type="checkbox" name="status" id="StatusA" value="Active" onclick="filterCheckbox();" checked >
								<label for="StatusA" style="background-color: #5dc156;">Active</label>
								<input type="checkbox" name="status" id="StatusI" value="Inactive" onclick="filterCheckbox();" checked>
								<label for="StatusI" style="background-color: #6dd0ca;">Inactive</label>
								<input type="checkbox" name="status" id="StatusC" value="Cancel" onclick="filterCheckbox();" checked>
								<label for="StatusC" style="background-color: #ffba42;">Cancel</label>
							</div>
						</div>
						<div class="col-xs-4 col-sm-4 col-md-2 filterbar">
							<button class="btn btn-primary" id="m1s" data-whatever="" data-toggle="modal" data-target="#myModal">Add new</button>
						</div>
					</div> -->
					
					<div class="jarviswidget jarviswidget-color-darken" id="wid-id-0" data-widget-editbutton="false">
						<div>
							
							<!-- widget content -->
							<div class="widget-body no-padding">
								
						        <table id="dt_basic" class="table table-striped table-bordered table-hover" style="margin-top:0px" width="100%">
									<thead>			                
										<tr class="header">
											<th data-hide="phone">Service Datetime</th>
											<th data-class="expand">Product Name</th>
											<th data-hide="phone">Qty</th>
											<th data-hide="phone">Reservation Info</th>
											<th class="center"Action</th>
										</tr>
									</thead>
									<tbody>
									<?PHP
												$sql = "SELECT 	booking_detail_id, booking_detail_status, booking_detail_date, booking_detail_time, 
																booking_detail_qty, 
																booking_detail.createdatetime, booking_detail.createby,
																booking_detail.updatedatetime, booking_detail.updateby,
																product_name, product_desc, product_seat, product_for, 
																TIME_FORMAT(product_showtime, '%H:%i') as product_showtime, product_duration, 
																product_car_type, product_meal_type, product_status,
																supplier_name, supplier_type, supplier_reserv_tel, supplier_reserv_email, 
																supplier_reserv_line, supplier_reserv_fax, supplier_reserv_main,
																booking.booking_id, booking_name, booking_pax, booking_nat, booking_tel, 
																booking_line, booking_remark
												FROM booking_detail, product, supplier, booking
												WHERE booking_detail.product_id = product.product_id
														and product.supplier_id = supplier.supplier_id
														and booking_detail.booking_id = booking.booking_id
														and booking_detail.booking_detail_status = 'N'
												ORDER BY booking_detail.booking_detail_date, booking_detail.booking_detail_time";

												$result = mysqli_query($conn ,$sql);
												
												if(mysqli_num_rows($result) > 0){
												//show data for each row
													$numRow=0;
													while($row = mysqli_fetch_assoc($result)){
														$numRow++;
														// Production Option wording
														$ProductOption = "";
														if($row['supplier_type'] == 'A'){
															$SupplierType = 'Adventure';
														}else if($row['supplier_type'] == 'S'){
															$SupplierType = 'Show';
															$ProductOption = "(Show Time:".$row['product_showtime'];
															if($row['product_for'] == 'S'){
																$ProductOption = $ProductOption.", Senier";
															}else if($row['product_for'] == 'A'){
																$ProductOption = $ProductOption.", Adult";
															}else if($row['product_for'] == 'C'){
																$ProductOption = $ProductOption.", Child";
															}else if($row['product_for'] == 'I'){
																$ProductOption = $ProductOption.", Infant";
															}
															$ProductOption = $ProductOption.")";
														}else if($row['supplier_type'] == 'D'){
															$SupplierType = 'Day Trip';
															$ProductOption = "(".$row['product_desc'].", Trip Time:".$row['product_showtime']."-".$row['product_endtime'].")";
														}else if($row['supplier_type'] == 'T'){
															$SupplierType = 'Transport';
															$ProductOption = "(".$row['product_desc'];
															if ($row['product_car_type']=='T'){
																$ProductOption = $ProductOption."Car (Max passenger 4)";
															}else if($row['product_car_type']=='F'){
																$ProductOption = $ProductOption."Van (Max passenger 10)";
															}else if($row['product_car_type']=='E'){
																$ProductOption = $ProductOption."Bus (Max passenger 35)";
															}
															$ProductOption = $ProductOption.")";
														}else if($row['supplier_type'] == 'M'){
															$SupplierType = 'Meal';
															$ProductOption = "(".$row['product_desc'].")";
														}else if($row['supplier_type'] == 'O'){
															$SupplierType = 'Other';
															$ProductOption = "(".$row['product_desc'].")";
														}

														if ($row['supplier_reserv_main'] == "T")	{
															$MainContract = "Tel. ".$row['supplier_reserv_tel'];
														}else if ($row['supplier_reserv_main'] == "F")	{
															$MainContract = "Fax. ".$row['supplier_reserv_fax'];
														}else if ($row['supplier_reserv_main'] == "E")	{
															$MainContract = "Email. ".$row['supplier_reserv_email'];
														}else if ($row['supplier_reserv_main'] == "L")	{
															$MainContract = "Line or WhatApp. ".$row['supplier_reserv_line'];
														}
												?>
													<tr>
													<td><i class="fa fa-clock-o" title="<?php 
														echo "Booking ID : ".substr("00000000",1,6-strlen($row['booking_id'])).$row['booking_id'];
														echo "\nCustomer : ".$row['booking_name']."  ".$row['booking_tel']." ".$row['booking_line'];
														echo "\nPax : ".$row['booking_pax']."  ".$row['booking_nat'];
														echo "\n".$row['booking_remark'];
														echo "\nCreate : ".date("d/m/Y", strtotime($row['createdatetime']))." (".$row['createby'].")";
														echo "  Update : ".date("d/m/Y", strtotime($row['updatedatetime']))." (".$row['updateby'].")";?>"></i> <?=date("d/m/Y", strtotime($row['booking_detail_date']))." ".date("H:i", strtotime($row['booking_detail_time']))?></td>
													<td><?="<b>".$row['product_name']."</b>  ".$ProductOption?></td>
													<td><?=number_format($row['booking_detail_qty'],0)?></td>
													<td><i class="fa fa-info-circle" title="<?="Tel. ".$row['supplier_reserv_tel']."\n Fax. ".$row['supplier_reserv_fax']."\n Email. ".$row['supplier_reserv_email']."\n Line or WhatApp. ".$row['supplier_reserv_line']?>"></i> <?="[".$SupplierType."] ".$row['supplier_name']."<br>".$MainContract?></td>
													<td class="center">
															<a onclick="resetModal();" class="btn btn-small bg-color-green txt-color-white"
															data-toggle="modal"
															data-target="#myModal_Confirm"
															data-whatever="<?=$row['booking_detail_id']?>">Confirm</a>

															<a onclick="resetModal();" class="btn btn-small bg-color-orange txt-color-white"
															data-toggle="modal"
															data-target="#myModal"
															data-whatever="<?=$row['booking_detail_id']?>">Reject</a>
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
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="header">Reject</h4>
			</div>
			<form action='bookingList-confirm.php' method='post' id="product-form" class="smart-form">
				<header>
					Reason
				</header>
					<section>
						<div class="row">
							<div class="input" style="padding: 25px 20px 0px 20px;">
								<label class="input">
									<textarea rows="4" name="txbbooking_detail_reject_reason" id="txbbooking_detail_reject_reason"></textarea>
								</label>
							</div>
						</div>
					</section>
				<footer>		
					<div class="row center">
						<input type="hidden" name="booking_detail_id" id="booking_detail_id">
						<button type="submit" class="btn btn-primary" style="float: unset; font-weight: 400;">Reject</button>
						<button type="button" class="btn btn-default" style="float: unset; font-weight: 400;" data-dismiss="modal">Cancel</button>
					</div>	
				</footer>		
			</form>
		</div>
	</div>
</div>

<!-- Modal 2-->
<div class="modal fade" id="myModal_Confirm" role="dialog">
    <div class="modal-dialog modal-Adduser">
		
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="header">Confirm</h4>
			</div>
			<form action='bookingList-confirm.php' method='post' id="confirm-form" class="smart-form">
				<header>
					Confirmation No
				</header>
					<section>
						<div class="row">
							<div class="input" style="padding: 25px 20px 0px 20px;">
									<input type="text" name="txbbooking_detail_confirm" id="txbbooking_detail_confirm">
							</div>
						</div>
					</section>
				<footer>		
					<div class="row center">
						<input type="hidden" name="booking_detail_id2" id="booking_detail_id2">
						<button type="submit" class="btn btn-primary" style="float: unset; font-weight: 400;">Confirm</button>
						<button type="button" class="btn btn-default" style="float: unset; font-weight: 400;" data-dismiss="modal">Cancel</button>
					</div>	
				</footer>		
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
			var dataString = 'booking_detail_id=' + recipient;
			console.log('dataString :'+dataString);
			$.ajax({
				
				url: "fetchEdit.php",
				type:"POST",
				data: dataString,
				dataType : 'json',
					
				success: function (data) {
					$('#booking_detail_id').val(data.booking_detail_id);
				},
				error: function(err) {
					console.log('err : '+err);
				}
			});  
		});

		$('#myModal_Confirm').on('show.bs.modal', function (event) {
			var button = $(event.relatedTarget) // Button that triggered the modal
			var recipient = button.data('whatever') // Extract info from data-* attributes
			var modal = $(this);
			var dataString = 'booking_detail_id=' + recipient;
			console.log('dataString :'+dataString);
			
			$.ajax({
				
				url: "fetchEdit.php",
				type:"POST",
				data: dataString,
				dataType : 'json',

				success: function (data) {
					$('#booking_detail_id2').val(data.booking_detail_id);		
				},
				error: function(err) {
					console.log('err : '+err);
				}
			});  
		});
		//// --------------------------- Validate------------------------------
		var errorClass = 'invalid';
		var errorElement = 'em';

		var $contactForm = $("#confirm-form").validate({
				errorClass		: errorClass,
				errorElement	: errorElement,
				highlight: function(element) {
					$(element).parent().removeClass('state-success').addClass('state-error');
					//$(element).parent().addClass("required");
					if($(element).parent().hasClass( "required" )){
						$(element).parent().css("border-left", "7px solid #FF3333");
					}
					$(element).removeClass('valid');
				},
				unhighlight: function(element) {
					$(element).parent().removeClass('state-error').addClass('state-success');
					//$(element).parent().removeClass("required");
					if($(element).parent().hasClass( "required" )){
						$(element).parent().css("border-left", "7px solid #047803");
					}
					$(element).addClass('valid');
				},
				submitHandler : function(form) {
				if (confirm("Do you want to save the data?")) {
					form.submit();
				}
				},

				// Do not change code below
				errorPlacement : function(error, element) {
					error.insertAfter(element.parent());
				}
			});

			var $contactForm2 = $("#product-form").validate({
				errorClass		: errorClass,
				errorElement	: errorElement,
				highlight: function(element) {
					$(element).parent().removeClass('state-success').addClass('state-error');
					//$(element).parent().addClass("required");
					if($(element).parent().hasClass( "required" )){
						$(element).parent().css("border-left", "7px solid #FF3333");
					}
					$(element).removeClass('valid');
				},
				unhighlight: function(element) {
					$(element).parent().removeClass('state-error').addClass('state-success');
					//$(element).parent().removeClass("required");
					if($(element).parent().hasClass( "required" )){
						$(element).parent().css("border-left", "7px solid #047803");
					}
					$(element).addClass('valid');
				},
				submitHandler : function(form) {
				if (confirm("Do you want to save the data?")) {
					form.submit();
				}
				},
				// Rules for form validation
				rules : {
					txbbooking_detail_reject_reason : {
						required : true
					}		
				},
				// Messages for form validation
				messages : {
					txbbooking_detail_reject_reason : {
						required : 'Please fill Remark'
					}
				},

				// Do not change code below
				errorPlacement : function(error, element) {
					error.insertAfter(element.parent());
				}
			});
		});

		/* END BASIC */

	function resetModal(){
			$( "#product-form" ).find( ".state-error" ).removeClass( "state-error" );
			$( "#product-form" ).find( ".state-success" ).removeClass( "state-success" );
			$( "#product-form" ).find( ".required" ).css("border-left", "7px solid #FF3333");
			$( "em" ).remove();
		}
</script>

<?php
	//include footer
	include ("inc/google-analytics.php");
?>																														