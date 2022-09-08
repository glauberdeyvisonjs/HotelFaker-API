@if ($message = Session::get('success'))
<div class="alert alert-success">
        {{ $message }}
</div>
@endif


@if ($message = Session::get('error'))
<div class="alert alert-error">
        {{ $message }}
</div>
@endif


@if ($message = Session::get('warning'))
<div class="alert alert-warning">
	    {{ $message }}
</div>
@endif


@if ($message = Session::get('info'))
<div class="alert alert-info">
	    {{ $message }}
</div>
@endif