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
                                    <h4 class="card-title">Tambah Lokasi Rak Buku</h4>
                                    <form class="pt-3" method="POST" action="/pinjam">
                                        {{ csrf_field() }}
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="exampleInputUsername1">Nama Peminjam</label>
                                                    <input type="text" class="form-control" required placeholder="Nama Peminjam" name="peminjam">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Buku</label>
                                                    <select class="js-example-basic-single w-100" name="buku">
                                                        <option disabled selected>Pilih Buku</option>
                                                        @foreach ($data as $item)
                                                            <option value="{{$item->id}}">{{$item->judul}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Jaminan</label>
                                                    <select class="js-example-basic-single w-100" name="jaminan">
                                                        <option disabled selected>Pilih Jaminan</option>
                                                        <option value="KTP">KTP</option>
                                                        <option value="KTM">KTM</option>
                                                        <option value="KK">KK</option>
                                                        <option value="ATM">ATM</option>
                                                        <option value="TAS">TAS</option>
                                                        <option value="HP">HP</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                  <label>Tanggal Pinjam</label>
                                                  <input class="form-control" placeholder="dd/mm/yyyy" name="tanggal_pinjam"/>
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
<script>
    $("#pinjam").addClass("active");
</script>
@endsection