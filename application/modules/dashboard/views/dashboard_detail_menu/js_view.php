<style type="text/css">
	#map {
	  width: 1400px;
	  height: 400px;
	}
</style>


<!-- <script src="//code.jquery.com/jquery-1.9.1.js"></script> -->
<!-- js for bar graph -->
  


<!-- <script src="https://cdn.canvasjs.com/canvasjs.min.js"></script> -->

<!-- js for line chart -->
<script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js"></script> -->
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script> -->
<!--<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script> -->

<script src="https://cdn.jsdelivr.net/npm/chart.js@3.0.0/dist/chart.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.0.0"></script>

<script type="text/javascript">

$(document).ready(function() {
   	$(function() {
        $( "#start_date" ).datepicker();
        $( "#end_date" ).datepicker();
   	});

   	
});

var module_path = "<?php echo base_url($folder_name);?>"; //for save method string
var myTable;
var validator;
var save_method; //for save method string
var idx; //for save index string
var ldx; //for save list index string
var url = new URL(window.location.href);
arrayOfStrings = url.toString().split('='); 
var getidfc = arrayOfStrings[1];
var spl_idfc = getidfc.toString().split('&'); 
var idfc = spl_idfc[0];
var orderid = arrayOfStrings[2];

<?php if  (_USER_ACCESS_LEVEL_VIEW == "1") { ?>
jQuery(function($) { 

	
	/* load table list */
	/*myTable =
	$('#dynamic-table')
	.DataTable( {
		fixedHeader: {
			headerOffset: $('.page-header').outerHeight()
		},
		responsive: true,
		bAutoWidth: false,
		"aoColumnDefs": [
		  { "bSortable": false, "aTargets": [ 0,1 ] },
		  { "sClass": "text-center", "aTargets": [ 0,1 ] }
		],
		
		"sAjaxSource": module_path+"/get_data_activity?idx="+idfc+"&orderid=0",
		"bProcessing": true,
        "bServerSide": true,
		"pagingType": "bootstrap_full_number",
		"colReorder": true,
		"rowCallback": function(row, data, index){ 
		    if(data[6]==1){
		        $(row).find('td:eq(3)').css('background-color', '#0fff0d');
		    }
		    if(data[6]==0){
		        $(row).find('td:eq(3)').css('background-color', '#ff0d37');
		    }
		  }
    } );*/

	<?php if  (_USER_ACCESS_LEVEL_ADD == "1" || _USER_ACCESS_LEVEL_UPDATE == "1") { ?>
	validator = $("#frmInputData").validate({
		errorElement: 'span', //default input error message container
		errorClass: 'help-block help-block-error', // default input error message class
		focusInvalid: false, // do not focus the last invalid input
		ignore: "", // validate all fields including form hidden input
		rules: {
			title: {
				required: true
			},
			module_name: {
				required: true
			},
			url: {
				required: true
			}
		},
		messages: { // custom messages for radio buttons and checkboxes
		},
		errorPlacement: function (error, element) { // render error placement for each input type
			if (element.parent(".input-group").size() > 0) {
				error.insertAfter(element.parent(".input-group"));
			} else if (element.attr("data-error-container")) { 
				error.appendTo(element.attr("data-error-container"));
			} else if (element.parents('.radio-list').size() > 0) { 
				error.appendTo(element.parents('.radio-list').attr("data-error-container"));
			} else if (element.parents('.radio-inline').size() > 0) { 
				error.appendTo(element.parents('.radio-inline').attr("data-error-container"));
			} else if (element.parents('.checkbox-list').size() > 0) {
				error.appendTo(element.parents('.checkbox-list').attr("data-error-container"));
			} else if (element.parents('.checkbox-inline').size() > 0) { 
				error.appendTo(element.parents('.checkbox-inline').attr("data-error-container"));
			} else {
				error.insertAfter(element); // for other inputs, just perform default behavior
			}
		},
		highlight: function (element) { // hightlight error inputs
			$(element)
				.closest('.form-group').addClass('has-error'); // set error class to the control group
		},
		unhighlight: function (element) { // revert the change done by hightlight
			$(element)
				.closest('.form-group').removeClass('has-error'); // set error class to the control group
		},
		success: function (label) {
			label
				.closest('.form-group').removeClass('has-error'); // set success class to the control group
		}
	});
	<?php } ?>


	getDataFC(idfc);
	getCctv(idfc);
	getDataRealtime(idfc,orderid);
	jobGraph(idfc);
	/*activityGraph('def', idfc);
	getLineChart('def', 'def', idfc);
	getTblWaktu('def', 'def', idfc);*/

	$('[name="id_fc"]').val(idfc);

})

<?php $this->load->view(_TEMPLATE_PATH . "common_module_js"); ?>
<?php } ?>

<?php if  (_USER_ACCESS_LEVEL_VIEW == "1" && (_USER_ACCESS_LEVEL_UPDATE == "1" || _USER_ACCESS_LEVEL_DETAIL == "1")) { ?>
function load_data()
{
    $.ajax({
		type: "POST",
        url : module_path+'/get_detail_data',
		data: { id: idx },
		cache: false,		
        dataType: "JSON",
        success: function(data)
        {
			if(data != false){
				
			} else {
				title = '<div class="text-center" style="padding-top:20px;padding-bottom:10px;"><i class="fa fa-exclamation-circle fa-5x" style="color:red"></i></div>';
				btn = '<br/><button class="btn blue" data-dismiss="modal">OK</button>';
				msg = '<p>Gagal peroleh data.</p>';
				var dialog = bootbox.dialog({
					message: title+'<center>'+msg+btn+'</center>'
				});
				//if(response.status){
					setTimeout(function(){
						dialog.modal('hide');
					}, 1500);
				//}
			}
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
			var dialog = bootbox.dialog({
				title: 'Error ' + jqXHR.status + ' - ' + jqXHR.statusText,
				message: jqXHR.responseText,
				buttons: {
					confirm: {
						label: 'Ok',
						className: 'btn blue'
					}
				}
			});
        }
    });
}


<?php } ?>



function getCctv(idfc){
	

	$.ajax({
		type: "POST",
        url : module_path+'/get_cctv',
		data: { cctv: idfc},
		cache: false,		
        dataType: "JSON",
        success: function(data)
        { 
			if(data != false){ 
				
				$('span.tblCctv').html(data);
				
			} else {
				title = '<div class="text-center" style="padding-top:20px;padding-bottom:10px;"><i class="fa fa-exclamation-circle fa-5x" style="color:red"></i></div>';
				btn = '<br/><button class="btn blue" data-dismiss="modal">OK</button>';
				msg = '<p>Gagal peroleh data.</p>';
				var dialog = bootbox.dialog({
					message: title+'<center>'+msg+btn+'</center>'
				});
				//if(response.status){
					setTimeout(function(){
						dialog.modal('hide');
					}, 1500);
				//}
			}
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
			var dialog = bootbox.dialog({
				title: '',//'Error ' + jqXHR.status + ' - ' + jqXHR.statusText,
				message: jqXHR.responseText,
				buttons: {
					confirm: {
						label: 'Ok',
						className: 'btn blue'
					}
				}
			});
        }
    });
}


function getDataRealtime(idfc, orderid){
	

	$.ajax({
		type: "POST",
        url : module_path+'/get_data_realtime',
		data: { idfc: idfc, orderid: orderid},
		cache: false,		
        dataType: "JSON",
        success: function(data)
        {  
			if(data != false){ 
				
				$('span.tblDataRealtime').html(data);
				
			} else { 
				title = '<div class="text-center" style="padding-top:20px;padding-bottom:10px;"><i class="fa fa-exclamation-circle fa-5x" style="color:red"></i></div>';
				btn = '<br/><button class="btn blue" data-dismiss="modal">OK</button>';
				msg = '<p>Gagal peroleh data.</p>';
				var dialog = bootbox.dialog({
					message: title+'<center>'+msg+btn+'</center>'
				});
				//if(response.status){
					setTimeout(function(){
						dialog.modal('hide');
					}, 1500);
				//}
			}
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
			var dialog = bootbox.dialog({
				title: '',//'Error ' + jqXHR.status + ' - ' + jqXHR.statusText,
				message: jqXHR.responseText,
				buttons: {
					confirm: {
						label: 'Ok',
						className: 'btn blue'
					}
				}
			});
        }
    });
}




function jobGraph(idfc){ 
	var start_date = document.getElementById("start_date").value;
  	var end_date = document.getElementById("end_date").value;

  	

	$.ajax({
		type: "POST",
        url : module_path+'/get_detailJobGraph',
		data: { cctv: idfc, start_date: start_date, end_date: end_date},
		cache: false,		
        dataType: "JSON",
        success: function(data)
        { 
			if(data != false){ 

				$('span#title_job').html(data[0].floating_crane_name);
				//// get Job Graph
				var arrDate		= []; 
				var arrJob 		= [];
				var arrDataJob	= [];	

				var arrColor 	= ["#5969ff",
	                                "#ff407b",
	                                "#25d5f2",
	                                "#ffc750",
	                                "#2ec551",
	                                "#7040fa",
	                                "#ff004e"];

	
	
				let total = {}; 
				for(var i=0; i<data.length; i++){
					var exists = arrDate.includes(data[i].date);
					if (!exists) { 
					    arrDate.push(data[i].date);
					}

					var exists_job = arrJob.includes(data[i].order_name);
					if (!exists_job) { 
						arrJob.push(data[i].order_name);
						
					}

					for(let a=0; a<arrJob.length; a++){
						let no = a+1; 
						<?php $ke = 'no'; ?>

						if(data[i].order_name == arrJob[a]){ 
							var obj={};
							obj['name'] = <?=$ke?>;
							obj['time'] = data[i].date_time_total;
							obj['date'] = data[i].date;
							arrDataJob.push(obj);
						}
					}
					
				} 

				document.cookie = "totalJob = " + arrJob.length;
				/*document.cookie = "totalJob = "+arrJob.length+"; SameSite=None; Secure";*/
				<?php
				    $ttlJob= 6;//$_COOKIE['totalJob'];
				?>


				var groupedJob = arrDataJob
				  .reduce((acc, curr) => {
				    var key = curr.name;
				    (acc[key] = acc[key] || [])
				      .push(curr.time);
				    return acc;
				  }, {});


				var groupedJobDate = arrDataJob
				  .reduce((acc, curr) => {
				    var key = curr.name;
				    (acc[key] = acc[key] || [])
				      .push(curr.date);
				    return acc;
				  }, {});


				for(let s=1; s<=arrJob.length; s++){
				  	for(let t=0; t<groupedJob[s].length; t++){
				  		total[`total_time_${s}`] = groupedJob[s];
				  		total[`date_${s}`] = groupedJobDate[s];
				  	}
				}
				var arrtotal=[];

				for(let u=1; u<=arrJob.length; u++){
					var uNo=u-1;
					
					for(var m=0; m<arrDate.length; m++){ 
						var arrobj={};
						arrobj['valName'] = 'xData_'+uNo;
						arrobj['valDate'] = arrDate[m];

						var exists_x = groupedJobDate[u].includes(arrDate[m]);
						if (!exists_x) { 
							arrobj['valTime'] = 0;
						}else{
							var arrayIdx = (groupedJobDate[u].indexOf(arrDate[m]));
							arrobj['valTime'] = total[`total_time_${u}`][arrayIdx];
						}
						arrtotal.push(arrobj);
						

					}
				}

				var groupedArrTotal = arrtotal
				  .reduce((acc, curr) => {
				    var key = curr.valName;
				    (acc[key] = acc[key] || [])
				      .push(curr.valTime);
				    return acc;
				  }, {});

  
				
				
				const canvas = document.getElementById('chartjs_bar');
				const ctx = canvas.getContext('2d');
				
				//var ctx = document.getElementById("chartjs_bar").getContext('2d');
			    var myChart = new Chart(ctx, {
			        type: 'bar',
			        data: {
			            labels: arrDate, 
			            datasets: [
			            	<?php 
			            	for($aa=0; $aa<$ttlJob; $aa++){ 
			            		//$i=$aa+1;
			            		?>
				            		{
								      label: arrJob[<?=$aa?>],
								      data: groupedArrTotal.xData_<?=$aa?>,
								      //borderColor: '#36A2EB',
								      backgroundColor: arrColor[<?=$aa?>],
								    },
			            		<?php
			            	}
			            	?>
			        	]
			        },
			        options: {
			               		legend: {
						            display: true,
						            position: 'bottom',

						            labels: {
						                fontColor: '#71748d',
						                fontFamily: 'Circular Std Book',
						                fontSize: 14,
						            }
						        },
						    }
			    });


			    canvas.onclick = (evt) => { 
				  const res = myChart.getElementsAtEventForMode(
				    evt,
				    'nearest',
				    { intersect: true },
				    true
				  ); 
				  // If didn't click on a bar, `res` will be an empty array
				  if (res.length === 0) {
				    return;
				  }

				  var indexClick = res[0].datasetIndex;
				  //console.log(myChart.data.datasets[indexClick].label);
				  
				  
				  //var valClick = res[0]._view.datasetLabel;
				  var valClick = myChart.data.datasets[indexClick].label;

				  activityGraph(valClick, idfc);
				  //alert('You clicked on ' +valClick);
				  //alert('You clicked on ' + myChart.data.labels[res[0]._view.datasetLabel]);
				};


				document.getElementById("downloadCSV_pekerjaan").addEventListener("click", function() { 
				  downloadCSV({ 
				    filename: "summary_pekerjaan.csv",
				    chart: myChart
				  })
				});

				document.getElementById('downloadImage_pekerjaan').addEventListener('click', () => {
	                const image = myChart
	                    .toBase64Image();
	                const link = document
	                    .createElement('a');
	                link.href = image;
	                link.download = 'summary_pekerjaan_img.png';
	                link.click();
	            });

				
				//// END get Job Graph
				
			} else { 
				$('span#title_job').html('No Job order');



				/*title = '<div class="text-center" style="padding-top:20px;padding-bottom:10px;"><i class="fa fa-exclamation-circle fa-5x" style="color:red"></i></div>';
				btn = '<br/><button class="btn blue" data-dismiss="modal">OK</button>';
				msg = '<p>Gagal peroleh data.</p>';
				var dialog = bootbox.dialog({
					message: title+'<center>'+msg+btn+'</center>'
				});
				//if(response.status){
					setTimeout(function(){
						dialog.modal('hide');
					}, 1500);
				//}*/
			}
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
			var dialog = bootbox.dialog({
				title: '',//'Error ' + jqXHR.status + ' - ' + jqXHR.statusText,
				message: jqXHR.responseText,
				buttons: {
					confirm: {
						label: 'Ok',
						className: 'btn blue'
					}
				}
			});
        }
    });


}


function activityGraph(jobId, fcId){
	
	$.ajax({
		type: "POST",
        url : module_path+'/get_detailActivityGraph',
		data: { jobId: jobId, fcId: fcId},
		cache: false,		
        dataType: "JSON",
        success: function(data)
        { 
			if(data != false){ 
				
				$('span#title_activity').html(data[0].order_name);

				//// get Activity Graph
				var arrAct = [];
				var arrTotalTime = [];
				for(var i=0; i<data.length; i++){ 
					arrAct.push(data[i].activity_name);
					arrTotalTime.push(data[i].total_date_time);
				}
				//console.log(arrAct);
				
				//var ctx = document.getElementById("chartjs_bar_activity").getContext('2d');
				const canvas = document.getElementById('chartjs_bar_activity');
				const ctx = canvas.getContext('2d');

				var chartExist = Chart.getChart("chartjs_bar_activity"); // <canvas> id
			    if (chartExist != undefined)  
			      chartExist.destroy(); 



			    var myChart = new Chart(ctx, {
			        type: 'bar',
			        data: {
			            labels: arrAct, 
			            datasets: [{
                            backgroundColor: [
                               "#3caab7",
                                "#29747d",
                                "#25d5f2",
                                "#ffc750",
                                "#2ec551",
                                "#7040fa",
                                "#ff004e"
                            ],
                            data: arrTotalTime, 
                            label: ''
                        }]
			        },
			        options: {
			        	plugins: {
			        		legend: {
						            display: false,
						            position: 'bottom',

						            labels: {
						                fontColor: '#71748d',
						                fontFamily: 'Circular Std Book',
						                fontSize: 14,
						            }
						    }
			        	}   
					}
			    });


			    canvas.onclick = (evt) => {
				  	const res = myChart.getElementsAtEventForMode(
					    evt,
					    'nearest',
					    { intersect: true },
					    true
				  	);
				  	// If didn't click on a bar, `res` will be an empty array
				  	if (res.length === 0) {
					    return;
				  	}
				
					var indexClick = res[0].index;

				  	/*var valClick = res[0]._view.label;*/
				  	var valClick = myChart.data.labels[indexClick];

			  		getLineChart(valClick, jobId, fcId);
				  	getTblWaktu(valClick, jobId, fcId);
				  	//alert('You clicked on ' +valClick);
				  	//alert('You clicked on ' + myChart.data.labels[res[0]._view.datasetLabel]);
				};


				document.getElementById("downloadCSV_activity").addEventListener("click", function() { 
				  downloadCSV({ 
				    filename: "summary_activity.csv",
				    chart: myChart
				  })
				});

				document.getElementById('downloadImage_activity').addEventListener('click', () => {
	                const image = myChart
	                    .toBase64Image();
	                const link = document
	                    .createElement('a');
	                link.href = image;
	                link.download = 'summary_activity_img.png';
	                link.click();
	            });

				
				//// END get Activity Graph
				
			} else {
				title = '<div class="text-center" style="padding-top:20px;padding-bottom:10px;"><i class="fa fa-exclamation-circle fa-5x" style="color:red"></i></div>';
				btn = '<br/><button class="btn blue" data-dismiss="modal">OK</button>';
				msg = '<p>Gagal peroleh data.</p>';
				var dialog = bootbox.dialog({
					message: title+'<center>'+msg+btn+'</center>'
				});
				//if(response.status){
					setTimeout(function(){
						dialog.modal('hide');
					}, 1500);
				//}
			}
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
			var dialog = bootbox.dialog({
				title: '',//'Error ' + jqXHR.status + ' - ' + jqXHR.statusText,
				message: jqXHR.responseText,
				buttons: {
					confirm: {
						label: 'Ok',
						className: 'btn blue'
					}
				}
			});
        }
    });


}

function getDateRange(){
	var id_fc = document.getElementById("id_fc").value;
	var start_date = document.getElementById("start_date").value;
  	var end_date = document.getElementById("end_date").value;


  	jobGraph(id_fc);
	
}

function getLineChart(activity, jobId, fcId){ 
	

	$.ajax({
		type: "POST",
        url : module_path+'/get_detailwaktuAct',
		data: { activity: activity, jobId: jobId, fcId: fcId},
		cache: false,		
        dataType: "JSON",
        success: function(data)
        { 
			if(data != false){ 

				//$('span#title_activity').html(data[0].order_name);

				//// get Activity Graph
				var arrAct = [];
				var arrTotalTime = [];
				for(var i=0; i<data.length; i++){ 
					arrAct.push(data[i].activity_name);
					arrTotalTime.push(data[i].total_time);
				}
				//console.log(arrAct);


				var chartExist = Chart.getChart("chartjs_line"); // <canvas> id
			    if (chartExist != undefined)  
			      chartExist.destroy(); 

				
				const canvas = document.getElementById('chartjs_line');
				const ctx = canvas.getContext('2d');


			    var myChart = new Chart(ctx, {
			        type: 'line',
			        data: {
			            labels: arrAct, 
			            datasets: [{
                            backgroundColor: [
                                "#072f77" //"#98baf9" 
                            ],
                            borderColor: [
                                "#072f77"
                            ],
                            data: arrTotalTime, 
                            label: ''
                        }]
			        },
			        options: {
			        	plugins: {
			        		legend: {
						            display: false,
						            position: 'bottom',

						            labels: {
						                fontColor: '#71748d',
						                fontFamily: 'Circular Std Book',
						                fontSize: 14,
						            }
						    }
			        	}
					}

			    });

			    //var chart = new Chart(document.getElementById('chartjs_line'), myChart);

				document.getElementById("downloadCSV").addEventListener("click", function() { 
				  downloadCSV({ 
				    filename: "chart-data.csv",
				    chart: myChart
				  })
				});

				document.getElementById('downloadImage').addEventListener('click', () => {
	                const image = myChart
	                    .toBase64Image();
	                const link = document
	                    .createElement('a');
	                link.href = image;
	                link.download = 'detail_activity_chart.png';
	                link.click();
	            });

				
			} else {
				title = '<div class="text-center" style="padding-top:20px;padding-bottom:10px;"><i class="fa fa-exclamation-circle fa-5x" style="color:red"></i></div>';
				btn = '<br/><button class="btn blue" data-dismiss="modal">OK</button>';
				msg = '<p>Gagal peroleh data.</p>';
				var dialog = bootbox.dialog({
					message: title+'<center>'+msg+btn+'</center>'
				});
				//if(response.status){
					setTimeout(function(){
						dialog.modal('hide');
					}, 1500);
				//}
			}
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
			var dialog = bootbox.dialog({
				title: '',//'Error ' + jqXHR.status + ' - ' + jqXHR.statusText,
				message: jqXHR.responseText,
				buttons: {
					confirm: {
						label: 'Ok',
						className: 'btn blue'
					}
				}
			});
        }
    });



}

function getTblWaktu(activity, job, fcId){

	myTable =
	$('#tbldetailWaktuAct')
	.DataTable( {
		fixedHeader: {
			headerOffset: $('.page-header').outerHeight()
		},
		responsive: true,
		bAutoWidth: false,
		"aoColumnDefs": [
		  { "bSortable": false, "aTargets": [ 0,1 ] },
		  { "sClass": "text-center", "aTargets": [ 0,1 ] }
		],
		"aaSorting": [
		  	[2,'asc'] 
		],
		"sAjaxSource": module_path+"/get_data_waktu_activity?job="+job+"&activity="+activity+"&fcId="+fcId+"",
		"bProcessing": true,
        "bServerSide": true,
		"pagingType": "bootstrap_full_number",
		"colReorder": true
    } );

}

function getEksportActivityMonitor(){
	var id_fc = document.getElementById("id_fc").value;
	
	$.ajax({
		type: "POST",
        url : module_path+'/eksport_activity_monitor',
		data: { id: id_fc },
		cache: false,		
        dataType: "JSON",
        success: function(data)
        {
			if(data != false){
				
			} else {
				title = '<div class="text-center" style="padding-top:20px;padding-bottom:10px;"><i class="fa fa-exclamation-circle fa-5x" style="color:red"></i></div>';
				btn = '<br/><button class="btn blue" data-dismiss="modal">OK</button>';
				msg = '<p>Gagal peroleh data.</p>';
				var dialog = bootbox.dialog({
					message: title+'<center>'+msg+btn+'</center>'
				});
				//if(response.status){
					setTimeout(function(){
						dialog.modal('hide');
					}, 1500);
				//}
			}
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
			var dialog = bootbox.dialog({
				title: 'Error ' + jqXHR.status + ' - ' + jqXHR.statusText,
				message: jqXHR.responseText,
				buttons: {
					confirm: {
						label: 'Ok',
						className: 'btn blue'
					}
				}
			});
        }
    });

}

function getDateTime() {
        var now     = new Date(); 
        var year    = now.getFullYear();
        var month   = now.getMonth()+1; 
        var day     = now.getDate();
        var hour    = now.getHours();
        var minute  = now.getMinutes();
        var second  = now.getSeconds(); 
        if(month.toString().length == 1) {
             month = '0'+month;
        }
        if(day.toString().length == 1) {
             day = '0'+day;
        }   
        if(hour.toString().length == 1) {
             hour = '0'+hour;
        }
        if(minute.toString().length == 1) {
             minute = '0'+minute;
        }
        if(second.toString().length == 1) {
             second = '0'+second;
        }   
        var dateTime = year+'-'+month+'-'+day+' '+hour+':'+minute+':'+second;   
         return dateTime;
    }


setInterval(function(){
	var idfc = $("#floating_crane option:selected").val();
	var orderid = $("#order_name option:selected").val();
	
	//$('#dynamic-table').DataTable().ajax.reload();
	getDataRealtime(idfc, orderid);

	/*SLACycle_percentage(idfc);
	SLACycle_jml(idfc);*/

	var txtdatetimestart = document.getElementById("txtdatetimestart").value;

    currentTime = getDateTime();

    $('#txtcurrdatetime').val(currentTime);

    //count process time 
    var date1 = new Date(txtdatetimestart);
	var date2 = new Date(currentTime);

	var date1_ms = date1.getTime();
	var date2_ms = date2.getTime();


	var diff = date2_ms - date1_ms;
	var hours   = Math.floor(diff / 3.6e6);
	var minutes = Math.floor((diff % 3.6e6) / 6e4);
	var seconds = Math.floor((diff % 6e4) / 1000);
	var duration = hours+":"+minutes+":"+seconds;
	//end count process time

	$('#txtprocesstime').val(duration);


}, 1000);


function getDataFC(id_fc){
	
	$.ajax({
		type: "POST",
        url : module_path+'/get_Data_FC',
		data: { id_fc: id_fc },
		cache: false,		
        dataType: "JSON",
        success: function(data)
        { 
			/*if(data != false){ 	*/
        	if(data.datafc.length != 0){ 	
        		var joborderid = data.datafc[0].job_order_id;
				var jobordername = data.datafc[0].order_name;
				var activityname = data.datafc[0].activity_name;


				$('#txtmothervessel').val(data.datafc[0].mother_vessel_name);
				$('select#floating_crane').val(data.datafc[0].floating_crane_id).trigger('change.select2');
				$('#txtdatetimestart').val(data.datafc[0].datetime_start);


				var $el = $("#order_name");
				$el.empty(); // remove old options
				$.each(data.msorder, function(key,value) {
				  	$el.append($("<option></option>")
				     .attr("value", value.job_order_id).text(value.order_name));
				});
				$('select#order_name').val(joborderid).trigger('change.select2');


			} else { 
				var joborderid = '';
				var jobordername = '';
				var activityname = '';


				$('#txtordername').val('');
				$('#txtmothervessel').val('');
				$('#txtdatetimestart').val('');

				var $el = $("#order_name");
				$el.empty(); // remove old options
				$.each(data.msorder, function(key,value) {
				  	$el.append($("<option></option>")
				     .attr("value", value.id).text(value.order_name));
				});
				$('select#order_name').val('').trigger('change.select2');
			}

			reloadDatatable(id_fc, joborderid);
			SLACycle_percentage(id_fc, joborderid);
			SLACycle_jml(id_fc, joborderid);
			activityGraph(jobordername, id_fc);
			getLineChart(activityname, jobordername, id_fc);
			getTblWaktu(activityname, jobordername, id_fc);

        },
        error: function (jqXHR, textStatus, errorThrown)
        {
			var dialog = bootbox.dialog({
				title: 'Error ' + jqXHR.status + ' - ' + jqXHR.statusText,
				message: jqXHR.responseText,
				buttons: {
					confirm: {
						label: 'Ok',
						className: 'btn blue'
					}
				}
			});
        }
    });
}


function SLACycle_percentage(fcId, orderid){
	
	$.ajax({
		type: "POST",
        url : module_path+'/get_sla_cycle_percentage',
		data: {fcId: fcId, orderid: orderid},
		cache: false,		
        dataType: "JSON",
        success: function(data)
        { 
			if(data != false){ 
				
				const dataX = {
				  labels: [
				    'Ideal',
				    'Over'
				  ],
				  datasets: [{
				    label: 'My First Dataset',
				    data: [data.sla_ideal, data.sla_over],
				    backgroundColor: ['#FE6B32','#0F5763'],
				    //hoverOffset: 4
				  }]
				};



				const canvas = document.getElementById('chartjs_pie');
				const ctx = canvas.getContext('2d');
				
				

			    /*var myChart = new Chart(ctx, {
			        type: 'pie',
			        data: dataX,
				  	options: {},
			       
			    });*/


			    var myChart = new Chart(ctx, {
			        type: 'pie',
			        data: dataX,
				  	options: {
		                responsive: true,
		                plugins: {
		                    datalabels: {
		                        formatter: (value, context) => {
		                            let percentage = (value / context.chart._metasets
		                            [context.datasetIndex].total * 100)
		                                .toFixed(2) + '%';
		                            //return percentage + '\n' + value;
		                                return percentage;
		                        },
		                        color: '#fff',
		                        font: {
		                            size: 14,
		                        }
		                    }
		                }
		            },
		            plugins: [ChartDataLabels]
			       
			    });



			    
			   

				
			} else {
				title = '<div class="text-center" style="padding-top:20px;padding-bottom:10px;"><i class="fa fa-exclamation-circle fa-5x" style="color:red"></i></div>';
				btn = '<br/><button class="btn blue" data-dismiss="modal">OK</button>';
				msg = '<p>Gagal peroleh data.</p>';
				var dialog = bootbox.dialog({
					message: title+'<center>'+msg+btn+'</center>'
				});
				//if(response.status){
					setTimeout(function(){
						dialog.modal('hide');
					}, 1500);
				//}
			}
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
			var dialog = bootbox.dialog({
				title: '',//'Error ' + jqXHR.status + ' - ' + jqXHR.statusText,
				message: jqXHR.responseText,
				buttons: {
					confirm: {
						label: 'Ok',
						className: 'btn blue'
					}
				}
			});
        }
    });


}


function SLACycle_jml(fcId, orderid){
	
	$.ajax({
		type: "POST",
        url : module_path+'/get_sla_cycle_percentage',
		data: {fcId: fcId, orderid: orderid},
		cache: false,		
        dataType: "JSON",
        success: function(data)
        { 
			if(data != false){ 
				
				const dataX = {
				  labels: [
				    'Ideal',
				    'Over'
				  ],
				  datasets: [{
				    label: ['',''],
				    data: [data.sla_ideal, data.sla_over],
				    backgroundColor: ['#FE6B32','#0F5763']
				  }]
				};



				const canvas = document.getElementById('chartjs_cycle_bar');
				const ctx = canvas.getContext('2d');

			    /*var myChart = new Chart(ctx, {
			        type: 'bar',
			        data: dataX,
				  	options: {
			               legend: {
						            display: false,
						            position: 'bottom',

						            labels: {
						                fontColor: '#71748d',
						                fontFamily: 'Circular Std Book',
						                fontSize: 14,
						            }
						        },
						       
						    }
			       
			    });*/


			    var myChart = new Chart(ctx, {
			        type: 'bar',
			        data: dataX,
				  	options: {
				       	responsive: true,
		                plugins: {
		                    datalabels: {
		                        formatter: (value, context) => {
		                            let percentage = (value / context.chart._metasets
		                            [context.datasetIndex].total * 100)
		                                .toFixed(2) + '%';
		                            /*return percentage + '\n' + value;*/
		                            return value;
		                        },
		                        color: '#fff',
		                        font: {
		                            size: 14,
		                        }
		                    },
		                    legend: {
						      display: false
						    }
		                }
				    },
				    plugins: [ChartDataLabels]
			       
			    });

				
			} else {
				title = '<div class="text-center" style="padding-top:20px;padding-bottom:10px;"><i class="fa fa-exclamation-circle fa-5x" style="color:red"></i></div>';
				btn = '<br/><button class="btn blue" data-dismiss="modal">OK</button>';
				msg = '<p>Gagal peroleh data.</p>';
				var dialog = bootbox.dialog({
					message: title+'<center>'+msg+btn+'</center>'
				});
				//if(response.status){
					setTimeout(function(){
						dialog.modal('hide');
					}, 1500);
				//}
			}
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
			var dialog = bootbox.dialog({
				title: '',//'Error ' + jqXHR.status + ' - ' + jqXHR.statusText,
				message: jqXHR.responseText,
				buttons: {
					confirm: {
						label: 'Ok',
						className: 'btn blue'
					}
				}
			});
        }
    });


}


function convertChartDataToCSV(args) {
  let result, columnDelimiter, lineDelimiter, labels, data;

  data = args.data.data || null;
  if (data == null || !data.length) {
    return null;
  }

  labels = args.labels || null;
  if (labels == null || !labels.length) {
    return null;
  }

  columnDelimiter = args.columnDelimiter || ',';
  lineDelimiter = args.lineDelimiter || '\n';

  result = '' + columnDelimiter;
  result += labels.join(columnDelimiter);
  result += lineDelimiter;

  result += args.data.label; //args.data.label.toString();

  for (let i = 0; i < data.length; i++) {
    result += columnDelimiter;
    result += data[i];
  }
  result += lineDelimiter;

  return result;
}

function downloadCSV(args) { 
  var data, filename, link;
  var csv = "";
  for (var i = 0; i < args.chart.data.datasets.length; i++) {
    csv += convertChartDataToCSV({
      data: args.chart.data.datasets[i],
      labels: args.chart.data.labels //dataLabels
    });
  }
  if (csv == null) return;
  

  filename = args.filename || 'chart-data.csv';
  if (!csv.match(/^data:text\/csv/i)) {
    csv = 'data:text/csv;charset=utf-8,' + csv;
  }

  // not sure if anything below this comment works
  data = encodeURI(csv);
  link = document.createElement('a');
  link.setAttribute('href', data);
  link.setAttribute('download', filename);
  document.body.appendChild(link); // Required for FF
  link.click();
  document.body.removeChild(link);
}


$('#floating_crane').on('change', function () { 
 	var idfc = $("#floating_crane option:selected").val();
 	var order_id = $("#order_name option:selected").val();
 	
 	if(idfc == ''){
 		idfc = 'all';
 	}

 	$('[name="id_fc"]').val(idfc);

 	getDataFC(idfc);
	getCctv(idfc);
	jobGraph(idfc);


});


function reloadDatatable(idfc, order_id){
	$("#dynamic-table").dataTable().fnDestroy();
	/* load table list */
	myTable =
	$('#dynamic-table')
	.DataTable( {
		fixedHeader: {
			headerOffset: $('.page-header').outerHeight()
		},
		responsive: true,
		bAutoWidth: false,
		"aoColumnDefs": [
		  { "bSortable": false, "aTargets": [ 0,1 ] },
		  { "sClass": "text-center", "aTargets": [ 0,1 ] }
		],
		/*"aaSorting": [
		  	[2,'asc'] 
		],*/
		"sAjaxSource": module_path+"/get_data_activity?idx="+idfc+"&orderid="+order_id+"",
		"bProcessing": true,
        "bServerSide": true,
		"pagingType": "bootstrap_full_number",
		"colReorder": true,
		"rowCallback": function(row, data, index){ 
		    if(data[6]==1){
		        $(row).find('td:eq(3)').css('background-color', '#0fff0d');
		    }
		    if(data[6]==0){
		        $(row).find('td:eq(3)').css('background-color', '#ff0d37');
		    }
		  }
    } );

}

$('#order_name').on('change', function () { 
	var id_fc 	= $("#floating_crane option:selected").val();
 	var orderid = $("#order_name option:selected").val();
 	
 	if(orderid != ''){
 		
 		$.ajax({
			type: "POST",
	        url : module_path+'/get_Data_By_Order',
			data: { orderid: orderid, id_fc: id_fc },
			cache: false,		
	        dataType: "JSON",
	        success: function(data)
	        { 
				if(data != false){ 	
					$('#txtmothervessel').val(data[0].mother_vessel_name);
					$('#txtdatetimestart').val(data[0].datetime_start);

				} else { 
					$('#txtmothervessel').val('');
					$('#txtdatetimestart').val('');

				}

				reloadDatatable(id_fc, orderid);
				SLACycle_percentage(id_fc, orderid);
				SLACycle_jml(id_fc, orderid);

	        },
	        error: function (jqXHR, textStatus, errorThrown)
	        {
				var dialog = bootbox.dialog({
					title: 'Error ' + jqXHR.status + ' - ' + jqXHR.statusText,
					message: jqXHR.responseText,
					buttons: {
						confirm: {
							label: 'Ok',
							className: 'btn blue'
						}
					}
				});
	        }
	    });


 	}else{
 		alert("Please choose Order Name");
 	}

});



</script>