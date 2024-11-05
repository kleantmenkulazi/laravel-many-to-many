@extends('layouts.app')

@section('page-title', $type->title)

@section('main-content')
    <div class="row mb-4">
        <div class="col">
            <div class="card">
                <div class="card-body text-center">
                    <h1 class=" text-success">
                        {{ $type->title }}
                    </h1>

                    <h6>
                        Created at {{ $type->created_at->format('d/m/Y - H:i')}}
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
                            ID: {{ $type->id }}
                        </li>

                        <li>
                            Slug: {{ $type->slug }}
                        </li>
                        <li>
                            Linked Projects:
                            @if ($type->projects()->count() >0)
                            <ul>
                                @foreach ($type->projects as $projects)
                                <li>
                                    <a href="{{ route('admin.projects.show', ['project'=> $poject->id])}}">{{ $project->title }}</a>
                                </li>
                                @endforeach
                            </ul>
                            @else
                            xxx
                            @endif
                        </li>
                    </ul>

                    <a class="btn btn-outline-primary btn-sm" href="{{ route('admin.types.index') }}">
                        ▤
                    </a>
                    <a class="btn btn-outline-warning btn-sm" href="{{ route('admin.types.edit', ['type' => $type->id]) }}">
                        ໒(⊙ᴗ⊙)७✎
                    </a>

                    
                    <form action="{{ route('admin.types.destroy', ['type'=> $type->id] ) }}" method="POST" class="d-inline-block"
                        onsubmit="return confirm('Are u sure u want to delete this type? ໒(x‸x)७')"    
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