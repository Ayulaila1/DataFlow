<div class="body-wrapper-inner mt-4">

    <div class="container-fluid">

        <div class="card shadow-sm border-0">

            <div class="card-header bg-white">

                <h4 class="fw-bold">
                    Riwayat Upload
                </h4>

            </div>

            <div class="card-body">

                @if(session()->has('success'))

                <div class="alert alert-success">

                    {{ session('success') }}

                </div>

                @endif

                <div class="row mb-3">

                    <div class="col-md-6">

                        <input type="text" class="form-control" placeholder="Cari nama file..."
                            wire:model.live="search">

                    </div>

                    <div class="col-md-3">

                        <select class="form-select" wire:model.live="status">

                            <option value="">
                                Semua Status
                            </option>

                            <option value="Uploaded">
                                Uploaded
                            </option>

                            <option value="Processed">
                                Processed
                            </option>

                            <option value="Failed">
                                Failed
                            </option>

                        </select>

                    </div>

                </div>

                <div class="table-responsive">

                    <table class="table table-bordered align-middle">

                        <thead class="table-light">

                            <tr>

                                <th>No</th>

                                <th>Nama File</th>

                                <th>Tanggal</th>

                                <th>Total Data</th>

                                <th>Status</th>

                                <th width="220">
                                    Aksi
                                </th>

                            </tr>

                        </thead>

                        <tbody>

                            @forelse($uploads as $item)

                            <tr>

                                <td>

                                    {{ $loop->iteration }}

                                </td>

                                <td>

                                    {{ $item->nama_asli }}

                                </td>

                                <td>

                                    {{ $item->created_at->format('d M Y H:i') }}

                                </td>

                                <td>

                                    {{ $item->total_data }}

                                </td>

                                <td>

                                    @if($item->status=="Processed")

                                    <span class="badge bg-success">

                                        Processed

                                    </span>

                                    @elseif($item->status=="Failed")

                                    <span class="badge bg-danger">

                                        Failed

                                    </span>

                                    @else

                                    <span class="badge bg-warning text-dark">

                                        Uploaded

                                    </span>

                                    @endif

                                </td>

                                <td>

                                    <button class="btn btn-primary btn-sm">

                                        Detail

                                    </button>

                                    <button class="btn btn-success btn-sm">

                                        Download

                                    </button>

                                    <button class="btn btn-danger btn-sm" wire:click="delete({{ $item->idupload }})">

                                        Delete

                                    </button>

                                </td>

                            </tr>

                            @empty

                            <tr>

                                <td colspan="6" class="text-center">

                                    Belum ada data.

                                </td>

                            </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>

                <div class="mt-3">

                    {{ $uploads->links() }}

                </div>

            </div>

        </div>

    </div>

</div>