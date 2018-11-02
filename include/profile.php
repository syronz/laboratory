<?php
	require_once '../class/database.class.php';
	if(!isset($_SESSION['user']))
		$db->go_to_login();
	//sleep(2);
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset='utf-8'>
		<!--<link href="css/bootstrap.css" rel="stylesheet">
		<link href="css/bootstrap-theme.css" rel="stylesheet">

		<link href="themes/redmond/jquery-ui-1.8.16.custom.css" rel="stylesheet" type="text/css" />
		<link href="deleted/scripts/jtable/themes/lightcolor/blue/jtable.css" rel="stylesheet" type="text/css" />
		<script src="deleted/scripts/jquery-1.9.1.js" type="text/javascript"></script>
		<script src="deleted/scripts/bootstrap.js" type="text/javascript"></script>
		<script src="deleted/scripts/jquery-ui-1.10.3.custom.js" type="text/javascript"></script>
	    <script src="deleted/Scripts/jtable/jquery.jtable.js" type="text/javascript"></script>
	    <script src="deleted/scripts/jtable/localization/jquery.jtable.ku.js" type="text/javascript"></script>
	    <link href="css/dsh_style.css" rel="stylesheet">-->
	</head>
	<body>
		<div id="testShow">
		</div>
		<div id="jtableDiv" style="width: 900px; margin:10px auto;"></div>
		<script type="text/javascript">
			$(document).ready(function () {

				$('#jtableDiv').jtable({
					//messages: kurdishDic,
					title: '<?php dic_show('Departments'); ?>',
					paging: true,
					pageSize: 10,
					sorting: true,
					defaultSorting: 'id DESC',
					actions: {
						listAction: 'control/department.control.php?action=list',
						createAction: 'control/department.control.php?action=create',
						updateAction: 'control/department.control.php?action=update',
						deleteAction: 'control/department.control.php?action=delete'
					},
					fields: {
						id: {
							key: true,
							create: false,
							edit: false,
							title: '<?php dic_show('id'); ?>',
							width: '10%'
						},
						name: {
							title: '<?php dic_show('Department'); ?>',
							width: '30%'
						},
						detail: {
							title: '<?php dic_show('Detail'); ?>',
							type: 'textarea',
							width: '60%'
						}
					}
				});

				//Load person list from server
				$('#jtableDiv').jtable('load');

			});

		</script>
	</body>
</html>