<?php
	require_once 'class/database.class.php';
	if(!isset($_SESSION['user']))
		header('Location:login.php');
?>

<!DOCTYPE html>
<html lang="en">
	
	<head>
		<?php require_once 'refference/head.php'; ?>
	</head>
	
	<body>
		<div class="container">
			<div class="row">
				<div class="col-xs-12 col-md-12">
					<?php require_once 'refference/navbar.php';?>
				</div>
			</div>
			<div class="row">
				<div class="col-md-9" id="main">
						<?php 
							require_once 'include/home.php'; 
							// require_once 'include/exam_result_print.php.php?id=38'; 
						?>
				</div>
				<div class="col-md-3  col-md-offset-0">
					<?php require_once 'refference/sidebar.php';?>
				</div>
			</div>
			<div class="row no-print">
				<div class="col-md-12">
					<div class="well well-sm" style="margin:10px 0 0 0"> Presented By <a href="http://erp14.com">ERP14</a>
						<p id="theTimer">00:00:00</p>
					</div>
				</div>
			</div>
		</div>
		<script src="js/bootstrap.min.js"></script>



		<iframe name="print_frame" width="0" height="0" frameborder="0" id="print_frame" src="about:blank"></iframe>
		<script src="js/dshScript.js" ></script>

	</body>

</html>
