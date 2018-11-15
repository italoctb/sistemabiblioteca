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
                  <th><a class="fixing_bug" href="#data-table-basic">Ano de publicação</a></th>
                  <th><a class="fixing_bug" href="#data-table-basic">Editora</a></th>
                  <th><a class="fixing_bug" href="#data-table-basic">Disponibilidade</a></th>
                  <th><a class="fixing_bug" href="#data-table-basic">Realizar reserva</a></th>
                </tr>
              </thead>
              <tbody>
                <?php

                  foreach ($livros as $liv) {?>
                    <tr>
                      <td><?php echo $liv->ISBN ?></td>
                      <td><?php echo $liv->titulo ?></td>
                      <td><?php echo $liv->ano_lançamento ?></td>
                      <td><?php echo $liv->editora ?></td>
                      <td><?php echo $liv->qtd_disp.'/'.$liv->qtd_copias?></td>
                      <td>
                        <a class="btn bt-form btn-block" href="<?=base_url('reservaLivro/'.$liv->ISBN)?>";>Reservar</a>
                        </td>
                    </tr>
                <?php  }?>

                </tbody>
                <tfoot>
                  <tr>
                    <th><a class="fixing_bug" href="#data-table-basic">ISBN</a></th>
                    <th><a class="fixing_bug" href="#data-table-basic">Nome da obra</a></th>
                    <th><a class="fixing_bug" href="#data-table-basic">Ano de publicação</a></th>
                    <th><a class="fixing_bug" href="#data-table-basic">Editora</a></th>
                    <th><a class="fixing_bug" href="#data-table-basic">Disponibilidade</a></th>
                    <th><a class="fixing_bug" href="#data-table-basic">Realizar reserva</a></th>
                  </tr>
                </tfoot>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
