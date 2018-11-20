-- MySQL Script generated by MySQL Workbench
-- Fri Nov 16 16:02:42 2018
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema equipe385116
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema equipe385116
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `equipe385116` DEFAULT CHARACTER SET utf8 ;
USE `equipe385116` ;

-- -----------------------------------------------------
-- Table `equipe385116`.`CATEGORIA`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `equipe385116`.`CATEGORIA` (
  `cod_categoria` INT NOT NULL,
  `descricao` VARCHAR(45) NULL,
  PRIMARY KEY (`cod_categoria`),
  UNIQUE INDEX `cod_categoria_UNIQUE` (`cod_categoria` ASC) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `equipe385116`.`LIVROS`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `equipe385116`.`LIVROS` (
  `ISBN` INT NOT NULL,
  `titulo` VARCHAR(45) NOT NULL,
  `ano_lançamento` YEAR NULL,
  `editora` VARCHAR(45) NULL,
  `qtd_copias` INT NOT NULL,
  `cod_categoria` INT NOT NULL,
  `qtd_disp` INT NOT NULL,
  PRIMARY KEY (`ISBN`),
  INDEX `fk_LIVROS_CATEGORIA1_idx` (`cod_categoria` ASC) ,
  UNIQUE INDEX `ISBN_UNIQUE` (`ISBN` ASC) ,
  CONSTRAINT `fk_LIVROS_CATEGORIA1`
    FOREIGN KEY (`cod_categoria`)
    REFERENCES `equipe385116`.`CATEGORIA` (`cod_categoria`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `equipe385116`.`AUTORES`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `equipe385116`.`AUTORES` (
  `nome_autor` VARCHAR(45) NOT NULL,
  `cpf` CHAR(11) NOT NULL,
  `nacionalidade` VARCHAR(45) NULL,
  PRIMARY KEY (`cpf`),
  UNIQUE INDEX `cpf_UNIQUE` (`cpf` ASC) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `equipe385116`.`CURSO`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `equipe385116`.`CURSO` (
  `cod_curso` VARCHAR(45) NOT NULL,
  `nome_curso` VARCHAR(45) NULL,
  PRIMARY KEY (`cod_curso`),
  UNIQUE INDEX `cod_curso_UNIQUE` (`cod_curso` ASC) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `equipe385116`.`ALUNOS`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `equipe385116`.`ALUNOS` (
  `mat_aluno` INT NOT NULL,
  `cod_curso` VARCHAR(45) NOT NULL,
  `data_de_ingresso` DATE NULL,
  `data_de_conclusao_prev` DATE NULL,
  `tipoAl` INT NOT NULL,
  PRIMARY KEY (`mat_aluno`),
  INDEX `cod_curso_idx` (`cod_curso` ASC) ,
  UNIQUE INDEX `mat_aluno_UNIQUE` (`mat_aluno` ASC) ,
  UNIQUE INDEX `cod_curso_UNIQUE` (`cod_curso` ASC) ,
  CONSTRAINT `cod_curso`
    FOREIGN KEY (`cod_curso`)
    REFERENCES `equipe385116`.`CURSO` (`cod_curso`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `equipe385116`.`FONE_ALUNOS`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `equipe385116`.`FONE_ALUNOS` (
  `fone_aluno` VARCHAR(13) NOT NULL,
  `mat_aluno` INT NOT NULL,
  PRIMARY KEY (`mat_aluno`, `fone_aluno`),
  INDEX `fk_FONE_ALUNOS_ALUNOS_idx` (`mat_aluno` ASC) ,
  UNIQUE INDEX `fone_aluno_UNIQUE` (`fone_aluno` ASC) ,
  CONSTRAINT `fk_FONE_ALUNOS_ALUNOS`
    FOREIGN KEY (`mat_aluno`)
    REFERENCES `equipe385116`.`ALUNOS` (`mat_aluno`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `equipe385116`.`PROFESSORES`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `equipe385116`.`PROFESSORES` (
  `mat_siape` INT NOT NULL,
  `regime_trabalho` ENUM('20h', '40h', 'DE') NOT NULL,
  `cod_curso` VARCHAR(45) NULL,
  `data_de_contratacao` YEAR NULL,
  `telefone_celular` VARCHAR(13) NULL,
  `tipoProf` INT NOT NULL,
  PRIMARY KEY (`mat_siape`),
  INDEX `cod_curso_idx` (`cod_curso` ASC) ,
  UNIQUE INDEX `mat_siape_UNIQUE` (`mat_siape` ASC) ,
  CONSTRAINT `cod_curso_prof`
    FOREIGN KEY (`cod_curso`)
    REFERENCES `equipe385116`.`CURSO` (`cod_curso`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `equipe385116`.`FUNCIONARIOS`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `equipe385116`.`FUNCIONARIOS` (
  `mat_func` INT NOT NULL,
  `tipoFunc` INT NOT NULL,
  PRIMARY KEY (`mat_func`),
  UNIQUE INDEX `mat_func_UNIQUE` (`mat_func` ASC) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `equipe385116`.`FONE_FUNC`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `equipe385116`.`FONE_FUNC` (
  `fone_func` VARCHAR(13) NOT NULL,
  `mat_func` INT NOT NULL,
  PRIMARY KEY (`mat_func`, `fone_func`),
  UNIQUE INDEX `fone_func_UNIQUE` (`fone_func` ASC) ,
  CONSTRAINT `TELEFONE_mat_func`
    FOREIGN KEY (`mat_func`)
    REFERENCES `equipe385116`.`FUNCIONARIOS` (`mat_func`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `equipe385116`.`LIVROS_has_AUTORES`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `equipe385116`.`LIVROS_has_AUTORES` (
  `ISBN` INT NOT NULL,
  `cpf` CHAR(11) NOT NULL,
  PRIMARY KEY (`ISBN`, `cpf`),
  INDEX `fk_LIVROS_has_AUTORES_AUTORES1_idx` (`cpf` ASC) ,
  INDEX `fk_LIVROS_has_AUTORES_LIVROS1_idx` (`ISBN` ASC) ,
  CONSTRAINT `fk_LIVROS_has_AUTORES_LIVROS1`
    FOREIGN KEY (`ISBN`)
    REFERENCES `equipe385116`.`LIVROS` (`ISBN`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_LIVROS_has_AUTORES_AUTORES1`
    FOREIGN KEY (`cpf`)
    REFERENCES `equipe385116`.`AUTORES` (`cpf`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `equipe385116`.`USUARIO`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `equipe385116`.`USUARIO` (
  `nome` VARCHAR(45) NOT NULL,
  `username` VARCHAR(45) NOT NULL,
  `password` VARCHAR(45) NOT NULL,
  `tipoUsuario` ENUM('tipoAl', 'tipoProf', 'tipoFunc') NOT NULL,
  `mat_aluno` INT NULL,
  `mat_siape` INT NULL,
  `mat_func` INT NULL,
  `user_end` VARCHAR(45) NOT NULL,
  `nivel_usuario` ENUM('administrador', 'bibliotecario', 'usuario') NOT NULL,
  `qntd_livros_max` INT NOT NULL,
  `qntd_livros` INT NOT NULL,
  PRIMARY KEY (`username`),
  INDEX `fk_LOGIN_ALUNOS1_idx` (`mat_aluno` ASC) ,
  INDEX `fk_LOGIN_PROFESSORES1_idx` (`mat_siape` ASC) ,
  INDEX `fk_LOGIN_FUNCIONARIOS1_idx` (`mat_func` ASC) ,
  UNIQUE INDEX `ALUNOS_mat_aluno_UNIQUE` (`mat_aluno` ASC) ,
  UNIQUE INDEX `PROFESSORES_mat_siape_UNIQUE` (`mat_siape` ASC) ,
  UNIQUE INDEX `FUNCIONARIOS_mat_func_UNIQUE` (`mat_func` ASC) ,
  UNIQUE INDEX `username_UNIQUE` (`username` ASC) ,
  CONSTRAINT `fk_LOGIN_ALUNOS1`
    FOREIGN KEY (`mat_aluno`)
    REFERENCES `equipe385116`.`ALUNOS` (`mat_aluno`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_LOGIN_PROFESSORES1`
    FOREIGN KEY (`mat_siape`)
    REFERENCES `equipe385116`.`PROFESSORES` (`mat_siape`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_LOGIN_FUNCIONARIOS1`
    FOREIGN KEY (`mat_func`)
    REFERENCES `equipe385116`.`FUNCIONARIOS` (`mat_func`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `equipe385116`.`EMPRESTIMOS`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `equipe385116`.`EMPRESTIMOS` (
  `ISBN` INT NOT NULL,
  `username` VARCHAR(45) NOT NULL,
  `data_reserva` DATE NOT NULL,
  `prazo_dev` DATE NOT NULL,
  PRIMARY KEY (`ISBN`, `username`, `data_reserva`),
  INDEX `User_idx` (`username` ASC) ,
  CONSTRAINT `isbn_LIVRO`
    FOREIGN KEY (`ISBN`)
    REFERENCES `equipe385116`.`LIVROS` (`ISBN`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `User`
    FOREIGN KEY (`username`)
    REFERENCES `equipe385116`.`USUARIO` (`username`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `equipe385116`.`RESERVA`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `equipe385116`.`RESERVA` (
  `ISBN` INT NOT NULL,
  `username` VARCHAR(45) NOT NULL,
  `data_reserva` DATE NOT NULL,
  PRIMARY KEY (`ISBN`, `username`, `data_reserva`),
  INDEX `User_idx` (`username` ASC) ,
  CONSTRAINT `isbn_LIVRO0`
    FOREIGN KEY (`ISBN`)
    REFERENCES `equipe385116`.`LIVROS` (`ISBN`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `User0`
    FOREIGN KEY (`username`)
    REFERENCES `equipe385116`.`USUARIO` (`username`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `equipe385116`.`REQUISICAO` (
  `id_req` INT NOT NULL,
  `username` VARCHAR(45) NOT NULL,
  INDEX `usernombre_idx` (`username` ASC) ,
  UNIQUE INDEX `username_UNIQUE` (`username` ASC) ,
  UNIQUE INDEX `id_req_UNIQUE` (`id_req` ASC) ,
  PRIMARY KEY (`id_req`),
  CONSTRAINT `usernombre`
    FOREIGN KEY (`username`)
    REFERENCES `equipe385116`.`USUARIO` (`username`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

-- -----------------------------------------------------
-- Data for table `equipe385116`.`CATEGORIA`
-- -----------------------------------------------------
START TRANSACTION;
USE `equipe385116`;
INSERT INTO `equipe385116`.`CATEGORIA` (`cod_categoria`, `descricao`) VALUES (1, 'Matemática');
INSERT INTO `equipe385116`.`CATEGORIA` (`cod_categoria`, `descricao`) VALUES (2, 'Física');
INSERT INTO `equipe385116`.`CATEGORIA` (`cod_categoria`, `descricao`) VALUES (3, 'Programação');
INSERT INTO `equipe385116`.`CATEGORIA` (`cod_categoria`, `descricao`) VALUES (4, 'Empreendedorismo');

COMMIT;


-- -----------------------------------------------------
-- Data for table `equipe385116`.`LIVROS`
-- -----------------------------------------------------
START TRANSACTION;
USE `equipe385116`;
INSERT INTO `equipe385116`.`LIVROS` (`ISBN`, `titulo`, `ano_lançamento`, `editora`, `qtd_copias`, `cod_categoria`, `qtd_disp`) VALUES (145623, 'Cálculo - volume 1', 2017, 'Cengage Learning', 5, 1, 4);
INSERT INTO `equipe385116`.`LIVROS` (`ISBN`, `titulo`, `ano_lançamento`, `editora`, `qtd_copias`, `cod_categoria`, `qtd_disp`) VALUES (145654, 'Cálculo - volume 2', 2017, 'Cengage Learning', 5, 1, 5);
INSERT INTO `equipe385116`.`LIVROS` (`ISBN`, `titulo`, `ano_lançamento`, `editora`, `qtd_copias`, `cod_categoria`, `qtd_disp`) VALUES (159478, 'Fundamentos de Fisica - Vol 1', 2017, 'LTC Editora', 5, 2, 4);
INSERT INTO `equipe385116`.`LIVROS` (`ISBN`, `titulo`, `ano_lançamento`, `editora`, `qtd_copias`, `cod_categoria`, `qtd_disp`) VALUES (159486, 'Fundamentos de Fisica - Vol 2', 2017, 'LTC Editora', 5, 2, 5);
INSERT INTO `equipe385116`.`LIVROS` (`ISBN`, `titulo`, `ano_lançamento`, `editora`, `qtd_copias`, `cod_categoria`, `qtd_disp`) VALUES (175624, 'Java - Como Programar', 2016, 'Pearson', 5, 3, 3);
INSERT INTO `equipe385116`.`LIVROS` (`ISBN`, `titulo`, `ano_lançamento`, `editora`, `qtd_copias`, `cod_categoria`, `qtd_disp`) VALUES (187456, 'O monge e o Executivo', 1989, 'Sextante / Gmt', 5, 4, 3);

COMMIT;


-- -----------------------------------------------------
-- Data for table `equipe385116`.`AUTORES`
-- -----------------------------------------------------
START TRANSACTION;
USE `equipe385116`;
INSERT INTO `equipe385116`.`AUTORES` (`nome_autor`, `cpf`, `nacionalidade`) VALUES ('James Stewart', '11111111111', 'Canadense');
INSERT INTO `equipe385116`.`AUTORES` (`nome_autor`, `cpf`, `nacionalidade`) VALUES ('Robert Resnick', '22222222222', 'Estados Unidos');
INSERT INTO `equipe385116`.`AUTORES` (`nome_autor`, `cpf`, `nacionalidade`) VALUES ('Jearl Walker', '33333333333', 'Estados Unidos');
INSERT INTO `equipe385116`.`AUTORES` (`nome_autor`, `cpf`, `nacionalidade`) VALUES ('H. M Deitel', '44444444444', 'Estados Unidos');
INSERT INTO `equipe385116`.`AUTORES` (`nome_autor`, `cpf`, `nacionalidade`) VALUES ('James C. Hunter', '55555555555', 'Estados Unidos');

COMMIT;


-- -----------------------------------------------------
-- Data for table `equipe385116`.`CURSO`
-- -----------------------------------------------------
START TRANSACTION;
USE `equipe385116`;
INSERT INTO `equipe385116`.`CURSO` (`cod_curso`, `nome_curso`) VALUES ('1', 'Medicina');
INSERT INTO `equipe385116`.`CURSO` (`cod_curso`, `nome_curso`) VALUES ('2', 'Engenharia');
INSERT INTO `equipe385116`.`CURSO` (`cod_curso`, `nome_curso`) VALUES ('3', 'Economia');

COMMIT;


-- -----------------------------------------------------
-- Data for table `equipe385116`.`ALUNOS`
-- -----------------------------------------------------
START TRANSACTION;
USE `equipe385116`;
INSERT INTO `equipe385116`.`ALUNOS` (`mat_aluno`, `cod_curso`, `data_de_ingresso`, `data_de_conclusao_prev`, `tipoAl`) VALUES (123, '1', '2016-03-13', '2021-12-03', 1);
INSERT INTO `equipe385116`.`ALUNOS` (`mat_aluno`, `cod_curso`, `data_de_ingresso`, `data_de_conclusao_prev`, `tipoAl`) VALUES (001, '2', '2015-08-15', '2020-07-16', 1);

COMMIT;


-- -----------------------------------------------------
-- Data for table `equipe385116`.`FONE_ALUNOS`
-- -----------------------------------------------------
START TRANSACTION;
USE `equipe385116`;
INSERT INTO `equipe385116`.`FONE_ALUNOS` (`fone_aluno`, `mat_aluno`) VALUES ('8599779955', 123);
INSERT INTO `equipe385116`.`FONE_ALUNOS` (`fone_aluno`, `mat_aluno`) VALUES ('8899886655', 123);
INSERT INTO `equipe385116`.`FONE_ALUNOS` (`fone_aluno`, `mat_aluno`) VALUES ('8594613265', 001);

COMMIT;


-- -----------------------------------------------------
-- Data for table `equipe385116`.`PROFESSORES`
-- -----------------------------------------------------
START TRANSACTION;
USE `equipe385116`;
INSERT INTO `equipe385116`.`PROFESSORES` (`mat_siape`, `regime_trabalho`, `cod_curso`, `data_de_contratacao`, `telefone_celular`, `tipoProf`) VALUES (555, '20h', '2', 2010, '0889123456', 3);

COMMIT;


-- -----------------------------------------------------
-- Data for table `equipe385116`.`FUNCIONARIOS`
-- -----------------------------------------------------
START TRANSACTION;
USE `equipe385116`;
INSERT INTO `equipe385116`.`FUNCIONARIOS` (`mat_func`, `tipoFunc`) VALUES (000, 2);
INSERT INTO `equipe385116`.`FUNCIONARIOS` (`mat_func`, `tipoFunc`) VALUES (456789, 2);

COMMIT;


-- -----------------------------------------------------
-- Data for table `equipe385116`.`FONE_FUNC`
-- -----------------------------------------------------
START TRANSACTION;
USE `equipe385116`;
INSERT INTO `equipe385116`.`FONE_FUNC` (`fone_func`, `mat_func`) VALUES ('0000000000', 000);
INSERT INTO `equipe385116`.`FONE_FUNC` (`fone_func`, `mat_func`) VALUES ('0859123456', 456789);
INSERT INTO `equipe385116`.`FONE_FUNC` (`fone_func`, `mat_func`) VALUES ('0869123456', 456789);

COMMIT;


-- -----------------------------------------------------
-- Data for table `equipe385116`.`LIVROS_has_AUTORES`
-- -----------------------------------------------------
START TRANSACTION;
USE `equipe385116`;
INSERT INTO `equipe385116`.`LIVROS_has_AUTORES` (`ISBN`, `cpf`) VALUES (145623, '11111111111');
INSERT INTO `equipe385116`.`LIVROS_has_AUTORES` (`ISBN`, `cpf`) VALUES (145654, '11111111111');
INSERT INTO `equipe385116`.`LIVROS_has_AUTORES` (`ISBN`, `cpf`) VALUES (159478, '22222222222');
INSERT INTO `equipe385116`.`LIVROS_has_AUTORES` (`ISBN`, `cpf`) VALUES (159478, '33333333333');
INSERT INTO `equipe385116`.`LIVROS_has_AUTORES` (`ISBN`, `cpf`) VALUES (159486, '22222222222');
INSERT INTO `equipe385116`.`LIVROS_has_AUTORES` (`ISBN`, `cpf`) VALUES (159486, '33333333333');
INSERT INTO `equipe385116`.`LIVROS_has_AUTORES` (`ISBN`, `cpf`) VALUES (175624, '44444444444');
INSERT INTO `equipe385116`.`LIVROS_has_AUTORES` (`ISBN`, `cpf`) VALUES (187456, '55555555555');

COMMIT;


-- -----------------------------------------------------
-- Data for table `equipe385116`.`USUARIO`
-- -----------------------------------------------------
START TRANSACTION;
USE `equipe385116`;
INSERT INTO `equipe385116`.`USUARIO` (`nome`, `username`, `password`, `tipoUsuario`, `mat_aluno`, `mat_siape`, `mat_func`, `user_end`, `nivel_usuario`, `qntd_livros_max`, `qntd_livros`) VALUES ('Administrador', 'admin', sha1('root'), 'tipoFunc', null, NULL, 000, 'Rua um, 1.', 'administrador', 4, 0);
INSERT INTO `equipe385116`.`USUARIO` (`nome`, `username`, `password`, `tipoUsuario`, `mat_aluno`, `mat_siape`, `mat_func`, `user_end`, `nivel_usuario`, `qntd_livros_max`, `qntd_livros`) VALUES ('Ítalo Barros', 'italobarros', sha1('italo123'), 'tipoAl', 123, null, NULL, 'Rua dois, 2', 'usuario', 3, 3);
INSERT INTO `equipe385116`.`USUARIO` (`nome`, `username`, `password`, `tipoUsuario`, `mat_aluno`, `mat_siape`, `mat_func`, `user_end`, `nivel_usuario`, `qntd_livros_max`, `qntd_livros`) VALUES ('Renan Cardoso', 'renao', sha1('renan123'), 'tipoFunc', null, NULL, 456789, 'Rua tres, 3', 'bibliotecario', 4, 1);
INSERT INTO `equipe385116`.`USUARIO` (`nome`, `username`, `password`, `tipoUsuario`, `mat_aluno`, `mat_siape`, `mat_func`, `user_end`, `nivel_usuario`, `qntd_livros_max`, `qntd_livros`) VALUES ('Murilo Andrade', 'mumu', sha1('mumu123'), 'tipoProf', null, 555, NULL, 'Rua quatro, 4', 'usuario', 5, 2);
INSERT INTO `equipe385116`.`USUARIO` (`nome`, `username`, `password`, `tipoUsuario`, `mat_aluno`, `mat_siape`, `mat_func`, `user_end`, `nivel_usuario`, `qntd_livros_max`, `qntd_livros`) VALUES ('Expedito Magalhães', 'expdito', sha1('exp123'), 'tipoAl', 001, NULL, NULL, 'Rua cinco, 5', 'usuario', 4, 0);

COMMIT;


-- -----------------------------------------------------
-- Data for table `equipe385116`.`EMPRESTIMOS`
-- -----------------------------------------------------
START TRANSACTION;
USE `equipe385116`;
INSERT INTO `equipe385116`.`EMPRESTIMOS` (`ISBN`, `username`, `data_reserva`, `prazo_dev`) VALUES (145623, 'italobarros', '2018-10-10', '2018-10-25');
INSERT INTO `equipe385116`.`EMPRESTIMOS` (`ISBN`, `username`, `data_reserva`, `prazo_dev`) VALUES (187456, 'renao', '2018-10-15', '2018-11-10');
INSERT INTO `equipe385116`.`EMPRESTIMOS` (`ISBN`, `username`, `data_reserva`, `prazo_dev`) VALUES (187456, 'mumu', '2018-10-30', '2018-11-30');
INSERT INTO `equipe385116`.`EMPRESTIMOS` (`ISBN`, `username`, `data_reserva`, `prazo_dev`) VALUES (175624, 'mumu', '2018-09-30', '2018-10-30');
INSERT INTO `equipe385116`.`EMPRESTIMOS` (`ISBN`, `username`, `data_reserva`, `prazo_dev`) VALUES (159478, 'italobarros', '2018-10-06', '2018-10-21');
INSERT INTO `equipe385116`.`EMPRESTIMOS` (`ISBN`, `username`, `data_reserva`, `prazo_dev`) VALUES (175624, 'italobarros', '2018-10-31', '2018-11-15');

COMMIT;

START TRANSACTION;
USE `equipe385116`;
INSERT INTO `equipe385116`.`REQUISICAO` (`id_req`, `username`) VALUES (001, 'expdito');

COMMIT;
