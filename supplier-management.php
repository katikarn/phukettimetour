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
														<td class="center"><a onclick="resetModal();" class="btn btn-small btn-primary"
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
<div class="modal fade" id="myModal" role="dialog" data-backdrop="static">
	<div class="modal-dialog modal-Adduser">
		
		<!-- Modal content-->
		
		<div class="modal-content">
			
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
						<i class="icon-append fa fa-times"></i>
					</button>
					<h4 class="header">Supplier</h4>
				</div>
				<div class="modal-body no-padding">
					<form action='supplier-management.php' method='post' id="supplier-form" class="smart-form">
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
									<label class="label col col-3 header">Type</label>
									<div class="col col-9">
										<label class="input">
											<div class="inline-group">
												<label class="radio">
													<input type="radio" name="type" value="T" id="m_TypeT" checked>
													<i></i>Ticket</label>
												<label class="radio">
													<input type="radio" name="type" value="D" id="m_TypeD">
													<i></i>Day Tip</label>
												<label class="radio">
													<input type="radio" name="type" value="C" id="m_TypeC">
													<i></i>Transport</label>
												<label class="radio">
													<input type="radio" name="type" value="M" id="m_TypeM">
													<i></i>Meal</label>
											</div>
										</label>
									</div>
								</div>
							</section>
							<section>
								<div class="row">
									<label class="label col col-3 header">Destination</label>
									<div class="col col-9">
										<label class="input required">
											<input type="text" name="s_Destination" id="s_Destination">
										</label>
									</div>
								</div>
							</section>	
							<section>
								<div class="row">
									<label class="label col col-3 header">Supplier Name</label>
									<div class="col col-9">
										<label class="input required">
											<input type="text" name="s_Name" id="s_Name">
										</label>
									</div>
								</div>
							</section>	
							<section>
								<div class="row">
									<label class="label col col-3 header">Detail</label>
									<div class="col col-9">
										<label class="input required">
											<textarea type="text" rows="5" name="s_Detail" id="s_Detail"></textarea>
										</label>
									</div>
								</div>
							</section>
							<section>
								<div class="row">
									<label class="label col col-3 header">Address</label>
									<div class="col col-9">
										<label class="input">
											<input type="text" name="s_Address" id="s_Address">
										</label>
									</div>
								</div>
							</section>
							<section>
								<div class="row">
									<label class="label col col-3 header">Tel</label>
									<div class="col col-9">
										<label class="input">
											<input type="text" name="s_Tel" id="s_Tel" onkeypress="return event.charCode >= 48 && event.charCode <= 57">
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
									<label class="label col col-3 header">Pay Type</label>
									<div class="col col-9">
										<label class="input">
											<div class="inline-group">
												<label class="radio">
													<input type="radio" name="PayType" value="C" id="p_TypeC" checked>
													<i></i>Credit</label>
												<label class="radio">
													<input type="radio" name="PayType" value="D" id="p_TypeD">
													<i></i>Cash transfer</label>
											</div>
										</label>
									</div>
								</div>
							</section>
							<section>
								<div class="row">
									<label class="label col col-3 header">Credit Term</label>
									<div class="col col-9">
										<label class="input required">
											<input type="number" step=".01" name="s_MaximumCredit" id="s_MaximumCredit">
										</label>
									</div>
								</div>
							</section>	
							<!-- <section>
								<div class="row">
									<label class="label col col-3 header">Deposit Amount</label>
									<div class="col col-9">
										<label class="input required">
											<input type="number" step=".01" name="s_DepositAmount" id="s_DepositAmount">
										</label>
									</div>
								</div>
							</section> -->
						</fieldset>
						<header>
							Contract - Resevation
						</header>
						<fieldset>
							<section>
								<div class="row">
									<label class="label col col-3 header">Name</label>
									<div class="col col-9">
										<label class="input required">
											<input type="text" name="s_Bookingcontact" id="s_Bookingcontact">
										</label>
									</div>
								</div>
							</section>	
							<section>
								<div class="row">
									<label class="label col col-3 header">Tel</label>
									<div class="col col-9">
										<label class="input">
											<input type="text" name="s_Bookingtel" id="s_Bookingtel" onkeypress="return event.charCode >= 48 && event.charCode <= 57">
										</label>
									</div>
								</div>
							</section>	
							<section>
								<div class="row">
									<label class="label col col-3 header">Email</label>
									<div class="col col-9">
										<label class="input">
											<input type="text" name="s_Bookingemail" id="s_Bookingemail">
										</label>
									</div>
								</div>
							</section>	
						</fieldset>
						<header>
							Contract - Account
						</header>
						<fieldset>
							<section>
								<div class="row">
									<label class="label col col-3 header">Name</label>
									<div class="col col-9">
										<label class="input required">
											<input type="text" name="s_Accountcontact" id="s_Accountcontact">
										</label>
									</div>
								</div>
							</section>	
							<section>
								<div class="row">
									<label class="label col col-3 header">Tel</label>
									<div class="col col-9">
										<label class="input">
											<input type="text" name="s_Accounttel" id="s_Accounttel" onkeypress="return event.charCode >= 48 && event.charCode <= 57">
										</label>
									</div>
								</div>
							</section>	
							<section>
								<div class="row">
									<label class="label col col-3 header">Email</label>
									<div class="col col-9">
										<label class="input">
											<input type="text" name="s_Accountemail" id="s_Accountemail">
										</label>
									</div>
								</div>
							</section>	
						</fieldset>
						<!-- <header>
							Contract - Salse
						</header>
						<fieldset>
							<section>
								<div class="row">
									<label class="label col col-3 header">Name</label>
									<div class="col col-9">
										<label class="input required">
											<input type="text" name="s_salseContact" id="s_salseContact">
										</label>
									</div>
								</div>
							</section>	
							<section>
								<div class="row">
									<label class="label col col-3 header">Tel</label>
									<div class="col col-9">
										<label class="input">
											<input type="text" name="s_salseTel" id="s_salseTel" onkeypress="return event.charCode >= 48 && event.charCode <= 57">
										</label>
									</div>
								</div>
							</section>	
							<section>
								<div class="row">
									<label class="label col col-3 header">Email</label>
									<div class="col col-9">
										<label class="input">
											<input type="text" name="s_salseEmail" id="s_salseEmail">
										</label>
									</div>
								</div>
							</section>	
						</fieldset> -->
						<!-- <header>
							Other
						</header>
						<fieldset>
							<section>
								<div class="row">
									<label class="label col col-3 header">Close Information</label>
									<div class="col col-9">
										<label class="input">
											<input type="text" name="s_Closeinformation" id="s_Closeinformation">
										</label>
									</div>
								</div>
							</section>	
							<section>
								<div class="row">
									<label class="label col col-3 header">Note</label>
									<div class="col col-9">
										<label class="input">
											<textarea rows="4" name="s_Note" id="s_Note"></textarea>
										</label>
									</div>
								</div>
							</section>	
						</fieldset> -->
						<footer class="center">
							<input type="hidden" name="supplier_id" id="supplier_id" />
							<button type="submit" name="submitAddSupplier" id="submitAddSupplier" class="btn btn-primary" style="float: unset;font-weight: 400;">
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
						// $('#s_salseContact').val(data.accountcontact);
						// $('#s_salseTel').val(data.accounttel);
						// $('#s_salseEmail').val(data.accountemail);
						// $('#s_Closeinformation').val(data.closeinformation);
						// $('#s_Note').val(data.note);
						$('#supplier_id').val(data.supplierid);
						$('#submitAddSupplier').val("Update");  
					}else{
					
						$('#m_StatusA').prop('checked',true);
						// $('#m_StatusI').prop('checked',false);
						// $('#m_StatusC').prop('checked',false);
						$('#m_TypeT').prop('checked',true);
						// $('#m_TypeD').prop('checked',false);
						// $('#m_TypeC').prop('checked',false);
						$('#p_TypeC').prop('checked',true);
						// $('#p_TypeD').prop('checked',false);
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
						// $('#s_salseContact').val('');
						// $('#s_salseTel').val('');
						// $('#s_salseEmail').val('');
						// $('#s_Closeinformation').val('');
						// $('#s_Note').val('');
						$('#supplier_id').val('');
						$('#submitAddSupplier').val("Insert");
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

		var $contactForm = $("#supplier-form").validate({
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
				s_Destination : {
					required : true
				},
				s_Name : {
					required : true
				},
				s_Detail : {
					required : true
				},
				s_MaximumCredit	: {
					required : true
				},	
				// s_DepositAmount	: {
				// 	required : true
				// },
				s_Bookingcontact : {
					required : true
				},
				s_Bookingemail : {
					email : true
				},
				s_Accountcontact : {
					required : true
				},
				s_Accountemail : {
					email : true
				}
				// s_salseContact : {
				// 	required : true
				// },
				// s_salseEmail : {
				// 	email : true
				// }	
			},

			// Messages for form validation
			messages : {
				s_Destination : {
					required : 'Please enter your Destination'
				},
				s_Name : {
					required : 'Please enter your Supplier Name'
				},
				s_Detail : {
					required : 'Please enter your Detail'
				},
				s_MaximumCredit	: {
					required : 'Please enter your Maximum Credit'
				},	
				// s_DepositAmount	: {
				// 	required : 'Please enter your Deposit Amount'
				// },
				s_Bookingcontact : {
					required : 'Please enter your Resevation Name'
				},
				s_Bookingemail : {
					email : 'Email format incorrect'
				},
				s_Accountcontact : {
					required : 'Please enter your Account Name'
				},
				s_Accountemail : {
					email : 'Email format incorrect'
				}
				// s_salseContact : {
				// 	required : 'Please enter your Sale Name'
				// },
				// s_salseEmail : {
				// 	email : 'Email format incorrect'
				// }
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
		otable.fnFilter(types, 3, true, false, false, false);
	}

	function resetModal(){
		$( "#supplier-form" ).find( ".state-error" ).removeClass( "state-error" );
		$( "#supplier-form" ).find( ".state-success" ).removeClass( "state-success" );
		$( "#supplier-form" ).find( ".required" ).css("border-left", "7px solid #FF3333");
		$( "em" ).remove();
	}
	
	
</script>																																					