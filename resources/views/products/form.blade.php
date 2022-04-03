
<div class="form-group row">
    <label for="image" class="col-md-4 col-form-label text-md-right">
        @isset($product)
            <img src="{{url('/storage')}}/{{$product->image}}" alt="{{$product->name}}" class="img-thumbnail" width="50%" >
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
    <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Categoria') }}</label>
    <div class="col-md-6">
        <select id="category_id" name="category_id" class="form-control">
            @foreach($categories as $key => $value)
                @isset($product)
                    <option @if($product->category_id == $key) selected @endif value="{{$key}}">{{$value}}</option>
                @else
                    <option value="{{$key}}">{{$value}}</option>
                @endisset
            @endforeach
        </select>
    </div>
</div>

<div class="form-group row">
    <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Nome') }}</label>

    <div class="col-md-6">
        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $product->name ?? old('name') }}"  autocomplete="name" >
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
        <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="description" rows="3">{{ $product->description ?? old('description') }}</textarea>
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
            <input id="name" type="number" class="form-control @error('order') is-invalid @enderror" name="order" value="{{ $product->order ?? old('order') }}"  autocomplete="order" style="width: 80px">
            <span style="padding-left: 30px"></span>
            <span style="padding-left: 10px">
                @isset($product)
                    <input class="form-check-input" type="radio" name="active" id="active1" value="1" @if($product->active == 1) checked @endif>
                @else
                    <input class="form-check-input" type="radio" name="active" id="active1" value="1" checked>
                @endisset
                <label class="form-check-label" for="inlineRadio1"> Ativo</label>
            </span>
            <span style="padding-left: 10px">
                @isset($product)
                    <input class="form-check-input" type="radio" name="active" id="active2" value="0" @if($product->active == 0) checked @endif>
                @else
                    <input class="form-check-input" type="radio" name="active" id="active2" value="0">
                @endisset
                <label class="form-check-label" for="inlineRadio1"> Inativo</label>
            </span>
        </span>
    </div>
</div>



