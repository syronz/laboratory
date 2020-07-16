					<div class="sidePanel no-print" id="homePanel">
						<div class="list-group">
							<a class="list-group-item list-group-item-success">
								<?php dic_show('Home');dic_show(' Options'); ?>
							</a>
							<a href="#fund>list" class="list-group-item"><?php dic_show('Fund'); ?></a>
							<a href="#patient>list" class="list-group-item"><?php dic_show('Patients'); ?></a>
							<a href="#lab>examList" class="list-group-item"><?php dic_show('Tests'); ?></a>
							<a href="#setting>profile" class="list-group-item"><?php dic_show('Settings'); ?></a>
						</div>
						<div class="thumbnail">
							<img src="images/light.png" alt="...">
							<div class="caption">
									<h3>About Program</h3>

								<p>This Program designed for limited laboratory actions.</p>
								<p>For support contact us at: <br><b> 0750 514 9171 </b> <br> Email: <b>sabina.diako@gmail.com</b> </p>
							</div>
						</div>
					</div>

					<div class="sidePanel no-print" id="fundPanel">
						<div class="list-group">
							<a class="list-group-item list-group-item-success">
								<?php dic_show('Fund');dic_show(' Options'); ?>
							</a>
							<a href="#home" class="list-group-item"><?php dic_show('Home'); ?></a>
							<a href="#fund>list" class="list-group-item"><?php dic_show('Fund List'); ?></a>
							<a href="#fund>financeDaily" class="list-group-item"><?php dic_show('Finance Daily'); ?></a>
							<a href="#fund>financeMonthly" class="list-group-item"><?php dic_show('Finance Monthly'); ?></a>
							
							<a href="#print" class="list-group-item"><?php dic_show('Print'); ?></a>
							<!-- <a href="#fund>monthReport" class="list-group-item"><?php dic_show('Fund Per Month'); ?></a> -->
						</div>
					</div>

					<div class="sidePanel no-print" id="patientPanel">
						<div class="list-group">
							<a class="list-group-item list-group-item-success">
								<?php dic_show('Patient');dic_show(' Options'); ?>
							</a>
							<!-- <a href="#patient>examAdd" class="list-group-item"><?php dic_show('Add New Exam'); ?></a> -->
							<a href="#patient>list" class="list-group-item"><?php dic_show('Patient List'); ?></a>		
							<a href="#print" class="list-group-item"><?php dic_show('Print'); ?></a>
						</div>
					</div>

					<div class="sidePanel no-print no-print" id="labPanel">
						<div class="list-group">
							<a class="list-group-item list-group-item-success">
								<?php dic_show('Test');dic_show(' Options'); ?>
							</a>
							<a href="#lab>examAdd" class="list-group-item"><?php dic_show('Add New Exam'); ?></a>
							<a href="#lab>examList" class="list-group-item"><?php dic_show('Exam List'); ?></a>
							
							<a href="#print" class="list-group-item"><?php dic_show('Print'); ?></a>
						</div>
					</div>

					<div class="sidePanel no-print" id="settingPanel">
						<div class="list-group">
							<a class="list-group-item list-group-item-success ">
								<?php dic_show('Setting');dic_show(' Options'); ?>
							</a>
							<a href="#home" class="list-group-item"><?php dic_show('Home'); ?></a>
							<a href="#setting>profileList" class="list-group-item"><?php dic_show('Manage Profile\'s'); ?></a>
							<a href="#setting>testList" class="list-group-item"><?php dic_show('Manage Test\'s'); ?></a>
							<a href="#setting>normalRanges" class="list-group-item"><?php dic_show('Manage Normal Range'); ?></a>
							<a href="#print" class="list-group-item"><?php dic_show('Print'); ?></a>
						</div>
					</div>
