<div
    class="position-relative overflow-hidden text-bg-light min-vh-100 d-flex align-items-center justify-content-center">

    <div class="d-flex align-items-center justify-content-center w-100">
        <div class="row justify-content-center w-100">
            <div class="col-md-8 col-lg-6 col-xxl-3">
                <div class="card mb-0 shadow">
                    <div class="card-body">
                        <div class="text-center mb-4">
                            {{-- Ganti dengan logo perusahaan nanti --}}
                            <img src="{{ asset('assets/images/logos/logo.svg') }}" width="120">
                            <h3 class="mt-3 fw-bold">
                                DATAFLOW
                            </h3>
                            <p class="text-muted">
                                Upload • Generate • Download
                            </p>
                        </div>

                        <form wire:submit="login">
                            <div class="mb-3">
                                <label class="form-label">
                                    Email
                                </label>
                                <input type="email" class="form-control" wire:model="email">
                                @error('email')
                                <small class="text-danger">
                                    {{ $message }}
                                </small>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label class="form-label">
                                    Password
                                </label>
                                <input type="password" class="form-control" wire:model="password">
                                @error('password')
                                <small class="text-danger">
                                    {{ $message }}
                                </small>
                                @enderror
                            </div>

                            @if(session()->has('error'))

                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                            @endif
                            <button type="submit" class="btn btn-primary w-100">
                                Login
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>