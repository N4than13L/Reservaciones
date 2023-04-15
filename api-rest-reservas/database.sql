CREATE DATABASE IF NOT EXISTS api_rest_reservaciones;
USE api_rest_reservaciones;

CREATE TABLE users(
id              int(255) auto_increment not null,
name            varchar(50) NOT NULL,
surname         varchar(100),
role            varchar(20),
email           varchar(255) NOT NULL,
password        varchar(255) NOT NULL,
description     text,
image           varchar(255),
created_at      datetime DEFAULT NULL,
updated_at      datetime DEFAULT NULL,
remember_token  varchar(255),
CONSTRAINT pk_users PRIMARY KEY(id)
)ENGINE=InnoDb;

CREATE TABLE booking_type(
id              int(255) auto_increment not null,
name            varchar(100),
created_at      datetime DEFAULT NULL,
updated_at      datetime DEFAULT NULL,
CONSTRAINT pk_booking_type PRIMARY KEY(id)
)ENGINE=InnoDb;

CREATE TABLE booking(
id              int(255) auto_increment not null,
user_id         int(255) not null,
booking_id     int(255) not null,
name           varchar(255),
surname         varchar(255),
bio           text,
age 			int,
nationality varchar(255),
created_at      datetime DEFAULT NULL,
updated_at      datetime DEFAULT NULL,
CONSTRAINT pk_booking PRIMARY KEY(id),
CONSTRAINT fk_booking_user FOREIGN KEY(user_id) REFERENCES users(id),
CONSTRAINT fk_booking_type_bokking FOREIGN KEY(booking_id) REFERENCES booking_type(id)
)ENGINE=InnoDb;