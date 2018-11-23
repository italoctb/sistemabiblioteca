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
            <div class="searc-input">
              <form action="<?=base_url('tratarConsultaUsuario')?>" method="POST">
              <input type="text" name="caixap1" class="caixaPclass" id="caixap1" placeholder="Pesquisar"/>
              <button class="btn btn-info info-icon-notika buttonPesq" type="submit"><i class="notika-icon notika-search"></i></button>
            </form>
          </div>
            <table id="" class="table table-striped">
              <thead>


                <tr>
                  <th><a class="fixing_bug" href="#data-table-basic">Usuário</a></th>
                  <th><a class="fixing_bug" href="#data-table-basic">Nome</a></th>
                  <th><a class="fixing_bug" href="#data-table-basic">Tipo de Usuario</a></th>
                  <th><a class="fixing_bug" href="#data-table-basic">Matrícula</a></th>
                </tr>
              </thead>
              <tbody>
                <?php

                  foreach ($title as $query) {?>

                    <tr>
                      <td><?php echo $query->username ?></td>
                      <td><?php echo $query->nome ?></td>
                      <?php if ($query->tipoUsuario == 'tipoAl'): ?>
                        <td>Aluno</td>
                        <td><?php echo $query->mat_aluno ?></td>
                      <?php endif; ?>
                      <?php if ($query->tipoUsuario == 'tipoFunc'): ?>
                        <td>Funcionário</td>
                        <td><?php echo $query->mat_func ?></td>
                      <?php endif; ?>
                      <?php if ($query->tipoUsuario == 'tipoProf'): ?>
                        <td>Professor</td>
                        <td><?php echo "(SIAPE) $query->mat_siape" ?></td>
                      <?php endif; ?>

						<td>
							<a class="btn btn-primary notika-btn-primary" style="position: relative; bottom:8px;" href="<?=base_url('editarUsuario/'.$query->username)?>";>Editar</a>
						</td>

                    </tr>
                <?php  }?>

                </tbody>
                <tfoot>
                  <tr>
                    <th><a class="fixing_bug" href="#data-table-basic">Usuário</a></th>
                    <th><a class="fixing_bug" href="#data-table-basic">Nome</a></th>
                    <th><a class="fixing_bug" href="#data-table-basic">Tipo de Usuario</a></th>
                    <th><a class="fixing_bug" href="#data-table-basic">Matrícula</a></th>
                  </tr>
                </tfoot>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
