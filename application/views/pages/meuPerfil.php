<span style="background-color:red;">
  <div class="container">
      <div class="row">
          <div class="col-md-4 col-md-offset-4">
                  <div class="panel-body">
                      <?php
					  $success_msg= $this->session->flashdata('success_msg');
					  $error_msg= $this->session->flashdata('error_msg');

					  if($success_msg){
						  ?>
						  <div class="alert alert-success">
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
					  ?>
                  </div>
          </div>
      </div>
  </div>
</span>

<div class="breadcomb-area">
  <div class="container">
    <div class="row">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="breadcomb-list">
          <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
              <div class="breadcomb-wp">
                <div class="breadcomb-icon">
                  <i class="notika-icon notika-support"></i>
                </div>
                <div class="breadcomb-ctn">
                  <h2>Meu Perfil</h2>
                </div>
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Breadcomb area End-->
  <!-- Typography area start-->
  <div class="typography-area">
      <div class="container">
          <div class="row">
              <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                  <div class="typography-list typography-mgn">
                      <div class="typography-bd">
                        <?php
                        if (!empty($title)){
                          foreach ($title as $query) {

                            if ($query->tipoUsuario == 'tipoAl'){?>
                        <p><b>Nome:</b> <?php echo $query->nome ?></p>
                        <p><b>Usuário:</b> <?php echo $query->username ?></p>
                        <p><b>Telefones: </b></p>
                        <?php foreach ($title2 as $query2) {?>
                          <p><?php echo $query2->fone_aluno ?></p>
                        <?php } ?>
                        <p><b>Endereço:</b> <?php echo $query->user_end ?></p>
                        <p><b>Tipo de usuário:</b> Aluno (a)</p>
                        <p><b>Matrícula:</b> <?php echo $query->mat_aluno ?></p>
                        <p><b>Curso:</b> <?php echo $query->nome_curso ?></p>
                        <p><b>Data de ingresso:</b> <?php echo $query->data_de_ingresso ?></p>
                        <p><b>Data de Previsão de Conclusão:</b> <?php echo $query->data_de_conclusao_prev ?></p>

                      <?php  }
                      if ($query->tipoUsuario == 'tipoProf'){?>
                        <p><b>Nome:</b> <?php echo $query->nome ?></p>
                        <p><b>Usuário:</b> <?php echo $query->username ?></p>
                        <p><b>Endereço:</b> <?php echo $query->user_end ?></p>
                        <p><b>Telefone Celular:</b> <?php echo $query->telefone_celular ?></p>
                        <p><b>Tipo de usuário:</b> Professor (a)</p>
                        <p><b>SIAPE:</b> <?php echo $query->mat_siape ?></p>
                        <p><b>Curso:</b> <?php echo $query->nome_curso ?></p>
                        <p><b>Data de Contratação:</b> <?php echo $query->data_de_contratacao ?></p>

                      <?php  }
                      if ($query->tipoUsuario == 'tipoFunc'){?>
                        <p><b>Nome:</b> <?php echo $query->nome ?></p>
                        <p><b>Usuário:</b> <?php echo $query->username ?></p>
                        <p><b>Telefones: </b></p>
                        <?php foreach ($title2 as $query2) {?>
                          <p><?php echo $query2->fone_func ?></p>
                        <?php } ?>
                        <p><b>Tipo de usuário:</b> Funcionário (a)</p>
                        <p><b>Matrícula:</b> <?php echo $query->mat_func ?></p>
                        <p><b>Endereço:</b> <?php echo $query->user_end ?></p>
                      <?php }}}else {?>
                        <p> <?php echo 'erro' ?></p>
                    <?php  } ?>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
