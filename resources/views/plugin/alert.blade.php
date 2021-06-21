@if (session()->has('warning'))
    <div class="alert alert-warning gradient-45deg-red-pink" style="color: #2f4f4f!important">
        {!! session()->get('warning') !!}
    </div>
@endif
@if (session()->has('info'))
    <div class="alert alert-info" style="color: #2f4f4f!important">
        {!! session()->get('info') !!}
    </div>
@endif
@if (session()->has('success'))
    <div class="alert alert-success gradient-45deg-green-teal" style="color: #2f4f4f!important;background: lightgreen">
        {!! session()->get('success') !!}
    </div>
@endif
@if (session()->has('danger'))
    <div class="alert alert-danger gradient-45deg-red-pink" style="color: #2f4f4f; #fff !important;">
        {!! session()->get('danger') !!}
    </div>
@endif 