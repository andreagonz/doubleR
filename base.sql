CREATE DATABASE rr;
USE rr;
CREATE TABLE productos (id int NOT NULL AUTO_INCREMENT, nombre varchar(100), precio double, imagen varchar(100), PRIMARY KEY (id));
CREATE TABLE admins (id int NOT NULL AUTO_INCREMENT, nombre varchar(100), pass varchar(100), PRIMARY KEY (id));
INSERT INTO productos (nombre,precio,imagen) VALUES ('Cafe',30.5,'cafe.jpg'),('Arroz Frito',45.5,'arroz_frito.jpg'),('Pescado Frito',70,'pescado.jpg'),('Sopa de Pollo',54,'sopa_pollo.jpg'),('Ensalada',67,'ensalada.jpg'),('Pay de Cereza',51,'pay.jpg'),('Papas Fritas',24,'papas_fritas.jpg'),('Helado',18,'helado.jpg'),('Agua de Sabor',11,'agua.jpg'),('Orden de Aguacate',15,'aguacate.jpg'),('Sopa de Verduras',34,'sopa.jpg'),('Flan',38,'flan.jpg');
