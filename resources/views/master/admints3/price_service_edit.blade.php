@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ asset('admin-ts3/price-service/proses_edit') }}" enctype="multipart/form-data" method="post" accept-charset="utf-8">
{{ csrf_field() }}
<input type="hidden" name="id" value="<?php echo $price->id ?>">



<div class="form-group row">
	<label class="col-sm-3 control-label text-right">Kode</label>
	<div class="col-sm-9">
		<input type="text" name="kode" class="form-control" placeholder="Kode" value="<?php echo $price->kode ?>" readonly>
	</div>
</div>


<div class="form-group row">
	<label class="col-sm-3 control-label text-right">Name</label>
	<div class="col-sm-9">
		<input type="text" name="service_name" class="form-control" placeholder="Name" value="<?php echo $price->service_name ?>" required>
	</div>
</div>


<div class="form-group row">
	<label class="col-sm-3 control-label text-right">Price Bengkel To TS3</label>
	<div class="col-sm-9">
		<input type="text" name="price_bengkel_to_ts3" class="form-control" placeholder="Price Bengkel To TS3" value="<?php echo $price->price_bengkel_to_ts3 ?>"  onkeypress="return isNumber(event)" required>
	</div>
</div>


<div class="form-group row">
	<label class="col-sm-3 control-label text-right">Client</label>
	<div class="col-sm-9">
		<select name="mst_client_id" id="mst_client_id" class="form-control select2">
		
			<?php foreach($client as $cl) { ?>
			  <option value="<?php echo $cl->id ?>" <?php if($price->mst_client_id==$cl->id) { echo 'selected'; } ?> ><?php echo $cl->client_name ?></option>
			<?php } ?>
		  </select>
	</div>
</div>


<div class="form-group row">
	<label class="col-sm-3 control-label text-right">Price TS3 to Client</label>
	<div class="col-sm-9">
		<input type="text" name="price_ts3_to_client" class="form-control" placeholder="Price TS3 to Client" value="<?php echo $price->price_ts3_to_client ?>"  onkeypress="return isNumber(event)" required>
	</div>
</div>

	


<div class="form-group row">
	<label class="col-sm-3 control-label text-right">Regional</label>
	<div class="col-sm-9">

		<select name="mst_regional_id[]" id="mst_regional_id" class="form-control select2" multiple="multiple">
		
			<?php foreach($regional as $rg) { ?>
			  <option value="<?php echo $rg->id ?>" 
				<?php     
				$str = $price->regional_id;
				$delimiter = ',';
				$regional_id = explode($delimiter, $str);
				foreach ($regional_id as $rgg) {
						if($rgg==$rg->id) { echo 'selected'; } 
				}
				?>			
				><?php echo $rg->regional ?></option>
			<?php } ?>
		  </select>
	</div>
</div>


<div class="form-group row">
	<label class="col-sm-3 control-label text-right">Type</label>
	<div class="col-sm-9">
		<select name="price_service_type" id="price_service_type" class="form-control select2">
		
			<?php foreach($price_type as $pt) { ?>
			  <option value="<?php echo $pt->value_1 ?>"  <?php if($price->price_service_type==$pt->value_1) { echo 'selected'; } ?>><?php echo $pt->value_1 ?></option>
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
			<a href="{{ asset('admin-ts3/price-service') }}" class="btn btn-danger">Kembali</a>
		</div>
	</div>
	<div class="clearfix"></div>
</div>
</form>

