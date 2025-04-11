
<link href="https://cdnjs.cloudflare.com/ajax/libs/video.js/8.10.0/video-js.min.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/video.js/8.10.0/video.min.js"></script>



<script type="text/javascript">

   document.addEventListener('livewire:initialized', function() {
       initializePlayer();
   });

   function initializePlayer() {
       let player = videojs('tesvid', {
           liveui: true,
           responsive: true,
           autoplay: true,
           muted: true,
           aspectRatio: '16:9',
           html5: {
               hls: {
                   enableLowInitialPlaylist: true,
                   smoothQualityChange: true,
                   overrideNative: true
               }
           }
       });

       // Store the player instance
       window.videoPlayers = window.videoPlayers || {};
       window.videoPlayers['tesvid'] = player;

       player.ready(function() {
           this.play().catch(function(error) {
               console.log("Autoplay failed:", error);
           });
       });

       // Handle visibility changes
       document.addEventListener('visibilitychange', function() {
           if (document.hidden) {
               player.pause();
           } else {
               player.play().catch(function(error) {
                   console.log("Resume playback failed:", error);
               });
           }
       });

       // Error handling and recovery
       player.on('error', function() {
           console.log('Video player error:', player.error());
           setTimeout(function() {
               player.reset();
               player.src({
                   type: 'application/x-mpegURL',
                   src: 'rtsp://admin:Nbid@2025!@172.10.11.7:554'
               });
               player.play().catch(function(error) {
                   console.log("Retry playback failed:", error);
               });
           }, 2000);
       });

       // Clean up on Livewire update
       Livewire.on('beforeDomUpdate', () => {
           const player = window.videoPlayers['tesvid'];
           if (player) {
               // Store the current time and playing state
               window.playerStates = window.playerStates || {};
               window.playerStates['tesvid'] = {
                   currentTime: player.currentTime(),
                   isPlaying: !player.paused()
               };
           }
       });

       // Restore player state after Livewire update
       Livewire.on('afterDomUpdate', () => {
           const player = window.videoPlayers['tesvid'];
           const state = window.playerStates?.['tesvid'];
           if (player && state) {
               player.currentTime(state.currentTime);
               if (state.isPlaying) {
                   player.play().catch(console.error);
               }
           }
       });
   }
</script>


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
	

	/*$.ajax({
		type: "POST",
        url : module_path+'/get_cctv',
		data: { floating_crane: floating_crane, jmlcctv: jmlcctv },
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
    });*/
}


<?php } ?>
</script>