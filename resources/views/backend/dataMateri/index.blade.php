@extends('partials.master')
@section('content')
<nav aria-label="breadcrumb" role="navigation">
    <ol class="breadcrumb adminx-page-breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
      <li class="breadcrumb-item active" aria-current="page">Data Materi</li>
    </ol>
  </nav>

  <div class="pb-3">
    <h1>Data Materi</h1>
  </div>

  @include('common.alert')

  <div class="col">
    <div class="card mb-grid">
      <div class="card-header d-flex justify-content-between align-items-center">
        <div class="card-header-title">
            <a href="{{ route('createDataMateri') }}" class="btn btn-sm btn-success">Add Data +</a>
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
              <th scope="col">Materi</th>
              <th scope="col" colspan="2">Actions</th>
            </tr>
          </thead>
          <tbody>
            
            @foreach ($dataMateri as $item)
            <tr>
              <th scope="row">
                <label class="custom-control custom-checkbox m-0 p-0">
                  <input type="checkbox" class="custom-control-input table-select-row">
                  <span class="custom-control-indicator"></span>
                </label>
              </th>
              <td>{{ $item->nama_materi }}</td>
              <td>
              </td>
              <td>
                <a href="{{ route('editDataMateri', ['id' => $item->id]) }}" class="btn btn-sm btn-primary">Edit</a>
              </td>
              <td>
                <form action="{{ route('deleteDataMateri', ['id' => $item->id]) }}" method="POST">
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