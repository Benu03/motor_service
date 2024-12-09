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
  @include('pic/service/tambah_direct_service')
</p> --}}
<form action="{{ route('spk-service-proses') }}" enctype="multipart/form-data" method="post" accept-charset="utf-8">
    {{ csrf_field() }}
<div class="row">
    


    <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box mb-3" id="filter-plan">
            <span class="info-box-icon bg-secondary elevation-1"><i class="fas fa-tools"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">PLAN</span>
                <span class="info-box-number">{{ $countspkplan }}</span>
            </div>
        </div>
    </div>
    
    <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box mb-3" id="filter-on-schedule">
            <span class="info-box-icon bg-success elevation-1"><i class="fas fa-tools"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">ON SCHEDULE</span>
                <span class="info-box-number">{{ $countspkonchecldule }}</span>
            </div>
        </div>
    </div>
    
    <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box mb-3" id="filter-service">
            <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-tools"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">SERVICE</span>
                <span class="info-box-number">{{ $countspkservice }}</span>
            </div>
        </div>
    </div>
    
    <div class="col-12 col-sm-6 col-md-3 ml-auto d-flex justify-content-end align-items-center">
        <button id="refreshTable" class="btn btn-secondary"><i class="fas fa-sync-alt"></i> Refresh</button>
    </div>

    <input type="hidden" id="filter-status">
</div>

<div class="clearfix"><hr></div>


<div class="d-flex justify-content-between mb-2">
    <div>
        <button type="button" class="btn btn-warning" name="proses_service" onClick="check();" data-toggle="modal" data-target="#ProsesSpkService">
            <i class="fa fa-edit"></i> Proses Mapping Service
        </button>
        @include('spk/admints3/spk_service_proses')
    </div>

    <div>



        <button type="button" class="btn" style="background-color: #d240ff; color: white;" name="add_service"  data-toggle="modal" data-target="#AddService"> 
            <i class="fa fa-cart-plus"></i> Add Vehicle Service
</button>
        @include('spk/admints3/spk_service_add_extend')
    </div>
</div>


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
                    <th width="10%">Source</th>
                    <th width="7%">NOPOL</th>
                    <th width="10%">Tanggal last Service</th>   
                    <th width="12%">Cabang</th> 
                    <th width="10%">Status Service</th>  
                    <th width="15%">Tanggal Schedule</th> 
                    <th width="15%">Bengkel</th>    
                    <th width="15%">Tanggal Service</th> 
                    <th>ACTION</th>
            </tr>
            </thead>
      
            </table>

            <div class="modal fade " id="spkListdetail"  role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <div class="modal-header">

                        <h4 class="modal-title mr-4" id="myModalLabel">Detail SPK Service (<span id="nopol"></span>)</h4>
    
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                        <div class="modal-body">
            
                
                            <div class="row mb-2">  
                                        
                                <div class="col-md-4">
                                    <div class="card-body box-profile">
                                        <div class="text-center">
                                        <img class="img img-thumbnail img-fluid" src="{{ asset('assets/upload/image/thumbs/motor.png') }}" >
                                        </div>
                                
                                        <h3 class="profile-username text-center"><span id="nopol"></span></h3>


                                        <h3 class="profile-username text-center"><span id="source"></h3>

                                        {{-- @if ($row->source == '."SPK UPLOAD".') --}}
                                            <h3 class="profile-username text-center"><span id="spk_no"></h3>
                                        {{-- @endif --}}

                                    </div>
                                </div>
                                <div class="col-md-8">
                                <div class="card">
                                    <div class="card-body">  
                                <div class="table-responsive-md">
                                <table class="table table-bordered">
                                    
                                    <tbody>
                                    
                        
                                        <tr>
                                            <th>NO RANGKA</th>
                                            <td><span id="norangka"></td>
                                            </tr>
                                            <tr>
                                            <th>NO MESIN</th>
                                            <td><span id="nomesin"></td>
                                            
                                        </tr>
                                        <tr>
                        
                                        <tr>
                                        <th>Tahun Pembuatan</th>
                                        <td><span id="tahun"></td>
                                        </tr>
                                        <tr>
                                        <th>Tipe</th>
                                        <td><span id="type"></td>
                                            
                                        </tr>
                                        <tr>
                                        <th>Tanggal Last Service</th>
                                        <td><span id="tgl_last_service"></td>
                                        </tr>
                                        <tr>
                                            <th>Status Service</th>
                                            <td><span id="status_service"></td>
                                        </tr>
                                        <tr>
                                            <th>Cabang</th>
                                            <td><span id="branch"></td>
                                        </tr>
                                        <tr>
                                            <th>PIC Cabang</th>
                                            <td><span id="pic_branch"></td>
                                        </tr>

                                        <tr>
                                            <th>Tanggal Schedule</th>
                                            <td><span id="tanggal_schedule"></td>
                                        </tr>
                                        <tr>
                                            <th>Tanggal Service</th>
                                            <td><span id="tanggal_service"></td>
                                        </tr>
                                        <tr>
                                            <th>Bengkel</th>
                                            <td><span id="bengkel_name"></td>
                                        </tr>
                                        <tr>
                                            <th>PIC Bengkel</th>
                                            <td><span id="pic_bengkel"></td>
                                        </tr>

                                        <tr>
                                            <th>Remark SPK</th>
                                            <td><span id="remark"></td>
                                        </tr>
                                        <tr>
                                            <th>Remark TS3</th>
                                            <td><span id="remark_ts3"></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div> 
                            </div>
                        </div>
                            </div>           
                        </div>    
                        
                        </div>
            </div>
            </div>
            </div>

        </div>
</div>
</div>
</form>


<script type="text/javascript">
    $(document).ready(function() { 
        var table;  // Deklarasikan `table` sebagai variabel global

        fetch_data();

        // Fungsi untuk memuat DataTables
        function fetch_data(){                    
            table = $('#dataTable').DataTable({
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
                    url: "{{ route('get-spk-list-service') }}",
                    type: "GET",
                    data: function(d) {
          
                        d.status_service = $('#filter-status').val(); 
                    }
                },
                columns: [
                    { 
                        data: 'check', 
                        name: 'check', 
                        className: "text-center",
                        orderable: false, 
                        searchable: false
                    },
                    { name: 'source', data: 'source' },
                    { name: 'nopol', data: 'nopol' },
                    { name: 'tgl_last_service', data: 'tgl_last_service' },
                    { name: 'branch', data: 'branch' },
                    { name: 'status_service', data: 'status_service' },
                    { name: 'tanggal_schedule', data: 'tanggal_schedule' },
                    { name: 'bengkel_name', data: 'bengkel_name' },
                    { name: 'tanggal_service', data: 'tanggal_service' },
                    { 
                        data: 'action', 
                        name: 'action', 
                        className: "text-center",
                        orderable: false, 
                        searchable: false
                    }
                ]
            });
        }

        $('#filter-plan').click(function() {
            $('#filter-status').val('PLANING');  // Set filter status
            table.draw();  // Redraw table untuk menerapkan filter
        });

        // Klik filter On Schedule
        $('#filter-on-schedule').click(function() {
            $('#filter-status').val('ONSCHEDULE');  // Set filter status
            table.draw();  // Redraw table untuk menerapkan filter
        });

        // Klik filter Service
        $('#filter-service').click(function() {
            $('#filter-status').val('SERVICE');  // Set filter status
            table.draw();  // Redraw table untuk menerapkan filter
        });

        $('#refreshTable').click(function() {
            $('#filter-status').val('');  // Set filter status
            table.draw();  // Redraw table untuk menerapkan filter
        });


        // Edit button click event
        $('body').on('click', '.spklistdetail', function () {
            var id = $(this).data('id');
            $.get("{{ route('get-spk-list-service-detail') }}" + '/' + id, 
            function (data) {
                console.log(data);
                $('#nopol').text(data.nopol);
                $('#source').text(data.source === 'Group' ? data.source : '');
                $('#spk_no').text(data.spk_no);
                $('#norangka').text(data.norangka);
                $('#nomesin').text(data.nomesin);
                $('#tahun').text(data.tahun);
                $('#type').text(data.type);
                $('#tgl_last_service').text(data.tgl_last_service);
                $('#status_service').text(data.status_service);
                $('#branch').text(data.branch);
                $('#pic_branch').text(data.pic_branch);
                $('#tanggal_schedule').text(data.tanggal_schedule);
                $('#tanggal_service').text(data.tanggal_service);
                $('#bengkel_name').text(data.bengkel_name);
                $('#pic_bengkel').text(data.pic_bengkel);
                $('#remark').text(data.remark);
                $('#remark_ts3').text(data.remark_ts3);
                $('#spkListdetail').modal('show');
            });
        });
    });
</script>



