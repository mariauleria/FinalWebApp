@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
@endsection

@section('js')
    <script defer src="{{ asset('js/datatable.js')}}"></script>
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">

                <a class="btn btn-small btn-success mb-3" href="{{ route('createRequest') }}">Pinjam Aset</a>

                <div class="card">
                    <div class="card-header">{{ __('Dashboard Mahasiswa') }}</div>

                    <div class="card-body">

                        @if(session('message'))
                            <div class="alert alert-success">{{ session('message') }}</div>
                        @endif


                        You're logged in!


                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
