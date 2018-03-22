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
		font-weight:bold;
		margin-top: 6px;
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
													
													<td><a class="btn btn-small btn-primary"
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
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-Adduser">
    
      <!-- Modal content-->
	  
      <div class="modal-content">
	  <form action="product-setup.php" method='post' >
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="header">Product</h4>
        </div>
        <div class="modal-body">
		<div class="row" style="margin">
			<div class="sectionHead">General Info</div>
			<div class="card-block madalContent">
				<div class="col-sm-4 col-md-4 header">
				Status <font color="red"> *</font>
				</div>
				<div class="col-sm-8 col-md-8 status">
					<input type="radio" name="status" value="A" id="m_StatusA" required>
						<label style="background-color: #5dc156;" for="m_StatusA">Active</label>
					<input type="radio" name="status" value="I" id="m_StatusI">
						<label style="background-color: #6dd0ca;" for="m_StatusI">Inactive</label>
					<input type="radio" name="status" value="C" id="m_StatusC">
						<label style="background-color: #ffba42;" for="m_StatusC">Cancel</label>
				</div>
				<div class="col-sm-12 col-md-4 header">
					Name <font color="red">*</font>
				</div>
				<div class="col-sm-12 col-md-8">
					<input type="text" id="productName" name="productName" value="" required>
				</div>
				<div class="col-sm-12 col-md-4 header">
					Supplier <font color="red">*</font>
				</div>
				<div class="col-sm-12 col-md-8">
					<input type="text" id="productSupplier" name="productSupplier" value="" required>
				</div>
				<div class="col-sm-4 col-md-4 header">
					Type <font color="red">*</font>
				</div>
				<div class="col-sm-8 col-md-8">
					<input type="radio" name="Type" value="T" id="p_TypeT" required>
						<label for="Type">Ticket</label>
					<input type="radio" name="Type" value="D" id="p_TypeD">
						<label for="Type">Day Trip</label>
					<input type="radio" name="Type" value="C" id="p_TypeC" >
						<label for="Type">Car</label>
				</div>
				<div class="col-sm-12 col-md-4 header">
					Detail
				</div>
				<div class="col-sm-12 col-md-8">
					<textarea name="Detail" id="Detail" value="" cols="40" rows="5"></textarea>
				</div>
				<div class="col-xs-4 col-sm-4 col-md-4 header">
					Confirm Class <font color="red">*</font>
				</div>
				<div class="col-xs-8 col-sm-8 col-md-8">
					<input type="radio" name="ConfirmClass" value="M" id="c_TypeM" required>
						<label for="c_TypeM">Manual</label>
					<input type="radio" name="ConfirmClass" value="A" id="c_TypeA">
						<label for="c_TypeA">Auto</label>
				</div>	
			</div>
			<div class="sectionHead" >Finance</div>
			<div class="card-block madalContent">
				<div class="col-sm-12 col-md-4 header">
					Cost Price <font color="red"> *</font>
				</div>
				<div class="col-sm-12 col-md-8">
					<input type="text" id="CostPrice" name="CostPrice" value="" required>
				</div>
				<div class="col-sm-12 col-md-4 header">
					Normal Price <font color="red">*</font>
				</div>
				<div class="col-sm-12 col-md-8">
					<input type="text" id="NormalPrice" name="NormalPrice" value="" required> 
				</div>
				<div class="col-sm-12 col-md-4 header">
					Sales Price1<font color="red">*</font>
				</div>
				<div class="col-sm-12 col-md-8">
					<input type="text" id="SalesPrice1" name="SalesPrice1" value="" required> 
				</div>
				<div class="col-sm-12 col-md-4 header">
					Sales Price2<font color="red">*</font>
				</div>
				<div class="col-sm-12 col-md-8">
					<input type="text" id="SalesPrice2" name="SalesPrice2" value="" required> 
				</div>				
			</div>
			<div class="sectionHead">Tricket Info</div>
			<div class="card-block madalContent">
				<div class="col-xs-4 col-sm-4 col-md-4 header">
					Seat Type <font color="red">*</font>
				</div>
				<div class="col-xs-8 col-sm-8 col-md-8">
					<input type="radio" name="SeatType" value="O" id="s_TypeO" required>
						<label for="s_TypeO">Open</label>
					<input type="radio" name="SeatType" value="F" id="s_TypeF">
						<label for="s_TypeF">Fixed Seat</label>
				</div>
				<div class="col-xs-4 col-sm-4 col-md-4 header">
					Ticket Type <font color="red">*</font>
				</div>
				<div class="col-xs-8 col-sm-8 col-md-8">
					<div>
						<input type="radio" name="TicketType" value="Z" id="t_TypeZ" required>
						<label for="t_TypeZ">Same Price</label>
					</div>
					<div>
						<input type="radio" name="TicketType" value="A" id="t_TypeA">
						<label for="t_TypeA">Adult</label>						
					</div>
					<div>
						<input type="radio" name="TicketType" value="C" id="t_TypeC" >
						<label for="t_TypeC">Chident</label>
					</div>
					<div>
						<input type="radio" name="TicketType" value="S" id="t_TypeS">
						<label for="t_TypeS">Senier</label>
					</div>		
				</div>
				<div class="col-sm-12 col-md-4 header">
				Show Time <font color="red">*</font>
				</div>
				<div class="col-sm-12 col-md-8">
					<input type="text" id="ShowTime" name="ShowTime" value="">
				</div>
			</div>
			<div class="sectionHead">Day Trip Info</div>
			<div class="card-block madalContent">
				<div class="col-xs-4 col-sm-4 col-md-4 header">
					Free pickup <font color="red">*</font>
				</div>
				<div class="col-xs-8 col-sm-8 col-md-8">
					<input type="radio" name="Freepickup" value="Y" id="f_TypeY" required>
						<label for="f_TypeY">Yes</label>
					<input type="radio" name="Freepickup" value="N" id="f_TypeN">
						<label for="f_TypeN">No</label>
				</div>
				<div class="col-sm-12 col-md-4 header">
				Min <font color="red">*</font>
				</div>
				<div class="col-sm-12 col-md-8">
					<input type="text" id="Min" name="Min" value="">
				</div>
				<div class="col-sm-12 col-md-4 header">
				Max <font color="red">*</font>
				</div>
				<div class="col-sm-12 col-md-8">
					<input type="text" id="Max" name="Max" value="">
				</div>
				<div class="col-sm-12 col-md-4 header">
				Detail <font color="red">*</font>
				</div>
				<div class="col-sm-8 col-md-8">
					<textarea id="d_detail" name="d_detail" value="" cols="40" rows="5"></textarea>
				</div>
			</div>
			<div class="sectionHead">Car Info</div>
			<div class="card-block madalContent">
				<div class="col-sm-12 col-md-4 header">
				Car Type <font color="red">*</font>
				</div>
				<div class="col-sm-12 col-md-8">
					<input type="text" id="CarTypeText" name="CarTypeText" value="">
				</div>
				<div class="col-sm-12 col-md-4 header">
				Max Seat <font color="red">*</font>
				</div>
				<div class="col-sm-12 col-md-8">
					<input type="text" id="MaxSeat" name="MaxSeat" value="">
				</div>
			</div>
			
			<div class="col-md-12 center">
				<input type="hidden" name="productid" id="productid" />
				<button type="submit" name="submitAddProduct" id="submitAddProduct" value="" 
				class="btn btn-info mr-20" onclick="return confirm('Do you want to save the data Product')">Save</button>
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div></div>
        </div>
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

		/* // DOM Position key index //
		
		l - Length changing (dropdown)
		f - Filtering input (search)
		t - The Table! (datatable)
		i - Information (records)
		p - Pagination (paging)
		r - pRocessing 
		< and > - div elements
		<"#id" and > - div with an id
		<"class" and > - div with a class
		<"#id.class" and > - div with an id and class
		
		Also see: http://legacy.datatables.net/usage/features
		*/	
		
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
						$('#m_StatusA').prop('checked',false);
						$('#m_StatusI').prop('checked',false);
						$('#m_StatusC').prop('checked',false);
						$('#productName').val('');  
						$('#productSupplier').val(''); 
						$('#p_TypeT').prop('checked',false);
						$('#p_TypeD').prop('checked',false);
						$('#p_TypeC').prop('checked',false);
						$('#Detail').val('');   
						$('#c_TypeM').prop('checked',false);
						$('#c_TypeA').prop('checked',false);
						$('#CostPrice').val(''); 
						$('#NormalPrice').val(''); 
						$('#SalesPrice1').val(''); 
						$('#SalesPrice2').val(''); 
						$('#s_TypeO').prop('checked',false);
						$('#s_TypeF').prop('checked',false);
						$('#t_TypeZ').prop('checked',false);
						$('#t_TypeA').prop('checked',false);
						$('#t_TypeC').prop('checked',false);
						$('#t_TypeS').prop('checked',false);
						$('#ShowTime').val(''); 
						$('#f_TypeN').prop('checked',false);
						$('#f_TypeY').prop('checked',false);
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

	</script>

	<?php
	//include footer
	include ("inc/google-analytics.php");
	?>																														