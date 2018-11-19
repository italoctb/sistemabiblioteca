<?php
    $user = $this->session->userdata('nivel_usuario');
    if($user != 'administrador'){redirect(base_url(''));}
?>

<div class="container ic-cmp-int float-lb form-elet-mg form-add">
    <div class="container">

      <form action="<?=base_url('trataRemover')?>" method="post" class="form-signin">

        <div class="row">
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="form-element-list mg-t-30">
              <div class="row">
                  <div class="col-lg-6  col-md-6  col-sm-6  col-xs-12">
                    <div class="nk-int-mk sl-dp-mn sm-res-mg-t-10">
                        <h2>Remover cadastro</h2>
                    </div>
                      <div class="bootstrap-select fm-cmp-mg">
                          <select class="selectpicker" data-live-search="true" name="username">
                            <option disabled="disabled" selected>Escolha o usuário</option>
                            <?php foreach ($title as $usuario){
                                echo "<option>$usuario->username</option>";
                            }?>
                          </select>
                      </div>
                  </div>
                  <div class="col-lg-6  col-md-6  col-sm-6  col-xs-12" style="position: relative; top:25px;">
                    <div  class="form-group justify-content-center" style="text-align: center;">
                        <button type="submit" class="btn btn-danger notika-btn-danger" value="Cadastrar" onclick="return confirm('Tem certeza que deseja deletar o usuário?');">Remover</button>
                    </div>
                  </div>
              </div>
            </div>
          </div>
        </div>

        <div class="row justify-content-center" style="margin-top : 30px;">

        </div>
    </form>
    </div>
  </div>
