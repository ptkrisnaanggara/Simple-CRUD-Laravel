@if ($errors->any())
    <div class="alert alert-danger">
        <ul style="text-align: left !important">
            @foreach ($errors->all() as $error)
                <li><span>{{ $error }}</span></li>
            @endforeach
        </ul>
    </div>
@endif