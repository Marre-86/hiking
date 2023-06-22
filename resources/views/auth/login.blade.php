@extends('layouts.main')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card">
                    <h3 class="card-header">{{ __('Login') }}</h3>
                    <div class="card-body">
                        <form method="POST" action="{{ route('login') }}">
                        @csrf
                            <div class="form-group row">
                                <div class="col-md-7 text-center mx-auto">
                                    <a href="{{route('login.google')}}" class="btn btn-danger btn-block mb-2">Login with Google</a>
                                    <a href="{{route('login.facebook')}}" class="btn btn-primary btn-block mb-2">Login with Facebook</a>
                                    <a href="{{route('login.github')}}" class="btn btn-dark btn-block">Login with Github</a>
                                </div>
                            </div>   
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection