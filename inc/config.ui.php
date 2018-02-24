<?php

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
			"Booking List" => array(
				"title" => "Booking List",
				"url" => APP_URL
			),
			"Confirm Booking" => array(
				"title" => "Confirm Booking",
				"url" => APP_URL."/dashboard-social.php"
			)
		)
	),
	"Finance" => array(
		"title" => "Finance",
		"icon" => "fa-bar-chart",
		"sub" => array(
			"Invoice" => array(
				"title" => "Invoice",
				"url" => APP_URL
			),
			"Agent: Payment Approve" => array(
				"title" => "Agent: Payment Approve",
				"url" => APP_URL."/dashboard-social.php"
			)
			,
			"Supplier: Paid Status" => array(
				"title" => "Supplier: Paid Status",
				"url" => APP_URL."/dashboard-social.php"
			)
		)
	),
	"Setup" => array(
		"title" => "Setup",
		"icon" => "fa-cog",
		"sub" => array(
			"Product Setup" => array(
				"title" => "Product Setup",
				"url" => APP_URL."/product-setup.php"
			),
			"Agent Management" => array(
				"title" => "Agent Management",
				"url" => APP_URL."/agent-management.php"
			),
			"Supplier Management" => array(
				"title" => "Supplier Management",
				"url" => APP_URL."/supplier-management.php"
			),
			"User Management" => array(
				"title" => "User Management",
				"url" => APP_URL."/user-management.php"
			),
			"Audit Log" => array(
				"title" => "Audit Log",
				"url" => APP_URL."/jqgrid.php"
			)
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