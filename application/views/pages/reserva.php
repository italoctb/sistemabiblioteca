<?php
    $user_id = $this->session->userdata('nivel_usuario');
    $tipo= $this->session->userdata('tipoUsuario');
    if($user_id != 'usuario' && $user_id != 'bibliotecario' && $user_id != 'administrador'){redirect(base_url('sem_acesso'));}
?>

<script src="./ordena/sorttable.js"></script>

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
                  <th><a class="fixing_bug" href="#data-table-basic">Realizar reserva</a></th>
                </tr>
              </thead>
              <tbody>
                <?php


                  /* Tabela exibindo as reservas disponíveis para o usuário, as informações ISBN, título e ano de lançamento, e editora são exibidas*/

                  foreach ($livros as $liv) {?>
                    <tr>
                      <td><?php echo $liv->ISBN ?></td>
                      <td><?php echo $liv->titulo ?></td>
                      <td><?php echo $liv->ano_lançamento ?></td>
                      <td><?php echo $liv->editora ?></td>
                      <td>
                        <a class="btn btn-success notika-btn-success" style="position: relative; bottom:4px;" href="<?=base_url('reservaLivro/'.$liv->ISBN)?>";>Reservar</a> 
                        <!--

                        Envia para os controladores o código do livro para ser vinculado ao usuário que está logado

                        -->
                    </tr>
                <?php  }?>

                </tbody>
                <tfoot>
                  <tr>
                    <th><a class="fixing_bug" href="#data-table-basic">ISBN</a></th>
                    <th><a class="fixing_bug" href="#data-table-basic">Nome da obra</a></th>
                    <th><a class="fixing_bug" href="#data-table-basic">Ano de publicação</a></th>
                    <th><a class="fixing_bug" href="#data-table-basic">Editora</a></th>
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
