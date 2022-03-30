@extends('layouts.app')
@section('content')
<div class="row">
    <section class="col-12 d-flex justify-content-center">
        <div class="card" style="width: 18rem;">
            <img src="{{$post->image}}" class="card-img-top" alt="{{$post->title}}">
            <div class="card-body">
                <h4 class="card-title">{{$post->title}}
                @if($post->category)<sub class="badge badge-pill badge-{{$post->category->color}}" style="font-size: 0.6rem" role="button">{{$post->category->label}}</sub>@endif
                </h4>
                <p class="card-text">{{$post->content}}</p>
                <div class="d-flex justify-content-around">
                    <a href="{{route('admin.posts.edit', $post->id)}}" class="btn btn-sm btn-warning">
                        <i class="fa-solid fa-pencil"></i>
                        <span style="font-size: 0.8rem" class="mr-2">Edit</span>
                    </a>
                    <form action="{{route('admin.posts.destroy', $post->id)}}" method="POST" class="delete-form">
                        @method('DELETE')
                        @csrf
                        <button type="submit" class="btn btn-sm btn-danger"><i class="fa-solid fa-trash mr-2"></i><span>Cancel</span></button>
                    </form>
                    <a href="{{route('admin.posts.index')}}" class="btn btn-sm btn-secondary">
                        <i class="fa-solid fa-house"></i>
                        <span>Indietro</span>
                    </a>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
@section('others-script')
<script src="{{ asset('js/delete-script.js') }}" defer></script>
@endsection