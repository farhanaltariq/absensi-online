@extends('partials.master')
@section('content')
<nav aria-label="breadcrumb" role="navigation">
    <ol class="breadcrumb adminx-page-breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
      <li class="breadcrumb-item active"><a href="{{ route('indexDataKelas') }}">Kelas</a></li>
      <li class="breadcrumb-item active" aria-current="page">Add Data Kelas</li>
    </ol>
  </nav>

  <div class="pb-3">
    <h1>Add Data Kelas</h1>
  </div>

  <div class="card mb-grid">
    <div class="card-body">
      <form action="{{ route('storeDataKelas') }}" method="POST">
        @csrf
        <div class="form-group row">
            <label for="inputEmail3" class="col-sm-2 col-form-label form-label">Jurusan</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="jurusan" placeholder="Jurusan">
            </div>
          </div>
          <div class="form-group row">
            <label for="inputEmail3" class="col-sm-2 col-form-label form-label">Fakultas</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="fakultas" placeholder="Fakultas">
            </div>
          </div>
          <div class="form-group row">
            <label for="inputEmail3" class="col-sm-2 col-form-label form-label">Tingkat</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="tingkat" placeholder="Tingkat">
            </div>
          </div>
          <div class="form-group row">
            <label for="inputEmail3" class="col-sm-2 col-form-label form-label">Kelas</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="kelas" placeholder="Kelas">
            </div>
          </div>
        </div>
        <div class="form-group row">
          <div class="col-sm-10">
            <button type="submit" class="btn btn-primary">Insert Data</button>
          </div>
        </div>
      </form>
    </div>
  </div>
  @endsection