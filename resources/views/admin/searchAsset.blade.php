@extends('layouts.app')

@section('css')
    {{--    <link href="{{ asset('css/pizza.css') }}" rel="stylesheet">--}}
@endsection

@section('js')
    <script defer src="{{ asset('js/datatable.js')}}"></script>
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard Admin') }}</div>

                    <div class="card-body">



                        <table id="myTable" class="table">
                            <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Serial Number</th>
                                <th scope="col">Division</th>
                                <th scope="col">Category</th>
                                <th scope="col">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($data as $index => $item)
                                <tr>
                                    {{--                masukin kolom--}}
                                    <th scope="row">{{$index}}</th>
                                    <td>{{$item->serial_number}}</td>
                                    <td>{{$item->division->name}}</td>
                                    <td>{{$item->assetCategory->name}}</td>
                                    <td>
                                        <a class="btn btn-small btn-info" href="{{ URL::to('assets/' . $item->id . '/edit') }}">Edit</a>
                                        <a class="btn btn-small btn-info" href="#">Delete</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>



                    </div>
                </div>
                <a class="btn btn-small btn-success" href="{{ route('createAsset') }}">Tambah Aset Baru</a>
            </div>
        </div>
    </div>
@endsection
