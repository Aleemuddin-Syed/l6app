@extends('dashboard.layout')
@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
      <h2 class="h2">Post Section</h2>
      <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group mr-2">
          <a href="{{ route('posts.create') }}" class="btn btn-sm btn-outline-secondary">Add New Post</a>
        </div>
      </div>
    </div>
    <div class="table-responsive">
      <table class="table table-striped table-sm">
        <thead>
          <tr>
            <th>#</th>
            <th>Title</th>
            <th>Thumbnail</th>
            <th>Slug</th>
            <th>Author</th>
            <th>Catogory</th>
            <th>Content</th>
            <th>Created At</th>
            <th>Updated A</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php $no = 1; ?>
          @foreach($posts as $data)
          <tr>
            <td>{{ $no }}</td>
            <td>{{ $data->title }}</td>
            <td><img src="{{ $data->thumbnail }}" /></td>
            <td>{{ $data->slug }}</td>
            <td>{{ $data->user->name }}</td>
            <td>
              @if(!$data->categories->isEmpty())
                @foreach($data->categories as $cat)
                  {{ $cat->title }}
                @endforeach
              @endif
            </td>
            <td>{{ $data->content }}</td>
            <td>{{ $data->created_at }}</td>
            <td>{{ $data->updated_at }}</td>
            <td>
              <div class="btn-group btn-group-sm" role="group">
                {{-- @can('isAdmin') --}}
                {{-- @canany(['isAdmin','isSubscribe']) --}}
                {{-- @can('isAllowed',collect(['Admin','Subscribers'])) --}}
                {{-- @can('isAllowed',$data->user->id) --}}
                {{-- @can('isAllowed',$data) --}} {{-- For the policies --}} 
                {{-- @can('view',$data) --}}  {{-- for resource policy --}}
                <a href="{{ route('posts.edit', $data->id) }}" class="btn btn-secondary">Edit</a>
                <form method="POST" action="{{ route('posts.destroy', $data->id) }}">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-danger">Delete</button>
                </form>
                {{-- @endcan --}}
              </div>
            </td>
          </tr>
          <?php $no++; ?>
          @endforeach
        </tbody>
      </table>
    </div>
@endsection