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
                  <th><a class="fixing_bug" href="#data-table-basic">Nome da obra</a></th>
                  <th><a class="fixing_bug" href="#data-table-basic">Autor</a></th>
                  <th><a class="fixing_bug" href="#data-table-basic">Ano de publicação</a></th>
                  <th><a class="fixing_bug" href="#data-table-basic">Editora</a></th>
                  <th><a class="fixing_bug" href="#data-table-basic">Categoria</a></th>
                  <th><a class="fixing_bug" href="#data-table-basic">Disponibilidade</a></th>
                </tr>
              </thead>
              <tbody>
                <?php

                  foreach ($title as $query) {?>
                    <tr>
                      <td><?php echo $query->ISBN ?></td>
                      <td><?php echo $query->titulo ?></td>
                      <td><?php echo $query->nome_autor ?></td>
                      <td><?php echo $query->ano_lançamento ?></td>
                      <td><?php echo $query->editora ?></td>
                      <td><?php echo $query->descricao ?></td>
                      <td><?php echo $query->qtd_disp.'/'.$query->qtd_copias?></td>
                    </tr>
                <?php  }?>

                </tbody>
                <tfoot>
                  <tr>
                    <th><a class="fixing_bug" href="#data-table-basic">ISBN</a></th>
                    <th><a class="fixing_bug" href="#data-table-basic">Nome da obra</a></th>
                    <th><a class="fixing_bug" href="#data-table-basic">Autor</a></th>
                    <th><a class="fixing_bug" href="#data-table-basic">Ano de publicação</a></th>
                    <th><a class="fixing_bug" href="#data-table-basic">Editora</a></th>
                    <th><a class="fixing_bug" href="#data-table-basic">Categoria</a></th>
                    <th><a class="fixing_bug" href="#data-table-basic">Disponibilidade</a></th>
                  </tr>
                </tfoot>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
