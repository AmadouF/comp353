drop table Payments;
drop table Tasks;
drop table Regular;
drop table Manager;
drop table Deliverables;
drop table Contracts;
drop table SalesAssociate;
drop table Admins;
drop table Employees;
drop table Clients;

CREATE TABLE Clients(
  clientId INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  clientName VARCHAR(255) NOT NULL,
  repFirstName VARCHAR(255) NOT NULL,
  repMiddleInital VARCHAR(5) NOT NULL,
  repLastName VARCHAR(255) NOT NULL,
  emailId VARCHAR(255) NOT NULL,
  city VARCHAR(255) NOT NULL,
  province VARCHAR(255) NOT NULL,
  postalCode VARCHAR(255) NOT NULL,
  password VARCHAR(20) NOT NULL
);

CREATE TABLE Employees (
  employeeId INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  firstName VARCHAR(255) NOT NULL,
  lastName VARCHAR(255) NOT NULL,
  password varchar(20) NOT NULL
);

CREATE TABLE SalesAssociate (
  employeeId INT NOT NULL PRIMARY KEY REFERENCES Employees(employeeId)
);

CREATE TABLE Admins (
  employeeId INT NOT NULL PRIMARY KEY REFERENCES Employees(employeeId)
);

CREATE TABLE Contracts(
  contractId INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  clientId INT NOT NULL,
  superviseBy INT NOT NULL,
  contactNumber VARCHAR(15) NOT NULL,
  annualContractValue DOUBLE NOT NULL,
  initalAmount DOUBLE NOT NULL,
  serviceStartDate DATE NOT NULL,
  serviceType ENUM('Cloud','On-premises') NOT NULL,
  contractType ENUM('Premium','Gold','Diamond','Silver') NOT NULL,
  lineOfBusiness ENUM('CloudServices', 'Development', 'Research') NOT NULL,
  satisfactionLevel INT CHECK (satisfactionLevel >=1 AND satisfactionLevel <=10),
  FOREIGN KEY (clientId) REFERENCES Clients(clientId),
  FOREIGN KEY (superviseBy) REFERENCES SalesAssociate(employeeId)
);

create table Payments(
	paymentId INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	contractId INT NOT NULL,
  FOREIGN KEY (contractId) REFERENCES Contracts(contractId)
);

create TABLE Deliverables(
    contractId INT NOT NULL,
    deliverableIndex INT NOT NULL,
    scheduledDate DATE NOT NULL,
    deliveredDate DATE,
    PRIMARY KEY (contractId, DeliverableIndex),
    FOREIGN KEY (contractId) REFERENCES Contracts(contractId),
    CHECK(WEEDDAY(scheduledDate)!=5 AND WEEKDAY(scheduledDate)!=6)
);

CREATE TABLE Manager (
  employeeId INT NOT NULL PRIMARY KEY REFERENCES Employees(employeeId),
	contractId INT,
  superviseBy INT NOT NULL,
	FOREIGN KEY (contractId) REFERENCES Contracts(contractId),
  FOREIGN KEY (superviseBy) REFERENCES SalesAssociate(employeeId)
);

CREATE TABLE Regular (
  employeeId INT NOT NULL PRIMARY KEY REFERENCES Employees(employeeId),
	contractId INT,
  manageBy INT,
	department ENUM('Development', 'QA', 'UI', 'Design', 'BusinessIntelligence', 'Networking') NOT NULL,
	insurance ENUM('Premium','Silver','Normal') NOT NULL,
  desiredContractType ENUM('Premium','Gold','Diamond','Silver') NOT NULL,
	FOREIGN KEY (contractId) REFERENCES Contracts(contractId),
  FOREIGN KEY (manageBy) REFERENCES Manager(employeeId)
);

CREATE TABLE Tasks(
  employeeId INT NOT NULL PRIMARY KEY REFERENCES Employees(employeeId),
  contractId INT NOT NULL,
  taskType ENUM('Set up infrastructure for client','Provisioning of resources','Assigning tasks to resources','Allocating a dedicated point of contact') NOT NULL,
  hours int default 0,
  FOREIGN KEY(contractId) REFERENCES Contracts(contractId),
  CHECK(hours >= 0)
);
