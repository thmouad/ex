CREATE TABLE IF NOT EXISTS compte
(
	idcompte INT(5) AUTO_INCREMENT PRIMARY KEY,
	proprietaire VARCHAR(25),
	type VARCHAR(25),
	solde INT(5)
);
