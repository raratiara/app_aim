
 	<link rel="stylesheet" href="https://unpkg.com/leaflet@1.0.3/dist/leaflet.css" />
	<script src="https://unpkg.com/leaflet@1.0.3/dist/leaflet.js"></script>


	<!-- <div id='map' style="width: 100%; height: 600px;"></div>  -->


	<!-- Tombol toggle -->
	<div class="toggle-button" onclick="toggleVideos()">Sembunyikan Video</div>

	<!-- Info box -->
	<div class="info-box" id="infoBox">
	  <img src="https://aim.sandboxxplore.com/public/assets/images/crane.png" alt="Floating Crane" style="width:50px">
	  <h4>FC Avant Grade</h4>
	  <button type="button" class="btn btn-primary" onclick="getDetailnew()">Dashboard</button>
	  <!-- <p>Live View: Jalan M.H. Thamrin, Jakarta</p> -->
	</div>

	<!-- Peta -->
	<div id="map" style="height: 70vh; width: 100%;"></div>

	<!-- Video container -->
	<div class="video-container" id="videoContainer">
	  <video id="video1" controls muted></video>
	  <video id="video2" controls muted></video>
	  <video id="video3" controls muted></video>
	</div>


	<div>
		<button type="button-primary" id="refreshButton" class="btn btn-demo" data-toggle="modal" data-target="#myModal2">
			<i class="fa fa-bars" aria-hidden="true"></i>
		</button>
	</div>


	 <!-- <div class="container demo">
		
		<div class="modal right fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2">
			<div class="modal-dialog" role="document">
				<div class="modal-content">

					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" id="myModalLabel2">Select Floating Crane</h4>
					</div>

					<div class="modal-body">
						<div class="row">
							<div class="col-md-12 col-sm-12">
								<div class="form-group">
									<label class="col-md-12 control-label no-padding-right">Floating Crane Loc</label>
								</div>
							</div>
							<div class="col-md-12 col-sm-12">
								<div class="form-group">
									<div class="col-md-12">
										<?=$selfloatcrane?>
										<input type="hidden" id="hdnfloating_crane" name="hdnfloating_crane">
									</div>
								</div>
							</div>
							<div class="col-md-12 col-sm-12" style="margin-top:10px">
								<div class="form-group">
									<div class="col-md-12">
										<button type="button" class="btn btn-primary" onclick="getDetailnew()">Dashboard</button>
									</div>
								</div>
								
							</div>
						</div>
					</div>

				</div>
				
			</div>
			
		</div>
		
	</div>  -->





	 <div class="container demo">
		
		<div class="modal right fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2">
			<div class="modal-dialog" role="document">
				<div class="modal-content">

					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" id="myModalLabel2">List of Floating Crane</h4>
					</div>

					<div class="modal-body">
						<div class="row">
							<div class="col-md-12 col-sm-12">
								<div class="form-group">
									<span style="color:red">Click the Floating Crane</span>

								</div>
							</div>
							<div id="listboxFC" class="col-md-12 col-sm-12">
								
							</div>
							<!-- <div class="col-md-12 col-sm-12" style="margin-top:10px">
								<div class="form-group">
									<div class="col-md-12">
										<button type="button" class="btn btn-primary" onclick="getDetailnew()">Dashboard</button>
									</div>
								</div>
								
							</div> -->
						</div>
					</div>

				</div>
				
			</div>
			
		</div>
		
	</div> 






	<div class="modal fade" id="modalCCTV" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
	  <div class="modal-dialog">
	    <div class="modal-content" id="modal-contentcctv" style="width:1000px; height:400px; margin-left:-180px">
	      <div class="modal-header">
	        <h5 class="modal-title" id="modalLabel"><span id="fc_name"></span></h5>
	       <!--  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
	      </div>
	      <div class="modal-body">
	      	<input type="hidden" id="hdnfloating_crane" name="hdnfloating_crane">
	        <div id="videoContainerDS2">
				<table id="videoTableDS2">
				  <!-- <tr id="videoRow"></tr> -->
				</table>
			</div>
	      </div>
	      <div class="modal-footer">
	        <!-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> -->
	        <button type="button" class="btn btn-primary" onclick="getDetailnew()">Dashboard</button>
	      </div>
	    </div>
	  </div>
	</div>
	
	




	

	


	

	



		
	


	 




