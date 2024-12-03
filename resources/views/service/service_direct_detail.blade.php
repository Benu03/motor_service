<div class="modal fade" id="DetailDirect<?php echo $dt->id ?>"  role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-xl">
		<div class="modal-content">
				<div class="modal-header">
	
				<h4 class="modal-title mr-4" id="myModalLabel">Detail Direct Service (<?php echo $dt->nopol ?>)</h4>
				
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
					<div class="modal-body">
		
             
						<div class="row mb-2">  
                                      
							<div class="col-md-4">
								<div class="card-body box-profile">
									<div class="text-center">
										@if($dt->foto_kendaraan != NULL)
									  <img class="img img-thumbnail img-fluid" src="{{ asset('admin-ts3/service/get-image_direct/'.$dt->id) }}" >
									  @else
									  <img class="img img-thumbnail img-fluid" src="{{ asset('assets/upload/image/thumbs/motor.png') }}" >
									  @endif
									</div>
							
									<h3 class="profile-username text-center">{{ $dt->nopol }}</h3>


									<h3 class="profile-username text-center">{{ $dt->service_type_mvm }}</h3>

									{{-- @if ($dt->source == 'SPK UPLOAD')
										<h3 class="profile-username text-center">{{ $dt->spk_no }}</h3>
									 @endif --}}

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
										<th>Cabang</th>
										<td>{{ $dt->branch }}</td>
									</tr>
									<tr>
										  <th>PIC Cabang</th>
										  <td>{{ $dt->pic_branch }}</td>
									  </tr>
									  
							   <tr>
								<th>STATUS</th>
								<td>{{ $dt->status }}</td>
							   </tr>
							   <tr>
								<th>KM Kendaraan</th>
								<td>{{ $dt->km }}</td>
							   
							</tr>

							
							<tr>
							 <th>Tanggal Pengerjaan</th>
							 <td>{{ $dt->tanggal_pengerjaan }}</td>
							</tr>
							<tr>
							 <th>Jenis Pekerjaan</th>
							 <td>{{ $dt->jenis_pekerjaan }}</td>
							
							 </tr>

							 <tr>
								 <th>Nama Driver</th>
								 <td>{{ $dt->nama_driver }}</td>
								</tr>
								<tr>
								 <th>Kontak Driver</th>
								 <td>{{ $dt->kontak_driver }}</td>
								
								 </tr>

								 <tr>
									 <th>Keluhan</th>
									 <td>{{ $dt->keluhan }}</td>
									</tr>

									  
									 
								 </tbody> 
							 </table>

							 
						   </div> 
					
						   </div>
					   </div>
						 </div>           
					 </div>    



					 @if($dt->status == 'ESTIMATE')					 
					 @include('admin-ts3/service/estimate_detail') 
					
					@endif




					 
                    </div>
		</div>
	</div>
</div>