<?php
session_start();
include("inc/connectionToMysql.php");
include("login-controller.php");
//Unset the variables stored in session
// unset($_SESSION['LoginUserID']);
// unset($_SESSION['LoginUser']);
//initilize the page
require_once("inc/init.php");

//require UI configuration (nav, ribbon, etc.)
require_once("inc/config.ui.php");

/*---------------- PHP Custom Scripts ---------

YOU CAN SET CONFIGURATION VARIABLES HERE BEFORE IT GOES TO NAV, RIBBON, ETC.
E.G. $page_title = "Custom Title" */

$page_title = "Login";

/* ---------------- END PHP Custom Scripts ------------- */

//include header
//you can add your custom css in $page_css array.
//Note: all css files are inside css/ folder
$page_css[] = "your_style.css";
$no_main_header = true;
$page_html_prop = array("id"=>"extr-page", "class"=>"animated fadeInDown");
include("inc/header.php");

?>
<style type="text/css">
	#main{

		background: #C33764 !important;  /* fallback for old browsers */
		background: -webkit-linear-gradient(to right, #1D2671, #C33764) !important;  /* Chrome 10-25, Safari 5.1-6 */
		background: linear-gradient(to right, #1D2671, #C33764) !important; /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
	}
</style>
<!-- ==========================CONTENT STARTS HERE ========================== -->
<!-- possible classes: minified, no-right-panel, fixed-ribbon, fixed-header, fixed-width-->
<header id="header">
	<!--<span id="logo"></span>-->

	<div id="logo-group">
		<span id="logo"> <img src="<?php echo ASSETS_URL; ?>/img/logo.png" alt="SmartAdmin"> </span>

		<!-- END AJAX-DROPDOWN -->
	</div>

	<span id="extr-page-header-space"> <span class="hidden-mobile hiddex-xs">Need an account?</span> <a href="<?php echo APP_URL; ?>/register.php" class="btn btn-danger">Create account</a> </span>

</header>

<div id="main" role="main">

	<!-- MAIN CONTENT -->
	<div id="content" class="container">

		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-5 col-lg-4">
				<div class="well no-padding">
				<form id="login-form" method="POST" class="smart-form client-form" action="login.php">
					
						<header>
							Sign In
						</header>

						<fieldset>
							
							<section>
								<label class="label">Username</label>
								<label class="input"> <i class="icon-append fa fa-user"></i>
									<input type="text" name="username">
									<b class="tooltip tooltip-top-right"><i class="fa fa-user txt-color-teal"></i> Please enter email address/username</b></label>
							</section>

							<section>
								<label class="label">Password</label>
								<label class="input"> <i class="icon-append fa fa-lock"></i>
									<input type="password" name="password">
									<b class="tooltip tooltip-top-right"><i class="fa fa-lock txt-color-teal"></i> Enter your password</b> </label>
								<div class="note">
									<a href="<?php echo APP_URL; ?>/forgotpassword.php">Forgot password?</a>
								</div>
							</section>

						</fieldset>
						<footer class="text-center">
							<button type="submit" name="submitSignIn" class="btn btn-primary" style="float:none">
								Sign in
							</button>
						</footer>
					</form>

				</div>
				
				
			</div>
			<div class="col-xs-12 col-sm-12 col-md-7 col-lg-8 hidden-xs hidden-sm">
				

			</div>
			
		</div>
	</div>

</div>
<!-- END MAIN PANEL -->
<!-- ==========================CONTENT ENDS HERE ========================== -->

<?php 
	//include required scripts
	include("inc/scripts.php"); 
?>

<!-- PAGE RELATED PLUGIN(S) 
<script src="..."></script>-->

<script type="text/javascript">
	runAllForms();

	$(function() {
		// Validation
		$("#login-form").validate({
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
	});
</script>

<?php 
	//include footer
	include("inc/google-analytics.php"); 
?>