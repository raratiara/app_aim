
<!DOCTYPE html>
<html>
<head>
  <title>HLS Video Stream</title>
  <script src="https://cdn.jsdelivr.net/npm/hls.js@latest"></script>
</head>
<body>

<!-- <video id="video" width="640" height="360" controls></video>    -->
<!-- <video id="video1" width="300" height="230" controls></video>
<video id="video2" width="300" height="230" controls></video>
<video id="video3" width="300" height="230" controls></video> --><!-- 
<div id="videoContainer">lllll</div> -->

<script>
  /*var video1 = document.getElementById('video1');
  var videoSrc1 = 'https://streamingcctv.gerbangdata.co.id/hls/demo-fc-0.m3u8';

  if (Hls.isSupported()) {
    var hls1 = new Hls();
    hls1.loadSource(videoSrc1);
    hls1.attachMedia(video1);
    hls1.on(Hls.Events.MANIFEST_PARSED, function () {
      video1.play();
    });
  } else if (video1.canPlayType('application/vnd.apple.mpegurl')) {
    // For Safari (which natively supports HLS)
    video1.src = videoSrc1;
    video1.addEventListener('loadedmetadata', function () {
      video1.play();
    });
  }




  var video2 = document.getElementById('video2');
  var videoSrc2 = 'https://streamingcctv.gerbangdata.co.id/hls/demo-fc-1.m3u8';

  if (Hls.isSupported()) {
    var hls2 = new Hls();
    hls2.loadSource(videoSrc2);
    hls2.attachMedia(video2);
    hls2.on(Hls.Events.MANIFEST_PARSED, function () {
      video2.play();
    });
  } else if (video2.canPlayType('application/vnd.apple.mpegurl')) {
    // For Safari (which natively supports HLS)
    video2.src = videoSrc2;
    video2.addEventListener('loadedmetadata', function () {
      video2.play();
    });
  }



  var video3 = document.getElementById('video3');
  var videoSrc3 = 'https://streamingcctv.gerbangdata.co.id/hls/demo-fc-2.m3u8';

  if (Hls.isSupported()) {
    var hls3 = new Hls();
    hls3.loadSource(videoSrc3);
    hls3.attachMedia(video3);
    hls3.on(Hls.Events.MANIFEST_PARSED, function () {
      video3.play();
    });
  } else if (video3.canPlayType('application/vnd.apple.mpegurl')) {
    // For Safari (which natively supports HLS)
    video3.src = videoSrc3;
    video3.addEventListener('loadedmetadata', function () {
      video3.play();
    });
  }*/

</script>




</body>
</html>







<script type="text/javascript">
var module_path = "<?php echo base_url($folder_name);?>"; //for save method string
var myTable;
var validator;
var save_method; //for save method string
var idx; //for save index string
var ldx; //for save list index string


<?php if  (_USER_ACCESS_LEVEL_VIEW == "1") { ?>


$(document).ready(function() {
   getCctv('all', '');

   	
});


function cari(){

	var floating_crane = $("#floating_crane option:selected").val();
	var jmlcctv = document.getElementById("txtjmlcctv").value;

	
	
	getCctv(floating_crane, jmlcctv);
}

function getCctv(floating_crane, jmlcctv){
	

	$.ajax({
		type: "POST",
        url : module_path+'/get_cctv',
		data: { floating_crane: floating_crane, jmlcctv: jmlcctv },
		cache: false,		
        dataType: "JSON",
        success: function(data)
        { 
            /*var container = document.getElementById('videoContainer');
            container.innerHTML = ''; // removes all children including videos*/
            const table = document.getElementById('videoTable');
            table.innerHTML = ''; // removes all rows (tr)

    
			if(data != false){ 			
				//$('span.tblCctv').html(data);

                var videoTable = document.getElementById('videoTable');
                let tr = document.createElement('tr');
                videoTable.appendChild(tr);
                for(i=0; i<data.length; i++){ 
                    
                    if (i > 0 && i % 4 === 0) {
                      tr = document.createElement('tr');  // new row after every 4 cells
                      videoTable.appendChild(tr);
                    }

                    //const td = document.createElement('td');



                    // Get the row where we want to insert the video cell
                    //var row = document.getElementById('videoRow');

                    // Create a new table cell
                    var cell = document.createElement('td');
                    cell.style.backgroundColor = '#f0f0f0'; // example style

                    var video = document.createElement('video');
                    video.setAttribute('width', '300');
                    video.setAttribute('height', '230');
                    video.setAttribute('controls', '');
                    video.id = "myVideo"+i;  // optional, for future reference


                    // Optional: autoplay or loop
                    //video.autoplay = true;
                    // video.loop = true;
                    //document.getElementById('videoContainer').appendChild(video);
                     // Append the video to the cell
                      //cell.appendChild(video);

                      // Append the cell to the row
                      //row.appendChild(cell);
                    //video.play();
                    //video.autoplay = true;

                    cell.appendChild(video);
                    tr.appendChild(cell);

                    var streamUrl = data[i].embed;

                    if (Hls.isSupported()) {
                        var hls = new Hls();
                        hls.loadSource(streamUrl);
                        hls.attachMedia(video);
                        hls.on(Hls.Events.MANIFEST_PARSED, function () {
                          //video.play();
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