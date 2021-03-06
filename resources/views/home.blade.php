@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center align-items-center flex-column">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                </div>
            </div>
        </div>
        <div class="col-md-8 mt-5">
            <example-component dusk="products"></example-component>
        </div>
    </div>
</div>
@endsection
