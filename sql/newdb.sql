create database accounts;

use accounts;

create table admins (
	ID int auto_increment primary key,
	username char(255),
	password char(255)
);

create table users (
	ID int auto_increment primary key,
	FirstName char(255),
	LastName char(255),
	Username char(255),
	Password char(255),
	AssignedKit char(255),
	InspectionDate char(255)
);

create database inventory;

use inventory;

create table reports (
	ID int auto_increment primary key,
	User char(255),
	Inventory text,
	comments text,
	InspectionDate char(255)
);

create table settings (
	kitCount int
);

create table tools (
	ID int auto_increment primary key,
	itemName text,
	partNumber int,
	manufacturer char(255),
	description text,
	quantity int,
	imageFileName char(255),
	fileFormat char(255)
);


alter table reports add fulltext(Inventory);
alter table reports add fulltext(comments);
alter table tools add fulltext(itemName);
alter table tools add fulltext(description);