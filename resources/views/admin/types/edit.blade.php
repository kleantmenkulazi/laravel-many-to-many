@extends('layouts.app')

@section('page-title', 'Edit '.$type->title)

@section('main-content')
    <div class="row mb-4">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h1 class="text-center text-success">
                        Edit {{$type->title}}
                    </h1>
                </div>
            </div>
        </div>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger mb-4">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>
                        {{ $error }}
                    </li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">

                    <form action="{{ route('admin.types.update', ['type' => $type->id])}}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="mb-3">
                            <label for="title" class="form-label">
                                Title <span class="text-danger">*</span>
                            </label>
                            <input value="{{ old('title', $type->title) }}" type="text" minlength="3" maxlength="64" required id="title" name="title" placeholder="Write the title..." class="form-control">
                        </div>

                        <div class="d-flex justify-content-start">

                            <div class="me-3">
                                <button type="submit" class="btn btn-outline-warning">
                                    Submit
                                </button>
                            </div>
    
                            <div class="me-3">
                                <a href="{{ route('admin.types.show', ['type' => $type->id])}}" type="submit" class="btn btn-outline-success">
                                    Cancel
                                </a>
                            </div>

                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection