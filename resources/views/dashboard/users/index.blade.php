@extends('dashboard.layout')
@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
      <h2 class="h2">User Section</h2>
      <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group mr-2">
          <a href="{{ route('users.create') }}" class="btn btn-sm btn-outline-secondary">Add New User</a>
        </div>
      </div>
    </div>

    <div class="table-responsive">
      <table class="table table-striped table-sm">
        <thead>
          <tr>
            <th>#</th>
            <th>Name</th>
            <th>Thumbnail</th>
            <th>City</th>
            <th>Country</th>
            <th>Roles</th>
            <th>Created At</th>
            <th>Updated A</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php $no = 1; ?>
          @foreach($users as $data)
          <tr>
            <td>{{ $no }}</td>
            <td>{{ $data->name }}</td>
            <td>{{ $data->profile->photo ?? 'N/A' }}</td>
            <td>{{ $data->profile->city ?? 'N/A'  }}</td>
            <td>{{ $data->profile->country ?? 'N/A' }}</td>
            <td>
              @if(!$data->roles->isEmpty())
                {{$data->roles->implode('name',', ')}}
              @endif
            </td>
            <td>{{ $data->created_at }}</td>
            <td>{{ $data->updated_at }}</td>
            <td>
              {{-- <a href="{{ route('users.edit', $data->id) }}" class="">Edit</a>
              <a href="{{ route('users.destroy', $data->id) }}" class="">Delete</a> --}}
              <div class="btn-group btn-group-sm" role="group">
                <a href="{{ route('users.edit', $data->id) }}" class="btn btn-secondary">Edit</a>
                <form method="POST" action="{{ route('users.destroy', $data->id) }}">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-danger">Delete</button>
                </form>
                
              </div>
            </td>
          </tr>
          <?php $no++; ?>
          @endforeach
        </tbody>
      </table>
    </div>
@endsection