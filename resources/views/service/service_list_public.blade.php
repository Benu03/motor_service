@if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

{{-- Info Box --}}
<div class="row mb-4">
    <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box mb-3">
            <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-motorcycle"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Service</span>
                <span class="info-box-number">{{ $countservice }}</span>
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
        <tbody>
            @php $i = 1; @endphp
            @foreach ($service as $dt)
                <tr>
                    <td class="text-center">{{ $i }}</td>
                    <td>{{ $dt->source }}</td>
                    <td>{{ $dt->nopol }}</td>
                    <td>{{ $dt->tgl_last_service }}</td>
                    <td>{{ $dt->branch }}</td>
                    <td>{{ $dt->status_service }}</td>
                    <td>{{ $dt->tanggal_schedule }}</td>
                    <td>{{ $dt->bengkel_name }}</td>
                    <td>{{ $dt->tanggal_service }}</td>
                    <td>
                        <div class="btn-group">
                            <a href="{{ url('service-bengkel-process/'.$dt->id) }}" class="btn btn-warning btn-sm">
                                <i class="fa fa-edit"></i>
                            </a>

                            <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#Detail{{ $dt->nopol }}">
                                <i class="fa fa-eye"></i>
                            </button>

                            {{-- Modal Detail --}}
                            @include('service/service_bengkel_detail')
                        </div>
                    </td>
                </tr>
                @php $i++; @endphp
            @endforeach
        </tbody>
    </table>
</div>
