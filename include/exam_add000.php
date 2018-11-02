<?php
	require_once '../class/profile.class.php';
	require_once '../class/patient.class.php';
	$option_profiles = profile::profile_as_options();
	dsh(profile::allTest());


?>
<div class="panel panel-primary">
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
      <option value="male">Male</option>
      <option value="female">Female</option>
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
<div class="profileAndTest">
	<div class="form-group">
	  <label class="col-md-3 control-label" for="profile">Profile</label>
	  <div class="col-md-4">
	    <select id="profile1" name="profile" class="form-control profile_select">
	      <!-- <option value="man">Man</option>
	      <option value="woman">Woman</option> -->
	      <?php echo profile::profile_as_options();?>
	    </select>
	  </div>
	</div>
	<div class="testsForProfile"></div>
</div>

<div class="profileAndTest">
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

<div class="profileAndTest">
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

<div class="profileAndTest">
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

<div class="profileAndTest">
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
</button>


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