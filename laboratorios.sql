SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;




CREATE TABLE `tblanomalia` (
  `idAnomalia` int(11) NOT NULL,
  `idPractica` int(11) NOT NULL,
  `descripAnomalia` varchar(45) NOT NULL,
  `fechaDecteAnomalia` varchar(45) NOT NULL,
  `estadoAnomalia` varchar(45) NOT NULL,
  `fechaResoAnomalia` date NOT NULL,
  `tipoAnomalia` varchar(45) NOT NULL,
  `idTecnico` int(11) NOT NULL,
  `idReserva` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;



CREATE TABLE `tbldocente` (
  `idDocente` int(11) NOT NULL,
  `cedulaDocente` varchar(45) NOT NULL,
  `nomDocente` varchar(45) NOT NULL,
  `apellidoDocente` varchar(45) NOT NULL,
  `correoInstitucionalDocente` varchar(45) NOT NULL,
  `idSolicitudPractica` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;


INSERT INTO `tbldocente` (`idDocente`, `cedulaDocente`, `nomDocente`, `apellidoDocente`, `correoInstitucionalDocente`, `idSolicitudPractica`) VALUES
(1, 'V-12345678', 'Pedro', 'Pérez', 'pperez@uptaeb.edu.ve', 1);



CREATE TABLE `tblinsumos` (
  `idInsumos` int(11) NOT NULL,
  `cantidadStock` varchar(45) NOT NULL,
  `nomInsumos` varchar(45) NOT NULL,
  `descripInsumos` varchar(45) NOT NULL,
  `categoriaInsumos` varchar(45) NOT NULL,
  `cantidadDispInsumos` varchar(45) NOT NULL,
  `cantidadMinInsumos` varchar(45) NOT NULL,
  `unidadMedidaInsumos` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;



CREATE TABLE `tblinsumosreserva` (
  `idReserva` int(11) NOT NULL,
  `idInsumos` int(11) NOT NULL,
  `cantidadRequerida` varchar(45) NOT NULL,
  `estado` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;



CREATE TABLE `tbllaboratorio` (
  `idLaboratorio` int(11) NOT NULL,
  `tipoLaboratorio` varchar(45) NOT NULL,
  `capacidadLaboratorio` varchar(45) NOT NULL,
  `estadoLaboratorio` varchar(45) NOT NULL,
  `ubicacionLaboratorio` varchar(45) NOT NULL,
  `nomLaboratorio` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;



CREATE TABLE `tblpersonaldireccion` (
  `idPersonalDireccion` int(11) NOT NULL,
  `nomPersonalDireccion` varchar(45) NOT NULL,
  `cargoPersonalDireccion` varchar(45) NOT NULL,
  `cedulaPersonalDireccion` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;


INSERT INTO `tblpersonaldireccion` (`idPersonalDireccion`, `nomPersonalDireccion`, `cargoPersonalDireccion`, `cedulaPersonalDireccion`) VALUES
(1, 'María Rodríguez', 'Dirección de Recursos para la Formación', 'V-11223344');



CREATE TABLE `tblpnf` (
  `idPNF` int(11) NOT NULL,
  `nombrePNF` varchar(45) NOT NULL,
  `tblPNFcol` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;



CREATE TABLE `tblreserva` (
  `idReserva` int(11) NOT NULL,
  `objetivoReserva` varchar(45) NOT NULL,
  `horaInicioReserva` varchar(45) NOT NULL,
  `horaFinReserva` varchar(45) NOT NULL,
  `nombreReserva` varchar(45) NOT NULL,
  `fechaReserva` varchar(45) NOT NULL,
  `descripReserva` varchar(45) NOT NULL,
  `turnoReserva` varchar(45) NOT NULL,
  `estadoReserva` varchar(45) NOT NULL,
  `observacionReserva` varchar(45) NOT NULL,
  `idLaboratorio` int(11) NOT NULL,
  `idSolicitudPractica` int(11) NOT NULL,
  `idTipoPractica` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;



CREATE TABLE `tblseccion` (
  `idSeccion` int(11) NOT NULL,
  `cantidadSeccion` varchar(45) NOT NULL,
  `turnoSeccion` varchar(45) NOT NULL,
  `trayectoSeccion` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;



CREATE TABLE `tblsolicitudpractica` (
  `idSolicitudPractica` int(11) NOT NULL,
  `observacionSolicitudPractica` varchar(45) NOT NULL,
  `fechaSolicitudPractica` date NOT NULL,
  `horaInicioSolicitudPractica` varchar(45) NOT NULL,
  `horaFinSolicitudPractica` varchar(45) NOT NULL,
  `estadoSolicitudPractica` varchar(45) NOT NULL,
  `idPersonalDireccion` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;



CREATE TABLE `tbltecnico` (
  `idTecnico` int(11) NOT NULL,
  `cedulaTecnico` varchar(45) NOT NULL,
  `nomTecnico` varchar(45) NOT NULL,
  `direccionTecnico` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;


INSERT INTO `tbltecnico` (`idTecnico`, `cedulaTecnico`, `nomTecnico`, `direccionTecnico`) VALUES
(1, 'V-87654321', 'Carlos Mendoza', 'Laboratorio de Informática e Instrumentación');



CREATE TABLE `tbltecnicoinsumos` (
  `idTecnico` int(11) NOT NULL,
  `idInsumos` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;



CREATE TABLE `tbltelfdocente` (
  `idtelfDocente` int(11) NOT NULL,
  `idDocente` int(11) NOT NULL,
  `telfDocente` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;



CREATE TABLE `tbltelftecnico` (
  `idtelfTecnico` int(11) NOT NULL,
  `idTecnico` int(11) NOT NULL,
  `telfTecnico` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;



CREATE TABLE `tbltipopractica` (
  `idTipoPractica` int(11) NOT NULL,
  `nombreTipoPractica` varchar(45) NOT NULL,
  `tipoPractica` varchar(45) NOT NULL,
  `objetivoTipoPractica` varchar(45) NOT NULL,
  `subcategoriaTipoPractica` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;



CREATE TABLE `tblunidadcurricular` (
  `idUnidadCurricular` int(11) NOT NULL,
  `nombreUnidadCurricular` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;



CREATE TABLE `tblunidadcurricularpnf` (
  `idUnidadCurricular` int(11) NOT NULL,
  `idPNF` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;



CREATE TABLE `tblunidadcurricularsecciondocente` (
  `idUnidadCurricular` int(11) NOT NULL,
  `idDocente` int(11) NOT NULL,
  `idSeccion` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;


ALTER TABLE `tblanomalia`
  ADD PRIMARY KEY (`idAnomalia`),
  ADD KEY `idTecnico_idx` (`idTecnico`),
  ADD KEY `idReserva_idx` (`idReserva`);

ALTER TABLE `tbldocente`
  ADD PRIMARY KEY (`idDocente`),
  ADD UNIQUE KEY `cedulaDocente_UNIQUE` (`cedulaDocente`),
  ADD KEY `idx_idSolicitudPractica` (`idSolicitudPractica`);

ALTER TABLE `tblinsumos`
  ADD PRIMARY KEY (`idInsumos`);

ALTER TABLE `tblinsumosreserva`
  ADD PRIMARY KEY (`idReserva`,`idInsumos`),
  ADD KEY `idInsumos_idx` (`idInsumos`);

ALTER TABLE `tbllaboratorio`
  ADD PRIMARY KEY (`idLaboratorio`);

ALTER TABLE `tblpersonaldireccion`
  ADD PRIMARY KEY (`idPersonalDireccion`),
  ADD UNIQUE KEY `cedulaPersonalDireccion_UNIQUE` (`cedulaPersonalDireccion`);

ALTER TABLE `tblpnf`
  ADD PRIMARY KEY (`idPNF`);

ALTER TABLE `tblreserva`
  ADD PRIMARY KEY (`idReserva`),
  ADD KEY `idLaboratorio_idx` (`idLaboratorio`),
  ADD KEY `idSolicitudPractica_idx` (`idSolicitudPractica`),
  ADD KEY `idTipoPractica_idx` (`idTipoPractica`);

ALTER TABLE `tblseccion`
  ADD PRIMARY KEY (`idSeccion`);

ALTER TABLE `tblsolicitudpractica`
  ADD PRIMARY KEY (`idSolicitudPractica`),
  ADD KEY `idx_idPersonalDireccion` (`idPersonalDireccion`);

ALTER TABLE `tbltecnico`
  ADD PRIMARY KEY (`idTecnico`),
  ADD UNIQUE KEY `cedulaTecnico_UNIQUE` (`cedulaTecnico`);

ALTER TABLE `tbltecnicoinsumos`
  ADD PRIMARY KEY (`idTecnico`,`idInsumos`),
  ADD KEY `idInsumos_idx` (`idInsumos`);

ALTER TABLE `tbltelfdocente`
  ADD PRIMARY KEY (`idtelfDocente`),
  ADD KEY `idx_idDocente` (`idDocente`);

ALTER TABLE `tbltelftecnico`
  ADD PRIMARY KEY (`idtelfTecnico`),
  ADD KEY `idTecnico_idx` (`idTecnico`);

ALTER TABLE `tbltipopractica`
  ADD PRIMARY KEY (`idTipoPractica`);

ALTER TABLE `tblunidadcurricularpnf`
  ADD PRIMARY KEY (`idUnidadCurricular`,`idPNF`),
  ADD KEY `idPNF_idx` (`idPNF`);

ALTER TABLE `tblunidadcurricularsecciondocente`
  ADD PRIMARY KEY (`idUnidadCurricular`,`idDocente`,`idSeccion`),
  ADD KEY `idx_idDocente` (`idDocente`),
  ADD KEY `idx_idSeccion` (`idSeccion`);


ALTER TABLE `tblanomalia`
  MODIFY `idAnomalia` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `tbldocente`
  MODIFY `idDocente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

ALTER TABLE `tblinsumos`
  MODIFY `idInsumos` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `tbllaboratorio`
  MODIFY `idLaboratorio` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `tblpersonaldireccion`
  MODIFY `idPersonalDireccion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

ALTER TABLE `tblpnf`
  MODIFY `idPNF` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `tblreserva`
  MODIFY `idReserva` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `tblseccion`
  MODIFY `idSeccion` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
