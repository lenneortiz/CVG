
--
-- Estructura de tabla para la tabla `intento_login`
--
CREATE TABLE intento_login (
  user_id int(11) NOT NULL,
  tiempo varchar(30) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Estructura de tabla para la tabla `user`
--
CREATE TABLE user (
  iduser int(11) NOT NULL NOT NULL AUTO_INCREMENT,
  foto varchar(100) COLLATE utf8_spanish_ci DEFAULT 'avatar.png',
  nombre varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  usuario varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  correo varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  pass varchar(60) COLLATE utf8_spanish_ci NOT NULL,
  estado tinyint(4) DEFAULT NULL,
  created timestamp default now(),
  modified timestamp default now() on update now(),
PRIMARY KEY(iduser)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;


--
-- Volcado de datos para la tabla `user`
--

INSERT INTO `user` (`iduser`, `foto`, `nombre`, `usuario`, `correo`, `pass`, `estado`, `created`, `modified`) VALUES
(1, '651283.jpg', 'Lenne', 'lenne_35', 'yamirokuay.lo@gmail.com', '$2y$10$Z6nhm6xS.HiyOZ6l.5uqGeaPJmr5sbLOs2.k07dbKyTaspsS.FEJO', 1, '2017-08-17 14:43:32', '2017-08-17 15:30:14'),
(2, '457025.jpg', 'Pepe', 'pepe2020', 'pepe20@gmail.com', '$2y$10$tsPdd0jfikEIXw1GJeDbxOLy9ulsS9V2CWen0N8e6ZiE7rZB0hmRK', 1, '2017-08-17 14:43:32', '2017-08-17 14:43:32'),
(3, '424489.jpg', 'Luis', 'luis135', 'l_j@gmail.com', '$2y$10$G9QyiDOKRtYfNVEBclcXt.qUAgWt7O7iGucdI0bT8GNz1XTEygpoW', 1, '2017-08-17 14:43:32', '2017-08-17 14:43:32'),
(4, '279884.jpg', 'Maria', 'maria23', 'm.lo@gmail.com', '$2y$10$MV9hGvrc5iQoEFZkKYZxNuU2T0uK4htW9prtJHG5vqh4TqfrufDaK', 1, '2017-08-17 14:43:32', '2017-08-17 14:43:32'),
(5, '366823.jpg', 'Jesus', 'j_9_245', 'j2020@gmail.com', '$2y$10$2NWuu2L6Pbdg47L5Gel6fOE.9Sh.EGNm8XkEYngYRtfzBKh.cn2OG', 1, '2017-08-17 14:43:32', '2017-08-17 14:43:32'),
(6, '899809.jpg', 'Elaine', 'ela20_m', 'ela2020.lo@gmail.com', '$2y$10$5Oop0g016cZJJ8LqMhtNHeWZCQZWMtDsR46GfMuQmorVIomxMoODC', 1, '2017-08-17 14:43:32', '2017-08-17 14:43:32'),
(7, '496363.png', 'Jenifer', 'jeni21_m', 'jeni21_m@gmail.com', '$2y$10$Xr2WU8Aps7pihNY41wsD..s.pVanNIoWbUjfRRYGs48DLZz/LJDFe', 1, '2017-08-17 14:43:32', '2017-08-17 14:43:32'),
(8, '751289.jpg', 'Gladys', 'gladi27', 'gladi27@gmail.com', '$2y$10$e9fnUHnlGlNncbfC8ompDOFXoaNhZjB1Cn7wlZKDOut75qAKa93uy', 1, '2017-08-17 14:43:32', '2017-08-17 14:43:32'),
(9, '106202.jpg', 'Franyelimar', 'franye2020', 'franye2020@gmail.com', '$2y$10$zNFBEYu4Pelw4tTFNx8Sr.8aJkOprVZC2VVKFSve/oFWvD84TcQoK', 1, '2017-08-17 14:43:32', '2017-08-17 14:43:32');

--
-- Estructura de tabla para la tabla `perfiles`
--

CREATE TABLE perfiles (
  idperfil int(11) NOT NULL AUTO_INCREMENT COMMENT 'llave primaria de la tabla perfil',
  nombre varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL COMMENT 'Descripción del perfil',
  created  timestamp default now() COMMENT 'fecha de registro del perfil',
  modified timestamp default now() on update now() COMMENT 'fecha de actualización del perfil',
  PRIMARY KEY(idperfil)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `perfiles`
--

INSERT INTO `perfiles` (`idperfil`, `nombre`, `created`, `modified`) VALUES
(1, 'Administrador', NULL, NULL),
(2, 'Usuario', NULL, NULL),
(3, 'Gerente',NULL, NULL);

--
-- Estructura de tabla para la tabla `recursos`
--

CREATE TABLE recursos (
  idrecurso int(11) NOT NULL AUTO_INCREMENT COMMENT 'llave primaria de la recursos',
  nombre varchar(100) NOT NULL COMMENT 'nombre del recurso',
  created  timestamp default now() COMMENT 'fecha de registro del perfil',
  modified timestamp default now() on update now() COMMENT 'fecha de actualización del recurso',
PRIMARY KEY(idrecurso)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `recursos`
--
INSERT INTO recursos (idrecurso, nombre, created, modified) VALUES
(1, 'gestionar usuarios', NULL, NULL),
(2, 'gestionar funcionarios', NULL, NULL),
(3, 'gestionar bienes', NULL, NULL),
(4, 'gestionar movimientos', NULL, NULL);

--
-- Estructura de tabla para la tabla `usuarios_perfiles`
--

CREATE TABLE usuarios_perfiles (
iduser_perfil int(11) NOT NULL AUTO_INCREMENT,
  id_user int(11) NOT NULL,
  idperfil int(11) NOT NULL,
PRIMARY KEY(iduser_perfil),
  INDEX (id_user),
  FOREIGN KEY (id_user) REFERENCES user (iduser) ON DELETE CASCADE ON UPDATE CASCADE,
  INDEX (idperfil),
  FOREIGN KEY (idperfil) REFERENCES perfiles (idperfil) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `usuarios_perfiles`
--

INSERT INTO `usuarios_perfiles` (`iduser_perfil`, `id_user`, `idperfil`) VALUES
(1, 1, 1),
(2, 2, 2),
(3, 3, 2),
(4, 4, 2),
(5, 5, 2),
(6, 6, 2),
(7, 7, 2),
(8, 8, 2);


--
-- Estructura de tabla para la tabla `perfiles_recursos`
--

  CREATE TABLE perfiles_recursos (
    perfile_recurso int(11) NOT NULL AUTO_INCREMENT,
    consultar char(1) DEFAULT '0',
    agregar char(1) DEFAULT '0',
    editar char(1) DEFAULT '0',
    eliminar char(1) DEFAULT '0',
    reporte char(1) DEFAULT '0',
    idperfil int(11) NOT NULL,
    PRIMARY KEY(perfile_recurso),
    INDEX (idperfil),
    FOREIGN KEY (idperfil) REFERENCES perfiles (idperfil) ON DELETE CASCADE ON UPDATE CASCADE
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

  --
-- Volcado de datos para la tabla `perfiles_recursos`
--

INSERT INTO `perfiles_recursos` (`perfile_recurso`, `consultar`, `agregar`, `editar`, `eliminar`, `reporte`, `idperfil`) VALUES
(1, '1', '2', '3', '4', '5', 1),
(2, '1', '2', '0', '0', '0', 2);

--
-- Estructura de tabla para la tabla `categoria`
--
CREATE TABLE categoria (
  id_categoria  INT(11)           NOT NULL AUTO_INCREMENT                               COMMENT 'llave primaria de la tabla categoria',
  nombre        VARCHAR(45)       NOT NULL COLLATE utf8_spanish_ci                      COMMENT 'Descripción de la categoria',
  estado        ENUM ('0','1')    NOT NULL COLLATE utf8_spanish_ci                      COMMENT 'Descripción de la categoria',
  created timestamp default now()                    COMMENT 'fecha de registro de la categoria',
  modified timestamp default now() on update now() COMMENT 'fecha de actualización de la categoria',
  PRIMARY KEY(id_categoria)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`id_categoria`, `nombre`, `estado`, `created`, `modified`) VALUES
(1, 'MOBILIARIO', '1', NULL, NULL),
(2, 'EQUIPO DE COMPUTACIÓN', '1', NULL, NULL),
(3, 'EQUIPO DE LIMPIEZA', '0', NULL, NULL),
(4, 'EQUIPO DE REGRIGERACIÓN', '1', NULL, NULL);

--
-- Estructura de tabla para la tabla `unidad_adscripta`
--
     CREATE TABLE unidad_adscripta (
     id_unidad_adscripta    INT(11)         NOT NULL AUTO_INCREMENT COMMENT 'llave primaria de la tabla unidad_adscripta',
     nombre      VARCHAR(45)     NOT NULL COLLATE utf8_spanish_ci  COMMENT 'Nombre de la unidad_adscripta',
     estado      ENUM ('0','1')  NOT NULL COLLATE utf8_spanish_ci  COMMENT 'estado activo o no activo de la unidad_adscripta',
     created timestamp default now()  COMMENT 'fecha de registro de la unidad_adscripta',
     modified timestamp default now() on update now() COMMENT 'fecha de actualización de la unidad_adscripta',
     PRIMARY KEY(id_unidad_adscripta)
     ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

     --
-- Volcado de datos para la tabla `unidad_adscripta`
--

INSERT INTO `unidad_adscripta` (`id_unidad_adscripta`, `nombre`, `estado`, `created`, `modified`) VALUES
(NULL, 'ADMINISTRACIÓN', '1', '2017-08-17 15:16:00', '2017-08-17 15:16:00'),
(NULL, 'GERENCIA', '1', '2017-08-17 15:16:00', '2017-08-17 15:16:00'),
(NULL, 'PERSONAL', '1', '2017-08-17 15:16:00', '2017-08-17 15:16:00'),
(NULL, 'SERVICIOS GENERALES', '1', '2017-08-17 15:16:00', '2017-08-17 15:16:00');

--
-- Estructura de tabla para la tabla `funcionarios`
--
CREATE TABLE funcionarios (
  id_funcionario int(11) NOT NULL AUTO_INCREMENT,
  cedula int(11) NOT NULL,
  foto varchar(100) COLLATE utf8_spanish_ci DEFAULT 'avatar.png',
  nombre1 varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  nombre2 varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  apellido1 varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  apellido2 varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  fec_nac varchar(10) COLLATE utf8_spanish_ci NOT NULL,
  fec_ingreso varchar(10) COLLATE utf8_spanish_ci NOT NULL,
  estado enum('0','1') COLLATE utf8_spanish_ci NOT NULL,
  grado_intruccion varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  profesion varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  code_cargo varchar(10) COLLATE utf8_spanish_ci NOT NULL,
  descrip_cargo varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  func_inhe_cargo varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  obj_desemp_individual varchar(400) COLLATE utf8_spanish_ci NOT NULL,
  id_unidad_adscripta int(11) NOT NULL,
  info_complentaria varchar(300) COLLATE utf8_spanish_ci NOT NULL,
  created timestamp default now(),
  modified timestamp default now() on update now(),
  PRIMARY KEY(id_funcionario),
  INDEX (id_unidad_adscripta),
  FOREIGN KEY (id_unidad_adscripta) REFERENCES unidad_adscripta (id_unidad_adscripta) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;



--
-- Volcado de datos para la tabla `funcionarios`
--

INSERT INTO `funcionarios` (`id_funcionario`, `cedula`, `foto`, `nombre1`, `nombre2`, `apellido1`, `apellido2`, `fec_nac`, `fec_ingreso`, `estado`, `grado_intruccion`, `profesion`, `code_cargo`, `descrip_cargo`, `func_inhe_cargo`, `obj_desemp_individual`, `id_unidad_adscripta`, `info_complentaria`, `created`, `modified`) VALUES
(NULL, 10567746, '906337.jpg', 'Edgar', 'Luis', 'Balza', 'Reyes', '1967-04-15', '1995-08-16', '1', 'universitario', 'su Informática / Lic en\r\nAdministración', 'S1717205', 'Analista/Programador', 'Análisis, Desarrollo e Implantación de Sistemas\r\nAutomatizados.\r\nDesarrollo de Aplicaciones Cliente/Servidor\r\nConfiguración/Administración de Redes.', 'Apoyo a la Gerencia Subregional en el Desarrollo\r\nde Herramientas Automatizadas para el\r\nseguimiento y control de logros y resultados de la\r\nGestión.\r\n\r\nDigitalización y elaboración de Cartografía Base\r\npara Desarrollo de PDULES:\r\n\r\nAdministración, Consolidación y Difusión de la\r\nInformación resultantes de la ejecución del plan\r\noperativo vigente.', 3, 'Este recurso actualmente se encuentra en Comisión\r\nde Servicios en apoyo y asistencia a la Gerencia\r\nSubregional Bolívar. Su unidad de adscripción original\r\nes Planeamiento Urbano.', '2017-08-21 04:00:30', '2017-08-21 18:15:04'),
(NULL, 13795082, '183228.jpg', 'Daniel', 'Jose', 'Lopez', 'Ortiz', '1977-07-13', '2002-05-04', '1', 'universitario', 'Ingeniero informático', 'T454664646', 'especializado en sistemas de nube', 'Generación de herramientas informáticas para el trabajo en nube de los clientes.\r\n', 'Integración en un equipo de desarrollo encargado de la programación, la resolución de incidencias y el mantenimiento de sistemas\r\nGeneración de soluciones en nube moduladas a las necesidades del cliente', 1, 'altamente eficiente y resolutivo, precisando una mínima supervisión para el desarrollo de mis funciones. ', '2017-08-21 20:09:18', '2017-08-21 20:09:48');


--
-- Estructura de tabla para la tabla `bienes`
--



     CREATE TABLE bienes (
           id_bien              INT(11)         NOT NULL AUTO_INCREMENT                               COMMENT 'llave primaria de la tabla bienes',
           id_categoria         INT(11)         NOT NULL                                              COMMENT 'llave primaria de la tabla categoria',
           id_unidad_adscripta  INT(11)         NOT NULL                                              COMMENT 'llave primaria de la tabla unidad_adscripta',
           id_funcionario       INT(11)         NOT NULL                                              COMMENT 'llave primaria de la tabla funcionario',
           bien_foto            VARCHAR(100)    DEFAULT 'articulo.png' COLLATE utf8_spanish_ci        COMMENT 'imagen del articulo',
           bien_nombre          VARCHAR(150)    NOT NULL COLLATE utf8_spanish_ci                      COMMENT 'Nombre de la articulo',
           bien_descripcion     TEXT            NOT NULL COLLATE utf8_spanish_ci                      COMMENT 'Descripción de la articulo',
           bien_cantidad        INT(11)         NOT NULL  COLLATE utf8_spanish_ci                     COMMENT 'cantida de articulos disponibles',
           bien_codigo          VARCHAR(10)     NOT NULL  COLLATE utf8_spanish_ci                     COMMENT 'código de barra del articulo',
           estado               ENUM ('0','1','2')  NOT NULL COLLATE utf8_spanish_ci                  COMMENT 'estado activo o no activo del articulo',
           created timestamp default now()                    COMMENT 'fecha de registro del bien',
           modified timestamp default now() on update now() COMMENT 'fecha de actualización del bien',
           PRIMARY KEY(id_bien),
           INDEX (id_categoria),
           FOREIGN KEY (id_categoria) REFERENCES categoria (id_categoria) ON DELETE CASCADE ON UPDATE CASCADE,
           INDEX (id_unidad_adscripta),
           FOREIGN KEY (id_unidad_adscripta) REFERENCES unidad_adscripta (id_unidad_adscripta) ON DELETE CASCADE ON UPDATE CASCADE,
           INDEX (id_funcionario),
           FOREIGN KEY (id_funcionario) REFERENCES funcionarios (id_funcionario) ON DELETE CASCADE ON UPDATE CASCADE
         ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
     --
-- Volcado de datos para la tabla `bienes`
--

INSERT INTO `bienes` (`id_bien`, `id_categoria`, `id_unidad_adscripta`, `id_funcionario`, `bien_foto`, `bien_nombre`, `bien_descripcion`, `bien_cantidad`, `bien_codigo`, `estado`, `created`, `modified`) VALUES
(1, 1, 1, 1, '643190.jpg', 'SILLA CON MESA DE ESCRITORIO', 'silla de cuero de color negro con mesa de madera', 3, 'TR40959688', '1', NULL, NULL),
(2, 1, 1, 1, '37344.jpg', 'SILLA DE OFIICINA', 'de color negro con ruedas plasticas', 4, 'TF456YT654', '1', NULL, NULL);



--
-- Estructura de tabla para la tabla `observacion`
--

CREATE TABLE observacion_bien(
  id_observacion              INT(11)         NOT NULL AUTO_INCREMENT                               COMMENT 'llave primaria de la tabla observacion',
  id_bien                     INT(11)         NOT NULL                                              COMMENT 'llave primaria de la tabla bienes',
  observacion VARCHAR(50) NULL,
  PRIMARY KEY(id_observacion),
  INDEX (id_bien),
  FOREIGN KEY (id_bien) REFERENCES bienes (id_bien) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `observacion`
--

INSERT INTO `observacion_bien` (`id_observacion`, `id_bien`, `observacion`) VALUES
(1, 1, 'en buen estado'),
(2, 2, 'en buen estado');

CREATE TABLE observacion_funcionario(
  id_observacion_funcionario INT(11) NOT NULL AUTO_INCREMENT  COMMENT 'llave primaria de la tabla observacion',
  id_funcionario INT(11) NOT NULL COMMENT 'llave primaria de la tabla funcionario',
  observacion VARCHAR(300) NULL,
  PRIMARY KEY(id_observacion_funcionario),
  INDEX (id_funcionario),
  FOREIGN KEY (id_funcionario) REFERENCES funcionarios (id_funcionario) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

INSERT INTO `observacion_funcionario` (`id_observacion_funcionario`, `id_funcionario`, `observacion`) VALUES
(NULL, 1, 'Este recurso actualmente se encuentra en Comisión\r\nde Servicios en apoyo y asistencia a la Gerencia\r\nSubregional Bolívar. Su unidad de adscripción original\r\nes Planeamiento Urbano.'),
(NULL, 2, 'Este recurso actualmente se encuentra en Comisión\r\nde Servicios en apoyo y asistencia a la Gerencia\r\nSubregional Bolívar. Su unidad de adscripción original\r\nes Planeamiento Urbano.');
