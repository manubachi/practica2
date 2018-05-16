------------------------------
-- Archivo de base de datos --
------------------------------
DROP TABLE IF EXISTS propietarios CASCADE;
CREATE TABLE propietarios (
    id         BIGSERIAL       PRIMARY KEY
  , nombre     VARCHAR(255)    NOT NULL
  , dni        VARCHAR(255)    NOT NULL UNIQUE
  , telefono   VARCHAR(15)     NOT NULL
);

DROP TABLE IF EXISTS inmuebles CASCADE;
CREATE TABLE inmuebles (
    id               BIGSERIAL     PRIMARY KEY
  , propietario_id   BIGINT        NOT NULL REFERENCES propietarios(id)
  , n_habitaciones   INT
  , n_wc             INT
  , precio           NUMERIC
  , has_lavavajillas BOOLEAN       DEFAULT FALSE
  , has_garage       BOOLEAN       DEFAULT FALSE
  , has_trastero     BOOLEAN       DEFAULT FALSE
  , detalles         VARCHAR(255)
);

INSERT INTO propietarios (nombre, dni, telefono) VALUES
    ('Manuel Alejandro', '20073539-J','+34 608521478')
  , ('Rocio', '401232120-E', '+34 678123698')
  , ('Pepe', '401232121-F', '+34 612789541')
  , ('Ana', '401232122-G', '+34 677845211')
  , ('Paco', '401232123-H','+34 697210130')
;

INSERT INTO inmuebles (propietario_id, n_habitaciones, n_wc, precio,
                       has_lavavajillas, has_garage, has_trastero,
                       detalles)
VALUES
    (1, 2, 2, 250, false, false, false, 'Muy bonito todo')
  , (2, 1, 1, 190, true, true, true, 'A pie de playa')
  , (3, 8, 4, 550, false, true, false, 'Buen precio')
  , (4, 4, 2, 420, true, true, false, 'En el campo')
  , (5, 3, 1, 330, false, false, true, 'Con piscina')
;
