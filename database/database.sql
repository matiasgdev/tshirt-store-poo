
/* create db */
CREATE DATABASE IF NOT EXISTS store;
USE store;

/* Users table */
CREATE TABLE users (
  id            int(255) AUTO_INCREMENT not null,
  name          varchar(100) not null,
  lastname      varchar(255),
  email         varchar(255) not null, 
  password      varchar(255) not null,
  rol           varchar(20),
  avatar        varchar(255),
  CONSTRAINT pk_users PRIMARY KEY (id),
  CONSTRAINT uq_email UNIQUE(email)
)ENGINE=InnoDb;

INSERT INTO users VALUES (null, "Admin", "Admin", "admin@admin.com", "password", "admin", null);

/* Categories table */
CREATE TABLE categories (
  id      int(255) AUTO_INCREMENT not  null,
  name    varchar(255) not null,
  CONSTRAINT pk_categories PRIMARY KEY (id)
)ENGINE=InnoDb;

INSERT INTO categories VALUES (null, "Manga corta");
INSERT INTO categories VALUES (null, "Escotadas");
INSERT INTO categories VALUES (null, "Manga larga");
INSERT INTO categories VALUES (null, "Camisetas");

/* Products table */
CREATE TABLE products (
  id                int(255) AUTO_INCREMENT not null,
  category_id       int(255) not null,
  name              varchar(100) not null,
  description       TEXT,
  price             float(100,2) not null,
  stock             int(255) not null,
  offer             varchar(2),
  date              date not null,
  image             varchar(255),

  CONSTRAINT pk_products PRIMARY KEY (id),
  CONSTRAINT fk_product_category FOREIGN KEY (category_id) REFERENCES categories(id)
)ENGINE=InnoDb;

/* Orders table */

CREATE TABLE orders (
  id                int(255) AUTO_INCREMENT not null,
  user_id           int(255) not null,
  location          varchar(100) not null,
  address           varchar(255) not null,
  cost              float(200,2) not null,
  status            varchar(20) not null,
  date              date,
  time              time,

  CONSTRAINT pk_orders PRIMARY KEY (id),
  CONSTRAINT fk_order_user FOREIGN KEY (user_id) REFERENCES users(id)
)ENGINE=InnoDb;

/* Order line table */

CREATE TABLE orders_line (
  id           int(255) AUTO_INCREMENT NOT NULL,
  order_id     int(255) not null,
  product_id   int(255) not null,
  
  CONSTRAINT pk_orders_line PRIMARY KEY (id),
  CONSTRAINT fk_order_line FOREIGN KEY (order_id) REFERENCES orders(id),
  CONSTRAINT fk_product_line FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE CASCADE

)ENGINE=InnoDb;

