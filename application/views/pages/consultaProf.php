<?php
    $user = $this->session->userdata('nivel_usuario');
    if($user != 'administrador' && $user != 'bibliotecario'){base_url('');}
?>

<div class="data-table-area">
  <div class="container form-add">
    <div class="row">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="data-table-list">
          <div class="table-responsive">
            <div class="searc-input">
              <form action="<?=base_url('tratarConsultaProf')?>" method="POST">
              <input type="text" class="caixaPclass" name="caixaProf" id="caixaProf" placeholder="Pesquisar"/>
              <button class="btn btn-info info-icon-notika buttonPesq" type="submit"><i class="notika-icon notika-search"></i></button>
            </form>
          </div>
            <table id="" class="table table-striped">
              <thead>
                <tr>
                  <th><a class="fixing_bug" href="#data-table-basic">SIAPE</a></th>
                  <th><a class="fixing_bug" href="<?= base_url('consultaProf/ordenaPorNome');?>">Nome</a></th>
                  <th><a class="fixing_bug" href="<?=base_url('consultaProf/ordenaPorCurso');?>">Nome do curso</a></th>
                </tr>
              </thead>
              <tbody>
                <?php

                /* Tabela exibindo os professores vinculados, as informações matrícula siape, nome e nome do curso são exibidas*/

                  foreach ($title as $query) {?>
                    <tr>
                      <td><?php echo $query->mat_siape ?></td>
                      <td><?php echo $query->nome ?></td>
                      <td><a id="a-edit"  href="<?=base_url('curso/'.$query->nome_curso)?>"><?php echo $query->nome_curso ?></a></td>
                    </tr>
                <?php  }?>

                </tbody>
                <tfoot>
                  <tr>
                    <th><a class="fixing_bug" href="#data-table-basic">SIAPE</a></th>
                    <th><a class="fixing_bug" href="#data-table-basic">Nome</a></th>
                    <th><a class="fixing_bug" href="#data-table-basic">Nome do curso</a></th>
                  </tr>
                </tfoot>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
