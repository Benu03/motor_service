@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ asset('admin-ts3/invoice/submit') }}" enctype="multipart/form-data" method="post" accept-charset="utf-8">
{{ csrf_field() }}
<input type="hidden" name="invoice_no" value="{{ $invoice_no }}">


<div class="form-group row">

	<div class="col-sm-12">
		<div class="form-group pull-right btn-group">
			<input type="submit" name="submit" class="btn btn-primary " value="Kirim">
			<input type="submit" name="reset" class="btn btn-danger " value="Reset">
			{{-- <a href="{{ asset('admin-ts3/invoice/client') }}" class="btn btn-danger">Kembali</a> --}}
		</div>
	</div>
	<div class="clearfix"></div>
</div>
</form>



