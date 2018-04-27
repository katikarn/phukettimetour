<html  xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>test</title>
	<script src="https://code.jquery.com/jquery-1.12.3.min.js"></script>
	<script src="https://unpkg.com/jspdf@latest/dist/jspdf.min.js"></script>	
</head>
<body>
<div>
				
									<!-- widget edit box --><!-- end widget edit box -->
				
									<!-- widget content -->
									<div class="widget-body no-padding">
									  <div class="padding-10">
										  <br>
											<div class="pull-left">
											  <address>
												  <br>
													<strong>SmartAdmin, Inc.</strong>
													<br>
													231 Ajax Rd,
													<br>
													Detroit MI - 48212, USA
													<br>
													<abbr title="Phone">P:</abbr> (123) 456-7890
											  </address>
										</div>
											<div class="pull-right">
												<h1 class="font-400">invoice</h1>
											</div>
											<div class="clearfix"></div>
											<br>
											<br>
											<div class="row">
												<div class="col-sm-9">
													<h4 class="semi-bold">Rogers, Inc.</h4>
													<address>
														<strong>Mr. Simon Hedger</strong>
														<br>
														342 Mirlington Road,
														<br>
														Calfornia, CA 431464
														<br>
														<abbr title="Phone">P:</abbr> (467) 143-4317
													</address>
												</div>
												<div class="col-sm-3">
													<div>
														<div>
															<strong>INVOICE NO :</strong>
															<span class="pull-right"> #AA-454-4113-00 </span>
														</div>
				
													</div>
													<div>
														<div class="font-md">
															<strong>INVOICE DATE :</strong>
															<span class="pull-right"> <i class="fa fa-calendar"></i> 15/02/13 </span>
														</div>
				
													</div>
													<br>
													<div class="well well-sm  bg-color-darken txt-color-white no-border">
														<div class="fa-lg">
															Total Due :
															<span class="pull-right"> 4,972 USD** </span>
														</div>
				
													</div>
													<br>
													<br>
												</div>
											</div>
										<table class="table table-hover">
												<thead>
													<tr>
														<th class="text-center">QTY</th>
														<th>ITEM</th>
														<th>DESCRIPTION</th>
														<th>PRICE</th>
														<th>SUBTOTAL</th>
													</tr>
												</thead>
												<tbody>
													<tr>
														<td class="text-center"><strong>1</strong></td>
														<td><a href="javascript:void(0);">Print and Web Logo Design</a></td>
														<td>Perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium totam rem aperiam xplicabo.</td>
														<td>$1,300.00</td>
				
														<td>$1,300.00</td>
													</tr>
													<tr>
														<td class="text-center"><strong>1</strong></td>
														<td><a href="javascript:void(0);">SEO Management</a></td>
														<td>Sit voluptatem accusantium doloremque laudantium inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.</td>
														<td>$1,400.00</td>
														<td>$1,400.00</td>
													</tr>
													<tr>
														<td class="text-center"><strong>1</strong></td>
														<td><a href="javascript:void(0);">Backend Support and Upgrade</a></td>
														<td>Inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.</td>
														<td>$1,700.00</td>
														<td>$1,700.00</td>
													</tr>
													<tr>
														<td colspan="4">Total</td>
														<td><strong>$4,400.00</strong></td>
													</tr>
													<tr>
														<td colspan="4">HST/GST</td>
														<td><strong>13%</strong></td>
													</tr>
												</tbody>
											</table>
				
											<div class="invoice-footer">
				
												<div class="row">
				
													<div class="col-sm-7">
													  <div class="payment-methods">
														<h5>Payment Methods</h5>
														</div>
													</div>
													<div class="col-sm-5">
														<div class="invoice-sum-total pull-right">
															<h3><strong>Total: <span class="text-success">$4,972 USD</span></strong></h3>
														</div>
													</div>
				
												</div>
												
												<div class="row">
													<div class="col-sm-12">
														<p class="note">**To avoid any excess penalty charges, please make payments within 30 days of the due date. There will be a 2% interest charge per month on all late invoices.</p>
													</div>
												</div>
				
											</div>
									  </div>
				
  </div>
									<!-- end widget content -->
				
								</div>
</body>

  <script type="text/javascript">
  	$( document ).ready(function() {
  		var doc = new jsPDF();
	  	doc.setProperties({
			title: 'Title',
			subject: 'This is the subject',
			author: 'James Hall',
			keywords: 'generated, javascript, web 2.0, ajax',
			creator: 'MEEE'
		});

    	var source = window.document.getElementsByTagName("body")[0];
	  	doc.fromHTML(source, 10, 10);
	    var string = doc.output('datauristring');
		var iframe = "<iframe width='100%' height='100%' src='" + string + "'></iframe>"
		//var x = window.open();
		//x.document.open();
		document.write(iframe);
		//x.document.close();	
	});
 
  // $('#cmd').click(function () { 
  // 		var source = window.document.getElementsByTagName("body")[0];
	 //  doc.fromHTML(source, 10, 10);
	 //  //doc.save('two-by-four.pdf')
	 //  //doc.output("dataurlnewwindow");

	 //  var string = doc.output('datauristring');
		// var iframe = "<iframe width='100%' height='100%' src='" + string + "'></iframe>"
		// var x = window.open();
		// x.document.open();
		// x.document.write(iframe);
		// x.document.close();	  
  	
  // });
  
 //  	var doc = new jsPDF();          
	// var elementHandler = {
	//   '#ignorePDF': function (element, renderer) {
	//     return true;
	//   }
	// };
	// var source = window.document.getElementsByTagName("body")[0];
	// doc.fromHTML(
	//     source,
	//     15,
	//     15,
	//     {
	//       'width': 180,'elementHandlers': elementHandler
	//     });

	// doc.output("dataurlnewwindow");
  </script>
</html>