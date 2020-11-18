drop database tracking_brand;
create database tracking_brand;
use  tracking_brand;

create table tb_cliente(
    id_cliente int primary key AUTO_INCREMENT,
    nombre_cli varchar(20),
    apat_cli varchar(20),
    amat_cli varchar(20),
    email_clie varchar(100),
    tel_clie varchar(10),
    uuid_clie varchar(15)
)engine=innodb;

create table tb_automovil(
    id_automovil int primary key AUTO_INCREMENT,
    placas_auto varchar(10) UNIQUE,
    marca_auto varchar(20),
    modelo_auto varchar(20), 
    nserie_auto varchar(20),
    num_tarjeta_circula varchar(50),
    tipo_auto varchar(50),
    color_auto varchar(30),
    kilometraje_ini int(10),
    kilometraje_fin int(10),
    gasolina_ini int(3),
    gasolina_fin int(3),
    fecha_ingreso date,
    fecha_salida date,
    detalles_obs text,
    id_cliente int NOT NULL,
    FOREIGN KEY (id_cliente) REFERENCES tb_cliente(id_cliente) ON DELETE CASCADE ON UPDATE CASCADE,
    status_auto varchar(20),
    uuid_auto varchar(15)
)engine=innodb;


create table tb_evidencia(
    id_evidencia int primary key AUTO_INCREMENT,
    tipo_evidencia enum('video','Foto'),
    area_evidencia varchar(20),
    id_automovil int NOT NULL,
    FOREIGN KEY (id_automovil) REFERENCES tb_automovil(id_automovil) ON DELETE CASCADE ON UPDATE CASCADE,
    archivo_evidencia varchar(50)
)engine=innodb;


CREATE TABLE controlAutomovil
(
   id_control int not null auto_increment,
   id_automovil int,
   anterior_status varchar(50),
   nuevo_status varchar(50),
   modificado datetime,
   primary key(id_control)
) ENGINE = InnoDB;



DROP TRIGGER IF EXISTS tg_controlAutomovil;
delimiter //
create trigger tg_controlAutomovil after update on tb_automovil
   for each row
    begin
         insert into controlAutomovil (id_automovil, anterior_status , nuevo_status, modificado )
          values(OLD.id_automovil , OLD.status_auto , NEW.status_auto, NOW() );
    end//
delimiter ;

CREATE TABLE tb_detalles_terminado(
    id_detalle_terminado int(10) primary key auto_increment,
    id_automovil int(10) NOT NULL,
    area_terminada varchar(25),
    area_nueva varchar(25),
    fecha_hora_terminada datetime,
    detalles_obs text,
    operador_encargado varchar(50),
    FOREIGN KEY (id_automovil) REFERENCES tb_automovil(id_automovil) ON DELETE CASCADE ON UPDATE CASCADE
)ENGINE=InnoDB;

CREATE TABLE tb_firmas(
    id_firma int(10) primary key auto_increment,
    id_automovil int(10) NOT NULL,
    tipo_firma ENUM('recepcion','terminado'),
    ruta_firma varchar(50),
    fecha_hora_firmado datetime,
    FOREIGN KEY (id_automovil) REFERENCES tb_automovil(id_automovil) ON DELETE CASCADE ON UPDATE CASCADE
)ENGINE=InnoDB;

