<p class="text-right">
	<a href="{{ asset('admin-ts3/vehicle/edit/'.$vehicle->id) }}" class="btn btn-warning btn-sm">
		<i class="fa fa-edit"></i> Edit
	</a>
	<a href="{{ asset('admin-ts3/vehicle') }}" class="btn btn-success btn-sm">
		<i class="fa fa-backward"></i> Kembali
	</a>
</p>
<hr>

<div class="row">
  <div class="col-md-3">
    <!-- Profile Image -->
    <div class="card card-primary card-outline">
      <div class="card-body box-profile">
        <div class="text-center">
          <img class="img img-thumbnail img-fluid" src="{{ asset('assets/upload/image/thumbs/motor.png') }}" >
        </div>

        <h3 class="profile-username text-center">{{ $vehicle->nopol }}</h3>
		<h3 class="profile-username text-center">{{ $vehicle->gambar_unit }}</h3>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
    </div>
    <div class="col-md-9">
    	<div class="card card-primary">
    	<div class="card-header">
                <h3 class="card-title">Detail Data Motor  {{  $vehicle->client_name }}</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
    	<table class="table table-bordered">
    		<thead>
    			<tr>
    				<th width="25%">Nopol</th>
    				<th>{{  $vehicle->nopol }}</th>
    			</tr>
    		</thead>
    		<tbody>
    			<tr>
    				<td>No Rangka</td>
    				<td>{{ $vehicle->norangka }}</td>
    			</tr>
    			<tr>
    				<td>No Mesin</td>
    				<td>{{ $vehicle->nomesin  }}</td>
    			</tr>
    			<tr>
    				<td>Type</td>
    				<td>{{ $vehicle->type }}</td>
    			</tr>
    			<tr>
    				<td>Tahun Pembuatan</td>
    				<td>{{ $vehicle->tahun_pembuatan }}</td>
    			</tr>
    			<tr>
    				<td>Tanggal Last Service</td>
    				<td>{{ $vehicle->tgl_last_service }}</td>
    			</tr>
    			
    			<tr>
    				<td>Create Date</td>
    				<td>{{ $vehicle->created_date }}</td>
    			</tr>
    			<tr>
    				<td>Create By</td>
    				<td>{{ $vehicle->create_by }}</td>
    			</tr>
    			<tr>
    				<td>Update Date</td>
    				<td>{{ $vehicle->updated_at }}</td>
    			</tr>
    			<tr>
    				<td>Update By</td>
    				<td>{{ $vehicle->update_by }}</td>
    			</tr>
				<tr>
    				<td>Remark</td>
    				<td>{{ $vehicle->remark }}</td>
    			</tr>
    		</tbody>
    	</table>
</div>
</div>
</div>
    </div>
</div>