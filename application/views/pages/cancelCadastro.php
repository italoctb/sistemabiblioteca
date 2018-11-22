<!<span style="background-color:red;">
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

  <div class="container">
    <div class="row">
      <div class="col-lg-6 col-lg-offset-3 col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3 col-xs-12">
        <div class="data-table-list">
          <form action="<?=base_url('TrataCancelCadastro')?>" method="post" class="form-signin">
            <div class="row">
              <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="form-element-list mg-t-30">

                  <div class="row" style="margin-top: 20px; margin-bottom:20px;">
                    <div class="col-lg-8 col-lg-offset-2  col-md-6 col-md-offset-2  col-sm-6 col-sm-offset-2  col-xs-12">
                      <div class="nk-int-mk sl-dp-mn sm-res-mg-t-10">
                        <h2 style="text-align:center;">Requisição de cancelamento de conta</h2>
                      </div>
                    </div>
                  </div>

                  <div class="row" style="margin-top: 20px; margin-bottom:20px;">
                    <div class="col-lg-8 col-lg-offset-2  col-md-6 col-md-offset-2  col-sm-6 col-sm-offset-2  col-xs-12">
                        <div class="form-group ic-cmp-int">
                            <div class="form-ic-cmp">
                                <i class="notika-icon notika-support"></i>
                            </div>
                            <div class="nk-int-st">
                                <input type="text" class="form-control" name="usuario" placeholder="Confirme seu usuário" required>
                            </div>
                        </div>
                    </div>
                  </div>

                  <div class="row" style="margin-top: 20px; margin-bottom:55px;">
                    <div class="col-lg-8 col-lg-offset-2  col-md-6 col-md-offset-2  col-sm-6 col-sm-offset-2  col-xs-12">
                      <div class="form-group ic-cmp-int form-elet-mg res-mg-fcs">
                            <div class="form-ic-cmp">
                                <i class="notika-icon notika-edit"></i>
                            </div>
                            <div class="nk-int-st">
                                <input type="password" class="form-control" name="senha" placeholder="Confirme sua senha" required>
                            </div>
                      </div>
                    </div>
                  </div>

                  <div class="row" style="margin-top: 20px; margin-bottom:20px;">
                    <div class="col-lg-8 col-lg-offset-2  col-md-6 col-md-offset-2  col-sm-6 col-sm-offset-2  col-xs-12">
                      <div  class="form-group justify-content-center" style="text-align: center;">
                        <button type="submit" class="btn btn-danger notika-btn-danger" value="" onclick="return confirm('Tem certeza que deseja deletar o usuário?');">Solicitar</button>
                      </div>
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
