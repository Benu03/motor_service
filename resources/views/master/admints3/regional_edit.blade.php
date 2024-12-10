@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ asset('admin-ts3/regional/proses_edit') }}" enctype="multipart/form-data" method="post" accept-charset="utf-8">
{{ csrf_field() }}
<input type="hidden" name="id" value="<?php echo $regional->id ?>">

<div class="form-group row">
	<label class="col-sm-3 control-label text-right">Client</label>
	<div class="col-sm-9">
	
		<select name="client" class="form-control select2">
			
			<?php foreach($client as $cl) { ?>
			  <option value="<?php echo $cl->id ?>" <?php if($regional->mst_client_id==$cl->id) { echo 'selected'; } ?>><?php echo $cl->client_name ?></option>
			<?php } ?>
		  </select>

	</div>
</div>

<div class="form-group row">
	<label class="col-sm-3 control-label text-right">Regional</label>
	<div class="col-sm-9">
		<input type="text" name="regional" class="form-control" placeholder="Regional" value="<?php echo $regional->regional ?>" required>
	</div>
</div>

<div class="form-group row">
	<label class="col-sm-3 control-label text-right">PIC Regional</label>
	<div class="col-sm-9">
		<select name="pic_regional" id="pic_regional" class="form-control select2">
			
			<?php foreach($userbranch as $ub) { ?>
			  <option value="<?php echo $ub->username ?>"  <?php if($regional->pic_regional==$ub->username) { echo 'selected'; } ?>><?php echo $ub->nama ?></option>
			<?php } ?>
		  </select>
	</div>
</div>


<div class="form-group row">
	<label class="col-sm-3 control-label text-right"></label>
	<div class="col-sm-9">
		<div class="form-group pull-right btn-group">
			<input type="submit" name="submit" class="btn btn-primary " value="Simpan Data">
			<input type="reset" name="reset" class="btn btn-success " value="Reset">
			<a href="{{ asset('admin-ts3/regional') }}" class="btn btn-danger">Kembali</a>
		</div>
	</div>
	<div class="clearfix"></div>
</div>
</form>

