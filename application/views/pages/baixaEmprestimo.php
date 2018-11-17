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


<div class="data-table-area">
  <div class="container">
    <div class="row">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="data-table-list">
          <div class="table-responsive">
            <table id="" class="table table-striped">
              <thead>
                <tr>
                  <th><a class="fixing_bug" href="#data-table-basic">ISBN</a></th>
                  <th><a class="fixing_bug" href="#data-table-basic">Usuário</a></th>
                  <th><a class="fixing_bug" href="#data-table-basic">Data de reserva</a></th>
                  <th><a class="fixing_bug" href="#data-table-basic">Data de devolução</a></th>
                </tr>
              </thead>
              <tbody>
                <?php
                  foreach (emprestimo as $res):
                  if ($res->username == $username):
                    echo $username;
                ?>
                    <tr>
                        <td><?=$res->ISBN?></td>
                        <td><?=$res->username?></td>
                        <td><?=$res->data_reserva?></td>
                        <td><?=$res->prazo_dev?></td>

                        <td>
                          <a class="btn btn-primary notika-btn-primary" href="<?=base_url('editarEmprestimo/'.$res->ISBN.'/'.$res->username)?>";>Editar</a>
                        </td>

                        <td>
                            <a class="btn btn-success notika-btn-success" href="<?=base_url('devEmprestimo/'.$res->ISBN.'/'.$res->username)?>" onclick="return confirm('Deseja realmente dar baixa no registro?');">Encerrar</a>
                        </td>
                    </tr>
                <?php
                  endif;
                  endforeach;
                ?>

                </tbody>
                <tfoot>
                  <tr>
                    <th><a class="fixing_bug" href="#data-table-basic">ISBN</a></th>
                  <th><a class="fixing_bug" href="#data-table-basic">Usuário</a></th>
                  <th><a class="fixing_bug" href="#data-table-basic">Data de reserva</a></th>
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
