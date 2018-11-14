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
                  <th><a class="fixing_bug" href="#data-table-basic">Data de devolução</a></th>
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
                      <td><?php echo $query->prazo_dev ?></td>
                    </tr>
                <?php  }?>

                </tbody>
                <tfoot>
                  <tr>
                    <th><a class="fixing_bug" href="#data-table-basic">Usuário</a></th>
                    <th><a class="fixing_bug" href="#data-table-basic">Nome</a></th>
                    <th><a class="fixing_bug" href="#data-table-basic">Título</a></th>
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
