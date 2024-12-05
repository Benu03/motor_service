<div class="modal fade" id="Detail<?php echo $dt->spk_seq ?>"  role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-xl">
		<div class="modal-content">
				<div class="modal-header">
	
				<h4 class="modal-title mr-4" id="myModalLabel">Detail SPK No (<?php echo $dt->spk_no ?>)</h4>
				
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
					<div class="modal-body">
		
                        <div class="row mb-2">  
                                      
                                 <div class="col-md-12">
                                    <div class="card">
                                        <div class="card-body">  
                              <div class="table-responsive-md">
                                  <table class="table table-bordered">
                                      
                                      <tbody>
                                          <tr>
                                              <th>Jumlah Kendaraan</th>
                                              <td>{{ $dt->count_vehicle }}</td>
                                              <th>Status</th>
                                              <td>{{ $dt->status }}</td>
                                          </tr>
                          
                                          <tr>
                                              <th>Tanggal Pengerjaan</th>
                                              <td>{{ $dt->tanggal_pengerjaan }}</td>
                                              <th>Tanggal Berlaku SPK Terakhir</th>
                                              <td>{{ $dt->tanggal_last_spk }}</td>
                                             
                                          </tr>
                          
                                          <tr>
                                            <th>User Upload</th>
                                            <td>{{ $dt->user_upload }}</td>
                                            <th>User Posting</th>
                                            <td>{{ $dt->user_posting }}</td>
                                             
                                          </tr>
                                          <tr>
                                            <th>Tanggal Upload</th>
                                            <td>{{ $dt->upload_date }}</td>
                                              <th>Tanggal Posting</th>
                                              <td>{{ $dt->posting_date }}</td>
                                          </tr>
                                      </tbody>
                                  </table>
                                </div> 
                                </div>
                            </div>
                              </div>           
                          </div>    
                          
                          <div class="row"> 
                            <div class="col-md-12 text-right">
                                        @if(isset($dt->nama_file))
                                        <a href="{{ asset('admin-ts3/spk-file/'.$dt->nama_file) }}"class="btn btn-secondary">
                                            <i class="far fa-file-excel"></i> Downlod File SPK
                                        </a>
                                        @endif
                                 
                                  </div>  
                            
                          </div>
				
		
					</div>
		</div>
	</div>
</div>