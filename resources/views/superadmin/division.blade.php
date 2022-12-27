@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
@endsection

@section('js')
    <script defer src="{{ asset('js/datatable.js')}}"></script>
@endsection

@section('content')
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form method="POST" action="{{ route('storeDivision') }}">
                    @csrf
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Departemen Baru</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                            <div class="mb-3">
                                <label for="division-name" class="col-form-label">{{ __('Nama Departemen') }}</label>
                                <input type="text" class="form-control" id="division-name" name="division-name" autocomplete="division-name" autofocus>
                            </div>
                            <div class="mb-3">
                                <label for="division-name" class="col-form-label">{{ __('Pengelola Aset') }}</label>
                                <div class="mt-2">
                                    <input class="form-check-input mt-1" type="checkbox" value="1" id="approver" name="approver" checked onclick="return false" />
                                    <label class="form-check-label" for="approver">Admin</label>
                                    <input class="form-check-input mt-1 ms-2" type="checkbox" value="2" id="approver" name="approver" />
                                    <label class="form-check-label" for="approver">Approver</label>
                                </div>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Tambahkan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">

                <button type="button" class="btn btn-small btn-success mb-3" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    <span class="material-symbols-outlined">add</span>Tambah Departemen Baru
                </button>

                <div class="card">
                    <div class="card-header">{{ __('Dashboard Super Admin') }}</div>

                    <div class="card-body">



                        @if(session('message'))
                            <div class="alert alert-success">{{ session('message') }}</div>
                        @endif

                        <table id="myTable" class="table">
                            <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Nama Departemen</th>
                                <th scope="col">Aksi</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($data as $index => $item)
                                <tr>
                                    {{--                                masukin kolom--}}
                                    <th scope="row">{{$index+1}}</th>
                                    <td>{{$item->name}}</td>
                                    <td>
{{--                                        TODO: ini harusnya pas delete ada confirmation boxnya gimana galangsung kedelete--}}
                                        <form action="{{ url('deleteDivision/' . $item->id) }}" method="post">
                                            <button class="btn btn-small btn-danger" type="submit"><span class="material-symbols-outlined">delete</span></button>
                                            <input type="hidden" name="_method" value="delete" />
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        </form>
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
