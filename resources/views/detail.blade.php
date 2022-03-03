@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
                <div class="card text-center">
                    <div class="card-header">
                        <img class="rounded-circle" src="{{URL::asset('/storage/images/'.$data->image)}}" alt="" height="80" width="80">
                    </div>
                            <div class="card-body">
                                <h5 class="card-title">{{$data->name}}</h5>
                                <p class="card-text">{{$data->email}}</p>
                                <a href="#" class="btn btn-primary">Book Here</a>
                            </div>
                            <div class="card-footer text-muted">
                                2 days ago
                            </div>
                </div> 
        </div>
    </div>
</div>
            
@endsection