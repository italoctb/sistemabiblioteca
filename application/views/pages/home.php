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
