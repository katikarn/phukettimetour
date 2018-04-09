<?php
	session_start();
	include('inc/auth.php');
	include("inc/connectionToMysql.php");
	include("product-controller.php");
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
		</div>
		<!-- widget grid -->
		<section id="widget-grid" class="">
			<!-- row -->
			<div class="row">
				<!-- NEW WIDGET START -->
				<article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<div class="row header">
						<div class="col-sm-4 col-md-4 col-lg-4">
							Keyword<br/>
							<input id="column3_search" type="text" name="googlesearch">
						</div>
						<div class="col-xs-12 col-sm-10 col-md-8 col-lg-6 status smart-form" style="padding-top: 25px;">
							<div class="checkbox"  style="padding-left: 0px;">
								<div class="col-xs-3 col-md-3">
									<label class="checkbox">
										<input type="checkbox" name="status" id="StatusA" value="Active" onclick="filterCheckbox();" checked ><i></i><span style="background-color: #5dc156;">Active</span>
									</label>
								</div>
								<div class="col-xs-3 col-md-3">
									<label class="checkbox">
										<input type="checkbox" name="status" id="StatusI" value="Inactive" onclick="filterCheckbox();" checked ><i></i><span style="background-color: #6dd0ca;">Inactive</span>
									</label>
								</div>
								<div class="col-xs-3 col-md-3">
									<label class="checkbox">
										<input type="checkbox" name="status" id="StatusC" value="Cancel" onclick="filterCheckbox();" checked ><i></i><span style="background-color: #ffba42;">Cancel</span>
									</label>
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
										</tr>
									</thead>
									<tbody>
										<?PHP
											$sql = "SELECT `product_id`, `product_status`, `product_name`, `product_for`, `supplier_name` 
											FROM `product`,`supplier` 
											where `supplier`.`supplier_id` = `product`.`supplier_id`";
												$result = mysqli_query($conn ,$sql);
												if(mysqli_num_rows($result) > 0){
													//show data for each row
												while($row = mysqli_fetch_assoc($result)){
													if($row['product_status'] == 'A'){
														$statusUser = '<font color="green">Active</font>';
													}else if($row['product_status'] == 'I'){
														$statusUser = 'Inactive';
													}else if($row['product_status'] == 'C'){
														$statusUser = '<font color="red">Cancel</font>';
													}else{
														$statusUser = '';
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
												 ?>
												<tr>
													<td><?=$row['product_id']?></td>
													<td><?=$row['product_name']?></td>
													<td><?=$row['supplier_name']?></td>
													<td><?=$product_for?></td>
													<td><?=$statusUser?></td>
													<td class="center"><a onclick="resetModal();" class="btn btn-small btn-primary"
															data-toggle="modal"
															data-target="#myModal"
															data-whatever="<?=$row['product_id']?>">Edit</a>
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
		  			<fieldset>
		  				<section>
							<div class="row">
								<label class="label col col-3 header">Status</label>
								<div class="col col-9">
									<label class="input status">
										<div class="inline-group">
											<label class="radio">
												<input type="radio" name="chkproduct_status" value="A" id="chkproduct_status_A" checked=true>
												<i></i><span style="background-color: #5dc156;">Active</span></label>
											<label class="radio">
												<input type="radio" name="chkproduct_status" value="I" id="chkproduct_status_I">
												<i></i><span style="background-color: #6dd0ca;">Inactive</span></label>
											<label class="radio">
												<input type="radio" name="chkproduct_status" value="C" id="chkproduct_status_C">
												<i></i><span style="background-color: #ffba42;">Cancel</span></label>
										</div>
									</label>
								</div>
							</div>
							<div class="row">
								<label class="label col col-3 header">Supplier</label>
								<div class="col col-9">
									<label class="input required">
										<select name="lsbsupplier_id" id="lsbsupplier_id">
											<option value="" selected></option>
											<?php
												$sql = "SELECT `supplier_id`, `supplier_name` FROM `supplier`	WHERE `supplier_status` <> 'C' ORDER BY `supplier_name` ";
												$result = mysqli_query($conn ,$sql);
												if(mysqli_num_rows($result) > 0)	{
													//show data for each row
													while($row = mysqli_fetch_assoc($result))	{?>
														<option value="<?=$row['supplier_id']; ?>"><?=$row['supplier_name']; ?></option>
													<?php } 
												}?>
										</select>
									</label>
								</div>
							</div>
							<div class="row">
								<label class="label col col-3 header">Product Name</label>
								<div class="col col-9">
									<label class="input required">
										<input type="text" name="txbproduct_name" id="txbproduct_name" maxlength="50">
									</label>
								</div>
							</div>
							<div class="row">
								<label class="label col col-3 header">Short Description</label>
								<div class="col col-9">
									<label class="input">
										<input type="text" name="txbproduct_desc" id="txbproduct_desc" maxlength="250">
									</label>
								</div>
							</div>
							<div class="row">
								<label class="label col col-3 header">Product Detail</label>
								<div class="col col-9">
									<label class="input">
										<textarea type="text" rows="5" name="txbproduct_detail" id="txbproduct_detail" maxlength="500"></textarea>
									</label>
								</div>
							</div>
							<div class="input input-file">
								<span class="button"><input type="file" id="txbproduct_file1" name="txbproduct_file1" onchange="this.parentNode.nextSibling.value = this.value">Browse</span><input type="text" placeholder="Include contract files" readonly="">
							</div>
							<div class="input input-file">
								<span class="button"><input type="file" id="txbproduct_file2" name="txbproduct_file2" onchange="this.parentNode.nextSibling.value = this.value">Browse</span><input type="text" placeholder="Include contract files" readonly="">
							</div>
							<div class="input input-file">
								<span class="button"><input type="file" id="txbproduct_file3" name="txbproduct_file3" onchange="this.parentNode.nextSibling.value = this.value">Browse</span><input type="text" placeholder="Include contract files" readonly="">
							</div>
						</section>		  				
		  			</fieldset>
		  			<header>
		  				Product Spec
		  			</header>
		  			<fieldset>
		  				<section>
						  	<div class="row">
								<label class="label col col-3 header">Confirm Class</label>
								<div class="col col-9">
									<label class="input">
										<div class="inline-group">
											<label class="radio">
												<input type="radio" name="chkproduct_confirm_class" value="M" id="chkproduct_confirm_class_M" checked>
												<i></i>Manual</label>
											<label class="radio">
												<input type="radio" name="chkproduct_confirm_class" value="A" id="chkproduct_confirm_class_A">
												<i></i>Auto</label>
										</div>
									</label>
								</div>
							</div>
							<div class="row">
								<label class="label col col-3 header">Seat Type</label>
								<div class="col col-9">
									<label class="input">
										<div class="inline-group">
											<label class="radio">
												<input type="radio" name="chkproduct_seat" value="N" id="chkproduct_seat_N" checked>
												<i></i>No Seat</label>
											<label class="radio">
												<input type="radio" name="chkproduct_seat" value="Y" id="chkproduct_seat_Y">
												<i></i>Fixed Seat</label>
										</div>
									</label>
								</div>
							</div>
							<div class="row">
								<label class="label col col-3 header">Use for</label>
								<div class="col col-9">
									<label class="input">
										<div class="inline-group">
											<label class="radio">
												<input type="radio" name="chkproduct_for" value="Z" id="chkproduct_for_Z" checked>
												<i></i>All</label>
											<label class="radio">
												<input type="radio" name="chkproduct_for" value="A" id="chkproduct_for_A">
												<i></i>Adult</label>
											<label class="radio">
												<input type="radio" name="chkproduct_for" value="C" id="chkproduct_for_C">
												<i></i>Chident</label>
											<label class="radio">
												<input type="radio" name="chkproduct_for" value="S" id="chkproduct_for_S">
												<i></i>Senier</label>
										</div>
									</label>
								</div>
							</div>
							<div class="row">
								<label class="label col col-3 header">Show Time</label>
								<div class="col col-9">
									<label class="input">
										<input type="Time" name="txbproduct_showtime" id="txbproduct_showtime">
									</label>
								</div>
							</div>
							<div class="row">
								<label class="label col col-3 header">Duration</label>
								<div class="col col-9">
									<label class="input">
										<input type="text" name="txbproduct_duration" id="txbproduct_duration" mamaxlength="20"x>
									</label>
								</div>
							</div>
							<div class="row">
								<label class="label col col-3 header">Car Type</label>
								<div class="col col-9">
									<label class="input">
										<select name="lsbproduct_car_type" id="lsbproduct_car_type">
											<option value="" selected></option>
											<option value="T">Car (Max passenger 4)</option>
											<option value="F">Van (Max passenger 10)</option>
											<option value="E">Bus (Max passenger 35)</option>
									  	</select>
									</label>
								</div>
							</div>
							<div class="row">
								<label class="label col col-3 header">Meal Type</label>
								<div class="col col-9">
									<label class="input">
										<select name="lsbproduct_meal_type" id="lsbproduct_meal_type">
											<option value="" selected></option>
											<option value="1">Buffet</option>
											<option value="2">VET</option>
											<option value="3">--</option>
									  	</select>
									</label>
								</div>
							</div>
						</section>
		  			</fieldset>
		  			<header>
		  				Price
		  			</header>
		  			<fieldset>
		  				<section>
							<div class="row">
								<label class="label col col-3 header">Cost Price</label>
								<div class="col col-9">
									<label class="input required">
										<input type="number" step=".01" name="txbproduct_cost_price" id="txbproduct_cost_price">
									</label>
								</div>
							</div>
							<div class="row">
								<label class="label col col-3 header">Price-Normal</label>
								<div class="col col-9">
									<label class="input required">
										<input type="number" step=".01" name="txbproduct_normal_price" id="txbproduct_normal_price">
									</label>
								</div>
							</div>
							<div class="row">
								<label class="label col col-3 header">Price-Oversea</label>
								<div class="col col-9">
									<label class="input required">
										<input type="number" step=".01" name="txbproduct_oversea_price" id="txbproduct_oversea_price">
									</label>
								</div>
							</div>
							<div class="row">
								<label class="label col col-3 header">Price-Level 1</label>
								<div class="col col-9">
									<label class="input required">
										<input type="number" step=".01" name="txbproduct_price_l1" id="txbproduct_price_l1">
									</label>
								</div>
							</div>
							<div class="row">
								<label class="label col col-3 header">Price-Level 2</label>
								<div class="col col-9">
									<label class="input required">
										<input type="number" step=".01" name="txbproduct_price_l2" id="txbproduct_price_l2">
									</label>
								</div>
							</div>					
							<div class="row">
								<label class="label col col-3 header">Remark</label>
								<div class="col col-9">
									<label class="input">
										<textarea type="text" rows="5" name="txbproduct_remark" id="txbproduct_remark"></textarea>
									</label>
								</div>
							</div>
						</section>
		  			</fieldset>
		  			<footer class="center">
						<input type="hidden" name="product_id" id="product_id" />
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
			var dataString = 'product_id=' + recipient;
			console.log('dataString :'+dataString);
			$.ajax({
				
				url: "fetchEdit.php",
				type:"POST",
				data: dataString,
				dataType : 'json',
					
				success: function (data) {
					if(data != null){
						console.log(data);
						//console.log('data.product.product_id :'+data.product_id);
						//console.log('data.status :'+data.product_status);
						$('#chkproduct_status_' + data.product_status).prop('checked',true);
						$('#lsbsupplier_id').val(data.supplier_id);
						$('#txbproduct_name').val(data.product_name);
						$('#txbproduct_desc').val(data.product_desc);
						$('#txbproduct_detail').val(data.product_detail);
						$('#txbproduct_file1').val(data.product_file1);
						$('#txbproduct_file2').val(data.product_file2);
						$('#txbproduct_file3').val(data.product_file3);
						$('#chkproduct_confirm_class_' + data.product_confirm_class).prop('checked',true);
						$('#chkproduct_seat_' + data.product_seat).prop('checked',true);
						$('#chkproduct_for_' + data.product_for).prop('checked',true);
						$('#txbproduct_showtime').val(data.product_showtime);
						$('#txbproduct_duration').val(data.product_duration);
						$('#lsbproduct_car_type').val(data.product_car_type);
						$('#lsbproduct_meal_type').val(data.product_meal_type);
						$('#txbproduct_cost_price').val(data.product_cost_price);
						$('#txbproduct_normal_price').val(data.product_normal_price);
						$('#txbproduct_oversea_price').val(data.product_oversea_price);
						$('#txbproduct_price_l1').val(data.product_price_l1);
						$('#txbproduct_price_l2').val(data.product_price_l2);
						$('#txbproduct_remark').val(data.product_remark);
						$('#product_id').val(data.product_id);
						$('#submitAddProduct').val("Update");
					}else{
						$('#chkproduct_status_A').prop('checked',true);
						//$('#chkproduct_status_I').prop('checked',true);
						//$('#chkproduct_status_C').prop('checked',true);							
						$('#lsbsupplier_id').val('');
						$('#txbproduct_name').val('');
						$('#txbproduct_desc').val('');
						$('#txbproduct_detail').val('');
						$('#txbproduct_file1').val('');
						$('#txbproduct_file2').val('');
						$('#txbproduct_file3').val('');
						$('#chkproduct_confirm_class_M').prop('checked',true);
						//$('#chkproduct_confirm_class_A').prop('checked',true);
						$('#chkproduct_seat_N').prop('checked',true);
						//$('#chkproduct_seat_Y').prop('checked',true);
						$('#chkproduct_for_Z').prop('checked',true);
						//$('#chkproduct_for_A' + data.chkproduct_for).prop('checked',true);
						//$('#chkproduct_for_C' + data.chkproduct_for).prop('checked',true);
						//$('#chkproduct_for_S' + data.chkproduct_for).prop('checked',true);
						$('#txbproduct_showtime').val('');
						$('#txbproduct_duration').val('');
						$('#lsbproduct_car_type').val('');
						$('#lsbproduct_meal_type').val('');
						$('#txbproduct_cost_price').val('');
						$('#txbproduct_normal_price').val('');
						$('#txbproduct_oversea_price').val('');
						$('#txbproduct_price_l1').val('');
						$('#txbproduct_price_l2').val('');
						$('#txbproduct_remark').val('');
						$('#product_id').val('');
						$('#submitAddProduct').val("Insert");
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
					lsbsupplier_id : {
						required : true
					},
					txbproduct_name : {
						required : true
					},
					txbproduct_cost_price	: {
						required : true
					},	
					txbproduct_normal_price	: {
						required : true
					},
					txbproduct_oversea_price : {
						required : true
					},
					txbproduct_price_l1 : {
						required : true
					},
					txbproduct_price_l2 : {
						required : true
					}		
				},

				// Messages for form validation
				messages : {
					lsbsupplier_id : {
						required : 'Please select Supplier'
					},
					txbproduct_name : {
						required : 'Please fill Product Name'
					},
					txbproduct_cost_price	: {
						required : 'Please fill cost price'
					},	
					txbproduct_normal_price	: {
						required : 'Please fill normal price'
					},
					txbproduct_oversea_price : {
						required : 'Please fill oversea price'
					},
					txbproduct_price_l1 : {
						required : 'Please fill price level 1'
					},
					txbproduct_price_l2 : {
						required : 'Please fill price level 2'
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