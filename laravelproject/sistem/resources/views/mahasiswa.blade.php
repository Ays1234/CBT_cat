@extends('layouts.app')
@extends('layouts.alert')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Mahasiswa</div>
                <div class="card-body">
                    <h5>Tambah Data Mahasiswa</h5><hr>
                    <form class="form-horizontal" method="POST" action="{{url('simpan-data-mahasiswa')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 col-xs-12">
                                <div class="form-group row">
                                    <label for="nim" class="col-md-4 col-form-label text-md-right">NIM*</label>

                                    <div class="col-md-8">
                                        <input id="nim" type="number" class="form-control @error('nim') is-invalid @enderror" name="nim" value="{{ old('nim') }}" required autofocus>

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
                                        <input id="nama" type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" value="{{ old('nama') }}">

                                        @error('nama')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="foto" class="col-md-4 col-form-label text-md-right">Foto*</label>

                                    <div class="col-md-8">
                                        <input type="file" onchange="readFoto(event)" class="form-control" name="foto" value="{{ old('foto') }}">

                                        <img id='output' style="width: 100px;">

                                        @error('foto')
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
                                        <input id="tanggal_lahir" type="date" class="form-control @error('tanggal_lahir') is-invalid @enderror" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}" required>

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
                                        <input id="program_studi" type="text" class="form-control @error('program_studi') is-invalid @enderror" name="program_studi" value="{{ old('program_studi') }}" required>

                                        @error('program_studi')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="dokumen" class="col-md-4 col-form-label text-md-right">Dokumen*</label>

                                    <div class="col-md-8">
                                        <input type="file" class="form-control" name="dokumen" value="{{ old('dokumen') }}">

                                        @error('dokumen')
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
                    <hr>
                    <div class="row">
                            <div class="col-md-8">
                            <a href="{{url('/downloaddatamahasiswa')}}" target="_blank">
                                <button class="btn btn-warning" type="button">Download</button>
                            </a>
                            <button type="button" class="btn btn-default" data-toggle="modal" data-target="#ModalUpload">Upload</button>
                        </div>
                        <div class="col-md-4">
                            <form method="GET" action="{{url('/mahasiswa-cari')}}">
                                <div class="form-group row">
                                    <div class="col-md-9">
                                        <input type="text" name="cari" class="form-control">
                                    </div>
                                    <div class="col-md-3">
                                        <button class="btn btn-primary">Cari</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div><hr>
                    <form method="POST" action="{{url('hapus-mahasiswa-checklist/{id}')}}">
                        @csrf
                    <div class="table-responsive">
                        <table class="table table-striped table-hover table-bordered">
                            <thead>
                                <tr>
                                    <th class="text-center"><input type="checkbox" name="hapus_data" class="checkbox" id="hapus_data" value=""></th>
                                    <th class="text-center">No</th>
                                    <th class="text-center" width="10%">Foto</th>
                                    <th class="text-center">NIM</th>
                                    <th class="text-center">Nama</th>
                                    <th class="text-center">Tanggal Lahir</th>
                                    <th class="text-center">Program Studi</th>
                                    <th class="text-center">Dokumen</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($data as $no => $value)
                                <tr>
                                    <td align="center"><input type="checkbox" name="nim_hapus[]" class="checkbox-inline" value="{{$value->nim}}"></td>
                                    <td align="center">{{$no+1}}</td>
                                    <td align="center">
                                        <img src="images/foto/{{$value->foto}}" width="100%">
                                    </td>
                                    <td align="center">{{$value->nim}}</td>
                                    <td>{{$value->nama}}</td>
                                    <td align="center">{{$value->tanggal_lahir}}</td>
                                    <td align="center">{{$value->program_studi}}</td>
                                    <td align="center">
                                        <a href="dokumen/{{$value->dokumen}}"><button class="btn btn-success" type="button">Download</button></a>
                                    </td>
                                    <td align="center">
                                        <a href="{{url($value->nim.'/edit-mahasiswa')}}">
                                        <button class="btn btn-primary">Ubah</button>
                                        </a>
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#ModalUbah{{$value->nim}}">Modal Ubah</button>
                                        <a href="{{url($value->nim.'/hapus-mahasiswa')}}">
                                        <button type="button" class="btn btn-danger">Hapus</button>
                                        </a>
                                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#ModalHapus{{$value->nim}}">Modal Hapus</button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $data->links() }} 
                        <input type="submit" class="btn btn-danger" name="hapus_data" value="Hapus Data yang di tandai">
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
@foreach($data as $no => $value)
  <div class="modal fade" id="ModalUbah{{$value->nim}}" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Edit Data Mahasiswa</h4>
        </div>
        <div class="modal-body">
                                <form method="POST" action="{{url('update-mahasiswa/'.$value->nim)}}">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 col-xs-12">
                                <div class="form-group row">
                                    <label for="nim" class="col-md-4 col-form-label text-md-right">NIM*</label>

                                    <div class="col-md-8">
                                        <input id="nim" type="number" class="form-control @error('nim') is-invalid @enderror" name="nim" value="{{ $value->nim }}" required autofocus>

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
                                        <input id="nama" type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" value="{{ $value->nama }}">

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
                                        <input id="tanggal_lahir" type="date" class="form-control @error('tanggal_lahir') is-invalid @enderror" name="tanggal_lahir" value="{{ $value->tanggal_lahir }}" required>

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
                                        <input id="program_studi" type="text" class="form-control @error('program_studi') is-invalid @enderror" name="program_studi" value="{{ $value->program_studi }}" required>

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
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
</div>
@endforeach
<!-- Modal -->
@foreach($data as $no => $value)
  <div class="modal fade" id="ModalHapus{{$value->nim}}" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Hapus Data Mahasiswa</h4>
        </div>
        <div class="modal-body">
            Apakah anda yakin akan menghapus data <strong>{{$value->nama}}</strong> ? <br>
            <a href="{{url($value->nim.'/hapus-mahasiswa')}}">
            <button class="btn btn-danger">Hapus</button>
            </a>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
</div>
@endforeach

<div class="modal fade" id="ModalUpload" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Upload Data Mahasiswa</h4>
        </div>
        <div class="modal-body">
            <form action="{{url('uploaddatamahasiswa')}}" method="POST" enctype="multipart/form-data">
                @csrf
            <input type="file" name="data_mahasiswa" class="form-control"><br>
            <button class="btn btn-success">Simpan</button>
            </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
    var readFoto= function(event) {
    var input = event.target;
    var reader = new FileReader();
    reader.onload = function(){
      var dataURL = reader.result;
      var output = document.getElementById('output');
      output.src = dataURL;
    };
    reader.readAsDataURL(input.files[0]);
  };
</script>
@endsection
