<?php
	require_once '../class/database.class.php';
	if(!isset($_SESSION['user']))
		$db->go_to_login();
?>
	<div id="jtableDiv" style="width:846px;"></div>
	<script type="text/javascript">
		$(document).ready(function () {
			$('#jtableDiv').jtable({
				title: '<?php dic_show('fund'); ?>',
				paging: true,
				pageSize: 10,
				sorting: true,
				defaultSorting: 'id DESC',
				actions: {
					listAction: 'control/fund.control.php?action=list',
					createAction: 'control/fund.control.php?action=create',
					updateAction: 'control/fund.control.php?action=update',
					deleteAction: 'control/fund.control.php?action=delete'
				},
				fields: {
					id: {
						key: true,
						create: false,
						edit: false,
						title: '<?php dic_show('id'); ?>',
						width: '5%'
					},	
					
					id_user: {
						title: '<?php dic_show('user'); ?>',
						options: 'control/user.control.php?action=json_list&part=fund',
						create: false,
						edit: false,
						list:false
					},

					id_patient: {
						title: '<?php dic_show('patient'); ?>',
						options: 'control/user.control.php?action=json_list&part=fund',
						create: false,
						edit: false,
						list:false
					},		
					
					dollar: {
						title: '<?php dic_show('$'); ?>',
					},	
					dinar: {
						title: '<?php dic_show('IQD'); ?>',
					},			
					date:{
						title: '<?php dic_show('date'); ?>',
						// type: 'date',
						create: false,
						edit: false
					},
					type: {
						title: '<?php dic_show('type'); ?>',
						create: false,
						edit: false
					},
					detail: {
						title: '<?php dic_show('detail'); ?>'
					},
					box_dollar: {
						title: '<?php dic_show('Box $'); ?>',
						create: false,
						edit: false
					},
					box_dinar: {
						title: '<?php dic_show('Box IQD'); ?>',
						create: false,
						edit: false
					},	
					

					// show:{
					// 	title: '>',
	    //                 width: '2%',
	    //                 sorting: false,
	    //                 edit: false,
	    //                 create: false,
	    //                 display: function (std) {
     //                    //Create an image that will be used to open child table
     //                    var $img = $('<img src="images/small/transfer_page.png" title="Edit phone numbers" />');
     //                    //Open child table when user clicks the image
     //                    $img.click(function () {
     //                        //alert('hello');
     //   //                      var element = $(this).parent().parent().find('td');
     //   //                      var id = element[0].innerHTML;
					// 		// $('#trans_category').val(category);
					// 		// $('#result').html('');

     //                        $("#money_transfer").dialog( "open" );
     //                    });
     //                    return $img;
     //                	}
					// },

				}
			});
			$('#jtableDiv').jtable('load');
		});

		var user_name = '<?php echo $_SESSION['user']['name']; ?>';

		$('#money_transfer_btn').click(function(){
            var id_user = <?php echo $_SESSION['user']['id']; ?>;
// var id_user = 1;
            // console.log(id_user);
            $("#money_transfer").dialog( "open" );

            $(':input','#money_transfer')
			  .not(':button, :submit, :reset, :hidden')
			  .val('')
			  .removeAttr('checked')
			  .removeAttr('selected');
			$('#result').html('');
			$('#user_name').val(user_name);

            $.getJSON( "control/fund.control.php?action=last_position&part=money_transfer&id_user=<?php echo $_SESSION['user']['id'];?>", function(data) {
                var items = [];
                items.push( "<option value='-1'>Department</option>" );

                // console.log(data.box_dinar);
                $('#box_dollar').val(data.box_dollar);
                $('#box_dinar').val(data.box_dinar);
            });


        });

        $( "#money_transfer" ).dialog({
            autoOpen: false,
            width: 680,
            buttons: [
                {
                    text: "Ok",
                    click: function() {
                        //$( this ).dialog( "close" );

                        // form_data = $('form').serializeObject();
                        form_data = $('#trans_form').serializeObject();

                        // console.log(form_data);
                        var name_reciever = $('#user_select option:selected').text();
                        var money_selected = $('#dollar_destination').val() + '$ ';
                        if($('#dinar_destination').val())
                        	money_selected += $('#dinar_destination').val() + 'IQD ';
                        if(confirm('Send ' + money_selected + ' To ' + name_reciever)){
                        	//form_data['id_company'] = $('#company_list').val();
	                        $.post("control/fund.control.php?action=money_transfer",form_data, function( data ){
	                            $('#result').html(data);
	                            $('#jtableDiv').jtable('reload');
	                            // $('#trans_form')[0].reset();

	                            $( this ).dialog( "close" );
	                        });
                        }
                        
                    }
                },
                {
                    text: "Cancel",
                    click: function() {
                        $('#trans_form')[0].reset();
                        $( this ).dialog( "close" );
                    }
                }
            ]
        });

        $.getJSON( "control/department.control.php?action=json_list&part=money_transfer", function( data ) {
            var items = [];
            // items.push( "<option value='-1'>Department</option>" );
            if(data['Result']=='OK'){
                $.each( data['Options'], function( key, val ) {
                    items.push( "<option value='" + val['Value'] + "'>" + val['DisplayText'] + "</option>" );
                });
                // $(items.join( "" )).appendTo("#department_select");
                $("#department_select").html($(items.join("")));
            }
            else
                alert(data['Message']);
        });

	</script>



	<div id="money_transfer" title="<?php dic_show('Money Transfer'); ?>">
		<h5><?php dic_show('Source : '); ?></h5>
		<form id="trans_form">
		
		<section>
			<label><?php dic_show('Box $ : '); ?></label>
			<input type="text" id="box_dollar" disabled>
			<!-- <input type="hidden" class="trans_id" name="trans_id"> -->
			<label><?php dic_show('Box IQD : '); ?></label>
			<input type="text" id="box_dinar" disabled>
		</section>
		<section>.</section>
		<section>
			<label><?php dic_show('User : '); ?></label>
			<input type="text" id="user_name" disabled value="<?php echo $_SESSION['user']['name']; ?>">
		</section>
		<div class="clear"></div>
		<hr>
		<h5><?php dic_show('Destination : '); ?></h5>
			<section>
				<label><?php dic_show('Department: '); ?></label>
				<select id="department_select" name="department_select">
					<option value="-1"><?php dic_show('Select'); ?></option>
				</select>
				<label><?php dic_show('Location : '); ?></label>
				<select id="location_select" name="location_select"></select>
				<label><?php dic_show('User : '); ?></label>
				<select id="user_select" name="user_select"></select>
			</section>
			<section>
				<label><?php dic_show('Dollar : '); ?></label>
				<input type="number" id="dollar_destination" name="dollar_destination">
				<label><?php dic_show('Dinar : '); ?></label>
				<input type="number" id="dinar_destination" name="dinar_destination">

				<!-- <label><?php dic_show('State : '); ?></label>
				<select id="state_destination" name="state_destination">
					<option value="1"><?php dic_show('ready to sell'); ?></option>
					<option value="0"><?php dic_show('selled'); ?></option>
					<option value="-1"><?php dic_show('repair'); ?></option>
				</select> -->
			</section>
			<section>
				<label><?php dic_show('Detail : '); ?></label>
				<input type="text" id="detail_destination" name="detail_destination">
			</section>
		</form>
		<div class="clear"></div>
		<br>
		<h5 id="result"></h5>
	</div>

