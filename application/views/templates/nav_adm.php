<body>
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
																		<li><a href="<?=base_url('home')?>">Biblioteca</a></li>
																		<li><a href="<?=base_url('professores')?>">Professores</a></li>
																		<li><a href="<?=base_url('consultaUsuario')?>">Consulta usuários</a></li>
																		<li><a href="<?=base_url('consultaEmprestimo')?>">Consulta empréstimos</a></li>
																		<li><a href="<?=base_url('meusEmprestimos')?>">Meus empréstimos</a></li>
																		<li><a href="<?=base_url('logout')?>">Sair</a></li>
	                                </ul>
	                            </li>

								<li><a data-toggle="collapse" data-target="#Charts" href="#">Sistema</a>
									<ul class="notika-main-menu-dropdown">
										<li><a href="<?=base_url('consultaAdmin')?>">Realizar empréstimos</a></li>
										<li><a href="<?=base_url('')?>">Alterar empréstimos</a></li>
										<li><a href="<?=base_url('')?>">Finalizar empréstimos</a></li>
									</ul>
	                            </li>

	                            <li><a data-toggle="collapse" data-target="#Pagemob" href="#">Usuário</a>
	                                <ul id="Pagemob" class="collapse dropdown-header-top">
										<li><a href="<?=base_url('meuPerfil')?>">Meu perfil</a></li>
										<li><a href="<?=base_url('editarUsuario/')?>">Editar perfil</a></li>
										<li><a href="<?=base_url('')?>">Adicionar cadastro</a></li>
										<li><a href="<?=base_url('')?>">Cancelar cadastro</a></li>
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

	                <ul class="nav nav-tabs notika-menu-wrap menu-it-icon-pro nav-li">
	                    <li class="active"><a data-toggle="tab" href="#Home"><i class="notika-icon notika-house"></i> Início</a></li>
	                    <li><a data-toggle="tab" href="#Forms"><i class="notika-icon notika-form"></i> Sistema</a></li>
	                    <li><a data-toggle="tab" href="#Page"><i class="notika-icon notika-support"></i> Usuário</a></li>
	                </ul>

	                <div class="tab-content custom-menu-content">

	                    <div id="Home" class="tab-pane in active notika-tab-menu-bg animated flipInX">
	                        <ul class="notika-main-menu-dropdown">
								<li><a href="<?=base_url('admin/home')?>">Biblioteca</a></li>
								<li><a href="<?=base_url('consultaProf')?>">Professores</a></li>
								<li><a href="<?=base_url('consultaUsuario')?>">Consultar usuários</a></li>
								<li><a href="<?=base_url('admin/consultaEmprestimo')?>">Consultar empréstimos</a></li>
								<li><a href="<?=base_url('admin/consultaReserva')?>">Consultar reservas</a></li>
								<li><a href="<?=base_url('admin/meusEmprestimos')?>">Meus empréstimos</a></li>
								<li><a href="<?=base_url('minhasReservas')?>">Minhas reservas</a></li>
								<li><a href="<?=base_url('logout')?>">Sair</a></li>
	                        </ul>
	                    </div>

	                    <div id="Forms" class="tab-pane notika-tab-menu-bg animated flipInX">
	                        <ul class="notika-main-menu-dropdown">
														<li><a href="<?=base_url('emprestimo')?>">Realizar empréstimo</a></li>
														<li><a href="<?=base_url('reserva')?>">Realizar reserva</a></li>
														<li><a href="<?=base_url('alterarEmprestimos')?>">Alterar empréstimos</a></li>
														<li><a href="<?=base_url('alterarReserva')?>">Alterar Reservas</a></li>
	                        </ul>
	                    </div>

	                    <div id="Page" class="tab-pane notika-tab-menu-bg animated flipInX">
	                        <ul class="notika-main-menu-dropdown">
														<li><a href="<?=base_url('meuPerfil')?>">Meu perfil</a></li>
														<li><a href="<?=base_url('editarPerfil')?>">Editar perfil</a></li>
														<li><a href="<?=base_url('addCadastro')?>">Adicionar cadastro</a></li>
														<li><a href="#">Editar cadastro</a></li>
														<li><a href="<?=base_url('solicitaRemocao')?>">Requisições</a></li>
														<li><a href="<?=base_url('removerCadastro')?>">Remover cadastro</a></li>
														<li><a href="<?=base_url('cancelCadastro')?>">Cancelar cadastro</a></li>
	                        </ul>
	                    </div>

	                </div>
	            </div>
	        </div>
	    </div>
	</div>
