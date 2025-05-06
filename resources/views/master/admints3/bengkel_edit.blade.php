<div class="row">
    {{-- Form Edit Bengkel --}}
    <div class="col-md-6">

		@if ($errors->any())
			<div class="alert alert-danger">
				<ul>
					@foreach ($errors->all() as $error)
						<li>{{ $error }}</li>
					@endforeach
				</ul>
			</div>
		@endif

		<form action="{{ asset('admin-ts3/bengkel/proses_edit') }}" enctype="multipart/form-data" method="post" accept-charset="utf-8">
			@csrf
			<input type="hidden" name="id" value="{{ $bengkel->id }}">

			<div class="form-group row">
				<label class="col-sm-3 control-label text-right">Bengkel</label>
				<div class="col-sm-9">
					<input type="text" name="bengkel_name" class="form-control" placeholder="Bengkel Name" value="{{ $bengkel->bengkel_name }}" required>
				</div>
			</div>

			<div class="form-group row">
				<label class="col-sm-3 control-label text-right">Alias</label>
				<div class="col-sm-9">
					<input type="text" name="bengkel_alias" class="form-control" placeholder="Bengkel Alias" value="{{ $bengkel->bengkel_alias }}" required readonly>
				</div>
			</div>

			<div class="form-group row">
				<label class="col-sm-3 control-label text-right">PIC Bengkel</label>
				<div class="col-sm-9">
					<select name="pic_bengkel" class="form-control select2">
						@foreach ($userbengkel as $ub)
							<option value="{{ $ub->username }}" {{ $bengkel->pic_bengkel == $ub->username ? 'selected' : '' }}>
								{{ $ub->fullname }}
							</option>
						@endforeach
					</select>
				</div>
			</div>

			<div class="form-group row">
				<label class="col-sm-3 control-label text-right">Phone</label>
				<div class="col-sm-9">
					<input type="text" name="phone" class="form-control" placeholder="Phone" value="{{ $bengkel->phone }}" required>
				</div>
			</div>

			<div class="form-group row">
				<label class="col-sm-3 control-label text-right">Address</label>
				<div class="col-sm-9">
					<textarea name="address" id="address" class="form-control" placeholder="Address">{{ $bengkel->address }}</textarea>
				</div>
			</div>

			<div class="form-group row">
				<label class="col-sm-3 control-label text-right">Latitude</label>
				<div class="col-sm-9">
					<input type="text" name="latitude" class="form-control" placeholder="Latitude" value="{{ $bengkel->latitude }}" required>
				</div>
			</div>

			<div class="form-group row">
				<label class="col-sm-3 control-label text-right">Longitude</label>
				<div class="col-sm-9">
					<input type="text" name="longitude" class="form-control" placeholder="Longitude" value="{{ $bengkel->longitude }}" required>
				</div>
			</div>

			<div class="form-group row">
				<label class="col-sm-3 control-label text-right"></label>
				<div class="col-sm-9">
					<div class="form-group pull-right btn-group">
						<input type="submit" name="submit" class="btn btn-primary" value="Simpan Data">
						<input type="reset" name="reset" class="btn btn-success" value="Reset">
						<a href="{{ route('bengkel') }}" class="btn btn-danger">Kembali</a>
					</div>
				</div>
				<div class="clearfix"></div>
			</div>
		</form>
	</div>

    {{-- Form Member Bengkel --}}
    <div class="col-md-6">


		<div class="card">
			<div class="card-header bg-primary text-white">
				Tambah Member Bengkel
			</div>
			<div class="card-body">
				<form id="form-add-member">
					@csrf
					<input type="hidden" name="bengkel_id" value="{{ $bengkel->id }}">
		
					<div class="form-group row">
						<label class="col-sm-3 control-label text-right">Member Bengkel</label>
						<div class="col-sm-9">
							<select name="member_bengkel" class="form-control select2" required>
								@foreach ($userbengkel as $ub)
									<option value="{{ $ub->username }}">{{ $ub->fullname }}</option>
								@endforeach
							</select>
						</div>
					</div>
		
					<div class="form-group mt-3 text-end">
						<button type="submit" class="btn btn-success">Tambah Member</button>
					</div>
				</form>
		
				<hr>
		
				<table class="table table-bordered table-striped mt-2" id="table-members">
					<thead class="table-light">
						<tr>
							<th>No</th>
							<th>Username</th>
							<th width="10%">Aksi</th>
						</tr>
					</thead>
					<tbody>
						@foreach ($memberbengkel as $index => $member)
							<tr data-username="{{ $member->username }}">
								<td>{{ $index + 1 }}</td>
								<td>{{ $member->username }}</td>
								<td class="text-center">
									<button class="btn btn-danger btn-sm btn-delete-member" data-username="{{ $member->username }}">x</button>
								</td>
							</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
		
		

    </div>



</div>

<script>
$(document).ready(function () {
    // Tambah member
    $('#form-add-member').on('submit', function (e) {
        e.preventDefault();

        $.ajax({
           url: "{{ route('bengkel-member-add') }}",
            method: "POST",
            data: $(this).serialize(),
            success: function (response) {
                if (response.success) {
                    // Tambahkan ke tabel
                    let newRow = `
                        <tr data-username="${response.username}">
                            <td>${$('#table-members tbody tr').length + 1}</td>
                            <td>${response.username}</td>
                            <td class="text-center">
                                <button class="btn btn-danger btn-sm btn-delete-member" data-username="${response.username}">x</button>
                            </td>
                        </tr>`;
                    $('#table-members tbody').append(newRow);
                } else {
                    alert(response.message);
                }
            },
            error: function () {
                alert("Gagal menambahkan member.");
            }
        });
    });

    // Hapus member
    $(document).on('click', '.btn-delete-member', function () {
        let username = $(this).data('username');
        let bengkelId = "{{ $bengkel->id }}";
        if (confirm("Yakin ingin menghapus member ini?")) {
            $.ajax({
              url: "{{ route('bengkel-member-hapus') }}",
                method: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    username: username,
                    bengkel_id: bengkelId
                },
                success: function (response) {
                    if (response.success) {
                        $(`#table-members tr[data-username="${username}"]`).remove();

						$('#table-members tbody tr').each(function (index) {
							$(this).find('td:first').text(index + 1);
						});

                    } else {
                        alert(response.message);
                    }
                },
                error: function () {
                    alert("Gagal menghapus member.");
                }
            });
        }
    });
});
</script>

