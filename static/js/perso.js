$("#tipo_drop_add").change(function(){
  if($("#tipo_drop_add").val() == "Professor"){
    $("#dinamic-div-form").slideUp("slow");
    $prof_form = '<div class="row"> <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"> <div class="form-element-list mg-t-30"> <div class="row"> <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12"> <div class="form-group ic-cmp-int form-elet-mg res-mg-fcs"> <div class="form-ic-cmp"> <i class="notika-icon notika-edit"></i> </div><div class="nk-int-st"> <input type="text" class="form-control" placeholder="Matrícula SIAPE"> </div></div></div><div class="col-lg-3 col-md-3 col-sm-3 col-xs-12"> <div class="form-group ic-cmp-int"> <div class="form-ic-cmp"> <i class="notika-icon notika-calendar"></i> </div><div class="nk-int-st"> <input type="text" class="form-control date" data-mask="99/99/9999" placeholder="Ano de contrato (yyyy/mm/dd)"> </div></div></div><div class="col-lg-4 col-md-4 col-sm-4 col-xs-12"> <div class="form-group ic-cmp-int"> <div class="form-ic-cmp"> <i class="notika-icon notika-phone"></i> </div><div class="nk-int-st"> <input type="text" class="form-control" data-mask="(999) 999-9999" placeholder="Telefone (apenas números com ddd)"> </div></div></div></div><div class="row"> <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" style="margin-top:10px;"> <h5 style="display: inline-block;margin-right: 10px;">Selecione um curso: </h5> <div class="btn-group btn-group-toggle" data-toggle="buttons"> <label class="btn btn-secondary active"> <input type="radio" name="options" id="option1" autocomplete="off" checked> Engenharia </label> <label class="btn btn-secondary"> <input type="radio" name="options" id="option2" autocomplete="off"> Medicina </label> <label class="btn btn-secondary"> <input type="radio" name="options" id="option3" autocomplete="off"> Economia </label> </div></div><div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" style="margin-top:10px;"> <h5 style="display: inline-block;margin-right: 10px;">Selecione a carga horária: </h5> <div class="btn-group btn-group-toggle" data-toggle="buttons"> <label class="btn btn-secondary active"> <input type="radio" name="options" id="option1" autocomplete="off" checked> 20h </label> <label class="btn btn-secondary"> <input type="radio" name="options" id="option2" autocomplete="off"> 40h </label> </div></div></div></div></div></div>';
    $("#dinamic-div-form").html($prof_form);
    $("#dinamic-div-form").slideDown("slow");
  }else if($("#tipo_drop_add").val() == "Aluno"){
    $("#dinamic-div-form").slideUp("slow");

    $other_form = '<div class="row"> <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"> <div class="form-element-list mg-t-30"> <div class="row"> <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12"> <div class="form-group ic-cmp-int form-elet-mg res-mg-fcs"> <div class="form-ic-cmp"> <i class="notika-icon notika-edit"></i> </div><div class="nk-int-st"> <input type="text" class="form-control" placeholder="Matrícula"> </div></div></div><div class="col-lg-4 col-md-4 col-sm-4 col-xs-12"> <div class="form-group ic-cmp-int"> <div class="form-ic-cmp"> <i class="notika-icon notika-calendar"></i> </div><div class="nk-int-st"> <input type="text" class="form-control date" data-mask="99/99/9999" placeholder="Data de ingresso(yyyy/mm/dd)"> </div></div></div><div class="col-lg-4 col-md-4 col-sm-4 col-xs-12"> <div class="form-group ic-cmp-int"> <div class="form-ic-cmp"> <i class="notika-icon notika-calendar"></i> </div><div class="nk-int-st"> <input type="text" class="form-control date" data-mask="99/99/9999" placeholder="Data de conclusão(yyyy/mm/dd)"> </div></div></div></div><div class="row"> <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12"> <div class="form-group ic-cmp-int"> <div class="form-ic-cmp"> <i class="notika-icon notika-phone"></i> </div><div class="nk-int-st"> <input type="text" class="form-control" data-mask="(999) 999-9999" placeholder="Telefone (apenas números com ddd)"> </div></div></div><div class="col-lg-8 col-md-8 col-sm-8 col-xs-12" style="margin-top:10px;"> <h5 style="display: inline-block;margin-right: 10px;">Selecione um curso: </h5> <div class="btn-group btn-group-toggle" data-toggle="buttons"> <label class="btn btn-secondary active"> <input type="radio" name="options" id="option1" autocomplete="off" checked> Engenharia </label> <label class="btn btn-secondary"> <input type="radio" name="options" id="option2" autocomplete="off"> Medicina </label> <label class="btn btn-secondary"> <input type="radio" name="options" id="option3" autocomplete="off"> Economia </label> </div></div></div></div></div></div>';
    $("#dinamic-div-form").html($other_form);
    $("#dinamic-div-form").slideDown("slow");
  }else if($("#tipo_drop_add").val() == "Funcionário"){
    $("#dinamic-div-form").slideUp("slow");

    $other_form = '<div class="row"> <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"> <div class="form-element-list mg-t-30"> <div class="row"> <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12"> <div class="form-group ic-cmp-int form-elet-mg res-mg-fcs"> <div class="form-ic-cmp"> <i class="notika-icon notika-edit"></i> </div><div class="nk-int-st"> <input type="text" class="form-control" placeholder="Matrícula"> </div></div></div><div class="col-lg-4 col-md-4 col-sm-4 col-xs-12"> <div class="form-group ic-cmp-int"> <div class="form-ic-cmp"> <i class="notika-icon notika-phone"></i> </div><div class="nk-int-st"> <input type="text" class="form-control" data-mask="(999) 999-9999" placeholder="Telefone (apenas números com ddd)"> </div></div></div></div></div></div></div>';

    $("#dinamic-div-form").html($other_form);
    $("#dinamic-div-form").slideDown("slow");
  }else{
    alert('Escolha um tipo de usuário!');
  }
});


$("#tipo_drop_emp").change(function(){
  if($("#tipo_drop_emp").val() == "ISBN"){
    $("#nomeObraDiv").fadeOut("slow");
    $("#isbnEmpDiv").fadeIn("slow");
  }else if($("#tipo_drop_emp").val() == "Título da obra"){
    $("#isbnEmpDiv").fadeOut("slow");
    $("#nomeObraDiv").fadeIn("slow");
  }else{
    alert('Escolha um tipo de consulta!');
  }
});
