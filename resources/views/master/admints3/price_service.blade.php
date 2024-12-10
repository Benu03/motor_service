@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<p>
  @include('master/admints3/price_service_tambah')
</p>
<form action="{{ asset('admin-ts3/price-service/proses') }}" method="post" accept-charset="utf-8">
{{ csrf_field() }}
<div class="row">

  <div class="col-md-8">
    <div class="btn-group">
      <button class="btn btn-danger" type="submit" name="hapus" onClick="check();" >
          <i class="fa fa-trash"></i>
      </button> 
        <button type="button" class="btn btn-primary " data-toggle="modal" data-target="#Tambah">
            <i class="fa fa-plus"></i> Tambah Baru
        </button>
   </div>
    </div>

    <div class="col-md-4 text-right">
        <a href="{{ asset('admin-ts3/export/price-service') }}" class="btn btn-success">       
            <i class="fas fa-file-excel"></i> Export Excel
        </a>
    </div>


</div>

<div class="clearfix"><hr></div>
<div class="table-responsive mailbox-messages">
    <div class="table-responsive mailbox-messages">
<table id="dataTable" class="display table table-bordered" cellspacing="0" width="100%">
<thead>
    <tr class="bg-info">
        <th width="5%">
          <div class="mailbox-controls">
                <!-- Check all button -->
               <button type="button" class="btn btn-default btn-sm checkbox-toggle"><i class="far fa-square"></i>
                </button>
            </div>
        </th>
        <th width="10%">Kode</th>
        <th width="25%">Name</th>
        <th width="12%">Price Bengkel to TS3</th>
        <th width="10%">Client</th>
        <th width="12%">Price TS3 to Client</th>
        <th width="25%">Regional</th>
        <th width="25%">Type</th>
       
        <th>ACTION</th>
</tr>
</thead>

</table>
</div>
</div>
</form>




<script type="text/javascript">
    $(document).ready(function() { 
        fetch_data()
        function fetch_data(){                    
                $('#dataTable').DataTable({
                    pageLength: 10,
                    lengthChange: true,
                    bFilter: true,
                    destroy: true,
                    processing: true,
                    serverSide: true,
                    oLanguage: {
                        sZeroRecords: "Tidak Ada Data",
                        sSearch: "Pencarian _INPUT_",
                        sLengthMenu: "_MENU_",
                        sInfo: "Menampilkan _START_ - _END_ dari _TOTAL_ data",
                        sInfoEmpty: "0 data",
                        oPaginate: {
                            sNext: "<i class='fa fa-angle-right'></i>",
                            sPrevious: "<i class='fa fa-angle-left'></i>"
                        }
                    },
                    ajax: {
                        url:"{{  asset('admin-ts3/get-price-service') }}",
                        type: "GET"
                             
                    },
                    columns: [
                        { 
                            data: 'check', 
                            name: 'check', 
                            className: "text-center",
                            orderable: false, 
                            searchable: false
                        },
                        { name: 'kode', data: 'kode' },
                        { name: 'service_name', data: 'service_name' },
                        { name: 'price_bengkel_to_ts3', data: 'price_bengkel_to_ts3' },
                        { name: 'client_name', data: 'client_name' },
                        { name: 'price_ts3_to_client', data: 'price_ts3_to_client' },
                        { name: 'regional', data: 'regional' },
                        { name: 'price_service_type', data: 'price_service_type' },
                        {
                            data: 'action', 
                            name: 'action', 
                            className: "text-center",
                            orderable: false, 
                            searchable: false
                           
                        },
                    ]
                });
            }         
    });
    </script>