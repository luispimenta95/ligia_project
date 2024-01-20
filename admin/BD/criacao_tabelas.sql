create table categoria(
id_categoria int auto_increment not null primary key,
nome_categoria varchar(255)
);

create table noticia (
id_noticia int auto_increment not null primary key,
titulo_noticia varchar(255),
texto_noticia longtext ,
data_noticia timestamp,
id_categoria int,
status_noticia boolean default 1,
foreign key(id_categoria) references categoria(id_categoria) on delete restrict on update cascade

);

create table administrador (
id_administrador int auto_increment not null primary key,
nome_administrador varchar(55),
cpf_administrador varchar(15),
senha_administrador varchar(255),
email_administrador varchar(255)

);

create table imagem_noticia(
id_img_noticia int auto_increment not null primary key,
imagem varchar(255),
id_noticia int,
foreign key(id_noticia) references noticia (id_noticia) ON update cascade on delete cascade
);


