create table autor (
	id int auto_increment,
    nome varchar(100) not null,
    data_nascimento date not null,
    cpf char(11) not null,
    primary key(id)
);

create table categoria (
	id int auto_increment,
    descricao varchar(150) not null,
    primary key(id)
);

create table livro (
	id int auto_increment,
    id_categoria int not null,
    titulo varchar(255) not null,
    isbn varchar(100) not null, 
	editora varchar(255) not null,
    ano year not null,
    primary key(id),
    foreign key(id_categoria) references categoria(id)
);

create table aluno(
	id int auto_increment,
    RA int,
    curso varchar(255),
    nome varchar(155),
    primary key(id)
);

create table usuario(
	id int auto_increment,
    nome varchar(150),
    email varchar(150),
    senha varchar(100),
    primary key(id)
);

create table livro_autor (
	id_autor int not null,
    id_livro int not null,
    foreign key(id_autor) references autor(id),
    foreign key(id_livro) references livro(id),
    primary key(id_autor, id_livro)
);

create table emprestimo(
	id int auto_increment,
    id_livro int not null,
    id_aluno int not null,
    id_usuario int not null,
    data_emprestimo date not null,
    data_devolucao date not null,
    primary key(id),
    foreign key(id_livro) references livro(id),
    foreign key(id_aluno) references aluno(id),
    foreign key(id_usuario) references usuario(id)
);