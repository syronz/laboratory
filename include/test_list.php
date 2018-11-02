<?php
	require_once '../class/database.class.php';
	if(!isset($_SESSION['user']))
		$db->go_to_login();
?>
	<div id="testShow">
	</div>
	<div id="jtableDiv" style="width:846px;"></div>
	<script type="text/javascript">
		$(document).ready(function () {

			$('#jtableDiv').jtable({
				title: '<?php dic_show("Test\'s"); ?>',
				paging: true,
				pageSize: 10,
				sorting: true,
				defaultSorting: 'id DESC',
				actions: {
					listAction: 'control/test.control.php?action=list',
					createAction: 'control/test.control.php?action=create',
					updateAction: 'control/test.control.php?action=update',
					deleteAction: 'control/test.control.php?action=delete'
				},
				fields: {
					test_detail:{
						title: '<?php dic_show(""); ?>',
	                    width: '2%',
	                    sorting: false,
	                    edit: false,
	                    create: false,
	                    display: function (std) {
                        //Create an image that will be used to open child table
                        var $img = $('<img src="images/small/list_metro.png" title="<?php dic_show('Show Normals') ?>" />');
                        //Open child table when user clicks the image
                        $img.click(function () {
                            $('#jtableDiv').jtable('openChildTable',
                                    $img.closest('tr'),
                                    {
                                        title: '<?php dic_show('test: '); ?>' + std.record.name + ' - <?php dic_show("Normals") ?>',
                                        actions: {
											listAction: 'control/normal_range.control.php?action=detail_list&id_test='+std.record.id,
											createAction: 'control/normal_range.control.php?action=create_detail&id_test='+std.record.id,
											updateAction: 'control/normal_range.control.php?action=update',
											deleteAction: 'control/normal_range.control.php?action=delete'
										},
										fields: {
											// id: {
											// 	key: true,
											// 	create: false,
											// 	edit: false,
											// 	title: '<?php dic_show('id'); ?>',
											// 	width: '5%'
											// },					
											// id_test : {
											// 	title: '<?php dic_show('id_test'); ?>',
											// 	dependsOn: 'id_company',
											// 		options: function(data){
											// 			if (data.source == 'list') {
						     //                        		return 'control/test.control.php?action=json_list&part=stuff&id_company=0';
						     //                    		}
						     //                    		return 'control/test.control.php?action=json_list&part=stuff&id_company=' + data.dependedValues.id_company;
											// 		}
												
											// },
					id: {
						key: true,
						create: false,
						edit: false,
						title: '<?php dic_show('id'); ?>',
						width: '5%'
					},	
					id_test: {
						title: '<?php dic_show('test'); ?>',
						options: 'control/test.control.php?action=json_list&part=normal_range',
						create: false,
						edit: false,
						list:false
					},			
					min_age: {
						title: '<?php dic_show('min_age'); ?>'
					},
					max_age: {
						title: '<?php dic_show('max_age'); ?>'
					},
					gender: {
						title: '<?php dic_show('Gender'); ?>',
						options:{male:'male',female:'female',both:'both'}
					},
					date: {
						title: '<?php dic_show('Date_Created'); ?>',
						edit: false,
						create: false,
						list:false
					},
					detail: {
						title: '<?php dic_show('Detail'); ?>'
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
                                    }, function (data) { //opened handler
                                        data.childTable.jtable('load');
                                });
                        });
                        //Return image to show on the person row
                        return $img;
                    	}
					},
					id: {
						key: true,
						create: false,
						edit: false,
						title: '<?php dic_show('id'); ?>',
						width: '5%'
					},	
					id_profile: {
						title: '<?php dic_show('profile'); ?>',
						options: 'control/profile.control.php?action=json_list&part=test'
					},			
					name: {
						title: '<?php dic_show('Name'); ?>'
					},
					type: {
						title: '<?php dic_show('Type'); ?>'
					},
					result_type: {
						title: '<?php dic_show('Unit'); ?>'
					},
					price: {
						title: '<?php dic_show('price'); ?>'
					},
					date: {
						title: '<?php dic_show('Date_created'); ?>',
						edit: false,
						create: false,
						list:false
					},
					default_normal: {
						title: '<?php dic_show('Normal_Ranges'); ?>',
type:'textarea'
					},
					detail: {
						title: '<?php dic_show('Detail'); ?>'
					}
				}
			});
			$('#jtableDiv').jtable('load');
		});

	</script>
