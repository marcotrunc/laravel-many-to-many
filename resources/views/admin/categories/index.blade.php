@extends('layouts.app')

@section('content')
 {{-- Header --}}
 <header class="d-flex justify-content-between">
  <h1>Tutte le categorie</h1>
  <div>
    <a href="{{route('admin.categories.create')}}" class="btn btn-success d-flex align-content-center">Aggiungi</a>
  </div>
</header>
{{-- Table --}}
<table class="table">
    <thead class="thead-dark">
      <tr>
        <th scope="col">#</th>
        <th scope="col">Nome</th>
        <th scope="col">Colore</th>
        <th scope="col">Creata il</th>
        <th scope="col">Modificata il</th>
        <th scope="col">Azioni</th>
      </tr>
    </thead>
    <tbody>
        @forelse ($categories as $c)
            <tr>
                <th scope="row">{{$c->id}}</th>
                <td>{{$c->label}}</td>
                <td><span class="badge badge-pill badge-{{$c->color}}">{{$c->label}}</span></td>
                <td>{{$c->created_at}}</td>
                <td>{{$c->updated_at}}</td>
                <td class="d-flex justify-content-between align-items-center">
                    {{-- Show --}}
                    <a href="{{route('admin.categories.show',$c->id)}}" class="btn btn-sm btn-info">
                      <i class="fa-solid fa-eye"></i></a>
                      {{-- Edit --}}
                    <a href="{{route('admin.categories.edit',$c->id)}}" class="btn btn-sm btn-warning">
                      <i class="fa-solid fa-pencil"></i></a> 
                      {{-- Delete --}}
                    <form action="{{route('admin.categories.destroy', $c->id)}}" method="POST"  class="delete-form" data-title="{{$c->label}}">
                      @method('DELETE')
                      @csrf
                      <button type="submit" class="btn btn-sm btn-danger"><i class="fa-solid fa-trash"></i></button>
                    </form>
                  </td>
            </tr>         
        @empty
            
        @endforelse 
    </tbody>
  </table>
@endsection