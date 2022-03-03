@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Counsellors List') }}</div>
                    <div class="card-body">
                        @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                        @endif
                        {{-- Table --}}
                        <table class="table">
                            {{-- <thead>
                                <tr>
                                <th scope="col">#</th>
                                <th scope="col">First</th>
                                <th scope="col">Last</th>
                                <th scope="col">Handle</th>
                                </tr>
                            </thead> --}}
                            <tbody>
                                @foreach($choose_counsellors as $index => $c)
                                    <tr>
                                        <th scope="row">{{$index+1}}</th>
                                        <td>
                                            <img class="rounded" src="{{URL::asset('/storage/images/'.$c->image)}}" alt="" height="30" width="30">
                                        </td>
                                        <td>{{$c->name}}</td>
                                        <td>{{$c->email}}</td>
                                        <td>
                                            <a href="/detail/{{$c->id}}">
                                                <button class="btn btn-sm btn-info">Contact Counsellors</button>
                                            </a>
                                            
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{-- Table --}}
                        
                    </div>
                </div> 
        </div>
    </div>
</div>
            
@endsection
