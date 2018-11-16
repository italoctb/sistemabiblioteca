<span style="background-color:red;">
  <div class="container">
      <div class="row">
          <div class="col-md-4 col-md-offset-4">
                  <div class="alert alert-warning-body">
                      <?php
                        $success_msg  = $this->session->flashdata('success_msg');
                        $error_msg    = $this->session->flashdata('error_msg');
                        $other_msg    = $this->session->flashdata('other_msg');

                        if($success_msg){
                            ?>
                              <div class="alert alert-success" role="alert">
                                <?php echo $success_msg; ?>
                              </div>
                            <?php
                        }
                        if($error_msg){
                            ?>
                              <div class="alert alert-danger" role="alert">
                                  <?php echo $error_msg; ?>
                              </div>
                            <?php
                        }

                        if($other_msg){
                            ?>
                              <div class="alert alert-info" role="alert">
                                <?php echo $other_msg; ?>
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
                  <th><a class="fixing_bug" href="#data-table-basic">tipoUsuario</a></th>
                  <th><a class="fixing_bug" href="#data-table-basic">Endereço</a></th>
                </tr>
              </thead>
              <tbody>
                <?php

                  foreach ($title as $query) {
                    if ($query->username != 'admin'){
                    ?>

                    <tr>
                      <td><?php echo $query->username ?></td>
                      <td><?php echo $query->nome ?></td>
                      <td><?php echo $query->tipoUsuario ?></td>
                      <td><?php echo $query->user_end ?></td>

                      <td>
                            <a class="btn bt-form btn-block" href="<?=base_url('editarUsuario/'.$query->username)?>";>Editar</a>
                        </td>
                        <td>
                            <a class="btn btn-danger bt-form btn-block" href="<?=base_url('deletarUsuario/'.$query->username)?>" onclick="return confirm('Tem certeza que deseja deletar o usuário?');">Deletar</a>
                        </td>

                    </tr>
                <?php  }}?>

                </tbody>
                <tfoot>
                  <tr>
                    <th><a class="fixing_bug" href="#data-table-basic">Usuário</a></th>
                    <th><a class="fixing_bug" href="#data-table-basic">Nome</a></th>
                    <th><a class="fixing_bug" href="#data-table-basic">tipoUsuario</a></th>
                    <th><a class="fixing_bug" href="#data-table-basic">Endereço</a></th>
                  </tr>
                </tfoot>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>