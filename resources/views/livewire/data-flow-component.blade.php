<div class="row">
    <div class="col-12">
        <div class="card">

            <div class="card-header bg-primary text-white">
                <h4 class="mb-0">Upload File Excel</h4>
            </div>

            <div class="card-body">

                @if (session()->has('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                @if (session()->has('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif

                <div class="mb-3">
                    <label class="form-label">
                        Pilih File Excel
                    </label>

                    <input
                        type="file"
                        class="form-control"
                        wire:model="file"
                        accept=".xlsx,.xls">

                    @error('file')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div wire:loading wire:target="file" class="mb-2">
                    <span class="text-primary">
                        Sedang mengunggah file...
                    </span>
                </div>

                <button
                    type="button"
                    class="btn btn-primary"
                    wire:click="processUpload"
                    wire:loading.attr="disabled">

                    <span wire:loading.remove wire:target="processUpload">
                        Upload & Process
                    </span>

                    <span wire:loading wire:target="processUpload">
                        Processing...
                    </span>

                </button>

            </div>

        </div>
    </div>
</div>