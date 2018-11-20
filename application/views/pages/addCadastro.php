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

<div class="container ic-cmp-int float-lb form-elet-mg form-add">
	<div class="container">

		<form action="<?=base_url('registro_usuario')?>" method="post" class="form-signin" id="form_user">

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
										<input type="text" name="user_end" class="form-control" placeholder="Home Address" required>
									</div>
								</div>
							</div>
							<div class="col-lg-3 col-lg-offset-1 col-md-3 col-md-offset-1 col-sm-3 col-sm-offset-1 col-xs-10 col-xs-offset-2" style="margin-top:6px;">
								<div class="bootstrap-select fm-cmp-mg">
									<select name="tipoUsuario" class="selectpicker" id="tipo_drop_add">
										<option disabled="disabled" selected>Escolha o tipo de usuário</option>
										<option value="tipoProf">Professor</option>
										<option value="tipoFunc">Funcionário</option>
										<option value="tipoAl">Aluno</option>
									</select>
								</div>
							</div>
							<div class="col-lg-3 col-lg-offset-1 col-md-3 col-md-offset-1 col-sm-3 col-sm-offset-1 col-xs-10 col-xs-offset-2" style="margin-top:6px;">
								<div class="bootstrap-select fm-cmp-mg">
									<select name="nivel_usuario" class="selectpicker">
										<option disabled="disabled" selected>Escolha o nível de acesso</option>
										<option value="administrador">Administrador</option>
										<option value="bibliotecario">Bibliotecário</option>
										<option value="usuario">Usuário</option>
									</select>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div id="dinamic-div-form" style="display: none;"></div>

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

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="<?php echo base_url('static/js/jquery-3.3.1.min.js')?>"></script>
<script src="<?php echo base_url('static/js/bootstrap.min.js')?>"></script>
<script src="<?php echo base_url('static/js/popper.min.js')?>"></script>
<script src="<?php echo base_url('static/js/perso.js')?>"></script>


<script>

</script>
