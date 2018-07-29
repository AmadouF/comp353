--Main Project, new table additions.

CREATE TABLE Contracts(
contractId int NOT NULL AUTO_INCREMENT PRIMARY KEY,
clientId int NOT NULL,
FOREIGN KEY(clientId) REFERENCES Clients(clientId),
contactNumber varchar(15) NOT NULL,
annualContractValue double NOT NULL,
initalAmount double NOT NULL,
serviceStartDate DATE NOT NULL,
serviceType ENUM('Cloud','On-premises') NOT NULL,
contractType ENUM('Premium','Gold','Diamond','Silver') NOT NULL,
lineOfBusiness ENUM('CloudServices', 'Development', 'Research'),
satisfactionLevel int CHECK (satisfactionLevel >=1 AND satisfactionLevel <=10)
);


Create table Clients(
 clientId int NOT NULL AUTO_INCREMENT,
 clientName varchar(255),
 repFirstName varchar(255),
 repMiddleInital varchar(5),
 repLastName varchar(255),
 emailId varchar(255), 
 city varchar(255), 
 province varchar(255),
 postalCode varchar(255),
 password varchar(20),
 PRIMARY KEY (clientId)
 );
 
CREATE TABLE Employees (
employeeId INT NOT NULL AUTO_INCREMENT,
firstName VARCHAR(255) NOT NULL,
lastName VARCHAR(255) NOT NULL, 
password varchar(20) NOT NULL,
PRIMARY KEY (employeeId));

CREATE TABLE SalesAssociate (
        employeeId int NOT NULL PRIMARY KEY REFERENCES Employees(employeeId)
);

CREATE TABLE Admin (
        employeeId int NOT NULL PRIMARY KEY REFERENCES Employees(employeeId)
);


CREATE TABLE Manager (
        employeeId INT NOT NULL PRIMARY KEY REFERENCES Employees(employeeId),
		contractId int NOT NULL,
		FOREIGN KEY (contractId) REFERENCES Contracts(contractId)
);


CREATE TABLE Regular (
        employeeId INT NOT NULL PRIMARY KEY REFERENCES Employees(employeeId),
		contractId int NOT NULL,
		department ENUM('Development', 'QA', 'UI', 'Design', 'BusinessIntelligence', 'Networking') NOT NULL,
		insurance ENUM('Premium','Silver','Normal') NOT NULL,
		FOREIGN KEY (contractId) REFERENCES Contracts(contractId)
);



CREATE TABLE Tasks(
employeeId INT NOT NULL PRIMARY KEY REFERENCES Employees(employeeId),
contractId int NOT NULL,
FOREIGN KEY(contractId) REFERENCES Contracts(contractId),
taskType ENUM('Set up infrastructure for client','Provisioning of resources','Assigning tasks to resources','Allocating a dedicated point of contact') NOT NULL,
hours int CHECK(hours >= 0)
);

 
 
 
 
 
 
 
 --How to reset primary key
 alter table Companies AUTO_INCREMENT = 1;
 
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










