@extends('layouts.app')

@section('page-title', 'Types')

@section('main-content')
    <div class="row mb-4">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h1 class="text-center text-success">
                        Types
                    </h1>
                </div>
            </div>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col text-center">
            <a class="btn btn-success" href="{{ route('admin.types.create')}}">
                Create a new Type +
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <table class="table">
                        <thead>
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">Title</th>
                            <th scope="col">Actions</th>
                          </tr>
                        </thead>
                        <tbody>

                            @foreach ($types as $type)
                                <tr>
                                    <th scope="row">{{ $type->id }}</th>
                                    <td>{{ $type->title }}</td>
                                    <td> {{ count($type->projects)}}</td>
                                    <td>
                                        <a class="btn btn-outline-primary btn-sm" href="{{ route('admin.types.show', ['type' => $type->id]) }}">
                                            ໒(⊙ᴗ⊙)७
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
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                      </table>
                </div>
            </div>
        </div>
    </div>
@endsection