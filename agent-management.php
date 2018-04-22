<?php 
	session_start();
	include("inc/auth.php");
	include("inc/constant.php");
	include("inc/connectionToMysql.php");
	include("agent-controller.php");
/////////////////////////////////////////////////////////
	//initilize the page
	require_once ("inc/init.php");
	
	//require UI configuration (nav, ribbon, etc.)
	require_once ("inc/config.ui.php");
	
	/*---------------- PHP Custom Scripts ---------
		
		YOU CAN SET CONFIGURATION VARIABLES HERE BEFORE IT GOES TO NAV, RIBBON, ETC.
	E.G. $page_title = "Custom Title" */
	
	$page_title = "Agent Management";
	
	/* ---------------- END PHP Custom Scripts ------------- */
	
	//include header
	//you can add your custom css in $page_css array.
	//Note: all css files are inside css/ folder
	$page_css[] = "your_style.css";
	include ("inc/header.php");
	
	//include left panel (navigation)
	//follow the tree in inc/config.ui.php
	$page_nav["Setup"]["sub"]["Agent Management"]["active"] = true;
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
					Agent
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
						<div class="hidden-md col-lg-2">
							<!-- Date<br/>
							<input id="date_search" placeholder="DD/MM/YYYY" type="text" name="date_search"> -->
						</div>
						<div class="col-xs-12 col-sm-10 col-md-8 col-lg-6 status smart-form" style="padding-top: 25px;">
							<div class="checkbox" style="padding-left: 0px;">
								<div class="col-xs-3 col-md-3">
									<label class="checkbox">
										<input type="checkbox" name="status" id="StatusA" value="Active" onclick="filterCheckbox();" checked ><i></i><span style="background-color: green">Active</span></label>
								</div>
								<div class="col-xs-3 col-md-3">
									<label class="checkbox">
										<input type="checkbox" name="status" id="StatusI" value="Inactive" onclick="filterCheckbox();" checked ><i></i><span style="background-color: red">Inactive</span></label>
								</div>
								<div class="col-xs-3 col-md-3">
									<label class="checkbox">
										<input type="checkbox" name="status" id="StatusC" value="Cancel" onclick="filterCheckbox();" checked ><i></i><span style="background-color: orange">Cancel</span></label>
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
											<th data-hide="phone">Agent ID</th>
											<th data-class="expand">Agent name</th>
											<th data-hide="phone">Email</th>
											<th data-hide="phone">Tel</th>
											<th data-hide="phone">Status</th>
											<th class="center"><button style="padding: 6px 12px;" class="btn btn-primary" id="m1s" data-whatever="" data-toggle="modal" data-target="#myModal" onclick="resetModal()">Add new</button></th>
										</tr>
									</thead>
									<tbody>
										<script type="text/javascript">
											var storeUsername = [];
										</script>
										<?PHP
											$sql = "SELECT `agent_id`, `agent_username`, `agent_main_email`, `agent_password`, `agent_name`, 
													`agent_address`, `agent_status`, `agent_remark`, `agent_main_tel`
													FROM `agent`
													ORDER BY `agent_name`";
											$result = mysqli_query($conn ,$sql);
											if(mysqli_num_rows($result) > 0){
												//show data for each row
												while($row = mysqli_fetch_assoc($result)){
													if($row['agent_status'] == 'A'){
														$statusUser = '<font color="green">Active</font>';
													}else if($row['agent_status'] == 'I'){
														$statusUser = '<font color="red">Inactive</font>';
													}else if($row['agent_status'] == 'C'){
														$statusUser = '<font color="red">Cancel</font>';
													}
													?>
													<tr>
														<script type="text/javascript">
															storeUsername.push('<?=$row['agent_username']?>');
														</script>
														<td><?=substr("00000000",1,4-strlen($row['agent_id'])).$row['agent_id']?></td>
														<td><?=$row['agent_name']?></td>
														<td><?=$row['agent_main_email']?></td>
														<td><?=$row['agent_main_tel']?></td>
														<td><?=$statusUser?></td>
														<td class="center"><a onclick="resetModal();" class="btn btn-small btn-success"
															data-toggle="modal"
															data-target="#myModal"
															data-whatever="<?=$row['agent_id']?>" >Edit</a>
															<a href="agent-management.php?id=<?=$row['agent_id']?>&hAction=Delete" class="btn btn-small btn-danger">Del</a>
														</td>
													</tr>
													<?PHP
												}
											}
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
          		<h4 class="header">Agent Manager</h4>
        	</div>
        	<div class="modal-body no-padding">
				<form action='agent-management.php' method='post' class="smart-form" id="agent-form" enctype="multipart/form-data">
        			<fieldset>
        				<section>
							<div class="row">
								<label class="label col col-3 header">Status</label>
								<div class="col col-9">
									<label class="input status">
										<div class="inline-group">
											<label class="radio">
												<input type="radio" name="chkagent_status" value="A" id="chkagent_status_A" checked=true>
												<i></i><span style="background-color: green">Active
											</span>
											</label>
											<label class="radio">
												<input type="radio" name="chkagent_status" value="I" id="chkagent_status_I">
												<i></i><span style="background-color: red">Inactive
											</span>
											</label>
											<label class="radio">
												<input type="radio" name="chkagent_status" value="C" id="chkagent_status_C">
												<i></i><span style="background-color: orange">Cancel
											</span>
											</label>
										</div>
									</label>
								</div>
							</div>
							<div class="row">
								<label class="label col col-3 header">Agent Name</label>
								<div class="col col-9">
									<label class="input required">
										<input type="text" name="txbagent_name" id="txbagent_name">
									</label>
								</div>
							</div>
							<div class="row">
								<label class="label col col-3 header">Name for Account</label>
								<div class="col col-9">
									<label class="input required">
										<input type="text" name="txbagent_name_acc" id="txbagent_name_acc">
									</label>
								</div>
							</div>
							<div class="row">
								<label class="label col col-3 header">Address</label>
								<div class="col col-9">
									<label class="input">
										<input type="text" name="txbagent_address" id="txbagent_address">
									</label>
								</div>
							</div>
							<div class="row">
								<label class="label col col-3 header">Contact Person</label>
								<div class="col col-4">
									<label class="input required">
										<input type="text" name="txbagent_main_name" id="txbagent_main_name" maxlength="50">
									</label>
								</div>
								<label class="label col col-2 header">Tel</label>
								<div class="col col-3">
									<label class="input required">
										<input type="text" name="txbagent_main_tel" id="txbagent_main_tel" onkeypress="return event.charCode >= 48 && event.charCode <= 57" maxlength="15">
									</label>
								</div>
							</div>
							<div class="row">
								<label class="label col col-3 header">Email</label>
								<div class="col col-4">
									<label class="input required">
										<input type="text" name="txbagent_main_email" id="txbagent_main_email" maxlength="50">
									</label>
								</div>
								<label class="label col col-2 header">Line</label>
								<div class="col col-3">
									<label class="input">
										<input type="text" name="txbagent_main_line" id="txbagent_main_line" maxlength="50">
									</label>
								</div>
							</div>
							<div class="row">
								<label class="label col col-3 header">Upload file</label>
								<div class="input input-file col col-9">
									<span class="button">
										<input type="file" name="txbagent_file" id="txbagent_file" onchange="this.parentNode.nextSibling.value = this.value; showFile(this.id);">Browse
									</span>
									<input type="text" placeholder="Include files" readonly="" id="show_agent_file">
									<a id="show_txbagent_file" target="_blank" style="display: none"></a>
									<input type="hidden" id="Text_txbagent_file" name="Text_txbagent_file"/> 
								</div>
							</div>
						</section>
						<header>Condition</header>
						<section>
							<div class="row">
								<label class="label col col-3 header">Business Section</label>
								<div class="col col-4">
									<label class="input required">
										<select name="lsbagent_section" id="lsbagent_section">
											<option value="" selected></option>
											<option value="D">DMC</option>
											<option value="T">Tour Counter</option>
											<option value="A">Travel Agent</option>
											<option value="W">Wholesale Travel Company</option>
											<option value="C">Corperate</option>
											<option value="G">Goverment</option>
										</select>
									</label>
								</div>
								<label class="label col col-2 header">License</label>
								<div class="col col-3">
									<label class="input">
										<input type="text" name="txbagent_license" id="txbagent_license">
									</label>
								</div>
							</div>
							<div class="row">							
								<label class="label col col-3 header">Rate Type</label>
								<div class="col col-4">
									<label class="input required">
										<select name="chkagent_price_type" id="chkagent_price_type">
											<option value="" selected></option>
											<option value="A">Agent Rate A</option>
											<option value="B">Agent Rate B</option>
											<option value="O">Oversea Rate</option>
										</select>
									</label>
								</div>
								<label class="label col col-2 header">CreditTerm</label>
								<div class="col col-3">
									<label class="input">
										<input type="number" step="1" name="txbagent_creditterm" id="txbagent_creditterm">
									</label>
								</div>
							</div>
							<div class="row">							
								<label class="label col col-3 header">Pay Type</label>
								<div class="col col-4">
									<label class="input required">
										<select name="chkagent_pay_type" id="chkagent_pay_type">
											<option value="" selected></option>
											<option value="T">Cash</option>
											<option value="D">Deposit</option>
											<option value="C">Credit</option>
										</select>
									</label>
								</div>
								<label class="label col col-2 header">Amount</label>
								<div class="col col-3">
									<label class="input">
										<input type="number" step="0.25" name="txbagent_amount" id="txbagent_amount">
									</label>
								</div>
							</div>
							<div class="row">						
								<label class="label col col-3 header">Vat Type</label>
								<div class="col col-9">
									<label class="input">
										<div class="inline-group">
											<label class="radio">
												<input type="radio" name="chkagent_vat_type" value="I" id="chkagent_vat_type_I" checked>
												<i></i>Include
											</label>
											<label class="radio">
												<input type="radio" name="chkagent_vat_type" value="E" id="chkagent_vat_type_E">
												<i></i>Exclude
											</label>
										</div>
									</label>
								</div>
							</div>
						</section>
					</fieldset>
					<fieldset>
						<header>Contact - Booking Person</header>
						<section>
							<label class="label col col-3 header">Name</label>
							<div class="col col-9">
								<label class="input">
									<input type="text" name="txbagent_reserv_name" id="txbagent_reserv_name" maxlength="50">
								</label>
							</div>
							<label class="label col col-3 header">Tel</label>
							<div class="col col-3">
								<label class="input">
									<input type="text" name="txbagent_reserv_tel" id="txbagent_reserv_tel" onkeypress="return event.charCode >= 48 && event.charCode <= 57" maxlength="15">
								</label>
							</div>
							<label class="label col col-2 header">Email</label>
							<div class="col col-4">
								<label class="input">
									<input type="text" name="txbagent_reserv_email" id="txbagent_reserv_email" maxlength="50">
								</label>
							</div>
							<label class="label col col-3 header">Fax</label>
							<div class="col col-3">
								<label class="input">
									<input type="text" name="txbagent_reserv_fax" id="txbagent_reserv_fax" maxlength="50">
								</label>
							</div>										
							<label class="label col col-2 header">Line</label>
							<div class="col col-4">
								<label class="input">
									<input type="text" name="txbagent_reserv_line" id="txbagent_reserv_line" maxlength="50">
								</label>
							</div>
						</section>
						<header>Contract - Account Person</header>
						<section>
							<label class="label col col-3 header">Name</label>
							<div class="col col-9">
								<label class="input">
									<input type="text" name="txbagent_account_name" id="txbagent_account_name" maxlength="50">
								</label>
							</div>
							<label class="label col col-3 header">Tel</label>
							<div class="col col-3">
								<label class="input">
									<input type="text" name="txbagent_account_tel" id="txbagent_account_tel" onkeypress="return event.charCode >= 48 && event.charCode <= 57" maxlength="15">
								</label>
							</div>
							<label class="label col col-2 header">Email</label>
							<div class="col col-4">
								<label class="input">
									<input type="text" name="txbagent_account_email" id="txbagent_account_email" maxlength="50">
								</label>
							</div>
							<label class="label col col-3 header">Note</label>
							<div class="col col-9">		
								<label class="input">
									<textarea type="text" rows="4" name="txbagent_remark" id="txbagent_remark" maxlength="500"></textarea>
								</label>
							</div>
						</section>
						<header>Login Information</header>
						<section>
							<label class="label col col-3 header">Username</label>
							<div class="col col-9">
								<label class="input required">
									<input type="text" name="txbagent_username" id="txbagent_username">
								</label>
							</div>
							<label class="label col col-3 header">Password</label>
							<div class="col col-9">
								<label class="input required">
									<input type="text" name="txbagent_password" id="txbagent_password">
								</label>
							</div>
						</section>
					</fieldset>
					<footer class="center">
						<input type="hidden" name="agent_id" id="agent_id" />
							<button type="submit" name="submitAddAgent" id="submitAddAgent"	class="btn btn-primary" style="float: unset;font-weight: 400;">Save</button>
							<button type="button" class="btn btn-default" data-dismiss="modal" style="float: unset;font-weight: 400;">Cancel</button>
							<button type="button" class="btn btn-default" data-dismiss="modal" style="float: unset;font-weight: 400;">Send user email</button>
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
			var dataString = 'agent_id=' + recipient;
			console.log('dataString :'+dataString);
            $.ajax({
                
                url: "fetchEdit.php",
				type:"POST",
                data: dataString,
				dataType : 'json',
                
                success: function (data) {
					if(data != null){
						$('#agent_id').val(data.agent_id);
						$('#chkagent_status_' + data.agent_status).prop('checked',true);
						$('#txbagent_name').val(data.agent_name);
						$('#txbagent_name_acc').val(data.agent_name_acc);
						$('#txbagent_main_name').val(data.agent_main_name);
						$('#txbagent_main_tel').val(data.agent_main_tel);
						$('#txbagent_main_email').val(data.agent_main_email);
						$('#txbagent_main_line').val(data.agent_main_line);
						$('#show_agent_file').val(data.agent_file);

						$('#Text_txbagent_file').val(data.agent_file);
						$('#show_txbagent_file').html(data.agent_file);
						$('#show_txbagent_file').attr('href','<?=$path_folder_Agent ?>' + data.agent_file);
						$('#show_txbagent_file').css("display","block");

						$('#lsbagent_section').val(data.agent_section);											
						$('#txbagent_license').val(data.agent_license);
						$('#chkagent_price_type').val(data.agent_price_type);
						$('#txbagent_creditterm').val(data.agent_creditterm);						
						$('#chkagent_pay_type').val(data.agent_pay_type);
						$('#txbagent_amount').val(data.agent_amount);
						$('#chkagent_vat_type_' + data.agent_vat_type).prop('checked',true);
						$('#txbagent_reserv_name').val(data.agent_reserv_name);
						$('#txbagent_reserv_tel').val(data.agent_reserv_tel);
						$('#txbagent_reserv_email').val(data.agent_reserv_email);
						$('#txbagent_reserv_line').val(data.agent_reserv_line);
						$('#txbagent_reserv_fax').val(data.agent_reserv_fax);
						$('#lsbagent_reserv_main').val(data.agent_reserv_main);
						$('#txbagent_account_name').val(data.agent_account_name);
						$('#txbagent_account_tel').val(data.agent_account_tel);
						$('#txbagent_account_email').val(data.agent_account_email);
						$('#txbagent_remark').val(data.agent_remark);
						$('#txbagent_username').val(data.agent_username);
						$('#txbagent_password').val(data.agent_password);
						$('#submitAddAgent').val("Update");
					}else{
						$('#agent_id').val('');
						$('#chkagent_status_A').prop('checked',true);
						//$('#chkagent_status_I').prop('checked',true);
						//$('#chkagent_status_C').prop('checked',true);
						$('#txbagent_name').val('');
						$('#txbagent_name_acc').val('');
						$('#txbagent_main_name').val('');
						$('#txbagent_main_tel').val('');
						$('#txbagent_main_email').val('');
						$('#txbagent_main_line').val('');

						$('#txbagent_file').val('');
						$('#show_agent_file').val('');
						$('#Text_txbagent_file').val('');
						$('#show_txbagent_file').css("display","none");
						$('#show_txbagent_file').attr('href','');
						$('#show_txbagent_file').html('');

						$('#lsbagent_section').val('');
						$('#txbagent_license').val('');	
						$('#chkagent_price_type').val('');
						$('#txbagent_creditterm').val('');
						$('#chkagent_pay_type').val('');						
						$('#txbagent_amount').val('');
						$('#chkagent_vat_type_E').prop('checked',true);
						//$('#chkagent_vat_type_I').prop('checked',true);
						$('#txbagent_reserv_name').val('');
						$('#txbagent_reserv_tel').val('');
						$('#txbagent_reserv_email').val('');
						$('#txbagent_reserv_line').val('');
						$('#txbagent_reserv_fax').val('');
						$('#lsbagent_reserv_main').val('');
						$('#txbagent_account_name').val('');
						$('#txbagent_account_tel').val('');
						$('#txbagent_account_email').val('');
						$('#txbagent_remark').val('');
						$('#txbagent_username').val('');
						$('#txbagent_password').val('');
						$('#submitAddAgent').val("Insert");
					}
				},
                error: function(err) {
                    console.log('err : '+err);
				}
			});  
		});

		var errorClass = 'invalid';
		var errorElement = 'em';

		var $contactForm = $("#agent-form").validate({
			errorClass		: errorClass,
			errorElement	: errorElement,
			highlight: function(element) {
		        $(element).parent().removeClass('state-success').addClass('state-error');
		        if($(element).parent().hasClass( "required" )){
		        	 $(element).parent().css("border-left", "7px solid #FF3333");
		        }
		        $(element).removeClass('valid');
		    },
		    unhighlight: function(element) {
		        $(element).parent().removeClass('state-error').addClass('state-success');
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
				txbagent_name : {
					required : true,
				},
				txbagent_name_acc : {
					required : true,
				},
				txbagent_main_name : {
					required : true,
				},
				txbagent_main_tel : {
					required : true,
					minlength : 9,
				},
				txbagent_main_email : {
					required : true,
					email : true,
				},
				lsbagent_section : {
					required : true,
				},
				chkagent_price_type : {
					required : true,
				},
				chkagent_pay_type : {
					required : true,
				},
				txbagent_username : {
					required : true,
					minlength : 6,
					notEqual: true,
				},
				txbagent_password : {
					required : true,
					minlength : 6,
					haveNumber: true,
				},
				txbagent_reserv_email : {
					email : true,
				},
				txbagent_account_email : {
					email : true,
				},
			},
			// Messages for form validation
			messages : {
				txbagent_name : {
					required : 'Please fill Agent Name',
				},
				txbagent_name_acc : {
					required : 'Please fill Agent Account Name',
				},
				lsbagent_main_name : {
					required : 'Please select main contract',
				},
				txbagent_main_tel : {
					required : 'Please fill Tel',
					minlength : 'Tel incorrect'
				},
				txbagent_main_email : {
					required : 'Please fill Email',
					email : 'Email incorrect'
				},
				lsbagent_section : {
					required : 'Please select Business Section',
				},
				chkagent_price_type : {
					required : 'Please select Rate Type',
				},
				chkagent_pay_type : {
					required : 'Please select Pay Type',
				},
				txbagent_username : {
					required : 'Please fill Username',
					minlength : 'Username must more than 5 charecter',
					notEqual: 'Dupplicate Username'
				},
				txbagent_password : {
					required : 'Please fill Password',
					minlength : 'Password must more than 5 charecter',
					haveNumber: 'Password must more less than 1 number'
				},
				txbagent_reserv_email : {
					email : 'Email incorrect',
				},
				txbagent_account_email : {
					email : 'Email incorrect',
				},

			},
			// Do not change code below
			errorPlacement : function(error, element) {
				error.insertAfter(element.parent());
			}
		});

		$.validator.addMethod('haveNumber', function(value, element) {
	        return value.match(/\d/)
	    }, '');
	    $.validator.addMethod("notEqual", function(value, element, param) {
	    	var check = true;
	    	var isCheck = $('#submitAddAgent').val(); 
	    	for (var i = 0; i < storeUsername.length; i++) {
	    		//console.log(storeUsername[i]);
	    		if(value == storeUsername[i] && isCheck == "Insert")
	    		{
	    			check = false;
	    		}
	    	}
		  return check;
		}, "");	
	});

	/* END BASIC */

		function showFile(inputID){
		//console.log('inputID' + inputID);
		//console.log($("#"+ inputID)[0].files[0].name);
		var fileName = $("#" + inputID)[0].files[0].name;
		var pathFile = $("#" + inputID).val();
		$("#show_" + inputID ).css("display","block");
		$("#show_" + inputID).html(fileName);
		$("#show_" + inputID).attr("href", pathFile);
	}

	function filterCheckbox(){

		var types = $('input:checkbox[name="status"]:checked').map(function() {
    		return '^' + this.value + '\$';
 		 }).get().join('|');
		  //filter in column 0, with an regex, no smart filtering, no inputbox,not case sensitive
		  //console.log(types);
		  otable.fnFilter(types, 3, true, false, false, false);
	}

	function resetModal(){
		$( "#agent-form" ).find( ".state-error" ).removeClass( "state-error" );
		$( "#agent-form" ).find( ".state-success" ).removeClass( "state-success" );
		$( "#agent-form" ).find( ".required" ).css("border-left", "7px solid #FF3333");
		$( "em" ).remove();
	}
	</script>

	<?php
	//include footer
	include ("inc/google-analytics.php");
	?>																														