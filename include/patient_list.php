<?php
	require_once '../class/database.class.php';
	if(!isset($_SESSION['user']))
		$db->go_to_login();
?>
	<div id="jtableDiv" style="width:846px;"></div>
	<script type="text/javascript">
		$(document).ready(function () {
			$('#jtableDiv').jtable({
				title: '<?php dic_show('patient'); ?>',
				paging: true,
				pageSize: 10,
				sorting: true,
				defaultSorting: 'id DESC',
				actions: {
					listAction: 'control/patient.control.php?action=list',
					createAction: 'control/patient.control.php?action=create',
					updateAction: 'control/patient.control.php?action=update',
					deleteAction: 'control/patient.control.php?action=delete'
				},
				fields: {
					id: {
						key: true,
						create: false,
						edit: false,
						title: '<?php dic_show('id'); ?>',
						width: '5%'
					},	
					
					name: {
						title: '<?php dic_show('name'); ?>'
					},		
					
					dob: {
						title: '<?php dic_show('dob'); ?>',
						type:'date'
					},
					gender: {
						title: '<?php dic_show('gender'); ?>',
						options : {male:'male',female:'female'}
					},		
					phone: {
						title: '<?php dic_show('phone'); ?>'
					},			
					detail: {
						title: '<?php dic_show('detail'); ?>'
					},			
					date:{
						title: '<?php dic_show('date'); ?>',
						// type: 'date',
						create: false,
						edit: false,
						list:false
					},
					

				}
			});
			$('#jtableDiv').jtable('load');
		});
	</script>

