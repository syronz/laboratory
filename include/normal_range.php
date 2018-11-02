<?php
	require_once '../class/database.class.php';
	if(!isset($_SESSION['user']))
		$db->go_to_login();
?>
	<div id="jtableDiv" style="width:846px;"></div>
	<script type="text/javascript">
		$(document).ready(function () {

			$('#jtableDiv').jtable({
				title: '<?php dic_show("Normal_range\'s"); ?>',
				paging: true,
				pageSize: 10,
				sorting: true,
				defaultSorting: 'id DESC',
				actions: {
					listAction: 'control/normal_range.control.php?action=list',
					createAction: 'control/normal_range.control.php?action=create',
					updateAction: 'control/normal_range.control.php?action=update',
					deleteAction: 'control/normal_range.control.php?action=delete'
				},
				fields: {
					id: {
						key: true,
						create: false,
						edit: false,
						title: '<?php dic_show('id'); ?>',
						width: '5%'
					},	
					id_test: {
						title: '<?php dic_show('test'); ?>',
						options: 'control/test.control.php?action=json_list&part=normal_range'
					},			
					min_age: {
						title: '<?php dic_show('min_age'); ?>'
					},
					max_age: {
						title: '<?php dic_show('max_age'); ?>'
					},
					gender: {
						title: '<?php dic_show('gender'); ?>',
						options:{male:'male',female:'female',both:'both'}
					},
					date: {
						title: '<?php dic_show('date_created'); ?>',
						edit: false,
						create: false,
						list:false
					},
					detail: {
						title: '<?php dic_show('detail'); ?>'
					},
					in_print: {
						title: '<?php dic_show('in_print'); ?>',
						edit: false,
						create: false,
						list:false
					},
					min: {
						title: '<?php dic_show('min'); ?>'
					},
					max: {
						title: '<?php dic_show('max'); ?>'
					}
				}
			});
			$('#jtableDiv').jtable('load');
		});

	</script>