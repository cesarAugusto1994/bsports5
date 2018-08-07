@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Jogadores</h1>
@stop

@section('content')

<div class="row">

  <div class="col-md-12">
  </div>

  <div class="col-md-12">
    <div class="box box-info">
      <div class="box-header with-border">
        <h3 class="box-title">Novo Jogador</h3>

        <div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
          </button>
          <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
        </div>
      </div>
      <!-- /.box-header -->
      <div class="box-body">

        <form class="form-horizontal">
          <div class="box-body">
            <div class="form-group">
              <label for="nome" class="col-sm-2 control-label">Nome</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="nome" placeholder="Nome" required>
              </div>
            </div>
            <div class="form-group">
              <label for="email" class="col-sm-2 control-label">Email</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="email" placeholder="Email" required>
              </div>
            </div>
            <div class="form-group">
              <label for="nascimento" class="col-sm-2 control-label">Nascimento</label>
              <div class="col-sm-10">
                <input type="text" class="form-control date" id="nascimento" placeholder="Nascimento" required>
              </div>
            </div>
            <div class="form-group">
              <label for="lateralidade" class="col-sm-2 control-label">Lateralidade</label>
              <div class="col-sm-10">
                <select name="lateralidade" class="form-control" id="lateralidade" required>
                    <option value="Destro">Destro</option>
                    <option value="Canhoto">Canhoto</option>
                </select>
              </div>
            </div>
            <div class="form-group">
              <label for="categoria" class="col-sm-2 control-label">Categoria</label>
              <div class="col-sm-10">
                <select name="categoria" class="form-control" id="categoria" required>
                    @foreach(\App\Models\Categoria::where('tipo', 'Simples')->orderBy('tipo')->get() as $categoria)
                        <option value="{{ $categoria->id }}">{{ $categoria->nome }}</option>
                    @endforeach
                </select>
              </div>
            </div>
            <div class="form-group">
              <label for="observacao" class="col-sm-2 control-label">Observação</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="observacao" placeholder="Observação">
              </div>
            </div>
            <div class="form-group">
              <label for="inputPassword3" class="col-sm-2 control-label">Senha</label>
              <div class="col-sm-10">
                <input type="password" class="form-control" id="inputPassword3" placeholder="Senha" required>
              </div>
            </div>
            <div class="form-group">
              <label for="inputPassword3" class="col-sm-2 control-label">Repetir Senha</label>
              <div class="col-sm-10">
                <input type="password" class="form-control" id="inputPassword3" placeholder="Repetir Senha" required>
              </div>
            </div>

          </div>
          <!-- /.box-body -->
          <div class="box-footer">
            <button type="submit" class="btn btn-default">Cancelar</button>
            <button type="submit" class="btn btn-info pull-right">Salvar</button>
          </div>
          <!-- /.box-footer -->
        </form>

      </div>
      <!-- /.box-footer -->
    </div>
  </div>
</div>


@stop

@section('css')
@stop

@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>

<script>
  $(document).ready(function() {
    $('.date').mask('00/00/0000');
  });
</script>
@stop
