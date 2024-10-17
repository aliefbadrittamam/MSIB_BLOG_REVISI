@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h2">Dashboard</h1>
    </div>

    <div class="row">
        <div class="col-md-4 mb-4">
            <div class="card bg-primary text-white shadow">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="card-title h6 text-uppercase">Total Posts</h5>
                            <p class="card-text display-4 fw-bold">{{ $totalPosts }}</p>
                        </div>
                        <i class="fas fa-file-alt fa-3x opacity-50"></i>
                    </div>
                    <a href="{{ route('posts.index') }}" class="btn btn-outline-light mt-3">View Posts</a>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card bg-success text-white shadow">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="card-title h6 text-uppercase">Published Posts</h5>
                            <p class="card-text display-4 fw-bold">{{ $publishedPosts }}</p>
                        </div>
                        <i class="fas fa-check-circle fa-3x opacity-50"></i>
                    </div>
                    <a href="{{ route('posts.index') }}?filter=published" class="btn btn-outline-light mt-3">View Published</a>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card bg-warning text-dark shadow">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="card-title h6 text-uppercase">Draft Posts</h5>
                            <p class="card-text display-4 fw-bold">{{ $draftPosts }}</p>
                        </div>
                        <i class="fas fa-pencil-alt fa-3x opacity-50"></i>
                    </div>
                    <a href="{{ route('posts.index') }}?filter=draft" class="btn btn-outline-dark mt-3">View Drafts</a>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-light rounded shadow-sm p-4 mt-4">
        <h4 class="font-semibold mb-4">Latest Posts</h4>
        @if($latestPosts->count() > 0)
            <div class="row">
                @foreach($latestPosts as $post)
                    <div class="col-md-6 mb-4">
                        <div class="card h-100 border-0 shadow-sm hover-shadow">
                            <div class="card-body">
                                <h5 class="card-title">
                                    <a href="{{ route('posts.show', $post->id) }}" class="text-decoration-none text-primary">
                                        {{ $post->title }}
                                    </a>
                                </h5>
                                <p class="card-text text-muted mb-2">
                                    <small>
                                        <i class="fas fa-calendar-alt me-2"></i>{{ $post->created_at->format('M d, Y') }}
                                        <i class="fas fa-user ms-3 me-2"></i>{{ $post->user->name }}
                                    </small>
                                </p>
                                <p class="card-text">{{ Str::limit($post->content, 100) }}</p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="badge bg-{{ $post->is_published ? 'success' : 'warning' }} rounded-pill">
                                        {{ $post->is_published ? 'Published' : 'Draft' }}
                                    </span>
                                    <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-sm btn-outline-primary">
                                        <i class="fas fa-edit me-1"></i>Edit
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="alert alert-info" role="alert">
                <i class="fas fa-info-circle me-2"></i>No recent posts available.
            </div>
        @endif
    </div>
</div>
@endsection

@push('styles')
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
<style>
    .hover-shadow:hover {
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15) !important;
        transition: box-shadow 0.3s ease-in-out;
    }
    .card {
        transition: all 0.3s ease;
    }
    .card:hover {
        transform: translateY(-5px);
    }
</style>
@endpush