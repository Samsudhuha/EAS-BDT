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
                <a class="btn btn-info" href="/rak/form" style="margin-bottom: 10px">Tambah Lokasi Rak Buku</a>
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
                                                        <th width="50%">Lokasi</th>
                                                        <th width="50%">Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($data as $item)
                                                        <tr>
                                                            <td>{{$item->lokasi}}</td>
                                                            <td>
                                                                <a class="btn btn-warning" href="/rak/edit/{{$item->id}}">Edit</a>
                                                                <button class="btn btn-danger" onclick="deleteLokasiConfirmation({{$item->id}})" type="button">Hapus</button>

                                                                <form action="/rak/delete" method="post" hidden class="lokasi{{$item->id}}">
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
    $("#rak").addClass("active");
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

    function deleteLokasiConfirmation(flag) {
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
                $( ".lokasi" + flag ).submit();
            }
        })
    }
</script>
@endsection