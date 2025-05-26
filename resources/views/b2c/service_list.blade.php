{{-- Alert Error --}}
@if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

{{-- Ringkasan Status --}}
<div class="row mb-4">
    @foreach ($count as $item)
        <div class="col-12 col-sm-6 col-md-3 mb-3">
            <div class="card shadow-sm border-left-{{ strtolower($item->status) === 'completed' ? 'success' : 'warning' }}">
                <div class="card-body d-flex align-items-center">
                    <div class="me-3">
                        <div class="rounded-circle bg-{{ strtolower($item->status) === 'completed' ? 'success' : 'warning' }} text-white d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                            <i class="fas fa-motorcycle"></i>
                        </div>
                    </div>
                    <div>
                        <div class="text-muted small ml-2"><strong>{{ strtoupper($item->status) }}</strong></div>
                        <div class="h5 fw-bold ml-2">{{ $item->count_status }}</div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>

<hr class="my-3">

{{-- Tabel --}}
<div class="table-responsive mailbox-messages">
    <table id="example1" class="display table table-bordered" cellspacing="0" width="100%">
        <thead>
            <tr style="background-color: #709c0b; color: white; text-align: center;">
                <th>No</th>
                <th>SERVICE NO</th>
                <th>ORDER NO</th>
                <th>STATUS</th>
                <th>TANGGAL SERVICE</th>
                <th>NOPOL</th>
                <th>INVOICE</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $index => $row)
                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td class="text-center">{{ $row->service_number ?? '-' }}</td>
                    <td>{{ $row->order_number ?? '-' }}</td>
                    <td>{{ $row->status ?? '-' }}</td>
                    <td class="text-center">{{ $row->tanggal_service ?? '-' }}</td>
                    <td>{{ $row->nopol ?? '-' }}</td>
                    <td class="text-center">
                        @if (!empty($row->invoice_no))
                            <a href="{{ route('invoice-b2c', $row->invoice_no) }}" class="btn btn-sm btn-secondary">
                                {{  $row->invoice_no }}
                            </a>
                        @else
                            -
                        @endif
                    </td>
                    <td class="text-center">
                        <button 
                        type="button" 
                        class="btn btn-sm btn-success btn-detail"
                        data-toggle="modal"
                        data-target="#detailModalservice"
                        data-id="{{ $row->id }}"
                        data-service_number="{{ $row->service_number }}"
                        data-order_number="{{ $row->order_number }}"
                        data-tanggal_service="{{ $row->tanggal_service }}"
                        data-last_km="{{ $row->last_km }}"
                        data-status="{{ $row->status }}"
                        data-nopol="{{ $row->nopol }}"
                        data-user_bengkel="{{ $row->user_bengkel }}"
                        data-user_order="{{ $row->user_order }}"
                        data-invoice_no="{{ $row->invoice_no }}"
                        data-saran_mekanik="{{ $row->saran_mekanik }}"
                    >
                    <i class="fa fa-eye"></i>
                    </button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>


<div
  class="modal fade"
  id="detailModalservice"
  tabindex="-1"
  role="dialog"
  aria-labelledby="detailModalserviceLabel"
  aria-hidden="true"
>
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="detailModalserviceLabel">Detail Service</h5>
        <button
          type="button"
          class="close"
          data-dismiss="modal"
          aria-label="Close"
        >
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <table class="table table-borderless">
          <tbody>
            <tr><th>Service Number</th><td id="detailServiceNumber"></td></tr>
            <tr><th>Order Number</th><td id="detailOrder"></td></tr>
            <tr><th>Status</th><td id="detailStatus"></td></tr>
            <tr><th>Jadwal Service</th><td id="detailJadwal"></td></tr>
            <tr><th>Last KM</th><td id="detailLastKM"></td></tr>
            <tr><th>Nopol</th><td id="detailNopol"></td></tr>
            <tr><th>User Request</th><td id="detailUserOrder"></td></tr>
            <tr><th>User Bengkel</th><td id="detailUserBengkel"></td></tr>
            <tr><th>Invoice No</th><td id="detailInvoice"></td></tr>
            <tr><th>Saran Mekanik</th><td id="detailSaranMekanik"></td></tr>
          </tbody>
        </table>

        <hr>
        <h6>Detail Spare Part</h6>
        <table class="table table-bordered" id="additionalDetailTable">
          <thead>
            <tr>
              <th>Tipe</th>
              <th>Nama</th>
              <th>Jumlah</th>
              <th>Biaya</th>
              <th>Keterangan</th>
            </tr>
          </thead>
          <tbody></tbody>
        </table>

      </div>
      <div class="modal-footer">
        <button
          type="button"
          class="btn btn-secondary"
          data-dismiss="modal"
        >Tutup</button>
      </div>
    </div>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script  src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

<script>

  function formatRupiah(angka) {
    if (!angka) return '-';
    return 'Rp ' + angka.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
  }


  $('#detailModalservice').on('show.bs.modal', function (event) {
    const button = $(event.relatedTarget); 
    const modal = $(this);
    const id = button.data('id');

    modal.find('#detailServiceNumber').text(button.data('service_number') ?? '-');
    modal.find('#detailOrder').text(button.data('order_number') ?? '-');
    modal.find('#detailStatus').text(button.data('status') ?? '-');
    modal.find('#detailJadwal').text(button.data('tanggal_service') ?? '-');
    modal.find('#detailLastKM').text(button.data('last_km') ?? '-');
    modal.find('#detailNopol').text(button.data('nopol') ?? '-');
    modal.find('#detailUserOrder').text(button.data('user_order') ?? '-');
    modal.find('#detailUserBengkel').text(button.data('user_bengkel') ?? '-');
    modal.find('#detailInvoice').text(button.data('invoice_no') ?? '-');
    modal.find('#detailSaranMekanik').text(button.data('saran_mekanik') ?? '-');


    $('#additionalDetailTable tbody').empty();

    $.ajax({
      url:"{{  route('service-detail-b2c') }}",
      method: 'POST',
      data: { 
        _token: '{{ csrf_token() }}',
        id: id 
    },
      success: function(response) {
        if (Array.isArray(response) && response.length > 0) {
          response.forEach(item => {
            const row = `
              <tr>
                <td>${item.tipe ?? '-'}</td>
                <td>${item.nama ?? '-'}</td>
                <td>${item.jumlah ?? '-'}</td>
                <td>${formatRupiah(item.biaya)}</td>
                <td>${item.keterangan ?? '-'}</td>
              </tr>
            `;
            $('#additionalDetailTable tbody').append(row);
          });
        } else {
          $('#additionalDetailTable tbody').append('<tr><td colspan="5" class="text-center">Tidak ada data</td></tr>');
        }
      },
      error: function() {
        alert('Gagal mengambil detail service');
      }
    });




  });
</script>