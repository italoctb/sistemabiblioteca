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

<div class="data-table-area">
  <div class="container">
    <div class="row">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="data-table-list">
          <div class="table-responsive">
            <table id="" class="table table-striped">
              <thead>
                <tr>
                  <th><a class="fixing_bug" href="#data-table-basic">Usuário</a></th>
                  <th><a class="fixing_bug" href="#data-table-basic">Nome</a></th>
                  <th><a class="fixing_bug" href="#data-table-basic">Título</a></th>
                  <th><a class="fixing_bug" href="#data-table-basic">Data de reserva</a></th>
                </tr>
              </thead>
              <tbody>
                <?php

                  foreach ($title as $query) {?>
                    <tr>
                      <td><?php echo $query->username ?></td>
                      <td><?php echo $query->nome ?></td>
                      <td><?php echo $query->titulo ?></td>
                      <td><?php echo $query->data_reserva ?></td>
                    </tr>
                <?php  }?>

                </tbody>
                <tfoot>
                  <tr>
                    <th><a class="fixing_bug" href="#data-table-basic">Usuário</a></th>
                    <th><a class="fixing_bug" href="#data-table-basic">Nome</a></th>
                    <th><a class="fixing_bug" href="#data-table-basic">Título</a></th>
                    <th><a class="fixing_bug" href="#data-table-basic">Data de reserva</a></th>
                  </tr>
                </tfoot>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
