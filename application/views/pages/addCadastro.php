<?php
    $user = $this->session->userdata('nivel_usuario');
    if($user != 'administrador'){redirect(base_url(''));}
?>
<span style="background-color:red;">
  <div class="container">
      <div class="row">
          <div class="col-md-10 col-md-offset-1">
              <div class="login-panel panel panel-success">
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
  </div>
</span>

<div class="container ic-cmp-int float-lb form-elet-mg">
  <div class="data-table-area">
    <div class="container">

      <form action="<?=base_url('registro_usuario')?>" method="post" class="form-signin">

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
        ?>

        <h2 class="h3 mb-3 font-weight-normal">Registrar Usuário</h2>

        <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
              <div class="form-group ic-cmp-int">
                <div class="form-ic-cmp">
                  <i class="notika-icon notika-support"></i>
                </div>
                <div class="nk-int-st">
                  <input type="text" name="nome" class="form-control" placeholder="Nome" required>
                </div>
              </div>
            </div>

            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
              <div class="form-group ic-cmp-int">
                <div class="form-ic-cmp">
                  <i class="notika-icon notika-edit"></i>
                </div>
                <div class="nk-int-st">
                  <input type="text" name="matricula" class="form-control" placeholder="Matrícula" required>
                </div>
              </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
              <div class="form-group ic-cmp-int">
                <div class="form-ic-cmp">
                  <i class="notika-icon notika-support"></i>
                </div>
                <div class="nk-int-st">
                  <input type="text" name="username" class="form-control" placeholder="Usuário" required>
                </div>
              </div>
            </div>

            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
              <div class="form-group ic-cmp-int">
                <div class="form-ic-cmp">
                  <i class="notika-icon notika-tax"></i>
                </div>
                <div class="nk-int-st">
                  <input type="password" name="password" class="form-control" placeholder="Senha" required>
                </div>
              </div>
            </div>

            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
              <div class="form-group ic-cmp-int">
                <div class="form-ic-cmp">
                  <i class="notika-icon notika-map"></i>
                </div>
                <div class="nk-int-st">
                  <input type="text" name="user_end" class="form-control" placeholder="Endereço" required>
                </div>
              </div>
            </div>
        </div>

        <div class="row">
            <div class="form-group col-md-4">
                <label for="usuario">Nível</label><br>
                <?=form_dropdown('nivel_usuario', $nivel, '',array('class' => "selectpicker"));?>
            </div>
            <div class="form-group col-md-4">
                <label for="usuario">Tipo de Usuário</label><br>
                <?=form_dropdown('tipoUsuario', $tipo, '',array('class' => "selectpicker"));?>
            </div>
        </div>

        <div  class="form-group">
            <button type="submit" class="btn btn-success notika-btn-success" value="Cadastrar">Cadastrar</button>
            <button id="limpar" type="reset" class="btn btn-info notika-btn-info" name="Limpar" value="Limpar">Limpar</button>
        </div>

    </form>
      
    </div>
  </div>
</div>