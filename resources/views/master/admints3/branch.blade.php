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
  @include('master/admints3/branch_tambah')
  @include('master/admints3/branch_upload')
</p>
<form action="{{ url('branch-proses') }}" method="post" accept-charset="utf-8">
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
    <button type="button" class="btn btn-secondary " data-toggle="modal" data-target="#upload">
        <i class="fas fa-file-upload"></i> Upload
    </button>
    <a href="{{ url('branch-export') }}" class="btn btn-success">       
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
        <th width="15%">Area</th>
        <th width="15%">Branch</th>   
        <th width="15%">PIC Branch</th>    
        <th width="10%">Phone</th>   
        <th width="20%">Address</th>    
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
                        url:"{{  url('get-branch') }}",
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
                            name: 'area_slug',
                            data: 'area_slug'
                        },
                        {
                            name: 'branch',
                            data: 'branch'
                        },
                        {
                            name: 'pic_branch',
                            data: 'pic_branch'
                        },
                        {
                            name: 'phone',
                            data: 'phone'
                        },
                        {
                            name: 'address',
                            data: 'address'
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