@extends('layouts.home')

@section('title','Rak Buku - Form')

@section('navbar')
@include('layouts.navbar')
@endsection

@section('sidebar')
@include('layouts.sidebar')
@endsection

@section('custom-css')
<link rel="stylesheet" href="{{url('vendors/select2/select2.min.css')}}">
<link rel="stylesheet" href="{{url('vendors/select2-bootstrap-theme/select2-bootstrap.min.css')}}">
@endsection

@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-md-12 grid-margin">
                    @if (count($errors))
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $err)
                            <li>{{ $err }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    @if (session('success'))
                    <div class="alert alert-success">
                        <ul>
                            <li>{{ session('success') }}</li>
                        </ul>
                    </div>
                    @endif
                    <div class="row">
                        <div class="col-md-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Edit Lokasi Rak Buku</h4>
                                    <form class="pt-3" method="POST" action="/buku/edit" enctype="multipart/form-data">
                                        {{ csrf_field() }}
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="exampleInputUsername1">Judul</label>
                                                    <input type="text" class="form-control" required placeholder="Judul Buku" name="id" hidden value="{{$data['product_id']}}">
                                                    <input type="text" class="form-control" required placeholder="Judul Buku" name="judul" value="{{$data['judul']}}">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="exampleInputUsername1">Penulis</label>
                                                    <input type="text" class="form-control" required placeholder="Nama Penulis" name="penulis" value="{{$data['penulis']}}">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="exampleInputUsername1">Penerbit</label>
                                                    <input type="text" class="form-control" required placeholder="Nama Penerbit" name="penerbit" value="{{$data['penerbit']}}">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="exampleInputUsername1">Tahun</label>
                                                    <input type="text" class="form-control" required placeholder="Tahun Terbit" name="tahun" value="{{$data['tahun']}}">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Lokasi</label>
                                                    <select class="js-example-basic-single w-100" name="lokasi">
                                                        @foreach ($rak as $item)
                                                            <option value="{{$item->lokasi}}" @if ($item->lokasi == $data['lokasi']) selected @endif>{{$item->lokasi}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Jenis</label>
                                                    <select class="js-example-basic-single w-100" name="jenis">
                                                        <option value="komik" @if ('komik' == $data['jenis']) selected @endif>Komik</option>
                                                        <option value="novel" @if ('novel' == $data['jenis']) selected @endif>Novel</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>File upload</label>
                                                    <input type="file" name="image" class="file-upload-default" accept="image/png, image/gif, image/jpeg">
                                                    <div class="input-group col-xs-12">
                                                      <input type="text" class="form-control file-upload-info" disabled placeholder="Upload Image">
                                                      <span class="input-group-append">
                                                        <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
                                                      </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-primary mr-2">Submit</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('custom-js')
<script src="{{url('vendors/select2/select2.min.js')}}"></script>
<script src="{{url('js/select2.js')}}"></script>
<script src="{{url('js/file-upload.js')}}"></script>
<script>
    $("#buku").addClass("active");
</script>
@endsection