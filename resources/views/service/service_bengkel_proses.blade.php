<style>
    
    #tableModule tbody td:nth-child(1) {
            text-align: center;
        }

        #tableModule tbody td:nth-child(3) {
            text-align: center;
        }

        #tableModule thead{
            background-color: #F2F2F2;
            color: #2E308A !important;
            border-radius-top-left-radius: 10px !important;
            border-radius-top-right-radius: 10px !important;
        }

        #tableModule thead th{
            font-weight: 600 !important;
        }

        #tableModule thead th:nth-child(1), th:nth-child(2) {
            border-right: 0px;
        }

        @media (max-width: 768px) {
            .dataTables_wrapper .dataTables_filter {
                width: 100% !important;
                float: left;
            }
        }
</style>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form id="serviceProcessBengkel" action="{{ url('bengkel/service-proses') }}" enctype="multipart/form-data" method="post" accept-charset="utf-8">
    {{ csrf_field() }}
    <input type="hidden" name="id" value="{{ $service->id }}">
    <input type="hidden" name="pic_branch" value="{{ $service->pic_branch }}">

    <div class="form-group row">
        <div class="col-sm-6">
            <div class="form-group row">
                <label class="col-sm-3 control-label text-right">Tanggal Service</label>
                <div class="col-sm-9">
                    <input type="text" name="tanggal_service" class="form-control tanggal" placeholder="Tanggal Service" value="{{ isset($_POST['tanggal_service']) ? old('tanggal_service') : date('Y-m-d') }}" data-date-format="yyyy-mm-dd">	
                </div>
            </div>

            <div class="row form-group">
                <label class="col-md-3 text-right">Nama STNK <span class="text-danger">*</span></label>
                <div class="col-md-9">
                    <input type="text" name="nama_stnk" class="form-control" placeholder="Nama STNK" value="{{ $service->nama_stnk ?? '' }}" required>
                </div>
            </div>


            <div class="row form-group">
                <label class="col-md-3 text-right">Nama Driver <span class="text-danger">*</span></label>
                <div class="col-md-9">
                    <input type="text" name="nama_driver" class="form-control" placeholder="Nama Driver" value="{{ old('nama_driver') }}" required>
                </div>
            </div>

                        <div class="row form-group">
                            <label class="col-md-3 text-right">Regional <span class="text-danger">*</span></label>
                            <div class="col-md-9">
                                <input type="text" name="regional" class="form-control" placeholder="Regional" value="{{ $service->regional }}" required readonly>
                            </div>
                        </div>


            <div class="row form-group">
                <label class="col-md-3 text-right">AREA <span class="text-danger">*</span></label>
                <div class="col-md-9">
                    <input type="text" name="area" class="form-control" placeholder="AREA" value="{{ $service->area }}" required readonly>
                </div>
            </div>


            <div class="row form-group">
                <label class="col-md-3 text-right">CABANG <span class="text-danger">*</span></label>
                <div class="col-md-9">
                    <input type="text" name="branch" class="form-control" placeholder="CABANG" value="{{ $service->branch }}" required readonly>
                </div>
            </div>

        </div>
        <div class="col-sm-6">

            <div class="row form-group">
                <label class="col-md-3 text-right">NOPOL <span class="text-danger">*</span></label>
                <div class="col-md-9">
                    <input type="text" name="nopol" class="form-control" placeholder="NOPOL" value="{{ $service->nopol }}" required readonly>
                </div>
            </div>


            <div class="row form-group">
                <label class="col-md-3 text-right">No Rangka <span class="text-danger">*</span></label>
                <div class="col-md-9">
                    <input type="text" name="norangka" class="form-control" placeholder="No Rangka" value="{{ $service->norangka }}" required readonly>
                </div>
            </div>


            <div class="row form-group">
                <label class="col-md-3 text-right">No Mesin <span class="text-danger">*</span></label>
                <div class="col-md-9">
                    <input type="text" name="nomesin" class="form-control" placeholder="No Mesin" value="{{ $service->nomesin }}" required readonly>
                </div>
            </div>

            <div class="row form-group">
                <label class="col-md-3 text-right">Tipe/Tahun <span class="text-danger">*</span></label>
                <div class="col-md-9">
                    <input type="text" name="tipe_tahun" class="form-control" placeholder="Tipe/Tahun" value="{{ $service->type.'/'.$service->tahun_pembuatan }}" required readonly>
                </div>
            </div>

            <div class="row form-group">
                <label class="col-md-3 text-right">KM Terakhir <span class="text-danger">*</span></label>
                <div class="col-md-9">
                    <input type="text" name="last_km" class="form-control" placeholder="KM Terakhir" value="{{ $service->last_km }}" onkeypress="return isNumber(event)" required>
                </div>
            </div>


            <div class="row form-group">
                <label class="col-md-3 text-right">Mekanik <span class="text-danger">*</span></label>
                <div class="col-md-9">
                    <input type="text" name="mekanik" class="form-control" placeholder="Mekanik" value="{{ $service->pic_bengkel }}" required>
                </div>
            </div>

        </div>

    </div>

    <div class="clearfix"><hr></div>
    <div class="form-group row">
        <div class="col-sm-6">
            <div class="card card-info">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-6">
                            <h3 class="card-title">Pekerjaan</h3>
                        </div>
                        <div class="col-md-6">
                            <div class="custom-control custom-switch text-md-right">
                                @if($gps == null)
                                <input type="checkbox" class="custom-control-input" id="customSwitch1">
                                <label class="custom-control-label" name="gpslabel" for="customSwitch1">GPS Install</label>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4 col-sm-4 col-xs-4">
                            <div class="form-group">
                                <select name="pekerjaan" class="form-control select2" id="pekerjaan" style="width: 100%;">
                                    <option value="" hidden>-- Select Pekerjaan --</option>
                                    <option value="NO SERVICE">NO SERVICE</option>
                                    @foreach ($jobs as $item)
                                        <option value="{{ $item->mst_price_service_id }}"
                                            data-pekerjaan="{{ $item->service_name.' ('.$item->kode.')' }}">{{ $item->service_name.' ('.$item->kode.')' }}</option>
                                    @endforeach
                                </select>
                                <input type="hidden" id="selectedpekerjaanInput" name="selectedpekerjaan">
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-6">
                            <div class="form-group">
                                <input type="text" name="remarkpekerjaan" class="form-control" placeholder="Remark">
                                {{-- <input type="hidden" id="remarkpekerjaanInput" name="remarkpekerjaan"> --}}
                            </div>
                        </div>
    
                        <div class="col-md-2 col-sm-2 col-xs-2 text-right">
                            <button class="btn btn-success add_data_pekerjaan clickable" type="button">
                                <i class="fas fa-plus-circle"></i>
                            </button>
                        </div>
    
                    </div>
                    <div id="noServiceMessage" class="alert alert-warning mt-3" style="display: none;">
                        Pekerjaan ini tidak memerlukan layanan tambahan.
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <table id="tablepekerjaan" class="table table-sm table-bordered w-100">
                                <thead>
                                    <tr>
                                        <th class="text-center" style="width: 5%;">No</th>
                                        <th style="width: 25%;">Pekerjaan</th>
                                        <th style="width: 45%;">Remark</th>
                                        <th style="width: 15%; text-align: center;">Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
        <div class="col-sm-6">
            <div class="card card-warning">
                <div class="card-header">
                    <h3 class="card-title">Spare Part</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-5 col-sm-5 col-xs-5">
                            <div class="form-group">
                                <select name="part" class="form-control select2" id="part" style="width: 100%;">
                                    <option value="" hidden>-- Select Part --</option>
                                    @foreach($part as $pt)
                                        <option value="{{ $pt->mst_price_service_id }}"
                                            data-part="{{ $pt->service_name.' ('.$pt->kode.')' }}">{{ $pt->service_name.' ('.$pt->kode.')' }}</option>
                                    @endforeach
                                </select>
                                <input type="hidden" id="selectedpartInput" name="selectedpart">
                            </div>
                        </div>
                        <div class="col-md-5 col-sm-5 col-xs-5">
                            <div class="form-group">
                                <input type="text" name="remarkpart" class="form-control" placeholder="Remark">
                                {{-- <input type="hidden" id="remarkpartInput" name="remarkpart"> --}}
                            </div>
                        </div>
    
                        <div class="col-md-2 col-sm-2 col-xs-2 text-right">
                            <button class="btn btn-success add_data_part clickable" type="button">
                                <i class="fas fa-plus-circle"></i>
                            </button>
                        </div>
    
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <table id="tablepart" class="table table-sm table-bordered w-100">
                                <thead>
                                    <tr>
                                        <th class="text-center" style="width: 5%;">No</th>
                                        <th style="width: 25%;">Part</th>
                                        <th style="width: 45%;">Remark</th>
                                        <th style="width: 15%; text-align: center;">Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
   
    
    <div class="clearfix"><hr></div>
    <div class="form-group row">
        <div class="col-sm-6">
            <div class="card card-secondary">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-6">
                            <h3 class="card-title">Upload Service</h3>
                        </div>
                        <div class="col-md-6 text-right">
                            <button type="button" id="uploadBtn" class="btn btn-success" data-toggle="modal" data-target="#uploadModal">Upload File</button>
                        </div>
                    </div>
                </div>
                
                <div class="card-body">
                    <table id="fileTable" class="table table-bordered mt-3">
                        <thead>
                            <tr>
                                <th>File Name</th>
                                <th>Remark</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Data file akan muncul di sini -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-sm-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Remark Driver</h3>
                </div>
                <div class="card-body">
                    <div class="row form-group">
                        <div class="col-md-12">
                            <textarea name="remark_driver" id="remark_driver" class="form-control" placeholder="Remark Driver">{{ old('remark_driver') }}</textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>



    <div class="clearfix"><hr></div>
    <div class="form-group row ">
        <div class="col-sm-9 text-center">
            <div class="form-group pull-center btn-group">
                <button type="submit" name="submit" class="btn btn-primary" id="kirimBtn">Kirim</button>
                <input type="reset" name="reset" class="btn btn-success " value="Reset">
                <a href="{{ asset('bengkel/list-service') }}" class="btn btn-danger">Kembali</a>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
</form>



<div class="modal fade" id="gpsmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">GPS Install Form</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

              

            <div class="row form-group">
                <label class="col-md-3 text-right">Serial Number <span class="text-danger">*</span></label>
                <div class="col-md-9">
                    <input type="text" name="sn_gps" class="form-control" placeholder="SN GPS"  required>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-3 control-label text-right">Tanggal Pemasangan <span class="text-danger">*</span></label>
                <div class="col-sm-9">
                    <input type="text" name="install_date" class="form-control tanggal" placeholder="Tanggal Pemasangan" data-date-format="yyyy-mm-dd">	
                </div>
            </div>


            <div class="form-group row">
                <label class="col-sm-3 control-label text-right">Evidance <span class="text-danger">*</span></label>
                <div class="col-sm-9">
                <input type="file" name="uploadgps1" class="form-control" placeholder="Upload File Install GPS" required>	
                </div>
            </div>


            <div class="form-group row">
                <label class="col-sm-3 control-label text-right"></label>
                <div class="col-sm-9">
                <input type="file" name="uploadgps2" class="form-control" placeholder="Upload File Install GPS">	
                </div>
            </div>


            <div class="form-group row">
                <label class="col-sm-3 control-label text-right"></label>
                <div class="col-sm-9">
                <input type="file" name="uploadgps3" class="form-control" placeholder="Upload File Install GPS">	
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-3 control-label text-right">Remark</label>
                <div class="col-sm-9">
                <textarea name="remarkgps" id="remarkgps" class="form-control" placeholder="Remark Gps"></textarea>
                </div>
            </div>
         

    
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-primary" id="simpan_gps">Simpan</button>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="uploadModal" tabindex="-1" role="dialog" aria-labelledby="uploadModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="uploadModalLabel">Upload File</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="uploadForm" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="fileInput">Choose file</label>
                        <input type="file" class="form-control-file" id="fileInput" name="file" multiple>
                    </div>
                    <div class="form-group">
                        <label for="remarkInput">Remark</label>
                        <input type="text" class="form-control" id="remarkInput" name="remark" placeholder="Enter remark">
                        <input type="hidden" id="idInput" class="form-control mt-2" value="{{ $service->id }}">
                        <input type="hidden" id="nopolInput" class="form-control mt-2"value="{{ $service->nopol }}">
                        {{-- <input type="hidden" id="uploadFileUrl" value="{{ route('bengkel.upload-file') }}"> --}}
                        <meta name="csrf-token" content="{{ csrf_token() }}">
                    </div>
                </form>
                <div id="loader" class="text-center" style="display: none;">
                    <div class="spinner-border text-primary" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="submitUpload">Upload</button>
            </div>
        </div>
    </div>
</div>


{{-- <script src="{{ asset('js/bengkel.js') }}" defer></script> --}}

<script>
    $(document).ready(function () {
    $('#pekerjaan').change(function () {
        var pekerjaan = $(this).val();  // Ambil nilai pekerjaan yang dipilih
        if (pekerjaan === 'NO SERVICE') {
            $('#part').prop('disabled', true);  // Menonaktifkan select part
            $('input[name="remarkpart"]').prop('disabled', true);  
            $('.add_data_part').prop('disabled', true);
            $('#noServiceMessage').show();  // Menampilkan pesan khusus
        } else {
            $('#part').prop('disabled', false);  // Mengaktifkan kembali select part
            $('input[name="remarkpart"]').prop('disabled', false); 
            $('.add_data_part').prop('disabled', false);  
            $('#noServiceMessage').hide();  // Menyembunyikan pesan khusus
        }
    });
});


    $(document).ready(function () {
        let pekerjaanCount = 0;
        let selectedpekerjaan = new Set();

        // Initialize DataTable
        var table = $("#tablepekerjaan").DataTable({
            responsive: true,
            lengthChange: false,
            bInfo: false,
            ordering: false,
        });

            // Handle Add Button Click
        $(".add_data_pekerjaan").on("click", function () {
            const pekerjaanSelect = $("#pekerjaan");
            const selectedOption = pekerjaanSelect.find("option:selected");
            const pekerjaanId = selectedOption.val();
            const pekerjaanName = selectedOption.data("pekerjaan") || pekerjaanId;
            const remark = $('input[name="remarkpekerjaan"]').val().trim();

            // Validation for empty pekerjaan
            if (!pekerjaanId) {
                swal("Error", "Pekerjaan tidak boleh kosong.", "error");
                return;
            }

            if (!remark) {
                swal("Error", "Remark tidak boleh kosong.", "error");
                return;
            }

            if (selectedpekerjaan.has(pekerjaanId)) {
                swal("Error", "Pekerjaan sudah ada.", "error");
                return;
            }

            // Add to selected pekerjaan set and increment count
            selectedpekerjaan.add(pekerjaanId);
            pekerjaanCount++;

            // Add row to DataTable
            table.row
                .add([
                    pekerjaanCount,
                    `<input type="hidden" name="pekerjaan_data[]" value='${JSON.stringify(
                        { id: pekerjaanId, remark: remark }
                    )}'>${pekerjaanName}`,
                    `<input type="hidden" name="remark_pekerjaan[]" value="${remark}">${remark}`,
                    `<a href="javascript:;" class="remove_data text-center">
                        <i class="fas fa-times"></i>
                    </a>`,
                ])
                .draw(false);

            // Update hidden input with selected pekerjaan IDs
            $("#selectedpekerjaanInput").val(Array.from(selectedpekerjaan));

            // Clear input fields
            $('input[name="remarkpekerjaan"]').val("");
            pekerjaanSelect.val("").trigger("change");

            // Disable select, remark, and button if "NO SERVICE" was added
            if (pekerjaanId === "NO SERVICE") {
                $("#pekerjaan").prop("disabled", true);
                $('input[name="remarkpekerjaan"]').prop("disabled", true);
                $(".add_data_pekerjaan").prop("disabled", true);
                 $('#part').prop('disabled', true);  // Menonaktifkan select part
            $('input[name="remarkpart"]').prop('disabled', true);  
            $('.add_data_part').prop('disabled', true);
            }
        });

        // Handle Remove Button Click
        $("#tablepekerjaan tbody").on("click", ".remove_data", function () {
            var row = $(this).closest("tr");
            var pekerjaanId = JSON.parse(row.find('input[name="pekerjaan_data[]"]').val()).id;

            // Remove from selected pekerjaan set
            selectedpekerjaan.delete(pekerjaanId);

            // Remove row from DataTable
            table.row(row).remove().draw(false);

            // Update pekerjaan count and table indexes
            pekerjaanCount--;
            updateTableIndexes();

            // Update hidden input with selected pekerjaan IDs
            $("#selectedpekerjaanInput").val(Array.from(selectedpekerjaan));

            // Re-enable select, remark, and button if "NO SERVICE" was removed
            if (pekerjaanId === "NO SERVICE") {
                $("#pekerjaan").prop("disabled", false);
                $('input[name="remarkpekerjaan"]').prop("disabled", false);
                $(".add_data_pekerjaan").prop("disabled", false);
            }
        });

        // Function to update table row indexes
        function updateTableIndexes() {
            table.rows().every(function (rowIdx) {
                this.cell(rowIdx, 0)
                    .data(rowIdx + 1)
                    .draw(false);
            });
        }


    });



    $(document).ready(function () {
        let partCount = 0;
        let selectedpart = new Set();

        // Initialize DataTable
        var table = $("#tablepart").DataTable({
            responsive: true,
            lengthChange: false,
            bInfo: false,
            ordering: false,
        });

        // Handle Add Button Click
        $(".add_data_part").on("click", function () {
            const partSelect = $("#part");
            const selectedOption = partSelect.find("option:selected");
            const partId = selectedOption.val();
            const partName = selectedOption.data("part");
            const remark = $('input[name="remarkpart"]').val().trim();

            // Validation
            if (!partId) {
                swal("Error", "part tidak boleh kosong.", "error");
                return;
            }

            if (!remark) {
                swal("Error", "Remark tidak boleh kosong.", "error");
                return;
            }

            if (selectedpart.has(partId)) {
                swal("Error", "part sudah ada.", "error");
                return;
            }

            // Add to selected part set and increment count
            selectedpart.add(partId);
            partCount++;

            // Add row to DataTable
            table.row
                .add([
                    partCount,
                    `<input type="hidden" name="part_data[]" value='${JSON.stringify(
                        { id: partId, remark: remark }
                    )}'>${partName}`,
                    `<input type="hidden" name="remarks_part[]" value="${remark}">${remark}`,
                    `<a href="javascript:;" class="remove_data">
                    <i class="fas fa-times"></i>
                </a>`,
                ])
                .draw(false);

            // Update hidden input with selected part IDs
            $("#selectedpartInput").val(Array.from(selectedpart));

            // Clear input fields
            $('input[name="remarkpart"]').val("");
            partSelect.val("").trigger("change");
        });

        // Handle Remove Button Click
        $("#tablepart tbody").on("click", ".remove_data", function () {
            var row = $(this).closest("tr");
            var partId = row.find('input[type="hidden"]').first().val();

            // Remove from selected part set
            selectedpart.delete(partId);

            // Remove row from DataTable
            table.row(row).remove().draw(false);

            // Update part count and table indexes
            partCount--;
            updateTableIndexes();

            // Update hidden input with selected part IDs
            $("#selectedpartInput").val(Array.from(selectedpart));
        });

        // Function to update table row indexes
        function updateTableIndexes() {
            table.rows().every(function (rowIdx) {
                this.cell(rowIdx, 0)
                    .data(rowIdx + 1)
                    .draw(false);
            });
        }
    });

    $(document).ready(function () {
        $("#submitUpload").on("click", function () {
            const fileInput = $("#fileInput")[0].files;
            const remarkInput = $("#remarkInput").val().trim();
            const allowedFileTypes = ["image/jpeg", "image/png", "video/mp4"];
            const fileTableBody = $("#fileTable tbody");

            // Validasi input
            if (fileInput.length === 0) {
                swal("Error", "Please select at least one file", "error");
                return;
            }

            if (!remarkInput) {
                swal("Error", "Please input remark", "error");
                return;
            }

            let validFiles = true;

            Array.from(fileInput).forEach((file) => {
                if (!allowedFileTypes.includes(file.type)) {
                    swal(
                        "Error",
                        "Invalid file type. Please upload JPG, PNG images or MP4 videos",
                        "error"
                    );
                    validFiles = false;
                    return;
                }

                if (file.size > 5 * 1024 * 1024) {
                    swal(
                        "Error",
                        "File is too large. Please upload a file smaller than 5MB",
                        "error"
                    );

                    validFiles = false;
                    return;
                }
            });

            if (validFiles) {
                $("#loader").show();
                $("#submitUpload").prop("disabled", true);
                uploadFiles(fileInput, remarkInput);
            }
        });

        $("#fileTable").on("click", ".remove-file", function () {
            $(this).closest("tr").remove();
        });

        function uploadFiles(files, remark) {
            const formData = new FormData();
            const uploadUrl = $("#uploadFileUrl").val();
            const csrfToken = $('meta[name="csrf-token"]').attr("content");
            const id = $("#idInput").val().trim();
            const nopol = $("#nopolInput").val().trim();
            const fileTableBody = $("#fileTable tbody");

            Array.from(files).forEach((file) => {
                formData.append("file[]", file);
            });

            formData.append("remark", remark);
            formData.append("id", id);
            formData.append("nopol", nopol);

            console.log(formData);
            $.ajax({
                headers: { "X-CSRF-TOKEN": csrfToken },
                url: uploadUrl,
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {
                    $("#loader").hide();
                    $("#submitUpload").prop("disabled", false);
                    if (response.success) {
                        swal(
                            "Success",
                            "Files uploaded successfully!",
                            "success"
                        ).then(() => {
                            response.data.forEach((data) => {
                                fileTableBody.append(`
                                    <tr>
                                        <td>${data.filename}</td>
                                        <td>${data.remark}</td>
                                        <td><button type="button" class="btn btn-danger btn-sm remove-file">Remove</button></td>
                                        <input type="hidden" name="upload_data[]" value='${JSON.stringify(
                                            {
                                                filename: data.filename,
                                                remark: data.remark,
                                            }
                                        )}'>
                                    </tr>
                                
            
                                `);
                            });

                            $("#fileInput").val("");
                            $("#remarkInput").val("");
                            $("#uploadModal").modal("hide");
                        });
                    } else {
                        $("#submitUpload").prop("disabled", false);
                        swal(
                            "Error",
                            "Failed to upload files: " + response.message,
                            "error"
                        );
                    }
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    $("#loader").hide(); // Hide loader
                    $("#submitUpload").prop("disabled", false);
                    $("#fileInput").val("");
                    $("#remarkInput").val("");
                    swal("Error", "Error occurred: " + textStatus, "error");
                },
            });
        }
    });

</script>
<script>
    $(document).ready(function(){
        $('#simpan_gps').click(function(){
            // Ambil nilai input
            var nopol = $('input[name="nopol"]').val();
            var install_date = $('input[name="install_date"]').val();
            var sn_gps = $('input[name="sn_gps"]').val();
            var install_date = $('input[name="install_date"]').val();
            var uploadgps1 = $('input[name="uploadgps1"]').prop('files')[0];
            var uploadgps2 = $('input[name="uploadgps2"]').prop('files')[0];
            var uploadgps3 = $('input[name="uploadgps3"]').prop('files')[0];
            var remarkgps = $('textarea[name="remarkgps"]').val();

            // Buat FormData objek
            var formData = new FormData();
            formData.append('nopol', nopol);
            formData.append('sn_gps', sn_gps);
            formData.append('install_date', install_date);
            formData.append('uploadgps1', uploadgps1);
            formData.append('uploadgps2', uploadgps2);
            formData.append('uploadgps3', uploadgps3);
            formData.append('remarkgps', remarkgps);

            // Kirim data ke server menggunakan AJAX
            $.ajax({
                headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'},
                url: "{{ asset('bengkel/gps-posting') }}", 
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                   
                    $('#gpsmodal').modal('hide'); // Menutup modal setelah request berhasil

                    swal("Sukses", "Data GPS berhasil disimpan!", "success").then(function() {
                        $('#customSwitch1').prop('checked', true); // Mengatur switch ke posisi tercentang
                    });
                  
                 
                    
                
                },
                error: function(xhr, status, error) {
                    swal("Warning", "Terjadi kesalahan saat menyimpan data GPS: " + error, "warning").then(function() {
                        $('#customSwitch1').prop('checked', false);
                    });
                    
                  
                }
            });
        });
    });
</script>



<script>
    $(document).ready(function(){
        $('#customSwitch1').click(function(){
            if($(this).is(":checked")) {
                $('#gpsmodal').modal('show');
            } else {
                $('#gpsmodal').modal('hide');
            }
        });

        $('#gpsmodal').on('hidden.bs.modal', function () {
            $('#customSwitch1').prop('checked', false);
        });
    });
</script>

<script>
$(document).ready(function() {
  $("#serviceProcessBengkel").on("submit", function(e) {
    e.preventDefault();

    // Cek setiap field input
    var isFormValid = true;
    $("#serviceProcessBengkel input[required]").each(function() {
      if ($(this).val().trim() === "") {
        isFormValid = false;
        return false; // Hentikan loop jika ada field yang kosong
      }
    });

    if (isFormValid) {
      // Tampilkan SweetAlert untuk konfirmasi hanya jika semua field telah diisi
      swal({
        title: "Apakah Anda yakin?",
        text: "Tindakan ini tidak dapat dibatalkan.",
        icon: "warning",
        buttons: {
          cancel: "Batal",
          confirm: "Konfirmasi"
        },
        dangerMode: true
      }).then(function(result) {
        if (result) {
          
          // Jika pengguna mengonfirmasi, submit formulir secara manual
          submitForm();
        }
      });
    } else {
      // Tampilkan notifikasi bahwa ada field yang kosong
      swal("Error", "Harap isi semua field yang diperlukan.", "error");
    }
  });

  // Jalankan submit form saat tombol "Kirim" diklik
  $("#kirimBtn").on("click", function() {
    $("#serviceProcessBengkel").submit();
  });

async function submitForm() {
    // Dapatkan data form
    var formData = new FormData($("#serviceProcessBengkel")[0]);

    try {
      // Tampilkan animasi loading menggunakan SweetAlert
      swal({
        title: "Mengirim data...",
        icon: "info",
        buttons: false,
        closeOnClickOutside: false,
        closeOnEsc: false,
        position: "center"
      });

      // Kirim data form ke controller menggunakan Ajax
      await $.ajax({
        headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'},
        url: "{{ asset('bengkel/service-proses') }}", 
        method: "POST",
        data: formData,
        processData: false,
        contentType: false,
        success: function(response) {
          // Handle response dari controller di sini
          swal("Sukses", "Data Berhasil Di Kirim!", "success").then(function() {
            // Redirect ke halaman lain jika diperlukan
            window.location.href = "{{ asset('bengkel/list-service') }}";
          });
        },
        error: function(error) {
          console.error("Gagal mengirimkan formulir:", error);
        }
      });
    } catch (error) {
      console.error("Gagal mengirimkan formulir:", error);
    }
  }
});



</script>



