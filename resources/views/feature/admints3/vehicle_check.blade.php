
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
                                 Nopol <i class="fas fa-motorcycle ml-2"></i>
                                </span>
                            </div>
                            <input type="text" name="nopol" id="nopol" class="form-control" placeholder="Nopol Kendaraan" >	
                            </div> 
					</div>
                  

                    <div class="col-sm-6">
						<div class="form-group pull-right btn-group">
                            <button type="button" name="cari_vehicle" id="cari_vehicle" class="btn btn-primary" value="Filter Data">
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
        $('#cari_vehicle').click(function(){
            var nopol = $('#nopol').val();
            // Ajax request
            $.ajax({
                headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'},
                url: "{{ url('admin-ts3/vehicle-check-process') }}", // Gunakan url() untuk menghasilkan URL lengkap
                type: 'POST',
                data: {
                    nopol: nopol
                },
                success: function(response){
                    $('#result').html(response.html);
                },
                error: function(xhr, status, error){
                    console.error(error); // Log error jika ada
                }
            });
        });
        
        $('#refresh').click(function(){
            $('#nopol').val('');
            $('#result').html(''); 
        });
    });
</script>