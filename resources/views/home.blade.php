@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if (Auth::user()->role === 'user')
            <div class="card">
                <div class="card-header">{{ __('This is User') }}</div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    
                    
                    <form method="POST" action="{{route('counsellor.choose')}}" >
                        @csrf
                        @foreach ($questions as $q)
                        <div class="form-group">
                            <label for="exampleFormControlInput1"><h4>{{$q->name}}</h4></label>
                            <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Answer your opinion.."> 
                        </div>
                        <div class="form-group">    
                            <div class="form-check">
                                <input class="form-check-input" name="check[]" type="checkbox" value="{{$q->user->id}}">
                                <label class="form-check-label" for="defaultCheck1">
                                    <small style="color: coral">If this question sane with your conditions, Please tick the check-box
                                    </small>
                                </label>
                            </div>         
                        </div>
                        <hr>
                        @endforeach
                        <button type="submit" class="btn btn-info float-right">Find appropriate counsellors</button>
                    </form>
                    

                </div>
            </div>
            @elseif(Auth::user()->role === 'counsellor')
            <div class="card">
                <div class="card-header">{{ __('This is Counsellor') }}</div>
                    <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    </div>
            </div>
            @else
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
                                @foreach($counsellors as $index => $c)
                                    <tr>
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
                                            
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{-- Table --}}
                        
                    </div>
                </div> 
            @endif
        </div>
    </div>
</div>
            
@endsection
