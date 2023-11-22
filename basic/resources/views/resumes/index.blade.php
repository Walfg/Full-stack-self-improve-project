@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Your resumes</div>
                    <table>
                        <thead>
                            <tr>
                                <th>Resumes:</th>
                                {{-- <th>Artist</th>
                                <th>Year</th> --}}
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($resumes as $resume)
                                <tr>
                                    <td>
                                        <a href="{{ route('resumes.show', $resume) }}">
                                            {{ $resume->title }}
                                        </a>
                                    </td>
                                    <td>
                                        <div class="d-flex justify-content-end">
                                            <div>
                                                <a class="btn btn-primary"
                                                    href="{{ route('resumes.edit', $resume) }}">Edit</a>
                                            </div>
                                            <div>
                                                <form method="POST" action="{{ route('resumes.destroy', $resume) }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-danger" type="submit">
                                                        Delete
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </td>

                                </tr>
                            @endforeach
                            {{-- <tr>
                                <td>Shining Star</td>
                                <td>Earth, Wind, and Fire</td>
                                <td>1975</td>
                            </tr> --}}
                        </tbody>
                    </table>

                    <div class="card-body">

                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
