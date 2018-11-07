<?php
	require_once '../class/profile.class.php';
	require_once '../class/patient.class.php';
	require_once '../class/test.class.php';
	require_once '../class/exam.class.php';
	require_once '../class/normal_range.class.php';
	// $option_profiles = profile::profile_as_options();
	// dsh($_GET);
	$idExam = $_GET['id'];
	$examHeaderInfo = exam::get_exam_info($idExam);
	$patientInfo = patient::get_patient_info($examHeaderInfo['id_patient']);
	 //dsh($examHeaderInfo);
	// dsh($patientInfo);
	$examInfo = test::examListPrint($idExam);
	$arrByProfile = array();
	foreach ($examInfo as $key => $value) {
		if(!is_array(@$arrByProfile[$value['id_profile']]))
			$arrByProfile[$value['id_profile']] = array();
		array_push($arrByProfile[$value['id_profile']], $value);
	}
	// dsh($arrByProfile);
	//dsh($examInfo);


?>
<style>
.tblName,.tblResult{
	width: 100%;
}
.tblName td{
	/*width: 12.5%;*/
	font-family: arial;
	font-size: 11px;
}
h5{
	text-align: center;
	font-weight: bold;
	margin: 30px 0 5px 0;
}
h4{
	margin-bottom: 20px;
	text-align: center;
}
.tblResult th{
	/*font-weight: normal;*/
	font-size: smaller;
	border-bottom: 1px solid #428BCA;
	text-align: left;
}
.tblResult th,.tblResult td{
	padding: 3px;
}
.footPage{
	font-size: smaller;
}
</style>
<img src="images/baner.jpg" style="width:100%; opacity:0;">
<!--<img src="images/logo3.png" alt="Soma Laboratory" style="float:left;">
<div style="float:right; font-size:smaller;">
Exam ID # : <?php echo $examHeaderInfo['id']; ?> <br>
Date : <?php echo Date('Y-m-d',time()); ?> 
</div>-->
<div class="clear" style="clear:both;"></div>
<h4> Laboratory Result # <?php echo $examHeaderInfo['id']; ?></h4>

<table class="tblName" border="0">
	<tr>
		<td style="vertical-align:top;width:10%">Name :</td>
		<td style="vertical-align:top;width:25%"><?php echo $patientInfo['name'];?></td>
		
		<td style="vertical-align:top;width:10%">Age :</td>
		<td style="vertical-align:top;width:25%"><?php echo $examHeaderInfo['age']; echo ' ['.$patientInfo['dob'].']';?></td>
		
		<td style="vertical-align:top;width:10%">Doctor : </td>
		<td style="vertical-align:top;width:25%"><?php echo $examHeaderInfo['doctor']; ?></td>

	</tr>
	<tr>
		<td>Patient ID #:</td>
		<td><?php echo $patientInfo['id'];?></td>
		
		<td>Gender :</td>
		<td><?php echo $patientInfo['gender'];?></td>
		
		<td>Recieved :</td>
		<td><?php echo substr($examHeaderInfo['date_recieved'],0,15); ?></td>

	</tr>
	<!--<tr>
		<td>Patient ID #:</td>
		<td><?php echo $patientInfo['id'];?></td>
		<td></td>
		<td>Gender :</td>
		<td><?php echo $patientInfo['gender'];?></td>
		<td></td>
		<td>Recieved :</td>
		<td><?php echo $examHeaderInfo['date_recieved']; ?></td>
	</tr>-->
</table>

<hr>
<div style="min-height:630px">
	<!-- <h5>T3 (Total)</h5>
	<table class="tblResult">
		<tr>
			<th>Test Name</th>
			<th>Result</th>
			<th>Unit</th>
			<th>Flag</th>
			<th>Normal Range</th>
		</tr>
		<tr>
			<td>T123</td>
			<td>12.5</td>
			<td>umol/L</td>
			<td>H</td>
			<td>12.3 - 26.87</td>
		</tr>
	</table> -->

	<?php
		foreach ($arrByProfile as $key => $value) {

			echo "<h5>{$value[0]['profile_name']}</h5>";
			echo '<table class="tblResult"><tr><th style="width:40%;">Test Name</th><th style="width:10%; text-align:center;">Result</th><th style="width:10%;text-align:center;">Unit</th><th style="width:10%;text-align:center;">Flag</th><th style="width:30%;text-align:center;">Normal Range</th></tr>';
			foreach ($value as $key2 => $value2) {
				

				$normalInfo = normal_range::returnNormal($value2['id_test'],$examHeaderInfo['age'],$patientInfo['gender']);

				if($normalInfo)
					$normalText = $normalInfo['min'].' - '.$normalInfo['max'];
				else
					$normalText = $value2['default_normal'];

				$style = '';
				if($value2['checker'])
					$flag = $value2['checker'];
				else{
					if($value2['result'] < $normalInfo['min'])
						$flag = 'L';
					else if($value2['result'] > $normalInfo['max'])
						$flag = 'H';
					else
						$flag = '-';
				}
				if($flag == 'L')
					$style = 'style="color:orange;"';
				else if($flag == 'H')
					$style = 'style="color:red;"';


				echo "<tr $style>";
				echo "<td>{$value2['test_name']}</td>";
				echo "<td style='text-align:center;'>{$value2['result']}</td>";
				echo "<td style='text-align:center;'>{$value2['result_type']}</td>";
				echo "<td style='text-align:center;'>$flag</td>";
				echo "<td style='text-align:center;'>$normalText</td>";
				echo '</tr>';
			}
			echo '</table>';
		}

if(@$examHeaderInfo['detail']){
	echo '<br><p style="color:gray">Comment : ';
	echo $examHeaderInfo['detail'];
	echo '</p>';
}

	?>



</div>
<span style="color:red;font-size:10px;">High </span>
<span style="color:orange;font-size:10px;">Low </span>
<span style="color:black;font-size:10px;">Normal</span>
<!-- <hr style="margin-top:3px"> -->
<div class="footPage" style="direction:ltr;text-align:center; font-size:10px; color:#FE0000">
<img src="images/footer.jpg" style="width:100%;  opacity:0;">
</div>
<?php
// dsh($_GET);

?>
