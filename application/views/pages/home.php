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
            <div class="searc-input">
              <form action="<?=base_url('tratarConsultaHome')?>" method="POST">
              <input type="text" class="caixaPclass" name="caixaHome" id="caixaHome" placeholder="pesquisar"/>
              <button class="btn btn-info info-icon-notika buttonPesq" type="submit"><i class="notika-icon notika-search"></i></button>
              </form>
            </div>
            <table id="" class="table table-striped">
              <thead>

                <tr>
                  <th><a class="btn btn-success notika-btn-success waves-effect" href="<?=base_url('ordenaISBN')?>">ISBN</a></th>
                  <th><a class="btn btn-success notika-btn-success waves-effect" href="<?=base_url('ordenaNomeObra')?>">Nome da obra</a></th>
                  <th><a class="btn btn-success notika-btn-success waves-effect" href="<?=base_url('ordenaNomeAutor')?>">Autor</a></th>
                  <th><a class="btn btn-success notika-btn-success waves-effect" href="<?=base_url('ordenaAno')?>">Ano de publicação</a></th>
                  <th><a class="btn btn-success notika-btn-success waves-effect" href="<?=base_url('ordenaEdit')?>">Editora</a></th>
                  <th><a class="btn btn-success notika-btn-success waves-effect" href="<?=base_url('ordenaCategoria')?>">Categoria</a></th>
                  <th><a class="btn btn-success notika-btn-success waves-effect" href="<?=base_url('ordenaDisp')?>">Disponibilidade</a></th>
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
                      <td><a id="a-edit" href="<?=base_url('livros/'.$query->ISBN)?>"><?=$query->ISBN?></a></td>
                      <td><a id="a-edit" href="<?=base_url('livros/'.$query->ISBN)?>"><?=$query->titulo?></a></td>

                      <td>
                        <?php
                          foreach ($title->cpf as $cpf_query){
                            if ($query->ISBN == $cpf_query->ISBN){
                              $aux++;
                              foreach ($title->autor as $autor_query) {
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
                      <td><a id="a-edit" href="<?=base_url('editora/'.$query->editora)?>"><?=$query->editora?></a></td>
                      <td><a id="a-edit" href="<?=base_url('categoria/'.$query->cod_categoria)?>"><?=$query->descricao?></a></td>
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
