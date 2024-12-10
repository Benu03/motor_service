@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ asset('admin-ts3/branch/proses_edit') }}" enctype="multipart/form-data" method="post" accept-charset="utf-8">
{{ csrf_field() }}
<input type="hidden" name="id" value="<?php echo $branch->id ?>">
 
<div class="form-group row">
	<label class="col-sm-3 control-label text-right">Area</label>
	<div class="col-sm-9">
	
		<select name="mst_area_id" class="form-control select2">

			<?php foreach($area as $rg) { ?>
			  <option value="<?php echo $rg->id ?>" <?php if($branch->mst_area_id==$rg->id) { echo 'selected'; } ?>><?php echo $rg->area_slug ?></option>
			<?php } ?>
		  </select>

	</div>
</div>

<div class="form-group row">
	<label class="col-sm-3 control-label text-right">Branch</label>
	<div class="col-sm-9">
		<input type="text" name="branch" class="form-control" placeholder="branch" value="<?php echo $branch->branch ?>" required>
	</div>
</div>


<div class="form-group row">
	<label class="col-sm-3 control-label text-right">PIC Branch</label>
	<div class="col-sm-9">
		<select name="pic_branch" id="pic_branch" class="form-control select2">
			
			<?php foreach($userbranch as $ub) { ?>
			  <option value="<?php echo $ub->username ?>"  <?php if($branch->pic_branch==$ub->username) { echo 'selected'; } ?>><?php echo $ub->nama ?></option>
			<?php } ?>
		  </select>
	</div>
</div>

<div class="form-group row">
	<label class="col-sm-3 control-label text-right">Phone</label>
	<div class="col-sm-9">
		<input type="text" name="phone" class="form-control" placeholder="Phone" value="<?php echo $branch->phone ?>"  onkeypress="return isNumber(event)">
	</div>
</div>

<div class="form-group row">
	<label class="col-sm-3 control-label text-right">Address</label>
	<div class="col-sm-9">
		<textarea name="address" id="address" class="form-control" id="address" placeholder="Address"><?php echo $branch->address ?></textarea>

	</div>
</div>



<div class="form-group row">
	<label class="col-sm-3 control-label text-right"></label>
	<div class="col-sm-9">
		<div class="form-group pull-right btn-group">
			<input type="submit" name="submit" class="btn btn-primary " value="Simpan Data">
			<input type="reset" name="reset" class="btn btn-success " value="Reset">
			<a href="{{ asset('admin-ts3/branch') }}" class="btn btn-danger">Kembali</a>
		</div>
	</div>
	<div class="clearfix"></div>
</div>
</form>

