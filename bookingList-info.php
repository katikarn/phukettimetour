<?php 
	session_start();
	include('inc/auth.php');
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


		<!-- <div class="row">
			<div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
				<a data-toggle="modal" href="#myModal" class="btn btn-success btn-lg pull-right header-btn hidden-mobile"><i class="fa fa-circle-arrow-up fa-lg"></i> Launch form modal</a>
			</div>
		</div> -->
		<div class="row">
			<div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
				<h1 class="header">
					Booking Information
				</h1>
			</div>
			<div class="col-xs-12 col-sm-5 col-md-5 col-lg-8" style="text-align: right;">
				<a class="btn btn-primary" style="margin-right: 10px;"> 
					<i style="margin-right: 5px;" class="icon-append fa fa-check"></i>Save</a>
				<a href="bookingList.php" class="btn btn-default" style="margin-right: 10px;"> 
					<i style="margin-right: 5px;" class="icon-append fa fa-times"></i>Cancel</a>
				<a class="btn btn-default" style="margin-right: 10px;">
					<i style="margin-right: 5px;" class="icon-append fa fa-file-o"></i>Report </a>
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
							<h2>General Info</h2>				
							
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
										<div class="row">
											<section class="col col-12">
												<label class="label">Status</label>
												<div class="inline-group">
													<label class="radio">
														<input type="radio" name="radio-inline" checked="">
														<i></i>New</label>
													<label class="radio">
														<input type="radio" name="radio-inline">
														<i></i>Complete</label>
													<label class="radio">
														<input type="radio" name="radio-inline">
														<i></i>Cancel</label>
												</div>
											</section>
										</div>

										<section>
											<label class="label">Agent</label>
											<label class="input required">
												<i class="icon-append fa fa-user"></i>
												<input type="text" name="Agent" id="Agent">
											</label>
										</section>

										<section>
											<label class="label">Name</label>
											<label class="input required">
												<i class="icon-append fa fa-user"></i>
												<input type="text" name="name" id="name">
											</label>
										</section>

										<div class="row">
											<section class="col col-6">
												<label class="label">Date</label>
												<label class="input required">
													<i class="icon-append fa fa-user"></i>
													<input type="text" name="named" id="named">
												</label>
											</section>
											<section class="col col-6">
												<label class="label">Total Guest</label>
												<label class="input">
													<i class="icon-append fa fa-envelope-o"></i>
													<input type="email" name="emaild" id="emaild">
												</label>
											</section>
										</div>
										
										<section>
											<label class="label">Note</label>
											<label class="textarea">
												<i class="icon-append fa fa-comment"></i>
												<textarea rows="4" name="message" id="message"></textarea>
											</label>
										</section>
										
									</fieldset>
<!-- 									
									<footer>
										<button type="submit" class="btn btn-primary">Validate Form</button>
									</footer> -->
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
							<!-- widget content -->
							<div class="widget-body no-padding">
								<div class="row" style="margin: 10px 20px 10px 0px;float: right;">
									<button class="btn btn-primary"  data-whatever="" data-toggle="modal" data-target="#myModal" >
										<i style="margin-right: 10px;" class="icon-append fa fa-plus"></i>Add </button>
								</div>
								<table id="dt_basic" class="table table-striped table-bordered table-hover" style="margin-top:0px" width="100%">
									<thead>			                
										<tr class="header">
											<th data-hide="phone">No</th>
											<th data-class="expand">Date</th>
											<th data-hide="phone">Product Name</th>
											<th>Type</th>
											<th>Status</th>
											<th>QTY x UNIT</th>
											<th>Amount</th>
											<th></th>
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
														<td><?=$statusUser?></td>
														<td><?=$statusUser?></td>
														<td><?=$statusUser?></td>
														<td><?=$statusUser?></td>
														<td style="width:12%;text-align: center;"><a class="btn btn-small btn-primary"
															data-toggle="modal"
															data-target="#myModal"
															data-whatever="<?=$row['userid']?>" >Edit</a>
															<a class="btn btn-small btn-primary"
															data-toggle="modal"
															data-target="#myModal"
															data-whatever="<?=$row['userid']?>" >Delete</a>
														</td>
													</tr>
													<?PHP
													}}
										?>
										
									</tbody>
								</table>		
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
			name : {
				required : true
			},
			email : {
				required : true,
				email : true
			},
			message : {
				required : true,
				minlength : 10
			}
		},

		// Messages for form validation
		messages : {
			name : {
				required : 'Please enter your name',
			},
			email : {
				required : 'Please enter your email address',
				email : 'Please enter a VALID email address'
			},
			message : {
				required : 'Please enter your message'
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