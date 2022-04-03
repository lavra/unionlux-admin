<nav class="navbar navbar-expand-xl navbar-dark bg-dark">
    <a class="navbar-brand" href="#">{{ config('app.name', 'Unionlux') }} </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample06" aria-controls="navbarsExample06" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarsExample06">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item @if($configPage == 'home') active @endif">
                <a class="nav-link" href="{{url('home')}}">Home @if($configPage == 'home') <span class="sr-only">(current)</span> @endif</a>
            </li>
            <li class="nav-item @if($configPage == 'users') active @endif">
                <a class="nav-link" href="{{url('usuarios')}}">Usuários @if($configPage == 'users') <span class="sr-only">(current)</span> @endif</a>
            </li>
            <li class="nav-item">
                <a class="nav-link @if($configPage == 'categories') active @endif" href="{{url('categorias')}}">Categorias @if($configPage == 'categories') <span class="sr-only">(current)</span> @endif</a>
            </li>
            <li class="nav-item">
                <a class="nav-link @if($configPage == 'products') active @endif" href="{{url('produtos')}}">Produtos @if($configPage == 'products') <span class="sr-only">(current)</span> @endif</a>
            </li>
            <li class="nav-item">
                <a class="nav-link @if($configPage == 'contacts') active @endif" href="{{url('contatos')}}">Contatos @if($configPage == 'contacts') <span class="sr-only">(current)</span> @endif</a>
            </li>
            <li class="nav-item">
                <a class="nav-link @if($configPage == 'newsletters') active @endif" href="{{url('newsletters')}}">Newsletters @if($configPage == 'newsletters') <span class="sr-only">(current)</span> @endif</a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Sair</a>
            </li>
        </ul>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
        <div class="float-right text-info"><i class="fa fa-user"></i> {{Auth::user()->name}}</div>

    </div>
</nav>
