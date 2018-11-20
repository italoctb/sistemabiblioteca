<?php
    $user = $this->session->userdata('nivel_usuario');
    if($user != 'administrador'){redirect(base_url(''));}
?>

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
                          <p style="font-size: 16px; font-weight: bolder;">Curso: <?php echo $cat;?></p>
                        </div>
                    </div>


                  <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                    <table id="" class="table table-striped">
                      <thead>
                        <tr>
                          <th><a class="fixing_bug" href="#data-table-basic">Nome</a></th>
                          <th><a class="fixing_bug" href="#data-table-basic">Matrícula SIAPE</a></th>
                          <th><a class="fixing_bug" href="#data-table-basic">Telefone celular</a></th>
                        </tr>
                      </thead>

                      <tbody>

                        <?php
                        foreach ($liv as $res):?>
                            <tr>
                                <td><?=$res->nome?></td>
                                <td><?=$res->mat_siape?></td>
                                <td><?=$res->telefone_celular?></td>
                            </tr>
                        <?php endforeach; ?>
                      </tbody>
                      <tfoot>
                        <tr>
                          <th><a class="fixing_bug" href="#data-table-basic">Nome</a></th>
                          <th><a class="fixing_bug" href="#data-table-basic">Matrícula SIAPE</a></th>
                          <th><a class="fixing_bug" href="#data-table-basic">Telefone celular</a></th>
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
