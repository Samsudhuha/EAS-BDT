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
                                    <form class="pt-3" method="POST" action="/rak/edit">
                                        {{ csrf_field() }}
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="exampleInputUsername1">Lokasi</label>
                                                    <input type="text" class="form-control" required hidden value="{{$data->id}}" name="id">
                                                    <input type="text" class="form-control" required value="{{$data->lokasi}}" name="lokasi">
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