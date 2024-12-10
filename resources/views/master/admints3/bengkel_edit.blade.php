@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ asset('admin-ts3/bengkel/proses_edit') }}" enctype="multipart/form-data" method="post" accept-charset="utf-8">
{{ csrf_field() }}
<input type="hidden" name="id" value="<?php echo $bengkel->id ?>">

<div class="form-group row">
	<label class="col-sm-3 control-label text-right">Bengkel</label>
	<div class="col-sm-9">
		<input type="text" name="bengkel_name" class="form-control" placeholder="Bengkel Name" value="<?php echo $bengkel->bengkel_name ?>" required>
	</div>
</div>

<div class="form-group row">
	<label class="col-sm-3 control-label text-right">Alias</label>
	<div class="col-sm-9">
		<input type="text" name="bengkel_alias" class="form-control" placeholder="Bengkel Alias" value="<?php echo $bengkel->bengkel_alias ?>" required readonly>
	</div>
</div>



<div class="form-group row">
	<label class="col-sm-3 control-label text-right">PIC Bengkel</label>
	<div class="col-sm-9">
	
		<select name="pic_bengkel" class="form-control select2">
			
			<?php foreach($userbengkel as $ub) { ?>
			  <option value="<?php echo $ub->username ?>" <?php if($bengkel->pic_bengkel==$ub->nama) { echo 'selected'; } ?>><?php echo $ub->nama ?></option>
			<?php } ?>
		  </select>

	</div>
</div>

<div class="form-group row">
	<label class="col-sm-3 control-label text-right">Phone</label>
	<div class="col-sm-9">
		<input type="text" name="phone" class="form-control" placeholder="Phone" value="<?php echo $bengkel->phone ?>" required>
	</div>
</div>

<div class="form-group row">
	<label class="col-sm-3 control-label text-right">Address</label>
	<div class="col-sm-9">
		<textarea name="address" id="address" class="form-control" id="address" placeholder="Address"><?php echo $bengkel->address ?></textarea>

	</div>
</div>


<div class="form-group row">
	<label class="col-sm-3 control-label text-right">Latitude</label>
	<div class="col-sm-9">
		<input type="text" name="latitude" class="form-control" placeholder="Latitude" value="<?php echo $bengkel->latitude ?>" required >
	</div>
</div>

<div class="form-group row">
	<label class="col-sm-3 control-label text-right">Longitude</label>
	<div class="col-sm-9">
		<input type="text" name="longitude" class="form-control" placeholder="Longitude" value="<?php echo $bengkel->longitude ?>" required >
	</div>
</div>




<div class="form-group row">
	<label class="col-sm-3 control-label text-right"></label>
	<div class="col-sm-9">
		<div class="form-group pull-right btn-group">
			<input type="submit" name="submit" class="btn btn-primary " value="Simpan Data">
			<input type="reset" name="reset" class="btn btn-success " value="Reset">
			<a href="{{ asset('admin-ts3/bengkel') }}" class="btn btn-danger">Kembali</a>
		</div>
	</div>
	<div class="clearfix"></div>
</div>
</form>

