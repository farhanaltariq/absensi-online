@extends('partials.master')
@section('content')
<nav aria-label="breadcrumb" role="navigation">
    <ol class="breadcrumb adminx-page-breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
      <li class="breadcrumb-item active"><a href="{{ route('indexDataAss') }}">Asisten</a></li>
      <li class="breadcrumb-item active" aria-current="page">Edit Data Asisten</li>
    </ol>
  </nav>

  <div class="pb-3">
    <h1>Edit Data Asisten</h1>
  </div>

  @include('common.alert')

  <div class="card mb-grid">
    <div class="card-header">
      <div class="card-header-title">Horizontal form</div>
    </div>
    <div class="card-body">
      <form action="{{ route('updateDataAss', ['id' => $edit->id]) }}" method="POST" enctype="multipart/form-data">
        @method('PUT')
        @csrf
        <div class="form-group row">
            <label for="inputEmail3" class="col-sm-2 col-form-label form-label">Nama</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="name" placeholder="Nama" value="{{ $edit->name }}">
            </div>
          </div>
          <div class="form-group row">
            <label for="inputEmail3" class="col-sm-2 col-form-label form-label">Email</label>
            <div class="col-sm-10">
              <input type="email" class="form-control" name="email" placeholder="Email" value="{{ $edit->email }}">
            </div>
          </div>
          <div class="form-group row">
            <label for="inputPassword3" class="col-sm-2 col-form-label form-label">Password</label>
            <div class="col-sm-10">
              <input type="password" class="form-control" name="password" placeholder="Password">
            </div>
          </div>
          <div class="form-group row">
            <label for="inputPassword3" class="col-sm-2 col-form-label form-label">Confirm Password</label>
            <div class="col-sm-10">
              <input type="password" class="form-control" name="password2" placeholder="Confirm Password">
            </div>
          </div>
          <div class="form-group row">
            <label for="inputPassword3" class="col-sm-2 col-form-label form-label">Join Date</label>
            <div class="col-sm-10">
              <input type="date" class="form-control" name="join_date" value="{{ $edit->join_date }}">
            </div>
          </div>
        <div class="form-group row">
            <label for="inputPassword3" class="col-sm-2 col-form-label form-label">Role</label>
            <div class="col-sm-10">
              <select class="form-control" name="role">
                  <option value="{{ $edit->role }}" selected disabled>{{ $edit->role }}</option>
                  <option value="Asisten">Asisten</option>
                  <option value="PJ">PJ</option>
                  <option value="Staff">Staff</option>
                  <option value="Admin">Admin</option>
              </select>
            </div>
          </div>
          <div class="form-group row">
            <label for="inputPassword3" class="col-sm-2 col-form-label form-label">Upload Foto</label>
            <div class="col-sm-10">
                <div class="custom-file">
                    <input type="file" name="photo" class="custom-file-input">
                    <label class="custom-file-label">{{ $edit->photo }}</label>
                  </div>
                  <a target="_blank" href="{{ asset('avatar_asisten').'/'.$edit->photo }}">{{ $edit->photo }}</a>
                </div>
        </div>
        {{-- <fieldset class="form-group">
          <div class="row">
            <legend class="col-form-legend col-sm-2 form-label">Radios</legend>
            <div class="col-sm-10">
              <div class="form-check">
                <label class="form-check-label">
                  <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios1" value="option1" checked="">
                  Option one is this and that—be sure to include why it's great
                </label>
              </div>
              <div class="form-check">
                <label class="form-check-label">
                  <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios2" value="option2">
                  Option two can be something else and selecting it will deselect option one
                </label>
              </div>
              <div class="form-check disabled">
                <label class="form-check-label">
                  <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios3" value="option3" disabled="">
                  Option three is disabled
                </label>
              </div>
            </div>
          </div>
        </fieldset> --}}
        {{-- <div class="form-group row">
          <div class="col-sm-2 form-label pt-1">Checkbox</div>
          <div class="col-sm-10">
            <div class="form-check">
              <label class="form-check-label">
                <input class="form-check-input" type="checkbox"> Check me out
              </label>
            </div>
          </div>
        </div> --}}
        <div class="form-group row">
          <div class="col-sm-10">
            <button type="submit" class="btn btn-primary">Update</button>
          </div>
        </div>
      </form>
    </div>
  </div>
  @endsection