@if(session('success'))
    <div class="alert-box success">{{ session('success') }}</div>
@endif
@if($errors->any())
    <div class="alert-box error">
        <ul>@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
    </div>
@endif
