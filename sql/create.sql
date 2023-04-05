drop table if exists utilisateur cascade;
drop table if exists message;
drop table if exists page;
drop table if exists portfolio;

create table utilisateur (
  nomUtilisateur text primary key,
  mdphash textl not null,
  nom text,
  prenom text,
  age int,
  ville text,
  universite text,
  mailUtilisateur text
);

create table message (
  mailMessage text,
  nomUtilisateur text references utilisateur(nomUtilisateur),
  nomEnvoyeur text,
  prenom text,
  objet text not null,
  message text not null,
  primary key(mailMessage, nomUtilisateur)
);

create table portfolio (
    nomUtilisateur text references utilisateur(nomUtilisateur),
    idPortfolio serial not null,
    nomPortfolio text not null,
    accesible boolean,
    primary key(nomUtilisateur, idPortfolio)
);

create table page (
    nomUtilisateur text,
    idPortfolio int,
    idPage serial not null,
    jsonPage json not null,
    type text not null,
    foreign key (nomUtilisateur, idPortfolio) references portfolio(nomUtilisateur, idPortfolio),
    primary key(nomUtilisateur, idPortfolio, idPage)
);