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

<?php $nivel = $this->session->userdata('nivel_usuario');
if ($nivel === 'administrador'):
  $navi = 'admin';
elseif ($nivel === 'usuario'):
  $navi = 'user';
elseif ($nivel === 'bibliotecario'):
  $navi = 'blib';
endif; ?>

<div class="data-table-area">
  <div class="container">
    <div class="row">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="data-table-list">
          <div class="table-responsive">
            <div class="searc-input">
              <form action="<?=base_url("$navi/tratarConsultaEmp")?>" method="POST">
              <input type="text" class="caixaPclass" name="caixaE" id="caixaE" placeholder="pesquisar"/>
              <button class="btn btn-info info-icon-notika buttonPesq" type="submit"><i class="notika-icon notika-search"></i></button>
              </form>
            </div>
            <table id="" class="table table-striped">
              <thead>
                <tr>
                  <th><a class="fixing_bug" href="#data-table-basic">Usuário</a></th>
                  <th><a class="fixing_bug" href="#data-table-basic">Nome</a></th>
                  <th><a class="fixing_bug" href="#data-table-basic">Título</a></th>
                  <th><a class="fixing_bug" href="#data-table-basic">Data de empréstimo</a></th>
                  <th><a class="fixing_bug" href="#data-table-basic">Data de devolução</a></th>
                </tr>
              </thead>
              <tbody>
                <?php

                   /* Tabela exibindo os empréstimos realizados, as informações nome de usuário, nome, título, data _reserva, data do empréstimo e data de devolução são exibidas*/

                  foreach ($title as $query) {?>
                    <tr>
                      <td><?php echo $query->username ?></td>
                      <td><?php echo $query->nome ?></td>
                      <td><?php echo $query->titulo ?></td>
                      <td><?php echo $query->data_reserva ?></td>
                      <td><?php echo $query->prazo_dev ?></td>
                    </tr>
                <?php  }?>

                </tbody>
                <tfoot>
                  <tr>
                    <th><a class="fixing_bug" href="#data-table-basic">Usuário</a></th>
                    <th><a class="fixing_bug" href="#data-table-basic">Nome</a></th>
                    <th><a class="fixing_bug" href="#data-table-basic">Título</a></th>
                    <th><a class="fixing_bug" href="#data-table-basic">Data de empréstimo</a></th>
                    <th><a class="fixing_bug" href="#data-table-basic">Data de devolução</a></th>
                  </tr>
                </tfoot>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
