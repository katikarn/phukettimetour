<?php 
	session_start();
	include('inc/auth.php');
	include("inc/connectionToMysql.php");
	include("bookingList-info-controller.php");
	/////////////////////////////////////////////////////////
	//initilize the page
	require_once ("inc/init.php");
	
	//require UI configuration (nav, ribbon, etc.)
	require_once ("inc/config.ui.php");
	
	/*---------------- PHP Custom Scripts ---------
		
		YOU CAN SET CONFIGURATION VARIABLES HERE BEFORE IT GOES TO NAV, RIBBON, ETC.
	E.G. $page_title = "Custom Title" */
	
	$page_title = "Booking Information";
	
	/* ---------------- END PHP Custom Scripts ------------- */
	
	//include header
	//you can add your custom css in $page_css array.
	//Note: all css files are inside css/ folder
	$page_css[] = "your_style.css";
	include ("inc/header.php");
	
	//include left panel (navigation)
	//follow the tree in inc/config.ui.php
	$page_nav["Booking"]["sub"]["Booking List"]["active"] = true;
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

	.required{
		border-left: 7px solid #FF3333;
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
					Booking Information
				</h1>
			</div>
			<div class="col-xs-12 col-sm-5 col-md-5 col-lg-8" style="text-align: right;">
				<a href="bookingList.php" class="btn btn-default" style="margin-right: 10px;"> 
					<i style="margin-right: 5px;" class="icon-append fa fa-send"></i>Send Mail</a>
				<a class="btn btn-default" style="margin-right: 10px;">
					<i style="margin-right: 5px;" class="icon-append fa fa-car"></i>Pickup Card</a>
				<a class="btn btn-default" style="margin-right: 10px;">
					<i style="margin-right: 5px;" class="icon-append fa fa-file-o"></i>Itinerary</a>
			</div>
		</div>
		<!-- widget grid -->
		<section id="widget-grid" class="">
			<!-- START ROW -->
			<div class="row">
				<!-- NEW COL START -->
				<article class="col-sm-12 col-md-12 col-lg-12">
					<!-- Widget ID (each widget will need unique ID)-->
					<div class="jarviswidget" id="wid-id-0" data-widget-editbutton="false" data-widget-custombutton="false">
						<header>
							<span class="widget-icon"> <i class="fa fa-edit"></i> </span>
							<h2>Booking No : <b>999999</b></h2>
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
								<form action="demo-contacts.php" method="post" id="contact-form" class="smart-form">
									<!-- <header>Contacts form</header> -->
									<fieldset>
										<section>
											<label class="label">Agent</label>
											<label class="input required">
												<select name="lsbagent_id" id="lsbagent_id">
													<option value="" selected></option>
													<?php
													$sql = "SELECT `agent_id`, `agent_name` FROM `agent` ORDER BY `agent_name` ";
													$result = mysqli_query($conn ,$sql);
													if(mysqli_num_rows($result) > 0)	{
														//show data for each row
														while($row = mysqli_fetch_assoc($result))	{?>
															<option value="<?=$row['agent_id']; ?>"><?=$row['agent_name']; ?></option>
														<?php } 
													}?>
												</select>
											</label>
										</section>
										<div class="row">
											<section class="col col-8">
												<label class="label">Tour Leader Name</label>
												<label class="input required">
													<i class="icon-append fa fa-user"></i>
													<input type="text" name="txbbooking_name" id="txbbooking_name" maxlength="100">
												</label>
											</section>										
											<section class="col col-4">
												<label class="label">Pax</label>
												<label class="input required">
													<i class="icon-append fa  fa-group"></i>
													<input type="number" step="1" name="txbbooking_pax" id="txbbooking_pax">
												</label>
											</section>
										</div>
										<div class="row">
										<section class="col col-4">
											<label class="label">Nationality</label>
											<label class="input">
												<i class="icon-append fa fa-flag-checkered"></i>
												<input type="text" name="txbbooking_nat" id="txbbooking_nat" maxlength="50">
											</label>
										</section>
										<section class="col col-4">
											<label class="label">Tel</label>
											<label class="input">
												<i class="icon-append fa fa-phone"></i>
												<input type="email" name="txbbooking_tel" id="txbbooking_tel" maxlength="50">
											</label>
										</section>
										<section class="col col-4">
											<label class="label">Whatapp or Line</label>
											<label class="input">
												<i class="icon-append fa fa-wechat"></i>
												<input type="email" name="txbbooking_line" id="txbbooking_line" maxlength="50">
											</label>
											</section>
										</div>
										<section>
											<label class="label">Note (Other Request)</label>
											<label class="textarea">
												<i class="icon-append fa fa-comment"></i>
												<textarea rows="4" name="txbbooking_remark" id="txbbooking_remark" maxlength="500"></textarea>
											</label>
										</section>
									</fieldset>
									<footer>
									<section class="col col-6">
										<label>Status</label>
										<div class="inline-group">
											<label class="radio">
												<input type="radio" name="chkbooking_status" id="chkbooking_status_N" checked="">
												<i></i>New</label>
											<label class="radio">
												<input type="radio" name="chkbooking_status" id="chkbooking_status_F">
												<i></i>Confrim</label>
											<label class="radio">
												<input type="radio" name="chkbooking_status" id="chkbooking_status_C">
												<i></i>Cancel</label>
										</div>
									</section>
									<section class="col col-6">
										<button type="submit" class="btn btn-primary">Save</button>
									</section>
									</footer>
								</form>
							</div>
							<!-- end widget content -->
						</div>
						<!-- end widget div -->
					</div>
					<!-- end widget -->								
				</article>
				<!-- END COL -->		
			</div>
			<!-- END ROW -->
		</section>
		<!-- end widget grid -->

		<!-- widget grid -->
		<section id="widget-grid" class="">
			<!-- START ROW -->
			<div class="row">
				<!-- NEW COL START -->
				<article class="col-sm-12 col-md-12 col-lg-12">
					<!-- Widget ID (each widget will need unique ID)-->
					<div class="jarviswidget" id="wid-id-0" data-widget-editbutton="false" data-widget-custombutton="false">
						<header>
							<span class="widget-icon"> <i class="fa fa-edit"></i> </span>
							<h2>Booking Detail</h2>
						</header>
						<!-- widget div-->
						<div>
							
						<div class="jarviswidget jarviswidget-color-darken" id="wid-id-0" data-widget-editbutton="false">
						<div>
							<!-- widget content -->
							<div class="widget-body no-padding">
						        <table id="dt_basic" class="table table-striped table-bordered table-hover" style="margin-top:0px" width="100%">
									<thead>			                
										<tr class="header">
											<th data-hide="phone">Service Date</th>
											<th data-hide="phone">Product Name</th>
											<th>Price x Pax</th>
											<th>Amount</th>											
											<th>Status</th>
											<th>
												<div style="text-align: right">
													<button class="btn btn-primary bg-color-green"  data-whatever="" data-toggle="modal" data-target="#myModal" >
													<i style="margin-right: 10px;" class="icon-append fa fa-plus"></i>Add</button>
												</div>
											</th>
										</tr>
									</thead>
									<tbody>
										<?PHP
											$sql = "SELECT 	`booking_detail_id`, `booking_detail_status`, `booking_detail_date`, 
											`booking_detail_time`, `booking_detail_net_price`, `booking_detail_qty`, `booking_detail_total_amount`,
											`product_name`, `product_desc`, `product_seat`,	`product_for`, `product_showtime`, `product_duration`, 
											`product_car_type`, `product_meal_type`, `supplier_name`
											FROM `booking_detail` WHERE 1
											ORDER BY `booking_detail_date`, `booking_detail_time`";
											$result = mysqli_query($conn ,$sql);
											
											if(mysqli_num_rows($result) > 0){
											//show data for each row
												while($row = mysqli_fetch_assoc($result)){
													if($row['product_for'] == 'A'){
														$product_for = 'Adult';
													}else if($row['product_for'] == 'I'){
														$product_for = 'Chident';
													}else if($row['product_for'] == 'C'){
														$product_for = 'Senier';
													}else{
														$product_for = 'All';
													}

													$product_sum = $row['product_name']." ".$row['product_showtime']." ".$product_for." <br>(".$row['supplier_name'].")";
													$pricepax = $row['booking_detail_net_price']." x ".$row['booking_detail_qty'];
													$booking_detail_total_amount = $row['booking_detail_total_amount'];

													if($row['booking_detail_status'] == 'N'){
														$statusUser = '<font color="green">New</font>';
													}else if($row['booking_detail_status'] == 'W'){
														$statusUser = 'Waiting';
													}else if($row['booking_detail_status'] == 'F'){
														$statusUser = 'Confirm';
													}else if($row['booking_detail_status'] == 'C'){
														$statusUser = '<font color="red">Cancel</font>';
													}else{
														$statusUser = '';
													}
												 ?>
												<tr>
													<td><?=$row['booking_detail_date']." ".$row['booking_detail_time']?></td>
													<td><?=$product_sum?></td>
													<td><?=$pricepax?></td>
													<td><?=$booking_detail_total_amount?></td>
													<td><?=$statusUser?></td>
													<td class="center"><a onclick="resetModal();" class="btn btn-small btn-primary bg-color-green"
															data-toggle="modal"
															data-target="#myModal"
															data-whatever="<?=$row['booking_detail_id']?>">Edit</a>
															<a onclick="resetModal();" class="btn btn-small bg-color-orange txt-color-white"
															data-toggle="modal"
															data-target="#myModal"
															data-whatever="<?=$row['booking_detail_id']?>">Del</a>
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
							<!-- end widget content -->
						</div>						
					</div>
					<!-- end widget -->								


				</article>
				<!-- END COL -->		

			</div>

			<!-- END ROW -->

		</section>
		<!-- end widget grid -->

		<!-- Modal -->
		<div class="modal fade" id="myModal" tabindex="-1" role="dialog">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
							<i class="icon-append fa fa-times"></i>
						</button>
						<h4 class="header">
							Product Detail
							<!-- <img src="<?php echo ASSETS_URL; ?>/img/logo.png" width="150" alt="SmartAdmin"> -->
						</h4>
					</div>
					<div class="modal-body no-padding">
						<form id="login-form" class="smart-form">
									<fieldset>
										<section>
											<div class="row">
												<label class="label col col-2">Supplier</label>
												<div class="col col-10">
													<label class="input required">
														<input type="supplier" name="supplier">
													</label>
												</div>
											</div>
										</section>

										<section>
											<div class="row">
												<label class="label col col-2">Product</label>
												<div class="col col-10">
													<label class="input required">
														<input type="product" name="product">
													</label>
												</div>
											</div>
										</section>

										<section>
											<div class="row">
												<label class="label col col-2">Show Time</label>
												<div class="col col-10">
													<label class="input required">
														<input type="showTime" name="showTime">
													</label>
												</div>
											</div>
										</section>
										<section>
											<div class="row">
												<label class="label col col-2">QTY</label>
												<div class="col col-10">
													<label class="input required">
														<input type="QTY" name="QTY">
													</label>
												</div>
											</div>
										</section>
										<section>
											<div class="row">
												<label class="label col col-2">Remark</label>
												<div class="col col-10">
													<label class="input">
														<textarea rows="4" name="remark" id="remark"></textarea>
													</label>
												</div>
											</div>
										</section>
										<section>
											<div class="row">
												<label class="label col col-2">Status</label>
												<div class="col col-10">
													<label class="input">
														<div class="inline-group">
															<label class="radio">
																<input type="radio" name="radio-inline" checked="">
																<i></i>New</label>
															<label class="radio">
																<input type="radio" name="radio-inline">
																<i></i>Complete</label>
															<label class="radio">
																<input type="radio" name="radio-inline">
																<i></i>Modify</label>
															<label class="radio">
																<input type="radio" name="radio-inline">
																<i></i>Cancel</label>
														</div>
													</label>
												</div>
											</div>
										</section>
									</fieldset>
									
									<footer class="center">
										<button type="submit" class="btn btn-primary" style="float: unset;font-weight: 400;">
											Save
										</button>
										<button type="button" class="btn btn-default" data-dismiss="modal" style="float: unset;font-weight: 400;">
											Cancel
										</button>

									</footer>
								</form>						
								

					</div>

				</div><!-- /.modal-content -->
			</div><!-- /.modal-dialog -->
		</div><!-- /.modal -->


	</div>
	<!-- END MAIN CONTENT -->

</div>
<!-- END MAIN PANEL -->
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

<!-- PAGE RELATED PLUGIN(S) -->
<script src="<?php echo ASSETS_URL; ?>/js/plugin/jquery-form/jquery-form.min.js"></script>


<script type="text/javascript">
		
// DO NOT REMOVE : GLOBAL FUNCTIONS!

$(document).ready(function() {

	var errorClass = 'invalid';
	var errorElement = 'em';

	var $contactForm = $("#contact-form").validate({
		errorClass		: errorClass,
		errorElement	: errorElement,
		highlight: function(element) {
	        $(element).parent().removeClass('state-success').addClass("state-error");
	        $(element).removeClass('valid');
	    },
	    unhighlight: function(element) {
	        $(element).parent().removeClass("state-error").addClass('state-success');
	        $(element).addClass('valid');
	    },
		// Rules for form validation
		rules : {
			lsbagent_id : {
				required : true,
			},
			txbbooking_name : {
				required : true,
			},
			txbbooking_pax : {
				required : true,
				minlength : 1
			}
		},

		// Messages for form validation
		messages : {
			lsbagent_id : {
				required : 'Please select agent',
			},
			txbbooking_name : {
				required : 'Please fill Tour Leader Name',
			},
			txbbooking_pax : {
				required : 'Please fill PAX',
				minlength : 'Pax incorrect'
			}
		},

		// Ajax form submition
		submitHandler : function(form) {
			$(form).ajaxSubmit({
				success : function() {
					$("#contact-form").addClass('submited');
				}
			});
		},

		// Do not change code below
		errorPlacement : function(error, element) {
			error.insertAfter(element.parent());
		}
	});

	var $loginForm = $("#login-form").validate({
		errorClass		: errorClass,
		errorElement	: errorElement,
		highlight: function(element) {
	        $(element).parent().removeClass('state-success').addClass("state-error");
	        $(element).removeClass('valid');
	    },
	    unhighlight: function(element) {
	        $(element).parent().removeClass("state-error").addClass('state-success');
	        $(element).addClass('valid');
	    },
		// Rules for form validation
		rules : {
			email : {
				required : true,
				email : true
			},
			password : {
				required : true,
				minlength : 3,
				maxlength : 20
			}
		},

		// Messages for form validation
		messages : {
			email : {
				required : 'Please enter your email address',
				email : 'Please enter a VALID email address'
			},
			password : {
				required : 'Please enter your password'
			}
		},

		// Do not change code below
		errorPlacement : function(error, element) {
			error.insertAfter(element.parent());
		}
	});

})

</script>

<?php
	//include footer
	include ("inc/google-analytics.php");
?>																														