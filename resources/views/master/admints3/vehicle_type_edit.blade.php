@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ asset('admin-ts3/vehicle-type/proses-edit-vehicle-type') }}" enctype="multipart/form-data" method="post" accept-charset="utf-8">
{{ csrf_field() }}
<input type="hidden" name="id" value="<?php echo $vehicle_type->id ?>">

<div class="form-group row">
	<label class="col-sm-3 control-label text-right">Group</label>
	<div class="col-sm-9">
		<select name="group_vehicle" id="group_vehicle" class="form-control select2">
		
			<?php foreach($group_vehicle as $gv) { ?>
			  <option value="<?php echo $gv->value_1 ?>" <?php if($vehicle_type->group_vehicle==$gv->value_1) { echo 'selected'; } ?>><?php echo $gv->value_1 ?></option>
			<?php } ?>
		  </select>
	</div>
</div>


				<div class="form-group row">
					<label class="col-sm-3 control-label text-right">Type</label>
					<div class="col-sm-9">
						<input type="text" name="type" class="form-control" placeholder="Type" value="<?php echo $vehicle_type->type ?>" required>
					</div>
				</div>


				<div class="form-group row">
					<label class="col-sm-3 control-label text-right">Tahun</label>
					<div class="col-sm-9">
						<input type="text" name="tahun_pembuatan" class="form-control" placeholder="Tahun" value="<?php echo $vehicle_type->tahun_pembuatan ?>"  onkeypress="return isNumber(event)" required>
					</div>
				</div>

				<div class="form-group row">
					<label class="col-sm-3 control-label text-right">Deskripsi</label>
					<div class="col-sm-9">
						<textarea name="desc" id="address" class="form-control" id="desc" placeholder="Deskripsi"><?php echo $vehicle_type->desc ?></textarea>

					</div>
				</div>

<div class="form-group row">
	<label class="col-sm-3 control-label text-right"></label>
	<div class="col-sm-9">
		<div class="form-group pull-right btn-group">
			<input type="submit" name="submit" class="btn btn-primary " value="Simpan Data">
			<input type="reset" name="reset" class="btn btn-success " value="Reset">
			<a href="{{ asset('admin-ts3/vehicle-type') }}" class="btn btn-danger">Kembali</a>
		</div>
	</div>
	<div class="clearfix"></div>
</div>
</form>

