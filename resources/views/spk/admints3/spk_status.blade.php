
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="row">
    <!-- SPK Onprogress Info Box -->
    <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box mb-3 filter-button" id="filterOnProgress">
            <span class="info-box-icon bg-success elevation-1"><i class="fa fa-file-contract"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">SPK Onprogress</span>
                <span class="info-box-number">{{ $onprogress }}</span>
            </div>
        </div>
    </div>

    <!-- SPK Waiting Info Box -->
    <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box mb-3 filter-button" id="filterWaiting">
            <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-money-check"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">SPK Waiting</span>
                <span class="info-box-number">{{ $waiting }}</span>
            </div>
        </div>
    </div>

    <div class="col-12 col-sm-6 col-md-3 ml-auto d-flex justify-content-end align-items-center">
        <button id="refreshTable" class="btn btn-secondary"><i class="fas fa-sync-alt"></i> Refresh</button>
    </div>
</div>

<div class="clearfix"><hr></div>

<!-- Table -->
<div class="table-responsive mailbox-messages">
    <table id="example1" class="display table table-bordered" cellspacing="0" width="100%">
        <thead>
            <tr class="bg-info">
                <th width="5%">No</th>
                <th width="15%">SPK Nomor</th>
                <th width="10%">Jumlah Kendaraan</th>
                <th width="15%">Tanggal Pengerjaan</th>
                <th width="15%">Tanggal Berlaku SPK Terakhir</th>
                <th width="10%">Status</th>
                <th width="15%">User Posting</th>
                <th width="15%">Tanggal Posting</th>
                <th>ACTION</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 1; foreach ($spk as $dt) { ?>
            <tr>
                <td class="text-center"><?php echo $i; ?></td>
                <td><?php echo $dt->spk_no; ?></td>
                <td><?php echo $dt->count_vehicle; ?></td>
                <td><?php echo $dt->tanggal_pengerjaan; ?></td>
                <td><?php echo $dt->tanggal_last_spk; ?></td>
                <td><?php echo $dt->status; ?></td>
                <td><?php echo $dt->user_posting; ?></td>
                <td><?php echo substr($dt->posting_date, 0, 10); ?></td>
                <td>
                    <div class="btn-group">
                        <button type="button" class="btn btn-success btn-sm mr-2" data-toggle="modal" data-target="#Detail<?php echo $dt->spk_seq; ?>">
                            <i class="fa fa-eye"></i> 
                        </button>
                        @if ($dt->status == 'WAITING')
                        <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#Proses<?php echo $dt->spk_seq; ?>">
                            <i class="fa fa-edit"></i> 
                        </button>
                        @endif
                    </div>
                    @include('spk/admints3/spk_detail') 
                    @include('spk/admints3/spk_proses')
                </td>
            </tr>
            <?php $i++; } ?>
        </tbody>
    </table>
</div>

<script>
    $(document).ready(function() {
        // Initialize DataTable
        var table = $('#example1').DataTable({
            "lengthMenu": [10, 25, 50] 
        });

        $('#example1_length label').css('display', 'none');
        
        // Filter DataTable when "SPK Onprogress" is clicked
        $('#filterOnProgress').on('click', function() {
            table.column(5).search('ONPROGRESS').draw();
        });

        // Filter DataTable when "SPK Waiting" is clicked
        $('#filterWaiting').on('click', function() {
            table.column(5).search('WAITING').draw();
        });

         $('#refreshTable').on('click', function() {
            table.search('').columns().search('').draw(); 
        });
    });
</script>
