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
				
					<div class="col-sm-2">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                 From <i class="far fa-calendar-alt ml-2"></i>
                                </span>
                            </div>
                            <input type="text" name="from_date" id="from_date" class="form-control tanggal" placeholder="From Date" value="" data-date-format="yyyy-mm-dd">	
                            </div> 
					</div>
                    <div class="col-sm-2">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                 To <i class="far fa-calendar-alt ml-2"></i>
                                </span>
                            </div>
                            <input type="text" name="to_date"  id="to_date" class="form-control tanggal" placeholder="To Date" value="" data-date-format="yyyy-mm-dd">	
                            </div> 
					</div>





                    <div class="col-sm-6">
						<div class="form-group pull-right btn-group">
                            <button type="button" name="filter" id="filter" class="btn btn-primary" value="Filter Data">
                                <i class="fas fa-filter"></i> Filter Data
                              </button>
                            <button type="button" name="refresh"  id="refresh" class="btn btn-warning " value="Refresh">
                                <i class="fas fa-sync-alt"></i> Refresh
                              </button>
    
						</div>
					</div>

                    <div class="col-sm-2 text-right">

                    <button type="button" name="export-pdf" id="export-pdf" class="btn btn-danger" value="Export Data">
                            <i class="far fa-file-pdf"></i> PDF 
                          </button>
                   
                        <button type="button" name="export" id="export" class="btn btn-success" value="Export Data">
                            <i class="far fa-file-excel"></i> XLSX 
                          </button>
                 
                    </div>

                   
				</div>
                <div class="form-group row">
                <div class="col-sm-4">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                 SPK No 
                                </span>
                            </div>
                            <input type="text" name="spkno"  id="spkno" class="form-control" placeholder="SPK No" value="" >
                               
					</div>

                </div>


                <div class="clearfix"></div>

               
    {{-- </div>        --}}
    </div> 

</div>

<div class="clearfix"><hr></div>
<div class="table-responsive mailbox-messages">
    <div class="table-responsive mailbox-messages">
<table id="dataTable" class="display table table-bordered" cellspacing="0" width="100%" style="font-size: 12px;">
<thead>
    <tr class="bg-info">
        {{-- <th width="5%">
          <div class="mailbox-controls">
                <!-- Check all button -->
               <button type="button" class="btn btn-default btn-sm checkbox-toggle"><i class="far fa-square"></i>
                </button>
            </div>
        </th> --}}
        <th width="12%">Service No</th>
        <th width="7%">SPK NO</th>   
        <th width="7%">Nopol</th>   
        <th width="7%">Status</th> 
        <th width="8%">Tanggal Service</th>
        <th width="8%">Regional</th>
        <th width="8%">Area</th>
        <th width="8%">Cabang</th> 
        <th width="7%">Last KM</th> 
        <th width="10%">Nama Driver</th>    
        <th width="7%">Bengkel</th>    
        <th width="8%">Mekanik</th>    
        <th width="5%">Action</th>    
</tr>
</thead>

</table>
</div>
</div>
</form>



<script type="text/javascript">
    $(document).ready(function() { 
        fetch_data()
        function fetch_data(from_date = '', to_date = '', spkno){                    
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
                        url:"{{  url('admin-ts3/get-history-service') }}",
                        type: "POST",
                        data: function (d) {
                        d.from_date = from_date;
                        d.to_date = to_date;
                        d.spkno = spkno;
                    }
                             
                    },
                    columns: [
                        { 
                            data: 'service_no', 
                            name: 'service_no', 
        
                        },
                        {
                            name: 'spk_no',
                            data: 'spk_no'
                        },
                        {
                            name: 'nopol',
                            data: 'nopol'
                        },
                        {
                            name: 'status_service',
                            data: 'status_service'
                        },
                        {
                            name: 'tanggal_service',
                            data: 'tanggal_service'
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
                            name: 'last_km',
                            data: 'last_km'
                        },
                        {
                            name: 'nama_driver',
                            data: 'nama_driver'
                        },
                        {
                            name: 'bengkel_name',
                            data: 'bengkel_name'
                        },
                        {
                            name: 'mekanik',
                            data: 'mekanik'
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
            

            $('#filter').click(function(){
            var from_date = $('#from_date').val();
            var to_date = $('#to_date').val();
            var spkno = $('#spkno').val();

            $('#dataTable').DataTable().destroy();
                fetch_data(from_date, to_date, spkno);

            // if(from_date != '' &&  to_date != ''){
            //     $('#dataTable').DataTable().destroy();
            //     fetch_data(from_date, to_date, spkno);
            // } else{
            //     swal('Oops..', 'Date Filter Belum Di input', 'warning');
            // }

        });

        $('#refresh').click(function(){
            $('#from_date').val('');
            $('#to_date').val('');
            $('#spkno').val('');
            $('#dataTable').DataTable().destroy();
            fetch_data();
        });

      





        $('#export').click(function(){
    var from_date = $('#from_date').val();
    var to_date = $('#to_date').val();
    var spkno = $('#spkno').val();

    if (from_date !== '' || to_date !== '' || spkno !== '') {
        // Tampilkan animasi pengunduhan
        var downloadButton = $('#export');
        downloadButton.text('Downloading...');
        downloadButton.attr('disabled', true);

        // Kirim permintaan AJAX ke kontroler Anda untuk mendapatkan data
        $.ajax({
            headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'},
            url: "{{ asset('admin-ts3/export-history-service') }}",
            type: "POST",
            data: {
                from_date: from_date,
                to_date: to_date,
                spkno: spkno
            },
            success: function(response) {
                // Mengubah nama kolom
                var data = response.data.map(item => {
                    return {
                        'No Mesin': item.nomesin,
                        'Tahun': item.tahun,
                        'Tipe': item.tipe,
                        'Status Service': item.status_service,
                        'Tanggal Service': item.tanggal_service,
                        // 'Nama Driver': item.nama_driver,
                        // 'Last KM': item.last_km,
                        // 'Bengkel': item.bengkel,
                        // 'Mekanik': item.mekanik,
                        'Tanggal Last Service': item.tgl_last_service,
                        // 'Regional': item.regional,
                        // 'Area': item.area,
                        // 'Cabang': item.cabang,
                        // 'PIC Cabang': item.pic_cabang,
                        // 'Tanggal Schedule': item.tanggal_schedule,
                        // 'Remark': item.remark
                    };
                });

                // Buat workbook dan worksheet
                var wb = XLSX.utils.book_new();
                var ws = XLSX.utils.json_to_sheet(data);

                // Menambahkan header "REALISASI SPK PERIOD from_date SAMPAI DENGAN to_date" di baris pertama dan membuatnya bold
                var headerText = `REALISASI SPK PERIOD ${from_date} SAMPAI DENGAN ${to_date}`;
                XLSX.utils.sheet_add_aoa(ws, [[headerText]], { origin: 'A1' });
                ws['A1'].s = { font: { bold: true } };

                // Menambahkan baris kosong di baris kedua
                XLSX.utils.sheet_add_aoa(ws, [[]], { origin: 'A2' });

                // Menambahkan nama kolom di baris ketiga
                XLSX.utils.sheet_add_aoa(ws, [
                    ['No Mesin', 'Tahun', 'Tipe', 'Status Service', 'Tanggal Service', 'Nama Driver', 'Last KM', 'Bengkel', 'Mekanik', 'Tanggal Last Service', 'Regional', 'Area', 'Cabang', 'PIC Cabang', 'Tanggal Schedule', 'Remark']
                ], { origin: 'A3' });

                // Menambahkan worksheet ke workbook
                XLSX.utils.book_append_sheet(wb, ws, 'Sheet1');

                // Buat objek Blob yang berisi data file Excel
                var blob = new Blob([new Uint8Array(XLSX.write(wb, { bookType: 'xlsx', type: 'array' }))], {
                    type: 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
                });

                // Animasi delay sebelum pengunduhan dimulai
                setTimeout(function() {
                    // Pengaktifan pengunduhan
                    downloadButton.html('<i class="far fa-file-excel"></i> Export');
                    downloadButton.attr('disabled', false);

                    // Trigger pengunduhan file Excel
                    var a = document.createElement('a');
                    a.href = URL.createObjectURL(blob);
                    a.download = 'History-Service.xlsx';
                    a.click();
                }, 1000); // Durasi animasi dalam milidetik
            },
            error: function() {
                swal('Oops..', 'Terjadi kesalahan saat memuat data.', 'error');
                // Mengembalikan tombol ke keadaan semula jika terjadi kesalahan
                downloadButton.html('<i class="far fa-file-excel"></i> Export');
                downloadButton.attr('disabled', false);
            }
        });
    } else {
        swal('Oops..', 'Filter Belum Di input', 'warning');
    }
});

        
    });



    </script>

<script>
$('#export-pdf').click(function(){
    var from_date = $('#from_date').val();
    var to_date = $('#to_date').val();
    var spkno = $('#spkno').val();

    if (from_date !== '' || to_date !== '' || spkno !== '') {
        // Tampilkan animasi pengunduhan
        var downloadButton = $('#export-pdf');
        downloadButton.text('Downloading...');
        downloadButton.attr('disabled', true);

        // Kirim permintaan AJAX ke kontroler Anda untuk mendapatkan data
        $.ajax({
            headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'},
            url: "{{ asset('admin-ts3/export-history-service') }}",
            type: "POST",
            data: {
                from_date: from_date,
                to_date: to_date,
                spkno: spkno
            },
            success: function(response) {
                // Mengubah nama kolom
                var data = response.data.map(item => {
                    return {
                        'No Mesin': item.nomesin,
                        'Tahun': item.tahun,
                        'Tipe': item.tipe,
                        'Status Service': item.status_service,
                        'Tanggal Service': item.tanggal_service,
                        'Nama Driver': item.nama_driver,
                        'Last KM': item.last_km,
                        'Bengkel': item.bengkel,
                        'Mekanik': item.mekanik,
                        'Tanggal Last Service': item.tgl_last_service,
                        'Regional': item.regional,
                        'Area': item.area,
                        'Cabang': item.cabang,
                        'PIC Cabang': item.pic_cabang,
                        'Tanggal Schedule': item.tanggal_schedule,
                        'Remark': item.remark
                    };
                });

                // Buat dokumen PDF dengan orientasi landscape
                const { jsPDF } = window.jspdf;
                const doc = new jsPDF({ orientation: 'landscape' });

                // Menambahkan header
                doc.setFontSize(16);
                doc.setFont('Helvetica', 'bold');
                doc.text(`REALISASI SPK PERIOD ${from_date} SAMPAI DENGAN ${to_date}`, 14, 20);
                
                // Menambahkan baris kosong
                doc.text('', 14, 30);

                // Menambahkan tabel
                doc.autoTable({
                    startY: 40,
                    head: [['No Mesin', 'Tahun', 'Tipe', 'Status Service', 'Tanggal Service', 'Nama Driver', 'Last KM', 'Bengkel', 'Mekanik', 'Tanggal Last Service', 'Regional', 'Area', 'Cabang', 'PIC Cabang', 'Tanggal Schedule', 'Remark']],
                    body: data.map(item => [
                        item['No Mesin'],
                        item['Tahun'],
                        item['Tipe'],
                        item['Status Service'],
                        item['Tanggal Service'],
                        item['Nama Driver'],
                        item['Last KM'],
                        item['Bengkel'],
                        item['Mekanik'],
                        item['Tanggal Last Service'],
                        item['Regional'],
                        item['Area'],
                        item['Cabang'],
                        item['PIC Cabang'],
                        item['Tanggal Schedule'],
                        item['Remark']
                    ]),
                    headStyles: { fillColor: [22, 160, 133] }, // Warna header tabel
                    margin: { top: 40 },
                    // Pilihan landscape untuk tabel
                    pageBreak: 'auto',
                });

                // Simpan PDF dan unduh
                doc.save('History-Service.pdf');

                // Kembalikan tombol ke keadaan semula
                setTimeout(function() {
                    downloadButton.html('<i class="far fa-file-pdf"></i> Export PDF');
                    downloadButton.attr('disabled', false);
                }, 1000); // Durasi animasi dalam milidetik
            },
            error: function() {
                swal('Oops..', 'Terjadi kesalahan saat memuat data.', 'error');
                // Mengembalikan tombol ke keadaan semula jika terjadi kesalahan
                downloadButton.html('<i class="far fa-file-pdf"></i> PDF');
                downloadButton.attr('disabled', false);
            }
        });
    } else {
        swal('Oops..', 'Filter Belum Di input', 'warning');
    }
});
</script>