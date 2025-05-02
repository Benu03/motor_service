<div class="modal fade" id="Detail<?php echo $dt->nopol ?>"  role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-xl">
		<div class="modal-content">
				<div class="modal-header">
	
				<h4 class="modal-title mr-4" id="myModalLabel">Detail Vehicle (<?php echo $dt->nopol ?>)</h4>
				
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
					<div class="modal-body">
		
             
						<div class="row mb-2">  
                                      
							<div class="col-md-4">
								<div class="card-body box-profile">
									<div class="text-center">
									  <img class="img img-thumbnail img-fluid" src="{{ asset('assets/upload/image/thumbs/motor.png') }}" >
									</div>
							
									<h3 class="profile-username text-center">{{ $dt->nopol }}</h3>


									<h3 class="profile-username text-center">{{ $dt->source }}</h3>

									@if ($dt->source == 'SPK UPLOAD')
										<h3 class="profile-username text-center">{{ $dt->spk_no }}</h3>
									 @endif

								  </div>
							</div>
							<div class="col-md-8">
							   <div class="card">
								   <div class="card-body">  
						 	<div class="table-responsive-md">
							 <table class="table table-bordered">
								 
								 <tbody>
								
					 
									 <tr>
										 <th>NO RANGKA</th>
										 <td>{{ $dt->norangka }}</td>
										</tr>
										<tr>
										 <th>NO MESIN</th>
										 <td>{{ $dt->nomesin }}</td>
										
									 </tr>
									<tr>
					 
									 <tr>
									   <th>Tahun Pembuatan</th>
									   <td>{{ $dt->tahun }}</td>
									</tr>
									<tr>
									   <th>Tipe</th>
									   <td>{{ $dt->type }}</td>
										
									 </tr>
									 <tr>
									   <th>Tanggal Last Service</th>
									   <td>{{ $dt->tgl_last_service }}</td>
									</tr>
									<tr>
										 <th>Status Service</th>
										 <td>{{ $dt->status_service }}</td>
									 </tr>
									 <tr>
										<th>Cabang</th>
										<td>{{ $dt->branch }}</td>
									</tr>
									<tr>
										  <th>PIC Cabang</th>
										  <td>{{ $dt->pic_branch }}</td>
									  </tr>

									  <tr>
										<th>Tanggal Schedule</th>
										<td>{{ $dt->tanggal_schedule }}</td>
									</tr>
									<tr>
										  <th>Tanggal Service</th>
										  <td>{{ $dt->tanggal_service }}</td>
									  </tr>
									  <tr>
										<th>Bengkel</th>
										<td>{{ $dt->bengkel_name }}</td>
									</tr>
									<tr>
										  <th>PIC Bengkel</th>
										  <td>{{ $dt->pic_bengkel }}</td>
									  </tr>

									  <tr>
										<th>Remark SPK</th>
										<td>{{ $dt->remark }}</td>
									</tr>
									<tr>
										  <th>Remark TS3</th>
										  <td>{{ $dt->remark_ts3 }}</td>
									  </tr>
								 </tbody>
							 </table>
						   </div> 
						   </div>
					   </div>
						 </div>           
					 </div>    
					 
                    </div>
		</div>
	</div>
</div>