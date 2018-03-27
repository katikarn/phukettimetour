<?php 
	session_start();
	include('inc/auth.php');
	include("inc/connectionToMysql.php");
	include("registerAgentController.php");
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
							<div class="checkbox" style="padding-left: 0px;">
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
											<th data-hide="phone">Agent name</th>
											<th data-class="expand">Email</th>
											<th data-hide="phone">Username</th>
											<th>Status</th>
											<th></th>
										</tr>
									</thead>
									<tbody>
										<script type="text/javascript">
											var storeUsername = [];
										</script>
										<?PHP
											$sql = "SELECT `agentid`, `username`, `email`, `password`, `agentname`, 
													`agentaddress`, `agentcontactname`, `agentcontacttel`, `maximumcredit`, 
													`remaincredit`, `creditterm`, `pricetype`, `vattype`, `status`, `note`
													FROM `agent` ";
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
													?>
													<tr>
														<script type="text/javascript">
															storeUsername.push('<?=$row['username']?>');
														</script>
														<td><?=$row['agentname']?></td>
														<td><?=$row['email']?></td>
														<td><?=$row['username']?></td>
														<td><?=$statusUser?></td>
														<td class="center"><a onclick="resetModal();" class="btn btn-small btn-primary"
															data-toggle="modal"
															data-target="#myModal"
															data-whatever="<?=$row['agentid']?>" >Edit</a>
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
          	<h4 class="header">Agent Manager</h4>
        </div>
        <div class="modal-body no-padding">
        	<form action='agent-management.php' method='post' class="smart-form" id="agent-form">
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
							<label class="label col col-3 header">Agent Name</label>
							<div class="col col-9">
								<label class="input required">
									<input type="text" name="agentName" id="agentName">
								</label>
							</div>
						</div>
					</section>
					<section>
						<div class="row">
							<label class="label col col-3 header">Username</label>
							<div class="col col-9">
								<label class="input required">
									<input type="text" name="username" id="username">
								</label>
							</div>
						</div>
					</section>
					<section>
						<div class="row">
							<label class="label col col-3 header">Password</label>
							<div class="col col-9">
								<label class="input required">
									<input type="password" name="password" id="password">
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
							<label class="label col col-3 header">Maximum Credit</label>
							<div class="col col-9">
								<label class="input required">
									<input type="text" name="maxCredit" id="maxCredit">
								</label>
							</div>
						</div>
					</section>
					<section>
						<div class="row">
							<label class="label col col-3 header">Credit Term (Day)</label>
							<div class="col col-9">
								<label class="input required">
									<input type="number" step="1" name="creditTerm" id="creditTerm">
								</label>
							</div>
						</div>
					</section>
					<section>
						<div class="row">
							<label class="label col col-3 header">Price Type</label>
							<div class="col col-9">
								<label class="input">
									<div class="inline-group">
										<label class="radio">
											<input type="radio" name="priceType" value="N" id="p_TypeN" checked>
											<i></i>Normal</label>
										<label class="radio">
											<input type="radio" name="priceType" value="S" id="p_TypeS">
											<i></i>Special</label>
										<label class="radio">
											<input type="radio" name="priceType" value="O" id="p_TypeO">
											<i></i>Oversea Agent</label>
									</div>
								</label>
							</div>
						</div>
					</section>
					<section>
						<div class="row">
							<label class="label col col-3 header">Vat Type</label>
							<div class="col col-9">
								<label class="input">
									<div class="inline-group">
										<label class="radio">
											<input type="radio" name="varType" value="I" id="v_TypeI" checked>
											<i></i>Include</label>
										<label class="radio">
											<input type="radio" name="varType" value="E" id="v_TypeE">
											<i></i>Exclude</label>
									</div>
								</label>
							</div>
						</div>
					</section>		

        		</fieldset>
        		<header>
					Contact
				</header>
        		<fieldset>
					<section>
						<div class="row">
							<label class="label col col-3 header">Email</label>
							<div class="col col-9">
								<label class="input required">
									<input type="email" name="email" id="email">
								</label>
							</div>
						</div>
					</section>
					<section>
						<div class="row">
							<label class="label col col-3 header">Contact Name</label>
							<div class="col col-9">
								<label class="input">
									<input type="text" name="conatactName" id="conatactName">
								</label>
							</div>
						</div>
					</section>
					<section>
						<div class="row">
							<label class="label col col-3 header">Tel</label>
							<div class="col col-9">
								<label class="input">
									<input type="text" name="tel" id="tel" onkeypress="return event.charCode >= 48 && event.charCode <= 57">
								</label>
							</div>
						</div>
					</section>
					<section>
						<div class="row">
							<label class="label col col-3 header">Address</label>
							<div class="col col-9">
								<label class="input">
									<input type="text" name="address" id="address">
								</label>
							</div>
						</div>
					</section>	
					<section>
						<div class="row">
							<label class="label col col-3 header">Remark</label>
							<div class="col col-9">
								<label class="input">
									<textarea rows="4" name="note" id="note"></textarea>
								</label>
							</div>
						</div>
					</section>		

        		</fieldset>
				<footer class="center">
					<input type="hidden" name="agent_id" id="agent_id" />
						<button type="submit" name="submitAddAgent" id="submitAddAgent"	class="btn btn-primary" style="float: unset;font-weight: 400;">Save</button>
						<button type="button" class="btn btn-default" data-dismiss="modal" style="float: unset;font-weight: 400;">Cancel</button>
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
						$('#m_Status' + data.status).prop('checked',true);
						$('#agentName').val(data.agentname);
						$('#username').val(data.username);   
						$('#password').val(data.password);  
						$('#maxCredit').val(data.maximumcredit);   
						//$('#creditTerm').val(data.creditterm);
						$('#p_Type' + data.pricetype).prop('checked',true);
						$('#v_Type' + data.vattype).prop('checked',true);
						$('#email').val(data.email);
						$('#conatactName').val(data.agentcontactname);
						$('#tel').val(data.agentcontacttel);
						$('#address').val(data.agentaddress);
						$('#note').val(data.note);
						$('#agent_id').val(data.agentid);
						
						$('#submitAddAgent').val("Update");  
					}else{
						$('#m_StatusA').prop('checked',true);
						// $('#m_StatusI').prop('checked',false);
						// $('#m_StatusC').prop('checked',false);
						$('#agentname').val('');
						$('#username').val('');  
						$('#email').val('');  
						$('#password').val('');  
						$('#maxCredit').val('');   
						$('#creditTerm').val('');
						$('#p_TypeN').prop('checked',true);
						// $('#p_TypeS').prop('checked',false);
						$('#v_TypeI').prop('checked',true);
						// $('#v_TypeE').prop('checked',false);
						$('#conatactName').val('');
						$('#tel').val('');
						$('#address').val('');
						$('#note').val('');
						$('#agent_id').val('');
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
				agentName : {
					required : true,
				},
				username : {
					required : true,
					minlength : 6,
					notEqual: true
				},
				password :{
					required : true,
					minlength : 6,
					haveNumber: true
				},
				email :{
					required : true,
					email : true
				},
				maxCredit :{
					required : true,
				},
				creditTerm :{
					required : true,
				}
			},

			// Messages for form validation
			messages : {
				agentName : {
					required : 'Please enter your AgentName',
				},
				username : {
					required : 'Please enter your Username',
					minlength: 'Username must more than 6 character ',
					notEqual: 'Username must not duplicate'
				},
				password : {
					required : 'Please enter your Password',
					minlength: 'Password must more than 6 character',
					haveNumber: 'Password must more less than 1 number'
				},
				email : {
					required : 'Please enter your email address',
					email : 'Email format incorrect'
				},
				maxCredit : {
					required : 'Please enter your Max Credit',
				},
				creditTerm : {
					required : 'Please enter your Credit Term',
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