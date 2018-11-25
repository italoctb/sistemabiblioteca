<?php
    $user = $this->session->userdata('nivel_usuario');
    if($user != 'administrador'){redirect(base_url(''));}
?>
<span style="background-color:red;">
  <div class="container">
      <div class="row">
          <div class="col-md-10 col-md-offset-1">
                  <div class="panel-body">
                      <?php
                      $success_msg= $this->session->flashdata('success_msg');
                      $error_msg= $this->session->flashdata('error_msg');

                      if($success_msg){
                          ?>
                          <div class="alert alert-success">
                                <?php echo $success_msg; ?>
                              </div>
                          <?php
                      }
                      if($error_msg){
                          ?>
                          <div class="alert alert-danger">
                                <?php echo $error_msg; ?>
                            </div>
                          <?php
                      }
                      ?>
                  </div>
          </div>
      </div>
  </div>
</span>

<div class="container ic-cmp-int float-lb form-elet-mg">
  <div class="data-table-area">
    <div class="container">

      <form action="<?=base_url('updateUsuario')?>" method="post" class="form-signin">

        <?php
            $nivel = array(
                'administrador'   => 'Administrador',
                'usuario'         => 'Usuário',
                'bibliotecario'   => 'Bibliotecario'
            );

            $tipo = array(
                'tipoFunc' => 'Funcionário',
                'tipoProf' => 'Professor',
                'tipoAl'   => 'Aluno',
            );

            if ($usuario[0]->tipoUsuario == 'tipoFunc'):
              $matricula = $usuario[0]->mat_func;
            elseif ($usuario[0]->tipoUsuario == 'tipoAl'):
              $matricula = $usuario[0]->mat_aluno;
            elseif ($usuario[0]->tipoUsuario == 'tipoProf'):
              $matricula = $usuario[0]->mat_siape;
            endif;
        ?>

        <h2 class="h3 mb-3 font-weight-normal">Editar Usuário</h2>

        <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
              <div class="form-group ic-cmp-int">
                <div class="form-ic-cmp">
                  <i class="notika-icon notika-support"></i>
                </div>
                <div class="nk-int-st">
                  <input type="text" name="nome" class="form-control" placeholder="Nome" value="<?=$usuario[0]->nome?>" required>
                </div>
              </div>
            </div>
                  <input type="hidden" name="matricula" class="form-control" placeholder="Matrícula" value="<?=$matricula?>" required>

        <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
              <div class="form-group ic-cmp-int">
                <div class="form-ic-cmp">
                  <i class="notika-icon notika-support"></i>
                </div>
                <div class="nk-int-st">
                  <input type="text" name="username" class="form-control" placeholder="Usuário" value="<?=$usuario[0]->username?>" required>
                </div>
              </div>
            </div>

            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
              <div class="form-group ic-cmp-int">
                <div class="form-ic-cmp">
                  <i class="notika-icon notika-map"></i>
                </div>
                <div class="nk-int-st">
                  <input type="text" name="user_end" class="form-control" placeholder="Endereço" value="<?=$usuario[0]->user_end?>" required>
                </div>
              </div>
            </div>

            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
              <div class="form-group ic-cmp-int">
                <div class="form-ic-cmp">
                  <i class="notika-icon notika-tax"></i>
                </div>
                <div class="nk-int-st">
                  <button type="buttom" class="btn btn-success notika-btn-success" value="Atualizar Senha" disabled>Atualizar senha</button>
                </div>
              </div>
          </div>
        </div>

        <div class="row" >
            <div class="form-group col-md-4">
                <input type="hidden" name="nivel_usuario" class="form-control" placeholder="Nível" value="<?=$usuario[0]->nivel_usuario?>" required>
            </div>
            <div class="form-group col-md-4">
                <input type="hidden" name="tipoUsuario" class="form-control" placeholder="Tipo" value="<?=$usuario[0]->tipoUsuario?>" required>
            </div>
        </div>

        <div  class="form-group">
            <button type="submit" class="btn btn-success notika-btn-success" value="Cadastrar">Atualizar</button>
			<a class="btn btn-primary notika-btn-primary" href="<?= base_url('editarCadastro') ?>">Voltar</a>
        </div>

    </form>

    </div>
  </div>
</div>
