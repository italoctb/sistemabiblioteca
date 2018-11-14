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
																		<li><a href="home">Biblioteca</a></li>
																		<li><a href="professores">Professores</a></li>
																		<li><a href="consultaUsuario">Consulta usuários</a></li>
																		<li><a href="consultaReserva">Consulta reservas</a></li>
																		<li><a href="minhasReservas">Minhas reservas</a></li>
																		<li><a href="<?php echo base_url('user_logout')?>">Sair</a></li>
	                                </ul>
	                            </li>
															<li><a data-toggle="collapse" data-target="#Charts" href="#">Sistema</a>
																<ul class="notika-main-menu-dropdown">
																	<li><a href="form-elements.html">Realizar empréstimos</a></li>
																	<li><a href="form-components.html">Alterar empréstimos</a></li>
																	<li><a href="form-examples.html">Finalizar empréstimos</a></li>
																</ul>
	                            </li>
	                            <li><a data-toggle="collapse" data-target="#Pagemob" href="#">Usuário</a>
	                                <ul id="Pagemob" class="collapse dropdown-header-top">
																		<li><a href="contact.html">Meu perfil</a></li>
																		<li><a href="invoice.html">Editar perfil</a></li>
																		<li><a href="typography.html">Adicionar cadastro</a></li>
																		<li><a href="color.html">Editar cadastro</a></li>
																		<li><a href="login-register.html">Remover cadastro</a></li>
																		<li><a href="404.html">Cancelar cadastro</a></li>
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
														<li><a href="home">Biblioteca</a></li>
														<li><a href="professores">Professores</a></li>
														<li><a href="consultaUsuario">Consulta usuários</a></li>
														<li><a href="consultaReserva">Consulta reservas</a></li>
														<li><a href="minhasReservas">Minhas reservas</a></li>
														<li><a href="<?php echo base_url('admin_logout')?>">Sair</a></li>
	                        </ul>
	                    </div>
	                    <div id="Forms" class="tab-pane notika-tab-menu-bg animated flipInX">
	                        <ul class="notika-main-menu-dropdown">
														<li><a href="realizarEmprestimo">Realizar empréstimos</a></li>
														<li><a href="alterarEmprestimo">Alterar empréstimos</a></li>
														<li><a href="finalizarEmprestimo">Finalizar empréstimos</a></li>
	                        </ul>
	                    </div>
	                    <div id="Page" class="tab-pane notika-tab-menu-bg animated flipInX">
	                        <ul class="notika-main-menu-dropdown">
														<li><a href="meuPerfil">Meu perfil</a></li>
														<li><a href="editarPerfil">Editar perfil</a></li>
														<li><a href="addCadastro">Adicionar cadastro</a></li>
														<li><a href="editCadastro">Editar cadastro</a></li>
														<li><a href="removCadastro">Remover cadastro</a></li>
														<li><a href="cancelCadastro">Cancelar cadastro</a></li>
	                        </ul>
	                    </div>
	                </div>
	            </div>
	        </div>
	    </div>
	</div>