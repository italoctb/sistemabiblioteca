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
                  <th><a class="fixing_bug" href="#data-table-basic">Usuário</a></th>
                  <th><a class="fixing_bug" href="#data-table-basic">Data de reserva</a></th>
                  <th><a class="fixing_bug" href="#data-table-basic">Data de devolução</a></th>
                </tr>
              </thead>
              <tbody>
                <?php
                  foreach ($reserva as $res):
                  if ($res->username == $username):
                    echo $username;
                ?>
                    <tr>
                        <td><?=$res->ISBN?></td>
                        <td><?=$res->username?></td>
                        <td><?=$res->data_reserva?></td>
                        <td><?=$res->prazo_dev?></td>

                        <td>
                            <a class="btn bt-form btn-block" href="<?=base_url('devReserva/'.$res->ISBN.'/'.$res->username)?>" onclick="return confirm('Deseja realmente dar baixa no registro?');">Dar Baixa</a>
                        </td>
                    </tr>
                <?php
                  endif;
                  endforeach;
                ?>

                </tbody>
                <tfoot>
                  <tr>
                    <th><a class="fixing_bug" href="#data-table-basic">ISBN</a></th>
                  <th><a class="fixing_bug" href="#data-table-basic">Usuário</a></th>
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
