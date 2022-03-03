@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            
                <div class="card">
                    <div class="card-header">
                        <img class="rounded" src="{{URL::asset('/storage/images/'.$counsellor->image)}}" alt="" height="30" width="30">
                        {{$counsellor->name}}
                    </div>
                    <div class="card-body">
                        @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                        @endif
                        <form method="PUT" action="{{ route('counsellor.update') }}" enctype="multipart/form-data">
                            @csrf
                            <input type="text" hidden name="id" value="{{$counsellor->id}}">
                            <input type="text" hidden name="old_image" value="{{$counsellor->image}}">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Name</label>
                                <input type="text" name="name" class="form-control" id="exampleInputEmail1" value="{{old('name', $counsellor->name)}}">
                            </div>

                            <div class="form-group">
                                <label>Questons</label>
                                @foreach($questions as $ques)
                                <div id="inputFormRow">
                                    <div class="input-group mb-3">
                                        <input type="text" name="question[]" class="form-control m-input" value="{{old('question[]', $ques->name)}}" autocomplete="off">
                                        <div class="input-group-append">
                                            <button id="removeRow" type="button" class="btn btn-danger rounded-circle ml-3">X</button>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                                <div id="newRow"></div>
                                <button id="addRow" type="button" class="btn btn-info">Add more questions</button>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Email address</label>
                                <input type="email" name="email" class="form-control" id="exampleInputEmail1" value="{{old('email', $counsellor->email)}}">
                                <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Password</label>
                                <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                            </div>
                            <div class="form-group">
                                <input type="file" name="image" class="form-control-file" style="border: none">
                            </div>
                            <button type="submit" class="btn btn-primary ">Update</button>
                        </form>
                        {{-- Table --}}
                        {{-- <table class="table">
                            <tbody>
                                @foreach($counsellor as $index => $c)
                                    {{-- <tr>
                                        <th scope="row">{{$index+1}}</th>
                                        <td>
                                            <img class="rounded" src="{{URL::asset('/storage/images/'.$c->image)}}" alt="" height="30" width="30">
                                        </td>
                                        <td>{{$c->name}}</td>
                                        <td>{{$c->email}}</td>
                                        <td>
                                            <a href="/edit/{{$c->id}}">
                                                <button class="btn btn-sm btn-info">Edit</button>
                                            </a>
                                            <button class="btn btn-sm btn-danger">Delete</button>
                                        </td>
                                    </tr> --}}
                                {{-- @endforeach
                            </tbody>
                        </table> --}}
                        {{-- Table --}}
                        
                    </div>
                </div> 
        </div>
    </div>
</div>
            
@endsection
