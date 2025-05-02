@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
{{-- <p>
  @include('admin-client/spk/tambah_upload')
</p> --}}
<form action="{{ asset('admin-client/report/proses') }}" method="post" accept-charset="utf-8">
{{ csrf_field() }}
<div class="row">


    {{-- <div class="btn-group">
      {{-- <button class="btn btn-danger" type="submit" name="hapus" onClick="check();" >
          <i class="fa fa-trash"></i>
      </button>  --}}
        {{-- <button type="button" class="btn btn-success " data-toggle="modal" data-target="#Tambah">
            <i class="fa fa-plus"></i> Tambah SPK Baru
        </button>
   </div>  --}}
   <div class="col-md-12">
        {{-- <div class="form-group">
            <label>Date range:</label>
            <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text">
                 <i class="far fa-calendar-alt"></i>
                </span>
            </div>
            <input type="text" class="form-control float-right" id="reservation">
            </div> --}}
            
        
            
				<div class="form-group row">
					<label class="col-sm-2 control-label text-left">Tanggal Transaksi</label>
					<div class="col-sm-3">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                 <i class="far fa-calendar-alt"></i>
                                </span>
                            </div>
                            <input type="text" class="form-control float-right" id="reservation">
                            </div> 
					</div>
                    <div class="col-sm-6">
						<div class="form-group pull-right btn-group">
							<input type="submit" name="submit" class="btn btn-primary " value="Filter Data">
							<input type="reset" name="reset" class="btn btn-success " value="Reset">
						</div>
					</div>
                    <div class="clearfix"></div>
				</div>

               
    {{-- </div>        --}}
</div> 

</div>

<div class="clearfix"><hr></div>
<div class="table-responsive mailbox-messages">
    <div class="table-responsive mailbox-messages">
<table id="example1" class="display table table-bordered" cellspacing="0" width="100%">
<thead>
    <tr class="bg-info">
        {{-- <th width="5%">
          <div class="mailbox-controls">
                <!-- Check all button -->
               <button type="button" class="btn btn-default btn-sm checkbox-toggle"><i class="far fa-square"></i>
                </button>
            </div>
        </th> --}}
        <th width="15%">SPK Nomor</th>
        <th width="15%">Jumlah Vehicle</th>   
        <th width="15%">Status</th> 
        <th width="15%">Amount</th>  
        <th width="15%">Tanggal Pengerjaan</th> 
        <th width="15%">User Post</th>    
        <th width="15%">Date Post</th>    
</tr>
</thead>
<tbody>
{{-- 
    {{-- <?php $i=1; foreach($area as $ar) { ?> --}}

    {{-- <td class="text-center">
        <div class="icheck-primary">
                  <input type="checkbox" class="icheckbox_flat-blue " name="id[]" value="<?php echo $ar->id ?>" id="check<?php echo $i ?>">
                   <label for="check<?php echo $i ?>"></label>
        </div> --}}
        {{-- <small class="text-center"><?php echo $i ?></small> --}}
    {{-- </td>
    <td><?php echo $ar->regional_slug ?></td>
    <td><?php echo $ar->area ?></td>
    <td>
        <div class="btn-group">
        <a href="{{ asset('admin-ts3/area/edit/'.$ar->id) }}" 
          class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></a>

          <a href="{{ asset('admin-ts3/area/delete/'.$ar->id) }}" class="btn btn-danger btn-sm  delete-link">
            <i class="fa fa-trash"></i></a>
        </div>

    </td>
</tr> --}}
{{-- 
<?php $i++; } ?>  --}}

</tbody>
</table>
</div>
</div>
</form>

<script>
    $('#reservation').daterangepicker()
</script>