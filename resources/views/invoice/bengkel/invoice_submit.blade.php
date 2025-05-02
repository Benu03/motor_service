

<form action="{{ asset('bengkel/invoice/submit') }}" enctype="multipart/form-data" method="post" accept-charset="utf-8">
{{ csrf_field() }}
<input type="hidden" name="invoice_no" value="{{ $invoice_no }}">


<div class="form-group row">
	<label class="col-sm-3 control-label text-right"></label>
	<div class="col-sm-9">
		<div class="form-group pull-right btn-group">
			<input type="submit" name="submit" class="btn btn-primary " value="Kirim Data">
			<a href="{{ asset('bengkel/invoice-reset') }}/{{ $invoice_no }}" class="btn btn-success">Reset </a>
			<a href="{{ asset('bengkel/invoice') }}" class="btn btn-danger">Kembali</a>
		</div>
	</div>
	<div class="clearfix"></div>
</div>
</form>

