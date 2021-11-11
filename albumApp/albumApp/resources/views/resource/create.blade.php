@extends('base')

@section('container')
<h1>{{ $enterprise }}</h1>
<form action="{{ url('resource') }}" method="post">
    @csrf
    <input value="{{ old('name') }}" type="text" name="name" placeholder="Name of the product" min-length="5" max-length="30" required />
    <input value="{{ old('priece') }}" type="number" name="priece" placeholder="Price of the product" min="1" step="0.01" required />
    <input type="submit" value="Create"/>
</form>

@endsection