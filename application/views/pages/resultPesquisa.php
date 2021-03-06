<span style="background-color:red;">
  <div class="container">
      <div class="row">
          <div class="col-md-4 col-md-offset-4">
                  <div class="alert alert-warning-body">
                      <?php
                        $success_msg= $this->session->flashdata('success_msg');
                        $error_msg= $this->session->flashdata('error_msg');
                        $other_msg= $this->session->flashdata('other_msg');

                        if($success_msg){
                            ?>
                              <div class="alert alert-success" role="alert">
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
            <table id="tabela_livros" class="table table-striped">
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
                   $isbnTemp = 0;
                   $autorTemp = 0;
                   $cont = 0;
                    foreach ($title as $query) {
                      if ($isbnTemp!=$query->ISBN){
                        $aux = 0;
                ?>
                    <tr>
                      <td><?=$query->ISBN?></td>
                      <td><?=$query->titulo?></td>

                      <td>
                        <?php
                          foreach ($cpf as $cpf_query){
                            if ($query->ISBN == $cpf_query->ISBN){
                              $aux++;
                              foreach ($autor as $autor_query) {
                                if ($cpf_query->cpf == $autor_query->cpf){
                                  if ($aux>=2){
                                    echo " / ";
                                  }
                                  echo $autor_query->nome_autor;
                                }
                              }
                            }
                          }
                        ?>
                      </td>

                      <td><?=$query->ano_lançamento?></td>
                      <td><?=$query->editora?></td>
                      <td><?=$query->descricao?></td>
                      <td><?=$query->qtd_disp.'/'.$query->qtd_copias?></td>
                    </tr>
                <?php
                  $isbnTemp=$query->ISBN;
                  $autorTemp=$query->nome_autor;
                 }}
                ?>

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

<script
  src="https://code.jquery.com/jquery-3.0.0.slim.min.js"
  integrity="sha256-Rf4BadfyCtsvHmO89BUZcbYvNNvZvOT08ALfEzvCsD0="
  crossorigin="anonymous">
</script>
