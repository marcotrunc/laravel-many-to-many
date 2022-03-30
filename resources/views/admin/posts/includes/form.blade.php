@if ($post ->exists)
<form action="{{route('admin.posts.update',$post->id)}}" method="POST">
    @method('PUT')
    @else
    <form action="{{route('admin.posts.store')}}" method="POST">
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
                    <label for="title">Titolo</label>
                    <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{old('title',$post->title)}}" />
                    <small id="titleHelp" class="form-text text-muted">Inserici qui il titolo del tuo post</small>
                </div>
            </div>

            <div class="col-4">
                <div class="form-group">
                    <label for="category-pill">Categoria</label>
                    <select class="form-control" id="category-pill" name="category_id">
                    <option value="">Altro</option>
                      @foreach ($categories as $category)
                      <option value="{{$category->id}}" @if(old('category_id',$post->category_id) == $category->id) selected @endif>{{$category->label}} </option>
                      @endforeach
                    </select>
                  </div>
            </div>

            <div class="col-12">
                <div class="form-group">
                    <label for="content">Contenuto</label>
                    <textarea class="form-control @error('content') is-invalid @enderror" id="content" rows="5" name="content">{{old('content',$post->content)}}</textarea>
                </div>
            </div>
            <div class="col-11">
                <div class="form-group">
                    <label for="image">Link dell'immagine</label>
                    <input type="text" class="form-control @error('image') is-invalid @enderror" id="image" name="image" value="{{old('image',$post->image)}}">
                    <small id="imageHelp" class="form-text text-muted">Inserici qui il link dell'immagine</small>
                </div>
            </div>
            <div class="col-1">
                <img src="{{old('image', $post->image ?? 'https://www.geometrian.it/wp-content/uploads/2016/12/image-placeholder-500x500.jpg') }} " alt="{{$post->title}}" id="preview" width="100px" class="@error('image') is-invalid @enderror">
            </div>
            <div class="col-12 d-flex justidy-content-center">
                <hr>
                @foreach($tags as $tag)
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" id="tag-{{$tag->id}}" value="{{$tag->id}}" name="tags[]" role="button" @if(in_array($tag->id, old('tags') ?? [])) checked @endif>
                    <label class="form-check-label" for="tag-{{$tag->id}}"> {{$tag->label}} </label>
                </div>
                @endforeach
                <hr>
            </div>
            </div>
            <div class="d-flex justify-content-center mt-4">
                <button type="submit" class="btn btn-success">
                    <i class="fa-solid fa-floppy-disk mr-2"></i>
                    <span>Conferma</span>
                </button>
            </div>
        </form>
</div>
<script src="{{asset('js/image-preview.js')}}" defer></script>