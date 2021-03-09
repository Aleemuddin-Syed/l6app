@extends('dashboard.layout')
@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
      <h2 class="h2">Category Section</h2>
      <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group mr-2">
          <a href="{{ route('categories.create') }}" class="btn btn-sm btn-outline-secondary">Add New Category</a>
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
            <th>Created At</th>
            <th>Updated A</th>
            <th>Children</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php $no = 1; ?>
          @foreach($data as $list)
          <tr>
            <td>{{ $no }}</td>
            <td>{{ $list->title }}</td>
            <td><img src="{{ storage_path('app/public/'). $list->thumbnail }}"/></td>
            <td>{{ $list->created_at }}</td>
            <td>{{ $list->updated_at }}</td>
            <td>
              @if(!$list->children->isEmpty())
                @foreach($list->children as $child)
                  {{ $child->title }}
                @endforeach
              @else
                {{ 'not parent' }}
              @endif
            </td>
            <td>
              <div class="btn-group btn-group-sm" role="group">
                <a href="{{ route('categories.edit', $list->id) }}" class="btn btn-secondary">Edit</a>
                <form method="POST" action="{{ route('categories.destroy', $list->id) }}">
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