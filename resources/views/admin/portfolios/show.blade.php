@extends('layouts.admin')

@section('content')
    <div class="pb-3">
        <h3>{{ $portfolio->name }}</h3>
        <a  href="{{ route('admin.portfolios.edit', ['portfolio' => $portfolio->slug]) }}">edit</a>
    </div>
    <div class="pb-3"><strong>ID: </strong>{{ $portfolio->id }}</div>
    <div class="pb-3"><strong>Slug: </strong>{{ $portfolio->slug }}</div>
    <div class="pb-3"><strong>Type: </strong>{{ $portfolio->type ? $portfolio->type->name : 'There is no type specify' }}</div>
    <div class="pb-3"><strong>Client Name: </strong>{{ $portfolio->client_name }}</div>
    <div class="pb-3"><strong>Tags: </strong>
    @if (count($portfolio->technologies) > 0)
        @foreach ($portfolio->technologies as $technology)
            {{ $technology->name }}@if (!$loop->last), @endif
        @endforeach
    @else
        No tag
    @endif
    </div>
    <img style="width: 500px;" src="{{ asset('storage/' . $portfolio->cover_image) }}" alt="{{ $portfolio->name }}">
    <p>{{ $portfolio->summary }}</p>
    <div class="pb-3">
        <form action="{{ route('admin.portfolios.destroy', ['portfolio' => $portfolio->slug]) }}" method="POST">
            @csrf
            @method('DELETE')

            <button style="color: red; padding: 0;" class="btn btn-link" type="submit">delete</button>
        </form>
    </div>
    <div style="border: 1px solid grey; padding: 10px;">
        <div><strong>Last Update: </strong>{{ $portfolio->updated_at ? $portfolio->updated_at : 'empty' }}</div>
        <div><strong>Created: </strong>{{ $portfolio->created_at }}</div>
    </div>
@endsection