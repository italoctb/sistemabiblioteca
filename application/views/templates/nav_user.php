<!-- NavBar mobile -->
<div class="mobile-menu-area">
	<div class="container">
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="mobile-menu">
					<nav id="dropdown">
						<ul class="mobile-menu-nav">
							<li><a data-toggle="collapse" data-target="#Charts" href="#">Início</a>
								<ul class="collapse dropdown-header-top">
									<li><a href="<?=base_url('user/home')?>">Biblioteca</a></li>
									<li><a href="<?=base_url('meusEmprestimos')?>">Meus empréstimos</a></li>
									<li><a href="<?php echo base_url('logout')?>">Sair</a></li>
								</ul>
							</li>
							<li><a data-toggle="collapse" data-target="#Charts" href="#">Sistema</a>
								<ul class="notika-main-menu-dropdown">
									<li><a href="<?=base_url('reserva')?>">Realizar reserva</a></li>
								</ul>
							</li>
							<li><a data-toggle="collapse" data-target="#Pagemob" href="#">Usuário</a>
								<ul id="Pagemob" class="collapse dropdown-header-top">
									<li><a href="<?=base_url('meuPerfil')?>">Meu perfil</a></li>
									<li><a href="<?=base_url('editarPerfil')?>">Editar perfil</a></li>
									<li><a href="<?=base_url('cancelCadastro')?>">Cancelar cadastro</a></li>
								</ul>
							</li>
						</ul>
					</nav>
				</div>
			</div>
		</div>
	</div>
</div>
<!--  NavBar Computador-->
<div class="main-menu-area mg-tb-40">
	<div class="container">
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<ul class="nav nav-tabs notika-menu-wrap menu-it-icon-pro">
					<li class="active"><a data-toggle="tab" href="#Home"><i class="notika-icon notika-house"></i> Início</a>
					</li>
					<li><a data-toggle="tab" href="#Forms"><i class="notika-icon notika-form"></i> Sistema</a>
					</li>
					<li><a data-toggle="tab" href="#Page"><i class="notika-icon notika-support"></i> Usuário</a>
					</li>
				</ul>
				<div class="tab-content custom-menu-content">
					<div id="Home" class="tab-pane in active notika-tab-menu-bg animated flipInX">
						<ul class="notika-main-menu-dropdown">
							<li><a href="<?=base_url('user/home')?>">Biblioteca</a></li>
							<li><a href="<?=base_url('meusEmprestimos')?>">Meus empréstimos</a></li>
							<li><a href="<?=base_url('minhasReservas')?>">Minhas Reservas</a></li>
							<li><a href="<?php echo base_url('logout')?>">Sair</a></li>
						</ul>
					</div>
					<div id="Forms" class="tab-pane notika-tab-menu-bg animated flipInX">
						<ul class="notika-main-menu-dropdown">
							<li><a href="<?=base_url('reserva')?>">Realizar reserva</a></li>
						</ul>
					</div>
					<div id="Page" class="tab-pane notika-tab-menu-bg animated flipInX">
						<ul class="notika-main-menu-dropdown">
							<li><a href="<?=base_url('meuPerfil')?>">Meu perfil</a></li>
							<li><a href="<?=base_url('editarPerfil')?>">Editar perfil</a></li>
							<li><a href="<?=base_url('cancelCadastro')?>">Cancelar cadastro</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
