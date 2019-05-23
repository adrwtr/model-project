/*
 Navicat Premium Data Transfer

 Source Server         : localhost
 Source Server Type    : MySQL
 Source Server Version : 50552
 Source Host           : localhost:3306
 Source Schema         : modelproj

 Target Server Type    : MySQL
 Target Server Version : 50552
 File Encoding         : 65001

 Date: 23/05/2019 14:44:24
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for campo
-- ----------------------------
DROP TABLE IF EXISTS `campo`;
CREATE TABLE `campo`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tabela_id` int(11) NULL DEFAULT NULL,
  `ds_nome` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `ds_prop` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `sn_pk` tinyint(1) NOT NULL,
  `ds_descricao` longtext CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `nr_ordem` int(11) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `IDX_291737AA554FF37F`(`tabela_id`) USING BTREE,
  CONSTRAINT `FK_291737AA554FF37F` FOREIGN KEY (`tabela_id`) REFERENCES `tabela` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 763 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of campo
-- ----------------------------
INSERT INTO `campo` VALUES (1, 6, 'id', 'bigint(10) NOT NULL AUTO_INCREMENT', 1, '', 0);
INSERT INTO `campo` VALUES (2, 6, 'status', 'bigint(10) NOT NULL DEFAULT \'0\'', 0, '0 -> Ativo\n1 -> Inativo', 1);
INSERT INTO `campo` VALUES (3, 6, 'enrolid', 'bigint(10) NOT NULL', 0, '', 2);
INSERT INTO `campo` VALUES (4, 6, 'userid', 'bigint(10) NOT NULL', 0, '', 3);
INSERT INTO `campo` VALUES (5, 6, 'timestart', 'bigint(10) NOT NULL DEFAULT \'0\'', 0, '', 4);
INSERT INTO `campo` VALUES (6, 6, 'timeend', 'bigint(10) NOT NULL DEFAULT \'2147483647\'', 0, '', 5);
INSERT INTO `campo` VALUES (7, 6, 'modifierid', 'bigint(10) NOT NULL DEFAULT \'0\'', 0, '', 6);
INSERT INTO `campo` VALUES (8, 6, 'timecreated', 'bigint(10) NOT NULL DEFAULT \'0\'', 0, '', 7);
INSERT INTO `campo` VALUES (9, 6, 'timemodified', 'bigint(10) NOT NULL DEFAULT \'0\'', 0, '', 8);
INSERT INTO `campo` VALUES (10, 2, 'id', 'bigint(10)', 1, '', 0);
INSERT INTO `campo` VALUES (11, 2, 'auth', 'varchar(20)', 0, '', 1);
INSERT INTO `campo` VALUES (12, 2, 'username', 'varchar(100)', 0, '', 2);
INSERT INTO `campo` VALUES (13, 2, 'password', 'varchar(255)', 0, '', 3);
INSERT INTO `campo` VALUES (14, 2, 'idnumber', 'varchar(255)', 0, '', 4);
INSERT INTO `campo` VALUES (15, 2, 'firstname', 'varchar(255)', 0, '', 5);
INSERT INTO `campo` VALUES (16, 2, 'lastname', 'varchar(255)', 0, '', 6);
INSERT INTO `campo` VALUES (17, 2, 'email', 'varchar(255)', 0, '', 7);
INSERT INTO `campo` VALUES (18, 3, 'id', 'bigint(10)', 1, '', 0);
INSERT INTO `campo` VALUES (19, 3, 'category', 'bigint(10)', 0, 'O Curso pode pertencer a uma categoria', 1);
INSERT INTO `campo` VALUES (20, 3, 'fullname', 'varchar(254)', 0, '', 2);
INSERT INTO `campo` VALUES (21, 3, 'shortname', 'varchar(255)', 0, '', 3);
INSERT INTO `campo` VALUES (22, 3, 'idnumber', 'varchar(255)', 0, 'Ligação com sistemas externos. CD_MOODLE_CURSO do UNIMESTRE fica aqui.', 4);
INSERT INTO `campo` VALUES (23, 4, 'id', 'bigint(10)', 1, '', 0);
INSERT INTO `campo` VALUES (24, 4, 'courseid', 'bigint(10)', 0, '', 1);
INSERT INTO `campo` VALUES (25, 4, 'idnumber', 'varchar(255)', 0, 'Ligação com outros sistemas', 2);
INSERT INTO `campo` VALUES (26, 4, 'name', 'varchar(255)', 0, '', 3);
INSERT INTO `campo` VALUES (27, 4, 'description', 'longtext', 0, '', 4);
INSERT INTO `campo` VALUES (32, 5, 'id', 'bigint(10)', 1, '', 0);
INSERT INTO `campo` VALUES (33, 5, 'enrol', 'varchar(20)', 0, 'Forma que a matricula será feita. Exemplo: pelo sistema, manual. etc', 1);
INSERT INTO `campo` VALUES (34, 5, 'status', 'bigint(10)', 0, '', 2);
INSERT INTO `campo` VALUES (35, 5, 'courseid', 'bigint(10)', 0, '', 3);
INSERT INTO `campo` VALUES (36, 7, 'cd_log', 'bigint(255) NOT NULL AUTO_INCREMENT', 1, '', 0);
INSERT INTO `campo` VALUES (37, 7, 'ds_url', 'varchar(255) DEFAULT NULL', 0, '', 1);
INSERT INTO `campo` VALUES (38, 7, 'ds_url_parametros', 'varchar(255) DEFAULT NULL', 0, '', 2);
INSERT INTO `campo` VALUES (39, 7, 'ds_headers', 'text', 0, '', 3);
INSERT INTO `campo` VALUES (40, 7, 'ds_body_enviado', 'text', 0, 'A requisição completa', 4);
INSERT INTO `campo` VALUES (41, 7, 'ds_resultado', 'text', 0, 'Possível resultado da requisição', 5);
INSERT INTO `campo` VALUES (42, 7, 'dt_base', 'timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP', 0, '', 6);
INSERT INTO `campo` VALUES (43, 8, 'cd_log', 'bigint(255) NOT NULL AUTO_INCREMENT', 1, '', 0);
INSERT INTO `campo` VALUES (44, 8, 'ds_url', 'text', 0, '', 1);
INSERT INTO `campo` VALUES (45, 8, 'ds_url_parametros', 'text', 0, '', 2);
INSERT INTO `campo` VALUES (46, 8, 'ds_headers', 'text', 0, '', 3);
INSERT INTO `campo` VALUES (47, 8, 'ds_body_enviado', 'text', 0, 'Corpo da API enviado - body', 4);
INSERT INTO `campo` VALUES (48, 8, 'ds_resultado', 'text', 0, 'O resultado não é salvo automaticamente, o programador precisa programar para que isso ocorra', 5);
INSERT INTO `campo` VALUES (49, 8, 'dt_base', 'timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP', 0, '', 6);
INSERT INTO `campo` VALUES (50, 9, 'cd_mensalidade', 'int(11)', 1, '', 0);
INSERT INTO `campo` VALUES (51, 9, 'codigoaluno', 'int(11)', 0, '', 1);
INSERT INTO `campo` VALUES (52, 9, 'cd_tipo_titulo', 'smallint(6)', 0, 'Ligação com fin_tipos_titulo', 2);
INSERT INTO `campo` VALUES (53, 9, 'parcela', 'smallint(6)', 0, 'Número da parcela - caso tenha sido gerado vários titulos ao mesmo tempo ou uma sequência de títulos. Controlado por regra de negócio.', 3);
INSERT INTO `campo` VALUES (54, 9, 'datavencimento', 'datetime', 0, '', 4);
INSERT INTO `campo` VALUES (55, 9, 'dt_competencia', 'datetime', 0, '', 5);
INSERT INTO `campo` VALUES (56, 9, 'turma', 'varchar(50)', 0, 'Código da turma padrão UNIMESTRE', 6);
INSERT INTO `campo` VALUES (57, 9, 'dataemissao', 'datetime', 0, '', 7);
INSERT INTO `campo` VALUES (58, 9, 'nossonumero', 'varchar(30)', 0, 'Número para geração do boleto bancário', 8);
INSERT INTO `campo` VALUES (59, 9, 'valorbruto', 'double(11,2)', 0, 'Valor original e inicial do título', 9);
INSERT INTO `campo` VALUES (60, 9, 'valordesconto', 'double', 0, 'Valor a ser descontado', 10);
INSERT INTO `campo` VALUES (61, 9, 'descontoextra', 'double', 0, 'Valor a ser descontado', 11);
INSERT INTO `campo` VALUES (62, 9, 'valorextra', 'double', 0, 'valor a ser acrescido', 12);
INSERT INTO `campo` VALUES (63, 9, 'VALORTOTAL', 'double(15,2)', 0, 'Valor total a ser pago - [\'valorbruto\'] +[\'valorextra\'] +[\'valorjuros\'] - [\'descontoextra\'] - [\'valordesconto\']', 13);
INSERT INTO `campo` VALUES (64, 9, 'valorjuros', 'double', 0, 'valor a ser acrescido', 14);
INSERT INTO `campo` VALUES (65, 9, 'valorpago', 'double', 0, 'Quanto foi pago pelo usuário - podendo ser diferente do valor do título.', 15);
INSERT INTO `campo` VALUES (66, 9, 'datapagamento', 'datetime', 0, '', 16);
INSERT INTO `campo` VALUES (67, 9, 'situacao', 'smallint(6)', 0, 'Indica como o titulo foi pago. Tabela situacoes_financeiras', 17);
INSERT INTO `campo` VALUES (68, 9, 'curso', 'varchar(15)', 0, '', 18);
INSERT INTO `campo` VALUES (69, 9, 'depto', 'smallint(6)', 0, '', 19);
INSERT INTO `campo` VALUES (70, 10, 'cd_pessoa', 'int(11) NOT NULL', 1, '', 0);
INSERT INTO `campo` VALUES (71, 10, 'cd_resp_finan', 'int(11) DEFAULT NULL', 0, 'Responsável financeiro', 1);
INSERT INTO `campo` VALUES (72, 10, 'cd_resp_acad', 'int(11) DEFAULT NULL', 0, 'Responsável acadêmico', 2);
INSERT INTO `campo` VALUES (73, 10, 'cd_mae', 'int(11) unsigned DEFAULT NULL', 0, '', 3);
INSERT INTO `campo` VALUES (74, 10, 'cd_pai', 'int(11) unsigned DEFAULT NULL', 0, '', 4);
INSERT INTO `campo` VALUES (75, 10, 'nm_pessoa', 'varchar(60) DEFAULT NULL', 0, '', 5);
INSERT INTO `campo` VALUES (76, 10, 'nm_contato', 'varchar(100) DEFAULT NULL', 0, '', 6);
INSERT INTO `campo` VALUES (77, 10, 'dt_nascimento', 'datetime DEFAULT NULL', 0, '', 7);
INSERT INTO `campo` VALUES (78, 10, 'ds_cidade_nascimento', 'varchar(50) DEFAULT NULL', 0, '', 8);
INSERT INTO `campo` VALUES (79, 10, 'cd_municipio', 'int(10) unsigned DEFAULT NULL', 0, '', 9);
INSERT INTO `campo` VALUES (80, 10, 'ds_estado_nascimento', 'char(3) DEFAULT NULL', 0, '', 10);
INSERT INTO `campo` VALUES (81, 10, 'ds_pais_nascimento', 'varchar(50) DEFAULT NULL', 0, '', 11);
INSERT INTO `campo` VALUES (82, 10, 'cd_pais', 'int(10) unsigned DEFAULT NULL', 0, '', 12);
INSERT INTO `campo` VALUES (83, 10, 'cd_pais_nascimento', 'int(11) unsigned DEFAULT NULL', 0, '', 13);
INSERT INTO `campo` VALUES (84, 10, 'cd_logradouro', 'int(10) unsigned DEFAULT NULL', 0, '', 14);
INSERT INTO `campo` VALUES (85, 10, 'ds_logradouro', 'varchar(150) DEFAULT NULL', 0, '', 15);
INSERT INTO `campo` VALUES (86, 10, 'ds_logradouro_nro', 'varchar(10) DEFAULT NULL', 0, '', 16);
INSERT INTO `campo` VALUES (87, 10, 'ds_complemento', 'varchar(150) DEFAULT NULL', 0, '', 17);
INSERT INTO `campo` VALUES (88, 10, 'ds_cep', 'varchar(8) DEFAULT NULL', 0, '', 18);
INSERT INTO `campo` VALUES (89, 10, 'ds_bairro', 'varchar(50) DEFAULT NULL', 0, '', 19);
INSERT INTO `campo` VALUES (90, 10, 'ds_cidade', 'varchar(50) DEFAULT NULL', 0, '', 20);
INSERT INTO `campo` VALUES (91, 10, 'ds_estado', 'char(3) DEFAULT NULL', 0, '', 21);
INSERT INTO `campo` VALUES (92, 10, 'ds_pais', 'varchar(50) DEFAULT NULL', 0, '', 22);
INSERT INTO `campo` VALUES (93, 10, 'ds_sexo', 'char(1) DEFAULT NULL', 0, '', 23);
INSERT INTO `campo` VALUES (94, 10, 'ds_nacionalidade', 'varchar(50) DEFAULT NULL', 0, '', 24);
INSERT INTO `campo` VALUES (95, 10, 'ds_identidade', 'varchar(20) DEFAULT NULL', 0, '', 25);
INSERT INTO `campo` VALUES (96, 10, 'cd_orgao_emissor', 'int(10) unsigned DEFAULT NULL', 0, '', 26);
INSERT INTO `campo` VALUES (97, 10, 'ds_identidade_orgao_exp', 'varchar(50) DEFAULT NULL', 0, '', 27);
INSERT INTO `campo` VALUES (98, 10, 'dt_identidade_expedicao', 'datetime DEFAULT NULL', 0, '', 28);
INSERT INTO `campo` VALUES (99, 10, 'ds_cpf', 'varchar(15) DEFAULT NULL', 0, '', 29);
INSERT INTO `campo` VALUES (100, 10, 'ds_rm_corporacao', 'varchar(20) DEFAULT NULL', 0, '', 30);
INSERT INTO `campo` VALUES (101, 10, 'nr_dia_vencimento', 'int(2) unsigned DEFAULT NULL', 0, '', 31);
INSERT INTO `campo` VALUES (102, 10, 'sn_nao_bloquear_financeiro', 'tinyint(1) unsigned DEFAULT \'0\'', 0, '', 32);
INSERT INTO `campo` VALUES (103, 10, 'ds_rm_org_numero', 'varchar(20) DEFAULT NULL', 0, '', 33);
INSERT INTO `campo` VALUES (104, 10, 'dt_rm_exp', 'datetime DEFAULT NULL', 0, '', 34);
INSERT INTO `campo` VALUES (105, 10, 'ds_rm_doc_numero', 'varchar(20) DEFAULT NULL', 0, '', 35);
INSERT INTO `campo` VALUES (106, 10, 'ds_rm_orgao', 'varchar(20) DEFAULT NULL', 0, '', 36);
INSERT INTO `campo` VALUES (107, 10, 'ds_rm_doc_tipo', 'varchar(60) DEFAULT NULL', 0, '', 37);
INSERT INTO `campo` VALUES (108, 10, 'ds_titulo_numero', 'varchar(20) DEFAULT NULL', 0, '', 38);
INSERT INTO `campo` VALUES (109, 10, 'ds_titulo_secao', 'varchar(10) DEFAULT NULL', 0, '', 39);
INSERT INTO `campo` VALUES (110, 10, 'ds_titulo_zona', 'varchar(10) DEFAULT NULL', 0, '', 40);
INSERT INTO `campo` VALUES (111, 10, 'dt_titulo_emissao', 'datetime DEFAULT NULL', 0, '', 41);
INSERT INTO `campo` VALUES (112, 10, 'nm_pai', 'varchar(80) DEFAULT NULL', 0, '', 42);
INSERT INTO `campo` VALUES (113, 10, 'nm_mae', 'varchar(80) DEFAULT NULL', 0, '', 43);
INSERT INTO `campo` VALUES (114, 10, 'cd_estado_civil', 'smallint(6) DEFAULT NULL', 0, '', 44);
INSERT INTO `campo` VALUES (115, 10, 'ds_estado_civil', 'char(1) DEFAULT NULL', 0, '', 45);
INSERT INTO `campo` VALUES (116, 10, 'nm_conjuge', 'varchar(80) DEFAULT NULL', 0, '', 46);
INSERT INTO `campo` VALUES (117, 10, 'cd_usuario', 'int(11) DEFAULT NULL', 0, '', 47);
INSERT INTO `campo` VALUES (118, 10, 'dt_revisao', 'datetime DEFAULT NULL', 0, '', 48);
INSERT INTO `campo` VALUES (119, 10, 'cd_pessoa_alteracao', 'int(10) unsigned DEFAULT NULL', 0, '', 49);
INSERT INTO `campo` VALUES (120, 10, 'dt_cadastro', 'datetime DEFAULT NULL', 0, '', 50);
INSERT INTO `campo` VALUES (121, 10, 'nm_sem_acento', 'varchar(80) DEFAULT NULL', 0, '', 51);
INSERT INTO `campo` VALUES (122, 10, 'ds_arquivo_documento', 'varchar(100) DEFAULT NULL', 0, '', 52);
INSERT INTO `campo` VALUES (123, 10, 'cd_empresa', 'int(11) DEFAULT NULL', 0, '', 53);
INSERT INTO `campo` VALUES (124, 10, 'ds_cargo', 'varchar(80) DEFAULT NULL', 0, '', 54);
INSERT INTO `campo` VALUES (125, 10, 'ds_observacao', 'mediumtext', 0, '', 55);
INSERT INTO `campo` VALUES (126, 10, 'ds_login', 'varchar(100) DEFAULT NULL', 0, '', 56);
INSERT INTO `campo` VALUES (127, 10, 'ds_senha', 'varchar(32) DEFAULT NULL', 0, '', 57);
INSERT INTO `campo` VALUES (128, 10, 'ds_senha_md4', 'varchar(32) DEFAULT NULL', 0, '', 58);
INSERT INTO `campo` VALUES (129, 10, 'sn_senha_provisoria', 'char(1) DEFAULT NULL', 0, '', 59);
INSERT INTO `campo` VALUES (130, 10, 'sn_bloqueto_empresa', 'char(1) DEFAULT \'N\'', 0, '', 60);
INSERT INTO `campo` VALUES (131, 10, 'im_pessoa', 'mediumblob', 0, '', 61);
INSERT INTO `campo` VALUES (132, 10, 'sn_foto_publica', 'char(1) DEFAULT \'S\'', 0, '', 62);
INSERT INTO `campo` VALUES (133, 10, 'sn_pai', 'char(1) DEFAULT \'N\'', 0, '', 63);
INSERT INTO `campo` VALUES (134, 10, 'sn_mae', 'char(1) DEFAULT \'N\'', 0, '', 64);
INSERT INTO `campo` VALUES (135, 10, 'tp_pessoa', 'char(1) DEFAULT \'F\'', 0, '', 65);
INSERT INTO `campo` VALUES (136, 10, 'ds_cnpj', 'varchar(14) DEFAULT NULL', 0, '', 66);
INSERT INTO `campo` VALUES (137, 10, 'ds_inscri_estadual', 'varchar(50) DEFAULT NULL', 0, '', 67);
INSERT INTO `campo` VALUES (138, 10, 'tp_cert', 'tinyint(1) unsigned DEFAULT \'0\'', 0, '', 68);
INSERT INTO `campo` VALUES (139, 10, 'nr_cert_termo', 'varchar(50) DEFAULT NULL', 0, '', 69);
INSERT INTO `campo` VALUES (140, 10, 'ds_cert_folha', 'varchar(8) DEFAULT NULL', 0, '', 70);
INSERT INTO `campo` VALUES (141, 10, 'ds_cert_livro', 'varchar(8) DEFAULT NULL', 0, '', 71);
INSERT INTO `campo` VALUES (142, 10, 'dt_cert', 'datetime DEFAULT NULL', 0, '', 72);
INSERT INTO `campo` VALUES (143, 10, 'ds_cert_uf', 'char(3) DEFAULT NULL', 0, '', 73);
INSERT INTO `campo` VALUES (144, 10, 'ds_cert_orgao', 'varchar(100) DEFAULT NULL', 0, '', 74);
INSERT INTO `campo` VALUES (145, 10, 'cd_municipio_nasc', 'int(10) unsigned DEFAULT NULL', 0, '', 75);
INSERT INTO `campo` VALUES (146, 10, 'nr_praca', 'int(11) unsigned DEFAULT NULL', 0, '', 76);
INSERT INTO `campo` VALUES (147, 10, 'cd_estado_nascimento', 'smallint(6) DEFAULT NULL', 0, '', 77);
INSERT INTO `campo` VALUES (148, 10, 'cd_estado', 'int(11) unsigned DEFAULT NULL', 0, '', 78);
INSERT INTO `campo` VALUES (149, 10, 'cd_convenio', 'int(10) unsigned NOT NULL DEFAULT \'0\'', 0, '', 79);
INSERT INTO `campo` VALUES (150, 10, 'sn_pai_resp', 'tinyint(1) unsigned NOT NULL DEFAULT \'1\'', 0, '', 80);
INSERT INTO `campo` VALUES (151, 10, 'sn_mae_resp', 'tinyint(1) unsigned NOT NULL DEFAULT \'1\'', 0, '', 81);
INSERT INTO `campo` VALUES (152, 10, 'cd_cert_uf', 'smallint(6) DEFAULT NULL', 0, '', 82);
INSERT INTO `campo` VALUES (153, 10, 'cd_localidade', 'int(11) DEFAULT NULL', 0, '', 83);
INSERT INTO `campo` VALUES (154, 10, 'cd_localidade_nasc', 'int(11) DEFAULT NULL', 0, '', 84);
INSERT INTO `campo` VALUES (155, 10, 'sn_pais_como_resp', 'tinyint(1) unsigned NOT NULL DEFAULT \'1\'', 0, '', 85);
INSERT INTO `campo` VALUES (156, 10, 'sn_obito', 'tinyint(1) unsigned NOT NULL DEFAULT \'0\'', 0, '', 86);
INSERT INTO `campo` VALUES (157, 10, 'sn_requerimentos_email', 'char(1) DEFAULT \'S\'', 0, '', 87);
INSERT INTO `campo` VALUES (158, 10, 'cd_instituicao_ensino', 'smallint(6) DEFAULT NULL', 0, '', 88);
INSERT INTO `campo` VALUES (159, 10, 'cd_raca', 'smallint(6) DEFAULT NULL COMMENT \'Busca da tabela de situacoes\'', 0, '', 89);
INSERT INTO `campo` VALUES (160, 10, 'cd_mec', 'varchar(30) DEFAULT NULL', 0, '', 90);
INSERT INTO `campo` VALUES (161, 10, 'sn_foto', 'char(1) DEFAULT \'S\'', 0, '', 91);
INSERT INTO `campo` VALUES (162, 10, 'sn_bloqueado', 'smallint(1) DEFAULT \'0\'', 0, '', 92);
INSERT INTO `campo` VALUES (163, 10, 'cd_usuario_pessoa', 'int(11) unsigned DEFAULT NULL', 0, '', 93);
INSERT INTO `campo` VALUES (164, 10, 'ds_inscri_municipal', 'varchar(50) DEFAULT NULL', 0, '', 94);
INSERT INTO `campo` VALUES (165, 10, 'cd_bairro', 'int(11) DEFAULT NULL', 0, '', 95);
INSERT INTO `campo` VALUES (166, 10, 'sn_bloq_cartas', 'tinyint(1) DEFAULT NULL', 0, '', 96);
INSERT INTO `campo` VALUES (167, 10, 'sn_bloq_emails', 'tinyint(1) DEFAULT NULL', 0, '', 97);
INSERT INTO `campo` VALUES (168, 10, 'sn_naturalizado', 'tinyint(1) DEFAULT NULL', 0, '', 98);
INSERT INTO `campo` VALUES (169, 10, 'dt_identidade_expiracao', 'datetime DEFAULT NULL', 0, '', 99);
INSERT INTO `campo` VALUES (170, 10, 'ds_matricula', 'varchar(40) DEFAULT NULL', 0, '', 100);
INSERT INTO `campo` VALUES (171, 10, 'sn_pode_retirar_material', 'tinyint(1) DEFAULT \'0\'', 0, '', 101);
INSERT INTO `campo` VALUES (172, 10, 'ds_passaporte', 'varchar(50) DEFAULT NULL', 0, '', 102);
INSERT INTO `campo` VALUES (173, 10, 'ds_forma_conheceu', 'varchar(255) DEFAULT NULL', 0, '', 103);
INSERT INTO `campo` VALUES (174, 10, 'ds_formacao_academica', 'varchar(255) DEFAULT NULL', 0, '', 104);
INSERT INTO `campo` VALUES (175, 10, 'nm_pessoa_oficial', 'varchar(60) DEFAULT NULL', 0, '', 105);
INSERT INTO `campo` VALUES (176, 10, 'sn_nome_social', 'tinyint(4) NOT NULL DEFAULT \'0\'', 0, '', 106);
INSERT INTO `campo` VALUES (177, 10, 'ds_profissao', 'varchar(255) DEFAULT NULL', 0, '', 107);
INSERT INTO `campo` VALUES (178, 10, 'ds_local_trabalho', 'varchar(255) DEFAULT NULL', 0, '', 108);
INSERT INTO `campo` VALUES (179, 10, 'dt_base', 'timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP', 0, '', 109);
INSERT INTO `campo` VALUES (180, 10, 'sn_fornecedor', 'tinyint(4) DEFAULT \'0\'', 0, '', 110);
INSERT INTO `campo` VALUES (188, 12, 'ds_variavel', 'varchar(50) NOT NULL DEFAULT \'\'', 1, '', 0);
INSERT INTO `campo` VALUES (189, 12, 'ds_valor', 'mediumtext', 0, '', 1);
INSERT INTO `campo` VALUES (190, 12, 'sn_restrito', 'char(1) DEFAULT \'N\'', 0, '', 2);
INSERT INTO `campo` VALUES (191, 12, 'ds_variavel_usuario', 'mediumtext', 0, '', 3);
INSERT INTO `campo` VALUES (192, 12, 'cd_categoria', 'int(11) DEFAULT \'0\'', 0, '', 4);
INSERT INTO `campo` VALUES (193, 12, 'cd_tipo', 'tinyint(1) NOT NULL DEFAULT \'0\'', 0, '', 5);
INSERT INTO `campo` VALUES (194, 12, 'cd_coligada', 'smallint(6) NOT NULL DEFAULT \'0\'', 0, '', 6);
INSERT INTO `campo` VALUES (195, 13, 'cd_grupo', 'int(11) NOT NULL AUTO_INCREMENT', 1, '', 0);
INSERT INTO `campo` VALUES (196, 13, 'ds_nome_grupo', 'varchar(50) NOT NULL DEFAULT \'\'', 0, '', 1);
INSERT INTO `campo` VALUES (197, 13, 'sn_bloqueado', 'tinyint(1) NOT NULL DEFAULT \'0\'', 0, '', 2);
INSERT INTO `campo` VALUES (198, 13, 'sn_fixo', 'tinyint(1) NOT NULL DEFAULT \'0\'', 0, '', 3);
INSERT INTO `campo` VALUES (199, 13, 'cd_pessoa', 'int(11) DEFAULT NULL', 0, '', 4);
INSERT INTO `campo` VALUES (200, 13, 'ds_papel', 'varchar(50) DEFAULT NULL', 0, 'Informa o papel do grupo no sistema. Utilizado para buscar permissões.', 5);
INSERT INTO `campo` VALUES (201, 13, 'cd_menu_inicial', 'int(11) DEFAULT NULL', 0, '', 6);
INSERT INTO `campo` VALUES (202, 14, 'ds_papel', 'varchar(50)', 1, 'ADMIN - ALUNO - PROFESSOR', 0);
INSERT INTO `campo` VALUES (203, 14, 'ds_nome_grupo', 'varchar(50)', 0, '', 1);
INSERT INTO `campo` VALUES (204, 14, 'ds_observacao', 'varchar(255)', 0, '', 2);
INSERT INTO `campo` VALUES (205, 15, 'cd_coligada', 'smallint(6) unsigned NOT NULL AUTO_INCREMENT', 1, '', 0);
INSERT INTO `campo` VALUES (206, 15, 'nm_coligada', 'varchar(255) DEFAULT NULL', 0, '', 1);
INSERT INTO `campo` VALUES (207, 15, 'nm_razao_social', 'varchar(100) DEFAULT NULL', 0, '', 2);
INSERT INTO `campo` VALUES (208, 15, 'ds_cnpj', 'varchar(20) DEFAULT NULL', 0, '', 3);
INSERT INTO `campo` VALUES (209, 15, 'cd_municipio', 'int(10) unsigned DEFAULT NULL', 0, '', 4);
INSERT INTO `campo` VALUES (210, 15, 'cd_escola', 'int(10) unsigned DEFAULT NULL', 0, '', 5);
INSERT INTO `campo` VALUES (211, 15, 'ds_codcliente', 'varchar(30) DEFAULT NULL', 0, '', 6);
INSERT INTO `campo` VALUES (212, 15, 'cd_unidade_rede', 'int(10) unsigned DEFAULT NULL', 0, '', 7);
INSERT INTO `campo` VALUES (213, 15, 'sn_academico', 'smallint(6) unsigned DEFAULT \'1\'', 0, '', 8);
INSERT INTO `campo` VALUES (214, 15, 'sn_financeiro', 'smallint(6) unsigned DEFAULT \'1\'', 0, '', 9);
INSERT INTO `campo` VALUES (215, 15, 'nm_diretor_geral', 'varchar(100) DEFAULT NULL', 0, '', 10);
INSERT INTO `campo` VALUES (216, 15, 'nm_diretor_acad', 'varchar(100) DEFAULT NULL', 0, '', 11);
INSERT INTO `campo` VALUES (217, 15, 'nm_diretor_finan', 'varchar(100) DEFAULT NULL', 0, '', 12);
INSERT INTO `campo` VALUES (218, 15, 'nm_testemunha1', 'varchar(100) DEFAULT NULL', 0, '', 13);
INSERT INTO `campo` VALUES (219, 15, 'nm_testemunha2', 'varchar(100) DEFAULT NULL', 0, '', 14);
INSERT INTO `campo` VALUES (220, 15, 'ds_cpf_geral', 'varchar(20) DEFAULT NULL', 0, '', 15);
INSERT INTO `campo` VALUES (221, 15, 'ds_cpf_acad', 'varchar(20) DEFAULT NULL', 0, '', 16);
INSERT INTO `campo` VALUES (222, 15, 'ds_cpf_finan', 'varchar(20) DEFAULT NULL', 0, '', 17);
INSERT INTO `campo` VALUES (223, 15, 'ds_cpf_test1', 'varchar(20) DEFAULT NULL', 0, '', 18);
INSERT INTO `campo` VALUES (224, 15, 'ds_cpf_test2', 'varchar(20) DEFAULT NULL', 0, '', 19);
INSERT INTO `campo` VALUES (225, 15, 'me_instituicao', 'varchar(240) DEFAULT NULL', 0, '', 20);
INSERT INTO `campo` VALUES (226, 15, 'me_diretor', 'varchar(240) DEFAULT NULL', 0, '', 21);
INSERT INTO `campo` VALUES (227, 15, 'ds_cidade', 'varchar(50) DEFAULT NULL', 0, '', 22);
INSERT INTO `campo` VALUES (228, 15, 'SN_MATRIZ', 'tinyint(1) DEFAULT \'0\'', 0, '', 23);
INSERT INTO `campo` VALUES (229, 15, 'cd_coligada_matriz', 'int(5) DEFAULT NULL', 0, 'Informa se é uma coligada matriz - ou qual é a coligada matriz dela', 24);
INSERT INTO `campo` VALUES (230, 15, 'ds_estado', 'varchar(255) DEFAULT NULL', 0, '', 25);
INSERT INTO `campo` VALUES (231, 15, 'cd_instituicao_mec', 'int(11) DEFAULT NULL', 0, '', 26);
INSERT INTO `campo` VALUES (232, 15, 'ds_endereco', 'varchar(255) DEFAULT NULL', 0, '', 27);
INSERT INTO `campo` VALUES (233, 15, 'ds_numero', 'varchar(255) DEFAULT NULL', 0, '', 28);
INSERT INTO `campo` VALUES (234, 15, 'ds_complemento', 'varchar(255) DEFAULT NULL', 0, '', 29);
INSERT INTO `campo` VALUES (235, 15, 'ds_bairro', 'varchar(255) DEFAULT NULL', 0, '', 30);
INSERT INTO `campo` VALUES (236, 15, 'ds_cep', 'varchar(8) DEFAULT NULL', 0, '', 31);
INSERT INTO `campo` VALUES (237, 15, 'ds_email_geral', 'varchar(255) DEFAULT NULL', 0, '', 32);
INSERT INTO `campo` VALUES (238, 15, 'ds_latitude', 'varchar(255) DEFAULT NULL', 0, '', 33);
INSERT INTO `campo` VALUES (239, 15, 'ds_longitude', 'varchar(255) DEFAULT NULL', 0, '', 34);
INSERT INTO `campo` VALUES (240, 15, 'ds_nre', 'varchar(50) DEFAULT NULL', 0, '', 35);
INSERT INTO `campo` VALUES (241, 15, 'ds_ato_direto', 'varchar(240) DEFAULT NULL', 0, '', 36);
INSERT INTO `campo` VALUES (242, 15, 'me_secretaria', 'varchar(240) DEFAULT NULL', 0, '', 37);
INSERT INTO `campo` VALUES (243, 15, 'ds_ato_secretaria', 'varchar(240) DEFAULT NULL', 0, '', 38);
INSERT INTO `campo` VALUES (244, 15, 'ds_ato_ofic_estab', 'varchar(240) DEFAULT NULL', 0, '', 39);
INSERT INTO `campo` VALUES (245, 15, 'dt_base', 'timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP', 0, '', 40);
INSERT INTO `campo` VALUES (246, 16, 'cd_grupo_pessoa', 'int(11) NOT NULL AUTO_INCREMENT', 1, '', 0);
INSERT INTO `campo` VALUES (247, 16, 'cd_grupo', 'int(11) NOT NULL DEFAULT \'0\'', 0, '', 1);
INSERT INTO `campo` VALUES (248, 16, 'cd_pessoa', 'int(11) NOT NULL DEFAULT \'0\'', 0, '', 2);
INSERT INTO `campo` VALUES (249, 16, 'cd_coligada', 'smallint(6) unsigned NOT NULL DEFAULT \'0\'', 0, '', 3);
INSERT INTO `campo` VALUES (250, 17, 'cd_modulo', 'int(11) NOT NULL AUTO_INCREMENT', 1, '', 0);
INSERT INTO `campo` VALUES (251, 17, 'ds_nome_modulo', 'varchar(100) NOT NULL DEFAULT \'0\'', 0, '', 1);
INSERT INTO `campo` VALUES (252, 17, 'ds_descricao', 'varchar(255) DEFAULT \'0\'', 0, '', 2);
INSERT INTO `campo` VALUES (253, 17, 'ds_chave', 'varchar(50) NOT NULL DEFAULT \'0\'', 0, 'Chave para encontrar no código', 3);
INSERT INTO `campo` VALUES (254, 17, 'sn_fixo', 'tinyint(1) NOT NULL DEFAULT \'0\'', 0, '', 4);
INSERT INTO `campo` VALUES (255, 17, 'sn_online', 'tinyint(1) DEFAULT \'0\'', 0, '', 5);
INSERT INTO `campo` VALUES (256, 17, 'me_icone', 'blob', 0, '', 6);
INSERT INTO `campo` VALUES (257, 17, 'sn_visual', 'tinyint(1) unsigned NOT NULL', 0, '', 7);
INSERT INTO `campo` VALUES (258, 17, 'nr_ordem', 'int(11) unsigned DEFAULT NULL', 0, '', 8);
INSERT INTO `campo` VALUES (259, 17, 'sn_ativo', 'tinyint(1) unsigned DEFAULT \'1\'', 0, '', 9);
INSERT INTO `campo` VALUES (260, 17, 'DS_LICENCA', 'varchar(255) DEFAULT NULL', 0, '', 10);
INSERT INTO `campo` VALUES (261, 18, 'cd_acao', 'int(11) NOT NULL AUTO_INCREMENT', 1, '', 0);
INSERT INTO `campo` VALUES (262, 18, 'cd_modulo', 'int(11) NOT NULL DEFAULT \'0\'', 0, '', 1);
INSERT INTO `campo` VALUES (263, 18, 'ds_nome_acao', 'varchar(255) NOT NULL DEFAULT \'0\'', 0, '', 2);
INSERT INTO `campo` VALUES (264, 18, 'ds_chave', 'varchar(50) NOT NULL DEFAULT \'0\'', 0, 'Chave para busca na programação', 3);
INSERT INTO `campo` VALUES (265, 18, 'ds_licenca', 'varchar(150) NOT NULL', 0, '', 4);
INSERT INTO `campo` VALUES (266, 19, 'cd_permissao', 'int(11) NOT NULL AUTO_INCREMENT', 1, '', 0);
INSERT INTO `campo` VALUES (267, 19, 'cd_grupo', 'int(11) NOT NULL DEFAULT \'0\'', 0, '', 1);
INSERT INTO `campo` VALUES (268, 19, 'cd_acao', 'int(11) NOT NULL DEFAULT \'0\'', 0, '', 2);
INSERT INTO `campo` VALUES (269, 19, 'nr_permissao', 'int(11) NOT NULL DEFAULT \'0\'', 0, 'de 0 a 31\nacesso, incluir, alterar, excluir e especial', 3);
INSERT INTO `campo` VALUES (270, 20, 'cd_caixa', 'int(11) NOT NULL AUTO_INCREMENT', 1, '', 0);
INSERT INTO `campo` VALUES (271, 20, 'cd_coligada', 'smallint(6) unsigned NOT NULL DEFAULT \'1\'', 0, '', 1);
INSERT INTO `campo` VALUES (272, 20, 'sn_todas_coligadas', 'tinyint(1) unsigned NOT NULL DEFAULT \'0\'', 0, '', 2);
INSERT INTO `campo` VALUES (273, 20, 'ds_caixa', 'varchar(255) DEFAULT NULL', 0, '', 3);
INSERT INTO `campo` VALUES (274, 20, 'ds_observacao', 'mediumtext', 0, '', 4);
INSERT INTO `campo` VALUES (275, 20, 'tp_conta', 'smallint(6) DEFAULT NULL', 0, '', 5);
INSERT INTO `campo` VALUES (276, 20, 'nm_banco', 'varchar(100) DEFAULT NULL', 0, '', 6);
INSERT INTO `campo` VALUES (277, 20, 'nr_banco', 'varchar(30) DEFAULT NULL', 0, '', 7);
INSERT INTO `campo` VALUES (278, 20, 'nr_agencia', 'varchar(30) DEFAULT NULL', 0, '', 8);
INSERT INTO `campo` VALUES (279, 20, 'nm_agencia', 'varchar(100) DEFAULT NULL', 0, '', 9);
INSERT INTO `campo` VALUES (280, 20, 'nr_conta', 'varchar(50) DEFAULT NULL', 0, '', 10);
INSERT INTO `campo` VALUES (281, 20, 'nr_float_bancario', 'smallint(2) DEFAULT NULL', 0, '', 11);
INSERT INTO `campo` VALUES (282, 20, 'dt_criacao', 'datetime DEFAULT NULL', 0, '', 12);
INSERT INTO `campo` VALUES (283, 20, 'vl_saldo_inicio', 'double DEFAULT NULL', 0, '', 13);
INSERT INTO `campo` VALUES (284, 20, 'sn_ativa', 'char(1) DEFAULT NULL', 0, '', 14);
INSERT INTO `campo` VALUES (285, 20, 'sn_conta_resultado', 'tinyint(1) NOT NULL DEFAULT \'1\'', 0, '', 15);
INSERT INTO `campo` VALUES (286, 20, 'nr_uso_banco', 'varchar(20) DEFAULT NULL', 0, '', 16);
INSERT INTO `campo` VALUES (287, 20, 'ds_mensagem_bloqueto', 'mediumtext', 0, '', 17);
INSERT INTO `campo` VALUES (288, 20, 'sn_multa', 'char(1) DEFAULT \'N\'', 0, '', 18);
INSERT INTO `campo` VALUES (289, 20, 'sn_juros', 'char(1) DEFAULT \'N\'', 0, '', 19);
INSERT INTO `campo` VALUES (290, 20, 'sn_correcao', 'char(1) DEFAULT \'N\'', 0, '', 20);
INSERT INTO `campo` VALUES (291, 20, 'sn_juros_mensal', 'char(1) DEFAULT \'N\'', 0, '', 21);
INSERT INTO `campo` VALUES (292, 20, 'vl_multa_percent', 'double DEFAULT NULL', 0, '', 22);
INSERT INTO `campo` VALUES (293, 20, 'vl_juros_percent', 'double DEFAULT NULL', 0, '', 23);
INSERT INTO `campo` VALUES (294, 20, 'vl_juros_mensal', 'double DEFAULT NULL', 0, '', 24);
INSERT INTO `campo` VALUES (295, 20, 'nr_dias_acrescimo', 'int(6) DEFAULT \'0\'', 0, '', 25);
INSERT INTO `campo` VALUES (296, 20, 'nr_dias_desconto', 'int(6) DEFAULT \'0\'', 0, '', 26);
INSERT INTO `campo` VALUES (297, 20, 'vl_dias_desc_perc', 'double unsigned DEFAULT \'0\'', 0, '', 27);
INSERT INTO `campo` VALUES (298, 20, 'nr_carteira', 'varchar(20) DEFAULT NULL', 0, '', 28);
INSERT INTO `campo` VALUES (299, 20, 'nr_convenio', 'varchar(15) DEFAULT NULL', 0, '', 29);
INSERT INTO `campo` VALUES (300, 20, 'nm_cedente', 'varchar(100) DEFAULT NULL', 0, '', 30);
INSERT INTO `campo` VALUES (301, 20, 'ds_cnpj_cedente', 'varchar(50) DEFAULT NULL', 0, '', 31);
INSERT INTO `campo` VALUES (302, 20, 'nr_transacao', 'varchar(5) DEFAULT NULL', 0, '', 32);
INSERT INTO `campo` VALUES (303, 20, 'ds_identificacao_retorno', 'varchar(30) DEFAULT NULL', 0, '', 33);
INSERT INTO `campo` VALUES (304, 20, 'nm_arquivo_bloqueto', 'varchar(50) DEFAULT NULL', 0, '', 34);
INSERT INTO `campo` VALUES (305, 20, 'ds_nn_prefixo', 'varchar(20) DEFAULT NULL', 0, '', 35);
INSERT INTO `campo` VALUES (306, 20, 'nr_ultimo_cheque', 'int(11) DEFAULT NULL', 0, '', 36);
INSERT INTO `campo` VALUES (307, 20, 'dt_saldo_base', 'datetime DEFAULT NULL', 0, '', 37);
INSERT INTO `campo` VALUES (308, 20, 'nr_nn_ultimo', 'int(11) DEFAULT NULL', 0, '', 38);
INSERT INTO `campo` VALUES (309, 20, 'nr_nn_tamanho', 'int(11) unsigned DEFAULT \'8\'', 0, '', 39);
INSERT INTO `campo` VALUES (310, 20, 'cd_boleto_online', 'int(11) unsigned DEFAULT NULL', 0, '', 40);
INSERT INTO `campo` VALUES (311, 20, 'cd_plano_conta', 'int(11) unsigned DEFAULT \'0\'', 0, '', 41);
INSERT INTO `campo` VALUES (312, 20, 'cd_conta_desconto', 'int(11) unsigned DEFAULT \'0\'', 0, '', 42);
INSERT INTO `campo` VALUES (313, 20, 'cd_conta_acrescimo', 'int(11) unsigned DEFAULT \'0\'', 0, '', 43);
INSERT INTO `campo` VALUES (314, 20, 'sn_saldo_disponivel', 'tinyint(1) unsigned DEFAULT \'1\'', 0, '', 44);
INSERT INTO `campo` VALUES (315, 20, 'ds_categoria', 'varchar(100) DEFAULT NULL', 0, '', 45);
INSERT INTO `campo` VALUES (316, 20, 'cd_conta_tarifa', 'int(11) unsigned DEFAULT NULL', 0, '', 46);
INSERT INTO `campo` VALUES (317, 20, 'cd_centro_tarifa', 'int(11) unsigned DEFAULT NULL', 0, '', 47);
INSERT INTO `campo` VALUES (318, 20, 'ds_grupo_categoria', 'varchar(100) DEFAULT NULL', 0, '', 48);
INSERT INTO `campo` VALUES (319, 20, 'sn_transf_aberta', 'tinyint(1) DEFAULT \'0\'', 0, '', 49);
INSERT INTO `campo` VALUES (320, 20, 'sn_ignorar_dda', 'tinyint(1) DEFAULT NULL', 0, '', 50);
INSERT INTO `campo` VALUES (321, 20, 'cd_historico_baixa', 'int(11) unsigned DEFAULT NULL', 0, '', 51);
INSERT INTO `campo` VALUES (322, 20, 'ds_historico_baixa', 'varchar(250) DEFAULT NULL', 0, '', 52);
INSERT INTO `campo` VALUES (323, 20, 'cd_historico_desc', 'int(11) unsigned DEFAULT NULL', 0, '', 53);
INSERT INTO `campo` VALUES (324, 20, 'ds_historico_desc', 'varchar(250) DEFAULT NULL', 0, '', 54);
INSERT INTO `campo` VALUES (325, 20, 'cd_historico_juros', 'int(11) unsigned DEFAULT NULL', 0, '', 55);
INSERT INTO `campo` VALUES (326, 20, 'ds_historico_juros', 'varchar(250) DEFAULT NULL', 0, '', 56);
INSERT INTO `campo` VALUES (327, 20, 'cd_conta_desc_cp', 'int(11) unsigned DEFAULT \'0\'', 0, '', 57);
INSERT INTO `campo` VALUES (328, 20, 'cd_conta_multa_cp', 'int(11) unsigned DEFAULT \'0\'', 0, '', 58);
INSERT INTO `campo` VALUES (329, 20, 'cd_conta_juros_cp', 'int(11) unsigned DEFAULT \'0\'', 0, '', 59);
INSERT INTO `campo` VALUES (330, 20, 'ds_endereco_cedente', 'varchar(255) DEFAULT NULL', 0, '', 60);
INSERT INTO `campo` VALUES (331, 21, 'cd_tipo', 'smallint(6) unsigned NOT NULL DEFAULT \'0\'', 1, '', 0);
INSERT INTO `campo` VALUES (332, 21, 'ds_tipo', 'varchar(255) DEFAULT NULL', 0, '', 1);
INSERT INTO `campo` VALUES (333, 22, 'id', 'int(11) NOT NULL AUTO_INCREMENT', 1, '', 0);
INSERT INTO `campo` VALUES (334, 22, 'dt_log', 'datetime NOT NULL', 0, '', 1);
INSERT INTO `campo` VALUES (335, 22, 'me_log', 'longtext COLLATE utf8_unicode_ci', 0, '', 2);
INSERT INTO `campo` VALUES (336, 23, 'id', 'int(11) NOT NULL AUTO_INCREMENT', 1, '', 0);
INSERT INTO `campo` VALUES (337, 23, 'saas_cliente_id', 'int(11) DEFAULT NULL', 0, '', 1);
INSERT INTO `campo` VALUES (338, 23, 'saas_gateway_id', 'int(11) DEFAULT NULL', 0, '', 2);
INSERT INTO `campo` VALUES (339, 23, 'me_log', 'longtext COLLATE utf8_unicode_ci', 0, '', 3);
INSERT INTO `campo` VALUES (340, 23, 'dt_log', 'datetime NOT NULL', 0, '', 4);
INSERT INTO `campo` VALUES (341, 24, 'saas_cliente_id', '', 0, 'Criado automaticamente pela leitura da SQL - verificar propriedades', 0);
INSERT INTO `campo` VALUES (342, 25, 'saas_gateway_id', '', 0, 'Criado automaticamente pela leitura da SQL - verificar propriedades', 0);
INSERT INTO `campo` VALUES (343, 26, 'id', 'int(11) NOT NULL AUTO_INCREMENT', 1, '', 0);
INSERT INTO `campo` VALUES (344, 26, 'ds_nome', 'varchar(255) COLLATE utf8_unicode_ci NOT NULL', 0, '', 1);
INSERT INTO `campo` VALUES (345, 26, 'ds_chave', 'varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL', 0, '', 2);
INSERT INTO `campo` VALUES (346, 26, 'dt_base', 'timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP', 0, '', 3);
INSERT INTO `campo` VALUES (347, 27, 'id', 'int(11) NOT NULL AUTO_INCREMENT', 1, '', 0);
INSERT INTO `campo` VALUES (348, 27, 'ds_nome', 'varchar(255) COLLATE utf8_unicode_ci NOT NULL', 0, '', 1);
INSERT INTO `campo` VALUES (349, 27, 'ds_chave', 'varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL', 0, '', 2);
INSERT INTO `campo` VALUES (350, 27, 'dt_base', 'timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP', 0, '', 3);
INSERT INTO `campo` VALUES (351, 28, 'id', 'int(11) NOT NULL AUTO_INCREMENT', 1, '', 0);
INSERT INTO `campo` VALUES (352, 28, 'admin_grupo_id', 'int(11) DEFAULT NULL', 0, '', 1);
INSERT INTO `campo` VALUES (353, 28, 'admin_sistema_acao_id', 'int(11) DEFAULT NULL', 0, '', 2);
INSERT INTO `campo` VALUES (354, 28, 'dt_base', 'timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP', 0, '', 3);
INSERT INTO `campo` VALUES (355, 29, 'id', 'int(11) NOT NULL AUTO_INCREMENT', 1, '', 0);
INSERT INTO `campo` VALUES (356, 29, 'ds_nome', 'varchar(255) COLLATE utf8_unicode_ci NOT NULL', 0, '', 1);
INSERT INTO `campo` VALUES (357, 29, 'ds_email', 'varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL', 0, '', 2);
INSERT INTO `campo` VALUES (358, 29, 'ds_login', 'varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL', 0, '', 3);
INSERT INTO `campo` VALUES (359, 29, 'ds_senha', 'varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL', 0, '', 4);
INSERT INTO `campo` VALUES (360, 29, 'dt_base', 'timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP', 0, '', 5);
INSERT INTO `campo` VALUES (361, 30, 'id', 'int(11) NOT NULL AUTO_INCREMENT', 1, '', 0);
INSERT INTO `campo` VALUES (362, 30, 'admin_usuario_id', 'int(11) DEFAULT NULL', 0, '', 1);
INSERT INTO `campo` VALUES (363, 30, 'admin_grupo_id', 'int(11) DEFAULT NULL', 0, '', 2);
INSERT INTO `campo` VALUES (364, 30, 'dt_base', 'timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP', 0, '', 3);
INSERT INTO `campo` VALUES (365, 31, 'id', 'int(11) NOT NULL AUTO_INCREMENT', 1, '', 0);
INSERT INTO `campo` VALUES (366, 31, 'admin_usuario_id', 'int(11) DEFAULT NULL', 0, '', 1);
INSERT INTO `campo` VALUES (367, 31, 'saas_cliente_id', 'int(11) DEFAULT NULL', 0, '', 2);
INSERT INTO `campo` VALUES (368, 31, 'dt_base', 'timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP', 0, '', 3);
INSERT INTO `campo` VALUES (369, 25, 'id', 'int(11) NOT NULL AUTO_INCREMENT', 1, '', 0);
INSERT INTO `campo` VALUES (370, 25, 'ds_nome', 'varchar(255) COLLATE utf8_unicode_ci NOT NULL', 0, '', 1);
INSERT INTO `campo` VALUES (371, 25, 'ds_chave', 'varchar(255) COLLATE utf8_unicode_ci NOT NULL', 0, '', 2);
INSERT INTO `campo` VALUES (372, 25, 'ds_url_formulario', 'varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL', 0, '', 3);
INSERT INTO `campo` VALUES (373, 25, 'dt_base', 'timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP', 0, '', 4);
INSERT INTO `campo` VALUES (374, 33, 'id', 'int(11) NOT NULL AUTO_INCREMENT', 1, '', 0);
INSERT INTO `campo` VALUES (375, 33, 'saas_gateway_id', 'int(11) DEFAULT NULL', 0, '', 1);
INSERT INTO `campo` VALUES (376, 33, 'saas_pessoa_id', 'int(11) DEFAULT NULL', 0, '', 2);
INSERT INTO `campo` VALUES (377, 33, 'ds_hash_pessoa_gateway', 'varchar(255) COLLATE utf8_unicode_ci NOT NULL', 0, '', 3);
INSERT INTO `campo` VALUES (378, 33, 'dt_base', 'timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP', 0, '', 4);
INSERT INTO `campo` VALUES (379, 34, 'saas_pessoa_id', '', 0, 'Criado automaticamente pela leitura da SQL - verificar propriedades', 0);
INSERT INTO `campo` VALUES (380, 35, 'id', 'int(11) NOT NULL AUTO_INCREMENT', 1, '', 0);
INSERT INTO `campo` VALUES (381, 35, 'saas_cliente_id', 'int(11) DEFAULT NULL', 0, '', 1);
INSERT INTO `campo` VALUES (382, 35, 'saas_gateway_id', 'int(11) DEFAULT NULL', 0, '', 2);
INSERT INTO `campo` VALUES (383, 35, 'dt_base', 'timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP', 0, '', 3);
INSERT INTO `campo` VALUES (384, 37, 'cd_tipo_acao', 'smallint(6) unsigned NOT NULL DEFAULT \'0\'', 1, '', 0);
INSERT INTO `campo` VALUES (385, 37, 'ds_tipo_acao', 'varchar(255) DEFAULT NULL', 0, '', 1);
INSERT INTO `campo` VALUES (388, 38, 'cd_conta', 'int(11) unsigned NOT NULL', 1, '', 0);
INSERT INTO `campo` VALUES (389, 38, 'cd_coligada_matriz', 'smallint(6) unsigned NOT NULL', 0, '', 1);
INSERT INTO `campo` VALUES (390, 38, 'ds_conta', 'varchar(255) DEFAULT NULL', 0, '', 2);
INSERT INTO `campo` VALUES (391, 38, 'ds_observacao', 'mediumtext', 0, '', 3);
INSERT INTO `campo` VALUES (392, 38, 'cd_classificacao', 'varchar(20) DEFAULT NULL', 0, 'Código contábil. Exemplo. 1.000.100.200', 4);
INSERT INTO `campo` VALUES (393, 38, 'cd_apropriacao', 'int(11) DEFAULT NULL', 0, '', 5);
INSERT INTO `campo` VALUES (394, 38, 'tp_conta', 'smallint(1) DEFAULT NULL', 0, 'Analítica - 1 \nSintética - 2\nUma conta analítica pode ter várias contas sintéticas.', 6);
INSERT INTO `campo` VALUES (395, 38, 'tp_entrada_saida', 'smallint(1) unsigned DEFAULT NULL', 0, '1 - Entrada\n2 - Saida\n0 - Ambos', 7);
INSERT INTO `campo` VALUES (396, 38, 'sn_ativo', 'tinyint(1) unsigned DEFAULT \'1\'', 0, '', 8);
INSERT INTO `campo` VALUES (397, 38, 'cd_conta_contabil', 'varchar(20) DEFAULT NULL', 0, '', 9);
INSERT INTO `campo` VALUES (398, 38, 'cd_grupo_principal', 'int(11) NOT NULL DEFAULT \'0\'', 0, '', 10);
INSERT INTO `campo` VALUES (399, 38, 'cd_class1', 'smallint(6) unsigned DEFAULT \'0\'', 0, '', 11);
INSERT INTO `campo` VALUES (400, 38, 'cd_class2', 'smallint(6) unsigned DEFAULT \'0\'', 0, '', 12);
INSERT INTO `campo` VALUES (401, 38, 'cd_class3', 'smallint(6) unsigned DEFAULT \'0\'', 0, '', 13);
INSERT INTO `campo` VALUES (402, 38, 'cd_class4', 'smallint(6) unsigned DEFAULT \'0\'', 0, '', 14);
INSERT INTO `campo` VALUES (403, 38, 'cd_class5', 'smallint(6) unsigned DEFAULT \'0\'', 0, '', 15);
INSERT INTO `campo` VALUES (404, 38, 'cd_class6', 'smallint(6) unsigned DEFAULT \'0\'', 0, '', 16);
INSERT INTO `campo` VALUES (405, 38, 'cd_class7', 'smallint(6) unsigned DEFAULT \'0\'', 0, '', 17);
INSERT INTO `campo` VALUES (406, 38, 'cd_class8', 'smallint(6) unsigned DEFAULT \'0\'', 0, '', 18);
INSERT INTO `campo` VALUES (407, 38, 'cd_class9', 'smallint(6) unsigned DEFAULT \'0\'', 0, '', 19);
INSERT INTO `campo` VALUES (408, 38, 'ds_formula_calculo', 'varchar(200) DEFAULT NULL', 0, '', 20);
INSERT INTO `campo` VALUES (409, 38, 'cd_criterio', 'int(11) unsigned DEFAULT NULL', 0, '', 21);
INSERT INTO `campo` VALUES (410, 38, 'sn_custeio', 'tinyint(1) unsigned DEFAULT \'1\'', 0, '', 22);
INSERT INTO `campo` VALUES (411, 38, 'cd_grupo_custeio', 'int(11) unsigned DEFAULT NULL', 0, '', 23);
INSERT INTO `campo` VALUES (412, 38, 'cd_grupo_contas', 'int(11) DEFAULT NULL', 0, '', 24);
INSERT INTO `campo` VALUES (413, 38, 'cd_pessoa', 'int(11) DEFAULT NULL COMMENT \'Código da pessoa para fornecedores\'', 0, 'Código da pessoa para fornecedores', 25);
INSERT INTO `campo` VALUES (414, 38, 'dt_inclusao', 'timestamp NULL DEFAULT CURRENT_TIMESTAMP COMMENT \'Data e hora padrao da inclusão da conta\'', 0, '', 26);
INSERT INTO `campo` VALUES (415, 39, 'cd_acao', 'int(11) unsigned NOT NULL AUTO_INCREMENT', 1, '', 0);
INSERT INTO `campo` VALUES (416, 39, 'ds_acao', 'varchar(255) DEFAULT NULL', 0, 'Exemplo: COMPROMISSO GERADO MANUALMENTE\nBAIXA MANUAL DE MENSALIDADE', 1);
INSERT INTO `campo` VALUES (417, 39, 'cd_tipo_acao', 'smallint(6) DEFAULT NULL', 0, 'fin_acoes_tipos', 2);
INSERT INTO `campo` VALUES (418, 39, 'cd_movimento_caixa', 'int(11) unsigned DEFAULT \'0\'', 0, 'fin_acoes_movimento', 3);
INSERT INTO `campo` VALUES (419, 39, 'sn_ativo', 'char(1) DEFAULT NULL', 0, '', 4);
INSERT INTO `campo` VALUES (420, 39, 'cd_origem', 'smallint(1) DEFAULT NULL', 0, 'Módulo ou sistema de origem do movimento.  Identificação da origem da ação\n\n1 - Recebimento\n2 - Compromissos\n3 - Tesouraria\n4 - Biblioteca \n', 5);
INSERT INTO `campo` VALUES (421, 39, 'tp_entrada_saida', 'smallint(1) DEFAULT NULL', 0, '0 - ?\n1 - entrada\n2 - saida', 6);
INSERT INTO `campo` VALUES (422, 39, 'cd_movimento_estorno', 'int(11) unsigned DEFAULT NULL', 0, 'fin_acoes_movimento', 7);
INSERT INTO `campo` VALUES (423, 39, 'cd_acao_automatica', 'int(11) DEFAULT NULL', 0, 'fin_acoes_movimento', 8);
INSERT INTO `campo` VALUES (424, 39, 'cd_plano_conta', 'int(11) unsigned DEFAULT \'0\'', 0, 'fin_config_plano_contas', 9);
INSERT INTO `campo` VALUES (425, 39, 'cd_historico_baixa', 'int(11) unsigned DEFAULT \'0\'', 0, '', 10);
INSERT INTO `campo` VALUES (426, 39, 'ds_historico_baixa', 'varchar(250) DEFAULT NULL', 0, '', 11);
INSERT INTO `campo` VALUES (427, 39, 'vl_perc_desconto', 'double DEFAULT NULL', 0, '', 12);
INSERT INTO `campo` VALUES (428, 39, 'sn_altera_desconto', 'tinyint(1) DEFAULT NULL', 0, '', 13);
INSERT INTO `campo` VALUES (429, 39, 'sn_desconto_valor_fixo', 'tinyint(1) DEFAULT \'0\'', 0, '', 14);
INSERT INTO `campo` VALUES (430, 40, 'cd_movimento_te', 'int(11) unsigned NOT NULL AUTO_INCREMENT', 1, '', 0);
INSERT INTO `campo` VALUES (431, 40, 'cd_coligada', 'smallint(6) unsigned NOT NULL DEFAULT \'1\'', 0, '', 1);
INSERT INTO `campo` VALUES (432, 40, 'cd_caixa', 'int(11) DEFAULT NULL', 0, '', 2);
INSERT INTO `campo` VALUES (433, 40, 'cd_abertura_caixa', 'int(11) DEFAULT NULL', 0, '?', 3);
INSERT INTO `campo` VALUES (434, 40, 'dt_movimento', 'datetime DEFAULT NULL', 0, '', 4);
INSERT INTO `campo` VALUES (435, 40, 'cd_acao', 'int(11) DEFAULT NULL', 0, '', 5);
INSERT INTO `campo` VALUES (436, 40, 'nr_documento', 'varchar(50) DEFAULT NULL', 0, '- Boleto\n- código da fatura do cartão', 6);
INSERT INTO `campo` VALUES (437, 40, 'ds_movimento', 'varchar(255) DEFAULT NULL', 0, 'Descrição do movimento', 7);
INSERT INTO `campo` VALUES (438, 40, 'dt_liberacao', 'datetime DEFAULT NULL', 0, '', 8);
INSERT INTO `campo` VALUES (439, 40, 'cd_origem', 'tinyint(1) DEFAULT NULL', 0, 'Local aonde houve o movimento', 9);
INSERT INTO `campo` VALUES (440, 40, 'ds_observacao', 'mediumtext', 0, '', 10);
INSERT INTO `campo` VALUES (441, 40, 'tp_entrada_saida', 'tinyint(1) DEFAULT NULL', 0, '1 - Entrada\n2 - saida', 11);
INSERT INTO `campo` VALUES (442, 40, 'vl_movimento', 'double DEFAULT \'0\'', 0, '', 12);
INSERT INTO `campo` VALUES (443, 40, 'cd_moeda', 'int(11) unsigned DEFAULT \'0\'', 0, '', 13);
INSERT INTO `campo` VALUES (444, 40, 'vl_moeda', 'double DEFAULT NULL', 0, '', 14);
INSERT INTO `campo` VALUES (445, 40, 'vl_saldo', 'double DEFAULT NULL', 0, '', 15);
INSERT INTO `campo` VALUES (446, 40, 'vl_dinheiro', 'double DEFAULT NULL', 0, '', 16);
INSERT INTO `campo` VALUES (447, 40, 'vl_cheque', 'double DEFAULT NULL', 0, '', 17);
INSERT INTO `campo` VALUES (448, 40, 'cd_mensalidade', 'int(11) unsigned NOT NULL DEFAULT \'0\'', 0, '', 18);
INSERT INTO `campo` VALUES (449, 40, 'cd_usuario', 'int(11) unsigned NOT NULL DEFAULT \'0\'', 0, '', 19);
INSERT INTO `campo` VALUES (450, 40, 'sn_compensado', 'tinyint(1) unsigned DEFAULT \'0\'', 0, '', 20);
INSERT INTO `campo` VALUES (451, 40, 'dt_compensacao', 'datetime DEFAULT NULL', 0, '', 21);
INSERT INTO `campo` VALUES (452, 40, 'cd_forma_pgto', 'int(11) unsigned DEFAULT \'0\'', 0, '', 22);
INSERT INTO `campo` VALUES (453, 40, 'dt_registro', 'datetime DEFAULT NULL', 0, '', 23);
INSERT INTO `campo` VALUES (454, 40, 'nr_cheque', 'int(11) DEFAULT NULL', 0, '', 24);
INSERT INTO `campo` VALUES (455, 40, 'vl_saldo_compensado', 'double DEFAULT NULL', 0, '', 25);
INSERT INTO `campo` VALUES (456, 40, 'cd_titulo', 'int(11) unsigned DEFAULT NULL', 0, '', 26);
INSERT INTO `campo` VALUES (457, 40, 'nr_estorno', 'int(11) unsigned DEFAULT \'0\'', 0, '', 27);
INSERT INTO `campo` VALUES (458, 40, 'cd_transfere', 'int(11) unsigned DEFAULT \'0\'', 0, '', 28);
INSERT INTO `campo` VALUES (459, 40, 'cd_cheque', 'int(11) unsigned DEFAULT \'0\'', 0, '', 29);
INSERT INTO `campo` VALUES (460, 40, 'cd_cartao', 'int(11) DEFAULT NULL', 0, '', 30);
INSERT INTO `campo` VALUES (461, 41, 'cd_mensalidade', 'int(11) NOT NULL', 1, 'codigo de mensalidade do unimestre', 0);
INSERT INTO `campo` VALUES (462, 41, 'bill_id', 'bigint(20) DEFAULT NULL', 0, 'codigo de mensalidade do quero bolsa', 1);
INSERT INTO `campo` VALUES (463, 41, 'ds_status', 'varchar(255) DEFAULT NULL', 0, 'status da mensalidade no quero bolsa\nopen - em aberto\npaid - pago\nexempted - isento', 2);
INSERT INTO `campo` VALUES (464, 41, 'dt_cobranca', 'datetime DEFAULT NULL', 0, '', 3);
INSERT INTO `campo` VALUES (465, 41, 'vl_valor_final', 'double(8,2) DEFAULT NULL', 0, '', 4);
INSERT INTO `campo` VALUES (466, 41, 'vl_valor_bruto', 'double(8,2) DEFAULT NULL', 0, '', 5);
INSERT INTO `campo` VALUES (467, 41, 'vl_valor_pago', 'double(8,2) DEFAULT NULL', 0, '', 6);
INSERT INTO `campo` VALUES (468, 41, 'ds_json', 'mediumtext', 0, 'json original enviado', 7);
INSERT INTO `campo` VALUES (469, 41, 'dt_base', 'timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP', 0, '', 8);
INSERT INTO `campo` VALUES (470, 42, 'cd_integracao_qb_matricula', 'bigint(255) NOT NULL AUTO_INCREMENT', 1, '', 0);
INSERT INTO `campo` VALUES (471, 42, 'cd_pessoa', 'int(11) DEFAULT NULL', 0, '', 1);
INSERT INTO `campo` VALUES (472, 42, 'ds_cpf', 'varchar(255) DEFAULT NULL', 0, '', 2);
INSERT INTO `campo` VALUES (473, 42, 'ds_matricula_id', 'varchar(255) DEFAULT NULL', 0, '', 3);
INSERT INTO `campo` VALUES (474, 42, 'ds_course_id', 'varchar(255) DEFAULT NULL', 0, '', 4);
INSERT INTO `campo` VALUES (475, 42, 'vl_discount_percentage', 'double DEFAULT NULL', 0, '', 5);
INSERT INTO `campo` VALUES (476, 42, 'nr_due_day', 'int(11) DEFAULT NULL', 0, '', 6);
INSERT INTO `campo` VALUES (477, 42, 'nr_start_year', 'int(11) DEFAULT NULL', 0, '', 7);
INSERT INTO `campo` VALUES (478, 42, 'nr_start_month', 'int(11) DEFAULT NULL', 0, '', 8);
INSERT INTO `campo` VALUES (479, 42, 'nr_duration_in_months', 'int(11) DEFAULT NULL', 0, '', 9);
INSERT INTO `campo` VALUES (480, 42, 'dt_created_at', 'datetime DEFAULT NULL', 0, '', 10);
INSERT INTO `campo` VALUES (481, 42, 'dt_base', 'timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP', 0, '', 11);
INSERT INTO `campo` VALUES (482, 43, 'cd_parametro', 'int(11) NOT NULL AUTO_INCREMENT', 1, '', 0);
INSERT INTO `campo` VALUES (483, 43, 'ds_parametro', 'varchar(255) NOT NULL DEFAULT \'0\'', 0, '', 1);
INSERT INTO `campo` VALUES (484, 43, 'ds_valor', 'text', 0, '', 2);
INSERT INTO `campo` VALUES (485, 43, 'cd_modulos_acoes', 'int(11) NOT NULL DEFAULT \'0\'', 0, 'não usado', 3);
INSERT INTO `campo` VALUES (486, 43, 'ds_observacao', 'longtext', 0, '', 4);
INSERT INTO `campo` VALUES (487, 43, 'cd_modulo', 'int(10) unsigned DEFAULT NULL', 0, 'qual é o modulo', 5);
INSERT INTO `campo` VALUES (488, 43, 'ds_ereg_validacao', 'varchar(255) DEFAULT NULL', 0, 'expressão regular usada para validação', 6);
INSERT INTO `campo` VALUES (489, 43, 'cd_validacao', 'int(11) NOT NULL DEFAULT \'0\'', 0, '', 7);
INSERT INTO `campo` VALUES (490, 43, 'ds_validacao_valores', 'varchar(50) DEFAULT NULL', 0, '', 8);
INSERT INTO `campo` VALUES (491, 43, 'cd_parametro_tipo', 'int(11) NOT NULL DEFAULT \'0\'', 0, '', 9);
INSERT INTO `campo` VALUES (492, 43, 'cd_coligada', 'smallint(6) DEFAULT \'0\'', 0, '- Se for ZERO serve para todas as coligadas\n- se tiver o número da coligada, serve apenas para aquela coligada', 10);
INSERT INTO `campo` VALUES (493, 43, 'dt_base', 'timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP', 0, '', 11);
INSERT INTO `campo` VALUES (494, 44, 'cd_coligada', 'int(11) NOT NULL AUTO_INCREMENT', 1, '', 0);
INSERT INTO `campo` VALUES (495, 44, 'nm_coligada', 'varchar(50) NOT NULL', 0, '', 1);
INSERT INTO `campo` VALUES (496, 44, 'nm_razao_social', 'varchar(100) DEFAULT NULL', 0, '', 2);
INSERT INTO `campo` VALUES (497, 44, 'ds_cnpj', 'varchar(20) DEFAULT NULL', 0, '', 3);
INSERT INTO `campo` VALUES (498, 44, 'cd_municipio', 'int(10) unsigned DEFAULT NULL', 0, '', 4);
INSERT INTO `campo` VALUES (499, 44, 'cd_escola', 'int(10) unsigned DEFAULT NULL', 0, '', 5);
INSERT INTO `campo` VALUES (500, 44, 'cd_unidade_rede', 'int(10) unsigned DEFAULT NULL', 0, '', 6);
INSERT INTO `campo` VALUES (501, 44, 'ds_codcliente', 'varchar(30) DEFAULT NULL', 0, '', 7);
INSERT INTO `campo` VALUES (502, 44, 'nm_diretor_geral', 'varchar(100) DEFAULT NULL', 0, '', 8);
INSERT INTO `campo` VALUES (503, 44, 'nm_diretor_acad', 'varchar(100) DEFAULT NULL', 0, '', 9);
INSERT INTO `campo` VALUES (504, 44, 'nm_diretor_finan', 'varchar(100) DEFAULT NULL', 0, '', 10);
INSERT INTO `campo` VALUES (505, 44, 'nm_testemunha1', 'varchar(100) DEFAULT NULL', 0, '', 11);
INSERT INTO `campo` VALUES (506, 44, 'nm_testemunha2', 'varchar(100) DEFAULT NULL', 0, '', 12);
INSERT INTO `campo` VALUES (507, 44, 'ds_cpf_geral', 'varchar(20) DEFAULT NULL', 0, '', 13);
INSERT INTO `campo` VALUES (508, 44, 'ds_cpf_acad', 'varchar(20) DEFAULT NULL', 0, '', 14);
INSERT INTO `campo` VALUES (509, 44, 'ds_cpf_finan', 'varchar(20) DEFAULT NULL', 0, '', 15);
INSERT INTO `campo` VALUES (510, 44, 'ds_cpf_test1', 'varchar(20) DEFAULT NULL', 0, '', 16);
INSERT INTO `campo` VALUES (511, 44, 'ds_cpf_test2', 'varchar(20) DEFAULT NULL', 0, '', 17);
INSERT INTO `campo` VALUES (512, 44, 'me_instituicao', 'varchar(240) DEFAULT NULL', 0, '', 18);
INSERT INTO `campo` VALUES (513, 44, 'me_diretor', 'varchar(240) DEFAULT NULL', 0, '', 19);
INSERT INTO `campo` VALUES (514, 44, 'ds_cidade', 'varchar(50) DEFAULT NULL', 0, '', 20);
INSERT INTO `campo` VALUES (515, 44, 'ds_estado', 'varchar(255) DEFAULT NULL', 0, '', 21);
INSERT INTO `campo` VALUES (516, 44, 'ds_endereco', 'varchar(255) DEFAULT NULL', 0, '', 22);
INSERT INTO `campo` VALUES (517, 44, 'ds_numero', 'varchar(255) DEFAULT NULL', 0, '', 23);
INSERT INTO `campo` VALUES (518, 44, 'ds_complemento', 'varchar(255) DEFAULT NULL', 0, '', 24);
INSERT INTO `campo` VALUES (519, 44, 'ds_bairro', 'varchar(255) DEFAULT NULL', 0, '', 25);
INSERT INTO `campo` VALUES (520, 44, 'ds_cep', 'varchar(8) DEFAULT NULL', 0, '', 26);
INSERT INTO `campo` VALUES (521, 44, 'ds_email_geral', 'varchar(255) DEFAULT NULL', 0, '', 27);
INSERT INTO `campo` VALUES (522, 44, 'ds_latitude', 'varchar(255) DEFAULT NULL', 0, '', 28);
INSERT INTO `campo` VALUES (523, 44, 'ds_longitude', 'varchar(255) DEFAULT NULL', 0, '', 29);
INSERT INTO `campo` VALUES (524, 44, 'ds_nre', 'varchar(50) DEFAULT NULL', 0, '', 30);
INSERT INTO `campo` VALUES (525, 44, 'ds_ato_direto', 'varchar(240) DEFAULT NULL', 0, '', 31);
INSERT INTO `campo` VALUES (526, 44, 'me_secretaria', 'varchar(240) DEFAULT NULL', 0, '', 32);
INSERT INTO `campo` VALUES (527, 44, 'ds_ato_secretaria', 'varchar(240) DEFAULT NULL', 0, '', 33);
INSERT INTO `campo` VALUES (528, 44, 'ds_ato_ofic_estab', 'varchar(240) DEFAULT NULL', 0, '', 34);
INSERT INTO `campo` VALUES (529, 44, 'cd_instituicao_mec', 'int(11) DEFAULT NULL', 0, '', 35);
INSERT INTO `campo` VALUES (530, 44, 'sn_bloquear_financeiro', 'tinyint(1) DEFAULT NULL', 0, '', 36);
INSERT INTO `campo` VALUES (531, 44, 'dt_bloqueio_financeiro', 'datetime DEFAULT NULL', 0, '', 37);
INSERT INTO `campo` VALUES (532, 44, 'sn_bloquear_boleto', 'tinyint(1) DEFAULT NULL', 0, '', 38);
INSERT INTO `campo` VALUES (533, 44, 'dt_bloqueio_boleto', 'datetime DEFAULT NULL', 0, '', 39);
INSERT INTO `campo` VALUES (534, 45, 'cd_situacao', 'int(11) DEFAULT NULL', 0, '', 0);
INSERT INTO `campo` VALUES (535, 45, 'ds_situacao', 'varchar(15) DEFAULT NULL', 0, '', 1);
INSERT INTO `campo` VALUES (536, 45, 'ds_sigla_situacao', 'varchar(10) DEFAULT NULL', 0, '', 2);
INSERT INTO `campo` VALUES (537, 45, 'cd_situacao_pai', 'int(11) DEFAULT NULL', 0, '', 3);
INSERT INTO `campo` VALUES (538, 45, 'nr_ordem_final', 'int(11) DEFAULT NULL', 0, '', 4);
INSERT INTO `campo` VALUES (539, 45, 'cd_situacao_censo', 'int(11) DEFAULT NULL', 0, '', 5);
INSERT INTO `campo` VALUES (540, 45, 'sn_equivalencia', 'tinyint(1) DEFAULT \'0\'', 0, '', 6);
INSERT INTO `campo` VALUES (541, 45, 'sn_final', 'int(11) DEFAULT NULL', 0, '', 7);
INSERT INTO `campo` VALUES (542, 45, 'cd_situacao_curso', 'int(11) DEFAULT NULL', 0, '', 8);
INSERT INTO `campo` VALUES (543, 46, 'cd_usuario', 'int(11) unsigned DEFAULT \'0\'', 0, '', 0);
INSERT INTO `campo` VALUES (544, 46, 'ds_parametro', 'varchar(100) DEFAULT \'0\'', 0, '', 1);
INSERT INTO `campo` VALUES (545, 46, 'ds_valor', 'varchar(255) DEFAULT \'0\'', 0, '', 2);
INSERT INTO `campo` VALUES (546, 47, 'codigo', 'smallint(6) NOT NULL AUTO_INCREMENT', 0, '', 0);
INSERT INTO `campo` VALUES (547, 47, 'descricao', 'varchar(255) DEFAULT NULL', 0, '', 1);
INSERT INTO `campo` VALUES (548, 47, 'razaosocial', 'varchar(255) DEFAULT NULL', 0, '', 2);
INSERT INTO `campo` VALUES (549, 47, 'sn_online', 'char(1) DEFAULT \'S\'', 0, '', 3);
INSERT INTO `campo` VALUES (550, 47, 'cd_caixa', 'int(11) DEFAULT \'0\'', 0, '', 4);
INSERT INTO `campo` VALUES (551, 47, 'cd_coligada', 'smallint(6) unsigned NOT NULL DEFAULT \'1\'', 0, '', 5);
INSERT INTO `campo` VALUES (552, 47, 'cd_boleto_padrao', 'int(11) DEFAULT NULL', 0, '', 6);
INSERT INTO `campo` VALUES (553, 47, 'sn_alterar_boleto', 'tinyint(1) DEFAULT \'1\'', 0, '', 7);
INSERT INTO `campo` VALUES (554, 47, 'ds_cnpj', 'varchar(30) DEFAULT NULL', 0, '', 8);
INSERT INTO `campo` VALUES (555, 47, 'cd_boleto_online', 'int(11) DEFAULT NULL', 0, '', 9);
INSERT INTO `campo` VALUES (556, 47, 'ds_mascara_matricula', 'varchar(20) DEFAULT NULL', 0, '', 10);
INSERT INTO `campo` VALUES (557, 47, 'ds_endereco', 'varchar(100) DEFAULT NULL', 0, '', 11);
INSERT INTO `campo` VALUES (558, 47, 'ds_bairro', 'varchar(100) DEFAULT NULL', 0, '', 12);
INSERT INTO `campo` VALUES (559, 47, 'ds_cidade', 'varchar(100) DEFAULT NULL', 0, '', 13);
INSERT INTO `campo` VALUES (560, 47, 'ds_estado', 'varchar(3) DEFAULT NULL', 0, '', 14);
INSERT INTO `campo` VALUES (561, 47, 'ds_cep', 'varchar(9) DEFAULT NULL', 0, '', 15);
INSERT INTO `campo` VALUES (562, 47, 'cd_instituicao', 'smallint(6) unsigned DEFAULT NULL', 0, '', 16);
INSERT INTO `campo` VALUES (563, 47, 'cd_pessoa', 'int(11) DEFAULT NULL', 0, '', 17);
INSERT INTO `campo` VALUES (564, 47, 'ds_email_depto', 'varchar(255) DEFAULT NULL', 0, '', 18);
INSERT INTO `campo` VALUES (565, 48, 'cd_area', 'int(11) unsigned NOT NULL AUTO_INCREMENT', 1, '', 0);
INSERT INTO `campo` VALUES (566, 48, 'ds_area', 'varchar(255) DEFAULT NULL', 0, '', 1);
INSERT INTO `campo` VALUES (567, 48, 'me_observacoes', 'mediumtext', 0, '', 2);
INSERT INTO `campo` VALUES (568, 48, 'sn_extracurricular', 'tinyint(4) NOT NULL DEFAULT \'0\'', 0, '', 3);
INSERT INTO `campo` VALUES (569, 49, 'cd_curso', 'varchar(15) NOT NULL DEFAULT \'\'', 0, '', 0);
INSERT INTO `campo` VALUES (570, 49, 'ds_curso', 'varchar(255) DEFAULT NULL', 0, '', 1);
INSERT INTO `campo` VALUES (571, 49, 'ds_apelido', 'varchar(255) DEFAULT NULL', 0, '', 2);
INSERT INTO `campo` VALUES (572, 49, 'nr_grau', 'smallint(6) DEFAULT NULL', 0, '', 3);
INSERT INTO `campo` VALUES (573, 49, 'ds_habilitacao', 'varchar(255) DEFAULT \'\'', 0, '', 4);
INSERT INTO `campo` VALUES (574, 49, 'sn_ativo', 'char(1) DEFAULT \'S\'', 0, '', 5);
INSERT INTO `campo` VALUES (575, 49, 'nr_relevancia', 'smallint(6) NOT NULL DEFAULT \'1\'', 0, '', 6);
INSERT INTO `campo` VALUES (576, 49, 'cd_titulacao', 'int(11) DEFAULT NULL', 0, '', 7);
INSERT INTO `campo` VALUES (577, 49, 'nr_incremento', 'tinyint(4) DEFAULT NULL', 0, '', 8);
INSERT INTO `campo` VALUES (578, 49, 'id_curso', 'int(11) NOT NULL AUTO_INCREMENT', 0, 'Id auto increment. Importante', 9);
INSERT INTO `campo` VALUES (579, 49, 'cd_area', 'int(11) DEFAULT NULL', 0, '', 10);
INSERT INTO `campo` VALUES (580, 49, 'sn_nao_verif_disc_aprovadas', 'tinyint(4) NOT NULL DEFAULT \'0\'', 0, '', 11);
INSERT INTO `campo` VALUES (581, 49, 'dt_revisao', 'datetime DEFAULT \'0000-00-00 00:00:00\'', 0, '', 12);
INSERT INTO `campo` VALUES (582, 49, 'ds_mascara_serie', 'varchar(255) DEFAULT \'$SERIE\'', 0, '', 13);
INSERT INTO `campo` VALUES (583, 49, 'dt_base', 'timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP', 0, '', 14);
INSERT INTO `campo` VALUES (584, 50, 'cd_curso', 'varchar(15) NOT NULL', 0, '', 0);
INSERT INTO `campo` VALUES (585, 50, 'cd_curso_equivalente', 'varchar(15) DEFAULT NULL', 0, '', 1);
INSERT INTO `campo` VALUES (586, 50, 'cd_grade', 'int(11) DEFAULT NULL', 0, '', 2);
INSERT INTO `campo` VALUES (587, 50, 'ds_contrato', 'varchar(30) DEFAULT NULL', 0, '', 3);
INSERT INTO `campo` VALUES (588, 50, 'nr_carga_horaria', 'float DEFAULT NULL', 0, '', 4);
INSERT INTO `campo` VALUES (589, 50, 'cd_coligada', 'smallint(6) NOT NULL', 0, '', 5);
INSERT INTO `campo` VALUES (590, 50, 'cd_depto', 'smallint(6) NOT NULL', 0, '', 6);
INSERT INTO `campo` VALUES (591, 50, 'nr_dias_letivos', 'float DEFAULT NULL', 0, '', 7);
INSERT INTO `campo` VALUES (592, 50, 'nr_duracao_aula', 'float DEFAULT NULL', 0, '', 8);
INSERT INTO `campo` VALUES (593, 50, 'cd_curso_mec', 'int(11) DEFAULT NULL', 0, '', 9);
INSERT INTO `campo` VALUES (594, 50, 'cd_grau_mec', 'varchar(20) DEFAULT NULL', 0, '', 10);
INSERT INTO `campo` VALUES (595, 50, 'cd_habilitacao_mec', 'int(11) DEFAULT NULL', 0, '', 11);
INSERT INTO `campo` VALUES (596, 50, 'ds_nome_etapa', 'varchar(20) DEFAULT NULL', 0, '', 12);
INSERT INTO `campo` VALUES (597, 50, 'nr_series', 'smallint(6) DEFAULT NULL', 0, '', 13);
INSERT INTO `campo` VALUES (598, 50, 'me_observacoes', 'mediumtext', 0, '', 14);
INSERT INTO `campo` VALUES (599, 50, 'ds_requerimento', 'varchar(50) DEFAULT NULL', 0, '', 15);
INSERT INTO `campo` VALUES (600, 50, 'sn_academico', 'smallint(6) DEFAULT NULL', 0, '', 16);
INSERT INTO `campo` VALUES (601, 50, 'sn_ativo', 'smallint(1) NOT NULL DEFAULT \'1\'', 0, '', 17);
INSERT INTO `campo` VALUES (602, 50, 'dt_base', 'timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP', 0, '', 18);
INSERT INTO `campo` VALUES (603, 51, 'cd_sala', 'int(10) unsigned NOT NULL AUTO_INCREMENT', 1, '', 0);
INSERT INTO `campo` VALUES (604, 51, 'ds_sala', 'varchar(255) DEFAULT NULL', 0, '', 1);
INSERT INTO `campo` VALUES (605, 51, 'qtd_vagas', 'int(10) unsigned DEFAULT NULL', 0, '', 2);
INSERT INTO `campo` VALUES (606, 51, 'sn_ativo', 'tinyint(3) unsigned DEFAULT NULL', 0, '', 3);
INSERT INTO `campo` VALUES (607, 51, 'cd_fornecedor', 'int(10) unsigned DEFAULT NULL', 0, '', 4);
INSERT INTO `campo` VALUES (608, 51, 'nr_intervalo_uso', 'int(11) unsigned NOT NULL DEFAULT \'0\'', 0, '', 5);
INSERT INTO `campo` VALUES (609, 52, 'anosemestre', 'smallint(6) NOT NULL', 0, '', 0);
INSERT INTO `campo` VALUES (610, 52, 'codigo', 'varchar(50) NOT NULL', 0, 'Código da turma', 1);
INSERT INTO `campo` VALUES (611, 52, 'curso', 'varchar(15) NOT NULL', 0, 'Código do curso', 2);
INSERT INTO `campo` VALUES (612, 52, 'grau', 'smallint(6) DEFAULT NULL', 0, '', 3);
INSERT INTO `campo` VALUES (613, 52, 'serie', 'smallint(6) NOT NULL DEFAULT \'1\'', 0, '', 4);
INSERT INTO `campo` VALUES (614, 52, 'turno', 'char(1) DEFAULT NULL', 0, 'S = turno misto\nM = matutino\nN = noturno\nv = vespertino', 5);
INSERT INTO `campo` VALUES (615, 52, 'descricao', 'varchar(255) DEFAULT NULL', 0, '', 6);
INSERT INTO `campo` VALUES (616, 52, 'contrato', 'varchar(50) DEFAULT NULL', 0, '', 7);
INSERT INTO `campo` VALUES (617, 52, 'vagas', 'smallint(6) DEFAULT NULL', 0, 'Quantidade de vagas da turma', 8);
INSERT INTO `campo` VALUES (618, 52, 'sn_bloquear_vagas', 'tinyint(1) unsigned DEFAULT \'0\'', 0, '', 9);
INSERT INTO `campo` VALUES (619, 52, 'horainicio', 'datetime DEFAULT NULL', 0, '', 10);
INSERT INTO `campo` VALUES (620, 52, 'horafim', 'datetime DEFAULT NULL', 0, '', 11);
INSERT INTO `campo` VALUES (621, 52, 'datainicio', 'datetime DEFAULT NULL', 0, '', 12);
INSERT INTO `campo` VALUES (622, 52, 'datafim', 'datetime DEFAULT NULL', 0, '', 13);
INSERT INTO `campo` VALUES (623, 52, 'idadeconclusao', 'smallint(6) DEFAULT NULL', 0, '', 14);
INSERT INTO `campo` VALUES (624, 52, 'dataconclusao', 'datetime DEFAULT NULL', 0, '', 15);
INSERT INTO `campo` VALUES (625, 52, 'diassemanaisletivos', 'double DEFAULT NULL', 0, '', 16);
INSERT INTO `campo` VALUES (626, 52, 'horarioletivo', 'varchar(50) DEFAULT NULL', 0, '', 17);
INSERT INTO `campo` VALUES (627, 52, 'horasaula', 'varchar(20) DEFAULT NULL', 0, '', 18);
INSERT INTO `campo` VALUES (628, 52, 'obshistorico', 'mediumtext', 0, '', 19);
INSERT INTO `campo` VALUES (629, 52, 'vl_ordem', 'smallint(5) unsigned DEFAULT NULL', 0, '', 20);
INSERT INTO `campo` VALUES (630, 52, 'professor_responsavel', 'int(11) DEFAULT NULL', 0, '', 21);
INSERT INTO `campo` VALUES (631, 52, 'sn_inscricao_online', 'char(1) DEFAULT NULL', 0, '', 22);
INSERT INTO `campo` VALUES (632, 52, 'cd_avaliacao', 'smallint(6) unsigned DEFAULT NULL', 0, '', 23);
INSERT INTO `campo` VALUES (633, 52, 'cd_campus', 'int(11) unsigned DEFAULT \'0\'', 0, '', 24);
INSERT INTO `campo` VALUES (634, 52, 'cd_proxima_turma', 'varchar(50) DEFAULT NULL', 0, '', 25);
INSERT INTO `campo` VALUES (635, 52, 'cd_centro', 'int(11) unsigned DEFAULT NULL', 0, '', 26);
INSERT INTO `campo` VALUES (636, 52, 'sn_terminal_acesso', 'tinyint(1) unsigned NOT NULL DEFAULT \'0\'', 0, '', 27);
INSERT INTO `campo` VALUES (637, 52, 'cd_caixa', 'int(11) unsigned DEFAULT NULL', 0, '', 28);
INSERT INTO `campo` VALUES (638, 52, 'sn_alterar_boleto', 'tinyint(1) unsigned DEFAULT \'1\'', 0, '', 29);
INSERT INTO `campo` VALUES (639, 52, 'cd_coligada', 'smallint(6) unsigned NOT NULL DEFAULT \'1\'', 0, '', 30);
INSERT INTO `campo` VALUES (640, 52, 'nr_min_alunos', 'smallint(6) DEFAULT NULL', 0, '', 31);
INSERT INTO `campo` VALUES (641, 52, 'cd_grade', 'int(11) unsigned DEFAULT \'0\'', 0, '', 32);
INSERT INTO `campo` VALUES (642, 52, 'sn_bloquear_disc_pendentes', 'tinyint(1) DEFAULT \'0\'', 0, '', 33);
INSERT INTO `campo` VALUES (643, 52, 'cd_etapa_mec', 'int(11) DEFAULT NULL', 0, '', 34);
INSERT INTO `campo` VALUES (644, 52, 'cd_unidade_certificadora', 'int(11) unsigned DEFAULT NULL', 0, '', 35);
INSERT INTO `campo` VALUES (645, 52, 'sn_turma_especial', 'tinyint(4) NOT NULL DEFAULT \'0\' COMMENT \'0 = turma não é especial, 1 = turma é especial\'', 0, '', 36);
INSERT INTO `campo` VALUES (646, 52, 'id_turma', 'int(11) unsigned NOT NULL AUTO_INCREMENT', 1, '', 37);
INSERT INTO `campo` VALUES (647, 52, 'cd_sala', 'int(10) unsigned DEFAULT NULL', 0, '', 38);
INSERT INTO `campo` VALUES (648, 52, 'sn_ativa', 'smallint(6) DEFAULT \'1\'', 0, '', 39);
INSERT INTO `campo` VALUES (649, 52, 'obscontrato', 'mediumtext', 0, '', 40);
INSERT INTO `campo` VALUES (650, 52, 'obsgerais', 'mediumtext', 0, '', 41);
INSERT INTO `campo` VALUES (651, 52, 'cd_situacao', 'tinyint(3) unsigned DEFAULT NULL', 0, '', 42);
INSERT INTO `campo` VALUES (652, 52, 'dt_inicio_monografia', 'datetime DEFAULT NULL', 0, '', 43);
INSERT INTO `campo` VALUES (653, 52, 'dt_fim_monografia', 'datetime DEFAULT NULL', 0, '', 44);
INSERT INTO `campo` VALUES (654, 52, 'professor_responsavel2', 'int(11) DEFAULT NULL', 0, '', 45);
INSERT INTO `campo` VALUES (655, 52, 'SN_USAR_PLANO', 'tinyint(1) unsigned NOT NULL DEFAULT \'1\'', 0, '', 46);
INSERT INTO `campo` VALUES (656, 52, 'CD_PLANO_PADRAO', 'int(11) DEFAULT NULL', 0, '', 47);
INSERT INTO `campo` VALUES (657, 52, 'dt_inicio_financeiro', 'datetime DEFAULT NULL', 0, '', 48);
INSERT INTO `campo` VALUES (658, 52, 'dt_fim_financeiro', 'datetime DEFAULT NULL', 0, '', 49);
INSERT INTO `campo` VALUES (659, 52, 'sn_cronograma_geren_inicio_fim', 'tinyint(1) unsigned NOT NULL DEFAULT \'0\'', 0, '', 50);
INSERT INTO `campo` VALUES (660, 52, 'sn_exporta_moodle', 'tinyint(1) unsigned NOT NULL DEFAULT \'0\'', 0, '', 51);
INSERT INTO `campo` VALUES (661, 52, 'cd_proximo_curso', 'varchar(15) DEFAULT NULL', 0, '', 52);
INSERT INTO `campo` VALUES (662, 52, 'sn_proximo_curso', 'tinyint(1) NOT NULL DEFAULT \'0\'', 0, '', 53);
INSERT INTO `campo` VALUES (663, 52, 'sn_matricula_mesmo_anosem', 'tinyint(4) NOT NULL DEFAULT \'0\'', 0, '', 54);
INSERT INTO `campo` VALUES (664, 52, 'dt_revisao', 'timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP', 0, '', 55);
INSERT INTO `campo` VALUES (665, 52, 'cd_proxima_turma_repr', 'varchar(50) DEFAULT NULL', 0, '', 56);
INSERT INTO `campo` VALUES (666, 53, 'cd_avaliacao', '', 0, 'Criado automaticamente pela leitura da SQL - verificar propriedades', 0);
INSERT INTO `campo` VALUES (724, 55, 'cd_plano', 'int(11) NOT NULL AUTO_INCREMENT', 1, '', 0);
INSERT INTO `campo` VALUES (725, 55, 'cd_coligada', 'smallint(6) unsigned NOT NULL DEFAULT \'1\'', 0, '', 1);
INSERT INTO `campo` VALUES (726, 55, 'cd_tipo_plano', 'smallint(6) unsigned NOT NULL DEFAULT \'1\'', 0, 'fin_config_tipos_titulo TODO', 2);
INSERT INTO `campo` VALUES (727, 55, 'ds_plano', 'varchar(50) DEFAULT NULL', 0, '', 3);
INSERT INTO `campo` VALUES (728, 55, 'nr_anosemestre', 'smallint(6) DEFAULT NULL', 0, '', 4);
INSERT INTO `campo` VALUES (729, 55, 'nr_parcelas', 'smallint(6) DEFAULT NULL', 0, '', 5);
INSERT INTO `campo` VALUES (730, 55, 'vl_cobrado', 'double DEFAULT NULL', 0, '', 6);
INSERT INTO `campo` VALUES (731, 55, 'vl_contrato', 'double DEFAULT NULL', 0, '', 7);
INSERT INTO `campo` VALUES (732, 55, 'vl_taxamaterial', 'double DEFAULT NULL', 0, '', 8);
INSERT INTO `campo` VALUES (733, 55, 'vl_taxaapostila', 'double DEFAULT NULL', 0, '', 9);
INSERT INTO `campo` VALUES (734, 55, 'vl_desconto', 'double DEFAULT NULL', 0, '', 10);
INSERT INTO `campo` VALUES (735, 55, 'vl_matricula', 'double DEFAULT NULL', 0, '', 11);
INSERT INTO `campo` VALUES (736, 55, 'dt_apartir', 'datetime DEFAULT NULL', 0, '', 12);
INSERT INTO `campo` VALUES (737, 55, 'nr_taxasmaterial', 'smallint(6) DEFAULT NULL', 0, '', 13);
INSERT INTO `campo` VALUES (738, 55, 'ds_paragrafo3', 'varchar(150) DEFAULT NULL', 0, '', 14);
INSERT INTO `campo` VALUES (739, 55, 'nr_dias_parcela_zero', 'tinyint(4) DEFAULT \'0\'', 0, '', 15);
INSERT INTO `campo` VALUES (740, 55, 'sn_dias_uteis', 'tinyint(1) NOT NULL DEFAULT \'1\'', 0, '', 16);
INSERT INTO `campo` VALUES (741, 55, 'sn_creditos', 'tinyint(1) NOT NULL DEFAULT \'0\'', 0, '', 17);
INSERT INTO `campo` VALUES (742, 55, 'nr_creditos_base', 'double NOT NULL DEFAULT \'0\'', 0, '', 18);
INSERT INTO `campo` VALUES (743, 55, 'nr_max_disciplinas', 'int(11) unsigned DEFAULT NULL', 0, '', 19);
INSERT INTO `campo` VALUES (744, 55, 'ds_dias_vencto', 'char(31) NOT NULL DEFAULT \'0000000000000000000000000000000\'', 0, '', 20);
INSERT INTO `campo` VALUES (745, 55, 'sn_pular_sabados', 'tinyint(1) unsigned NOT NULL DEFAULT \'0\'', 0, '', 21);
INSERT INTO `campo` VALUES (746, 55, 'sn_pular_domingos', 'tinyint(1) unsigned NOT NULL DEFAULT \'0\'', 0, '', 22);
INSERT INTO `campo` VALUES (747, 55, 'sn_pular_feriados', 'tinyint(1) unsigned NOT NULL DEFAULT \'0\'', 0, '', 23);
INSERT INTO `campo` VALUES (748, 55, 'dt_vigencia_inicio', 'datetime DEFAULT NULL', 0, '', 24);
INSERT INTO `campo` VALUES (749, 55, 'dt_vigencia_fim', 'datetime DEFAULT NULL', 0, '', 25);
INSERT INTO `campo` VALUES (750, 55, 'sn_vigencia', 'tinyint(1) NOT NULL', 0, '', 26);
INSERT INTO `campo` VALUES (751, 55, 'cd_acao_movimento_desc_cond', 'int(10) unsigned DEFAULT NULL', 0, '', 27);
INSERT INTO `campo` VALUES (752, 55, 'cd_acao_movimento_desc_fixo', 'int(10) unsigned DEFAULT NULL', 0, '', 28);
INSERT INTO `campo` VALUES (753, 55, 'sn_usar_matricula_online', 'tinyint(1) unsigned NOT NULL DEFAULT \'1\'', 0, '', 29);
INSERT INTO `campo` VALUES (754, 55, 'nr_ordem', 'int(10) unsigned DEFAULT NULL', 0, '', 30);
INSERT INTO `campo` VALUES (755, 55, 'nr_tipo_vencto', 'tinyint(3) unsigned NOT NULL DEFAULT \'0\'', 0, '', 31);
INSERT INTO `campo` VALUES (756, 55, 'nr_formula_vencto', 'tinyint(3) unsigned DEFAULT NULL', 0, '', 32);
INSERT INTO `campo` VALUES (757, 55, 'nr_formula_operador', 'tinyint(3) unsigned DEFAULT NULL', 0, '', 33);
INSERT INTO `campo` VALUES (758, 55, 'nr_formula_dias', 'smallint(5) unsigned DEFAULT NULL', 0, '', 34);
INSERT INTO `campo` VALUES (759, 55, 'sn_ativo', 'tinyint(4) NOT NULL DEFAULT \'1\'', 0, '', 35);
INSERT INTO `campo` VALUES (760, 55, 'dt_base', 'timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP', 0, '', 36);
INSERT INTO `campo` VALUES (761, 55, 'cd_plano_novo_equivalente', 'int(11) DEFAULT NULL', 0, '', 37);
INSERT INTO `campo` VALUES (762, 56, 'cd_plano_novo_equivalente', '', 0, 'Criado automaticamente pela leitura da SQL - verificar propriedades', 0);

-- ----------------------------
-- Table structure for sistema
-- ----------------------------
DROP TABLE IF EXISTS `sistema`;
CREATE TABLE `sistema`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ds_nome` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of sistema
-- ----------------------------
INSERT INTO `sistema` VALUES (1, 'Unimestre');
INSERT INTO `sistema` VALUES (2, 'Moodle');
INSERT INTO `sistema` VALUES (3, 'Gateway de Pagamento');

-- ----------------------------
-- Table structure for tabela
-- ----------------------------
DROP TABLE IF EXISTS `tabela`;
CREATE TABLE `tabela`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sistema_id` int(11) NOT NULL,
  `ds_nome` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `sn_temporario` tinyint(1) NOT NULL,
  `sn_excluido` tinyint(1) NOT NULL,
  `ds_descricao` longtext CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `ds_tag` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `IDX_A9EDF3AF17CDA208`(`sistema_id`) USING BTREE,
  CONSTRAINT `FK_A9EDF3AF17CDA208` FOREIGN KEY (`sistema_id`) REFERENCES `sistema` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 57 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of tabela
-- ----------------------------
INSERT INTO `tabela` VALUES (2, 2, 'mdl_user', 0, 0, 'Usuário do Moodle', NULL);
INSERT INTO `tabela` VALUES (3, 2, 'mdl_course', 0, 0, 'Cursos', NULL);
INSERT INTO `tabela` VALUES (4, 2, 'mdl_groups', 0, 0, 'Grupos que podem conter usuários e estão ligados a cursos', NULL);
INSERT INTO `tabela` VALUES (5, 2, 'mdl_enrol', 0, 0, 'Formato de matricula em um curso', NULL);
INSERT INTO `tabela` VALUES (6, 2, 'mdl_user_enrolments', 0, 0, 'Matricula dos alunos', NULL);
INSERT INTO `tabela` VALUES (7, 1, 'api_log_qb', 0, 0, 'Salva os logs de requisição a API do Quero Bolsas. API: projetos/api/index.php?api=quero_bolsa.v2.ApiQueroBolsaWebhook\n\n', NULL);
INSERT INTO `tabela` VALUES (8, 1, 'api_log', 0, 0, 'A proposta desta tabela é salvar a requisição para qualquer api realizada no UNIMESTRE. Se a API extender a classe ApiUnimestre, deverá salvar nessa tabela o log da execução.', NULL);
INSERT INTO `tabela` VALUES (9, 1, 'mensalidades', 0, 0, 'Mensalidades e titulos a serem pagos pelos alunos', NULL);
INSERT INTO `tabela` VALUES (10, 1, 'pessoas', 0, 0, 'Todas as pessoas', NULL);
INSERT INTO `tabela` VALUES (12, 1, 'parametros', 0, 0, 'Parâmetros utilizados no acadêmico', NULL);
INSERT INTO `tabela` VALUES (13, 1, 'nu_grupos', 0, 0, 'Grupos de usuário do sistema', 'acesso');
INSERT INTO `tabela` VALUES (14, 1, 'nu_papeis', 0, 0, 'É o papel que um usuário pode ter no sistema.  nu_papeis -> nu_grupos', NULL);
INSERT INTO `tabela` VALUES (15, 1, 'coligadas', 0, 0, 'É o cliente - ou unidades do cliente utilizado pelo UNIMESTRE como identificador da instituição', 'coligada');
INSERT INTO `tabela` VALUES (16, 1, 'nu_grupos_pessoas', 0, 0, 'Em que grupo e coligada a pessoa esta', 'acesso');
INSERT INTO `tabela` VALUES (17, 1, 'nu_modulos', 0, 0, 'Módulos do sistema\n- Verificar também as funções:\nFCD_GRUPOS_ESTUDANTES\nSPA_ATUALIZA_GRUPOS_PESSOA', 'permissão');
INSERT INTO `tabela` VALUES (18, 1, 'nu_modulos_acoes', 0, 0, 'Ações que os usuários podem fazer no sistema - regra de permissão', 'permissão, acesso');
INSERT INTO `tabela` VALUES (19, 1, 'nu_grupos_permissoes', 0, 0, 'Permissões dos grupos', 'acesso, permissão');
INSERT INTO `tabela` VALUES (20, 1, 'fin_cadastro_contas', 0, 0, 'Cadastro de contas bancárias do cliente', 'financeiro');
INSERT INTO `tabela` VALUES (21, 1, 'fin_cadastro_contas_tipos', 0, 0, 'Tipos de contas que podem existir.\nConta Corrente - Poupança - Caixa - Conta Interna', 'Financeiro');
INSERT INTO `tabela` VALUES (22, 3, 'saas_log', 0, 0, '', '');
INSERT INTO `tabela` VALUES (23, 3, 'saas_log_webhook', 0, 0, '', '');
INSERT INTO `tabela` VALUES (24, 3, 'saas_cliente', 0, 0, '', '');
INSERT INTO `tabela` VALUES (25, 3, 'saas_gateway', 0, 0, '', '');
INSERT INTO `tabela` VALUES (26, 3, 'admin_grupo', 0, 0, '', '');
INSERT INTO `tabela` VALUES (27, 3, 'admin_sistema_acao', 0, 0, '', '');
INSERT INTO `tabela` VALUES (28, 3, 'admin_grupo_sistema_acao', 0, 0, '', '');
INSERT INTO `tabela` VALUES (29, 3, 'admin_usuario', 0, 0, '', '');
INSERT INTO `tabela` VALUES (30, 3, 'admin_usuario_grupo', 0, 0, '', '');
INSERT INTO `tabela` VALUES (31, 3, 'admin_usuario_saas_cliente', 0, 0, '', '');
INSERT INTO `tabela` VALUES (33, 3, 'saas_gateway_pessoa', 0, 0, '', '');
INSERT INTO `tabela` VALUES (34, 3, 'saas_pessoa', 0, 0, '', '');
INSERT INTO `tabela` VALUES (35, 3, 'saas_cliente_gateway', 0, 0, '', '');
INSERT INTO `tabela` VALUES (37, 1, 'fin_acoes_tipos', 0, 0, 'Ações que podem ocorrer no financeiro em relação a uma mensalidade. Exemplos: Baixa por Pagamento - Baixa por Cancelamento - Baixa por Desconto - Geração de Título - Lançamento na Tesouraria', 'financeiro');
INSERT INTO `tabela` VALUES (38, 1, 'fin_config_plano_contas', 0, 0, 'Representa o PLANO de CONTAS da instituição - contábil\nPlano de contas é o agrupamento ordenado de todas as contas que serão utilizadas pela contabilidade.', 'financeiro, contabilidade');
INSERT INTO `tabela` VALUES (39, 1, 'fin_acoes_movimento', 0, 0, 'Identifica as ações que podem ser realizados nos caixas / mensalidades do financeiro', 'financeiro');
INSERT INTO `tabela` VALUES (40, 1, 'fin_mov_tesouraria', 0, 0, 'Local aonde fica armazenado o dinheiro.  Possui todos os movimentos de entrada e saída em um determinado caixa.', 'financeiro');
INSERT INTO `tabela` VALUES (41, 1, 'integracao_qb_mensalidade', 0, 0, 'Armazena todas as ligações de mensalidades entre o sistema UNIMESTRE e o sistema quero bolsa - bill e bill_id', 'quero_bolsa, integração, financeiro');
INSERT INTO `tabela` VALUES (42, 1, 'integracao_qb_matricula', 0, 0, 'Salva a informação das matriculas vindas do quero bolsa', 'quero bolsa, integração, matricula');
INSERT INTO `tabela` VALUES (43, 1, 'nu_parametros', 0, 0, 'Parâmetros do sistema', 'parametros, configurações');
INSERT INTO `tabela` VALUES (44, 1, 'coligadas_matriz', 0, 0, 'Informa as coligadas matrizes da instituição', 'coligada');
INSERT INTO `tabela` VALUES (45, 1, 'situacao', 0, 0, 'Situações de Matricula', 'matricula');
INSERT INTO `tabela` VALUES (46, 1, 'usuarios_parametros', 0, 0, 'Parâmetros de telas salvos para cada usuário', '');
INSERT INTO `tabela` VALUES (47, 1, 'departamentos', 0, 0, 'Está ligado diretamente a uma coligada. Seria os dados de departamento da coligada.', 'coligada');
INSERT INTO `tabela` VALUES (48, 1, 'cursos_areas_atuacao', 0, 0, 'areas de atuação', 'curso');
INSERT INTO `tabela` VALUES (49, 1, 'cursos_mestre', 0, 0, 'Cursos da instituição', 'curso');
INSERT INTO `tabela` VALUES (50, 1, 'cursos_coligadas', 0, 0, 'Ligação entre curso e coligada', 'curso, coligada');
INSERT INTO `tabela` VALUES (51, 1, 'uni_salas', 0, 0, 'cadastro de salas da instituição', '');
INSERT INTO `tabela` VALUES (52, 1, 'turmas', 0, 0, 'Cadastro de turmas', '');
INSERT INTO `tabela` VALUES (53, 1, 'avaliacoes_parametros_matriz', 0, 0, '', '');
INSERT INTO `tabela` VALUES (55, 1, 'fin_planos', 0, 0, 'Cadastro de Planos de Pagamento', 'financeiro, plano pagamento');
INSERT INTO `tabela` VALUES (56, 1, 'fin_planos_pgto', 0, 0, '', '');

-- ----------------------------
-- Table structure for tabela_chave
-- ----------------------------
DROP TABLE IF EXISTS `tabela_chave`;
CREATE TABLE `tabela_chave`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tabela_origem_id` int(11) NULL DEFAULT NULL,
  `tabela_destino_id` int(11) NULL DEFAULT NULL,
  `tipo_de_chave_id` int(11) NULL DEFAULT NULL,
  `campo_origem_id` int(11) NULL DEFAULT NULL,
  `campo_destino_id` int(11) NULL DEFAULT NULL,
  `nr_grupo` int(11) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `IDX_74D055FCF1B59830`(`tabela_origem_id`) USING BTREE,
  INDEX `IDX_74D055FC60F81562`(`tabela_destino_id`) USING BTREE,
  INDEX `IDX_74D055FCE2744C64`(`tipo_de_chave_id`) USING BTREE,
  INDEX `IDX_74D055FC140AE340`(`campo_origem_id`) USING BTREE,
  INDEX `IDX_74D055FC3018DB25`(`campo_destino_id`) USING BTREE,
  CONSTRAINT `FK_74D055FC140AE340` FOREIGN KEY (`campo_origem_id`) REFERENCES `campo` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `FK_74D055FC3018DB25` FOREIGN KEY (`campo_destino_id`) REFERENCES `campo` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `FK_74D055FC60F81562` FOREIGN KEY (`tabela_destino_id`) REFERENCES `tabela` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `FK_74D055FCE2744C64` FOREIGN KEY (`tipo_de_chave_id`) REFERENCES `tipo_de_chave` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `FK_74D055FCF1B59830` FOREIGN KEY (`tabela_origem_id`) REFERENCES `tabela` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 88 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of tabela_chave
-- ----------------------------
INSERT INTO `tabela_chave` VALUES (1, 6, NULL, 3, 3, NULL, 0);
INSERT INTO `tabela_chave` VALUES (2, 6, NULL, 3, 4, NULL, 0);
INSERT INTO `tabela_chave` VALUES (3, 4, 3, 1, 24, 18, 0);
INSERT INTO `tabela_chave` VALUES (4, 6, 5, 1, 3, 32, 0);
INSERT INTO `tabela_chave` VALUES (5, 6, 2, 1, 4, 10, 0);
INSERT INTO `tabela_chave` VALUES (6, 13, 14, 1, 200, 202, 0);
INSERT INTO `tabela_chave` VALUES (7, 13, NULL, 3, 195, NULL, 0);
INSERT INTO `tabela_chave` VALUES (8, 13, NULL, 3, 196, NULL, 1);
INSERT INTO `tabela_chave` VALUES (9, 14, NULL, 3, 202, NULL, 0);
INSERT INTO `tabela_chave` VALUES (10, 16, NULL, 3, 246, NULL, 0);
INSERT INTO `tabela_chave` VALUES (11, 16, NULL, 3, 70, NULL, 1);
INSERT INTO `tabela_chave` VALUES (12, 16, NULL, 3, 195, NULL, 1);
INSERT INTO `tabela_chave` VALUES (13, 16, NULL, 3, 194, NULL, 1);
INSERT INTO `tabela_chave` VALUES (14, 16, 13, 1, 247, 195, 0);
INSERT INTO `tabela_chave` VALUES (15, 16, 10, 1, 248, 70, 0);
INSERT INTO `tabela_chave` VALUES (16, 16, 15, 1, 249, 205, 0);
INSERT INTO `tabela_chave` VALUES (17, 17, NULL, 3, 250, NULL, 0);
INSERT INTO `tabela_chave` VALUES (18, 17, NULL, 3, 253, NULL, 1);
INSERT INTO `tabela_chave` VALUES (19, 17, NULL, 3, 253, NULL, 0);
INSERT INTO `tabela_chave` VALUES (20, 18, NULL, 3, 261, NULL, 0);
INSERT INTO `tabela_chave` VALUES (21, 18, NULL, 3, 250, NULL, 1);
INSERT INTO `tabela_chave` VALUES (22, 18, NULL, 3, 253, NULL, 1);
INSERT INTO `tabela_chave` VALUES (23, 18, NULL, 3, 264, NULL, 0);
INSERT INTO `tabela_chave` VALUES (24, 19, NULL, 3, 266, NULL, 0);
INSERT INTO `tabela_chave` VALUES (25, 19, NULL, 3, 195, NULL, 1);
INSERT INTO `tabela_chave` VALUES (26, 19, NULL, 3, 261, NULL, 1);
INSERT INTO `tabela_chave` VALUES (27, 19, 13, 1, 267, 195, 0);
INSERT INTO `tabela_chave` VALUES (28, 19, 18, 1, 268, 261, 0);
INSERT INTO `tabela_chave` VALUES (29, 20, 15, 1, 271, 205, 0);
INSERT INTO `tabela_chave` VALUES (30, 21, NULL, 3, 332, NULL, 0);
INSERT INTO `tabela_chave` VALUES (31, 20, 21, 1, 275, 331, 0);
INSERT INTO `tabela_chave` VALUES (32, 23, 24, 1, 337, 341, 0);
INSERT INTO `tabela_chave` VALUES (33, 23, 25, 1, 338, 342, 0);
INSERT INTO `tabela_chave` VALUES (34, 26, NULL, 3, 253, NULL, 0);
INSERT INTO `tabela_chave` VALUES (35, 27, NULL, 3, 253, NULL, 0);
INSERT INTO `tabela_chave` VALUES (36, 28, 26, 1, 352, 343, 0);
INSERT INTO `tabela_chave` VALUES (37, 28, 27, 1, 353, 347, 0);
INSERT INTO `tabela_chave` VALUES (38, 29, NULL, 3, 126, NULL, 0);
INSERT INTO `tabela_chave` VALUES (39, 30, 29, 1, 362, 355, 0);
INSERT INTO `tabela_chave` VALUES (40, 30, 26, 1, 363, 343, 0);
INSERT INTO `tabela_chave` VALUES (41, 31, 29, 1, 366, 355, 0);
INSERT INTO `tabela_chave` VALUES (42, 31, 24, 1, 367, NULL, 0);
INSERT INTO `tabela_chave` VALUES (44, 33, 34, 1, 376, 379, 0);
INSERT INTO `tabela_chave` VALUES (45, 33, 25, 1, 375, NULL, 0);
INSERT INTO `tabela_chave` VALUES (46, 35, 24, 1, 381, NULL, 0);
INSERT INTO `tabela_chave` VALUES (47, 35, 25, 1, 382, NULL, 0);
INSERT INTO `tabela_chave` VALUES (48, 38, 15, 1, 389, 205, 0);
INSERT INTO `tabela_chave` VALUES (49, 38, 10, 1, 413, 70, 0);
INSERT INTO `tabela_chave` VALUES (50, 39, NULL, 3, 423, NULL, 0);
INSERT INTO `tabela_chave` VALUES (51, 39, 37, 1, 417, 384, 0);
INSERT INTO `tabela_chave` VALUES (52, 39, 39, 1, 418, 415, 0);
INSERT INTO `tabela_chave` VALUES (53, 39, 39, 1, 422, 422, 0);
INSERT INTO `tabela_chave` VALUES (55, 39, 38, 1, 424, 388, 0);
INSERT INTO `tabela_chave` VALUES (56, 42, NULL, 3, 473, NULL, 0);
INSERT INTO `tabela_chave` VALUES (57, 41, 9, 1, 461, 50, 0);
INSERT INTO `tabela_chave` VALUES (58, 42, 10, 1, 471, 70, 0);
INSERT INTO `tabela_chave` VALUES (59, 43, NULL, 3, 482, NULL, 0);
INSERT INTO `tabela_chave` VALUES (60, 43, NULL, 3, 483, NULL, 1);
INSERT INTO `tabela_chave` VALUES (61, 43, NULL, 3, 250, NULL, 1);
INSERT INTO `tabela_chave` VALUES (62, 43, NULL, 3, 194, NULL, 1);
INSERT INTO `tabela_chave` VALUES (63, 43, 17, 1, 487, 250, 0);
INSERT INTO `tabela_chave` VALUES (64, 43, 15, 1, 492, 205, 0);
INSERT INTO `tabela_chave` VALUES (65, 44, NULL, 3, 206, NULL, 0);
INSERT INTO `tabela_chave` VALUES (66, 15, 44, 1, 229, 494, 0);
INSERT INTO `tabela_chave` VALUES (67, 15, 44, 1, 229, 494, 0);
INSERT INTO `tabela_chave` VALUES (68, 45, 45, 1, 537, 534, 0);
INSERT INTO `tabela_chave` VALUES (69, 46, 10, 1, 543, 70, 0);
INSERT INTO `tabela_chave` VALUES (70, 47, 20, 1, 550, 270, 0);
INSERT INTO `tabela_chave` VALUES (71, 47, 15, 1, 551, 205, 0);
INSERT INTO `tabela_chave` VALUES (72, 47, 10, 1, 563, 70, 0);
INSERT INTO `tabela_chave` VALUES (73, 49, NULL, 3, 578, NULL, 0);
INSERT INTO `tabela_chave` VALUES (74, 50, 49, 1, 584, 569, 0);
INSERT INTO `tabela_chave` VALUES (75, 52, 53, 1, 632, 666, 0);
INSERT INTO `tabela_chave` VALUES (76, 52, 51, 1, 647, 603, 0);
INSERT INTO `tabela_chave` VALUES (77, 52, NULL, 3, 609, NULL, 0);
INSERT INTO `tabela_chave` VALUES (78, 52, NULL, 3, 546, NULL, 0);
INSERT INTO `tabela_chave` VALUES (83, 52, 20, 1, 637, 270, 0);
INSERT INTO `tabela_chave` VALUES (84, 52, 15, 1, 639, 205, 0);
INSERT INTO `tabela_chave` VALUES (85, 50, 47, 1, 590, 546, 0);
INSERT INTO `tabela_chave` VALUES (86, 55, 56, 1, 761, 762, 0);
INSERT INTO `tabela_chave` VALUES (87, 55, 15, 1, 725, 205, 0);

-- ----------------------------
-- Table structure for tipo_de_chave
-- ----------------------------
DROP TABLE IF EXISTS `tipo_de_chave`;
CREATE TABLE `tipo_de_chave`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ds_nome` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `ds_chave` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of tipo_de_chave
-- ----------------------------
INSERT INTO `tipo_de_chave` VALUES (1, 'Foreing Key', 'FOREING_KEY');
INSERT INTO `tipo_de_chave` VALUES (2, 'Chave Logica', 'LOGIC_KEY');
INSERT INTO `tipo_de_chave` VALUES (3, 'Chave Unica', 'UNIQUE_KEY');

SET FOREIGN_KEY_CHECKS = 1;
