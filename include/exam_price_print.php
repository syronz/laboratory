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
	$count = 0;
	foreach ($examInfo as $key => $value) {
		if(!is_array(@$arrByProfile[$value['id_profile']]))
			$arrByProfile[$value['id_profile']] = array();
		array_push($arrByProfile[$value['id_profile']], $value);
		//$count += count($arrByProfile[$value['id_profile']]);
	}
	 //dsh($arrByProfile);
	

foreach ($arrByProfile as $key => $value) {
	foreach ($value as $key2 => $value2) {
		$count++;
			}
		}

//dsh($count);
$size = 8 / $count;
if($size > 1)
	$size = 1;
?>
<style>

</style>
<div style="width:7.5cm; font-size:1em;">
<img src="images/logo3.png" alt="Soma Laboratory" style="float:right; width:110px; opacity:0;">
<h4> Laboratory Price</h4>
<div style="float:left; font-size:smaller;">
Exam ID # : <?php echo $examHeaderInfo['id']; ?> <br>
Date : <?php echo Date('Y-m-d',time()); ?>  <br>
Name : <?php echo $patientInfo['name'];?>  <br>
PID #: <?php echo $patientInfo['id'];?>
</div>
<!--<div class="clear" style="clear:both;"></div>-->

<div class="clear" style="clear:both;"></div>
<hr>
<div style="font-size:<?php echo 1; ?>em;">
	<?php
echo '<table class="tblResult"><tr><td style="font-weight:bold;">Test Name</td><th style="width:10%;">Price</th></tr>';
		foreach ($arrByProfile as $key => $value) {

			//echo "<h5>{$value[0]['profile_name']}</h5>";
			
			foreach ($value as $key2 => $value2) {
				$normalInfo = normal_range::returnNormal($value2['id_test'],$examHeaderInfo['age'],$patientInfo['gender']);
				echo "<tr>";
				echo "<td style='font-size:".$size."em'>{$value2['test_name']}</td>";
				echo "<td style='font-size:".$size."em'>{$value2['price']}</td>";
				echo '</tr>';
			}
			
			

			
		}
echo '</table>';
		echo "<hr style='margin:0;'><table  class='tblResult'><tr><td>Total Price</td><td style='width:10%;'>".dsh_money(round($examHeaderInfo['total_price']))."</td></tr>";
		if($examHeaderInfo['discount']){
			echo "<tr><td>Discount</td><td>".dsh_money($examHeaderInfo['discount'])."</td></tr>";
			$remained = $examHeaderInfo['total_price'] - $examHeaderInfo['discount'];
			echo "<tr><td>Discount</td><td>$remained</td></tr>";
		}
		echo '</table>';

	?>

</div>
<hr>
<!--
<div style="font-size:9px;text-align:center; margin:0 3px;">
<p>ناونیشان: سلێمانی - نزیک کباب قادر - سەروو نەخۆشخانەی سۆما - پشت تەلاری نمای پزشکی - نهۆمی زەمینی پۆلیکلینیکی پسپۆریی هاوکاری نیشتمان</p>
<p>07701943869 - 07501943869</p>
</div>
-->
</div>
<?php
// dsh($_GET);

?>
