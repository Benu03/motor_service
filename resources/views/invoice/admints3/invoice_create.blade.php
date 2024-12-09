@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
{{-- <p>
  @include('admin-client/spk/tambah_upload')
</p> --}}
{{-- <form action="{{ asset('bengkel/invoice-create-proses') }}" method="post" accept-charset="utf-8"> --}}
{{-- {{ csrf_field() }} --}}
<div class="row">
   
    <div class="col-md-6">      
				<div class="form-group row">
					<label class="col-sm-3 control-label text-left">Invoice No</label>
					<div class="col-sm-5">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="fa fa-file-contract"></i>
                                </span>
                            </div>
                            <input type="text" class="form-control float-right" id="invoice_no" name="invoice_no" value="{{ $invoice_no }}" required readonly>
                            </div> 
					</div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <button class="btn btn-success " type="button" data-toggle="modal" data-target="#addInvoice">
                                <i class="fas fa-plus-circle"></i> Add Invoice
                            </button>
                            @include('invoice/admints3/add_invoice_bengkel') 
                        </div>
					</div>
				</div>
       
    </div>         
         


</div>



@if ($invoiceData->jasa != null)
<div class="clearfix"><hr></div>
@include('invoice/admints3/invoice_list_admin')

@endif

    




<div class="clearfix"><hr></div>
<div class="row">
    <div class="col-sm-12 text-center">	 
    @include('invoice/admints3/invoice_submit')
    </div>
    </div>
</div>    



{{-- </form> --}}
<!-- 
<script>
    $('#reservation').daterangepicker()
</script> -->




