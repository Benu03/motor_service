<div class="modal fade" id="ProsesMappingDirect"  role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-xl">
		<div class="modal-content">
				<div class="modal-header">
	
				<h4 class="modal-title mr-4" id="myModalLabel">Service Direct Mapping</h4>
				
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
					<div class="modal-body">
		
														
							<div class="form-group row">
								<label class="col-sm-3 control-label text-right">Bengkel</label>
								<div class="col-sm-9">
									<select name="mst_bengkel_id" id="mst_bengkel_id" class="form-control select2" width="100%">
										
										<?php foreach($bengkel as $bk) { ?>
										  <option value="<?php echo $bk->id ?>"><?php echo $bk->bengkel_name ?></option>
										<?php } ?>
									  </select>
								</div>
							</div>


							<div class="form-group row">
								<label class="col-sm-3 control-label text-right">Remark</label>
								<div class="col-sm-9">
									<textarea name="remark_ts3" class="form-control" id="remark_ts3" placeholder="Remark">{{ old('remark_ts3') }}</textarea>
			
								</div>
							</div>
							


							<div class="form-group row">
								<label class="col-sm-3 control-label text-right"></label>
								<div class="col-sm-9">
									<div class="form-group pull-right btn-group">
										<input type="submit" name="submit" class="btn btn-primary " value="Proses Data">
										<input type="reset" name="reset" class="btn btn-success " value="Reset">
										<button type="button" class="btn btn-danger " data-dismiss="modal">Close</button>
									</div>
								</div>
								<div class="clearfix"></div>
							</div>


					   
                        </div>
		</div>
	</div>
</div>