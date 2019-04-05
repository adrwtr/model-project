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

 Date: 04/04/2019 16:47:15
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
) ENGINE = InnoDB AUTO_INCREMENT = 270 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

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
INSERT INTO `campo` VALUES (229, 15, 'CD_COLIGADA_MATRIZ', 'int(5) DEFAULT NULL', 0, '', 24);
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
INSERT INTO `campo` VALUES (269, 19, 'nr_permissao', 'int(11) NOT NULL DEFAULT \'0\'', 0, '', 3);

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
) ENGINE = InnoDB AUTO_INCREMENT = 20 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

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
INSERT INTO `tabela` VALUES (15, 1, 'coligadas', 0, 0, 'É o cliente - ou unidades do cliente utilizado pelo UNIMESTRE como identificador da instituição', NULL);
INSERT INTO `tabela` VALUES (16, 1, 'nu_grupos_pessoas', 0, 0, 'Em que grupo e coligada a pessoa esta', 'acesso');
INSERT INTO `tabela` VALUES (17, 1, 'nu_modulos', 0, 0, 'Módulos do sistema', 'permissão');
INSERT INTO `tabela` VALUES (18, 1, 'nu_modulos_acoes', 0, 0, 'Ações que os usuários podem fazer no sistema - regra de permissão', 'permissão, acesso');
INSERT INTO `tabela` VALUES (19, 1, 'nu_grupos_permissoes', 0, 0, '', '');

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
) ENGINE = InnoDB AUTO_INCREMENT = 27 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

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
