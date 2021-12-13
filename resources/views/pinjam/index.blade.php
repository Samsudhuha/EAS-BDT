@extends('layouts.home')

@section('title','Rak Buku')

@section('navbar')
@include('layouts.navbar')
@endsection

@section('sidebar')
@include('layouts.sidebar')
@endsection

@section('custom-css')

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
                <a class="btn btn-info" href="/pinjam/form" style="margin-bottom: 10px">Tambah Peminjam</a>
                <div class="row">
                    <div class="col-md-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <p class="card-title">Lokasi</p>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="table-responsive">
                                            <table id="dataTable" class="display expandable-table" style="width:100%">
                                                <thead>
                                                    <tr>
                                                        <th width="20%">Nama Peminjam</th>
                                                        <th width="20%">Judul Buku</th>
                                                        <th width="10%">Jaminan</th>
                                                        <th width="15%">Tanggal Pinjam</th>
                                                        <th width="15%">Tanggal Kembali</th>
                                                        <th width="10%">Denda</th>
                                                        <th width="10%">Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($data as $item)
                                                        <tr>
                                                            <td>{{$item->peminjam}}</td>
                                                            <td>{{$item->Buku->judul}}</td>
                                                            <td>{{$item->jaminan}}</td>
                                                            <td>{{$item->tanggal_pinjam}}</td>
                                                            <td>{{$item->tanggal_kembali}}</td>
                                                            <td>{{$item->denda}}</td>
                                                            <td>
                                                                @if ($item->flag_kembali == 0)
                                                                    <button class="btn btn-success" onclick="editPinjamConfirmation({{$item->id}})" type="button">Kembali</button>
                                                                @endif
                                                                <button class="btn btn-danger" onclick="deletePinjamConfirmation({{$item->id}})" type="button">Hapus</button>

                                                                <form action="/pinjam/delete" method="post" hidden class="pinjam{{$item->id}}">
                                                                    @csrf
                                                                    <input type="text" value="{{$item->id}}" name="id" hidden>
                                                                </form>
                                                                <form action="/pinjam/update" method="post" hidden class="kembali{{$item->id}}">
                                                                    @csrf
                                                                    <input type="text" value="{{$item->id}}" name="id" hidden>
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
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('custom-js')
<script>
    $("#pinjam").addClass("active");
    $(function () {
        $('#dataTable').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });
    });

    function editPinjamConfirmation(flag) {
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
                $( ".kembali" + flag ).submit();
            }
        })
    }
    function deletePinjamConfirmation(flag) {
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
                $( ".pinjam" + flag ).submit();
            }
        })
    }
</script>
@endsection