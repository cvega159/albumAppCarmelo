@extends('base')

@section('container')
<h1>{{ $enterprise }}</h1>

<form action="{{ url('resource/' . $resource['id']) }}" method="post">
    @csrf
    @method('put')
    <input value="{{ old('name') }}" type="text" name="name" placeholder="Name of the product" min-length="5" max-length="30" required />
    <input value="{{ old('priece') }}" type="number" name="priece" placeholder="Price of the product" min="1" step="0.01" required />
    <input type="submit" value="Edit"/>
</form>

@endsection