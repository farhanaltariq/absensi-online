@extends('partials.master')
@section('content')
<nav aria-label="breadcrumb" role="navigation">
    <ol class="breadcrumb adminx-page-breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
      <li class="breadcrumb-item active" aria-current="page">Data Asisten</li>
    </ol>
  </nav>

  <div class="pb-3">
    <h1>Data Asisten</h1>
  </div>

  @include('common.alert')
  
  <div class="col">
    <div class="card mb-grid">
      <div class="card-header d-flex justify-content-between align-items-center">
        <div class="card-header-title">
            <a href="{{ route('createDataAss') }}" class="btn btn-sm btn-success">Add Data +</a>
        </div>
      </div>
      <div class="table-responsive-md">
        <table class="table table-actions table-striped table-hover mb-0">
          <thead>
            <tr>
              <th scope="col">
                <label class="custom-control custom-checkbox m-0 p-0">
                  <input type="checkbox" class="custom-control-input table-select-all">
                  <span class="custom-control-indicator"></span>
                </label>
              </th>
              <th scope="col">Nama</th>
              <th scope="col">Email</th>
              <th scope="col">Role</th>
              <th scope="col">Join Date</th>
              <th scope="col" class="text-center" colspan="2">Actions</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($dataUser as $user)
            <tr>
              <th scope="row" class="text-center">
                {{-- <label class="custom-control custom-checkbox m-0 p-0"> --}}
                  {{-- <input type="checkbox" class="custom-control-input table-select-row"> --}}
                  <img src="{{ asset('avatar_asisten') . '/' . $user->photo ?? null }}" width="50px" height="50px" alt="">
                  {{-- <span class="custom-control-indicator"></span> --}}
                </label>
              </th>
              <td>{{ $user->name }}</td>
              <td>{{  $user->email }}</td>
              <td>
                <span class="badge badge-pill badge-primary">{{  $user->role }}</span>
              </td>
              <td>{{  $user->join_date }}</td>
              <td>
                <a href="{{ route('editDataAss', ['id' => $user->id]) }}" class="btn btn-sm btn-primary">Edit</a>
              </td>
              <td>
                <form action="{{ route('deleteDataAss', ['id' => $user->id]) }}" method="POST">
                  @method('DELETE')
                  @csrf
                  <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                </form>
              </td>
            </tr>
            @endforeach
            
          </tbody>
        </table>
      </div>
    </div>
  </div>
@endsection