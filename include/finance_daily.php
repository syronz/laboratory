<?php
	require_once '../class/database.class.php';
	if(!isset($_SESSION['user']))
		$db->go_to_login();
?>
  <div class="datePicker">
    <input type="date" id="reportDay" >
  </div>
	<div id="jtableDiv" style="width:846px;"></div>
	<script type="text/javascript">
    const today = new Date();

    let todayStr = today.toJSON().substring(0,10);
    console.log(todayStr)

    $( "#reportDay" ).change(function( event ) {
      todayStr = event.currentTarget.value;
      $('#jtableDiv').jtable('destroy');
      loadTable(todayStr);
      $('#jtableDiv').jtable('reload');
      
      console.log(event, event.currentTarget.value);
    });

    const loadTable = (selectedDay) => {

        $('#jtableDiv').jtable({
          title: '<?php dic_show('Finance Daily'); ?>',
          paging: true,
          pageSize: 10,
          sorting: true,
          defaultSorting: 'id DESC',
          actions: {
            listAction: `control/fund.control.php?date=${selectedDay}&action=finance_daily`,
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
              title: '<?php dic_show('patient'); ?>',
            },	
            date_recieved: {
              title: '<?php dic_show('date time'); ?>',
            },			
            total_price: {
              title: '<?php dic_show('cost'); ?>',
              create: false,
              edit: false
            },
            discount: {
              title: '<?php dic_show('discount'); ?>'
            },
            balance: {
              title: '<?php dic_show('balance'); ?>',
              create: false,
              edit: false
            },
          }
        });
        $('#jtableDiv').jtable('load');

    }

    loadTable(todayStr);

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

                        form_data = $('#trans_form').serializeObject();

                        var name_reciever = $('#user_select option:selected').text();
                        var money_selected = $('#dollar_destination').val() + '$ ';
                        if($('#dinar_destination').val())
                          money_selected += $('#dinar_destination').val() + 'IQD ';
                        if(confirm('Send ' + money_selected + ' To ' + name_reciever)){
                          $.post("control/fund.control.php?action=money_transfer",form_data, function( data ){
                              $('#result').html(data);
                              $('#jtableDiv').jtable('reload');

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
            if(data['Result']=='OK'){
                $.each( data['Options'], function( key, val ) {
                    items.push( "<option value='" + val['Value'] + "'>" + val['DisplayText'] + "</option>" );
                });
                $("#department_select").html($(items.join("")));
            }
            else
                alert(data['Message']);
        });

  </script>




