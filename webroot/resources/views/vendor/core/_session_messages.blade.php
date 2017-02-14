@if(\Illuminate\Support\Facades\Session::has('error'))
    <div class="alert alert-danger">
        <strong>Oooops!</strong> {{ \Illuminate\Support\Facades\Session::get('error') }}
    </div>
@endif

@if(\Illuminate\Support\Facades\Session::has('success'))
    <div class="alert alert-success">
        {{ \Illuminate\Support\Facades\Session::get('success') }}
    </div>
@endif