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
                  <th><a class="fixing_bug" href="#data-table-basic">Número da Solicitação</a></th>
                  <th><a class="fixing_bug" href="#data-table-basic">Usuário</a></th>
                </tr>
              </thead>
              <tbody>
                <?php

                  foreach ($solicitacao as $sol) {?>
                    <tr>
                      <td><?php echo $sol->id_req ?></td>
                      <td><?php echo $sol->username ?></td>
                      <td>
                        <a 
                          class="btn btn-danger notika-btn-danger"
                          style="position: relative; bottom:4px;" 
                          onclick="return confirm('Deseja confirmar a solicitação de remoção do usuário?')"           href="<?=base_url('confirmaSolicitacao/'.$sol->username)?>";>
                          Confirmar solicitação
                        </a>
                      </td>
                    </tr>
                <?php  }?>

                </tbody>
               
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
