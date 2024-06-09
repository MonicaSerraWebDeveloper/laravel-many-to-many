@extends('layouts.admin')

@section('content')
    <h2>Portfolios</h2>
    
    <a href="{{ route('admin.portfolios.create') }}"><button class="btn btn-secondary">New Portfolios</button></a>
    <table class="table table-striped table-hover">
        <thead>
            <tr>
              <th scope="col">ID</th>
              <th scope="col">Name</th>
              <th scope="col">Slug</th>
              <th scope="col">Client Name</th>
              <th scope="col">View</th>
              <th scope="col">Modify</th>
              <th scope="col">Delete</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($portfolios as $portfolio)
                <tr>
                <th scope="row">{{ $portfolio->id }}</th>
                <td>{{ $portfolio->name }}</td>
                <td>{{ $portfolio->slug }}</td>
                <td>{{ $portfolio->client_name }}</td>
                <td>
                    <a href="{{ route('admin.portfolios.show', ['portfolio' => $portfolio->slug]) }}">view</a>
                </td>
                <td>
                    <a href="{{ route('admin.portfolios.edit', ['portfolio' => $portfolio->slug]) }}">edit</a>
                </td>
                <td>
                    <form action="{{ route('admin.portfolios.destroy', ['portfolio' => $portfolio->slug]) }}" method="POST">
                        @csrf
                        @method('DELETE')

                        <button style="color: red; padding: 0;" class="btn btn-link" type="submit">delete</button>
                    </form>
                </td>
                </tr>
            @endforeach
          </tbody>
    </table>
    
@endsection