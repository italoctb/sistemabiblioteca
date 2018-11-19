<?php
    $user = $this->session->userdata('nivel_usuario');
    if($user != 'administrador'){redirect(base_url(''));}
?>

<div class="container ic-cmp-int float-lb form-elet-mg form-add">
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

        <div class="row">
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="form-element-list mg-t-30">
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
              </div>

              <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <div class="form-group ic-cmp-int form-elet-mg res-mg-fcs">
                        <div class="form-ic-cmp">
                            <i class="notika-icon notika-house"></i>
                        </div>
                        <div class="nk-int-st">
                            <input type="text" class="form-control" placeholder="Home Address" required>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-lg-offset-1 col-md-3 col-md-offset-1 col-sm-3 col-sm-offset-1 col-xs-10 col-xs-offset-2" style="margin-top:6px;">
                    <div class="bootstrap-select fm-cmp-mg">
                        <select class="selectpicker" id = "tipo_drop_add">
                          <option disabled="disabled" selected>Escolha o tipo de usuário</option>
                          <option>Professor</option>
                          <option>Funcionário</option>
                          <option>Aluno</option>
                        </select>
                    </div>
                </div>
                <div class="col-lg-3 col-lg-offset-1 col-md-3 col-md-offset-1 col-sm-3 col-sm-offset-1 col-xs-10 col-xs-offset-2" style="margin-top:6px;">
                    <div class="bootstrap-select fm-cmp-mg">
                        <select class="selectpicker">
                          <option disabled="disabled" selected>Escolha o nível de acesso</option>
                          <option>Administrador</option>
                          <option>Bibliotecário</option>
                          <option>Usuário</option>
                        </select>
                    </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div id="dinamic-div-form" style="display : none;"></div>

        <div class="row justify-content-center" style="margin-top : 30px;">
          <div class="col-xs-4 col-xs-offset-4">
            <div  class="form-group justify-content-center" style="text-align: center;">
                <button type="submit" class="btn btn-success notika-btn-success" value="Cadastrar">Cadastrar</button>
                <button id="limpar" type="reset" class="btn btn-info notika-btn-info" name="Limpar" value="Limpar">Limpar</button>
            </div>
          </div>
        </div>


    </form>

    </div>
  </div>
