@extends('layouts.home')

@section('title','Buku')

@section('navbar')
@include('layouts.navbar')
@endsection

@section('sidebar')
@include('layouts.sidebar')
@endsection

@section('custom-css')
<style>
    table {border: none;}
</style>
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
                <a class="btn btn-info" href="/buku/form" style="margin-bottom: 10px">Tambah Buku</a>
                <div class="col-md-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            @php
                                $path = $_SERVER['REQUEST_URI'];
                            @endphp
                            @if ($path == '/buku')
                                <a class="btn btn-success" href="/buku">ALL</a>
                            @else
                                <a class="btn btn-primary" href="/buku">ALL</a>
                            @endif
                            @if ($path == '/buku/view/komik')
                                <a class="btn btn-success" href="/buku/view/komik">Komik</a>
                            @else
                                <a class="btn btn-primary" href="/buku/view/komik">Komik</a>
                            @endif
                            @if ($path == '/buku/view/novel')
                                <a class="btn btn-success" href="/buku/view/novel">Novel</a>
                            @else
                                <a class="btn btn-primary" href="/buku/view/novel">Novel</a>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row">
                    @foreach ($data as $item)
                    @if (isset($item['penerbit']))
                        <div class="col-md-4 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <img src="/{{$item['image']}}" alt="logo" height="225px" width="100%">
                                    <p class="card-title">{{$item['judul']}}</p>
                                    <table cellspacing="0" cellpadding="0" width="100%">
                                        <tbody>
                                            <tr>
                                                <td>Penerbit</td>
                                                <td>{{$item['penerbit']}}</td>
                                            </tr>
                                            <tr>
                                                <td>Penulis</td>
                                                <td>{{$item['penulis']}}</td>
                                            </tr>
                                            <tr>
                                                <td>Tahun Terbit</td>
                                                <td>{{$item['tahun']}}</td>
                                            </tr>
                                            <tr>
                                                <td>Lokasi</td>
                                                <td>{{$item['lokasi']}}</td>
                                            </tr>
                                            <br>
                                            <tr>
                                                <td colspan="2">
                                                    <center>
                                                        <a class="btn btn-warning" href="/buku/edit/{{$item['product_id']}}">Edit</a>
                                                        <button class="btn btn-danger" onclick="deleteBukuConfirmation({{$item['product_id']}})" type="button">Hapus</button>
                                                        
                                                        <form action="/buku/delete" method="post" hidden class="buku{{$item['product_id']}}">
                                                            @csrf
                                                            <input type="text" value="{{$item['product_id']}}" name="id" hidden>
                                                            <input type="text" value="{{$item['jenis']}}" name="jenis" hidden>
                                                        </form>
                                                    </center>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('custom-js')
<script>
    $("#buku").addClass("active");
    function deleteBukuConfirmation(flag) {
        Swal.fire({
            title: 'Apakah anda yakin?',
            text: "Anda tidak bisa merubah data jika sudah tersimpan",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: 'Batal',
            reverseButtons: true
            }).then((result) => {
            if (result.value) {
                $( ".buku" + flag ).submit();
            }
        })
    }
</script>
@endsection