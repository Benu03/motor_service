<div class="modal fade" id="Tambah" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #709c0b; color: white;">
                <h4 class="modal-title" id="myModalLabel">Tambah Data</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">
                <form action="{{ route('bengkel-add') }}" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}

                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label text-right">Bengkel Name</label>
                        <div class="col-sm-9">
                            <input type="text" name="bengkel_name" class="form-control" placeholder="Bengkel Name" value="{{ old('bengkel_name') }}" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label text-right">PIC Bengkel</label>
                        <div class="col-sm-9">
                            <select name="pic_bengkel" id="pic_bengkel" class="form-control select2">
                                <option selected disabled>Pilih</option>
                                @foreach($userbengkel as $ub)
                                    <option value="{{ $ub->username }}">{{ $ub->fullname }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label text-right">Phone</label>
                        <div class="col-sm-9">
                            <input type="text" name="phone" class="form-control" placeholder="Phone" value="{{ old('phone') }}" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label text-right">Address</label>
                        <div class="col-sm-9">
                            <textarea name="address" id="address" class="form-control" placeholder="Address">{{ old('address') }}</textarea>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label text-right">Latitude</label>
                        <div class="col-sm-9">
                            <input type="text" name="latitude" class="form-control" placeholder="Latitude" value="{{ old('latitude') }}" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label text-right">Longitude</label>
                        <div class="col-sm-9">
                            <input type="text" name="longitude" class="form-control" placeholder="Longitude" value="{{ old('longitude') }}" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-sm-9 offset-sm-3">
                            <div class="btn-group">
                                <button type="submit" class="btn btn-primary">Simpan Data</button>
                                <button type="reset" class="btn btn-success">Reset</button>
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
