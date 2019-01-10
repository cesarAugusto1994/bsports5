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
    <div class="box box-solid">
      <div class="box-header with-border">
        <h3 class="box-title">Novo Jogador</h3>
      </div>
      <!-- /.box-header -->
      <div class="box-body">

        <form class="form-horizontal" method="post" action="{{ route('players.store') }}" enctype="multipart/form-data">
          {{ csrf_field() }}
          <div class="box-body">
            <div class="form-group">
              <label for="nome" class="col-sm-2 control-label">Nome</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="nome" name="nome" placeholder="Nome" required>
              </div>
            </div>
            <div class="form-group">
              <label for="email" class="col-sm-2 control-label">Email</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="email" name="email" placeholder="Email" required>
              </div>
            </div>
            <div class="form-group">
              <label for="nascimento" class="col-sm-2 control-label">Nascimento</label>
              <div class="col-sm-10">
                <input type="text" class="form-control date" id="nascimento" name="nascimento" placeholder="Nascimento" required>
              </div>
            </div>
            <div class="form-group">
              <label for="lateralidade" class="col-sm-2 control-label">Lateralidade</label>
              <div class="col-sm-10">
                <select name="lateralidade" class="form-control" id="lateralidade" name="lateralidade" required>
                    <option value="Destro">Destro</option>
                    <option value="Canhoto">Canhoto</option>
                </select>
              </div>
            </div>
            <div class="form-group">
              <label for="categoria" class="col-sm-2 control-label">Categoria</label>
              <div class="col-sm-10">
                <select name="categoria" class="form-control" id="categoria" name="categoria" required>
                    @foreach($categorias as $categoria)
                        <option value="{{ $categoria->id }}">{{ $categoria->nome }}</option>
                    @endforeach
                </select>
              </div>
            </div>

            <div class="form-group">
              <label for="telefone" class="col-sm-2 control-label">Celular</label>
              <div class="col-sm-10">
                <input type="text" class="form-control celphone" name="celular" id="celular" placeholder="Celular">
              </div>
            </div>

            <div class="form-group">
              <label for="telefone" class="col-sm-2 control-label">Telefone</label>
              <div class="col-sm-10">
                <input type="text" class="form-control phone" name="telefone" id="telefone" placeholder="Telefone">
              </div>
            </div>

            <div class="form-group">
              <label for="telefone" class="col-sm-2 control-label">Avatar</label>
              <div class="col-sm-10">
                <input type="file" class="form-control" name="avatar" id="avatar" placeholder="Avatar">
              </div>
            </div>

            <div class="form-group">
              <label for="cep" class="col-sm-2 control-label">CEP</label>
              <div class="col-sm-10">
                <input type="text" class="form-control cep" data-url="{{ route('cep') }}" name="cep" id="cep" placeholder="">
              </div>
            </div>

            <div class="form-group">
              <label for="endereco" class="col-sm-2 control-label">Endereço</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="endereco" id="endereco" placeholder="">
              </div>
            </div>

            <div class="form-group">
              <label for="numero" class="col-sm-2 control-label">Numero</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="numero" id="numero" placeholder="">
              </div>
            </div>

            <div class="form-group">
              <label for="bairro" class="col-sm-2 control-label">Bairro</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="bairro" id="bairro" placeholder="">
              </div>
            </div>

            <div class="form-group">
              <label for="cidade" class="col-sm-2 control-label">Cidade</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="cidade" id="cidade" placeholder="">
              </div>
            </div>

            <div class="form-group">
              <label for="estado" class="col-sm-2 control-label">Estado</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="estado" id="estado" placeholder="">
              </div>
            </div>

            <div class="form-group">
              <label for="observacao" class="col-sm-2 control-label">Observação</label>
              <div class="col-sm-10">
                <textarea class="form-control" id="observacao" name="observacao"></textarea>
              </div>
            </div>
            <div class="form-group">
              <label for="password" class="col-sm-2 control-label">Senha</label>
              <div class="col-sm-10">
                <input type="password" class="form-control" id="password" name="password" placeholder="Senha" required>
              </div>
            </div>
            <div class="form-group">
              <label for="password_confirmation" class="col-sm-2 control-label">Repetir Senha</label>
              <div class="col-sm-10">
                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Repetir Senha" required>
              </div>
            </div>

            <div class="form-group">
              <div class="col-sm-offset-2 col-sm-10">
                <div class="checkbox">
                  <label>
                    <input type="checkbox" value="1" checked name="ativo"/> Ativo
                  </label>
                </div>
              </div>
            </div>


          </div>
          <!-- /.box-body -->
          <div class="box-footer">
            <button type="submit" class="btn btn-success">Salvar</button>
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
    $('.cpf').mask('000.000.000-00', {reverse: true, placeholder: "___.___.___-__"});
    $('.date').mask("00/00/0000", {placeholder: "__/__/____"})
    $('.phone').mask('(00) 0000-0000');
    $('.celphone').mask('(00) 00000-0000');
  });
</script>
@stop
