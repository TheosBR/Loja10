create database loja10;
use loja10;

create table produtos(
	id int auto_increment primary key,
     nome VARCHAR(100),
    preco DECIMAL(10,2),
    imagem VARCHAR(255)
);

CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100),
    email VARCHAR(100),
    senha VARCHAR(255)
);


DESCRIBE usuarios;
select * from usuarios;
select * from produtos;
