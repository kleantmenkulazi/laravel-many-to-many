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
                <img src="{{ $project->card }}" class="card-img-top" alt="{{ $project->title }}">

                <div class="card-body">
                    <ul>
                        <li>
                            ID: {{ $project->id }}
                        </li>
                        <li>
                            Slug: {{ $project->slug }}
                        </li>
                        <li>
                        </li>
                        <li>
                            Client: {{ $project->client }}
                        </li>
                        <li>
                            Sector: {{ $project->sector }}
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

                    </ul>

                    <p class="mb-4">
                        Description:
                        <br>
                        {{-- per mantenere gli a capo quando visualizzo la descrizione --}}
                        {!! nl2br($project->description) !!}
                    </p>
                    <a class="btn btn-outline-primary btn-sm" href="{{ route('admin.projects.index') }}">
                        ▤
                    </a>
                    <a class="btn btn-outline-warning btn-sm" href="{{ route('admin.projects.edit', ['project' => $project->id]) }}">
                        ໒(⊙ᴗ⊙)७✎
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