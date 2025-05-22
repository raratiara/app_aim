<style type="text/css">
	#map {
	  width: 1400px;
	  height: 400px;
	}

	
</style>

<script src="https://cdn.jsdelivr.net/npm/hls.js@latest"></script>


<script type="text/javascript">

var module_path = "<?php echo base_url($folder_name);?>"; //for save method string
var myTable;
var validator;
var save_method; //for save method string
var idx; //for save index string
var ldx; //for save list index string

<?php if  (_USER_ACCESS_LEVEL_VIEW == "1") { ?>
jQuery(function($) {
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
		"aaSorting": [
		  	[2,'asc'] 
		],
		"sAjaxSource": module_path+"/get_data",
		"bProcessing": true,
        "bServerSide": true,
		"pagingType": "bootstrap_full_number",
		"colReorder": true
    } );

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

	
})

<?php $this->load->view(_TEMPLATE_PATH . "common_module_js"); ?>
<?php } ?>

<?php if  (_USER_ACCESS_LEVEL_VIEW == "1" && (_USER_ACCESS_LEVEL_UPDATE == "1" || _USER_ACCESS_LEVEL_DETAIL == "1")) { ?>


$(document).ready(function() {
   	$(function() {

        	getMaps(selectVal='all');
        	listFC();

        	// Get the full URL query string
		const queryString = window.location.search;

		// Create a URLSearchParams object
		const urlParams = new URLSearchParams(queryString);

		// Get values from URL
		const id = urlParams.get('id');
		if(id != '' && id != null){
			$('#modalCCTV').modal('show');
			

			getStream(id);
			
		}
   	});
});

$('#floating_crane').on('change', function () { 
 	var selectVal = $("#floating_crane option:selected").val();
 	
 	if(selectVal == ''){
 		selectVal = 'all';
 	}
	$('[name="hdnfloating_crane"]').val(selectVal);

 	getMaps(selectVal);
});


function getMaps(id){

	$.ajax({
		type: "POST",
        url : module_path+'/get_maps',
		data: { id: id},
		cache: false,		
        dataType: "JSON",
        success: function(data)
        { 
			if(data != false){ 
				var locations = data;
				
				//$('div#clMaps').html(data);

				/*var locations = [
				  ["LOCATION_1", 11.8166, 122.0942],
				  ["LOCATION_2", 11.9804, 121.9189],
				  ["LOCATION_3", 10.7202, 122.5621],
				  ["LOCATION_4", 11.3889, 122.6277],
				  ["LOCATION_5", 10.5929, 122.6325]
				];*/

				//L.map('map').remove();
				var container = L.DomUtil.get('map');
		      	if(container != null){
			        container._leaflet_id = null;
		      	}
				
				//var map = L.map('map').setView([11.206051, 122.447886], 8);
				var map = L.map('map').setView([11.8166, 122.0942], 8);


				mapLink =
				  '<a href="http://openstreetmap.org">OpenStreetMap</a>';
				L.tileLayer(
				  'http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
				    attribution: '&copy; ' + mapLink + ' Contributors',
				    maxZoom: 18,
			  	}).addTo(map);



				for (var i = 0; i < locations.length; i++) {
				  /*marker = new L.marker([locations[i][1], locations[i][2]])
				    //.bindPopup(locations[i][0])
				  	.bindPopup(locations[i][0]).openPopup()
				    .addTo(map);*/
					var latlng = L.latLng(locations[i]['latitude'], locations[i]['longitude']);
				    /*marker = new L.popup(latlng, {content: '<p>Hello world!<br />This is a nice popup.</p>'})
				    .addTo(map);*/
				   

				    marker = new L.popup()
				    .setLatLng(latlng)
				    .setContent('<div class="mydivclass" onclick="getDetail('+"'"+locations[i]['floating_crane_id']+"'"+')"> <p>'+locations[i]['name']+'</p> </div>')
				    .addTo(map);

				    /*marker.on('click', function() { alert("hahaha");
					    alert(ev.latlng); // ev is an event object (MouseEvent in this case)
					});*/
				    //var google = window.google.maps;

				}

				
				
			} else {
				title = '<div class="text-center" style="padding-top:20px;padding-bottom:10px;"><i class="fa fa-exclamation-circle fa-5x" style="color:red"></i></div>';
				btn = '<br/><button class="btn blue" data-dismiss="modal">OK</button>';
				msg = '<p>Gagal peroleh data.</p>';
				var dialog = bootbox.dialog({
					message: title+'<center>'+msg+btn+'</center>'
				});
				if(response.status){
					setTimeout(function(){
						dialog.modal('hide');
					}, 1500);
				}
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


function getDetail(idfc){

	var getUrl = window.location;
	var baseUrl = getUrl .protocol + "//" + getUrl.host + "/" + getUrl.pathname.split('/')[1];

	//alert(getUrl);
	/*$('span.title_maps').html(loc);
	$('#modal-detail').modal('show');*/

	var link = document.createElement("a")
  	//link.href = ''+baseUrl+'/dashboard/dashboard_detail_menu?id='+idfc+'&orderid=0'
  	link.href = ''+baseUrl+'/dashboard_detail_menu?id='+idfc+'&orderid=0'
  	link.target = "_blank"
  	link.click()

}

function getDetailnew(){
	var idfc = $("#hdnfloating_crane").val();

	if(idfc == ''){
	   	alert("Choose Floating Crane");
	}else{
		var getUrl = window.location;
		var baseUrl = getUrl .protocol + "//" + getUrl.host + "/" + getUrl.pathname.split('/')[1];

		//alert(getUrl);
		/*$('span.title_maps').html(loc);
		$('#modal-detail').modal('show');*/

		var link = document.createElement("a")
	  	//link.href = ''+baseUrl+'/dashboard/dashboard_detail_menu?id='+idfc+'&orderid=0'
	  	link.href = ''+baseUrl+'/dashboard_detail_menu?id='+idfc+'&orderid=0'
	  	link.target = "_blank"
	  	link.click()
	}	
	
	
}

function listFC(){

	$.ajax({
		type: "POST",
        	url : module_path+'/get_listFC',
		data: { },
		cache: false,		
	        dataType: "JSON",
	        success: function(data)
	        { 
			if(data != false){ 
				 
				$('div#listboxFC').html(data);

			} else {
				alert('No Floating Crane');
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
	document.getElementById("listboxFC").innerHTML += "<br>Appended content.";

}

function getCctv(id){
	
	if(id == ''){
	   	alert("Click Floating Crane");
	}else{
		var getUrl = window.location;
		var baseUrl = getUrl .protocol + "//" + getUrl.host + "/" + getUrl.pathname.split('/')[1];

		//alert(getUrl);
		/*$('span.title_maps').html(loc);
		$('#modal-detail').modal('show');*/

		var link = document.createElement("a")
	  	//link.href = ''+baseUrl+'/dashboard/dashboard_detail_menu?id='+idfc+'&orderid=0'
	  	link.href = ''+baseUrl+'/dashboard_menu?id='+id+''
	  	link.target = "_blank"
	  	link.click()
	}
}



function getStream(idfc){
	

	$.ajax({
		type: "POST",
    		url : module_path+'/get_cctv',
		data: { idfc: idfc},
		cache: false,		
	        dataType: "JSON",
	        success: function(data)
	        { 
	        	var table = document.getElementById('videoTableDS2');
	      		table.innerHTML = ''; // removes all rows (tr)

			if(data != false){ 
					
				$('span#fc_name').html(data[0].floating_crane_name);
				$('#hdnfloating_crane').val(data[0].floating_crane_id);
				
				

			      	var videoTable = document.getElementById('videoTableDS2');
		            	let tr = document.createElement('tr');
		            	videoTable.appendChild(tr);
	            		for(i=0; i<data.length; i++){ 
                
	                		if (i > 0 && i % 4 === 0) {
		                  		tr = document.createElement('tr');  // new row after every 4 cells
		                  		videoTable.appendChild(tr);
		                	}

	              
			                var cell = document.createElement('td');
			                cell.style.backgroundColor = '#f0f0f0'; // example style

			                var video = document.createElement('video');
			                video.setAttribute('width', '300');
			                video.setAttribute('height', '230');
			                video.setAttribute('controls', '');
			                video.id = "myVideoDS2"+i;  // optional, for future reference


	               

			                cell.appendChild(video);
			                tr.appendChild(cell);

			                var streamUrl = data[i].embed;

			                if (Hls.isSupported()) {
			                    var hls = new Hls();
			                    hls.loadSource(streamUrl);
			                    hls.attachMedia(video);
			                    hls.on(Hls.Events.MANIFEST_PARSED, function () {
			                      
			                      video.play().catch((error) => {
			                        console.log("Autoplay failed:", error);
			                      });
			                    });
			                } else if (video.canPlayType('application/vnd.apple.mpegurl')) {
			                    video.src = streamUrl;
			                    video.addEventListener('loadedmetadata', function () {
			                      video.play();
			                    });
			                }

			                video.muted = true;
			                video.autoplay = true;

		          	}
						
			} 
			else {
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








<?php } ?>
</script>