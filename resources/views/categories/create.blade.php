@extends('layouts.template')

@section('title', 'Add New Category')

@section('content')
    <div class="mt-4 p-5 bg-black text-white rounded">
        <h1>Add New Category</h1>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger mt-4">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="row my-5">
        <div class="col-12 px-5">
            <form action="{{ route('categories.store') }}" method="POST">
                @csrf
                <x-text-field for="name" id="name" name="name" label="Category Name" value="{{ old('name') }}"/>

                <x-text-field for="slug" id="slug" name="slug" label="Slug" value="{{ old('slug') }}"/>

                <div class="mb-3 col-md-12 col-sm-12">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control" rows="10" name="description">{{ old('description') }}</textarea>
                </div>

                <button type="submit" class="btn btn-primary btn-block">Save</button>
            </form>
        </div>
    </div>
@endsection
