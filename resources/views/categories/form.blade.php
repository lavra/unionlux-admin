
<div class="form-group row">
    <label for="image" class="col-md-4 col-form-label text-md-right">
        @isset($category)
            <img src="{{url('/storage')}}/{{$category->image}}" alt="{{$category->name}}" class="img-thumbnail" width="50%" >
        @else
            {{ __('Foto') }}
        @endisset
    </label>
    <div class="col-md-6">
        <div class="custom-file">
            <input type="file" class="custom-file-input form-control @error('image') is-invalid @enderror" name="image" autocomplete="image">
            <label class="custom-file-label" for="image"></label>
            @error('image')
                <div class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </div>
            @enderror
        </div>
    </div>
</div>

<div class="form-group row">
    <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Nome') }}</label>

    <div class="col-md-6">
        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $category->name ?? old('name') }}"  autocomplete="name" >
        @error('name')
        <div class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </div>
        @enderror
    </div>
</div>

<div class="form-group row">
    <label for="description" class="col-md-4 col-form-label text-md-right">{{ __('Descrição') }}</label>
    <div class="col-md-6">
        <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="description" rows="3">{{ $category->description ?? old('description') }}</textarea>
        @error('description')
        <div class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </div>
        @enderror
    </div>
</div>

<div class="form-group row">
    <label for="active" class="col-md-4 col-form-label text-md-right">Ordem</label>
    <div class="col-md-6">
        <span class="form-check form-check-inline">
            <input id="name" type="number" class="form-control @error('order') is-invalid @enderror" name="order" value="{{ $category->order ?? old('order') }}"  autocomplete="order" style="width: 80px">
            <span style="padding-left: 30px"></span>
            <span style="padding-left: 10px">
                @isset($category)
                    <input class="form-check-input" type="radio" name="active" id="active1" value="1" @if($category->active == 1) checked @endif>
                @else
                    <input class="form-check-input" type="radio" name="active" id="active1" value="1" checked>
                @endisset
                <label class="form-check-label" for="inlineRadio1"> Ativo</label>
            </span>
            <span style="padding-left: 10px">
                @isset($category)
                    <input class="form-check-input" type="radio" name="active" id="active2" value="0" @if($category->active == 0) checked @endif>
                @else
                    <input class="form-check-input" type="radio" name="active" id="active2" value="0">
                @endisset
                <label class="form-check-label" for="inlineRadio1"> Inativo</label>
            </span>
        </span>
    </div>
</div>



