INSERT INTO `tblpersonaldireccion`
    (`idPersonalDireccion`, `nomPersonalDireccion`, `cargoPersonalDireccion`,
     `cedulaPersonalDireccion`, `correoInstitucionalPersonalDireccion`, `activo`)
VALUES
    (1, 'María Rodríguez', 'Dirección de Recursos para la Formación',
     'V-11223344', 'mariaRodri@uptaeb.edu.ve', 1);

INSERT INTO `tbltecnico`
    (`idTecnico`, `cedulaTecnico`, `correoInstitucionalTecnico`,
     `activo`, `nomTecnico`, `direccionTecnico`)
VALUES
    (1, 'V-87654321', 'cmendoza@uptaeb.edu.ve', 1,
     'Carlos Mendoza', 'Laboratorio de Informática e Instrumentación');

INSERT INTO `tbltelftecnico` (`idtelfTecnico`, `idTecnico`, `telfTecnico`)
VALUES (1, 1, '0412-3456789');

INSERT INTO `tbldocente`
    (`idDocente`, `cedulaDocente`, `nomDocente`, `apellidoDocente`,
     `correoInstitucionalDocente`, `activo`, `idSolicitudPractica`)
VALUES
    (1, 'V-12345678', 'Pedro', 'Pérez',
     'pperez@uptaeb.edu.ve', 1, 1);

INSERT INTO `tbltelfdocente` (`idtelfDocente`, `idDocente`, `telfDocente`)
VALUES (1, 1, '0416-9876543');

INSERT INTO `tblsolicitudpractica`
    (`idSolicitudPractica`, `observacionSolicitudPractica`,
     `fechaSolicitudPractica`, `horaInicioSolicitudPractica`,
     `horaFinSolicitudPractica`, `estadoSolicitudPractica`,
     `idPersonalDireccion`)
VALUES
    (1, 'Solicitud inicial de prueba',
     '2026-06-01', '08:00', '10:00', 'aprobada', 1);

INSERT INTO `tbllaboratorio`
    (`idLaboratorio`, `tipoLaboratorio`, `capacidadLaboratorio`,
     `estadoLaboratorio`, `ubicacionLaboratorio`, `nomLaboratorio`)
VALUES
    (1, 'quimica', '24', 'disponible', 'Edificio A, Piso 1', 'Lab. de Química A-01'),
    (2, 'biologia', '20', 'disponible', 'Edificio B, Piso 2', 'Lab. de Biología B-02'),
    (3, 'computacion', '30', 'disponible', 'Edificio C, Piso 1', 'Lab. de Informática C-01'),
    (4, 'multiproposito', '25', 'disponible', 'Edificio S, Piso 1', 'Lab. Seguridad S-01');

INSERT INTO `tbltipopractica`
    (`idTipoPractica`, `nombreTipoPractica`, `tipoPractica`,
     `objetivoTipoPractica`, `subcategoriaTipoPractica`)
VALUES
    (1, 'Práctica de Laboratorio', 'laboratorio',
     'Desarrollo de habilidades experimentales', 'presencial'),
    (2, 'Taller', 'taller',
     'Aplicación práctica de conceptos teóricos', 'presencial'),
    (3, 'Proyecto', 'proyecto',
     'Desarrollo de un proyecto integrador', 'mixto'),
    (4, 'Evaluación', 'evaluacion',
     'Evaluación práctica de competencias', 'presencial');

INSERT INTO `tblreserva`
    (`idReserva`, `objetivoReserva`, `horaInicioReserva`, `horaFinReserva`,
     `nombreReserva`, `fechaReserva`, `descripReserva`, `turnoReserva`,
     `estadoReserva`, `observacionReserva`,
     `idLaboratorio`, `idSolicitudPractica`, `idTipoPractica`)
VALUES
    (1, 'Práctica de titulación ácido-base', '08:00', '10:00',
     'Química General - Sección 1', '2026-06-10',
     'Práctica introductoria de laboratorio', 'manana',
     'aprobada', 'Reserva confirmada por administración',
     1, 1, 1);

INSERT INTO `tblinsumos`
    (`idInsumos`, `cantidadStock`, `nomInsumos`, `descripInsumos`,
     `categoriaInsumos`, `cantidadDispInsumos`, `cantidadMinInsumos`,
     `unidadMedidaInsumos`)
VALUES
    (1, '500', 'Ácido Clorhídrico', 'HCl 1M para titulaciones',
     'Reactivos Quimicos', '450', '50', 'Mililitros (ml)'),
    (2, '200', 'Hidróxido de Sodio', 'NaOH 0.5M',
     'Reactivos Quimicos', '180', '20', 'Mililitros (ml)'),
    (3, '30', 'Matraz Erlenmeyer', 'Matraz 250ml de vidrio borosilicato',
     'Material de Vidrio (Vidreria)', '28', '5', 'Unidades (Pzas)'),
    (4, '20', 'Probeta Graduada', 'Probeta 100ml de vidrio',
     'Material de Vidrio (Vidreria)', '18', '4', 'Unidades (Pzas)'),
    (5, '5', 'Microscopio Binocular', 'Microscopio óptico 40x-1000x',
     'Equipos e Instrumentos', '4', '1', 'Unidades (Pzas)'),
    (6, '200', 'Portaobjetos', 'Portaobjetos 76x26mm caja 50 uni.',
     'Material Biologico', '180', '20', 'Cajas / Paquetes'),
    (7, '1000', 'Guantes de Nitrilo', 'Guantes talla M sin polvo',
     'Insumos Desechables (Guantes/Mascarillas)', '850', '100', 'Unidades (Pzas)'),
    (8, '500', 'Mascarillas Quirúrgicas', 'Mascarillas 3 capas',
     'Insumos Desechables (Guantes/Mascarillas)', '400', '50', 'Unidades (Pzas)');

INSERT INTO `tblinsumosreserva`
    (`idReserva`, `idInsumos`, `cantidadRequerida`, `estado`)
VALUES
    (1, 1, '50', 'asignado'),
    (1, 3, '10', 'asignado');

INSERT INTO `tbltecnicoinsumos` (`idTecnico`, `idInsumos`)
VALUES
    (1, 1),
    (1, 2),
    (1, 5),
    (1, 7);

INSERT INTO `tblpnf` (`idPNF`, `nombrePNF`, `tblPNFcol`)
VALUES
    (1, 'PNF en Informática', 'Informática'),
    (2, 'PNF en Química', 'Química'),
    (3, 'PNF en Mecánica', 'Mecánica');

INSERT INTO `tblunidadcurricular` (`idUnidadCurricular`, `nombreUnidadCurricular`)
VALUES
    (1, 'Programación I'),
    (2, 'Química Orgánica'),
    (3, 'Física General'),
    (4, 'Matemática Aplicada');

INSERT INTO `tblunidadcurricularpnf` (`idUnidadCurricular`, `idPNF`)
VALUES
    (1, 1),
    (2, 2),
    (3, 1),
    (3, 2),
    (3, 3);

INSERT INTO `tblseccion` (`idSeccion`, `cantidadSeccion`, `turnoSeccion`, `trayectoSeccion`)
VALUES
    (1, '24', 'manana', 'Trayecto I'),
    (2, '20', 'tarde', 'Trayecto II');

INSERT INTO `tblunidadcurricularsecciondocente`
    (`idUnidadCurricular`, `idDocente`, `idSeccion`)
VALUES
    (1, 1, 1),
    (2, 1, 2);
