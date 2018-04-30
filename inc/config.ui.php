<?php
//Get num row
$sql = "SELECT count(*) AS nrow FROM booking_detail WHERE booking_detail_status='N'";
$result = mysqli_query($conn ,$sql);
if(mysqli_num_rows($result) > 0) {
	$row = mysqli_fetch_assoc($result);
	$TicketWaiting = $row['nrow'];
}
//Get num row
$sql = "SELECT count(*) AS nrow FROM booking WHERE booking_status='N'";
$result = mysqli_query($conn ,$sql);
if(mysqli_num_rows($result) > 0) {
	$row = mysqli_fetch_assoc($result);
	$BookingNstatus = $row['nrow'];
}
//Get num row
$sql = "SELECT count(*) AS nrow FROM booking WHERE booking_status='C'";
$result = mysqli_query($conn ,$sql);
if(mysqli_num_rows($result) > 0) {
	$row = mysqli_fetch_assoc($result);
	$BookingCstatus = $row['nrow'];
}
//CONFIGURATION for SmartAdmin UI

//ribbon breadcrumbs config
//array("Display Name" => "URL");
$breadcrumbs = array(
	"Home" => APP_URL
);

/*navigation array config

ex:
"dashboard" => array(
	"title" => "Display Title",
	"url" => "http://yoururl.com",
	"url_target" => "_self",
	"icon" => "fa-home",
	"label_htm" => "<span>Add your custom label/badge html here</span>",
	"sub" => array() //contains array of sub items with the same format as the parent
)

*/
$page_nav = array(
	"Home" => array(
		"title" => "Home",
		"url" => "index.php",
		"icon" => "fa-home"
	),
	"Booking" => array(
		"title" => "Booking",
		"icon" => "fa-book",
		"sub" => array(
			//"Create New Booking" => array(
			//	"title" => "Create New Booking",
			//	"url" => APP_URL."/bookingList-info.php"
			//),
			"Booking List" => array(
				"title" => "[1] Booking List ($BookingNstatus)",
				"url" => APP_URL."/bookingList.php"
			),
			"Wait for Confirm" => array(
				"title" => "[2] Wait for Confirm ($TicketWaiting)",
				"url" => APP_URL."/bookingList-confirm.php"
			),
			"Submit Invoice" => array(
				"title" => "[3] Submit Invoice ($BookingCstatus)",
				"url" => APP_URL."/bookingList-submit-invoice.php"						
			)
		)
	),
	"Tour Operation" => array(
		"title" => "Tour Operation",
		"icon" => "fa-ra",
		"sub" => array(
			"Daily Tour Operation" => array(
				"title" => "Daily Tour Operation",
				"url" => APP_URL."/tour_operation.php"
			),
			"Daily Transport" => array(
				"title" => "Daily Transport",
				"url" => APP_URL."/transport_operation.php"
			)
		)
	),
	"Accounting" => array(
		"title" => "Accounting",
		"icon" => "fa-bar-chart",
		"sub" => array(
			"Agent" => array(
				"title" => "Agent",
				"sub" => array(
					"Product Setup" => array(
						"title" => "Invoice List",
						"url" => APP_URL."#"
					),
					//"Payment Approve" => array(
					//	"title" => "Payment Approve",
					//	"url" => APP_URL."#"
					//),
					"Agent statement card" => array(
						"title" => "Agent statement",
						"url" => APP_URL."#"
					)
				)
			),
			"Supplier" => array(
				"title" => "Supplier",
				"sub" => array(
					"Product Setup" => array(
						"title" => "Order List",
						"url" => APP_URL."#"
					),					
						"Supplier Setup" => array(
						"title" => "Supplier statement",
						"url" => APP_URL."#"						
					),
				)
			),
			"Our Company" => array(
				"title" => "Our Company",
				"sub" => array(
					"Product Setup" => array(
						"title" => "Expenses",
						"url" => APP_URL."#"
					),					
						"Supplier Setup" => array(
						"title" => "Other Income",
						"url" => APP_URL."#"						
					),
						"Monthly report" => array(
						"title" => "Monthly report",
						"url" => APP_URL."#"						
					),
				)
			),
		)
	),
	"Setup" => array(
		"title" => "Setup",
		"icon" => "fa-cog",
		"sub" => array(
			"Agent Management" => array(
				"title" => "Agent Management",
				"url" => APP_URL."/agent-management.php"
			),
			"Supplier Management" => array(
				"title" => "Supplier Management",
				"sub" => array(
					"Supplier Setup" => array(
						"title" => "Supplier Setup",
						"url" => APP_URL."/supplier-management.php"						
					),
					"Product Setup" => array(
						"title" => "Product Setup",
						"url" => APP_URL."/product-setup.php"
					)
				)
			
			),			
			"User Management" => array(
				"title" => "User Management",
				"url" => APP_URL."/user-management.php"
			),
			//"Audit Log" => array(
			//	"title" => "Audit Log",
			//	"url" => APP_URL."/jqgrid.php"
			//)
		)
	)
);

//configuration variables
$page_title = "";
$page_css = array();
$no_main_header = false; //set true for lock.php and login.php
$page_body_prop = array(); //optional properties for <body>
$page_html_prop = array(); //optional properties for <html>
?>