<div class="body-wrapper-inner mt-4">

    <div class="container-fluid">

        {{-- ================= HEADER ================= --}}
        <div class="card border-0 shadow-sm mb-4 overflow-hidden"
            style="background:linear-gradient(135deg,#00529C,#0d6efd); border-radius:18px;">

            <div class="card-body p-4 text-white">

                <div class="row align-items-center">

                    <div class="col-md-8">

                        <h2 class="fw-bold mb-2" style="color: #f8fbff">
                            Selamat Datang, {{ auth()->user()->name }}
                        </h2>

                        <p class="mb-0 opacity-75">
                            DataFlow - Enterprise Excel Processing System
                        </p>

                    </div>

                    <div class="col-md-4 text-end d-none d-md-block">

                        <i class="ti ti-database fs-1"></i>

                    </div>

                </div>

            </div>

        </div>

        {{-- ================= STATISTIK ================= --}}

        <div class="row g-4">

            <div class="col-xl-3 col-md-6">

                <div class="card border-0 shadow-sm stat-card">

                    <div class="card-body">

                        <div class="d-flex justify-content-between">

                            <div>

                                <small class="text-muted">
                                    Total Upload
                                </small>

                                <h2 class="fw-bold mt-2">
                                    {{ $totalUpload }}
                                </h2>

                            </div>

                            <div class="icon-circle bg-primary">

                                <i class="ti ti-upload text-white fs-4"></i>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

            <div class="col-xl-3 col-md-6">

                <div class="card border-0 shadow-sm stat-card">

                    <div class="card-body">

                        <div class="d-flex justify-content-between">

                            <div>

                                <small class="text-muted">
                                    Berhasil
                                </small>

                                <h2 class="fw-bold text-success mt-2">
                                    {{ $successUpload }}
                                </h2>

                            </div>

                            <div class="icon-circle bg-success">

                                <i class="ti ti-circle-check text-white fs-4"></i>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

            <div class="col-xl-3 col-md-6">

                <div class="card border-0 shadow-sm stat-card">

                    <div class="card-body">

                        <div class="d-flex justify-content-between">

                            <div>

                                <small class="text-muted">
                                    Gagal
                                </small>

                                <h2 class="fw-bold text-danger mt-2">
                                    {{ $failedUpload }}
                                </h2>

                            </div>

                            <div class="icon-circle bg-danger">

                                <i class="ti ti-alert-circle text-white fs-4"></i>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

            <div class="col-xl-3 col-md-6">

                <div class="card border-0 shadow-sm stat-card">

                    <div class="card-body">

                        <div class="d-flex justify-content-between">

                            <div>

                                <small class="text-muted">
                                    Upload Hari Ini
                                </small>

                                <h2 class="fw-bold text-primary mt-2">
                                    {{ $todayUpload }}
                                </h2>

                            </div>

                            <div class="icon-circle bg-info">

                                <i class="ti ti-calendar text-white fs-4"></i>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

        {{-- ================= UPLOAD ================= --}}

        <div class="card border-0 shadow-sm mt-4">

            <div class="card-header bg-white border-0 pt-4">

                <h4 class="fw-bold mb-1">

                    Upload File Excel

                </h4>

                <small class="text-muted">

                    Upload file Excel (.xlsx / .xls) untuk diproses oleh sistem.

                </small>

            </div>

            <div class="card-body">

                @if(session()->has('success'))

                <div class="alert alert-success">

                    {{ session('success') }}

                </div>

                @endif

                @error('file')

                <div class="alert alert-danger">

                    {{ $message }}

                </div>

                @enderror

                <form wire:submit.prevent="upload" enctype="multipart/form-data">

                    <div class="upload-area">

                        <i class="ti ti-file-spreadsheet upload-icon"></i>

                        <h5 class="fw-bold mt-3">
                            Pilih File Excel
                        </h5>

                        <p class="text-muted">
                            Format yang didukung :
                            <strong>.xlsx</strong> &
                            <strong>.xls</strong>
                        </p>

                        <input type="file" wire:model.live="file" class="form-control">

                        <hr>

                        <pre>
                        @json($file)
                        </pre>

                    </div>

                    <div class="text-end mt-4">

                        <button type="submit" class="btn btn-primary px-5">

                            <i class="ti ti-upload me-2"></i>

                            Upload & Process

                        </button>

                    </div>

                </form>

            </div>

        </div>

        {{-- ================= PREVIEW FILE ================= --}}

        <div class="d-flex justify-content-between align-items-center mt-5 mb-3">

            <div>

                <h4 class="fw-bold mb-1">
                    File Terbaru
                </h4>

                <small class="text-muted">
                    Daftar file yang telah diupload.
                </small>

            </div>

        </div>

        <div class="row g-4">

            @forelse($uploads as $item)

            <div class="col-lg-4 col-md-6">

                <div class="card border-0 shadow-sm upload-card h-100">

                    <div class="card-body">

                        <div class="d-flex align-items-center">

                            <div class="excel-icon">

                                <i class="ti ti-file-spreadsheet"></i>

                            </div>

                            <div class="ms-3 flex-grow-1">

                                <h5 class="fw-bold mb-1 text-truncate">

                                    {{ $item->nama_asli }}

                                </h5>

                                <small class="text-muted">

                                    {{ date('d M Y H:i',strtotime($item->created_at)) }}

                                </small>

                            </div>

                        </div>

                        <hr>

                        <div class="row text-center">

                            <div class="col-6">

                                <small class="text-muted">

                                    Total Data

                                </small>

                                <h5 class="fw-bold">

                                    {{ $item->total_data }}

                                </h5>

                            </div>

                            <div class="col-6">

                                <small class="text-muted">

                                    Status

                                </small>

                                <br>

                                @if($item->status=="Processed")

                                <span class="badge bg-success px-3 py-2">

                                    Processed

                                </span>

                                @elseif($item->status=="Failed")

                                <span class="badge bg-danger px-3 py-2">

                                    Failed

                                </span>

                                @else

                                <span class="badge bg-warning text-dark px-3 py-2">

                                    Uploaded

                                </span>

                                @endif

                            </div>

                        </div>

                        <hr>

                        <div class="d-grid gap-2">

                            <button class="btn btn-outline-primary">

                                <i class="ti ti-eye me-2"></i>

                                Detail

                            </button>

                            <button class="btn btn-success">

                                <i class="ti ti-download me-2"></i>

                                Download

                            </button>

                            <button wire:click="delete({{ $item->idupload }})"
                                wire:confirm="Yakin ingin menghapus file ini?" class="btn btn-outline-danger">

                                <i class="ti ti-trash me-2"></i>

                                Delete

                            </button>

                        </div>

                    </div>

                </div>

            </div>

            @empty

            <div class="col-lg-12">

                <div class="card border-0 shadow-sm">

                    <div class="card-body text-center py-5">

                        <i class="ti ti-file-search text-primary" style="font-size:70px;"></i>

                        <h4 class="mt-3">

                            Belum Ada File

                        </h4>

                        <p class="text-muted">

                            Upload file Excel pertama untuk mulai memproses data.

                        </p>

                    </div>

                </div>

            </div>

            @endforelse

            <style>
                .body-wrapper-inner {

                    padding-top: 25px;

                }

                .stat-card {
                    transition: .3s;
                    border-radius: 18px;
                }

                .stat-card:hover {
                    transform: translateY(-5px);
                }

                .icon-circle {
                    width: 60px;
                    height: 60px;
                    border-radius: 50%;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                }

                .upload-area {

                    border: 2px dashed #0d6efd;

                    border-radius: 18px;

                    padding: 50px;

                    text-align: center;

                    background: #f8fbff;

                    transition: .3s;

                }

                .upload-area:hover {

                    background: #eef6ff;

                }

                .upload-icon {

                    font-size: 70px;

                    color: #0d6efd;

                }

                .card {

                    border-radius: 18px;

                }

                .upload-card {

                    border-radius: 20px;

                    transition: .35s;

                    overflow: hidden;

                }

                .upload-card:hover {

                    transform: translateY(-8px);

                    box-shadow: 0 15px 35px rgba(0, 82, 156, .18) !important;

                }

                .excel-icon {

                    width: 65px;

                    height: 65px;

                    border-radius: 18px;

                    background: #e8f1ff;

                    display: flex;

                    align-items: center;

                    justify-content: center;

                    color: #00529C;

                    font-size: 30px;

                }

                .btn {

                    border-radius: 12px;

                }

                .badge {

                    border-radius: 30px;

                }
            </style>

        </div>

    </div>

</div>