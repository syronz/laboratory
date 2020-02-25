$(document).ready(function(){
	var arrPanel = {fund:"fundPanel", home:"homePanel", patient:"patientPanel", lab:"labPanel", setting:"settingPanel", system:"settingPanel"};
	var router = {};
	router.home = "home";
	router.fund = {list:"fund_list",listDaily:"fund_list_daily"};
	router.patient = {list:"patient_list",examAdd:"exam_add",print:"patient_cash_print"};
	router.lab = {examList:"exam_list",examAdd:"exam_add",edit:"lab_exam_edit",examPrintResult:"exam_result_print",examPrice:"exam_price_print"};

	//router.labExamList = "exam_list";
	// router.lab.examList = {print:"exam_result_print"};
	router.setting = {profileList:"profile_list",testList:"test_list",normalRanges:"normal_range"};
	router.system = {logout:"logout"};

	// console.log(router['fund']['list']);
	// console.log(arrPanel['age']);
	$('a').click(function(){
		// console.log(window.location.hash);
		// routRefresh();
		// return false;
	});

	function showPanel(x){
		$('.sidePanel').hide();
		$(x).show();
	}

	function loadMain(arrHash,id){
//console.log(router[arrHash[0]]);
		$('#loading').css('display','block');
		if(!id)
			if(router[arrHash[0]][arrHash[1]])
				$('#main').load('include/'+router[arrHash[0]][arrHash[1]]+'.php',function(response, status, xhr){
					$('#loading').css('display','none');
				});
			else
				$('#main').load('include/'+router[arrHash[0]]+'.php',function(response, status, xhr){
					$('#loading').css('display','none');
				});
			else
				if(router[arrHash[0]][arrHash[1]])
					$('#main').load('include/'+router[arrHash[0]][arrHash[1]]+'.php?id='+id,function(response, status, xhr){
						$('#loading').css('display','none');
					});
				else
					$('#main').load('include/'+router[arrHash[0]]+'.php?id='+id,function(response, status, xhr){
						$('#loading').css('display','none');
					});

			}

	// function getMain(arrHash,property,value){
	// 	$('#loading').css('display','block');
	// 	var data = 0;
	// 	console.log(arrHash,property,value);
	// 	$.get('include/'+router[arrHash[0]][arrHash[1]]+'.php',{data:data},function(response, status, xhr){
	// 		$('#main').html(response);
	// 	});
	// }


	$( "#search_form" ).submit(function( event ) {
		$('#jtableDiv').jtable('reload');
		event.preventDefault();
	});

	function routRefresh(){
		// console.log(window.location.hash);
		// console.log(window.history);

		var str = window.location.hash;
		var str = str.substr(1);
		var arrHash = str.split('%3E');
		 //console.log(arrPanel);
		//console.log(arrHash);

		var x = $('#'+arrPanel[arrHash[0]]);

		if(arrHash[0] in arrPanel){
//console.log(arrHash, x);
			if(!arrHash[3]){
				showPanel(x);
				// $('#loading').css('display','block');
	   //          // $('#search_str').val('');
	   //          $('#main').load('include/category.php',function(response, status, xhr){
	   //              $('#loading').css('display','none');
	   //          });
	   loadMain(arrHash,arrHash[2]);
	}
	else{
		showPanel(x);
		console.log(arrHash);
		getMain(arrHash);
	}

}
else{
	window.history.back(); 
	if(arrHash[0] == 'print'){
		var printDivCSS = new String ('<link href="scripts/jtable.2.3.1/themes/metro/blue/jtable.css" rel="stylesheet" type="text/css" />'+'<link href="css/printStyle.css" rel="stylesheet">');
				var styles = '<style> td{text-decoration:none;} </style>';
				window.frames["print_frame"].document.body.innerHTML=printDivCSS + document.getElementById("main").innerHTML;
				window.frames["print_frame"].window.focus();
				window.frames["print_frame"].window.print();
			}

		}
	}

	$(window).on('hashchange', function(){
		routRefresh();
	});

	window.location.hash = 'home';



//****************************************************************** patient>examAdd
var totalPrice = 0;
$('body').on('change','.profile_select',function(){
		// console.log(this);
		var elementProfile = $(this).parent().parent();
		var idProfile = $(this).val();
		// $.get('control/test.control.php?action=testListProfile',idProfile:idProfile,function(data){
		// 	console.log(data);
		// });
		var testHtml = '';
		$.get('control/test.control.php?action=testListProfile',{idProfile:idProfile},function(data){
			data = $.parseJSON(data);
			// console.log(data);
			
			for(var e in data){
				// totalPrice += parseInt(data[e].price.replace(',',''));
				testHtml += '<div class="form-group">'+
				'<label class="col-md-3 control-label" for="patientDetail">'+data[e].name+'</label>'+
				'<div class="col-md-7">'+                     
				'<div class="input-group input-group-sm">'+
				'<span class="input-group-addon"><input type="checkbox" id="'+data[e].id+'" class="checkTest"></span>'+
				'<input type="text" class="form-control detailTest" placeholder="Detail For test" id="detail_'+data[e].id+'">'+
				'<span class="input-group-addon testPrice">'+data[e].price+'</span>'+
				'</div>'+
				'</div>'+
				'</div>';
			}

			// elementProfile.after(testHtml);
			elementProfile.next().html(testHtml);
			calculatePrice();
			// elementProfile.clone().appendTo(elementProfile.next().parent().after());
			console.log(totalPrice);
		});

		
	});

function calculatePrice(){
			// $('.testPrice').each(obj,function(key,value){
			// 	console.log(this);
			// });

			var testPrices = $('.testPrice');
			var count = testPrices.length;
			totalPrice = 0;
			for(var i=0; i<count; i++){
				if($(testPrices[i]).parent().find('.checkTest').is(":checked"))
					totalPrice += parseInt(testPrices[i].innerHTML.replace(',',''));
				// console.log($(testPrices[i]).parent().find('.checkTest').is(":checked"));
			}
			$('#totalPrice').val(totalPrice);
			calculateDiscount();
			// console.log(testPrices[0]);
		}

		function calculateDiscount(){
			$('#payin').val(totalPrice - $('#discount').val());
		}

		$('body').on('click','#addNewProfile',function(){
			$('.profileAndTest:last').clone().insertAfter('.profileAndTest:last');
			calculatePrice();
		});

		$('body').on('click','#removeLastProfile',function(){
			$('.profileAndTest:last').remove();
			calculatePrice();
		});

		$('body').on('change keyup keydown blur','#discount',function(){
			calculateDiscount();
		});
		
		$('body').on('change click','.checkTest',function(){
			calculatePrice();
		});

		$('body').on('keyup','#patientName',function(){
			console.log($('#patientName').val());
			$.get('control/patient.control.php?action=patientName',{data:$('#patientName').val()},function(result){
				
				var patientsSuggest = $.parseJSON(result);
				var htmlPatientSuggest = '';
				for(var e in patientsSuggest){
					htmlPatientSuggest += '<button type="button" class="btn btn-default btnSuggestPatient" value="'+patientsSuggest[e].id+'" >'+ patientsSuggest[e].name + ' / ' + patientsSuggest[e].dob + ' / ' + patientsSuggest[e].id + '</button><br>';
				}
				$('#suggestedPatient').html(htmlPatientSuggest);
				console.log(patientsSuggest);
			})
		});

		$('body').on('click', '.btnSuggestPatient', function(e){
			console.log($(this).val());
			$('#patientId').val($(this).val());
			checkIdPatient($(this).val());
			$('#patientName').val('');
		});

		$('body').on('click','#examAddSubmit',function(){
			var data = {};
			data.patientName = $('#patientName').val();
			data.dob = $('#dob').val();
			data.age = $('#age').val();
			data.gender = $('#gender').val();
			data.patientDetail = $('#patientDetail').val();
			data.patientId = $('#patientId').val();
			data.patientRegisteredName = $('#patientRegisteredName').val();
			data.recieved = $('#recieved').val();
			data.doctor = $('#doctor').val();
			data.doctorName = $('#doctorName').val();
			data.examDetail = $('#examDetail').val();
			data.discount = $('#discount').val();
			data.totalPrice = $('#totalPrice').val();
			data.tests = [];
		// data.tests[1] = {};
		// data.tests[1].name = 'diako';


		var testPrices = $('.testPrice');
		var count = testPrices.length;
		totalPrice = 0;
		var j = 0;
		for(var i=0; i<count; i++){
			if($(testPrices[i]).parent().find('.checkTest').is(":checked")){
				data.tests[j] = {};
				data.tests[j].check = $(testPrices[i]).parent().find('.checkTest').is(":checked");
				data.tests[j].price = parseInt(testPrices[i].innerHTML.replace(',',''));
				data.tests[j].detail = $(testPrices[i]).parent().find('.detailTest').val();
				data.tests[j].id = $(testPrices[i]).parent().find('.checkTest').attr('id');
				console.log($(testPrices[i]).parent().find('.checkTest').is(":checked"));
				// if($(testPrices[i]).parent().find('.checkTest').is(":checked"))
				// 
				j++;	
			}

			// console.log($(testPrices[i]).parent().find('.checkTest').is(":checked"));
		}
		console.log(data);
		$.get('control/exam.control.php?action=create',{data:data},function(result){
			if(result == '{"Result":"OK"}')
				$('#examAddSubmit').attr('disabled','disabled');
		})

		
	});

		function calculateDOB(age){
			age = age * 31536000000;
			var now = new Date();
			var DOB = new Date(now - age);
		// console.log(DOB.toISOString().substring(0,10));
		$('#dob').val(DOB.toISOString().substring(0,10));
		return DOB;
	}


	function calculateAge(DOB) { 
		var ageDifMs = Date.now() - DOB.getTime();
		// console.log((Date.now() - DOB.valueOf())/31536000000);
		var age = (Date.now() - DOB.valueOf())/31536000000;
		$('#age').val(Math.round(age*100)/100);
		return age;
		// var ageDate = new Date(ageDifMs); // miliseconds from epoch
		// return Math.abs(ageDate.getUTCFullYear() - 1970);
	}

	$('body').on('click change keydown keyup blur','#dob',function(){
		var DOB = new Date($(this).val());
		calculateAge(DOB);
	});

	$('body').on('click change keydown keyup blur','#age',function(){
		// var DOB = new Date($(this).val());
		calculateDOB($(this).val());
	});


	function checkIdPatient(idPatient){
		$.get('control/patient.control.php?action=patientId',{data:idPatient},function(result){
			console.log(result);
			if(result){
				$('#patientIdSuccess').css('display','inline').text(result);
				$('#patientIdWarning').css('display','none');
			}
			else{
				$('#patientIdWarning').css('display','inline');
				$('#patientIdSuccess').css('display','none');
			}
		});

	}
	$('body').on('change keyup keydown blur','#patientId',function(){
		console.log($(this).val());
		checkIdPatient($(this).val());
	});

	$('body').on('click change','#patientRegisteredName',function(){
		console.log($(this).val());
		$('#patientId').val($(this).val());
		checkIdPatient($(this).val());
		//$('#patientId');
	});

//****************************************************************** END patient>examAdd







});

window.setTimeout("updateTime()", 0);// start immediately
window.setInterval("updateTime()", 1000);// update every second
function updateTime() {
	document.getElementById("theTimer").firstChild.nodeValue =
	new Date().toTimeString().substring(0, 5);
}
