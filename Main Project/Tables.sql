--Main Project, new table additions.

CREATE TABLE Contracts(
  contractId INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  clientId INT NOT NULL,
  FOREIGN KEY(clientId) REFERENCES Clients(clientId),
  contactNumber VARCHAR(15) NOT NULL,
  annualContractValue DOUBLE NOT NULL,
  initalAmount DOUBLE NOT NULL,
  serviceStartDate DATE NOT NULL,
  serviceType ENUM('Cloud','On-premises') NOT NULL,
  contractType ENUM('Premium','Gold','Diamond','Silver') NOT NULL,
  lineOfBusiness ENUM('CloudServices', 'Development', 'Research') NOT NULL,
  satisfactionLevel INT CHECK (satisfactionLevel >=1 AND satisfactionLevel <=10)
);


CREATE TABLE Clients(
  clientId INT NOT NULL AUTO_INCREMENT,
  clientName VARCHAR(255),
  repFirstName VARCHAR(255),
  repMiddleInital VARCHAR(5),
  repLastName VARCHAR(255),
  emailId VARCHAR(255),
  city VARCHAR(255),
  province VARCHAR(255),
  postalCode VARCHAR(255),
  password VARCHAR(20) NOT NULL,
  PRIMARY KEY (clientId)
);

CREATE TABLE Employees (
  employeeId INT NOT NULL AUTO_INCREMENT,
  firstName VARCHAR(255) NOT NULL,
  lastName VARCHAR(255) NOT NULL,
  password varchar(20) NOT NULL,
  PRIMARY KEY (employeeId)
);

CREATE TABLE Supervisor (
  employeeId INT NOT NULL PRIMARY KEY REFERENCES Employees(employeeId)
);

CREATE TABLE SalesAssociate (
  employeeId INT NOT NULL PRIMARY KEY REFERENCES Employees(employeeId)
);

CREATE TABLE Admin (
  employeeId INT NOT NULL PRIMARY KEY REFERENCES Employees(employeeId)
);


CREATE TABLE Manager (
  employeeId INT NOT NULL PRIMARY KEY REFERENCES Employees(employeeId),
	contractId INT NOT NULL,
  manageBy INT NOT NULL,
	FOREIGN KEY (contractId) REFERENCES Contracts(contractId),
  FOREIGN KEY (manageBy) REFERENCES Supervisor(employeeId)
);


CREATE TABLE Regular (
  employeeId INT NOT NULL PRIMARY KEY REFERENCES Employees(employeeId),
	contractId INT NOT NULL,
  manageBy INT NOT NULL,
	department ENUM('Development', 'QA', 'UI', 'Design', 'BusinessIntelligence', 'Networking') NOT NULL,
	insurance ENUM('Premium','Silver','Normal') NOT NULL,
  desiredContractType ENUM('Premium','Gold','Diamond','Silver') NOT NULL,
	FOREIGN KEY (contractId) REFERENCES Contracts(contractId),
  FOREIGN KEY (manageBy) REFERENCES Manager(employeeId)
);



CREATE TABLE Tasks(
  employeeId INT NOT NULL PRIMARY KEY REFERENCES Employees(employeeId),
  contractId INT NOT NULL,
  FOREIGN KEY(contractId) REFERENCES Contracts(contractId),
  taskType ENUM('Set up infrastructure for client','Provisioning of resources','Assigning tasks to resources','Allocating a dedicated point of contact') NOT NULL,
  hours int CHECK(hours >= 0) default 0
);








--How to reset primary key
ALTER table Companies AUTO_INCREMENT = 1;

--Companies insertion
INSERT INTO Companies
VALUES (0,'Apple','Tim',NULL,'Cook','timcook@apple.com','Cupertino','CA','T2P4Y5');

INSERT INTO Companies
VALUES (0,'Playstation','Kazuo','K','Hirai','khirai@playstation.com','Tokyo','MU','U6QS9W');

UPDATE Companies
SET proince = 'CA'
WHERE companyName = 'Apple'


--Contracts insertion
INSERT INTO Contracts
VALUES (0,1,'5142225646',97000.00, 124.00, '2010-09-19','Cloud','Diamond');

--Employee insertion
INSERT INTO Employees
VALUES(0,1,'Development',1);
