
<div class="modal fade" id="upload"  role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">

				<h4 class="modal-title mr-4" id="myModalLabel">Upload Branch?</h4>
				<div class="btn-group">						  
					<a href="{{ asset('admin-ts3/template-upload-branch') }}"class="btn btn-secondary">
						<i class="far fa-file-excel"></i> Download Template File Upload
					</a>
				
			   </div>
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			</div>


			<div class="modal-body">

			
				<form action="{{ asset('admin-ts3/upload-branch-proses') }}" enctype="multipart/form-data" method="post" accept-charset="utf-8" id="fileUploadForm">
				{{ csrf_field() }}
				
				
				
				
				<div class="row form-group">
					<label class="col-md-3 control-label text-right">Upload File Branch</label>
					<div class="col-md-9">
					  <input type="file" name="branch" class="form-control" placeholder="Upload File Branch">	 
					</div>
					
				  </div>


				<div class="form-group row">
					<label class="col-sm-3 control-label text-right"></label>
					<div class="col-sm-9">
						<div class="form-group pull-right btn-group">
							<input type="submit" name="submit" class="btn btn-primary " value="Simpan Data">
							<input type="reset" name="reset" class="btn btn-success " value="Reset">
							<button type="button" class="btn btn-danger " data-dismiss="modal">Close</button>
						</div>
					</div>
					<div class="clearfix"></div>
				</div>
				</form>

			</div>
		</div>
	</div>
</div>



