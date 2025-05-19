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
                        <div class="text-muted small">Status: <strong>{{ strtoupper($item->status) }}</strong></div>
                        <div class="h5 fw-bold">{{ $item->count_status }}</div>
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
                <th>NOPOL</th>
                <th>ORDER NO</th>
                <th>STATUS</th>
                <th>JADWAL SERVICE</th>
                <th>USER REQUEST</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $index => $row)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $row->nopol ?? '-' }}</td>
                    <td>{{ $row->order_number ?? '-' }}</td>
                    <td>{{ $row->status ?? '-' }}</td>
                    <td>{{ $row->jadwal_service ?? '-' }}</td>
                    <td>{{ $row->created_by ?? '-' }}</td>
                    <td>
                        <button 
                        type="button" 
                        class="btn btn-sm btn-primary btn-detail"
                        data-toggle="modal"
                        data-target="#detailModalorder"
                        data-nopol="{{ $row->nopol }}"
                        data-type="{{ $row->type }}"
                        data-lat="{{ $row->lat }}"
                        data-lon="{{ $row->lon }}"
                        data-address="{{ $row->address }}"
                        data-remark_address="{{ $row->remark_address }}"
                        data-keluhan="{{ $row->keluhan }}"
                        data-paired_bengkel="{{ $row->paired_bengkel }}"
                        data-is_verify_bengkel="{{ $row->is_verify_bengkel }}"
                        data-remark_pembatalan="{{ $row->remark_pembatalan }}"
                        data-order="{{ $row->order_number }}"
                        data-status="{{ $row->status }}"
                        data-jadwal="{{ $row->jadwal_service }}"
                        data-user="{{ $row->created_by }}"
                    >
                        Detail
                    </button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>


{{-- Modal --}}
<div
  class="modal fade"
  id="detailModalorder"
  tabindex="-1"
  role="dialog"
  aria-labelledby="detailModalorderLabel"
  aria-hidden="true"
>
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="detailModalorderLabel">Detail Order</h5>
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
            <tr><th>Nopol</th><td id="detailNopol"></td></tr>
            <tr><th>Type</th><td id="detailType"></td></tr>
            <tr><th>Address</th><td id="detailAddress"></td></tr>
            <tr><th>Remark Address</th><td id="detailRemarkAddress"></td></tr>
            <tr><th>Keluhan</th><td id="detailKeluhan"></td></tr>
            <tr><th>Paired Bengkel</th><td id="detailPairedBengkel"></td></tr>
            <tr><th>Verify Bengkel</th><td id="detailIsVerifyBengkel"></td></tr>
            <tr><th>Remark Pembatalan</th><td id="detailRemarkPembatalan"></td></tr>
            <tr><th>Order Number</th><td id="detailOrder"></td></tr>
            <tr><th>Status</th><td id="detailStatus"></td></tr>
            <tr><th>Jadwal Service</th><td id="detailJadwal"></td></tr>
            <tr><th>User Request</th><td id="detailUser"></td></tr>
            <tr>
              <th>Lokasi (Map)</th>
              <td><div id="modalMap" style="height: 300px; width: 100%;"></div></td>
            </tr>
          </tbody>
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

<!-- jQuery dan Bootstrap 4 JS -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script
  src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"
></script>

<!-- Leaflet JS -->
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

<script>
  let map;
  let marker;

  $('#detailModalorder').on('show.bs.modal', function (event) {
    const button = $(event.relatedTarget); // tombol yang memicu modal
    const modal = $(this);

    // Ambil data dari tombol
    const data = {
      nopol: button.data('nopol') || '-',
      type: button.data('type') || '-',
      address: button.data('address') || '-',
      remark_address: button.data('remark_address') || '-',
      keluhan: button.data('keluhan') || '-',
      paired_bengkel: button.data('paired_bengkel') || '-',
      is_verify_bengkel: button.data('is_verify_bengkel') || '-',
      remark_pembatalan: button.data('remark_pembatalan') || '-',
      order: button.data('order') || '-',
      status: button.data('status') || '-',
      jadwal: button.data('jadwal') || '-',
      user: button.data('user') || '-',
      lat: parseFloat(button.data('lat')),
      lon: parseFloat(button.data('lon'))
    };

    // Set text detail ke modal
    modal.find('#detailNopol').text(data.nopol);
    modal.find('#detailType').text(data.type);
    modal.find('#detailAddress').text(data.address);
    modal.find('#detailRemarkAddress').text(data.remark_address);
    modal.find('#detailKeluhan').text(data.keluhan);
    modal.find('#detailPairedBengkel').text(data.paired_bengkel);
    modal.find('#detailIsVerifyBengkel').text(data.is_verify_bengkel);
    modal.find('#detailRemarkPembatalan').text(data.remark_pembatalan);
    modal.find('#detailOrder').text(data.order);
    modal.find('#detailStatus').text(data.status);
    modal.find('#detailJadwal').text(data.jadwal);
    modal.find('#detailUser').text(data.user);

    // Render ulang map (tunggu sedikit untuk DOM siap)
    setTimeout(() => {
      if (map) {
        map.remove();
      }

      if (!isNaN(data.lat) && !isNaN(data.lon)) {
        map = L.map('modalMap').setView([data.lat, data.lon], 13);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
          attribution: '&copy; OpenStreetMap contributors'
        }).addTo(map);

        marker = L.marker([data.lat, data.lon]).addTo(map);
      } else {
        $('#modalMap').html('<p class="text-danger">Koordinat tidak valid.</p>');
      }
    }, 300);
  });
</script>