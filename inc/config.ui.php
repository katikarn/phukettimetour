<?php
//Get num row
$sql = "SELECT count(*) AS nrow FROM booking_detail WHERE booking_detail_status='N'";
$result = mysqli_query($conn ,$sql);
if(mysqli_num_rows($result) > 0) {
	$row = mysqli_fetch_assoc($result);
	$TicketWaiting = $row['nrow'];
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
			"Create New Booking" => array(
				"title" => "Create New Booking",
				"url" => APP_URL."/bookingList-info.php"
			),
			"Booking List" => array(
				"title" => "Booking List",
				"url" => APP_URL."/bookingList.php"
			)
		)
	),
	"Tour Operation" => array(
		"title" => "Tour Operation",
		"icon" => "fa-ra",
		"sub" => array(
			"Ticket Waiting" => array(
				"title" => "Ticket Waiting ($TicketWaiting)",
				"url" => APP_URL."/bookingList-confirm.php"
			),
			"Daily Transport" => array(
				"title" => "Daily Transport",
				"url" => APP_URL."#"
			),
			"Re-confirm Ticket" => array(
				"title" => "Re-confirm Ticket",
				"url" => APP_URL."#"
			),
			"Report" => array(
				"title" => "Report",
				"sub" => array(
					"Supplier Setup" => array(
						"title" => "Itinerary Report",
						"url" => APP_URL."#"						
					),
					"Product Setup" => array(
						"title" => "Pickup Card",
						"url" => APP_URL."#"
					)
				)
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
						"Supplier Setup" => array(
						"title" => "Submit Invoice",
						"url" => APP_URL."#"						
					),
					"Payment Approve" => array(
						"title" => "Payment Approve",
						"url" => APP_URL."#"
					),
					"Invoice Over Due" => array(
						"title" => "Invoice Over Due (99)",
						"url" => APP_URL."#"
					),
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