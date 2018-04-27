<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html  xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>test</title>
	<script src="https://code.jquery.com/jquery-1.12.3.min.js"></script>
	<script src="https://unpkg.com/jspdf@latest/dist/jspdf.min.js"></script>	
</head>
<body>
    <div id="head" style="background-color: red">
      <p><font size="3" color="red">HEAD PDF</font></p>
    </div>
    <div id="cmd">
      <p><font size="3" color="red">print this to pdf</font></p>
    </div>
    <div id="head" style="background-color: #333">
      <p><font size="3" color="red">FOOTER PDF</font></p>
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