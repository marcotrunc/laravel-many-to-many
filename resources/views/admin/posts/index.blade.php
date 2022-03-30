@extends('layouts.app')

@section('content')
  {{-- Header --}}
  <header class="d-flex justify-content-between">
      <h1>Tutti i Post</h1>
      <div>
        <a href="{{route('admin.posts.create')}}" class="btn btn-success d-flex align-content-center">Aggiungi</a>
      </div>
  </header>
  {{-- Table --}}
  <table class="table table-dark mt-4">
      <thead>
        <tr>
          <th >#</th>
          <th>Title</th>
          <th>Categoria</th>
          <th>Autore</th>
          <th>Creato il</th>
          <th>actions</th>
        </tr>
      </thead>
    <tbody>
      @forelse($posts as $post)
        <tr>
          <th scope="row">{{$post->id}}</th>
          <td>{{$post->title}}</td>
          <td>
            @if($post->category)
              <span class="badge badge-pill badge-{{$post->category->color}}">{{$post->category->label}}</span>
            @else 
              <span> Nessuna categoria</span>  
            @endif
          </td>
          <td>
            @if($post->user)
            {{$post->user->name}}
            @else
            Utente Sconosciuto
            @endif
          </td>
          <td>{{$post->created_at}}</td>
          <td class="d-flex justify-content-between align-items-center">
            {{-- Show --}}
            <a href="{{route('admin.posts.show',$post->id)}}" class="btn btn-sm btn-info">
              <i class="fa-solid fa-eye"></i></a>
              {{-- Edit --}}
            <a href="{{route('admin.posts.edit',$post->id)}}" class="btn btn-sm btn-warning">
              <i class="fa-solid fa-pencil"></i></a> 
              {{-- Delete --}}
            <form action="{{route('admin.posts.destroy', $post->id)}}" method="POST"  class="delete-form" data-title="{{$post->title}}">
              @method('DELETE')
              @csrf
              <button type="submit" class="btn btn-sm btn-danger"><i class="fa-solid fa-trash"></i></button>
            </form>
          </td>
        </tr>
      @empty
          <tr>
              <td colspan=""><h3>Non vi sono posts disponibili</h3> </td>
          </tr>
      @endforelse
    </tbody>
  </table>

  {{-- Paginator --}}
  @if($posts->hasPages())
  <div class="d-flex justify-content-center">
    {{$posts->links()}}
  </div>
  @endif
  <hr>
  
  {{-- Link-Categories --}}
  <div class="row">
    @foreach($categories as $cat)
      <div class="col-4 mb-4">
        <h3>{{$cat->label}}</h3>
        @foreach($cat->posts as $p)
          <h6><a href="{{route('admin.posts.show', $p->id)}}">{{$p->title}}</a></h6>
        @endforeach
      </div>
    @endforeach
  </div>
@endsection
@section('others-script')
<script src="{{asset('js/delete-script.js')}}" defer></script>
@endsection