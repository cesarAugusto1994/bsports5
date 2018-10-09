<div class="logo-nav">
  <div class="header-action-bar" style="background:#215a88">
    <div class="container">
        <div class="row">
            <div class="col-md-12">

              <div class="header-navbar">

                  <nav>

                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                      <ul class="nav navbar-nav">
                        @foreach(\App\Models\MenuCategorias::orderBy('categoria_id')->get() as $item)
                            <li class="" style="background-color:#1b4465;height:100%"><a class="link-categorias" href="?category={{ $item->categoria->id }}">{{ $item->categoria->nome }}</a></li>
                        @endforeach
                      </ul>
                    </div>

                  </nav>

              </div>

            </div>

        </div>
    </div>
  </div>
</div>
