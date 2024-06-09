@extends('layouts.admin')

@section('content')
    <h2>Create new portfolio</h2>
    <form action="{{ route('admin.portfolios.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Title</label>
            <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}">
        </div>
        @error('name')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <div class="mb-3">
            <label for="client_name" class="form-label">Client Name</label>
            <input id="client_name" type="text" class="form-control" name="client_name" value="{{ old('client_name') }}">
        </div>
        @error('client_name')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <div class="mb-3">
            <label for="cover_image" class="form-label">Carica l'immagine</label>
            <input id="cover_image" class="form-control" type="file" name="cover_image">
        </div>

        <div class="mb-3">
            <label for="type_id" class="form-label">Type</label>
            <select id="type_id" class="form-select" name="type_id">
                <option value="">Choose typology</option>
                @foreach ($types as $type)
                    <option @selected($type->id == old('type_id')) value="{{ $type->id }}">{{ $type->name }}</option>
                @endforeach
            </select>
        <div>

        <div class="my-3">
            <label for="summary" class="form-label">Summary</label>
            <textarea id="summary" type="text" class="form-control" rows="10" name="summary" value="{{ old('summary') }}"></textarea>
        </div>
        @error('summary')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        
        <button type="submit" class="btn btn-primary">Publish</button>
      </form>
@endsection