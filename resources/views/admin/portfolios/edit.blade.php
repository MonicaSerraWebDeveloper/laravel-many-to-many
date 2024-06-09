@extends('layouts.admin')

@section('content')
    <h2>Edit the portfolio: "{{ $portfolio->name }}"</h2>
    <div class="py-3"><strong>ID:</strong> {{ $portfolio->id }}</div>
    <form action="{{ route('admin.portfolios.update', ['portfolio' => $portfolio->slug]) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        
        <div class="mb-3">
            <label for="name" class="form-label">Title</label>
            <input id="name" type="text" class="form-control" name="name" value="{{ old('name', $portfolio->name) }}">
        </div>
        @error('name')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <div class="mb-3">
            <label for="client_name" class="form-label">Client Name</label>
            <input id="client_name" type="text" class="form-control" name="client_name" value="{{ old('client_name', $portfolio->client_name)  }}">
        </div>
        @error('client_name')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <div class="mb-3">
            <label for="type_id" class="form-label">Type</label>
            <select id="type_id" class="form-select" name="type_id">
                <option value="">Choose typology</option>
                @foreach ($types as $type)
                    <option @selected($type->id == old('type_id', $portfolio->type_id)) value="{{ $type->id }}">{{ $type->name }}</option>
                @endforeach
            </select>
        <div>

        <div class="mb-3">
            <label for="cover_image" class="form-label">Cambia immagine</label>
            <input id="cover_image" class="form-control" type="file" name="cover_image">

            @if ($portfolio->cover_image)
                <div>
                    <img style="width: 500px;" src="{{ asset('storage/' . $portfolio->cover_image) }}" alt="{{ $portfolio->name }}">
                </div>
            @else 
                <p>Non è ancora stata caricata nessuna immagine</p>
            @endif
        </div>

        <div class="mb-3">
            <label for="summary" class="form-label">Summary</label>
            <textarea id="summary" type="text" class="form-control" rows="10" name="summary">{{ old('summary', $portfolio->summary) }}</textarea>
        </div>
        @error('summary')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <button type="submit" class="btn btn-primary">Update</button>
      </form>
@endsection