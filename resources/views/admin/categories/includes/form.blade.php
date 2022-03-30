@if ($category ->exists)
<form action="{{route('admin.categories.update',$category->id)}}" method="POST">
    @method('PUT')
    @else
    <form action="{{route('admin.categories.store')}}" method="POST">
        @endif
        @csrf
        <div class="row">        
            {{-- Errors --}}
            @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            <div class="col-12">
            @else
            <div class="col-8">
            @endif
            {{-- Form Fields  --}}
                <div class="form-group">
                    <label for="label">Titolo Categoria</label>
                    <input type="text" class="form-control @error('label') is-invalid @enderror" id="label" name="label" value="{{old('label',$category->label)}}" />
                    <small id="titleHelp" class="form-text text-muted">Inserici qui il titolo del tuo post</small>
                </div>
            </div>

            <div class="col-4">
                <div class="form-group">
                    <label for="category-pill">Colore Categoria</label>
                    <select class="form-control" id="category-pill" name="color">
                        <option @if(old('color',$category->color) == 'success' )selected @endif value="success">Verde</option>
                        <option @if(old('color',$category->color) == 'light' ) selected @endif value="light">Bianco</option>
                        <option @if(old('color',$category->color) == 'primary' ) selected @endif value="primary">Blu</option>
                        <option @if(old('color',$category->color) == 'secondary' ) selected @endif value="secondary">Grigio</option>
                        <option @if(old('color',$category->color) == 'danger' ) selected @endif value="danger">Rosso</option>
                        <option @if(old('color',$category->color) == 'warning' ) selected @endif value="warning">Arancio</option>
                    </select>
                  </div>
                </div>
            </div>
            <div class="d-flex justify-content-center">
                <button type="submit" class="btn btn-{{ $category->color }}">
                    <i class="fa-solid fa-floppy-disk mr-2"></i>
                    <span>Conferma</span>
                </button>
            </div>
        </form>
</div>