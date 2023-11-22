@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Resume Details</div>

                    <div class="card-body">
                      <img src="{{ asset('storage/' . $resume->picture) }}" alt="Profile Picture">

                        <p class="d-flex justify-content-center">Title: {{ $resume->title }}</p>
                        <p class="d-flex justify-content-center">Name: {{ $resume->name }}</p>
                        <p class="d-flex justify-content-center">Email: <a class="text-info mx-1" href="mailto:{{ $resume->email }}">{{ $resume->email }}</a></p>
                        <p class="d-flex justify-content-center">Created at: {{ $resume->created_at }}</p>
                        <p class="d-flex justify-content-center">Updated at: {{ $resume->updated_at }}</p>
                        <div class="d-flex justify-content-center">
                            <a href="{{ route('resumes.edit', $resume->id) }}" class="btn btn-secondary mb-2 mx-1">Edit
                                Resume</a>

                            <form method="POST" action="{{ route('resumes.destroy', $resume->id) }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger mb-2 mx-1">Delete Resume</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
