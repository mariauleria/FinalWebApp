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
                <div class="card">
                    <div class="card-header">{{ __('Kelola Aset') }}</div>

                    <div class="card-body">



                        <table id="myTable" class="table">
                            <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Serial Number</th>
                                <th scope="col">Category</th>
                                <th scope="col">Brand</th>
                                <th scope="col">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($data as $index => $item)
                                <tr>
                                    {{--                masukin kolom--}}
                                    <th scope="row">{{$index+1}}</th>
                                    <td>{{$item->serial_number}}</td>
                                    <td>{{$item->assetCategory->name}}</td>
                                    <td>{{$item->brand}}</td>
                                    <td>
                                        <a class="btn btn-small btn-info" href="{{ URL::to('admin/editAsset/' . $item->id) }}"><span class="material-symbols-outlined">edit_square</span></a>
                                        <form action="{{ url('deleteAsset/' . $item->id) }}" method="post">
                                            <button class="btn btn-small btn-info" type="submit"><span class="material-symbols-outlined">delete</span></button>
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
                <a class="btn btn-small btn-success mt-3" href="{{ route('createAsset') }}">Tambah Aset Baru</a>
                <a class="btn btn-small btn-success mt-3" href="{{ route('downloadAsset') }}"><span class="material-symbols-outlined">download</span>Unduh Rekap Aset</a>
            </div>
        </div>
    </div>
@endsection
