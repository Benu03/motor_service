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
@include('master/admints3/vehicle_type_tambah')
</p>
<form  id="delete-form" class="form-confirm" action="{{ route('vehicle-type-process') }}" method="POST" accept-charset="utf-8">
{{ csrf_field() }}
<input type="hidden" name="hapus" value="1">
<div class="row">

<div class="col-md-12">
    <div class="btn-group">
        <button type="button" class="btn btn-danger btn-sweet-delete">
            <i class="fa fa-trash"></i> Hapus
        </button>
        <button type="button" class="btn btn-success " data-toggle="modal" data-target="#Tambah_vehicle_type">
            <i class="fa fa-plus"></i> Tambah Baru
        </button>
</div>
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
            <button type="button" class="btn btn-default btn-sm checkbox-toggle"><i class="far fa-square"></i>
                </button>
            </div>
        </th>
        <th width="15%" class="text-center">Group</th>
        <th width="45%" class="text-center">Type</th>
        <th width="10%" class="text-center">Tahun</th>
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
                        url:"{{  route('get-vehicle-type') }}",
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
                        { name: 'group_vehicle', data: 'group_vehicle', className: "text-center", },
                        { name: 'type', data: 'type' },
                        { name: 'tahun_pembuatan', data: 'tahun_pembuatan', className: "text-center" },
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