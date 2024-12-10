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
        <div class="col-sm-3">
           
                <div class="input-group-prepend">
                    <span class="input-group-text">
                    Month <i class="far fa-calendar-alt ml-2"></i>
                    </span>
                    <select name="month" id="month">
                        <option value="01" <?php if(date("n") == 1) echo 'selected'; ?>>January</option>
                    <option value="02" <?php if(date("n") == 2) echo 'selected'; ?>>February</option>
                    <option value="03" <?php if(date("n") == 3) echo 'selected'; ?>>March</option>
                    <option value="04" <?php if(date("n") == 4) echo 'selected'; ?>>April</option>
                    <option value="05" <?php if(date("n") == 5) echo 'selected'; ?>>May</option>
                    <option value="06" <?php if(date("n") == 6) echo 'selected'; ?>>June</option>
                    <option value="07" <?php if(date("n") == 7) echo 'selected'; ?>>July</option>
                    <option value="08" <?php if(date("n") == 8) echo 'selected'; ?>>August</option>
                    <option value="09" <?php if(date("n") == 9) echo 'selected'; ?>>September</option>
                    <option value="10" <?php if(date("n") == 10) echo 'selected'; ?>>October</option>
                    <option value="11" <?php if(date("n") == 11) echo 'selected'; ?>>November</option>
                    <option value="12" <?php if(date("n") == 12) echo 'selected'; ?>>December</option>
                    </select>
                    
                </div>
       
        </div>

        <div class="col-sm-2">
           
            <div class="input-group-prepend">
                <span class="input-group-text">
                Year <i class="far fa-calendar-alt ml-2"></i>
                </span>
                <select id="year">
                    <?php
                    $currentYear = date("Y");
                    $startYear = $currentYear - 2;
                    $endYear = $currentYear + 2;
                    
                    for ($year = $startYear; $year <= $endYear; $year++) {
                        echo '<option value="' . $year . '"';
                        
                        if ($year == $currentYear) {
                            echo ' selected';
                        }
                        
                        echo '>' . $year . '</option>';
                    }
                    ?>
                </select>
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
    
</div>

<div class="clearfix"><hr></div>

<div class="row mb-2">
  
        <div class="col-md-12"> 
                   <div id="mvm-laba_rugi-chart"></div>
        
        </div>
        
       
       
</div>  
<div class="row">
    <div class="clearfix"><hr></div>
<div class="table-responsive mailbox-messages">
    <div class="table-responsive mailbox-messages">
<table id="dataTable" class="display table table-bordered" cellspacing="0" width="100%">
<thead>
    <tr class="bg-info">
        {{-- <th width="5%">
          <div class="mailbox-controls">
                <!-- Check all button -->
               <button type="button" class="btn btn-default btn-sm checkbox-toggle"><i class="far fa-square"></i>
                </button>
            </div>
        </th> --}}
        <th width="15%">SPK</th>
        <th width="10%">BENGKEL TO TS3</th>   
        <th width="10%">TS3 TO CLIENT</th> 
        <th width="10%">Gross Profit</th> 
        <th width="10%">Month</th> 
        <th width="10%">Year</th> 
        <th width="12%">Tanggal Pengerjaan</th>  

</tr>
</thead>

</table>
</div>
</div>
</div>  





</form>
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>
<script>
   $(function() {
    Highcharts.chart('mvm-laba_rugi-chart', {
        chart: {
            type: 'column'
        },
        title: {
            text: 'Report Laba Rugi',
            align: 'left'
        },
        xAxis: {
            categories: [<?php foreach ($dataPointslaba_rugi as $item) { ?>
                '<?= $item['spk_no'] ?>',
            <?php } ?>],
            crosshair: true,
            accessibility: {
                description: 'SPK'
            }
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Total Invoice (Rp)'
            },
            labels: {
                formatter: function() {
                    return Highcharts.numberFormat(this.value, 0, ',', '.') + ' Rp';
                }
            }
        },
        tooltip: {
            valuePrefix: 'Rp',
            valueDecimals: 0,
            valueThousandsSeparator: ','
        },
        plotOptions: {
            column: {
                pointPadding: 0.2,
                borderWidth: 0
            }
        },
        series: [
            {
                name: 'BENGKEL TO TS3',
                data: [<?php foreach ($dataPointslaba_rugi as $item) {
                    echo isset($item["total1"]) ? $item["total1"] . ", " : "0, ";
                } ?>]
            },
            {
                name: 'TS3 TO CLIENT',
                data: [<?php foreach ($dataPointslaba_rugi as $item) {
                    echo isset($item["total2"]) ? $item["total2"] . ", " : "0, ";
                } ?>]
            }
        ]
        });
    });

  </script>



  

<script type="text/javascript">
    $(document).ready(function() { 
        fetch_data()
        function fetch_data(month = '', year = ''){                    
                $('#dataTable').DataTable({
                    pageLength: 10,
                    lengthChange: true,
                    bFilter: true,
                    destroy: true,
                    processing: true,
                    serverSide: true,
                    order: [[6, 'desc']],
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
                        url:"{{  asset('admin-ts3/get-laba-rugi') }}",
                        type: "POST",
                        data: function (d) {
                        d.month = month;
                        d.year = year;
                    }
                             
                    },
                    columns: [
                        { 
                            data: 'spk_no', 
                            name: 'spk_no', 
        
                        },
                        { 
                            data: 'total1', 
                            name: 'total1', 
                            render: function(data, type, full, meta) {
                            var formattedAmount = formatRupiah(data);
                            return formattedAmount;
                            }
        
                        },
                        { 
                            data: 'total2', 
                            name: 'total2', 
                            render: function(data, type, full, meta) {
                            var formattedAmount = formatRupiah(data);
                            return formattedAmount;
                            }
                            
        
                        },
                        { 
                            data: null,
                            name: 'profit', 
                            render: function(data, type, full, meta) {
                                var total1 = parseFloat(full.total1.replace(/[^\d]/g, '')); // Menghapus karakter non-digit dari total1
                                var total2 = full.total2 === null ? null : parseFloat(full.total2.replace(/[^\d]/g, '')); // Menghapus karakter non-digit dari total2 jika bukan null
                                if (total2 === null) {
                                    return '-';
                                } else {
                                    var profit = total2 - total1;
                                    var formattedAmount = formatRupiah(profit);
                                    return formattedAmount;
                                }
                            }
        
                        },
                        { 
                            data: 'month_spk', 
                            name: 'month_spk', 
        
                        },
                        { 
                            data: 'year_spk', 
                            name: 'year_spk', 
        
                        },
                        { 
                            data: 'tanggal_pengerjaan', 
                            name: 'tanggal_pengerjaan', 
        
                        },
                      
                       
                    ]
                });
            }  
            

            $('#filter').click(function(){
            var month = $('#month').val();
            var year = $('#year').val();

            if(month != '' &&  year != ''){
                $('#dataTable').DataTable().destroy();
                fetch_data(month, year);
            } else{
                swal('Oops..', 'Date Filter Belum Di input', 'warning');
            }

        });

        $('#refresh').click(function(){
            $('#month').val('');
            $('#year').val('');
            $('#dataTable').DataTable().destroy();
            fetch_data();
        });

        $('#export').click(function(){
            var month = $('#month').val();
            var year = $('#year').val();

            if (month != '' && year != '') 
            {
                // Tampilkan animasi pengunduhan
                var downloadButton = $('#export');
                downloadButton.text('Downloading...');
                downloadButton.attr('disabled', true);

            // Kirim permintaan AJAX ke kontroler Anda untuk mendapatkan data
            $.ajax({
                headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'},
                url: "{{  asset('admin-ts3/export-summary-bengkel') }}",
                type: "POST",
                data: {
                    month: month,
                    year: year
                },
            success: function(response) {
            // Buat workbook Excel baru
            var wb = XLSX.utils.book_new();

            // Buat worksheet
            var ws = XLSX.utils.json_to_sheet(response.data);

            // Tambahkan worksheet ke workbook
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
                a.download = 'Summary_Bengkel.xlsx';
                a.click();
            }, 1000); // Durasi animasi dalam milidetik
                    },
                    error: function() {
                        swal('Oops..', 'Terjadi kesalahan saat memuat data.', 'error');
                    }
                });
            } else {
                swal('Oops..', 'Date Filter Belum Di input', 'warning');
            }
        });
            
        
    });

    function formatRupiah(amount) {
    var formatter = new Intl.NumberFormat('id-ID', {
        style: 'currency',
        currency: 'IDR',
        minimumFractionDigits: 0, 
        maximumFractionDigits: 0
    });
    var formattedAmount = formatter.format(amount);
    var decimalRemoved = formattedAmount.replace(/\.00(?=\D|$)/, '');
    return decimalRemoved;
    }  


    </script>
