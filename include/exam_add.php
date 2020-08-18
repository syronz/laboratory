<?php
	require_once '../class/profile.class.php';
	require_once '../class/patient.class.php';
	$option_profiles = profile::profile_as_options();
	$allTest = profile::allTest();
	// dsh(profile::allTest());

	$colors = ['#F0F8FF','#FAEBD7','#00FFFF','#7FFFD4','#F0FFFF','#F5F5DC','#FFE4C4','#DEB887','#5F9EA0','#7FFF00','#D2691E','#FF7F50','#6495ED','#FFF8DC','#00FFFF','#008B8B','#B8860B','#A9A9A9','#A9A9A9','#BDB76B','#556B2F','#FF8C00','#9932CC','#E9967A','#8FBC8F','#00CED1','#9400D3','#FF1493','#00BFFF','#1E90FF','#FFFAF0','#228B22','#FF00FF','#DCDCDC','#F8F8FF','#FFD700','#DAA520','#808080','#808080','#ADFF2F','#F0FFF0','#FF69B4','#CD5C5C','#FFFFF0','#F0E68C','#E6E6FA','#FFF0F5','#7CFC00','#FFFACD','#ADD8E6','#F08080','#E0FFFF','#FAFAD2','#D3D3D3','#D3D3D3','#90EE90','#FFB6C1','#FFA07A','#20B2AA','#87CEFA','#778899','#778899','#B0C4DE','#FFFFE0','#00FF00','#32CD32','#FAF0E6','#FF00FF','#800000','#66CDAA','#0000CD','#BA55D3','#9370DB','#3CB371','#7B68EE','#00FA9A','#48D1CC','#C71585','#191970','#F5FFFA','#FFE4E1','#FFE4B5','#FFDEAD','#000080','#FDF5E6','#808000','#6B8E23','#FFA500','#FF4500','#DA70D6','#EEE8AA','#98FB98','#AFEEEE','#DB7093','#FFEFD5','#FFDAB9','#CD853F','#FFC0CB','#DDA0DD','#B0E0E6','#800080','#663399','#FF0000','#BC8F8F','#4169E1','#8B4513','#FA8072','#F4A460','#2E8B57','#FFF5EE','#A0522D','#C0C0C0','#87CEEB','#6A5ACD','#708090','#708090','#FFFAFA','#00FF7F','#4682B4','#D2B48C','#008080','#D8BFD8','#FF6347','#40E0D0','#EE82EE','#F5DEB3','#FFFFFF','#F5F5F5','#FFFF00','#9ACD32'];

?>
<style>
	.floater{
		float: left;
		padding: 10px;
		border:1px solid gray;
		border-radius: 5px;
		/*background-color: yellow;*/
		margin: 5px;
		text-align: center;
	}
</style>
<div class="panel panel-success">
	<div class="panel-heading"><a href="#examList">Exam List</a> > [Add New Exam]</div>
	<div class="panel-body">
		<form class="form-horizontal">		
<fieldset>
<!-- Form Name -->
<legend>New Patient</legend>
<!-- Prepended text-->
<div class="form-group">
  <label class="col-md-3 control-label" for="patientName"></label>
  <div class="col-md-7">
    <div class="input-group">
      <span class="input-group-addon">Name</span>
      <input id="patientName" name="patientName" class="form-control" placeholder="Patient Name" type="text" required="">
    </div>
    <div id="suggestedPatient"></div>
    <br/>
    <div class="input-group">
      <span class="input-group-addon">Mobile</span>
      <input id="patientPhone" name="patientPhone" class="form-control" placeholder="Patient Phone" type="text" required="">
    </div>
  </div>
</div>

<!-- Prepended text-->
<div class="form-group">
  <label class="col-md-3 control-label" for="dob"></label>
  <div class="col-md-3">
    <div class="input-group">
      <span class="input-group-addon">DOB</span>
      <input id="dob" name="dob" class="form-control" placeholder="Date Of Birth" type="date">
    </div>
  </div>
  <div class="col-md-1"></div>
  <div class="col-md-3">
    <div class="input-group">
      <span class="input-group-addon">Age [year]</span>
      <input id="age" name="age" class="form-control" placeholder="Patient Age" type="text">
    </div>
  </div>
</div>

<!-- Select Basic -->
<div class="form-group">
  <label class="col-md-3 control-label" for="gender">Gender</label>
  <div class="col-md-7">
    <select id="gender" name="gender" class="form-control">
      <option value="Male">Male</option>
      <option value="Female">Female</option>
    </select>
  </div>
</div>

<!-- Textarea -->
<div class="form-group">
  <label class="col-md-3 control-label" for="patientDetail">Detail</label>
  <div class="col-md-7">                     
    <textarea class="form-control" id="patientDetail" name="patientDetail"></textarea>
  </div>
</div>

</fieldset>



<fieldset>

<!-- Form Name -->
<legend>Registered Patient</legend>

<!-- Prepended text-->
<div class="form-group">
  <label class="col-md-3 control-label" for="patientId">
<span class="label label-success result_label" id="patientIdSuccess">Success</span>
<span class="label label-warning result_label" id="patientIdWarning">This ID not exist!</span>
  </label>
  <div class="col-md-6">
    <div class="input-group">
      <span class="input-group-addon">ID</span>
      <input id="patientId" name="patientId" class="form-control" placeholder="Patient ID #" type="text">
    </div>
    <p class="help-block">Please Enter Patient ID</p>
  </div>
</div>

<!-- Select Basic -->
<div class="form-group">
  <label class="col-md-3 control-label" for="patientRegisteredName">Patient Name</label>
  <div class="col-md-6">
    <select id="patientRegisteredName" name="patientRegisteredName" class="form-control">
    	<?php echo patient::patient_as_options();?>
    </select>
  </div>
</div>

</fieldset>



<fieldset>

<!-- Form Name -->
<legend>Exam Info</legend>

<!-- Prepended text-->


<div class="form-group">
  <label class="col-md-3 control-label" for="recieved"></label>
<div class="col-md-4">
    <div class="input-group">
      <span class="input-group-addon">Recieved</span>
      <input id="recieved" name="recieved" class="form-control" type="date" value="<?php echo date('Y-m-d',time()); ?>">
    </div>
  </div> 
</div>



<!-- Select Basic -->
<div class="form-group">
  <label class="col-md-3 control-label" for="doctorName">Doctor</label>
  <!--<div class="col-md-3">
    <select id="doctor" name="doctor" class="form-control">
      <option value="man">Man</option>
      <option value="woman">Woman</option>
    </select>
  </div>
   <div class="col-md-1"></div> -->
  <div class="col-md-4">
    <div class="input-group">
      <span class="input-group-addon">Doctor</span>
      <input id="doctorName" name="doctorName" class="form-control" placeholder="Type For New Doctor" type="text" required="">
    </div>
  </div>
</div>

<!-- Textarea -->
<div class="form-group">
  <label class="col-md-3 control-label" for="examDetail">Exam Detail</label>
  <div class="col-md-7">                     
    <textarea class="form-control" id="examDetail" name="examDetail"></textarea>
  </div>
</div>

</fieldset>


<fieldset>
<legend>Test's</legend>

<div class="col-md-12">
	<?php
		$j=0;
		foreach ($allTest as $value) {
			
			if($value['tests'])
				echo "<div class='col-md-12'><h3>{$value['name']}</h3></div>";
			
			foreach ($value['tests'] as $k => $v) {
				echo "<label class='floater' for='{$v['id']}' style='background-color:{$colors[$j]}'>{$v['name']}<br><input type='checkbox' id='{$v['id']}' name='{$v['id']}' class='checkTest'> <span class='testPrice'>".dsh_money($v['price'])."</span></label>";

			}
			$j++;
		}

	?>
</div>


<!-- <div class="profileAndTest">
	<div class="form-group">
	  <label class="col-md-3 control-label" for="profile">Profile</label>
	  <div class="col-md-4">
	    <select id="profile1" name="profile" class="form-control profile_select">
	      <?php echo profile::profile_as_options();?>
	    </select>
	  </div>
	</div>
	<div class="testsForProfile"></div>
</div>

<button type="button" class="btn btn-default btn-sm right" id="removeLastProfile">
  <span class="glyphicon glyphicon-minus"></span> Remove Profile
</button>
<button type="button" class="btn btn-default btn-sm right" id="addNewProfile">
  <span class="glyphicon glyphicon-plus"></span> Add New Profile
</button> -->


</fieldset>



<fieldset>
<legend>Payment's</legend>

	<div class="form-group">
	  <label class="col-md-3 control-label" for="totalPrice"></label>
	  <div class="col-md-7">
	    <div class="input-group">
	      <span class="input-group-addon">Total Price</span>
	      <input id="totalPrice" name="totalPrice" class="form-control" placeholder="IQD" type="text" disabled>
	    </div>
	  </div>
	</div>

	<div class="form-group">
	  <label class="col-md-3 control-label" for="discount"></label>
	  <div class="col-md-7">
	    <div class="input-group">
	      <span class="input-group-addon">Discount</span>
	      <input id="discount" name="discount" class="form-control" placeholder="IQD" type="text" value="0">
	    </div>
	  </div>
	</div>

	<div class="form-group">
	  <label class="col-md-3 control-label" for="payin"></label>
	  <div class="col-md-7">
	    <div class="input-group">
	      <span class="input-group-addon">Pay In</span>
	      <input id="payin" name="payin" class="form-control" placeholder="IQD" type="text" disabled>
	    </div>
	  </div>
	</div>



</fieldset>
<button type="button" class="btn btn-primary right" id="examAddSubmit">Submit</button>


<script>


</script>



</form>

	</div>
	
	
</div>
