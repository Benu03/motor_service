@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ asset('admin-ts3/vehicle/proses-edit') }}" enctype="multipart/form-data" method="post" accept-charset="utf-8">
{{ csrf_field() }}
<input type="hidden" name="id" value="<?php echo $vehicle->id ?>">

<div class="form-group row">
	<label class="col-sm-3 control-label text-right">Client</label>
	<div class="col-sm-9">
		<select name="mst_client_id" id="mst_client_id" class="form-control select2">
		
			<?php foreach($client as $cl) { ?>
			  <option value="<?php echo $cl->id ?>" <?php if($vehicle->mst_client_id==$cl->id) { echo 'selected'; } ?> ><?php echo $cl->client_name ?></option>
			<?php } ?>
		  </select>
	</div>
</div>

<div class="form-group row">
	<label class="col-sm-3 control-label text-right">Nopol</label>
	<div class="col-sm-9">
		<input type="text" name="nopol" class="form-control" placeholder="Nopol" value="<?php echo $vehicle->nopol ?>" required>
	</div>
</div>

<div class="form-group row">
	<label class="col-sm-3 control-label text-right">No Rangka</label>
	<div class="col-sm-9">
		<input type="text" name="norangka" class="form-control" placeholder="No Rangka" value="<?php echo $vehicle->norangka ?>" required>
	</div>
</div>

<div class="form-group row">
	<label class="col-sm-3 control-label text-right">No Mesin</label>
	<div class="col-sm-9">
		<input type="text" name="nomesin" class="form-control" placeholder="No Mesin" value="<?php echo $vehicle->nomesin ?>" required>
	</div>
</div>
<div class="form-group row">
	<label class="col-sm-3 control-label text-right">Type</label>
	<div class="col-sm-9">
		<select name="mst_vehicle_type_id" id="mst_vehicle_type_id" class="form-control select2">
			<?php foreach($vehicle_type as $vtt) { ?>
			  <option value="<?php echo $vtt->id ?>" <?php if($vehicle->mst_vehicle_type_id==$vtt->id) { echo 'selected'; } ?>><?php echo $vtt->type ?></option>
			<?php } ?>
		  </select>
	</div>
</div>

<div class="form-group row">
	<label class="col-sm-3 control-label text-right">Remark</label>
	<div class="col-sm-9">
		<textarea name="remark" class="form-control" id="remark" placeholder="Remark"><?php echo $vehicle->remark ?></textarea>

	</div>
</div>

<div class="form-group row">
	<label class="col-sm-3 control-label text-right"></label>
	<div class="col-sm-9">
		<div class="form-group pull-right btn-group">
			<input type="submit" name="submit" class="btn btn-primary " value="Simpan Data">
			<input type="reset" name="reset" class="btn btn-success " value="Reset">
			<a href="{{ asset('admin-ts3/vehicle') }}" class="btn btn-danger">Kembali</a>
		</div>
	</div>
	<div class="clearfix"></div>
</div>
</form>

