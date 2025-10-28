@if (!empty(session('error')))
    <div class="alert alert-danger text-center" role="alert">
        <i class="fas fa-ban"></i> {{ session('error') }}
    </div>
@endif
@if (Session::get('success'))
    <div class="alert alert-success text-center" role="alert">
        <i class="fas fa-check-circle"></i> {{ Session::get('success') }}</li>
    </div>
@endif
