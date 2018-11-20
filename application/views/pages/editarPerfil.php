

        <?php      if (!empty($title)){
                foreach ($title as $query) {
if ($query->tipoUsuario == 'tipoAl'){?>
<form action="<?=base_url('tratarEditarPerfilAl')?>" method="POST">
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
      <div class="form-element-list mg-t-30">
          <div class="form-group ic-cmp-int">
            <div class="form-ic-cmp">
              <i class="notika-icon notika-support"></i>
            </div>
            <div class="nk-int-st">
              <p><b>Nome: </b>
              <input type="text" name="nome" value="<?php $query->nome ?>" class="form-control" placeholder="<?php echo $query->nome ?>"></p>
            </div>
          </div>
      </div>
</div>
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
  <div class="form-element-list mg-t-30">
    <div class="form-group ic-cmp-int">
      <div class="form-ic-cmp">
        <i class="notika-icon notika-support"></i>
      </div>
      <div class="nk-int-st">
        <p><b>Usuário: </b>
        <input type="text" name="username" value="<?php $query->username ?>" class="form-control" placeholder="<?php echo $query->username ?>"></p>
      </div>
    </div>
  </div>
</div>
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
  <div class="form-element-list mg-t-30">
    <div class="form-group ic-cmp-int">
        <div class="form-ic-cmp">
          <i class="notika-icon notika-tax"></i>
        </div>
        <div class="nk-int-st">
          <p><b>Senha: </b>
          <input type="password" value="<?php $query->password ?>" name="password" class="form-control" placeholder="Senha"></p>
        </div>
    </div>
  </div>
</div>
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
  <div class="form-element-list mg-t-30">
    <div class="form-group ic-cmp-int form-elet-mg res-mg-fcs">
      <div class="form-ic-cmp">
        <i class="notika-icon notika-house"></i>
      </div>
      <div class="nk-int-st">
        <p><b>Endereço: </b>
        <input type="text" name="user_end" value="<?php $query->user_end ?>" class="form-control" placeholder="<?php echo $query->user_end ?>" ></p>
      </div>
    </div>
  </div>
</div>
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="form-element-list mg-t-30">
          <div class="form-group ic-cmp-int">
            <?php foreach ($title2 as $query2) {?>
              <div class="form-ic-cmp">
                <i class="notika-icon notika-phone"></i>
              </div>
              <div class="nk-int-st">
                <input type="text" name="foneAl" value="<?php $query2->fone_aluno ?>" class="form-control" placeholder="<?php echo $query2->fone_aluno ?>">
              </div>
              <?php } ?>
          </div>
        </div>
      </div>
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="form-element-list mg-t-30">
          <div class="form-group ic-cmp-int form-elet-mg res-mg-fcs">
            <div class="form-ic-cmp">
              <i class="notika-icon notika-edit"></i>
            </div>
            <div class="nk-int-st">
              <p><b>Matrícula: </b>
              <input type="text" name="mat_aluno" value="<?php $query->mat_aluno ?>" class="form-control" placeholder="<?php echo $query->mat_aluno ?>" ></p>
            </div>
          </div>
        </div>
      </div>
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="form-element-list mg-t-30">
          <div class="form-group ic-cmp-int form-elet-mg res-mg-fcs">
            <div class="form-ic-cmp">
              <i class="notika-icon notika-edit"></i>
            </div>
            <div class="nk-int-st">
              <p><b>Nome do curso: </b>
              <input type="text" name="nome_curso" value="<?php $query->nome_curso ?>" class="form-control" placeholder="<?php echo $query->nome_curso ?>" ></p>
            </div>
          </div>
        </div>
      </div>
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="form-element-list mg-t-30">
          <div class="form-group ic-cmp-int form-elet-mg res-mg-fcs">
            <div class="form-ic-cmp">
              <i class="notika-icon notika-calendar"></i>
            </div>
            <div class="nk-int-st">
              <p><b>Data de ingresso: </b>
              <input type="text" name="data_de_ingresso" class="form-control" placeholder="<?php echo $query->data_de_ingresso ?>" ></p>
            </div>
          </div>
        </div>
      </div>
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="form-element-list mg-t-30">
          <div class="form-group ic-cmp-int form-elet-mg res-mg-fcs">
            <div class="form-ic-cmp">
              <i class="notika-icon notika-calendar"></i>
            </div>
            <div class="nk-int-st">
              <p><b>Data de Previsão de Conclusão: </b>
              <input type="text" name="data_de_conclusao_prev" class="form-control" placeholder="<?php echo $query->data_de_conclusao_prev ?>" ></p>
            </div>
          </div>
        </div>
      </div>
</form>
<?php }



    if ($query->tipoUsuario === 'tipoFunc'){?>
      <form action="<?=base_url('tratarEditarPerfilFunc')?>" method="POST">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="form-element-list mg-t-30">
                <div class="form-group ic-cmp-int">
                  <div class="form-ic-cmp">
                    <i class="notika-icon notika-support"></i>
                  </div>
                  <div class="nk-int-st">
                    <p><b>Nome: </b>
                    <input type="text" name="nome" id="nome" value="<?php echo $query->nome ?>" class="form-control" placeholder="<?php echo $query->nome ?>"></p>
                  </div>
                </div>
            </div>
      </div>
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="form-element-list mg-t-30">
          <div class="form-group ic-cmp-int">
            <div class="form-ic-cmp">
              <i class="notika-icon notika-support"></i>
            </div>
            <div class="nk-int-st">
              <p><b>Usuário: </b>
              <input type="text" name="username" value="<?php echo $query->username ?>" class="form-control" placeholder="<?php echo $query->username ?>"></p>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="form-element-list mg-t-30">
          <div class="form-group ic-cmp-int">
              <div class="form-ic-cmp">
                <i class="notika-icon notika-tax"></i>
              </div>
              <div class="nk-int-st">
                <p><b>Senha: </b>
                <input type="password" name="password" value="<?php echo $query->password ?>" class="form-control" placeholder="Senha"></p>
              </div>
          </div>
        </div>
      </div>
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="form-element-list mg-t-30">
          <div class="form-group ic-cmp-int form-elet-mg res-mg-fcs">
            <div class="form-ic-cmp">
              <i class="notika-icon notika-house"></i>
            </div>
            <div class="nk-int-st">
              <p><b>Endereço: </b>
              <input type="text" name="user_end" id="user_end" value="<?php echo $query->user_end ?>" class="form-control" placeholder="<?php echo $query->user_end ?>" ></p>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="form-element-list mg-t-30">
          <div class="form-group ic-cmp-int">
            <?php foreach ($title2 as $query2) {?>
              <div class="form-ic-cmp">
                <i class="notika-icon notika-phone"></i>
              </div>
              <div class="nk-int-st">
                <p><b>Telefone: </b>
                <input type="text" name="foneAl" value="<?php echo $query2->fone_func ?>" class="form-control" placeholder="<?php echo $query2->fone_func ?>"></p>
              </div>
              <?php } ?>
          </div>
        </div>
      </div>
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="form-element-list mg-t-30">
          <div class="form-group ic-cmp-int form-elet-mg res-mg-fcs">
            <div class="form-ic-cmp">
              <i class="notika-icon notika-edit"></i>
            </div>
            <div class="nk-int-st">
              <p><b>Matrícula: </b>
              <input type="text" name="mat_func" value="<?php echo $query->mat_func ?>" class="form-control" placeholder="<?php echo $query->mat_func ?>" ></p>
            </div>
          </div>
        </div>
      </div>
      <button type="submit" class="btn btn-success notika-btn-success">Editar</button>
</form>
<?php }

if ($query->tipoUsuario == 'tipoProf'){?>
  <form action="<?=base_url('tratarEditarPerfilProf')?>" method="POST">
  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="form-element-list mg-t-30">
            <div class="form-group ic-cmp-int">
              <div class="form-ic-cmp">
                <i class="notika-icon notika-support"></i>
              </div>
              <div class="nk-int-st">
                <p><b>Nome: </b>
                <input type="text" name="nome" class="form-control" placeholder="<?php echo $query->nome ?>"></p>
              </div>
            </div>
        </div>
  </div>
  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <div class="form-element-list mg-t-30">
      <div class="form-group ic-cmp-int">
        <div class="form-ic-cmp">
          <i class="notika-icon notika-support"></i>
        </div>
        <div class="nk-int-st">
          <p><b>Usuário: </b>
          <input type="text" name="username" class="form-control" placeholder="<?php echo $query->username ?>"></p>
        </div>
      </div>
    </div>
  </div>
  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <div class="form-element-list mg-t-30">
      <div class="form-group ic-cmp-int">
          <div class="form-ic-cmp">
            <i class="notika-icon notika-tax"></i>
          </div>
          <div class="nk-int-st">
            <p><b>Senha: </b>
            <input type="password" name="password" class="form-control" placeholder="Senha"></p>
          </div>
      </div>
    </div>
  </div>
  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <div class="form-element-list mg-t-30">
      <div class="form-group ic-cmp-int form-elet-mg res-mg-fcs">
        <div class="form-ic-cmp">
          <i class="notika-icon notika-house"></i>
        </div>
        <div class="nk-int-st">
          <p><b>Endereço: </b>
          <input type="text" name="user_end" class="form-control" placeholder="<?php echo $query->user_end ?>" ></p>
        </div>
      </div>
    </div>
  </div>
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
          <div class="form-element-list mg-t-30">
            <div class="form-group ic-cmp-int form-elet-mg res-mg-fcs">
              <div class="form-ic-cmp">
                <i class="notika-icon notika-edit"></i>
              </div>
              <div class="nk-int-st">
                <p><b>Telefone Celular: </b>
                <input type="text" name="telefone_celular" class="form-control" placeholder="<?php echo $query->telefone_celular ?>" ></p>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
          <div class="form-element-list mg-t-30">
            <div class="form-group ic-cmp-int form-elet-mg res-mg-fcs">
              <div class="form-ic-cmp">
                <i class="notika-icon notika-edit"></i>
              </div>
              <div class="nk-int-st">
                <p><b>SIAPE: </b>
                <input type="text" name="mat_siape" class="form-control" placeholder="<?php echo $query->mat_siape ?>" ></p>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
          <div class="form-element-list mg-t-30">
            <div class="form-group ic-cmp-int form-elet-mg res-mg-fcs">
              <div class="form-ic-cmp">
                <i class="notika-icon notika-edit"></i>
              </div>
              <div class="nk-int-st">
                <p><b>Nome do curso: </b>
                <input type="text" name="nome_curso" class="form-control" placeholder="<?php echo $query->nome_curso ?>" ></p>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
          <div class="form-element-list mg-t-30">
            <div class="form-group ic-cmp-int form-elet-mg res-mg-fcs">
              <div class="form-ic-cmp">
                <i class="notika-icon notika-edit"></i>
              </div>
              <div class="nk-int-st">
                <p><b>Data de Contratação: </b>
                <input type="text" name="data_de_contratacao" class="form-control" placeholder="<?php echo $query->data_de_contratacao ?>" ></p>
              </div>
            </div>
          </div>
        </div>
</form>

    <?php }}} ?>



            <!--    <div class="col-lg-3 col-lg-offset-1 col-md-3 col-md-offset-1 col-sm-3 col-sm-offset-1 col-xs-10 col-xs-offset-2" style="margin-top:6px;">
                    <div class="bootstrap-select fm-cmp-mg">
                        <select class="selectpicker" id = "tipo_drop_add">
                          <option disabled="disabled" selected>Escolha o tipo de usuário</option>
                          <option>Professor</option>
                          <option>Funcionário</option>
                          <option>Aluno</option>
                        </select>
                    </div>
                </div>
                <div class="col-lg-3 col-lg-offset-1 col-md-3 col-md-offset-1 col-sm-3 col-sm-offset-1 col-xs-10 col-xs-offset-2" style="margin-top:6px;">
                    <div class="bootstrap-select fm-cmp-mg">
                        <select class="selectpicker">
                          <option disabled="disabled" selected>Escolha o nível de acesso</option>
                          <option>Administrador</option>
                          <option>Bibliotecário</option>
                          <option>Usuário</option>
                        </select>
                    </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div id="dinamic-div-form" style="display : none;"></div>

        <div class="row justify-content-center" style="margin-top : 30px;">
          <div class="col-xs-4 col-xs-offset-4">
            <div  class="form-group justify-content-center" style="text-align: center;">
                <button type="submit" class="btn btn-success notika-btn-success" value="Cadastrar">Cadastrar</button>
                <button id="limpar" type="reset" class="btn btn-info notika-btn-info" name="Limpar" value="Limpar">Limpar</button>
            </div>
          </div>
        </div> -->


    </form>
