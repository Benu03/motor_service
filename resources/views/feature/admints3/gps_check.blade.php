
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif


        <div class="form-group row">
				
					<div class="col-sm-3">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                 GPS SN <i class="fas fa-map-marker-alt ml-2"></i>
                                </span>
                            </div>
                            <input type="text" name="sn" id="sn" class="form-control" placeholder="Serial Number" >	
                            </div> 
					</div>
                  

                    <div class="col-sm-6">
						<div class="form-group pull-right btn-group">
                            <button type="button" name="cari_gps" id="cari_gps" class="btn btn-primary" value="Filter Data">
                            <i class="fas fa-search"></i> Cari
                              </button>
                            <button type="button" name="refresh"  id="refresh" class="btn btn-warning " value="Refresh">
                                <i class="fas fa-sync-alt"></i> Refresh
                              </button>
						</div>
					</div>
                    <div class="clearfix"></div>
				</div>

        <div class="clearfix"><hr></div>

        
        <div id="result"></div>


<script>
$(document).ready(function(){
        $('#cari_gps').click(function(){
            var sn = $('#sn').val();
            // Ajax request
            $.ajax({
                headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'},
                url: "{{ url('admin-ts3/gps-check-process') }}", // Gunakan url() untuk menghasilkan URL lengkap
                type: 'POST',
                data: {
                    sn: sn
                },
                success: function(response){
                    $('#result').html(`
                        <div class="card">
                            <div class="card-header">
                                GPS Location
                            </div>
                            <div class="card-body">
                                <div id="map" style="height: 500px;"></div>
                            </div>
                        </div>
                    `);

                    // Inisialisasi peta dengan Leaflet.js
                    setTimeout(function(){
                        var map = L.map('map').setView([response.lat, response.long], 15);
                        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
                        }).addTo(map);

                        // Tambahkan penanda ke peta
                        L.marker([response.lat, response.long]).addTo(map)
                            .bindPopup('Serial Number').openPopup();
                    }, 100); // Tunggu 100ms sebelum inisialisasi peta
                },
                error: function(xhr, status, error){
                    console.error(error); // Log error jika ada
                }
            });
        });
        
        $('#refresh').click(function(){
            $('#sn').val('');
            $('#result').html(''); 
        });
    });
</script>