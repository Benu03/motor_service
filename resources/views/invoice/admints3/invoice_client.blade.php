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
{{-- <form action="{{ asset('admin-ts3/invoice-create') }}" method="post" accept-charset="utf-8">
{{ csrf_field() }} --}}
<div class="row">


  

                    
                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="info-box mb-3">
                        <span class="info-box-icon bg-success elevation-1"><i class="fas fa-money-check"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">
                        Request
                            </span>
                            <span class="info-box-number">
                            {{ $countinvoicets3req }}
                            </span>
                        </div>
                        <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    
           

                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box mb-3">
                    <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-money-check"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">
                       Proses
                        </span>
                        <span class="info-box-number">
                        {{ $countinvoicets3pro }}
                        </span>
                    </div>
                    <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>


        

</div>

<div class="row">
    <div class="col-md-6">
        <div class="btn-group mr-2">
           <a href="{{ route('invoice-client-create') }}" 
            class="btn btn-warning"><i class="fas fa-receipt"></i> Create Invoice Service</a>
        
       </div> 

       <div class="btn-group">
            <a href="{{ route('invoice-client-create-gps') }}" class="btn" style="background-color: #15edac; color: #000000; border-color: #15edac;">
                <i class="fas fa-receipt"></i> Create Invoice GPS
            </a>
        </div>
  </div>
  
  </div>
  
<div class="clearfix"><hr></div>
<div class="table-responsive mailbox-messages">
    <div class="table-responsive mailbox-messages">
<table id="example1" class="display table table-bordered" cellspacing="0" width="100%" style="font-size: 12px;">
<thead>
    <tr class="bg-info">
         
        <th width="10%">Invoice Nomor</th>
        <th width="10%">Invoice Type</th>
        <th width="10%">Tanggal Invoice</th>   
        <th width="10%">Regional</th>   
        <th width="7%">Status</th> 
        <th width="7%">PPH</th>  
        <th width="7%">PPN</th>  
        <th width="7%">Jasa</th>  
        <th width="7%">Part</th>  
        <th width="7%">Total</th>  
        <th width="10%">User Request</th>    
        <th>ACTION</th>
</tr>
</thead>
<tbody>
    <?php $i=1; foreach($invoice as $in) { ?>
        <tr>

        <td><?php echo $in->invoice_no ?></td>
        <td><?php echo $in->invoice_type ?></td>
        <td><?php echo $in->created_date ?></td>
        <td><?php echo $in->regional ?></td>
        <td><?php echo $in->status ?></td>
        <td><?php echo "Rp " . number_format($in->pph,0,',','.'); ?></td>
        <td><?php echo "Rp " . number_format($in->ppn,0,',','.'); ?></td>
        <td><?php echo "Rp " . number_format($in->jasa_total,0,',','.'); ?></td>
        <td><?php echo "Rp " . number_format($in->part_total,0,',','.'); ?></td>
        <td><?php echo "Rp " . number_format(($in->jasa_total - $in->pph) + $in->part_total + $in->ppn,0,',','.'); ?></td>
        <td><?php echo $in->create_by ?></td>
        <td>
            <div class="btn-group">
                @if($in->status == 'PROSES')
                   
                     
                <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#invoiceproses<?php echo $in->id ?>">
                    <i class="fa fa-edit"></i> 
                 </button>  

                 @include('invoice/admints3/invoice_admin_proses') 
                    @endif
                    
                <button type="button" class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#invoiceadmin<?php echo $in->id ?>">
                    <i class="fa fa-eye"></i> 
                 </button>     
            
                 @include('invoice/admints3/invoice_admin_view') 
    
                 
    
            </div>
    
        </td>
    </tr>
    
    <?php $i++; } ?> 

</tbody>
</table>
</div>
</div>
</form>