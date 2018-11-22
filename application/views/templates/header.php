<!doctype html>
<html class="no-js" lang=pt-br>

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

	<link rel="stylesheet" href="<?=base_url('static/css/bootstrap-select/bootstrap-select.css')?>">

	<link rel="stylesheet" type="text/css" href="<?=base_url('static/css/dashboard.css')?>">

	<link rel="stylesheet" type="text/css" href="<?=base_url('static/css/perso.css')?>">
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
					<a href="<?php base_url('/')?>"><img src="<?=base_url('static/img/logo/logo_bibli_2.png')?>" alt="" /></a>
				</div>
			</div>
			<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
				<div class="header-top-menu">
					<ul class="nav navbar-nav notika-top-nav">
						<li class="nav-item dropdown">
							<a href="#" data-toggle="dropdown" role="button" aria-expanded="false" class="nav-link dropdown-toggle"><span><i class="notika-icon notika-search" id="adjust_position_finder"></i></span></a>
							<div role="menu" class="dropdown-menu search-dd animated flipInX">
								<div class="search-input">
									<form action="<?=base_url('tratarConsultaHome')?>" method="POST">
										<div class="row">
											<div class="col-md-1">
												<button class="btn btn-info info-icon-notika buttonPesq" type="submit"><i class="notika-icon notika-search"></i></button>
											</div>
											<div class="col-md-11">
												<input type="text" name="caixaHome" id="caixaHome" placeholder="Encontre aqui a obra por nome ou por autor(a)">
											</div>
										</div>
									</form>
								</div>
							</li>
							<?php $c = $this->db->query('select count(*) as num from requisicao;')->row_object()->num;
										$consultaReq = $this->db->query('select id_req, username, nome from REQUISICAO natural join USUARIO order by id_req;')->result();?>
							<li class="nav-item nc-al"><a href="#" data-toggle="dropdown" role="button" aria-expanded="false" class="nav-link dropdown-toggle" onclick="$('#swtNot').fadeOut();"><span><i class="notika-icon notika-alarm" style="position: absolute; margin-top: 5px;"></i></span>
								<?php if ($c != 0): ?>
									<div id="swtNot"><div class="spinner4 spinner-4" style="left:36px; top:-35px;"></div><div class="ntd-ctn" style="left:42px;top:-29px;"><span style="color: white;"><?php echo $c; ?></span></div></a></div>
								<?php endif; ?>

									<div role="menu" class="dropdown-menu message-dd notification-dd animated zoomIn">
											<div class="hd-mg-tt">
													<h2>Requisições de cancelamento</h2>
											</div>
											<div class="hd-message-info">
												<?php foreach ($consultaReq as $req): ?>
													<a href="<?=base_url('solicitaRemocao/'.$req->id_req)?>">
															<div class="hd-message-sn">
																	<div class="hd-message-img">
																			<img src="img/post/1.jpg" alt="" />
																	</div>
																	<div class="hd-mg-ctn">
																			<h3><?php echo $req->nome;?></h3>
																			<p>Deseja desligar-se do sistema</p>
																			<p style="font-size: 14px; color: #A9A9A9; font-weight: bold;"; >id = #<?php echo $req->id_req; ?></p>
																	</div>
															</div>
													</a>
												<?php endforeach; ?>
											</div>
											<div class="hd-mg-va">
													<a href="#">Ok</a>
											</div>
									</div>
							</li>

						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
