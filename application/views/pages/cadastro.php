<!DOCTYPE html>
<html lang="en">
<head>
  <title>Sistema Bibliotecário - Cadastro</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="icon" type="image/png" href="<?=base_url('static/images/icons/favicon.ico')?>"/>
  <link rel="stylesheet" type="text/css" href="<?=base_url('static/vendor/bootstrap/css/bootstrap.min.css')?>">
  <link rel="stylesheet" type="text/css" href="<?=base_url('static/fonts/font-awesome-4.7.0/css/font-awesome.min.css')?>">
  <link rel="stylesheet" type="text/css" href="<?=base_url('static/fonts/Linearicons-Free-v1.0.0/icon-font.min.css')?>">
  <link rel="stylesheet" type="text/css" href="<?=base_url('static/vendor/animate/animate.css')?>">
  <link rel="stylesheet" type="text/css" href="<?=base_url('static/vendor/css-hamburgers/hamburgers.min.css')?>">
  <link rel="stylesheet" type="text/css" href="<?=base_url('static/vendor/animsition/css/animsition.min.css')?>">
  <link rel="stylesheet" type="text/css" href="<?=base_url('static/vendor/select2/select2.min.css')?>">
  <link rel="stylesheet" type="text/css" href="<?=base_url('static/vendor/daterangepicker/daterangepicker.css')?>">
  <link rel="stylesheet" type="text/css" href="<?=base_url('static/css/util_f.css')?>">
  <link rel="stylesheet" type="text/css" href="<?=base_url('static/css/main_f.css')?>">
  <link rel="stylesheet" type="text/css" href="<?=base_url('static/css/bootstrap.min.css')?>">
  <link rel="stylesheet" type="text/css" href="<?=base_url('static/css/dashboard.css')?>">
</head>


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


<body>
  <div class="limiter">
    <div class="container-login100">
      <div class="wrap-login100 p-l-85 p-r-85 p-t-55 p-b-55">
        <form class="login100-form validate-form" action="<?=base_url('addUsuario')?>" method="post">
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

        <h2 class="h3 mb-3 font-weight-normal">Registrar Usuário</h2>

        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
              <div class="form-group ic-cmp-int">
                <div class="form-ic-cmp">
                  <i class="notika-icon notika-support"></i>
                </div>
                <div class="nk-int-st">
                  <input type="text" name="nome" class="form-control" placeholder="Nome" required>
                </div>
              </div>
            </div>

            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
              <div class="form-group ic-cmp-int">
                <div class="form-ic-cmp">
                  <i class="notika-icon notika-edit"></i>
                </div>
                <div class="nk-int-st">
                  <input type="text" name="matricula" class="form-control" placeholder="Matrícula" required>
                </div>
              </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
              <div class="form-group ic-cmp-int">
                <div class="form-ic-cmp">
                  <i class="notika-icon notika-support"></i>
                </div>
                <div class="nk-int-st">
                  <input type="text" name="username" class="form-control" placeholder="Usuário" required>
                </div>
              </div>
            </div>

            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
              <div class="form-group ic-cmp-int">
                <div class="form-ic-cmp">
                  <i class="notika-icon notika-tax"></i>
                </div>
                <div class="nk-int-st">
                  <input type="password" name="password" class="form-control" placeholder="Senha" required>
                </div>
              </div>
            </div>

            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
              <div class="form-group ic-cmp-int">
                <div class="form-ic-cmp">
                  <i class="notika-icon notika-map"></i>
                </div>
                <div class="nk-int-st">
                  <input type="text" name="user_end" class="form-control" placeholder="Endereço" required>
                </div>
              </div>
            </div>
        </div>

        <div class="row">
            <div class="form-group col-md-6">
                <label for="usuario">Nível</label><br>
                <?=form_dropdown('nivel_usuario', $nivel, '',array('class' => "selectpicker"));?>
            </div>
            <div class="form-group col-md-6">
                <label for="usuario">Tipo de Usuário</label><br>
                <?=form_dropdown('tipoUsuario', $tipo, '',array('class' => "selectpicker"));?>
            </div>
        </div>

        <div class="row" style="margin-top: 50px;"></div>

        <div class="row">
  
            <div class="col-4">
              <button type="submit" class="btn btn-success notika-btn-success" value="Cadastrar">Enviar</button>
            </div>
            <div class="col-4">
              <button id="limpar" type="reset" class="btn btn-info notika-btn-info" name="Limpar" value="Limpar">Limpar</button>
            </div>
            <div class="col-4">
              <a id="voltar" type="" class="btn btn-danger notika-btn-danger" name="Limpar" value="Limpar" href="<?=base_url('')?>"><--Voltar</a>
            </div>
        </div>
        </form>
      </div>
    </div>
  </div>


  <div id="dropDownSelect1"></div>
  
  <script src="<?=base_url('static/vendor/jquery/jquery-3.2.1.min.js')?>"></script>-->
  <script src="<?=base_url('static/vendor/animsition/js/animsition.min.js')?>"></script>
  <script src="<?=base_url('static/vendor/bootstrap/js/popper.js')?>"></script>
  <script src="<?=base_url('static/vendor/bootstrap/js/bootstrap.min.js')?>"></script>
  <script src="<?=base_url('static/vendor/select2/select2.min.js')?>"></script>
  <script src="<?=base_url('static/vendor/daterangepicker/moment.min.js')?>"></script>
  <script src="<?=base_url('static/vendor/daterangepicker/daterangepicker.js')?>"></script>
  <script src="<?=base_url('static/vendor/countdowntime/countdowntime.js')?>"></script>
  <script src="<?=base_url('static/js/main_f.js')?>"></script>

</body>
</html>