<?php
	require_once '../class/database.class.php';
	if(!isset($_SESSION['user']))
		$db->go_to_login();
	//sleep(2);
?>
		<div id="testShow">
		</div>
		<div id="jtableDiv" style="width: 900px; margin:10px auto;"></div>
		<script type="text/javascript">
			$(document).ready(function () {

				$('#jtableDiv').jtable({
					//messages: kurdishDic,
					title: '<?php dic_show('Locations'); ?>',
					paging: true,
					pageSize: 10,
					sorting: true,
					defaultSorting: 'id DESC',
					actions: {
						listAction: 'control/location.control.php?action=list',
						createAction: 'control/location.control.php?action=create',
						updateAction: 'control/location.control.php?action=update',
						deleteAction: 'control/location.control.php?action=delete'
					},
					fields: {
						id: {
							key: true,
							create: false,
							edit: false,
							title: '<?php dic_show('id'); ?>',
							width: '5%'
						},
						id_department: {
							title: '<?php dic_show('departrment'); ?>',
							width: '15%',
							//options: 'control/test.php'
							options: 'control/department.control.php?action=json_list&part=location'
						},
						name: {
							title: '<?php dic_show('Location'); ?>',
							width: '15%'
						},
						id_user: {
							title: '<?php dic_show('id_manager'); ?>',
							width: '5%'
						},
						code: {
							title: '<?php dic_show('code'); ?>',
							width: '10%'
						},
						type: {
							title: '<?php dic_show('type'); ?>',
							width: '10%',
							options:{'branch':'<?php dic_show('Branch'); ?>','store':'<?php dic_show('Store'); ?>'}
						},
						phone: {
							title: '<?php dic_show('phone'); ?>',
							width: '10%'
						},
						address: {
							title: '<?php dic_show('address'); ?>',
							type: 'textarea',
							width: '15%'
						},
						detail: {
							title: '<?php dic_show('Detail'); ?>',
							type: 'textarea',
							width: '15%'
						}
					}
				});

				//Load person list from server
				$('#jtableDiv').jtable('load');
			});

		</script>