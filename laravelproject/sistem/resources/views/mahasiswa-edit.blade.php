@extends('layouts.app')
@extends('layouts.alert')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Mahasiswa</div>
                <div class="card-body">
                    <h5>Edit Data Mahasiswa</h5><hr>
                    <form method="POST" action="{{url('update-mahasiswa/'.$data->nim)}}">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 col-xs-12">
                                <div class="form-group row">
                                    <label for="nim" class="col-md-4 col-form-label text-md-right">NIM*</label>

                                    <div class="col-md-8">
                                        <input id="nim" type="number" class="form-control @error('nim') is-invalid @enderror" name="nim" value="{{ $data->nim }}" required autofocus>

                                        @error('nim')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="nama" class="col-md-4 col-form-label text-md-right">Nama*</label>

                                    <div class="col-md-8">
                                        <input id="nama" type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" value="{{ $data->nama }}">

                                        @error('nama')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-xs-12">
                                <div class="form-group row">
                                    <label for="tanggal_lahir" class="col-md-4 col-form-label text-md-right">Tanggal Lahir*</label>

                                    <div class="col-md-8">
                                        <input id="tanggal_lahir" type="date" class="form-control @error('tanggal_lahir') is-invalid @enderror" name="tanggal_lahir" value="{{ $data->tanggal_lahir }}" required>

                                        @error('tanggal_lahir')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="program_studi" class="col-md-4 col-form-label text-md-right">Program Studi*</label>

                                    <div class="col-md-8">
                                        <input id="program_studi" type="text" class="form-control @error('program_studi') is-invalid @enderror" name="program_studi" value="{{ $data->program_studi }}" required>

                                        @error('program_studi')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="program_studi" class="col-md-4 col-form-label text-md-right"></label>

                                    <div class="col-md-8">
                                        <button class="btn btn-success">Simpan</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
