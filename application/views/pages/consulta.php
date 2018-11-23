<?php
    $user_id = $this->session->userdata('nivel_usuario');
    $tipo= $this->session->userdata('tipoUsuario');
    if($user_id != 'usuario' && $user_id != 'bibliotecario' && $user_id != 'administrador'){redirect(base_url('sem_acesso'));}
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

<div class="container ic-cmp-int float-lb form-elet-mg form-add">
    <div class="container">
      <form action="<?=base_url('redirecionaEmprestimo')?>" method="post" class="form-signin">
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
                            <input type="text" name="username" class="form-control" placeholder="Usuário" required>
                          </div>
                        </div>
                      </div>

                      <div class="col-lg-3 col-lg-offset-1 col-md-3 col-md-offset-1 col-sm-3 col-sm-offset-1 col-xs-10 col-xs-offset-2" style="margin-top:6px;">
                          <div class="bootstrap-select fm-cmp-mg">
                              <select class="selectpicker" id = "tipo_drop_emp">
                                <option disabled="disabled" selected>Escolha o parâmentro</option>
                                <option>ISBN</option>
                                <option>Título da obra</option>
                              </select>
                          </div>
                      </div>

                      <div id="isbnEmpDiv" style="display: none;">
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <div class="form-group ic-cmp-int form-elet-mg">
                                <div class="form-ic-cmp">
                                    <i class="notika-icon notika-edit"></i>
                                </div>
                                <div class="nk-int-st">
                                    <input type="text" class="form-control" placeholder="ISBN" id="isbnEmp" name="isbnEmp">
                                </div>
                            </div>
                        </div>
                      </div>

                      <div id="nomeObraDiv" style="display: none;">
                        <div class="col-lg-3 col-lg-offset-1 col-md-3 col-md-offset-1 col-sm-3 col-sm-offset-1 col-xs-10 col-xs-offset-2" style="margin-top:6px;">
                            <div class="bootstrap-select fm-cmp-mg">
                                <select class="selectpicker" id = "nomeObra" data-live-search="true" name="nomeObra">
                                  <option disabled="disabled" selected>Escolha o Título da obra</option>
                                  <?php foreach ($livros as $liv){
                                      echo "<option>$liv->titulo</option>";
                                  }?>
                                </select>
                            </div>
                        </div>
                      </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="row justify-content-center" style="margin-top : 30px;">
              <div class="col-xs-4 col-xs-offset-4">
                <div  class="form-group justify-content-center" style="text-align: center;">
                    <button type="submit" class="btn btn-success notika-btn-success" value="Cadastrar">Realizar Empréstimo</button>
                    <button id="limpar" type="reset" class="btn btn-info notika-btn-info" name="Limpar" value="Limpar">Limpar</button>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
