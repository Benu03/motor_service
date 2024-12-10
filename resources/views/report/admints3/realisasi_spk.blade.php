@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ asset('admin-ts3/report/proses') }}" method="post" accept-charset="utf-8">
{{ csrf_field() }}
<div class="row">


  
   <div class="col-md-12">
        
            
        
            
				<div class="form-group row">
				
					<div class="col-sm-3">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                 From <i class="far fa-calendar-alt ml-2"></i>
                                </span>
                            </div>
                            
                            <input type="text" name="from_date" id="from_date" class="form-control tanggal" placeholder="From Date" value="" data-date-format="yyyy-mm-dd">	
                            </div> 
					</div>
                    <div class="col-sm-3">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                 To <i class="far fa-calendar-alt ml-2"></i>
                                </span>
                            </div>
                            <input type="text" name="to_date"  id="to_date" class="form-control tanggal" placeholder="To Date" value="" data-date-format="yyyy-mm-dd">	
                            </div> 
					</div>



                    <div class="col-sm-2">
						<div class="form-group pull-right btn-group">
                            <button type="button" name="filter" id="filter" class="btn btn-primary" value="Filter Data">
                                <i class="fas fa-filter"></i> Filter Data
                              </button>
                            <button type="button" name="refresh"  id="refresh" class="btn btn-warning " value="Refresh">
                                <i class="fas fa-sync-alt"></i> Refresh
                              </button>
    
						</div>
					</div>

                    <div class="col-sm-4 text-right">

                    <button type="button" name="export-pdf" id="export-pdf" class="btn btn-danger" value="Export Data">
                            <i class="far fa-file-pdf"></i> PDF 
                          </button>
                   
                        <button type="button" name="export" id="export-xlsx" class="btn btn-success" value="Export Data">
                            <i class="far fa-file-excel"></i> XLSX 
                          </button>
                 
                    </div>

                   
				</div>
                <div class="form-group row">

                    <div class="col-sm-4">
                        <label for="email" class="mr-sm-2">SPK No </label>
                        <input name="spkno" id="spkno" class="form-control mb-2 mr-sm-2" placeholder="SPK No">
                   
                    </div>

                    <div class="col-sm-4">
                        <label for="regional" class="mr-sm-2">Regional </label>
                        <select name="regional" id="regional" class="form-control select2" style="width: calc(100% + 1px); border-top-left-radius: 0; border-bottom-left-radius: 0;">
                                <option value='pilih' selected disabled>Pilih</option>
                                <?php foreach($regional as $rg) { ?>
                                    <option value="<?php echo $rg->regional ?>"><?php echo $rg->regional_slug ?></option>
                                <?php } ?>
                            </select>
                   
                    </div>
                 
                </div>


                <div class="clearfix"></div>

               
  
    </div> 

</div>

<div class="clearfix"><hr></div>
<div class="table-responsive mailbox-messages">
    <div class="table-responsive mailbox-messages">
<table id="dataTable" class="display table table-bordered" cellspacing="0" width="100%" style="font-size: 12px;">
<thead>
    <tr class="bg-info">
        
        <th width="7%">Nopol</th>   
        <th width="7%">No Rangka</th>   
        <th width="7%">No Mesin</th>  
        <th width="8%">Regional</th>
        <th width="8%">Area</th>
        <th width="8%">Cabang</th> 
        <th width="7%">SPK No</th> 
        <th width="10%">Tanggal Service</th>    
        <th width="7%">Keterangan</th>    
    
</tr>
</thead>

</table>
</div>
</div>
</form>



<script type="text/javascript">
    $(document).ready(function() { 
       
        fetch_data()
        function fetch_data(from_date = '', to_date = '', spkno, regional){                    
                $('#dataTable').DataTable({
                    pageLength: 10,
                    lengthChange: true,
                    bFilter: true,
                    destroy: true,
                    processing: true,
                    serverSide: true,
                    order: [[3, 'desc']],
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
                        headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'},
                        url:"{{  url('admin-ts3/get-realisasi-spk') }}",
                        type: "POST",
                        data: function (d) {
                        d.from_date = from_date;
                        d.to_date = to_date;
                        d.spkno = spkno;
                        d.regional = regional;
                    }
                             
                    },
                    columns: [
          
                        {
                            name: 'nopol',
                            data: 'nopol'
                        },
                        {
                            name: 'norangka',
                            data: 'norangka'
                        },
                        {
                            name: 'nomesin',
                            data: 'nomesin'
                        },
                       
                        {
                            name: 'regional',
                            data: 'regional'
                        },
                        {
                            name: 'area',
                            data: 'area'
                        },
                        {
                            name: 'branch',
                            data: 'branch'
                        },
                        {
                            name: 'spk_no',
                            data: 'spk_no'
                        },
                        {
                            name: 'tanggal_service',
                            data: 'tanggal_service'
                        },
                        {
                            name: 'remark',
                            data: 'remark'
                        },
                
                      
                    ]
                });
            }  
            

            $('#filter').click(function(){
            var from_date = $('#from_date').val();
            var to_date = $('#to_date').val();
            var spkno = $('#spkno').val();
            var regional = $('#regional').val();

            console.log(regional);

            $('#dataTable').DataTable().destroy();
                fetch_data(from_date, to_date, spkno,regional);

        });

        $('#refresh').click(function(){
            $('#from_date').val('');
            $('#to_date').val('');
            $('#spkno').val('');
            $('#regional').val('pilih').trigger('change');
            $('#dataTable').DataTable().destroy();
            fetch_data();
        });

    
        
    });



</script>

<script>
       $('#export-pdf').click(function() {
    var from_date = $('#from_date').val();
    var to_date = $('#to_date').val();
    var spkno = $('#spkno').val();
    var regional = $('#regional').val();

    if (from_date !== '' || to_date !== '' || spkno !== '' || regional !== null) {
        var downloadButton = $('#export-pdf');
        downloadButton.html('<i class="fa fa-spinner fa-spin"></i> Downloading...');
        downloadButton.attr('disabled', true);
    } else {
        swal('Oops..', 'Filter belum diinput', 'warning');
        return; // Stop further execution if no filters are provided
    }

    $.ajax({
        headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'},
        url: "{{ url('admin-ts3/export-realisasi-spk-pdf') }}",
        type: "POST",
        data: {
            from_date: from_date,
            to_date: to_date,
            spkno: spkno,
            regional: regional
        },
        success: function(response) {
            if (response.pdf_base64) { // Pastikan server mengembalikan base64 string
                var base64PDF = response.pdf_base64;
                var linkSource = 'data:application/pdf;base64,' + base64PDF;
                var downloadLink = document.createElement('a');
                var fileName = 'Realisasi-SPK-' + new Date().toISOString().slice(0, 10) + '.pdf';
                
                downloadLink.href = linkSource;
                downloadLink.download = fileName;
                downloadLink.click();

                downloadButton.html('<i class="far fa-file-pdf"></i> PDF');
                downloadButton.attr('disabled', false);
            } else {
                swal('Oops..', 'Terjadi kesalahan saat memproses permintaan.', 'error');
            }
        },
        error: function(xhr, status, error) {
            console.error('Error:', error);
            swal('Oops..', 'Terjadi kesalahan saat memproses permintaan.', 'error');
            downloadButton.html('Export PDF');
            downloadButton.attr('disabled', false);
        }
    });
});


</script>

<script>
    $('#export-xlsx').click(function() {
    var from_date = $('#from_date').val();
    var to_date = $('#to_date').val();
    var spkno = $('#spkno').val();
    var regional = $('#regional').val();

    // Validasi input sama seperti di PDF
    if (from_date !== '' || to_date !== '' || spkno !== '' || regional !== null) {
        var downloadButton = $('#export-xlsx');
        downloadButton.html('<i class="far fa-file-excel"></i> Downloading...');
        downloadButton.attr('disabled', true);

        // Kirim permintaan POST ke server untuk generate XLSX
        $.ajax({
            headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'},
            url: "{{ url('admin-ts3/export-realisasi-spk-xlsx') }}",
            type: "POST",
            data: {
                from_date: from_date,
                to_date: to_date,
                spkno: spkno,
                regional: regional
            },
            success: function(response) {
                // Proses file base64 untuk di-download
                var link = document.createElement('a');
                link.href = 'data:application/vnd.openxmlformats-officedocument.spreadsheetml.sheet;base64,' + response.file;
                link.download = response.fileName;
                link.click();

                downloadButton.html('<i class="far fa-file-excel"></i> XLSX');
                downloadButton.attr('disabled', false);
            },
            error: function(xhr, status, error) {
                console.error('Error: ', error);
                swal('Oops..', 'Terjadi kesalahan saat memproses permintaan.', 'error');
                downloadButton.html('<i class="far fa-file-excel"></i> XLSX');
                downloadButton.attr('disabled', false);
            }
        });
    } else {
        swal('Oops..', 'Filter belum diinput', 'warning');
    }
});


</script>



