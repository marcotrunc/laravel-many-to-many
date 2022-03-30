@extends('layouts.app')
@section('content')
<div class="row">
    <section class="col-12 d-flex justify-content-center">
        <div class="card" style="width: 18rem;">
            <div class="card-body">
                <h4 class="card-title">{{$category->label}}</h4>
                <small><span class="badge badge-pill badge-{{$category->color}}">{{$category->label}}</span></small>
                <div class="d-flex justify-content-around">
                    <a href="{{route('admin.categories.edit', $category->id)}}" class="btn btn-sm btn-warning">
                        <i class="fa-solid fa-pencil"></i>
                        <span style="font-size: 0.8rem" class="mr-2">Edit</span>
                    </a>
                    <form action="{{route('admin.categories.destroy', $category->id)}}" method="POST" class="delete-form">
                        @method('DELETE')
                        @csrf
                        <button type="submit" class="btn btn-sm btn-danger"><i class="fa-solid fa-trash mr-2"></i><span>Cancel</span></button>
                    </form>
                    <a href="{{route('admin.categories.index')}}" class="btn btn-sm btn-secondary">
                        <i class="fa-solid fa-house"></i>
                        <span>Indietro</span>
                    </a>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
