@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    {{-- @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in! --}}

                    <p>Token: {{ Request()->user()->api_token ?? 'N/A' }}</p>

                    {{-- <p>Token: 
                        @if(session()->has('api_token'))
                            {{ session()->get('api_token') }}
                        @endif
                    </p> --}}
                    <form action="{{ route('home') }}" method="post">
                        @csrf
                        <button type="submit" class="btn btn-primary">Token Generate</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
