<?php
    $user_id = $this->session->userdata('nivel_usuario');
    $tipo= $this->session->userdata('tipoUsuario');
    if($user_id != 'usuario' && $user_id != 'bibliotecario' && $user_id != 'administrador'){redirect(base_url('sem_acesso'));}
?>

<div class="data-table-area">
  <div class="container">
<div class="container">

<span style="background-color:red;">
  <div class="container">
      <div class="row">
          <div class="col-md-4 col-md-offset-4">
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

    <?php
        $temp = 0;
        if ($tipoUsuario == 'tipoProf'):
            $temp = 30;
        elseif ($tipoUsuario == 'tipoFunc'):
            $temp == 21;
        elseif ($tipoUsuario == 'tipoAl'):
            $temp = 15;
        endif;
        $data = date('Y/m/d');
        $nData = strtotime($data."+ $temp days");
        $dev_data = date("Y/m/d",$nData);
    ?>

<div class="container">
    <form action="<?=base_url('envReserva')?>" method="post" class="form-signin">

        <h2 class="h3 mb-3 font-weight-normal">Reservar Livro</h2>

        <div class="row">
            <div class="form-group col-md-4">
                <input type="hidden" class="form-control" name="username" id="username" value="<?=$username?>" size="40" >
            </div>
            <div class="form-group col-md-4">
                <input type="hidden" class="form-control" name="ISBN" id="ISBN" value="<?=$ISBN?>" size="40" >
            </div>
        </div>

        <div class="row">
            <div class="form-group col-md-8">
                <input type="hidden" class="form-control" name="data_reserva" id="data_reserva" value="<?=$data?>" size="40" >
            </div>

            <div class="form-group col-md-8">
                <input type="hidden" class="form-control" name="prazo_dev" id="prazo_dev" value="<?=$dev_data?>" size="40" >
            </div>
        </div>

          <div class="container">
            <h4>Dados do empréstimo:</h4>
            <pre>
              Usuário: <?=$username?><br>
              Livro: <?=$titulo?><br>
              Data de empréstimo: <?=$data?><br>
              Data de devolução: <?=$dev_data?><br>
            </pre>
          </div>

        <div  class="form-group">
            <button type="submit" class="btn btn-success notika-btn-success" value="Reservar"/>Revervar</button>
            <a class="btn login100-form-btn btn-lg btn-secondary" href="<?= base_url('consulta') ?>"> <-Voltar</a>
        </div>


    </form>

          
</div>
</div>
    </div>
  </div>
