<div class="data-table-area">
  <div class="container">
    <div class="row">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="data-table-list">
          <div class="table-responsive">
            <table id="" class="table table-striped">
              <thead>
                <tr>
                  <th><a class="fixing_bug" href="#data-table-basic">Matrícula</a></th>
                  <th><a class="fixing_bug" href="#data-table-basic">Nome</a></th>
                  <th><a class="fixing_bug" href="#data-table-basic">Usuário</a></th>
                  <th><a class="fixing_bug" href="#data-table-basic">Nível</a></th>
                  <th><a class="fixing_bug" href="#data-table-basic">Livros Alugados</a></th>
                  <th><a class="fixing_bug" href="#data-table-basic">Limite de Livros</a></th>
                </tr>
              </thead>
              <tbody>
                <?php
                  foreach ($usuarios as $cat):
                    if ($cat->tipoUsuario == 'tipoFunc'):
                      $matricula = $cat->mat_func;
                    elseif ($cat->tipoUsuario == 'tipoProf'):
                      $matricula = $cat->mat_siape;
                    elseif ($cat->tipoUsuario == 'tipoAl'):
                      $matricula = $cat->mat_aluno;
                    endif;
                  if ($cat->qntd_livros>0):
                ?>
                    <tr>
                        <td><?=$matricula?></td>
                        <td><?=$cat->nome?></td>
                        <td><?=$cat->username?></td>
                        <td><?=$cat->nivel_usuario?></td>
                        <td><?=$cat->qntd_livros?></td>
                        <td><?=$cat->qntd_livros_max?></td>

                        <td>
                            <a class="btn btn-primary notika-btn-primary" href="<?=base_url('baixaReserva/'.$cat->username)?>";>Visualisar</a>
                        </td>
                    </tr>

                <?php
                  endif;
                  endforeach;
                ?>

                </tbody>
                <tfoot>
                  <tr>
                    <th><a class="fixing_bug" href="#data-table-basic">Matrícula</a></th>
                  <th><a class="fixing_bug" href="#data-table-basic">Nome</a></th>
                  <th><a class="fixing_bug" href="#data-table-basic">Usuário</a></th>
                  <th><a class="fixing_bug" href="#data-table-basic">Nível</a></th>
                  <th><a class="fixing_bug" href="#data-table-basic">Livros Alugados</a></th>
                  <th><a class="fixing_bug" href="#data-table-basic">Limite de Livros</a></th>
                  </tr>
                </tfoot>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
