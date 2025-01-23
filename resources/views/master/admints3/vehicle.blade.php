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
@include('master/admints3/vehicle_tambah')
@include('master/admints3/vehicle_upload')
</p>
<form id="delete-form" class="form-confirm" action="{{ route('vehicle-proses') }}" method="post" accept-charset="utf-8">
{{ csrf_field() }}
<input type="hidden" name="hapus" value="1">
<div class="row">

<div class="col-md-8">
    <div class="btn-group">
        <button type="button" class="btn btn-danger btn-sweet-delete">
            <i class="fa fa-trash"></i> Hapus
        </button>
        <button type="button" class="btn btn-primary " data-toggle="modal" data-target="#Tambah">
            <i class="fa fa-plus"></i> Tambah Baru
        </button>
</div>
</div>
<div class="col-md-4 text-right">
    <button type="button" class="btn btn-secondary " data-toggle="modal" data-target="#upload">
        <i class="fas fa-file-upload"></i> Upload
    </button>
    <a href="{{ route('vehicle-export') }}" class="btn btn-success">       
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
        <th width="10%">Client</th>
        <th width="10%">Nopol</th>
        <th width="15%">No Rangka</th>
        <th width="15%">No Mesin</th>
        <th width="20%">Type</th>
        <th width="10%">Last Service</th>
        <th>ACTION</th>
</tr>
</thead>

</table>
</div>
</div>
</form>


<script type="text/javascript">

    $(document).ready(function() {
    fetch_data();

    function fetch_data() {
        $('#dataTable').DataTable({
            pageLength: 10,
            lengthChange: true,
            searching: true,
            destroy: true,
            processing: true,
            serverSide: true,
            language: {
                zeroRecords: "Tidak Ada Data",
                search: "Pencarian _INPUT_",
                lengthMenu: "_MENU_",
                info: "Menampilkan _START_ - _END_ dari _TOTAL_ data",
                infoEmpty: "0 data",
                paginate: {
                    next: "<i class='fa fa-angle-right'></i>",
                    previous: "<i class='fa fa-angle-left'></i>"
                }
            },
            ajax: {
                url: "{{  route('get-vehicle') }}",
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
                { name: 'client_name', data: 'client_name' },
                { name: 'nopol', data: 'nopol' },
                { name: 'norangka', data: 'norangka' },
                { name: 'nomesin', data: 'nomesin' },
                { name: 'type', data: 'type' },
                { name: 'tgl_last_service', data: 'tgl_last_service' },
                {
                    data: 'action',
                    name: 'action',
                    className: "text-center",
                    orderable: false,
                    searchable: false
                },
            ],
            // dom: 'Bfrtip',
            buttons: ['excel']
        });
    }
});

    </script>