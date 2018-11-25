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

	<link rel="stylesheet" type="text/css" href="<?=base_url('static/css/dashboard.css')?>">
	<!-- modernizr JS
	============================================ -->
	<script src="<?=base_url('static/js/vendor/modernizr-2.8.3.min.js')?>"></script>


</head>

<body>
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

    <div class="login-content">
        <div class="nk-block toggled">
            <form class="login100-form validate-form" action="<?=base_url('addUsuario')?>" method="post">
                <div class="nk-form">
                    <?php
                        $nivel = array(
                            'usuario'         => 'Usuário',
                        );

                        $tipo = array(
                            'tipoFunc' => 'Funcionário',
                            'tipoProf' => 'Professor',
                            'tipoAl'   => 'Aluno',
                        );
                    ?>

                    <div class="input-group">
                        <span class="input-group-addon nk-ic-st-pro"><i class="notika-icon notika-support"></i></span>
                        <div class="nk-int-st">
                            <input type="text" name="nome" class="form-control" placeholder="Nome" required>
                        </div>
                    </div>


                    <div class="input-group mg-t-15">
                        <span class="input-group-addon nk-ic-st-pro"><i class="notika-icon notika-support"></i></span>
                        <div class="nk-int-st">
                            <input type="text" name="username" class="form-control" placeholder="Usuário" required>
                        </div>
                    </div>

                    <div class="input-group mg-t-15">
                        <span class="input-group-addon nk-ic-st-pro"><i class="notika-icon notika-tax"></i></span>
                        <div class="nk-int-st">
                            <input type="password" name="password" class="form-control" placeholder="Password" required>
                        </div>
                    </div>

                    <div class="input-group mg-t-15">
                        <span class="input-group-addon nk-ic-st-pro"><i class="notika-icon notika-map"></i></span>
                        <div class="nk-int-st">
                            <input type="text" name="user_end" class="form-control" placeholder="Endereço" required>
                        </div>
                    </div>

                    <div class="input-group mg-t-15">
                        <div class="nk-int-st">
                            <div class="row">
                                <div class="form-group col-md-6" style="display:none;">
                                    <?=form_dropdown('nivel_usuario', $nivel, '',array('class' => "selectpicker"));?>
                                </div>
                                <div class="form-group col-md-12">
									<select name="tipoUsuario" class="selectpicker" id="tipo_drop_add2">
										<option disabled="disabled" selected>Escolha o tipo de usuário</option>
										<option value="tipoProf">Professor</option>
										<option value="tipoFunc">Funcionário</option>
										<option value="tipoAl">Aluno</option>
									</select>
                                </div>
                            </div>
                        </div>
						<div id="dinamic-div-form" style="display: none;"></div>
                    </div>

                    <button type="submit" class="btn btn-login btn-success btn-float" value="Cadastrar"><i class="notika-icon notika-right-arrow right-arrow-ant"></i></button>
                </div>

                <div class="nk-navigation nk-lg-ic">
                    <a href="<?=base_url('')?>" data-ma-block="#l-register"><i class="notika-icon notika-left-arrow"></i><span style="margin-left: 5px;">Voltar</span></a>
                </div>
            </form>
        </div>
    </div>

    <script src="<?=base_url('static/js/vendor/jquery-1.12.4.min.js')?>"></script>
    <script src="<?=base_url('static/js/bootstrap.min.js')?>"></script>
    <!-- wow JS
    ============================================ -->
    <script src="<?=base_url('static/js/wow.min.js')?>"></script>
    <!-- price-slider JS
    ============================================ -->
    <script src="<?=base_url('static/js/jquery-price-slider.js')?>"></script>
    <!-- owl.carousel JS
    ============================================ -->
    <script src="<?=base_url('static/js/owl.carousel.min.js')?>"></script>
    <!-- scrollUp JS
    ============================================ -->
    <script src="<?=base_url('static/js/jquery.scrollUp.min.js')?>"></script>
    <!-- meanmenu JS
    ============================================ -->
    <script src="<?=base_url('static/js/meanmenu/jquery.meanmenu.js')?>"></script>
    <!-- counterup JS
    ============================================ -->
    <script src="<?=base_url('static/js/counterup/jquery.counterup.min.js')?>"></script>
    <script src="<?=base_url('static/js/counterup/waypoints.min.js')?>"></script>
    <script src="<?=base_url('static/js/counterup/counterup-active.js')?>"></script>
    <!-- mCustomScrollbar JS
    ============================================ -->
    <script src="<?=base_url('static/js/scrollbar/jquery.mCustomScrollbar.concat.min.js')?>"></script>
    <!-- jvectormap JS
    ============================================ -->
    <script src="<?=base_url('static/js/jvectormap/jquery-jvectormap-2.0.2.min.js')?>"></script>
    <script src="<?=base_url('static/js/jvectormap/jquery-jvectormap-world-mill-en.js')?>"></script>
    <script src="<?=base_url('static/js/jvectormap/jvectormap-active.js')?>"></script>
    <!-- sparkline JS
    ============================================ -->
    <script src="<?=base_url('static/js/sparkline/jquery.sparkline.min.js')?>"></script>
    <script src="<?=base_url('static/js/sparkline/sparkline-active.js')?>"></script>
    <!-- sparkline JS
    ============================================ -->
    <script src="<?=base_url('static/js/flot/jquery.flot.js')?>"></script>
    <script src="<?=base_url('static/js/flot/jquery.flot.resize.js"')?>"></script>
    <script src="<?=base_url('static/js/flot/curvedLines.js')?>"></script>
    <script src="<?=base_url('static/js/flot/flot-active.js')?>"></script>
    <!-- knob JS
    ============================================ -->
    <script src="<?=base_url('static/js/knob/jquery.knob.js')?>"></script>
    <script src="<?=base_url('static/js/knob/jquery.appear.js')?>"></script>
    <script src="<?=base_url('static/js/knob/knob-active.js')?>"></script>
    <!--  wave JS
    ============================================ -->
    <script src="<?=base_url('static/js/wave/waves.min.js')?>"></script>
    <script src="<?=base_url('static/js/wave/wave-active.js')?>"></script>
    <!--  todo JS
    ============================================ -->
    <script src="<?=base_url('static/js/todo/jquery.todo.js')?>"></script>
    <!-- plugins JS
    ============================================ -->
    <script src="<?=base_url('static/js/plugins.js')?>"></script>
    <!--  Chat JS
    ============================================ -->
    <script src="<?=base_url('static/js/chat/moment.min.js')?>"></script>
    <script src="<?=base_url('static/js/chat/jquery.chat.js')?>"></script>
    <!-- Data Table JS
    ============================================ -->
    <script src="<?=base_url('static/js/data-table/jquery.dataTables.min.js')?>"></script>
    <script src="<?=base_url('static/js/data-table/data-table-act.js')?>"></script>

    <!-- main JS
    ============================================ -->
    <script src="<?=base_url('static/js/main.js')?>"></script>
<script src="<?=base_url('static/js/perso.js')?>"></script>

</body>

</html>
