




	<div class="row mb-2">  
                                 
							<div class="col-md-4">
								<div class="card-body box-profile">
									<div class="text-center">
									  <img class="img img-thumbnail img-fluid" src="{{ asset('assets/upload/image/thumbs/motor.png') }}" >
									</div>
							
									<h3 class="profile-username text-center">{{ $ar->nopol }}</h3>

									<h3 class="profile-username text-center">{{ $ar->source }}</h3>

									@if ($ar->source == 'SPK UPLOAD')
										<h3 class="profile-username text-center">{{ $ar->spk_no }}</h3>
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
														<td>{{ $ar->norangka }}</td>
														</tr>
														<tr>
														<th>NO MESIN</th>
														<td>{{ $ar->nomesin }}</td>
														
													</tr>
													<tr>
									
													<tr>
													<th>Tahun Pembuatan</th>
													<td>{{ $ar->tahun }}</td>
													</tr>
													<tr>
													<th>Tipe</th>
													<td>{{ $ar->type }}</td>
														
													</tr>
													<tr>
													<th>Tanggal Last Service</th>
													<td>{{ $ar->tgl_last_service }}</td>
													</tr>
													<tr>
														<th>Status Service</th>
														<td>{{ $ar->status_service }}</td>
													</tr>
													<tr>
														<th>Cabang</th>
														<td>{{ $ar->branch }}</td>
													</tr>
													<tr>
														<th>PIC Cabang</th>
														<td>{{ $ar->pic_branch }}</td>
													</tr>

													<tr>
														<th>Tanggal Schedule</th>
														<td>{{ $ar->tanggal_schedule }}</td>
													</tr>
													<tr>
														<th>Tanggal Service</th>
														<td>{{ $ar->tanggal_service }}</td>
													</tr>
													<tr>
														<th>Bengkel</th>
														<td>{{ $ar->bengkel_name }}</td>
													</tr>
													<tr>
														<th>PIC Bengkel</th>
														<td>{{ $ar->pic_bengkel }}</td>
													</tr>

													<tr>
														<th>Remark SPK</th>
														<td>{{ $ar->remark }}</td>
													</tr>
													<tr>
														<th>Remark TS3</th>
														<td>{{ $ar->remark_ts3 }}</td>
													</tr>
												</tbody>
									 		</table>
						   				</div> 
						   			</div>
					  	 		</div>


								   <div class="row mb-2">  
									<div class="col-sm-12">
										<div class="card">  
											<div class="card-header">
											Service Detail
											</div>
												<div class="card-body">  
													<div class="table-responsive-md">
														<table class="table table-bordered table-sm" style="font-size: 12px;">
																<thead>
																<tr class="bg-light">                                                      
															
																	<th width="15%">Detail Action</th>   
																	<th width="15%">Attribute</th> 
																		<th width="15%">Value Attibute</th>                                                 
																</tr>
																</thead>
			
																<tbody>
																	<?php
																	use Illuminate\Support\Facades\DB;
																	$sdetail  = DB::connection('ts3')->table('mvm.v_service_detail_history')->where('id',$ar->mvm_service_vehicle_h_id)->get();
																	?>
																	<?php $i=1; foreach($sdetail as $sd) { ?>
																	<tr>
																	<td><?php echo $sd->detail_type ?></td>                                              
																	<td>
																	@if($sd->detail_type == 'Upload')
																										
																	<button type="button" class="btn btn-success btn-sm" onclick="showModal(<?php echo $sd->service_d_id ?>, '<?php echo $sd->attribute ?>', '<?php echo strtolower(pathinfo($sd->unique_data, PATHINFO_EXTENSION)) ?>')">
																		<i class="fa fa-eye"></i> <?php echo $sd->attribute ?>
																	</button> 
															   
																	 @include('admin-ts3/report/service_image_history') 
																	@else
																	<?php echo $sd->attribute ?>
																	@endif
																	</td>  
																	<td><?php echo $sd->value_data ?></td>  
															
																	</tr>
																	<?php $i++; } ?> 
																	</tbody>
														
															</table>
			
													</div>
												</div>           
											</div>   
			
			
											   
										</div>           
							</div>  

					  		</div> 

  
	</div>
  
  
  