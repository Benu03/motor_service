@if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="row mb-4">
    <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box mb-3">
            <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-motorcycle"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Service</span>

            </div>
        </div>
    </div>
</div>

<hr class="my-3">

{{-- Tabel Service --}}
<div class="table-responsive mailbox-messages">
    <table id="example1" class="table table-bordered display w-100">
        <thead class="bg-info text-white">
            <tr>
                <th width="5%">No</th>
                <th width="10%">Source</th>
                <th width="7%">NOPOL</th>
                <th width="10%">Tanggal Last Service</th>   
                <th width="12%">Cabang</th> 
                <th width="10%">Status Service</th>  
                <th width="15%">Tanggal Schedule</th> 
                <th width="15%">Bengkel</th>    
                <th width="15%">Tanggal Service</th> 
                <th>Action</th>
            </tr>
        </thead>
      
    </table>
</div>
