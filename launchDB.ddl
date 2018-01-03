CREATE DATABASE twitterpirate;
\connect twitterpirate;

CREATE TABLE accounts (
	username text PRIMARY KEY, 
	password text, 
	profile text
);

CREATE TABLE wordclouds (
	username text, 
	cloudcontent text, 
	id integer PRIMARY KEY, 
	likes integer, 
	date text
);

