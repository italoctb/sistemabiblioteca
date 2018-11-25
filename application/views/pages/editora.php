<div class="container ic-cmp-int float-lb form-elet-mg form-add">
    <div class="container">
        <?php
            $nivel = array(
                'administrador'   => 'Administrador',
                'usuario'         => 'Usuário',
                'bibliotecario'   => 'Bibliotecario'
            );

            $tipo = array(
                'tipoFunc' => 'Funcionário',
                'tipoProf' => 'Professor',
                'tipoAl'   => 'Aluno',
            );
        ?>
        <div class="row">
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="form-element-list mg-t-30">
              <div class="row">
                  <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                    <div style="margin-top:25px;">
                          <p style="font-size: 16px; font-weight: bolder;">Editora: <?php echo $cat;?></p>
                        </div>
                    </div>


                  <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                    <table id="" class="table table-striped">
                      <thead>
                        <tr>
                          <th><a class="fixing_bug" href="#data-table-basic">ISBN</a></th>
                          <th><a class="fixing_bug" href="#data-table-basic">Nome da obra</a></th>
                          <th><a class="fixing_bug" href="#data-table-basic">Autor</a></th>
                          <th><a class="fixing_bug" href="#data-table-basic">Editora</a></th>
                          <th><a class="fixing_bug" href="#data-table-basic">Disponibilidade</a></th>
                        </tr>
                      </thead>

                      <tbody>

                        <?php $til = "";
                        foreach ($liv as $res):
                          if (!($res->titulo == $til)):?>
                            <tr>
                                <td><?=$res->ISBN?></td>
                                <td><?=$res->titulo?></td>
                                <td><?php
                                $aux = 0;
                                  foreach ($cpf as $cpf_query){
                                    if ($res->ISBN == $cpf_query->ISBN){
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
                                ?></td>
                                <td><?=$res->editora?></td>
                                <td><?=$res->qtd_disp.'/'.$res->qtd_copias?></td>
                            </tr>
                        <?php endif;$til = $res->titulo;endforeach; ?>
                      </tbody>
                      <tfoot>
                        <tr>
                          <th><a class="fixing_bug" href="#data-table-basic">ISBN</a></th>
                          <th><a class="fixing_bug" href="#data-table-basic">Nome da obra</a></th>
                          <th><a class="fixing_bug" href="#data-table-basic">Autor</a></th>
                          <th><a class="fixing_bug" href="#data-table-basic">Editora</a></th>
                          <th><a class="fixing_bug" href="#data-table-basic">Disponibilidade</a></th>
                        </tr>
                      </tfoot>
                    </table>
                  </div>
              </div>

            </div>
          </div>
        </div>
        <div class="row justify-content-center" style="margin-top : 30px;">
          <div class="col-xs-4 col-xs-offset-4">
            <div  class="form-group justify-content-center" style="text-align: center;">
                <a class="btn btn-info notika-btn-info" href="<?=base_url('/')?>">Voltar</a>
            </div>
          </div>
        </div>

    </div>
  </div>
