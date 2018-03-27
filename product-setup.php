<?php 
	session_start();
	include('inc/auth.php');
	include("inc/connectionToMysql.php");
	include("registerProductController.php");
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
		font-weight:bold !important;
	}
	
	.row{
		margin-bottom:10px;
	}
	
	#dt_basic{
		margin-top: 0px !important;
	}
	
	.status span{
		color:#fff;
		border-radius: 4px;
		border: 1px solid #ccc;
		padding: 2px;
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
		border-radius: 0px !important;
	}

	.error{
		color: red;
		font-weight: bold;
	}

	.required{
		border-left: 7px solid #FF3333;
	}
	
	@media only screen and (max-width: 320px) {
	    label.radio {
	        margin-right: 15px !important;
	    }
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
						<div class="col-sm-4 col-md-4 col-lg-4">
							Keywoard<br/>
							<input id="column3_search" type="text" name="googlesearch">
						</div>
						<div class="hidden-md col-lg-2">
							<!-- Date<br/>
							<input id="date_search" placeholder="DD/MM/YYYY" type="text" name="date_search"> -->
						</div>
						<div class="col-xs-12 col-sm-10 col-md-8 col-lg-6 status smart-form" style="padding-top: 25px;">
							<div class="checkbox"  style="padding-left: 0px;">
								<div class="col-xs-3 col-md-3">
									<label class="checkbox">
										<input type="checkbox" name="status" id="StatusA" value="Active" onclick="filterCheckbox();" checked ><i></i><span style="background-color: #5dc156;">Active</span></label>
								</div>
								<div class="col-xs-3 col-md-3">
									<label class="checkbox">
										<input type="checkbox" name="status" id="StatusI" value="Inactive" onclick="filterCheckbox();" checked ><i></i><span style="background-color: #6dd0ca;">Inactive</span></label>
								</div>
								<div class="col-xs-3 col-md-3">
									<label class="checkbox">
										<input type="checkbox" name="status" id="StatusC" value="Cancel" onclick="filterCheckbox();" checked ><i></i><span style="background-color: #ffba42;">Cancel</span></label>
								</div>
								<div class="col-xs-3 col-sm-4 col-md-3">
									<button style="padding: 6px 12px;" class="btn btn-primary" id="m1s" data-whatever="" data-toggle="modal" data-target="#myModal" onclick="resetModal()">Add new</button>
								</div>
							</div>
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
											<th></th>
											<!-- <th data-hide="phone,tablet"><i class="fa fa-fw fa-map-marker txt-color-blue hidden-md hidden-sm hidden-xs"></i> Zip</th> -->
											<!-- <th data-hide="phone,tablet">City</th> -->
											<!-- <th data-hide="phone,tablet"><i class="fa fa-fw fa-calendar txt-color-blue hidden-md hidden-sm hidden-xs"></i> Date</th> -->
										</tr>
									</thead>
									<tbody>
										<?PHP
											$sql = "SELECT `product`.`productid` AS `productid`,`product`.`name` AS `pName`,
											`supplier`.`name` AS `sName`, `product`.`product_type` AS `pType`, `product`.`status`  AS `pStatus` 
											FROM `product`,`supplier` 
											where `supplier`.`supplierid` = `product`.`supplierid`";
												$result = mysqli_query($conn ,$sql);
												if(mysqli_num_rows($result) > 0){
													//show data for each row
												while($row = mysqli_fetch_assoc($result)){
													if($row['pStatus'] == 'A'){
														$statusUser = '<font color="green">Active</font>';
													}else if($row['pStatus'] == 'I'){
														$statusUser = 'Inactive';
													}else if($row['pStatus'] == 'C'){
														$statusUser = '<font color="red">Cancel</font>';
													}
													if($row['pType'] == 'T'){
														$typeUser = 'Ticket';
														}else if($row['pType'] == 'D'){
														$typeUser = 'Day Trip';
														}else if($row['pType'] == 'A'){
														$typeUser = 'Admin';
													}
												 ?>
												<tr>
													<td><?=$row['productid']?></td>
													<td><?=$row['pName']?></td>
													<td><?=$row['sName']?></td>
													<td><?=$typeUser?></td>
													<td><?=$statusUser?></td>
													<td class="center"><a onclick="resetModal();" class="btn btn-small btn-primary"
															data-toggle="modal"
															data-target="#myModal"
															data-whatever="<?=$row['productid']?>" >Edit</a>
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
  <div class="modal fade" id="myModal" role="dialog" data-backdrop="static">
    <div class="modal-dialog modal-Adduser">
    
      <!-- Modal content-->
	  
      	<div class="modal-content">
	        <div class="modal-header">
	          	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
					<i class="icon-append fa fa-times"></i>
				</button>
	          	<h4 class="header">Product</h4>
	        </div>
	        <div class="modal-body no-padding">
		  		<form action="product-setup.php" method='post' id="product-form" class="smart-form">
		  			<header>
		  				General Info
		  			</header>
		  			<fieldset>
		  				<section>
							<div class="row">
								<label class="label col col-3 header">Status</label>
								<div class="col col-9">
									<label class="input status">
										<div class="inline-group">
											<label class="radio">
												<input type="radio" name="status" value="A" id="m_StatusA" checked=true>
												<i></i><span style="background-color: #5dc156;">Active</span></label>
											<label class="radio">
												<input type="radio" name="status" value="I" id="m_StatusI">
												<i></i><span style="background-color: #6dd0ca;">Inactive</span></label>
											<label class="radio">
												<input type="radio" name="status" value="C" id="m_StatusC">
												<i></i><span style="background-color: #ffba42;">Cancel</span></label>
										</div>
									</label>
								</div>
							</div>
						</section>
						<section>
							<div class="row">
								<label class="label col col-3 header">Name</label>
								<div class="col col-9">
									<label class="input required">
										<input type="text" name="productName" id="productName">
									</label>
								</div>
							</div>
						</section>
						<section>
							<div class="row">
								<label class="label col col-3 header">Supplier</label>
								<div class="col col-9">
									<label class="input required">
										<input type="text" name="productSupplier" id="productSupplier">
									</label>
								</div>
							</div>
						</section>
						<section>
							<div class="row">
								<label class="label col col-3 header">Type</label>
								<div class="col col-9">
									<label class="input">
										<div class="inline-group">
											<label class="radio">
												<input type="radio" name="Type" value="T" id="p_TypeT" checked>
												<i></i>Ticket</label>
											<label class="radio">
												<input type="radio" name="Type" value="D" id="p_TypeD">
												<i></i>Day Trip</label>
											<label class="radio">
												<input type="radio" name="Type" value="C" id="p_TypeC">
												<i></i>Car</label>
										</div>
									</label>
								</div>
							</div>
						</section>
						<section>
							<div class="row">
								<label class="label col col-3 header">Detail</label>
								<div class="col col-9">
									<label class="input">
										<textarea type="text" rows="5" name="Detail" id="Detail"></textarea>
									</label>
								</div>
							</div>
						</section>
						<section>
							<div class="row">
								<label class="label col col-3 header">Confirm Class</label>
								<div class="col col-9">
									<label class="input">
										<div class="inline-group">
											<label class="radio">
												<input type="radio" name="ConfirmClass" value="M" id="c_TypeM" checked>
												<i></i>Manual</label>
											<label class="radio">
												<input type="radio" name="ConfirmClass" value="A" id="c_TypeA">
												<i></i>Auto</label>
										</div>
									</label>
								</div>
							</div>
						</section>
		  				
		  			</fieldset>
		  			<header>
		  				Finance
		  			</header>
		  			<fieldset>
		  				<section>
							<div class="row">
								<label class="label col col-3 header">Cost Price</label>
								<div class="col col-9">
									<label class="input required">
										<input type="number" step=".01" name="CostPrice" id="CostPrice">
									</label>
								</div>
							</div>
						</section>
						<section>
							<div class="row">
								<label class="label col col-3 header">Normal Price</label>
								<div class="col col-9">
									<label class="input required">
										<input type="number" step=".01" name="NormalPrice" id="NormalPrice">
									</label>
								</div>
							</div>
						</section>
						<section>
							<div class="row">
								<label class="label col col-3 header">Sales Price1</label>
								<div class="col col-9">
									<label class="input required">
										<input type="number" step=".01" name="SalesPrice1" id="SalesPrice1">
									</label>
								</div>
							</div>
						</section>
						<section>
							<div class="row">
								<label class="label col col-3 header">Sales Price2</label>
								<div class="col col-9">
									<label class="input required">
										<input type="number" step=".01" name="SalesPrice2" id="SalesPrice2">
									</label>
								</div>
							</div>
						</section>
		  				
		  			</fieldset>
		  			<header>
		  				Tricket Info
		  			</header>
		  			<fieldset>
		  				<section>
							<div class="row">
								<label class="label col col-3 header">Seat Type</label>
								<div class="col col-9">
									<label class="input">
										<div class="inline-group">
											<label class="radio">
												<input type="radio" name="SeatType" value="O" id="s_TypeO" checked>
												<i></i>Open</label>
											<label class="radio">
												<input type="radio" name="SeatType" value="F" id="s_TypeF">
												<i></i>Fixed Seat</label>
										</div>
									</label>
								</div>
							</div>
						</section>
						<section>
							<div class="row">
								<label class="label col col-3 header">Ticket Type</label>
								<div class="col col-9">
									<label class="input">
										<div class="inline-group">
											<label class="radio">
												<input type="radio" name="TicketType" value="Z" id="t_TypeZ" checked>
												<i></i>Same Price</label>
											<label class="radio">
												<input type="radio" name="TicketType" value="A" id="t_TypeA">
												<i></i>Adult</label>
											<label class="radio">
												<input type="radio" name="TicketType" value="C" id="t_TypeC">
												<i></i>Chident</label>
											<label class="radio">
												<input type="radio" name="TicketType" value="S" id="t_TypeS">
												<i></i>Senier</label>
										</div>
									</label>
								</div>
							</div>
						</section>
						<section>
							<div class="row">
								<label class="label col col-3 header">Show Time</label>
								<div class="col col-9">
									<label class="input required">
										<input type="Time" name="ShowTime" id="ShowTime">
									</label>
								</div>
							</div>
						</section>
		  				
		  			</fieldset>
		  			<header>
		  				Day Trip Info
		  			</header>
		  			<fieldset>
		  				<section>
							<div class="row">
								<label class="label col col-3 header">Free pickup</label>
								<div class="col col-9">
									<label class="input">
										<div class="inline-group">
											<label class="radio">
												<input type="radio" name="Freepickup" value="Y" id="f_TypeY" checked>
												<i></i>Yes</label>
											<label class="radio">
												<input type="radio" name="Freepickup" value="N" id="f_TypeN">
												<i></i>No</label>
										</div>
									</label>
								</div>
							</div>
						</section>
						<section>
							<div class="row">
								<label class="label col col-3 header">Min</label>
								<div class="col col-9">
									<label class="input required">
										<input type="text" name="Min" id="Min" onkeypress="return event.charCode >= 48 && event.charCode <= 57">
									</label>
								</div>
							</div>
						</section>
						<section>
							<div class="row">
								<label class="label col col-3 header">Max</label>
								<div class="col col-9">
									<label class="input required">
										<input type="text" name="Max" id="Max" onkeypress="return event.charCode >= 48 && event.charCode <= 57">
									</label>
								</div>
							</div>
						</section>
						<section>
							<div class="row">
								<label class="label col col-3 header">Day Trip Info</label>
								<div class="col col-9">
									<label class="input required">
										<textarea type="text" rows="5" name="d_detail" id="d_detail"></textarea>
									</label>
								</div>
							</div>
						</section>
		  				
		  			</fieldset>
		  			<header>
		  				Car Info
		  			</header>
		  			<fieldset>
		  				<section>
							<div class="row">
								<label class="label col col-3 header">Car Type</label>
								<div class="col col-9">
									<label class="input required">
										<input type="text" name="CarTypeText" id="CarTypeText">
									</label>
								</div>
							</div>
						</section>
						<section>
							<div class="row">
								<label class="label col col-3 header">Max Seat</label>
								<div class="col col-9">
									<label class="input required">
										<input type="text" name="MaxSeat" id="MaxSeat" onkeypress="return event.charCode >= 48 && event.charCode <= 57">
									</label>
								</div>
							</div>
						</section>
		  				
		  			</fieldset>
		  			<footer class="center">
						<input type="hidden" name="productid" id="productid" />
						<button type="submit" name="submitAddProduct" id="submitAddProduct" class="btn btn-primary" style="float: unset;font-weight: 400;">
							Save</button>
						<button type="button" class="btn btn-default" data-dismiss="modal" style="float: unset;font-weight: 400;">
							Cancel</button>
					</footer>
			</form>
        </div>
	  
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
			var dataString = 'productid=' + recipient;
			console.log('dataString :'+dataString);
            $.ajax({
                
                url: "fetchEdit.php",
				type:"POST",
                data: dataString,
				dataType : 'json',
                
                success: function (data) {
					if(data != null){
						console.log(data);
						console.log('data.product.productid :'+data.pId);
						//console.log('data.status :'+data.product.status);
						$('#productid').val(data.pId);
						$('#m_Status' + data.pStatus).prop('checked',true);
						$('#productName').val(data.pName);  
						$('#productSupplier').val(data.sName); 
						$('#p_Type' + data.pProduct_type).prop('checked',true); 
						$('#Detail').val(data.pDetail);   
						$('#c_Type' + data.pConfirm_class).prop('checked',true);
						$('#CostPrice').val(data.pCostprice); 
						$('#NormalPrice').val(data.pNormalPrice); 
						$('#SalesPrice1').val(data.pSalesPrice1); 
						$('#SalesPrice2').val(data.pSalesPrice2); 
						$('#s_Type' + data.pT_seattype).prop('checked',true);
						$('#t_Type' + data.pT_tickettype).prop('checked',true);
						$('#ShowTime').val(data.pT_showtime); 
						$('#f_Type' + data.pD_freepickup).prop('checked',true);
						$('#Min').val(data.pD_min); 
						$('#Max').val(data.pD_max); 
						$('#d_detail').val(data.pD_detail); 
						$('#CarTypeText').val(data.pC_cartype); 
						$('#MaxSeat').val(data.pC_maximumseat); 
						/*$('#' + data.status).prop('checked',true);
						$('#' + data.type).prop('checked',true);*/
						$('#submitAddProduct').val("Update");  
					 }else{
						$('#productid').val('');
						$('#m_StatusA').prop('checked',true);
						// $('#m_StatusI').prop('checked',false);
						// $('#m_StatusC').prop('checked',false);
						$('#productName').val('');  
						$('#productSupplier').val(''); 
						$('#p_TypeT').prop('checked',true);
						// $('#p_TypeD').prop('checked',false);
						// $('#p_TypeC').prop('checked',false);
						$('#Detail').val('');   
						$('#c_TypeM').prop('checked',true);
						// $('#c_TypeA').prop('checked',false);
						$('#CostPrice').val(''); 
						$('#NormalPrice').val(''); 
						$('#SalesPrice1').val(''); 
						$('#SalesPrice2').val(''); 
						$('#s_TypeO').prop('checked',true);
						// $('#s_TypeF').prop('checked',false);
						$('#t_TypeZ').prop('checked',true);
						// $('#t_TypeA').prop('checked',false);
						// $('#t_TypeC').prop('checked',false);
						// $('#t_TypeS').prop('checked',false);
						$('#ShowTime').val(''); 
						$('#f_TypeN').prop('checked',true);
						// $('#f_TypeY').prop('checked',false);
						$('#Min').val(''); 
						$('#Max').val(''); 
						$('#d_detail').val(''); 
						$('#CarTypeText').val(''); 
						$('#MaxSeat').val('');
						$('#submitAddProduct').val("Insert");
						console.log($('#submitAddProduct').val("Insert"));
					}
				},
                error: function(err) {
                    console.log('err : '+err);
					
				}
			});  
		});
		//// --------------------------- Validate------------------------------
		var errorClass = 'invalid';
		var errorElement = 'em';

		var $contactForm = $("#product-form").validate({
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
				productName : {
					required : true
				},
				productSupplier : {
					required : true
				},
				CostPrice : {
					required : true
				},
				NormalPrice	: {
					required : true
				},	
				SalesPrice1	: {
					required : true
				},
				SalesPrice2 : {
					required : true
				},
				ShowTime : {
					required : true
				},
				Min : {
					required : true
				},
				Max : {
					required : true
				},
				d_detail : {
					required : true
				},	
				CarTypeText : {
					required : true
				},	
				MaxSeat : {
					required : true
				}			
			},

			// Messages for form validation
			messages : {
				productName : {
					required : 'Please enter your Product Name'
				},
				productSupplier : {
					required : 'Please enter your Supplier Name'
				},
				CostPrice : {
					required : 'Please enter your Cost Price'
				},
				NormalPrice	: {
					required : 'Please enter your Normal Price'
				},	
				SalesPrice1	: {
					required : 'Please enter your Sales Price1'
				},
				SalesPrice2 : {
					required : 'Please enter your Sales Price2'
				},
				ShowTime : {
					required : 'Please enter your ShowTime'
				},
				Min : {
					required : 'Please enter your Min'
				},
				Max : {
					required : 'Please enter your Max'
				},
				d_detail : {
					required : 'Please enter your Detail'
				},
				CarTypeText : {
					required : 'Please enter your Car Type'
				},
				MaxSeat : {
					required : 'Please enter your Max Seat'
				}


			},

			// Do not change code below
			errorPlacement : function(error, element) {
				error.insertAfter(element.parent());
			}
		});
	});

	/* END BASIC */
	function filterCheckbox(){

		var types = $('input:checkbox[name="status"]:checked').map(function() {
    		return '^' + this.value + '\$';
 		 }).get().join('|');
		  //filter in column 0, with an regex, no smart filtering, no inputbox,not case sensitive
		  //console.log(types);
		  otable.fnFilter(types, 4, true, false, false, false);
	}

	function resetModal(){
		$( "#product-form" ).find( ".state-error" ).removeClass( "state-error" );
		$( "#product-form" ).find( ".state-success" ).removeClass( "state-success" );
		$( "#product-form" ).find( ".required" ).css("border-left", "7px solid #FF3333");
		$( "em" ).remove();
	}

</script>																													