<div class="container-fluid mt-4">

    <div class="card shadow border-0">

        <div class="card-header bg-primary text-white">

            <div class="d-flex justify-content-between align-items-center">

                <h4 class="mb-0">

                    {{ $upload->nama_asli }}

                </h4>

                <a href="{{ route('dashboard') }}"
                    class="btn btn-light">

                    Kembali

                </a>

            </div>

        </div>

        <div class="card-body">

            {!! $html !!}

        </div>

    </div>

</div>