@extends('layouts.app')

@section('title', 'Posts')

@section('content')
<div class="container-fluid py-5 bg-soft">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="display-4 fw-bold text-primary">Posts</h1>
            <a href="{{ route('posts.create') }}" class="btn btn-primary btn-lg shadow-sm">
                <i class="fas fa-plus-circle me-2"></i>Create New Post
            </a>
        </div>

        {{-- Form Filter --}}
        <form method="GET" action="{{ route('posts.index') }}" class="mb-4 p-4 bg-white rounded shadow-sm">
            <div class="row g-3">
                <div class="col-md-4">
                    <input type="text" name="search" class="form-control form-control-lg border-0 bg-light" placeholder="Search by title" value="{{ request()->get('search') }}">
                </div>
                <div class="col-md-4">
                    <select name="category_id" class="form-select form-select-lg border-0 bg-light">
                        <option value="">Select Category</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ request()->get('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <button type="submit" class="btn btn-primary btn-lg w-100 shadow-sm">
                        <i class="fas fa-filter me-2"></i>Filter
                    </button>
                </div>
            </div>
        </form>

        @if ($posts->count() > 0)
            <div class="row row-cols-1 row-cols-md-2 g-4">
                @foreach ($posts as $post)
                    <div class="col">
                        <div class="card h-100 border-0 shadow-sm hover-shadow">
                            <div class="row g-0">
                                <div class="col-md-4">
                                    @if ($post->image)
                                        <img src="{{ asset('storage/'.$post->image) }}" alt="Post image" class="img-fluid rounded-start h-100 object-fit-cover">
                                    @else
                                        <img src="https://via.placeholder.com/300x200" alt="Default Image" class="img-fluid rounded-start h-100 object-fit-cover">
                                    @endif
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body">
                                        <h5 class="card-title">
                                            <a href="{{ route('posts.show', $post->id) }}" class="text-decoration-none text-primary">{{ $post->title }}</a>
                                        </h5>
                                        <p class="card-text">
                                            <small class="text-muted">
                                                <i class="fas fa-folder me-2"></i>{{ $post->category->name }}
                                            </small>
                                        </p>
                                        <p class="card-text">
                                            <small class="text-muted">
                                                <i class="fas fa-user me-2"></i>{{ $post->user ? $post->user->name : 'Unknown' }}
                                            </small>
                                        </p>
                                        <p class="card-text">
                                            <span class="badge {{ $post->is_published ? 'bg-success' : 'bg-secondary' }} rounded-pill">
                                                {{ $post->is_published ? 'Published' : 'Draft' }}
                                            </span>
                                        </p>
                                        <div class="mt-3">
                                            <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-outline-warning btn-sm me-2">
                                                <i class="fas fa-edit me-1"></i>Edit
                                            </a>
                                            <form action="{{ route('posts.destroy', $post->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this post?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-outline-danger btn-sm">
                                                    <i class="fas fa-trash-alt me-1"></i>Delete
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- Pagination --}}
            <div class="mt-4 d-flex justify-content-center">
                {{ $posts->links() }}
            </div>
        @else
            <div class="alert alert-info bg-light border-0 shadow-sm" role="alert">
                <i class="fas fa-info-circle me-2"></i>No posts available at the moment.
            </div>
        @endif
    </div>
</div>
@endsection

@push('styles')
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
<style>
    .bg-soft {
        background-color: #f8f9fa;
    }
    .hover-shadow:hover {
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15) !important;
        transition: box-shadow 0.3s ease-in-out;
    }
    .form-control:focus, .form-select:focus {
        box-shadow: none;
        border-color: #80bdff;
    }
    .btn-outline-warning, .btn-outline-danger {
        background-color: transparent;
    }
    .btn-outline-warning:hover, .btn-outline-danger:hover {
        color: #fff;
    }
</style>
@endpush