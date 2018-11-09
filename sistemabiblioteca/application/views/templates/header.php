<!doctype html>
<html class="no-js" lang=>

<head>
	<meta charset="utf-8">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<title>Sistema Bibliotecário</title>
	<meta name="description" content=>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- favicon
	============================================ -->
	<link rel="shortcut icon" type="image/x-icon" href="<?=base_url('static/img/logo_book.png')?>">
	<!-- Google Fonts
	============================================ -->
	<link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,700,900" rel="stylesheet">
	<!-- Bootstrap CSS
	============================================ -->
	<link rel="stylesheet" href="<?=base_url('static/css/bootstrap.min.css')?>">
	<!-- Bootstrap CSS
	============================================ -->
	<link rel="stylesheet" href="<?=base_url('static/css/font-awesome.min.css')?>">
	<!-- owl.carousel CSS
	============================================ -->
	<link rel="stylesheet" href="<?=base_url('static/css/owl.carousel.css')?>">
	<link rel="stylesheet" href="<?=base_url('static/css/owl.theme.css')?>">
	<link rel="stylesheet" href="<?=base_url('static/css/owl.transitions.css')?>">
	<!-- meanmenu CSS
	============================================ -->
	<link rel="stylesheet" href="<?=base_url('static/css/meanmenu/meanmenu.min.css')?>">
	<!-- animate CSS
	============================================ -->
	<link rel="stylesheet" href="<?=base_url('static/css/animate.css')?>">
	<!-- normalize CSS
	============================================ -->
	<link rel="stylesheet" href="<?=base_url('static/css/normalize.css')?>">
	<!-- mCustomScrollbar CSS
	============================================ -->
	<link rel="stylesheet" href="<?=base_url('static/css/scrollbar/jquery.mCustomScrollbar.min.css')?>">
	<!-- jvectormap CSS
	============================================ -->
	<link rel="stylesheet" href="<?=base_url('static/css/jvectormap/jquery-jvectormap-2.0.3.css')?>">
	<!-- notika icon CSS
	============================================ -->
	<link rel="stylesheet" href="<?=base_url('static/css/notika-custom-icon.css')?>">
	<!-- wave CSS
	============================================ -->
	<link rel="stylesheet" href="<?=base_url('static/css/wave/waves.min.css')?>">
	<!-- main CSS
	============================================ -->
	<link rel="stylesheet" href="<?=base_url('static/css/main.css')?>">
	<!-- style CSS
	============================================ -->
	<link rel="stylesheet" href="<?=base_url('static/style.css')?>">
	<!-- responsive CSS
	============================================ -->
	<link rel="stylesheet" href="<?=base_url('static/css/responsive.css')?>">

	<link rel="stylesheet" href="<?=base_url('static/css/adjust_styles.css')?>">
	<!-- modernizr JS
	============================================ -->
	<script src="<?=base_url('static/js/vendor/modernizr-2.8.3.min.js')?>"></script>


</head>

<body>
	<!-- NavBar primária -->
	<div class="header-top-area">
		<div class="container">
			<div class="row">
				<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
					<div class="logo-area">
						<a href="#"><img src="<?=base_url('static/img/logo/logo_bibli_2.png')?>" alt="" /></a>
					</div>
				</div>
				<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
					<div class="header-top-menu">
						<ul class="nav navbar-nav notika-top-nav">
							<li class="nav-item dropdown">
								<a href="#" data-toggle="dropdown" role="button" aria-expanded="false" class="nav-link dropdown-toggle"><span><i class="notika-icon notika-search" id="adjust_position_finder"></i></span></a>
								<div role="menu" class="dropdown-menu search-dd animated flipInX">
									<div class="search-input">
										<i class="notika-icon notika-left-arrow"></i>
										<input type="text" placeholder="Qual obra você procura ?"/>
									</div>
								</div>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
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
	                                    <li><a href="index.html">Biblioteca</a></li>
																			<li><a href="index.html">Consulta usuários</a></li>
																			<li><a href="index.html">Consulta reservas</a></li>
	                                    <li><a href="index-2.html">Minhas reservas</a></li>
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
														<li><a href="index.html">Biblioteca</a></li>
														<li><a href="index.html">Consulta usuários</a></li>
														<li><a href="index.html">Consulta reservas</a></li>
														<li><a href="index-2.html">Minhas reservas</a></li>
	                        </ul>
	                    </div>
	                    <div id="Forms" class="tab-pane notika-tab-menu-bg animated flipInX">
	                        <ul class="notika-main-menu-dropdown">
														<li><a href="form-elements.html">Realizar empréstimos</a></li>
														<li><a href="form-components.html">Alterar empréstimos</a></li>
														<li><a href="form-examples.html">Finalizar empréstimos</a></li>
	                        </ul>
	                    </div>
	                    <div id="Page" class="tab-pane notika-tab-menu-bg animated flipInX">
	                        <ul class="notika-main-menu-dropdown">
														<li><a href="contact.html">Meu perfil</a></li>
														<li><a href="invoice.html">Editar perfil</a></li>
														<li><a href="typography.html">Adicionar cadastro</a></li>
														<li><a href="color.html">Editar cadastro</a></li>
														<li><a href="login-register.html">Remover cadastro</a></li>
														<li><a href="404.html">Cancelar cadastro</a></li>
	                        </ul>
	                    </div>
	                </div>
	            </div>
	        </div>
	    </div>
	</div>
