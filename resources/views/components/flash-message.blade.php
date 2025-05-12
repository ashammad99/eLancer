@if(\Illuminate\Support\Facades\Session::has('success'))
    <div class="alert alert-success">
        {{\Illuminate\Support\Facades\Session::get('success')}}
    </div>
@endif

@if(\Illuminate\Support\Facades\Session::has('info'))
    <div class="alert alert-info">
        {{\Illuminate\Support\Facades\Session::get('info')}}
    </div>
@endif

@if(\Illuminate\Support\Facades\Session::has('error'))
    <div class="alert alert-danger">
        {{\Illuminate\Support\Facades\Session::get('error')}}
    </div>
@endif

@if(\Illuminate\Support\Facades\Session::has('warning'))
    <div class="alert alert-warning">
        {{\Illuminate\Support\Facades\Session::get('warning')}}
    </div>
@endif
