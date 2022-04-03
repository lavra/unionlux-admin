<div class="card">
    <div class="card-header">
        <h3 id="header-and-footer">
            <span class="bd-content-title">Conteudo: Slider Home</span>
        </h3>
    </div>
    <div class="card-body">


        <div class="row mb-2">
            <div class="col-md-6">
                <div class="row no-gutters border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
                    <div class="col p-4 d-flex flex-column position-static">
                        <h5 class="card-title">{{$slider->title}}</h5>
                        <p class="card-text">{{$slider->description}}</p>
                        <a href="javascript:void(0)" class="show-form-slider btn btn-primary">Clique aqi para alterar</a>
                    </div>
                    <div class="col-auto d-none d-lg-block">
                        <img src="{{$pathFile}}/{{$slider->image}}" class="bd-placeholder-img" width="200">
                    </div>
                </div>
            </div>

            <div id="form-slider" class="col-md-6" style="display: none">
                <p>Tamanho da imagem 434x529 png(fundo transparente)</p>
                <form action="{{route('home.slider.update')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group row">
                        <label for="inputPassword3" class="col-sm-2 col-form-label">Imagem</label>
                        <div class="col-sm-10">
                            <input type="file" class="form-control-file" name="image">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="title" class="col-sm-2 col-form-label">Titulo</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="title" name="title" value="{{$slider->title}}" autofocus>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="description" class="col-sm-2 col-form-label">Descrição</label>
                        <div class="col-sm-10">
                            <textarea class="form-control" id="description" name="description" rows="3">{{$slider->description}}</textarea>
                        </div>
                    </div>
                    <div class="d-none">
                        <input type="hidden" name="active" value="1">
                        <input type="hidden" name="order" value="01">
                        <input type="hidden" name="page" value="home">
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-10 text-center">
                            <button type="submit" class="btn btn-primary">Altrar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>