@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('price-service-edit-process') }}" method="post" enctype="multipart/form-data" accept-charset="utf-8">
    @csrf
    <input type="hidden" name="id" value="{{ $price->id }}">

    <div class="form-group row">
        <label class="col-sm-3 control-label text-right">Kode</label>
        <div class="col-sm-9">
            <input type="text" name="kode" class="form-control" placeholder="Kode" value="{{ $price->kode }}" readonly>
        </div>
    </div>

    <div class="form-group row">
        <label class="col-sm-3 control-label text-right">Name</label>
        <div class="col-sm-9">
            <input type="text" name="service_name" class="form-control" placeholder="Name" value="{{ $price->service_name }}" required>
        </div>
    </div>

    <div class="form-group row">
        <label class="col-sm-3 control-label text-right">Price Bengkel To TS3</label>
        <div class="col-sm-9">
            <input type="text" name="price_bengkel_to_ts3" class="form-control" placeholder="Price Bengkel To TS3" value="{{ $price->price_bengkel_to_ts3 }}" onkeypress="return isNumber(event)" required>
        </div>
    </div>

    <div class="form-group row">
        <label class="col-sm-3 control-label text-right">Client</label>
        <div class="col-sm-9">
            <select name="mst_client_id" id="mst_client_id" class="form-control select2">
                @foreach ($client as $cl)
                    <option value="{{ $cl->id }}" {{ $price->mst_client_id == $cl->id ? 'selected' : '' }}>
                        {{ $cl->client_name }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="form-group row">
        <label class="col-sm-3 control-label text-right">Price TS3 to Client</label>
        <div class="col-sm-9">
            <input type="text" name="price_ts3_to_client" class="form-control" placeholder="Price TS3 to Client" value="{{ $price->price_ts3_to_client }}" onkeypress="return isNumber(event)" required>
        </div>
    </div>

    <div class="form-group row">
        <label class="col-sm-3 control-label text-right">Regional</label>
        <div class="col-sm-9">
            <select name="mst_regional_id[]" id="mst_regional_id" class="form-control select2" multiple>
                @foreach ($regional as $rg)
                    <option value="{{ $rg->id }}" {{ in_array($rg->id, explode(',', $price->regional_id)) ? 'selected' : '' }}>
                        {{ $rg->regional }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="form-group row">
        <label class="col-sm-3 control-label text-right">Type</label>
        <div class="col-sm-9">
            <select name="price_service_type" id="price_service_type" class="form-control select2">
                @foreach ($price_type as $pt)
                    <option value="{{ $pt->value_1 }}" {{ $price->price_service_type == $pt->value_1 ? 'selected' : '' }}>
                        {{ $pt->value_1 }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="form-group row">
        <label class="col-sm-3 control-label text-right"></label>
        <div class="col-sm-9">
            <div class="form-group pull-right btn-group">
                <input type="submit" name="submit" class="btn btn-primary" value="Simpan Data">
                <input type="reset" name="reset" class="btn btn-success" value="Reset">
                <a href="{{ route('price-service') }}" class="btn btn-danger">Kembali</a>
            </div>
        </div>
    </div>
</form>


<script>
    $(document).ready(function () {
        $('.select2').select2({
            width: '100%', // Mengatur select2 agar memenuhi col-md-9
            placeholder: "Pilih opsi",
            allowClear: true
        });
    });

    function isNumber(evt) {
        var charCode = (evt.which) ? evt.which : evt.keyCode;
        if (charCode > 31 && (charCode < 48 || charCode > 57)) {
            return false;
        }
        return true;
    }
</script>
