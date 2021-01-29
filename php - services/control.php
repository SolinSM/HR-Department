<?php

	if( isset($_POST['add']) )
		require_once 'backend/add_employee.php';
	
	else if( isset($_POST['edit']) )
		require_once 'backend/update_employee.php';
	
	else if( isset($_POST['delete']) )
		require_once 'backend/delete_employee.php';

	else if( isset($_POST['find']) )
		require_once 'backend/search_emp.php';
	
	else if( isset($_POST['select_all']) )
		require_once 'backend/select_employees.php';
	
	else if( isset($_POST['select_info']) )
		require_once 'backend/select_specific_emp.php';
	
?>