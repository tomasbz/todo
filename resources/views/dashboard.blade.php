@extends('layouts.layout')

@section('content')
    <div class="container">
        <div class="spacer"></div>
        <div class="row">
            <div class="col">
                @if(count($todos) > 0)
                    <ul class="list-group list-group-flush mt-5 mb-5">
                        @foreach($todos as $todo)
                            <li class="list-group-item mb-2">
                                <h4>{{$todo->title}}</h4>
                                <p>{{$todo->body}}</p>
                                <small>{{$todo->created_at}}</small>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <p class="mt-5">No data found</p>
                @endif
            </div>
        </div>
    </div>
@endsection