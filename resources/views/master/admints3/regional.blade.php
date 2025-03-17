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
  @include('master/admints3/regional_tambah')
</p>
<form id="delete-form" class="form-confirm" action="{{ route('regional-proses') }}" method="post" accept-charset="utf-8">
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
    <a href="{{ route('regional-export') }}" class="btn btn-success">       
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
        <th width="25%">Client</th>
        <th width="25%">Regional</th>    
        <th width="25%">PIC Regional</th>   
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
                    url:"{{  url('get-regional') }}",
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
                    {
                        name: 'client_name',
                        data: 'client_name'
                    },
                    {
                        name: 'regional',
                        data: 'regional'
                    },
                    {
                        name: 'pic_regional',
                        data: 'pic_regional'
                    },
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