<div class="modal fade" id="AddService"  role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-xl">
		<div class="modal-content">
				<div class="modal-header">
	
				<h4 class="modal-title mr-4" id="myModalLabel">SPK Add Service Proses</h4>
				
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
					<div class="modal-body">
		
												
							<div class="form-group row">
								<label class="col-sm-3 control-label text-right">SPK NO</label>
								<div class="col-sm-9">
									
									<select name="spk_no_ext" id="spk_no_ext" class="form-control" width="100%">
										<option value="" selected disabled>Pilih SPK</option> <!-- Opsi default -->
										<?php foreach($spkonprogress as $spko) { ?>
											<option value="<?php echo $spko->id ?>"><?php echo $spko->spk_no ?></option>
										<?php } ?>
									</select>
									


								</div>
							</div>

							<div class="form-group row">
								<label class="col-sm-3 control-label text-right">Nopol</label>
								<div class="col-sm-9">
									
									  <select name="nopol_ext" id="nopol_ext" class="form-control" width="100%">
										<option value="" selected disabled>Pilih Nopol</option> <!-- Opsi default -->
										<?php foreach($nopol as $npl) { ?>
										<option value="<?php echo $npl->nopol ?>"><?php echo $npl->nopol ?></option>
										<?php } ?>
									</select>


								</div>
							</div>


							<div class="form-group row">
								<label class="col-sm-3 control-label text-right">Tanggal Schedule Service</label>
								<div class="col-sm-9">
									<input type="text" name="tanggal_schedule_ext" class="form-control tanggal" placeholder="Tanggal Schedule" value="<?php if(isset($_POST['tanggal_schedule'])) { echo old('tanggal_schedule'); }else{ echo date('Y-m-d'); } ?>" data-date-format="yyyy-mm-dd">	
								</div>
							</div>
							
							<div class="form-group row">
								<label class="col-sm-3 control-label text-right">Bengkel</label>
								<div class="col-sm-9">
									
									  <select name="mst_bengkel_id_etx" id="mst_bengkel_id_etx" class="form-control" width="100%">
										<option value="" selected disabled>Pilih Bengkel</option> <!-- Opsi default -->
										<?php foreach($bengkel as $bk) { ?>
										<option value="<?php echo $bk->id ?>"><?php echo $bk->bengkel_name ?></option>
										<?php } ?>
									</select>


								</div>
							</div>


							<div class="form-group row">
								<label class="col-sm-3 control-label text-right">Cabang</label>
								<div class="col-sm-9">
									
									  <select name="cabang_id_etx" id="cabang_id_etx" class="form-control" width="100%">
										<option value="" selected disabled>Pilih Cabang</option> <!-- Opsi default -->
										<?php foreach($cabang as $cbg) { ?>
										<option value="<?php echo $cbg->id ?>"><?php echo $cbg->branch.'  ('.$cbg->area_slug.')' ?></option>
										<?php } ?>
									</select>
									

								</div>
							</div>


							<div class="form-group row">
								<label class="col-sm-3 control-label text-right">Remark</label>
								<div class="col-sm-9">
									<textarea name="remark_ext" class="form-control" id="remark_ext" placeholder="Remark">{{ old('remark_ext') }}</textarea>
			
								</div>
							</div>
							


							<div class="form-group row">
								<label class="col-sm-3 control-label text-right"></label>
								<div class="col-sm-9">
									<div class="form-group pull-right btn-group">
	
										<button type="button" name="submit_ext" id="submit_ext" class="btn btn-primary">Proses Data
											<span id="loadingIcon" class="spinner-border spinner-border-sm" style="display: none;" role="status" aria-hidden="true"></span>
										</button>
										<input type="reset" name="reset" class="btn btn-success " value="Reset">
										<button type="button" class="btn btn-danger " data-dismiss="modal">Close</button>
									</div>
								</div>
								<div class="clearfix"></div>
							</div>


					   
                        </div>
		</div>
	</div>
</div>



<script>
$(document).ready(function(){
    $('button[name="submit_ext"]').click(function(e){
        e.preventDefault(); // Mencegah submit form default


		var submitButton = $('#submit_ext');
        var loadingIcon = $('#loadingIcon');
        
        // Menonaktifkan tombol submit dan menampilkan loading icon
        submitButton.prop('disabled', true);
        submitButton.html('Processing... <span id="loadingIcon" class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>');
        loadingIcon.show(); // Menampilkan ikon loading



        // Ambil data dari form
        let spk_no_ext = $('#spk_no_ext').val();
        let nopol_ext = $('#nopol_ext').val();
        let tanggal_schedule_ext = $('input[name="tanggal_schedule_ext"]').val();
        let mst_bengkel_id_etx = $('#mst_bengkel_id_etx').val();
        let cabang_id_etx = $('#cabang_id_etx').val();
        let remark_ext = $('#remark_ext').val();

        // Validasi: Cek jika ada field yang kosong
		if (!spk_no_ext || !nopol_ext || !tanggal_schedule_ext || !mst_bengkel_id_etx || !cabang_id_etx) {
            swal('Oops..', 'Data tidak boleh kosong', 'warning');
            submitButton.prop('disabled', false);
            submitButton.html('Submit'); // Kembalikan teks tombol
            loadingIcon.hide(); // Sembunyikan ikon loading
            return; 
        }

        // AJAX POST request
        $.ajax({
            url: "{{  asset('admin-ts3/spk-proses-extend') }}", // Ganti dengan route yang sesuai
            type: 'POST',
            data: {
                spk_no_ext: spk_no_ext,
                nopol_ext: nopol_ext,
                tanggal_schedule_ext: tanggal_schedule_ext,
                mst_bengkel_id_etx: mst_bengkel_id_etx,
                cabang_id_etx: cabang_id_etx,
                remark_ext: remark_ext,
                _token: "{{ csrf_token() }}" // Pastikan CSRF token diikutkan
            },
			success: function (response) {
                swal("Berhasil", "Data berhasil diinput", "success");
                $('#AddService').modal('hide');
                // Kembalikan status tombol
                submitButton.prop('disabled', false);
                submitButton.html('Submit');
                loadingIcon.hide(); // Sembunyikan ikon loading
            },
            error: function (xhr, status, error) {
                swal('Oops..', "Terjadi kesalahan saat menambahkan data", 'warning');
                // Kembalikan status tombol
                submitButton.prop('disabled', false);
                submitButton.html('Submit'); // Kembalikan teks tombol
                loadingIcon.hide(); // Sembunyikan ikon loading
                console.log(error); // Log kesalahan untuk debugging
            }
        });
    });
});
</script>



