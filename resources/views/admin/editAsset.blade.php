@extends('layouts.app')

@section('css')

@endsection

@section('js')

@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        {{ __('Edit Data Aset') }}
                    </div>

                    <div class="card-body">



                        <form method="POST" action="{{ url('updateAsset/' . $data->id) }}">
                            @csrf
                            @method('PUT')

                            <div class="row mb-3">
                                <label for="serialnumber" class="col-md-4 col-form-label text-md-end">{{ __('Nomor Seri') }}</label>

                                <div class="col-md-6">
                                    <input id="serialnumber" type="text" class="form-control @error('serialnumber') is-invalid @enderror" name="serialnumber" value="{{ $data->serial_number }}" required autocomplete="serialnumber" autofocus>

                                    @error('serialnumber')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="asset_category" class="col-md-4 col-form-label text-md-end">{{ __('Jenis Aset') }}</label>

                                <div class="col-md-6">
                                    <select class="form-select" name="asset_category" id="asset_category">
                                        @foreach($show as $index => $item)
                                            @if($data->asset_category_id == $item->id)
                                                <option value="{{ $item->id }}" selected>{{ $item->name }}</option>
                                            @else
                                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="asset-status" class="col-md-4 col-form-label text-md-end">{{ __('Status Aset') }}</label>

                                <div class="col-md-6">
                                    <select class="form-select" name="asset-status" id="asset-status">
                                        @if($data->status == 'in storage')
                                            <option value="in storage" selected>Tersedia di penyimpanan</option>
                                            <option value="not available">Tidak tersedia/rusak</option>
                                            <option value="in repair">Dalam perbaikan</option>
                                        @elseif($data->status == 'not available')
                                            <option value="in storage">Tersedia di penyimpanan</option>
                                            <option value="not available" selected>Tidak tersedia/rusak</option>
                                            <option value="in repair">Dalam perbaikan</option>
                                        @elseif($data->status == 'in repair')
                                            <option value="in storage">Tersedia di penyimpanan</option>
                                            <option value="not available">Tidak tersedia/rusak</option>
                                            <option value="in repair" selected>Dalam perbaikan</option>
                                        @endif
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="location" class="col-md-4 col-form-label text-md-end">{{ __('Lokasi Penyimpanan') }}</label>

                                <div class="col-md-6">
                                    <input id="location" type="text" class="form-control @error('location') is-invalid @enderror" name="location" value="{{ $data->assigned_location }}" required autocomplete="location" autofocus>

                                    @error('location')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="brand" class="col-md-4 col-form-label text-md-end">{{ __('Merek') }}</label>

                                <div class="col-md-6">
                                    <input id="brand" type="text" class="form-control @error('brand') is-invalid @enderror" name="brand" value="{{ $data->brand }}" required autocomplete="brand" autofocus>

                                    @error('brand')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Perbarui Data') }}
                                    </button>
                                </div>
                            </div>

                        </form>




                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
