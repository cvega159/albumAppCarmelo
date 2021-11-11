@extends('base')

@section('container')  
  <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
    <div class="col">
      <div class="card shadow-sm">
        <img src="{{url('images/bolleria.jpg')}}" width="100%" height="225">
        <div class="card-body">
          <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
          <div class="d-flex justify-content-between align-items-center">
            <div class="btn-group">
              <a href="{{ url('resource') }}"><button type="button" class="btn btn-sm btn-outline-secondary">COMPRA</button></a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  @endsection