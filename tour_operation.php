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
	
	$page_title = "Tour Operation";
	
	/* ---------------- END PHP Custom Scripts ------------- */
	
	//include header
	//you can add your custom css in $page_css array.
	//Note: all css files are inside css/ folder
	$page_css[] = "your_style.css";
	include ("inc/header.php");
	
	//include left panel (navigation)
	//follow the tree in inc/config.ui.php
	$page_nav["Tour Operation"]["sub"]["Daily Tour Operation"]["active"] = true;
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
	 /*float: right;*/
	margin-top: 20px;
	text-align: center;
	white-space: nowrap;
	}
	
	.status span{
		color:#fff;
		border-radius: 4px;
		border: 1px solid #ccc;
		padding: 2px;
	}
	
	label, .mr-20{
	margin-right:	20px;
	}
	
	.center{
	text-align:	center;
	}
	
	input[type=text], select, input[type=email]{
	width: 100%;
	padding: 5px;
	margin: 8px 0px;
	border: 1px solid #ccc;
	border-radius: 4px;
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
					Daily Tour Operation
				</h1>
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
							<input id="column3_search" type="text" name="column3_search">
						</div>
						<div class="col-sm-2 col-md-2 hidden-xs">
							Service Date<br/>
							<input id="date_search" placeholder="DD/MM/YYYY" type="text" name="date_search">
						</div>
					</div>
					
					<div class="jarviswidget jarviswidget-color-darken" id="wid-id-0" data-widget-editbutton="false">
						<div>
							<!-- widget content -->
							<div class="widget-body no-padding">
						        <table id="dt_basic" class="table table-striped table-bordered table-hover" style="margin-top:0px" width="100%">
									<thead>             
										<tr class="header">
											<th data-hide="phone">Service Datetime</th>
											<th>Booking Name</th>
											<th>Product Name</th>
											<th>Pax</th>
											<th>Service by Supplier</th>
											<th>Order from Agent</th>
											<th>Status</th>
											<th class="center"></th>
										</tr>
									</thead>
									<tbody>
										<?PHP
											$sql = "SELECT 	booking.booking_id, booking.booking_name, booking.booking_nat, booking.booking_tel,
															booking.booking_line, booking.booking_remark, booking_detail.booking_detail_date, booking_detail.booking_detail_note, 
															booking_detail.booking_detail_time, booking_detail.booking_detail_status, booking_detail.booking_detail_qty,
															agent.agent_name, booking.booking_status, booking_detail.booking_detail_confirm, 
															product.product_showtime, product.product_showtime, product.product_for, 
															product.product_name, supplier.supplier_name, agent.agent_main_tel,
															agent.agent_main_email, agent.agent_main_line,product.product_desc, product.product_car_type,
															supplier.supplier_reserv_tel, supplier.supplier_reserv_fax, supplier.supplier_reserv_email,
															supplier.supplier_reserv_line, supplier.supplier_type, supplier.supplier_name,
															supplier.supplier_reserv_main

													FROM booking, booking_detail, product, agent, supplier
													WHERE booking.booking_id=booking_detail.booking_id
															and booking_detail.product_id=product.product_id
															and booking_detail.booking_detail_date>=date(now())
															and booking.agent_id=agent.agent_id
															and product.supplier_id=supplier.supplier_id
													ORDER BY booking_detail.booking_detail_date, booking_detail.booking_detail_time";
											$result = mysqli_query($conn ,$sql);
											if(mysqli_num_rows($result) > 0){
												//show data for each row
												while($row = mysqli_fetch_assoc($result)){
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
													if($row['product_for'] == 'A'){
													$product_for = 'Adult';
												}else if($row['product_for'] == 'I'){
													$product_for = 'Chident';
												}else if($row['product_for'] == 'C'){
													$product_for = 'Senier';
												}else{
													$product_for = 'All';
												}
													
												if($row['booking_detail_status'] == 'N'){
													$statusUser = '<font color="green">New</font>';
												}else if($row['booking_detail_status'] == 'R'){
													$statusUser = '<font color="red">Reject</font> <i class="fa fa-info-circle" title="'.$row['booking_detail_reject_reason'].'"></i>';
												}else if($row['booking_detail_status'] == 'C'){
													if ($row['booking_detail_confirm']<>"")	{
														$conf=$row['booking_detail_confirm'];
													}else{
														$conf="-";
													}
													$statusUser = '<font color="blue">Confirm</font><br><b>'.$conf.'</b>';
												}else{
													$statusUser = '';
												}
												
												if ($row['supplier_reserv_main'] == "T")	{
													$MainContract = "Tel. ".$row['supplier_reserv_tel'];
												}else if ($row['supplier_reserv_main'] == "F")	{
													$MainContract = "Fax. ".$row['supplier_reserv_fax'];
												}else if ($row['supplier_reserv_main'] == "E")	{
													$MainContract = "Email. ".$row['supplier_reserv_email'];
												}else if ($row['supplier_reserv_main'] == "L")	{
													$MainContract = "Line or WhatApp. ".$row['supplier_reserv_line'];
												}?>
												<tr>
														<td><?=date("d/m/Y", strtotime($row['booking_detail_date']));?> <?=date("H:i", strtotime($row['booking_detail_time']));?></td>
														<td><i class="fa fa-info-circle" title="<?="Booking No : ".substr("00000000",1,6-strlen($row['booking_id'])).$row['booking_id']."\n Nationality : ".$row['booking_nat']."\n Tel : ".$row['booking_tel']."\n Line or WhatApp : ".$row['booking_line']."\n Remark : ".$row['booking_remark']?>"></i> <?=$row['booking_name']?></td>
														<td><?=$row['product_name']." ".$row['product_showtime']." ".$product_for." <br>(".$row['supplier_name'].")";?>
														<font color="red"><?=$row['booking_detail_note']?></font></td>
														<td><?=number_format($row['booking_detail_qty'],0);?></td>
														<td><i class="fa fa-info-circle" title="<?="Tel. ".$row['supplier_reserv_tel']."\n Fax. ".$row['supplier_reserv_fax']."\n Email. ".$row['supplier_reserv_email']."\n Line or WhatApp. ".$row['supplier_reserv_line']?>"></i> <?="[".$SupplierType."] ".$row['supplier_name']."<br>".$MainContract?></td>
														<td><i class="fa fa-info-circle" title="<?="Tel. ".$row['agent_main_tel']."\n E-mail. ".$row['agent_main_email']."\n Line or WhatApp. ".$row['agent_main_line']?>"></i> <?=$row['agent_name']?></td>
														<td><?=$statusUser?></td>
														<td style="text-align: center;">
														<a class="btn btn-small btn-primary bg-color-green" id="m1s" href="bookingList-info.php?id=<?=$row['booking_id']?>">More</a>
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

		$( "#date_search" ).keyup(function() {
			//alert( "Handler for .keyup() called." );
			table_dtbasic.columns( 0 ).search( this.value ).draw();
		});
		$('#myModal').on('show.bs.modal', function (event) {
			var button = $(event.relatedTarget) // Button that triggered the modal
			var recipient = button.data('whatever') // Extract info from data-* attributes
			var modal = $(this);
			var dataString = 'user_id=' + recipient;
			console.log('dataString :'+dataString);
            $.ajax({
                
                url: "fetchEdit.php",
				type:"POST",
                data: dataString,
				dataType : 'json',
                
                success: function (data) {
					if(data != null){
						console.log('data :'+data);
						console.log('data.username :'+data.username);
						console.log('data.status :'+data.status);
						$('#username').val(data.username);  
						$('#email').val(data.email);  
						$('#password').val(data.password);  
						$('#type').val(data.type);   
						$('#user_id').val(data.userid);
						$('#m_Status' + data.status).prop('checked',true);
						$('#m_type' + data.type).prop('checked',true);
						$('#submitAddUser').val("Update");  
					}else{
						$('#username').val('');  
						$('#email').val('');  
						$('#password').val('');  
						$('#type').val('');    
						$('#user_id').val('');
						$('#m_StatusA').prop('checked',false);
						$('#m_StatusI').prop('checked',false);
						$('#m_StatusC').prop('checked',false);
						$('#m_typeS').prop('checked',false);
						$('#m_typeM').prop('checked',false);
						$('#m_typeA').prop('checked',false);
						$('#submitAddUser').val("Insert");
					}
				},
                error: function(err) {
                    console.log('err : '+err);
					
				}
			});  
		});

		//// Validate
		//// set default 
		$('p[for="username"]').hide();
		$('p[for="password"]').hide();
		$('p[for="status"]').hide();
		$('p[for="type"]').hide();
		$('p[for="email"]').hide();

		$( "#username" ).keyup(function() {
			if($( "#username" ).val().length < 6){
				//console.log('test' + $( "#username" ).val().length);
				$('p[for="username"]').show();
			}else{
				//console.log('test' + $( "#username" ).val().length);
				$('p[for="username"]').hide();
			}
			
			
		});

		$( "#password" ).keyup(function() {
			if($( "#password" ).val().length < 6 ){
				$('p[for="password"]').html("Password must more than 6 character");
				$('p[for="password"]').show();
			}else{
				if($( "#password" ).val().match(/\d/))
				{
					$('p[for="password"]').hide();
				}else{
					$('p[for="password"]').html("Password must more less than 1 number");
					$('p[for="password"]').show();
				}	
			}
		});

		$( "#email" ).keyup(function() {
			if($( "#email" ).val().match(/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/)){
				$('p[for="email"]').hide();
			}else{
				$('p[for="email"]').show();
			}
		});
		

	});

	/* END BASIC */
	function filterCheckbox(){
		
		var types = $('input:checkbox[name="status"]:checked').map(function() {
    		return '^' + this.value + '\$';
		}).get().join('|');
		//filter in column 0, with an regex, no smart filtering, no inputbox,not case sensitive
		console.log(types);
		otable.fnFilter(types, 4, true, false, false, false);
	}
	
</script>

<?php
	//include footer
	include ("inc/google-analytics.php");
?>																														