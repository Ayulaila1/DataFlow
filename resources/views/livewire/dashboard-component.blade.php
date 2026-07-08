<div class="body-wrapper-inner">

    <div class="container-fluid">

        {{-- HEADER --}}
        <div class="card bg-primary text-white mb-4">

            <div class="card-body">

                <h3>

                    Selamat Datang,
                    {{ auth()->user()->name }}

                </h3>

                <p class="mb-0">

                    Sistem DataFlow

                </p>

            </div>

        </div>

        {{-- CARD --}}
        <div class="row">

            <div class="col-md-3">

                <div class="card">

                    <div class="card-body">

                        <h6>Total Upload</h6>

                        <h2>{{ $totalUpload }}</h2>

                    </div>

                </div>

            </div>

            <div class="col-md-3">

                <div class="card">

                    <div class="card-body">

                        <h6>Berhasil</h6>

                        <h2 class="text-success">

                            {{ $successUpload }}

                        </h2>

                    </div>

                </div>

            </div>

            <div class="col-md-3">

                <div class="card">

                    <div class="card-body">

                        <h6>Gagal</h6>

                        <h2 class="text-danger">

                            {{ $failedUpload }}

                        </h2>

                    </div>

                </div>

            </div>

            <div class="col-md-3">

                <div class="card">

                    <div class="card-body">

                        <h6>Upload Hari Ini</h6>

                        <h2 class="text-primary">

                            {{ $todayUpload }}

                        </h2>

                    </div>

                </div>

            </div>

        </div>

        {{-- TABEL --}}
        <div class="card mt-4">

            <div class="card-header">

                <h5>

                    Upload Terbaru

                </h5>

            </div>

            <div class="card-body">

                <div class="table-responsive">

                    <table class="table table-bordered">

                        <thead>

                            <tr>

                                <th>No</th>

                                <th>Nama File</th>

                                <th>Total Data</th>

                                <th>Status</th>

                                <th>Tanggal</th>

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

                                    {{ $item->total_data }}

                                </td>

                                <td>

                                    @if($item->status=="Processed")

                                    <span class="badge bg-success">

                                        Berhasil

                                    </span>

                                    @elseif($item->status=="Failed")

                                    <span class="badge bg-danger">

                                        Gagal

                                    </span>

                                    @else

                                    <span class="badge bg-warning">

                                        Uploaded

                                    </span>

                                    @endif

                                </td>

                                <td>

                                    {{ date('d M Y H:i',strtotime($item->created_at)) }}

                                </td>

                            </tr>

                            @empty

                            <tr>

                                <td colspan="5" class="text-center">

                                    Belum ada upload.

                                </td>

                            </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

        {{-- BUTTON --}}
        <form wire:submit.prevent="upload">

            <input type="file" wire:model="file" class="form-control">

            <button class="btn btn-primary mt-3">

                Upload

            </button>

        </form>

    </div>

</div>