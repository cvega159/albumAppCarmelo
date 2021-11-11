@extends('base')

@section('container')
    <h1>{{ $enterprise }}</h1>
    @isset($message)
        <div class="alert alert-{{ $type }}" role="alert">
            {{ $message }}
        </div>
    @endisset
    <table class="table table-striped">
    <thead>
        <tr>
            <th scope="col">#Id</th>
            <th scope="col">Name</th>
            <th scope="col">Price</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($resources as $resource)
            <tr>
                <td>
                    <p>{{$resource['id']}}</p>
                    
                </td>
                <td>
                    {{ $resource['name'] }}
                </td>
                <td>
                    {{ $resource['priece'].'€' }}
                </td>
                <td>
                    <form class="deleteForm" action="{{ url('resource/' . $resource['id']) }}" method="get">
                        <input type="submit" value="Show"/>
                    </form>
                </td>
                <td>
                    <form class="deleteForm" action="{{ url('resource/' . $resource['id'] . '/edit') }}" method="get">
                        <input type="submit" value="Edit"/>
                    </form>
                </td>
                <td>
                    <form class="deleteForm" action="{{ url('resource/' . $resource['id']) }}" method="post">
                        @method('delete')
                        @csrf
                        <input type="submit" value="Delete"/>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
<a href="{{ url('resource/create') }}" class="btn btn-primary btn-lg" type="button">Add new product</a>

@endsection