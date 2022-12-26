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

                <a class="btn btn-small btn-success mb-3" href="{{ route('checkRequest') }}">Pinjam Aset</a>

                <div class="card">
                    <div class="card-header">{{ __('Dashboard Mahasiswa') }}</div>

                    <div class="card-body">

                        @if(session('message'))
                            <div class="alert alert-success">{{ session('message') }}</div>
                        @endif

                        <table id="myTable" class="table">
                            <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Tujuan Peminjaman</th>
                                <th scope="col">Tanggal Pinjam</th>
                                <th scope="col">Tanggal Kembali</th>
                                <th scope="col">Lihat aset</th>
                                <th scope="col">Status</th>
                                <th scope="col">Aksi</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($data as $index => $req)
                                <tr>
                                    {{--                masukin kolom--}}
                                    <th scope="row">{{$index+1}}</th>
                                    <td>{{$req->purpose}}</td>
                                    <td>{{date("d M Y H:i", strtotime($req->book_date))}}</td>
                                    <td>{{date("d M Y H:i", strtotime($req->return_date))}}</td>
                                    <td><span class="material-symbols-outlined">visibility</span></td>
                                    <td>{{$req->status}}</td>
                                    <td>
                                        Cancel
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>


                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
