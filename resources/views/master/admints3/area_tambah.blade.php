
<div class="modal fade" id="Tambah"  role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">

				<h4 class="modal-title" id="myModalLabel">Tambah data?</h4>
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			</div>
			<div class="modal-body">
				<form action="{{ asset('admin-ts3/area/tambah') }}" enctype="multipart/form-data" method="post" accept-charset="utf-8">
				{{ csrf_field() }}
				
				<div class="form-group row">
					<label class="col-sm-3 control-label text-right">Regional</label>
					<div class="col-sm-9">
						<select name="mst_regional_id" id="mst_regional_id" class="form-control select2" width="100%">
							<option selected disabled>Pilih</option>
							<?php foreach($regional as $rg) { ?>
							  <option value="<?php echo $rg->id ?>"><?php echo $rg->regional_slug ?></option>
							<?php } ?>
						  </select>
					</div>
				</div>

				<div class="form-group row">
					<label class="col-sm-3 control-label text-right">Area</label>
					<div class="col-sm-9">
						<input type="text" name="area" class="form-control" placeholder="area" value="{{ old('area') }}" required>
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



