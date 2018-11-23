<span style="background-color:red;">
  <div class="container ">
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

  <div class="container form-add">
    <div class="row">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="data-table-list">
          <form action="<?=base_url('trataRemover')?>" method="post" class="form-signin">
            <div class="row">
              <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="form-element-list mg-t-30">
                  <div class="row">

                    <div class="col-lg-6  col-md-6  col-sm-6  col-xs-12">

                      <div class="nk-int-mk sl-dp-mn sm-res-mg-t-10">
                        <h2>Requisição de cancelamento de conta</h2>
                      </div>
                             <!--

                          Exibe ao administrador todos os pedidos realizados de solicitação de remoção de cadastro feita pelos usuários.

                          -->
                      <div class="bootstrap-select fm-cmp-mg">
                        <select class="selectpicker" data-live-search="true" name="username">
                          <?php if ($req): ?>
                            <option disabled="disabled">Escolha o usuário</option>
                            <option selected><?php echo $req->username ;?></option>
                          <?php else: ?>
                            <option disabled="disabled" selected>Escolha o usuário</option>
                          <?php endif; ?>
                          <?php foreach ($solicitacao as $sol){
                            if (!$req || $sol->username!=$req->username) {
                              echo "<option>$sol->username</option>";
                            }
                          }?>
                        </select>
                      </div>

                    </div>

                    <div class="col-lg-6  col-md-6  col-sm-6  col-xs-12" style="position: relative; top:25px;">
                      <div  class="form-group justify-content-center" style="text-align: center;">
                        <button type="submit" class="btn btn-danger notika-btn-danger" value="" onclick="return confirm('Tem certeza que deseja deletar o usuário?');">Remover</button>

                             <!--

                          Ao clicar, remove por completo o usuário e tudo que há vinculado sobre ele. Essa operação só é permitida caso não houver pendências na biblioteca.

                          -->
                      </div>
                    </div>

                  </div>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
