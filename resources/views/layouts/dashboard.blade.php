{{-- HEADER --}}
<div class="row mb-4">

    <div class="col-12">

        <div class="card border-0 shadow-lg overflow-hidden"
            style="background:linear-gradient(135deg,#0052D4,#2F80ED); border-radius:20px;">

            <div class="card-body py-4 px-5">

                <div class="row align-items-center">

                    <div class="col-lg-8">

                        <span class="badge bg-white text-primary px-3 py-2 mb-3">

                            Enterprise Dashboard

                        </span>

                        <h2 class="text-white fw-bold mb-2">

                            Selamat Datang,

                            {{ auth()->user()->name }}

                        </h2>

                        <p class="text-white-50 mb-0 fs-5">

                            Kelola upload, preview, edit, generate, dan download file Excel
                            secara cepat dan aman.

                        </p>

                    </div>

                    <div class="col-lg-4 text-end">

                        <div class="bg-white bg-opacity-25 rounded-circle d-inline-flex
                            align-items-center justify-content-center"
                            style="width:90px;height:90px;">

                            <i class="ti ti-file-spreadsheet text-white"
                                style="font-size:42px"></i>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

{{-- Statistik --}}
<div class="row">

  <div class="col-lg-3 col-md-6">
    <div class="card">
      <div class="card-body">

        <div class="d-flex justify-content-between">

          <div>

            <h6>Total Upload</h6>

            <h2>{{ $totalUpload ?? 0 }}</h2>

          </div>

          <div>

            <i class="ti ti-upload fs-1 text-primary"></i>

          </div>

        </div>

      </div>
    </div>
  </div>

  <div class="col-lg-3 col-md-6">
    <div class="card">
      <div class="card-body">

        <div class="d-flex justify-content-between">

          <div>

            <h6>File Berhasil</h6>

            <h2>{{ $successUpload ?? 0 }}</h2>

          </div>

          <div>

            <i class="ti ti-circle-check fs-1 text-success"></i>

          </div>

        </div>

      </div>
    </div>
  </div>

  <div class="col-lg-3 col-md-6">
    <div class="card">
      <div class="card-body">

        <div class="d-flex justify-content-between">

          <div>

            <h6>Total Download</h6>

            <h2>{{ $totalDownload ?? 0 }}</h2>

          </div>

          <div>

            <i class="ti ti-download fs-1 text-info"></i>

          </div>

        </div>

      </div>
    </div>
  </div>

  <div class="col-lg-3 col-md-6">
    <div class="card">
      <div class="card-body">

        <div class="d-flex justify-content-between">

          <div>

            <h6>Hari Ini</h6>

            <h2>{{ $todayUpload ?? 0 }}</h2>

          </div>

          <div>

            <i class="ti ti-calendar fs-1 text-warning"></i>

          </div>

        </div>

      </div>
    </div>
  </div>

</div>

{{-- Tombol Cepat --}}
<div class="row">

  <div class="col-lg-6">

    <div class="card">

      <div class="card-body text-center">

        <i class="ti ti-upload fs-1 text-primary"></i>

        <h4 class="mt-3">

          Upload File Excel

        </h4>

        <p>

          Upload file Excel untuk diproses.

        </p>

        <a href="{{ url('/upload') }}" class="btn btn-primary">

          Upload Sekarang

        </a>

      </div>

    </div>

  </div>

  <div class="col-lg-6">

    <div class="card">

      <div class="card-body text-center">

        <i class="ti ti-history fs-1 text-success"></i>

        <h4 class="mt-3">

          History

        </h4>

        <p>

          Lihat seluruh riwayat upload dan download.

        </p>

        <a href="{{ url('/history') }}" class="btn btn-success">

          Lihat History

        </a>

      </div>

    </div>

  </div>

</div>

{{-- Riwayat Upload --}}
<div class="row">

  <div class="col-12">

    <div class="card">

      <div class="card-body">

        <h4 class="card-title">

          Riwayat Upload Terbaru

        </h4>

        <div class="table-responsive mt-4">

          <table class="table table-bordered">

            <thead class="table-light">

              <tr>

                <th>No</th>

                <th>Nama File</th>

                <th>Total Data</th>

                <th>Status</th>

                <th>Tanggal Upload</th>

              </tr>

            </thead>

            <tbody>

              @forelse($uploads ?? [] as $item)

              <tr>

                <td>{{ $loop->iteration }}</td>

                <td>{{ $item->nama_asli }}</td>

                <td>{{ $item->total_data }}</td>

                <td>

                  @if($item->status=='Processed')

                  <span class="badge bg-success">

                    Berhasil

                  </span>

                  @elseif($item->status=='Failed')

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

                  {{ $item->created_at }}

                </td>

              </tr>

              @empty

              <tr>

                <td colspan="5" class="text-center">

                  Belum ada data upload.

                </td>

              </tr>

              @endforelse

            </tbody>

          </table>

        </div>

      </div>

    </div>

  </div>

</div>