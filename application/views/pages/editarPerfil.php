<?php
$user = $this->session->userdata('nivel_usuario');
if($user != 'administrador' && $user != 'bibliotecario' && $user != 'usuario'){redirect(base_url(''));}
?>

<?php
if (!empty($title)){
	foreach ($title as $query) {
		if ($query->tipoUsuario == 'tipoAl'){?>

			<form action="<?=base_url('tratarEditarPerfilAl')?>" method="POST">

				<div class="container">
					<div class="row">
						<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
							<div class="form-element-list mg-t-30">
								<div class="form-group ic-cmp-int">
									<div class="form-ic-cmp">
										<i class="notika-icon notika-support"></i>
									</div>
									<div class="nk-int-st">
										<p><b>Nome: </b>
											<input type="text" name="nome" value="<?= $query->nome ?>" class="form-control"
												   placeholder="<?= $query->nome ?>"></p>
									</div>
								</div>
							</div>
						</div>

						<input type="hidden" name="mat_aluno" value="<?= $query->mat_aluno ?>" class="form-control"
							   placeholder="<?= $query->mat_aluno ?>"></p>

						<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
							<div class="form-element-list mg-t-30">
								<div class="form-group ic-cmp-int">
									<div class="form-ic-cmp">
										<i class="notika-icon notika-support"></i>
									</div>
									<div class="nk-int-st">
										<p><b>Usuário: </b>
											<input type="text" name="username" value="<?= $query->username ?>" class="form-control"
												   placeholder="<?= $query->username ?>" disabled></p>
									</div>
								</div>
							</div>
						</div>

						<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
							<div class="form-element-list mg-t-30">
								<div class="form-group ic-cmp-int">
									<div class="form-ic-cmp">
										<i class="notika-icon notika-tax"></i>
									</div>
									<div class="nk-int-st">
										<p><b>Senha: </b>
											<input type="password" value="" name="password"
												   class="form-control"
												   placeholder="Nova Senha"></p>
									</div>
								</div>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
							<div class="form-element-list mg-t-30">
								<div class="form-group ic-cmp-int form-elet-mg res-mg-fcs">
									<div class="form-ic-cmp">
										<i class="notika-icon notika-house"></i>
									</div>
									<div class="nk-int-st">
										<p><b>Endereço: </b>
											<input type="text" name="user_end" value="<?= $query->user_end ?>" class="form-control"
												   placeholder="<?= $query->user_end ?>"></p>
									</div>
								</div>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="btn pull-right btn-sm" style="margin-top: 20px">
							<button type="submit" class="btn btn-success notika-btn-success">Atualizar</button>
						</div>
					</div>
				</div>

			</form>
		<?php }



		if ($query->tipoUsuario === 'tipoFunc'){?>
			<form action="<?=base_url('tratarEditarPerfilFunc')?>" method="POST">

				<div class="container">
					<div class="row">
						<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
							<div class="form-element-list mg-t-30">
								<div class="form-group ic-cmp-int">
									<div class="form-ic-cmp">
										<i class="notika-icon notika-support"></i>
									</div>
									<div class="nk-int-st">
										<p><b>Nome: </b>
											<input type="text" name="nome" id="nome" value="<?= $query->nome ?>"
												   class="form-control" placeholder="<?= $query->nome ?>"></p>
									</div>
								</div>
							</div>
						</div>

						<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
							<div class="form-element-list mg-t-30">
								<div class="form-group ic-cmp-int">
									<div class="form-ic-cmp">
										<i class="notika-icon notika-support"></i>
									</div>
									<div class="nk-int-st">
										<p><b>Usuário: </b>
											<input type="text" name="username" value="<?= $query->username ?>"
												   class="form-control" placeholder="<?= $query->username ?>" disabled></p>
									</div>
								</div>
							</div>
						</div>

						<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
							<div class="form-element-list mg-t-30">
								<div class="form-group ic-cmp-int">
									<div class="form-ic-cmp">
										<i class="notika-icon notika-tax"></i>
									</div>
									<div class="nk-int-st">
										<p><b>Senha: </b>
											<input type="password" name="password"
												   class="form-control" placeholder="Nova Senha"></p>
									</div>
								</div>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
							<div class="form-element-list mg-t-30">
								<div class="form-group ic-cmp-int form-elet-mg res-mg-fcs">
									<div class="form-ic-cmp">
										<i class="notika-icon notika-house"></i>
									</div>
									<div class="nk-int-st">
										<p><b>Endereço: </b>
											<input type="text" name="user_end" id="user_end"
												   value="<?= $query->user_end ?>" class="form-control"
												   placeholder="<?= $query->user_end ?>"></p>
									</div>
								</div>
							</div>
						</div>

						<input type="hidden" name="mat_func" value="<?= $query->mat_func ?>" class="form-control" placeholder="<?= $query->mat_func ?>"></p>

					</div>

					<div class="row">
						<div class="btn pull-right btn-sm" style="margin-top: 20px">
							<button type="submit" class="btn btn-success notika-btn-success">Atualizar</button>
						</div>
					</div>

				</div>


			</form>
		<?php }

		if ($query->tipoUsuario == 'tipoProf'){?>
			<form action="<?=base_url('tratarEditarPerfilProf')?>" method="POST">

				<div class="container">
					<div class="row">
						<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
							<div class="form-element-list mg-t-30">
								<div class="form-group ic-cmp-int">
									<div class="form-ic-cmp">
										<i class="notika-icon notika-support"></i>
									</div>
									<div class="nk-int-st">
										<p><b>Nome: </b>
											<input type="text" name="nome" value="<?= $query->nome ?>" class="form-control"
												   placeholder="<?= $query->nome ?>"></p>
									</div>
								</div>
							</div>
						</div>

						<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
							<div class="form-element-list mg-t-30">
								<div class="form-group ic-cmp-int">
									<div class="form-ic-cmp">
										<i class="notika-icon notika-support"></i>
									</div>
									<div class="nk-int-st">
										<p><b>Usuário: </b>
											<input type="text" name="username" value="<?= $query->username ?>"
												   class="form-control"
												   placeholder="<?= $query->username ?>" disabled></p>
									</div>
								</div>
							</div>
						</div>

						<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
							<div class="form-element-list mg-t-30">
								<div class="form-group ic-cmp-int">
									<div class="form-ic-cmp">
										<i class="notika-icon notika-tax"></i>
									</div>
									<div class="nk-int-st">
										<p><b>Senha: </b>
											<input type="password" name="password" value=""
												   class="form-control" placeholder="Nova Senha"></p>
									</div>
								</div>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
							<div class="form-element-list mg-t-30">
								<div class="form-group ic-cmp-int form-elet-mg res-mg-fcs">
									<div class="form-ic-cmp">
										<i class="notika-icon notika-house"></i>
									</div>
									<div class="nk-int-st">
										<p><b>Endereço: </b>
											<input type="text" name="user_end" class="form-control"
												   value="<?= $query->user_end ?>"
												   placeholder="<?= $query->user_end ?>"></p>
									</div>
								</div>
							</div>
						</div>

						<input type="hidden" name="mat_siape" value="<?= $query->mat_siape ?>" class="form-control" placeholder="<?= $query->mat_siape ?>" ></p>

						<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
							<div class="form-element-list mg-t-30">
								<div class="form-group ic-cmp-int form-elet-mg res-mg-fcs">
									<div class="form-ic-cmp">
										<i class="notika-icon notika-edit"></i>
									</div>
									<div class="nk-int-st">
										<p><b>Telefone Celular: </b>
											<input type="text" name="telefone_celular" value="<?= $query->telefone_celular ?>"
												   class="form-control" placeholder="<?= $query->telefone_celular ?>"></p>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="btn pull-right btn-sm" style="margin-top: 20px">
							<button type="submit" class="btn btn-success notika-btn-success">Atualizar</button>
						</div>
					</div>
				</div>
			</form>

		<?php }}} ?>
</form>
