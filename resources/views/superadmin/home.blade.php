@extends('layouts.app')

@section('css')

@endsection

@section('js')
    <script defer src="{{ asset('js/datatable.js')}}"></script>
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
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
                                <th scope="col">Nama</th>
                                <th scope="col">Binusian ID</th>
                                <th scope="col">Email</th>
                                <th scope="col">No. HP</th>
                                <th scope="col">Alamat</th>
                                <th scope="col">Department</th>
                                <th scope="col">Role</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($data as $index => $item)
                                <tr>
                                                    masukin kolom
                                    <th scope="row">{{$index+1}}</th>
                                    <td>{{$item->name}}</td>
                                    <td>{{$item->binusianid}}</td>
                                    <td>{{$item->email}}</td>
                                    <td>{{$item->phone}}</td>
                                    <td>{{$item->address}}</td>
{{--                                    <td>{{$item->division->id}}</td>--}}
{{--                                    <td>--}}
{{--                                        <a class="btn btn-small btn-info" href="{{ URL::to('admin/editAsset/' . $item->id) }}"><span class="material-symbols-outlined">edit_square</span></a>--}}
{{--                                        --}}{{--                                        <form action="{{ url('deleteAsset/' . $item->id) }}" method="post">--}}
{{--                                        --}}{{--                                            <button class="btn btn-small btn-info" type="submit"><span class="material-symbols-outlined">delete</span></button>--}}
{{--                                        --}}{{--                                            <input type="hidden" name="_method" value="delete" />--}}
{{--                                        --}}{{--                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">--}}
{{--                                        --}}{{--                                        </form>--}}
{{--                                        <button type="button" class="btn btn-danger deleteAssetBtn" value="{{ $item->id }}"><span class="material-symbols-outlined">delete</span></button>--}}
{{--                                    </td>--}}
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
