@extends('layouts.app')

@section('page-title', $project->title)

@section('main-content')
    <div class="row mb-4">
        <div class="col">
            <div class="card">
                <div class="card-body text-center">
                    <h1 class=" text-success">
                        {{ $project->title }}
                    </h1>

                    <h6>
                        Created at {{ $project->created_at->format('d/m/Y - H:i')}}
                    </h6>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <div class="card">
                
                @if ($project->cover)
                    <img src="{{ asset('/storage/'.$project->cover) }}" alt="{{ $project->title }}" class="card-img-top">
                @endif

                <div class="card-body">
                    <ul>
                        <li>
                            ID: {{ $project->id }}
                        </li>

                        <li>
                            Slug: {{ $project->slug }}
                        </li>
                        <li>
                            Client: {{ $project->client }}
                        </li>
                        <li>
                            Sector: {{ $project->sector }}
                        </li>
                        <li>
                            Published: {{ $project->published ? 'Yes' : 'No' }}
                        </li>

                        
                        <li>
                            Type:
                            @if (isset($project->type))
                                <a href="{{ route('admin.types.show', ['type' => $project->type_id] ) }}">
                                    {{ $project->type_id}} - {{$project->type->title}}
                                </a>
                            @else
                                -
                            @endif
                        </li>
                        <li>
                            Technologies:
                            <ul>
                                @foreach ($project->technologies as $technology)
                                    <li>
                                        <a href="{{ route('admin.technologies.show', ['technology' => $technology->id] ) }}" class="badge rounded-pill text-bg-primary">
                                            {{ $technology->title }} 
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </li>

                    </ul>

                    <p class="mb-4">
                        Description:
                        <br>
                        {!! nl2br($project->description) !!}
                    </p>
                    <a class="btn btn-outline-primary btn-sm" href="{{ route('admin.projects.index') }}">
                        
                    </a>
                    <a class="btn btn-outline-warning btn-sm" href="{{ route('admin.projects.edit', ['project' => $project->id]) }}">
                        ໒(•ᴗ•)७✎
                    </a>
                    <form action="{{ route('admin.projects.destroy', ['project'=> $project->id] ) }}" method="POST" class="d-inline-block"
                        onsubmit="return confirm('Are u sure u want to delete this project? ໒(x‸x)७')"    
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