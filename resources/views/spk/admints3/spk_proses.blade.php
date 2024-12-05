<div class="modal fade" id="Proses<?php echo $dt->spk_seq ?>"  role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-xl">
		<div class="modal-content">
				<div class="modal-header">
	
				<h4 class="modal-title mr-4" id="myModalLabel">Proses <?php echo $dt->spk_no ?></h4>
				
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
					<div class="modal-body">
		
						<form action="{{ route('spk-proses') }}" enctype="multipart/form-data" method="post" accept-charset="utf-8">
							{{ csrf_field() }}
							
							<input type="hidden" name="spk_seq" value="<?php echo $dt->spk_seq ?>">

							<div class="form-group row">
								<label class="col-sm-3 control-label text-right">Tanggal Proses</label>
								<div class="col-sm-9">
									<input type="text" name="tanggal_proses" class="form-control tanggal" placeholder="Tanggal Proses" value="<?php if(isset($_POST['tanggal_proses'])) { echo old('tanggal_proses'); }else{ echo date('Y-m-d'); } ?>" data-date-format="yyyy-mm-dd">	
								</div>
							</div>
		

							<div class="form-group row">
								<label class="col-sm-3 control-label text-right">Remark</label>
								<div class="col-sm-9">
									<textarea name="remark" class="form-control" id="remark" placeholder="Remark">{{ old('remark') }}</textarea>
			
								</div>
							</div>

							<div class="form-group row">
								<label class="col-sm-3 control-label text-right"></label>
								<div class="col-sm-9">
									<div class="form-group pull-right btn-group">
										<input type="submit" name="submit" class="btn btn-primary " value="Simpan Data">
										<input type="reset" name="reset" class="btn btn-success " value="Reset">
										<button type="button" class="btn btn-danger " data-dismiss="modal">Close</button>
									</div>
								</div>
								<div class="clearfix"></div>
							</div>
		
						</form>                                       
				
		
					</div>
		</div>
	</div>
</div>