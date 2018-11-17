
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

<div class="container ic-cmp-int float-lb form-elet-mg">
  <div class="data-table-area">
    <div class="container">

      <form action="<?=base_url('updateEmprestimo')?>" method="post" class="form-signin">

        <h2 class="h3 mb-3 font-weight-normal">Editar Reserva</h2>

        <div class="row">

          <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
              <div class="form-group ic-cmp-int">
                <div class="form-ic-cmp">
                  <i class="notika-icon notika-support"></i>
                </div>
                <div class="nk-int-st">
                  <label for="nome">Usuário:</label>
                  <input type="text" name="nome" class="form-control" placeholder="Nome" value="<?=$nome?>" disabled>
                </div>
              </div>
            </div>

                  <input type="hidden" name="username" class="form-control" placeholder="Usuário" value="<?=$username?>" required>

                  <input type="hidden" name="isbn" class="form-control" placeholder="ISBN" value="<?=$isbn?>" required>
                  
        <div class="row">

          <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
              <div class="form-group ic-cmp-int">
                <div class="form-ic-cmp">
                  <i class="notika-icon notika-support"></i>
                </div>
                <div class="nk-int-st">
                  <label for="titulo">Livro:</label>
                  <input type="text" name="titulo" class="form-control" placeholder="Usuário" value="<?=$titulo?>" disabled>
                </div>
              </div>
            </div>
                  
            

            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
              <div class="form-group ic-cmp-int">
                <div class="form-ic-cmp">
                  <i class="notika-icon notika-map"></i>
                </div>
                <div class="nk-int-st">
                  <label for="data_reserva">Data de Reverva:</label>
                  <input type="text" name="data_reserva" class="form-control" placeholder="Data de Reserva" value="<?=$emprestimo?>" required>
                </div>
              </div>
            </div>

            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
              <div class="form-group ic-cmp-int">
                <div class="form-ic-cmp">
                  <i class="notika-icon notika-map"></i>
                </div>
                <div class="nk-int-st">
                  <label for="prazo_dev">Data de Devolução:</label>
                  <input type="text" name="prazo_dev" class="form-control" placeholder="Data de Devolução" value="<?=$dev?>" required>
                </div>
              </div>
            </div>

        </div>

        <div  class="form-group">
            <button type="submit" class="btn btn-success notika-btn-success" value="Cadastrar">Atualizar</button>
            <a class="btn btn-primary notika-btn-primary" href="<?= base_url('baixaReserva/'.$username) ?>">Voltar</a>
        </div>

    </form>
      
    </div>
  </div>
</div>
