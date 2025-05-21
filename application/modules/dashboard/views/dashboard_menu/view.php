
 	<link rel="stylesheet" href="https://unpkg.com/leaflet@1.0.3/dist/leaflet.css" />
	<script src="https://unpkg.com/leaflet@1.0.3/dist/leaflet.js"></script>


	<div id='map' style="width: 100%; height: 600px;"></div> 

	<div>
		<button type="button-primary" id="refreshButton" class="btn btn-demo" data-toggle="modal" data-target="#myModal2">
			<i class="fa fa-bars" aria-hidden="true"></i>
		</button>
	</div>


	 <div class="container demo">
		
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
		
	</div> 





	<!-- <div class="container demo">
		
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
		
	</div> -->
	
	




	

	


	

	



		
	


	 




