<?php
	require_once '../class/database.class.php';
	if(!isset($_SESSION['user']))
		$db->go_to_login();
?>
	<div id="jtableDiv" style="width:846px;"></div>
	<script type="text/javascript">
		$(document).ready(function () {
			$('#jtableDiv').jtable({
				title: '<?php dic_show('Profile'); ?>',
				paging: true,
				pageSize: 10,
				sorting: true,
				defaultSorting: 'id DESC',
				actions: {
					listAction: 'control/profile.control.php?action=list',
					createAction: 'control/profile.control.php?action=create',
					updateAction: 'control/profile.control.php?action=update',
					deleteAction: 'control/profile.control.php?action=delete'
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

					// id_patient: {
					// 	title: '<?php dic_show('patient'); ?>',
					// 	options: 'control/user.control.php?action=json_list&part=profile',
					// 	create: false,
					// 	edit: false
					// },		
					
					type: {
						title: '<?php dic_show('type'); ?>'
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

