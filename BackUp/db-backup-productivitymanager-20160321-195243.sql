DROP DATABASE IF EXISTS productivitymanager,CREATE DATABASE IF NOT EXISTS productivitymanager,USE productivitymanager,<br>DROP TABLE IF EXISTS roles,CREATE TABLE `roles` (
  `idRoles` int(11) NOT NULL,
  `rol` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idRoles`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8\n\nINSERT INTO roles VALUES ("0","default");\n\nINSERT INTO roles VALUES ("1","Administrador");\n\nINSERT INTO roles VALUES ("2","Gerente");\n\nINSERT INTO roles VALUES ("3","Empleado");\n\nINSERT INTO roles VALUES ("4","Clientes");\n\n<br>DROP TABLE IF EXISTS areas,CREATE TABLE `areas` (
  `idAreas` int(11) NOT NULL DEFAULT '0',
  `nombreArea` varchar(45) DEFAULT NULL,
  `roles_idRoles` int(11) NOT NULL,
  PRIMARY KEY (`idAreas`,`roles_idRoles`),
  KEY `fk_areas_roles1_idx` (`roles_idRoles`),
  CONSTRAINT `fk_areas_roles1` FOREIGN KEY (`roles_idRoles`) REFERENCES `roles` (`idRoles`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8\n\nINSERT INTO areas VALUES ("0","default","0");\n\nINSERT INTO areas VALUES ("1","Administracion","1");\n\nINSERT INTO areas VALUES ("2","Privado","1");\n\nINSERT INTO areas VALUES ("3","Corte","3");\n\nINSERT INTO areas VALUES ("4","Ensamble","3");\n\nINSERT INTO areas VALUES ("6","Cliente","4");\n\n<br>DROP TABLE IF EXISTS personas,CREATE TABLE `personas` (
  `idUsuario` int(11) NOT NULL AUTO_INCREMENT,
  `identificacion` bigint(10) NOT NULL,
  `nombres` varchar(45) DEFAULT NULL,
  `apellidos` varchar(45) DEFAULT NULL,
  `direccion` varchar(45) DEFAULT NULL,
  `telefono` bigint(12) DEFAULT NULL,
  `fechaNacimiento` date DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `estado` enum('Activo','Inactivo','Bloqueado') NOT NULL,
  `foto` varchar(95) DEFAULT NULL,
  `areas_idAreas` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`idUsuario`,`identificacion`,`areas_idAreas`),
  UNIQUE KEY `identificacion_UNIQUE` (`identificacion`),
  KEY `apellidos` (`apellidos`),
  KEY `identificacion` (`identificacion`),
  KEY `fk_personas_areas1_idx1` (`areas_idAreas`),
  CONSTRAINT `fk_personas_areas1` FOREIGN KEY (`areas_idAreas`) REFERENCES `areas` (`idAreas`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8\n\nINSERT INTO personas VALUES ("1","1012377025","Camilo","Arias González","Cll 93 No 11-08","3015782659","1991-05-20","carias520@misena.edu.co","Inactivo","camilo.jpg","1");\n\nINSERT INTO personas VALUES ("7","1030590693","Jorge Mario ","Izquierdo Negrete","kr 1 h bis # 79-10 sur","3106775824","1991-03-29","jmizquierdo@misena.edu.co","Activo","Jorge.png","1");\n\n<br>DROP TABLE IF EXISTS clientes,CREATE TABLE `clientes` (
  `idCliente` int(11) NOT NULL,
  `nombreCompania` varchar(45) DEFAULT NULL,
  `nit` bigint(15) NOT NULL,
  `sectorEmpresarial` varchar(45) DEFAULT NULL,
  `sectorEconomico` varchar(45) DEFAULT NULL,
  `telefonoFijo` bigint(12) DEFAULT NULL,
  PRIMARY KEY (`idCliente`,`nit`),
  UNIQUE KEY `nit_UNIQUE` (`nit`),
  CONSTRAINT `fk_Clientes_Usuarios1` FOREIGN KEY (`idCliente`) REFERENCES `personas` (`idUsuario`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8\n\n<br>DROP TABLE IF EXISTS indicativos,CREATE TABLE `indicativos` (
  `idPais` int(11) NOT NULL,
  `nombrePais` varchar(45) DEFAULT NULL,
  `indicativo` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idPais`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8\n\nINSERT INTO indicativos VALUES ("1","AfganistÃ¡n","93");\n\nINSERT INTO indicativos VALUES ("2","Albania","355");\n\nINSERT INTO indicativos VALUES ("3","Alemania","49");\n\nINSERT INTO indicativos VALUES ("4","Angola","244");\n\nINSERT INTO indicativos VALUES ("5","Anguila","1");\n\nINSERT INTO indicativos VALUES ("6","Antigua y Barbuda","1");\n\nINSERT INTO indicativos VALUES ("7","Antillas Holandesas","599");\n\nINSERT INTO indicativos VALUES ("8","Arabia Saudita","966");\n\nINSERT INTO indicativos VALUES ("9","Argelia","213");\n\nINSERT INTO indicativos VALUES ("10","Argentina","54");\n\nINSERT INTO indicativos VALUES ("11","Armenia","374");\n\nINSERT INTO indicativos VALUES ("12","Aruba","297");\n\nINSERT INTO indicativos VALUES ("13","Australia","61");\n\nINSERT INTO indicativos VALUES ("14","Austria","43");\n\nINSERT INTO indicativos VALUES ("15","AzerbaiyÃ¡n","994");\n\nINSERT INTO indicativos VALUES ("16","Bahamas","1");\n\nINSERT INTO indicativos VALUES ("17","BangladÃ©s","880");\n\nINSERT INTO indicativos VALUES ("18","Barbados","1");\n\nINSERT INTO indicativos VALUES ("19","BÃ©lgica","32");\n\nINSERT INTO indicativos VALUES ("20","Belice","501");\n\nINSERT INTO indicativos VALUES ("21","BenÃ­n","229");\n\nINSERT INTO indicativos VALUES ("22","Bermudas","1");\n\nINSERT INTO indicativos VALUES ("23","Bielorrusia","375");\n\nINSERT INTO indicativos VALUES ("24","Bolivia","591");\n\nINSERT INTO indicativos VALUES ("25","Bosnia y Herzegovina","387");\n\nINSERT INTO indicativos VALUES ("26","Botsuana","267");\n\nINSERT INTO indicativos VALUES ("27","Brasil","55");\n\nINSERT INTO indicativos VALUES ("28","BrunÃ©i","673");\n\nINSERT INTO indicativos VALUES ("29","Bulgaria","359");\n\nINSERT INTO indicativos VALUES ("30","Burkina Faso","226");\n\nINSERT INTO indicativos VALUES ("31","Burundi","257");\n\nINSERT INTO indicativos VALUES ("32","ButÃ¡n","975");\n\nINSERT INTO indicativos VALUES ("33","Cabo Verde","238");\n\nINSERT INTO indicativos VALUES ("34","Camboya","855");\n\nINSERT INTO indicativos VALUES ("35","CamerÃºn","237");\n\nINSERT INTO indicativos VALUES ("36","CanadÃ¡","1");\n\nINSERT INTO indicativos VALUES ("37","Catar","974");\n\nINSERT INTO indicativos VALUES ("38","Chad","235");\n\nINSERT INTO indicativos VALUES ("39","Chequia","420");\n\nINSERT INTO indicativos VALUES ("40","Chile","56");\n\nINSERT INTO indicativos VALUES ("41","China","86");\n\nINSERT INTO indicativos VALUES ("42","Chipre","357");\n\nINSERT INTO indicativos VALUES ("43","Colombia","57");\n\nINSERT INTO indicativos VALUES ("44","Comoras","269");\n\nINSERT INTO indicativos VALUES ("45","Congo","242");\n\nINSERT INTO indicativos VALUES ("46","Corea","82");\n\nINSERT INTO indicativos VALUES ("47","Corea del Norte","850");\n\nINSERT INTO indicativos VALUES ("48","Costa de Marfil","225");\n\nINSERT INTO indicativos VALUES ("49","Costa Rica","506");\n\nINSERT INTO indicativos VALUES ("50","Croacia","385");\n\nINSERT INTO indicativos VALUES ("51","Cuba","53");\n\nINSERT INTO indicativos VALUES ("52","Diego GarcÃ­a","246");\n\nINSERT INTO indicativos VALUES ("53","Dinamarca","45");\n\nINSERT INTO indicativos VALUES ("54","Dominica","1");\n\nINSERT INTO indicativos VALUES ("55","Ecuador","593");\n\nINSERT INTO indicativos VALUES ("56","Egipto","20");\n\nINSERT INTO indicativos VALUES ("57","El Salvador","503");\n\nINSERT INTO indicativos VALUES ("58","Emiratos Ãrabes Unidos","971");\n\nINSERT INTO indicativos VALUES ("59","Eritrea","291");\n\nINSERT INTO indicativos VALUES ("60","Escocia","44");\n\nINSERT INTO indicativos VALUES ("61","Eslovaquia","421");\n\nINSERT INTO indicativos VALUES ("62","Eslovenia","386");\n\nINSERT INTO indicativos VALUES ("63","EspaÃ±a","34");\n\nINSERT INTO indicativos VALUES ("64","Estonia","372");\n\nINSERT INTO indicativos VALUES ("65","EtiopÃ­a","251");\n\nINSERT INTO indicativos VALUES ("66","FederaciÃ³n Rusa","7");\n\nINSERT INTO indicativos VALUES ("67","Filipinas","63");\n\nINSERT INTO indicativos VALUES ("68","Finlandia","358");\n\nINSERT INTO indicativos VALUES ("69","Fiyi","679");\n\nINSERT INTO indicativos VALUES ("70","Francia","33");\n\nINSERT INTO indicativos VALUES ("71","GabÃ³n","241");\n\nINSERT INTO indicativos VALUES ("72","Gales","44");\n\nINSERT INTO indicativos VALUES ("73","Gambia","220");\n\nINSERT INTO indicativos VALUES ("74","Georgia","995");\n\nINSERT INTO indicativos VALUES ("75","Ghana","233");\n\nINSERT INTO indicativos VALUES ("76","Gibraltar","350");\n\nINSERT INTO indicativos VALUES ("77","Granada","1");\n\nINSERT INTO indicativos VALUES ("78","Grecia","30");\n\nINSERT INTO indicativos VALUES ("79","Groenlandia","299");\n\nINSERT INTO indicativos VALUES ("80","Guadalupe","590");\n\nINSERT INTO indicativos VALUES ("81","Guam","1");\n\nINSERT INTO indicativos VALUES ("82","Guatemala","502");\n\nINSERT INTO indicativos VALUES ("83","Guayana Francesa","594");\n\nINSERT INTO indicativos VALUES ("84","Guinea","224");\n\nINSERT INTO indicativos VALUES ("85","Guinea Ecuatorial","240");\n\nINSERT INTO indicativos VALUES ("86","Guinea-Bissau","245");\n\nINSERT INTO indicativos VALUES ("87","Guyana","592");\n\nINSERT INTO indicativos VALUES ("88","HaitÃ­","509");\n\nINSERT INTO indicativos VALUES ("89","Holanda","31");\n\nINSERT INTO indicativos VALUES ("90","Honduras","504");\n\nINSERT INTO indicativos VALUES ("91","HongKong","852");\n\nINSERT INTO indicativos VALUES ("92","HungrÃ­a","36");\n\nINSERT INTO indicativos VALUES ("93","India","91");\n\nINSERT INTO indicativos VALUES ("94","Indonesia","62");\n\nINSERT INTO indicativos VALUES ("95","Inglaterra","44");\n\nINSERT INTO indicativos VALUES ("96","Irak","964");\n\nINSERT INTO indicativos VALUES ("97","IrÃ¡n","98");\n\nINSERT INTO indicativos VALUES ("98","Irlanda","353");\n\nINSERT INTO indicativos VALUES ("99","Irlanda del Norte","44");\n\nINSERT INTO indicativos VALUES ("100","Isla AscensiÃ³n","247");\n\nINSERT INTO indicativos VALUES ("101","Isla Norfolk","6723");\n\nINSERT INTO indicativos VALUES ("102","Islandia","354");\n\nINSERT INTO indicativos VALUES ("103","Islas CaimÃ¡n","1");\n\nINSERT INTO indicativos VALUES ("104","Islas Cook","682");\n\nINSERT INTO indicativos VALUES ("105","Islas Feroe","298");\n\nINSERT INTO indicativos VALUES ("106","Islas Malvinas","500");\n\nINSERT INTO indicativos VALUES ("107","Islas Marianas del Norte","1");\n\nINSERT INTO indicativos VALUES ("108","Islas Marshall","692");\n\nINSERT INTO indicativos VALUES ("109","Islas SalomÃ³n","677");\n\nINSERT INTO indicativos VALUES ("110","Islas Turcas y Caicos","1");\n\nINSERT INTO indicativos VALUES ("111","Islas VÃ­rgenes BritÃ¡nicas","1");\n\nINSERT INTO indicativos VALUES ("112","Islas VÃ­rgenes de los Estados Unidos","1");\n\nINSERT INTO indicativos VALUES ("113","Israel","972");\n\nINSERT INTO indicativos VALUES ("114","Italia","39");\n\nINSERT INTO indicativos VALUES ("115","Jamaica","1");\n\nINSERT INTO indicativos VALUES ("116","JapÃ³n","81");\n\nINSERT INTO indicativos VALUES ("117","Jordania","962");\n\nINSERT INTO indicativos VALUES ("118","KazajistÃ¡n","7");\n\nINSERT INTO indicativos VALUES ("119","Kenia","254");\n\nINSERT INTO indicativos VALUES ("120","KirguistÃ¡n","996");\n\nINSERT INTO indicativos VALUES ("121","Kiribati","686");\n\nINSERT INTO indicativos VALUES ("122","Kuwait","965");\n\nINSERT INTO indicativos VALUES ("123","Laos","856");\n\nINSERT INTO indicativos VALUES ("124","Lesoto","266");\n\nINSERT INTO indicativos VALUES ("125","Letonia","371");\n\nINSERT INTO indicativos VALUES ("126","LÃ­bano","961");\n\nINSERT INTO indicativos VALUES ("127","Liberia","231");\n\nINSERT INTO indicativos VALUES ("128","Libia","218");\n\nINSERT INTO indicativos VALUES ("129","Liechtenstein","423");\n\nINSERT INTO indicativos VALUES ("130","Lituania","370");\n\nINSERT INTO indicativos VALUES ("131","Luxemburgo","352");\n\nINSERT INTO indicativos VALUES ("132","Macao","853");\n\nINSERT INTO indicativos VALUES ("133","Macedonia","389");\n\nINSERT INTO indicativos VALUES ("134","Madagascar","261");\n\nINSERT INTO indicativos VALUES ("135","Malasia","60");\n\nINSERT INTO indicativos VALUES ("136","Malaui","265");\n\nINSERT INTO indicativos VALUES ("137","Maldivas","960");\n\nINSERT INTO indicativos VALUES ("138","MalÃ­","223");\n\nINSERT INTO indicativos VALUES ("139","Malta","356");\n\nINSERT INTO indicativos VALUES ("140","Marruecos","212");\n\nINSERT INTO indicativos VALUES ("141","Martinica","596");\n\nINSERT INTO indicativos VALUES ("142","Mauricio","230");\n\nINSERT INTO indicativos VALUES ("143","Mauritania","222");\n\nINSERT INTO indicativos VALUES ("144","Mayotte","262");\n\nINSERT INTO indicativos VALUES ("145","MÃ©xico","52");\n\nINSERT INTO indicativos VALUES ("146","Micronesia","691");\n\nINSERT INTO indicativos VALUES ("147","Moldavia","373");\n\nINSERT INTO indicativos VALUES ("148","MÃ³naco","377");\n\nINSERT INTO indicativos VALUES ("149","Mongolia","976");\n\nINSERT INTO indicativos VALUES ("150","Montenegro","382");\n\nINSERT INTO indicativos VALUES ("151","Montserrat","1");\n\nINSERT INTO indicativos VALUES ("152","Mozambique","258");\n\nINSERT INTO indicativos VALUES ("153","Myanmar","95");\n\nINSERT INTO indicativos VALUES ("154","Namibia","264");\n\nINSERT INTO indicativos VALUES ("155","Nauru","674");\n\nINSERT INTO indicativos VALUES ("156","Nepal","977");\n\nINSERT INTO indicativos VALUES ("157","Nicaragua","505");\n\nINSERT INTO indicativos VALUES ("158","NÃ­ger","227");\n\nINSERT INTO indicativos VALUES ("159","Nigeria","234");\n\nINSERT INTO indicativos VALUES ("160","Niue","683");\n\nINSERT INTO indicativos VALUES ("161","Noruega","47");\n\nINSERT INTO indicativos VALUES ("162","Nueva Caledonia","687");\n\nINSERT INTO indicativos VALUES ("163","Nueva Zelanda","64");\n\nINSERT INTO indicativos VALUES ("164","OmÃ¡n","968");\n\nINSERT INTO indicativos VALUES ("165","PakistÃ¡n","92");\n\nINSERT INTO indicativos VALUES ("166","Palaos","680");\n\nINSERT INTO indicativos VALUES ("167","Palestina","970");\n\nINSERT INTO indicativos VALUES ("168","PanamÃ¡","507");\n\nINSERT INTO indicativos VALUES ("169","PapÃºa Nueva Guinea","675");\n\nINSERT INTO indicativos VALUES ("170","Paraguay","595");\n\nINSERT INTO indicativos VALUES ("171","PerÃº","51");\n\nINSERT INTO indicativos VALUES ("172","Polinesia Francesa","689");\n\nINSERT INTO indicativos VALUES ("173","Polonia","48");\n\nINSERT INTO indicativos VALUES ("174","Portugal","351");\n\nINSERT INTO indicativos VALUES ("175","Principado de Andorra","376");\n\nINSERT INTO indicativos VALUES ("176","Puerto Rico","1");\n\nINSERT INTO indicativos VALUES ("177","Reino de BahrÃ©in","973");\n\nINSERT INTO indicativos VALUES ("178","Rep. Dominicana","1");\n\nINSERT INTO indicativos VALUES ("179","RepÃºblica Centroafricana","236");\n\nINSERT INTO indicativos VALUES ("180","RepÃºblica DemocrÃ¡tica del Congo","243");\n\nINSERT INTO indicativos VALUES ("181","ReuniÃ³n","262");\n\nINSERT INTO indicativos VALUES ("182","Ruanda","250");\n\nINSERT INTO indicativos VALUES ("183","RumanÃ­a","40");\n\nINSERT INTO indicativos VALUES ("184","SÃ¡hara Occidental","212");\n\nINSERT INTO indicativos VALUES ("185","Samoa","685");\n\nINSERT INTO indicativos VALUES ("186","Samoa Americana","1");\n\nINSERT INTO indicativos VALUES ("187","San BartolomÃ©","590");\n\nINSERT INTO indicativos VALUES ("188","San CristÃ³bal y Nieves","1");\n\nINSERT INTO indicativos VALUES ("189","San Marino","378");\n\nINSERT INTO indicativos VALUES ("190","San MartÃ­n","590");\n\nINSERT INTO indicativos VALUES ("191","San Pedro y MiquelÃ³n","508");\n\nINSERT INTO indicativos VALUES ("192","San Vicente y las Granadinas","1");\n\nINSERT INTO indicativos VALUES ("193","Santa Elena","290");\n\nINSERT INTO indicativos VALUES ("194","Santa LucÃ­a","1");\n\nINSERT INTO indicativos VALUES ("195","Santo TomÃ© y PrÃ­ncipe","239");\n\nINSERT INTO indicativos VALUES ("196","SatÃ©lite Inmarsat","870");\n\nINSERT INTO indicativos VALUES ("197","SatÃ©lite Iridium","8816");\n\nINSERT INTO indicativos VALUES ("198","SatÃ©lite Thuraya","882 16");\n\nINSERT INTO indicativos VALUES ("199","Senegal","221");\n\nINSERT INTO indicativos VALUES ("200","Serbia","381");\n\nINSERT INTO indicativos VALUES ("201","Seychelles","248");\n\nINSERT INTO indicativos VALUES ("202","Sierra Leona","232");\n\nINSERT INTO indicativos VALUES ("203","Singapur","65");\n\nINSERT INTO indicativos VALUES ("204","Sint Maarten","1");\n\nINSERT INTO indicativos VALUES ("205","Siria","963");\n\nINSERT INTO indicativos VALUES ("206","Somalia","252");\n\nINSERT INTO indicativos VALUES ("207","Sri Lanka","94");\n\nINSERT INTO indicativos VALUES ("208","Suazilandia","268");\n\nINSERT INTO indicativos VALUES ("209","SudÃ¡frica","27");\n\nINSERT INTO indicativos VALUES ("210","SudÃ¡n","249");\n\nINSERT INTO indicativos VALUES ("211","SudÃ¡n del Sur","211");\n\nINSERT INTO indicativos VALUES ("212","Suecia","46");\n\nINSERT INTO indicativos VALUES ("213","Suiza","41");\n\nINSERT INTO indicativos VALUES ("214","Surinam","597");\n\nINSERT INTO indicativos VALUES ("215","Tailandia","66");\n\nINSERT INTO indicativos VALUES ("216","TaiwÃ¡n","886");\n\nINSERT INTO indicativos VALUES ("217","Tanzania","255");\n\nINSERT INTO indicativos VALUES ("218","TayikistÃ¡n","992");\n\nINSERT INTO indicativos VALUES ("219","Timor Oriental","670");\n\nINSERT INTO indicativos VALUES ("220","Togo","228");\n\nINSERT INTO indicativos VALUES ("221","Tokelau","690");\n\nINSERT INTO indicativos VALUES ("222","Tonga","676");\n\nINSERT INTO indicativos VALUES ("223","Trinidad y Tobago","1");\n\nINSERT INTO indicativos VALUES ("224","TÃºnez","216");\n\nINSERT INTO indicativos VALUES ("225","TurkmenistÃ¡n","993");\n\nINSERT INTO indicativos VALUES ("226","TurquÃ­a","90");\n\nINSERT INTO indicativos VALUES ("227","Tuvalu","688");\n\nINSERT INTO indicativos VALUES ("228","Ucrania","380");\n\nINSERT INTO indicativos VALUES ("229","Uganda","256");\n\nINSERT INTO indicativos VALUES ("230","Uruguay","598");\n\nINSERT INTO indicativos VALUES ("231","USA","1");\n\nINSERT INTO indicativos VALUES ("232","UzbekistÃ¡n","998");\n\nINSERT INTO indicativos VALUES ("233","Vanuatu","678");\n\nINSERT INTO indicativos VALUES ("234","Vaticano","39");\n\nINSERT INTO indicativos VALUES ("235","Venezuela","58");\n\nINSERT INTO indicativos VALUES ("236","Vietnam","84");\n\nINSERT INTO indicativos VALUES ("237","Wallis y Futuna","681");\n\nINSERT INTO indicativos VALUES ("238","Yemen","967");\n\nINSERT INTO indicativos VALUES ("239","Yibuti","253");\n\nINSERT INTO indicativos VALUES ("240","Zambia","260");\n\nINSERT INTO indicativos VALUES ("241","Zimbabue","263");\n\n<br>DROP TABLE IF EXISTS contactenos,CREATE TABLE `contactenos` (
  `idContacto` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(50) NOT NULL,
  `Apellidos` varchar(45) NOT NULL,
  `empresa` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `idPais` int(11) NOT NULL,
  `telefono` varchar(10) DEFAULT NULL,
  `modo` varchar(45) DEFAULT NULL,
  `motivo` varchar(300) DEFAULT NULL,
  PRIMARY KEY (`idContacto`),
  KEY `fk_contactenos_personas1_idx` (`Nombre`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8\n\nINSERT INTO contactenos VALUES ("2","Jorge Mario ","Izquierdo","Productivity Manager","j@j.com","16","76768778","Blog o Foro","test");\n\n<br>DROP TABLE IF EXISTS proyectos,CREATE TABLE `proyectos` (
  `idProyecto` int(11) NOT NULL AUTO_INCREMENT,
  `nombreProyecto` varchar(45) DEFAULT NULL,
  `fechaInicio` date NOT NULL,
  `fechaFin` date DEFAULT NULL,
  `estadoProyecto` enum('Ejecución','Cancelado','Finalizado','Aplazado','Sin Estudio Costos','Sin Producción') NOT NULL,
  `ejecutado` int(11) NOT NULL,
  `observaciones` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`idProyecto`),
  KEY `estado` (`estadoProyecto`),
  KEY `nombreProyecto` (`nombreProyecto`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8\n\nINSERT INTO proyectos VALUES ("1","test 1","2016-03-10","2016-03-16","Ejecución","0","test");\n\n<br>DROP TABLE IF EXISTS estudiodecostos,CREATE TABLE `estudiodecostos` (
  `idestudioDeCostos` int(11) NOT NULL AUTO_INCREMENT,
  `idProyectoSolicitado` int(11) NOT NULL,
  `idGerenteACargo` int(11) NOT NULL,
  `costoManoDeObra` int(11) DEFAULT NULL,
  `costoProduccion` int(11) DEFAULT NULL,
  `costoProyecto` bigint(20) DEFAULT NULL,
  `utilidad` int(11) DEFAULT NULL,
  `tiempoEstimado` int(11) DEFAULT NULL,
  `totalTrabajadores` int(11) DEFAULT NULL,
  `observaciones` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`idestudioDeCostos`,`idProyectoSolicitado`,`idGerenteACargo`),
  KEY `fk_estudioDeCostos_Proyectos1_idx` (`idProyectoSolicitado`),
  KEY `fk_estudiodecostos_usuarios1_idx` (`idGerenteACargo`),
  CONSTRAINT `fk_estudioDeCostos_Proyectos1` FOREIGN KEY (`idProyectoSolicitado`) REFERENCES `proyectos` (`idProyecto`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_estudiodecostos_usuarios1` FOREIGN KEY (`idGerenteACargo`) REFERENCES `personas` (`idUsuario`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8\n\n<br>DROP TABLE IF EXISTS productos,CREATE TABLE `productos` (
  `idProductos` int(11) NOT NULL,
  `nombreProducto` varchar(45) DEFAULT NULL,
  `fotoProducto` varchar(45) DEFAULT NULL,
  `descripcionProducto` varchar(200) DEFAULT NULL,
  `estadoProducto` enum('Activo','Inactivo','Sin Procesos') DEFAULT NULL,
  `ganancia` double DEFAULT NULL,
  PRIMARY KEY (`idProductos`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8\n\n<br>DROP TABLE IF EXISTS materiaprima,CREATE TABLE `materiaprima` (
  `idMateriaPrima` int(11) NOT NULL AUTO_INCREMENT,
  `descripcionMateria` varchar(80) NOT NULL,
  `unidadDeMedida` varchar(45) NOT NULL,
  `precioBase` int(11) NOT NULL,
  PRIMARY KEY (`idMateriaPrima`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8\n\n<br>DROP TABLE IF EXISTS materiaprimaporproducto,CREATE TABLE `materiaprimaporproducto` (
  `ProductosIdProductos` int(11) NOT NULL,
  `idMateriaPrima_materiaPrima` int(11) NOT NULL,
  `cantidadMateriaPorProducto` int(11) DEFAULT NULL,
  PRIMARY KEY (`ProductosIdProductos`,`idMateriaPrima_materiaPrima`),
  KEY `fk_Productos_has_materiaPrima_materiaPrima1_idx` (`idMateriaPrima_materiaPrima`),
  KEY `fk_Productos_has_materiaPrima_Productos1_idx` (`ProductosIdProductos`),
  CONSTRAINT `fk_Productos_has_materiaPrima_Productos1` FOREIGN KEY (`ProductosIdProductos`) REFERENCES `productos` (`idProductos`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_Productos_has_materiaPrima_materiaPrima1` FOREIGN KEY (`idMateriaPrima_materiaPrima`) REFERENCES `materiaprima` (`idMateriaPrima`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8\n\n<br>DROP TABLE IF EXISTS materiaprimaporproyecto,CREATE TABLE `materiaprimaporproyecto` (
  `materiaPrima_idMateriaPrima` int(11) NOT NULL,
  `proyectos_idProyecto` int(11) NOT NULL,
  `valorTotal` int(11) DEFAULT NULL,
  `porcentajeProvisional` int(11) DEFAULT NULL,
  PRIMARY KEY (`materiaPrima_idMateriaPrima`,`proyectos_idProyecto`),
  KEY `fk_materiaPrima_has_proyectos_proyectos1_idx` (`proyectos_idProyecto`),
  CONSTRAINT `fk_materiaPrima_has_proyectos_materiaPrima1` FOREIGN KEY (`materiaPrima_idMateriaPrima`) REFERENCES `materiaprima` (`idMateriaPrima`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_materiaPrima_has_proyectos_proyectos1` FOREIGN KEY (`proyectos_idProyecto`) REFERENCES `proyectos` (`idProyecto`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8\n\n<br>DROP TABLE IF EXISTS novedades,CREATE TABLE `novedades` (
  `idNovedad` int(11) NOT NULL AUTO_INCREMENT,
  `usuarios_idUsuario` int(11) NOT NULL,
  `proyectos_idProyecto` int(11) NOT NULL,
  `categoria` enum('Retraso','Actividad','Solicitud') NOT NULL,
  `descripcionNovedad` varchar(200) DEFAULT NULL,
  `fechaNovedad` datetime NOT NULL,
  `archivoNovedad` varchar(45) DEFAULT NULL,
  `solucionNovedad` varchar(45) DEFAULT NULL,
  `fechaSolucionNovedad` date DEFAULT NULL,
  `estadoSolucion` enum('Pendiente','Solucionado') DEFAULT NULL,
  PRIMARY KEY (`idNovedad`,`usuarios_idUsuario`,`proyectos_idProyecto`),
  KEY `fk_Usuarios_has_Proyectos_Proyectos1_idx` (`proyectos_idProyecto`),
  KEY `fk_Usuarios_has_Proyectos_Usuarios1_idx` (`usuarios_idUsuario`),
  KEY `categoria` (`categoria`),
  CONSTRAINT `fk_Usuarios_has_Proyectos_Proyectos1` FOREIGN KEY (`proyectos_idProyecto`) REFERENCES `proyectos` (`idProyecto`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_Usuarios_has_Proyectos_Usuarios1` FOREIGN KEY (`usuarios_idUsuario`) REFERENCES `personas` (`idUsuario`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8\n\n<br>DROP TABLE IF EXISTS permisos,CREATE TABLE `permisos` (
  `idPermisos` int(11) NOT NULL,
  `URL` varchar(120) DEFAULT NULL,
  `nombreRuta` varchar(45) DEFAULT NULL,
  `nivel` int(11) DEFAULT NULL,
  PRIMARY KEY (`idPermisos`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8\n\nINSERT INTO permisos VALUES ("1","","Proyectos","1");\n\nINSERT INTO permisos VALUES ("2","crearProyecto","Crear Nuevo","2");\n\nINSERT INTO permisos VALUES ("3","listarProyectos","Listar Proyectos","2");\n\nINSERT INTO permisos VALUES ("4","","Novedades","1");\n\nINSERT INTO permisos VALUES ("5","agregarNovedad","Agregar Nueva","3");\n\nINSERT INTO permisos VALUES ("6","listarNovedades","Listar Informes de Novedad","3");\n\nINSERT INTO permisos VALUES ("7","","Personal","1");\n\nINSERT INTO permisos VALUES ("8","registrarUsuario","Registrar","4");\n\nINSERT INTO permisos VALUES ("9","listarUsuarios","Ver Todos","4");\n\nINSERT INTO permisos VALUES ("10","listarUsuariosInactivos","Inactivos","4");\n\nINSERT INTO permisos VALUES ("11","","Auditorias","1");\n\nINSERT INTO permisos VALUES ("12","generarAuditoria","Generar Nueva","5");\n\nINSERT INTO permisos VALUES ("13","listarAuditorias","Listar Auditorias","5");\n\nINSERT INTO permisos VALUES ("14","","Clientes","1");\n\nINSERT INTO permisos VALUES ("15","agregarCliente","Agregar","6");\n\nINSERT INTO permisos VALUES ("16","clientesActivos","Activos","6");\n\nINSERT INTO permisos VALUES ("17","clientesInactivos","Inactivos","6");\n\nINSERT INTO permisos VALUES ("18","","Roles","1");\n\nINSERT INTO permisos VALUES ("19","crearRol","Crear Nuevo","7");\n\nINSERT INTO permisos VALUES ("20","agregarAreas","Agregar Área","7");\n\nINSERT INTO permisos VALUES ("21","modificarRol","Modificar Rol","0");\n\nINSERT INTO permisos VALUES ("22","asignarPermisos","Asignar Permisos","0");\n\nINSERT INTO permisos VALUES ("23","modificarUsuario","Modificar Usuario","0");\n\nINSERT INTO permisos VALUES ("24","modificarCliente","Modificar Cliente","0");\n\nINSERT INTO permisos VALUES ("25","modificarContrasena","Modificar Contraseña","0");\n\nINSERT INTO permisos VALUES ("26","estudioDeCostos","Estudio De Costos","0");\n\nINSERT INTO permisos VALUES ("27","modificarProyecto","Modificar Proyecto","0");\n\nINSERT INTO permisos VALUES ("28","","Materia Prima","1");\n\nINSERT INTO permisos VALUES ("29","agregarInsumos","Agregar Materia Prima","8");\n\nINSERT INTO permisos VALUES ("30","actualizarRolArea","Actualizar Rol Area","0");\n\nINSERT INTO permisos VALUES ("31","agregarProcesos","Agregar Proceso","9");\n\nINSERT INTO permisos VALUES ("32","","Procesos","1");\n\nINSERT INTO permisos VALUES ("33","asignarAreas","Asignar Area","0");\n\nINSERT INTO permisos VALUES ("34","","Productos","1");\n\nINSERT INTO permisos VALUES ("35","agregarProductos","Agregar Producto","10");\n\nINSERT INTO permisos VALUES ("36","produccionProyecto","Producción Proyecto","0");\n\nINSERT INTO permisos VALUES ("37","crearRol?#ModalRoles","Ver Roles","7");\n\nINSERT INTO permisos VALUES ("38","informacionProyecto","Información Proyecto","0");\n\nINSERT INTO permisos VALUES ("39","insumosPorProducto","Insumos Por Producto","0");\n\nINSERT INTO permisos VALUES ("40","backup","BackUp","0");\n\n<br>DROP TABLE IF EXISTS permisosporrol,CREATE TABLE `permisosporrol` (
  `permisos_idPermisos` int(11) NOT NULL,
  `idRoles_Roles` int(11) NOT NULL,
  PRIMARY KEY (`permisos_idPermisos`,`idRoles_Roles`),
  KEY `fk_permisos_has_Roles_Roles1_idx` (`idRoles_Roles`),
  KEY `fk_permisos_has_Roles_permisos1_idx` (`permisos_idPermisos`),
  CONSTRAINT `fk_permisos_has_Roles_Roles1` FOREIGN KEY (`idRoles_Roles`) REFERENCES `roles` (`idRoles`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_permisos_has_Roles_permisos1` FOREIGN KEY (`permisos_idPermisos`) REFERENCES `permisos` (`idPermisos`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8\n\nINSERT INTO permisosporrol VALUES ("1","1");\n\nINSERT INTO permisosporrol VALUES ("2","1");\n\nINSERT INTO permisosporrol VALUES ("3","1");\n\nINSERT INTO permisosporrol VALUES ("4","1");\n\nINSERT INTO permisosporrol VALUES ("5","1");\n\nINSERT INTO permisosporrol VALUES ("6","1");\n\nINSERT INTO permisosporrol VALUES ("7","1");\n\nINSERT INTO permisosporrol VALUES ("8","1");\n\nINSERT INTO permisosporrol VALUES ("9","1");\n\nINSERT INTO permisosporrol VALUES ("10","1");\n\nINSERT INTO permisosporrol VALUES ("12","1");\n\nINSERT INTO permisosporrol VALUES ("14","1");\n\nINSERT INTO permisosporrol VALUES ("15","1");\n\nINSERT INTO permisosporrol VALUES ("16","1");\n\nINSERT INTO permisosporrol VALUES ("17","1");\n\nINSERT INTO permisosporrol VALUES ("18","1");\n\nINSERT INTO permisosporrol VALUES ("19","1");\n\nINSERT INTO permisosporrol VALUES ("20","1");\n\nINSERT INTO permisosporrol VALUES ("21","1");\n\nINSERT INTO permisosporrol VALUES ("22","1");\n\nINSERT INTO permisosporrol VALUES ("23","1");\n\nINSERT INTO permisosporrol VALUES ("24","1");\n\nINSERT INTO permisosporrol VALUES ("25","1");\n\nINSERT INTO permisosporrol VALUES ("26","1");\n\nINSERT INTO permisosporrol VALUES ("27","1");\n\nINSERT INTO permisosporrol VALUES ("28","1");\n\nINSERT INTO permisosporrol VALUES ("29","1");\n\nINSERT INTO permisosporrol VALUES ("30","1");\n\nINSERT INTO permisosporrol VALUES ("31","1");\n\nINSERT INTO permisosporrol VALUES ("32","1");\n\nINSERT INTO permisosporrol VALUES ("33","1");\n\nINSERT INTO permisosporrol VALUES ("34","1");\n\nINSERT INTO permisosporrol VALUES ("35","1");\n\nINSERT INTO permisosporrol VALUES ("36","1");\n\nINSERT INTO permisosporrol VALUES ("37","1");\n\nINSERT INTO permisosporrol VALUES ("38","1");\n\nINSERT INTO permisosporrol VALUES ("39","1");\n\nINSERT INTO permisosporrol VALUES ("40","1");\n\n<br>DROP TABLE IF EXISTS procesos,CREATE TABLE `procesos` (
  `idProceso` int(11) NOT NULL AUTO_INCREMENT,
  `tipoProceso` varchar(45) NOT NULL,
  `precioProceso` int(11) DEFAULT NULL,
  PRIMARY KEY (`idProceso`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8\n\n<br>DROP TABLE IF EXISTS procesoporproducto,CREATE TABLE `procesoporproducto` (
  `idProductos_Productos` int(11) NOT NULL,
  `procesos_idProceso` int(11) NOT NULL,
  `cantidadDeEmpleados` int(11) DEFAULT NULL,
  `tiempoPorProceso` int(11) DEFAULT NULL,
  PRIMARY KEY (`idProductos_Productos`,`procesos_idProceso`),
  KEY `fk_Productos_has_procesos_procesos1_idx` (`procesos_idProceso`),
  KEY `fk_Productos_has_procesos_Productos1_idx` (`idProductos_Productos`),
  CONSTRAINT `fk_Productos_has_procesos_Productos1` FOREIGN KEY (`idProductos_Productos`) REFERENCES `productos` (`idProductos`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_Productos_has_procesos_procesos1` FOREIGN KEY (`procesos_idProceso`) REFERENCES `procesos` (`idProceso`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8\n\n<br>DROP TABLE IF EXISTS procesosporproyecto,CREATE TABLE `procesosporproyecto` (
  `idProyecto_proyectos` int(11) NOT NULL,
  `procesos_idProceso` int(11) NOT NULL,
  `totalTiempoProceso` int(11) DEFAULT NULL,
  `totalPrecioProceso` int(11) DEFAULT NULL,
  `totalEmpleadosProceso` varchar(45) DEFAULT NULL,
  `porcentajeProvision` int(11) DEFAULT NULL,
  PRIMARY KEY (`idProyecto_proyectos`,`procesos_idProceso`),
  KEY `fk_proyectos_has_procesos_procesos1_idx` (`procesos_idProceso`),
  KEY `fk_proyectos_has_procesos_proyectos1_idx` (`idProyecto_proyectos`),
  CONSTRAINT `fk_proyectos_has_procesos_procesos1` FOREIGN KEY (`procesos_idProceso`) REFERENCES `procesos` (`idProceso`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_proyectos_has_procesos_proyectos1` FOREIGN KEY (`idProyecto_proyectos`) REFERENCES `proyectos` (`idProyecto`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8\n\n<br>DROP TABLE IF EXISTS productoporproyecto,CREATE TABLE `productoporproyecto` (
  `Productos_idProductos` int(11) NOT NULL,
  `proyectosIdProyecto` int(11) NOT NULL,
  `cantidadProductos` int(11) DEFAULT NULL,
  PRIMARY KEY (`Productos_idProductos`,`proyectosIdProyecto`),
  KEY `fk_Productos_has_proyectos_proyectos1_idx` (`proyectosIdProyecto`),
  KEY `fk_Productos_has_proyectos_Productos1_idx` (`Productos_idProductos`),
  CONSTRAINT `fk_Productos_has_proyectos_Productos1` FOREIGN KEY (`Productos_idProductos`) REFERENCES `productos` (`idProductos`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_Productos_has_proyectos_proyectos1` FOREIGN KEY (`proyectosIdProyecto`) REFERENCES `proyectos` (`idProyecto`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8\n\n<br>DROP TABLE IF EXISTS usuarioporproyecto,CREATE TABLE `usuarioporproyecto` (
  `usuarioAsignado` int(11) NOT NULL,
  `proyectoAsignado` int(11) NOT NULL,
  PRIMARY KEY (`usuarioAsignado`,`proyectoAsignado`),
  KEY `fk_usuarioPorProyecto_Proyectos1_idx` (`proyectoAsignado`),
  CONSTRAINT `fk_usuarioPorProyecto_Proyectos1` FOREIGN KEY (`proyectoAsignado`) REFERENCES `proyectos` (`idProyecto`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_usuarioPorProyecto_usuarios1` FOREIGN KEY (`usuarioAsignado`) REFERENCES `personas` (`idUsuario`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8\n\n<br>DROP TABLE IF EXISTS usuarios,CREATE TABLE `usuarios` (
  `idLogin` bigint(20) NOT NULL,
  `contrasena` varchar(32) NOT NULL,
  `rolesId` int(11) NOT NULL,
  PRIMARY KEY (`idLogin`,`rolesId`,`contrasena`),
  KEY `fk_roles_idx` (`rolesId`),
  CONSTRAINT `fk_roles` FOREIGN KEY (`rolesId`) REFERENCES `roles` (`idRoles`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_users_usuarios1` FOREIGN KEY (`idLogin`) REFERENCES `personas` (`identificacion`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8\n\nINSERT INTO usuarios VALUES ("1012377025","c893bad68927b457dbed39460e6afd62","1");\n\nINSERT INTO usuarios VALUES ("1030590693","d8578edf8458ce06fbc5bb76a58c5ca4","1");\n\n