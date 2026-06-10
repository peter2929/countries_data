@extends('layouts.app')

@section('content')
<p class="message">
    @if ($success)
        The data was successfully imported. Go to <a href="/">Main</a> to have a look.
    @else
        The import has failed. Please try again.
    @endif
</p>
@endsection
