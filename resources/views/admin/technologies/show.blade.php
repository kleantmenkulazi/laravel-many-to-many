@extends('layouts.app')

@section('page-title', $technology->title)

@section('main-content')
    <div class="row mb-4">
        <div class="col">
            <div class="card">
                <div class="card-body text-center">
                    <h1 class=" text-success">
                        {{ $technology->title }}
                    </h1>

                    <h6>
                        Created at {{ $technology->created_at->format('d/m/Y - H:i')}}
                    </h6>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <div class="card">

                <div class="card-body">
                    <ul>
                        <li>
                            ID: {{ $technology->id }}
                        </li>

                        <li>
                            Title: {{ $technology->title }}
                        </li>

                        
                        <li>
                            Linked Projects:
                            @if ($technology->projects()->count() > 0)
                            <ul>
                                @foreach ($technology->projects as $project)
                                    <li>
                                        <a href="{{ route('admin.projects.show', ['project'=> $project->id] ) }}">
                                            {{ $project->title }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                            @else
                            None
                        @endif
                    </li>
                </ul>

                    
                    <a class="btn btn-outline-primary btn-sm" href="{{ route('admin.technologies.index') }}">
                        
                    </a>
                    <a class="btn btn-outline-warning btn-sm" href="{{ route('admin.technologies.edit', ['technology' => $technology->id]) }}">
                        ໒(•ᴗ•)७✎
                    </a>
                    <form action="{{ route('admin.technologies.destroy', ['technology'=> $technology->id] ) }}" method="POST" class="d-inline-block"
                        onsubmit="return confirm('Are u sure u want to delete this technology? ໒(x‸x)७')"    
                    >
                        @csrf
                        @method('DELETE')
                            <button class="btn btn-outline-danger btn-sm">
                                ໒(x‸x)७
                            </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection