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
  clientName VARCHAR(255),
  repFirstName VARCHAR(255),
  repMiddleInital VARCHAR(5),
  repLastName VARCHAR(255),
  emailId VARCHAR(255),
  city VARCHAR(255),
  province VARCHAR(255),
  postalCode VARCHAR(255),
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
    foreign key (contractId) REFERENCES Contracts(contractId)
);

create TABLE Deliverables(
    contractId INT NOT NULL,
    deliverableIndex INT NOT NULL,
    scheduledDate DATE NOT NULL,
    deliveredDate DATE,
    PRIMARY KEY (contractId, DeliverableIndex),
    FOREIGN KEY (contractId) REFERENCES Contracts(contractId)
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


INSERT INTO Employees VALUES(1, 'Alejandro', 'Vargas', 'a');
INSERT INTO Admins VALUES (1);
INSERT INTO Employees VALUES(2, 'Kamren', 'Jackson', 'a');
INSERT INTO SalesAssociate VALUES(2);
INSERT INTO Clients VALUES (1, 'Etrade inc.', 'Celeste', '', 'Guerrero', 'Celeste_Guerrero@Etrade inc..com', 'Montreal', 'North West Territories', 'xxxxxx', 'pass');
INSERT INTO Contracts VALUES (1, 1, 2, '5149108628', 30059.087099574564, 13539.325837613917, '2018-10-12', 'Cloud', 'Premium', 'CloudServices', 5);
INSERT INTO Deliverables VALUES (1, 1, '2018-10-17', null);
INSERT INTO Deliverables VALUES (1, 2, '2018-10-19', null);
INSERT INTO Deliverables VALUES (1, 3, '2018-10-26', null);
INSERT INTO Employees VALUES(3, 'Lorelai', 'Schneider', 'a');
INSERT INTO Manager VALUES (3, 1, 2);
INSERT INTO Employees VALUES(4, 'Simone', 'Miller', 'a');
INSERT INTO Regular VALUES (4, 1,3, 'Development', 'Premium', 'Premium');
INSERT INTO Tasks VALUES (4, 1, 'Assigning tasks to resources', 0);
INSERT INTO Employees VALUES(5, 'Jaelyn', 'Lopez', 'a');
INSERT INTO Regular VALUES (5, 1,3, 'Networking', 'Premium', 'Premium');
INSERT INTO Tasks VALUES (5, 1, 'Set up infrastructure for client', 0);
INSERT INTO Employees VALUES(6, 'Brooks', 'Shepard', 'a');
INSERT INTO Regular VALUES (6, 1,3, 'QA', 'Silver', 'Premium');
INSERT INTO Tasks VALUES (6, 1, 'Provisioning of resources', 0);
INSERT INTO Employees VALUES(7, 'Nikhil', 'Becker', 'a');
INSERT INTO Regular VALUES (7, 1,3, 'Design', 'Silver', 'Premium');
INSERT INTO Tasks VALUES (7, 1, 'Set up infrastructure for client', 0);
INSERT INTO Employees VALUES(8, 'Kathleen', 'Melton', 'a');
INSERT INTO Regular VALUES (8, 1,3, 'Design', 'Silver', 'Premium');
INSERT INTO Tasks VALUES (8, 1, 'Assigning tasks to resources', 0);
INSERT INTO Employees VALUES(9, 'Sarai', 'Hays', 'a');
INSERT INTO Regular VALUES (9, 1,3, 'Networking', 'Normal', 'Premium');
INSERT INTO Tasks VALUES (9, 1, 'Set up infrastructure for client', 0);
INSERT INTO Employees VALUES(10, 'Meredith', 'Barber', 'a');
INSERT INTO Regular VALUES (10, 1,3, 'BusinessIntelligence', 'Premium', 'Premium');
INSERT INTO Tasks VALUES (10, 1, 'Provisioning of resources', 0);
INSERT INTO Employees VALUES(11, 'Wilson', 'Hancock', 'a');
INSERT INTO Manager VALUES (11, 1, 2);
INSERT INTO Employees VALUES(12, 'Virginia', 'Franco', 'a');
INSERT INTO Regular VALUES (12, 1,11, 'Networking', 'Silver', 'Premium');
INSERT INTO Tasks VALUES (12, 1, 'Provisioning of resources', 0);
INSERT INTO Employees VALUES(13, 'Tripp', 'Salinas', 'a');
INSERT INTO Regular VALUES (13, 1,11, 'BusinessIntelligence', 'Silver', 'Premium');
INSERT INTO Tasks VALUES (13, 1, 'Provisioning of resources', 0);
INSERT INTO Employees VALUES(14, 'Kinsley', 'Logan', 'a');
INSERT INTO Regular VALUES (14, 1,11, 'BusinessIntelligence', 'Normal', 'Premium');
INSERT INTO Tasks VALUES (14, 1, 'Provisioning of resources', 0);
INSERT INTO Employees VALUES(15, 'Tabitha', 'Benjamin', 'a');
INSERT INTO Regular VALUES (15, 1,11, 'Design', 'Normal', 'Premium');
INSERT INTO Tasks VALUES (15, 1, 'Allocating a dedicated point of contact', 0);
INSERT INTO Employees VALUES(16, 'Santiago', 'Pace', 'a');
INSERT INTO Regular VALUES (16, 1,11, 'Networking', 'Silver', 'Premium');
INSERT INTO Tasks VALUES (16, 1, 'Provisioning of resources', 0);
INSERT INTO Employees VALUES(17, 'Jerry', 'Estes', 'a');
INSERT INTO Regular VALUES (17, 1,11, 'UI', 'Silver', 'Premium');
INSERT INTO Tasks VALUES (17, 1, 'Assigning tasks to resources', 0);
INSERT INTO Clients VALUES (2, 'WeMakeWebsites', 'Giancarlo', '', 'Randolph', 'Giancarlo_Randolph@WeMakeWebsites.com', 'Montreal', 'North West Territories', 'xxxxxx', 'pass');
INSERT INTO Contracts VALUES (2, 2, 2, '5149108628', 73798.09485021504, 28521.59432826125, '2016-08-11', 'On-premises', 'Diamond', 'Development', 5);
INSERT INTO Deliverables VALUES (2, 1, '2016-08-19', null);
INSERT INTO Deliverables VALUES (2, 2, '2016-08-26', null);
INSERT INTO Deliverables VALUES (2, 3, '2016-09-06', null);
INSERT INTO Employees VALUES(18, 'Kailee', 'Downs', 'a');
INSERT INTO Manager VALUES (18, 2, 2);
INSERT INTO Employees VALUES(19, 'Joaquin', 'Le', 'a');
INSERT INTO Regular VALUES (19, 2,18, 'Development', 'Premium', 'Diamond');
INSERT INTO Tasks VALUES (19, 2, 'Allocating a dedicated point of contact', 0);
INSERT INTO Employees VALUES(20, 'Jaida', 'Watkins', 'a');
INSERT INTO Regular VALUES (20, 2,18, 'Networking', 'Normal', 'Diamond');
INSERT INTO Tasks VALUES (20, 2, 'Provisioning of resources', 0);
INSERT INTO Employees VALUES(21, 'Jaylyn', 'Bridges', 'a');
INSERT INTO Regular VALUES (21, 2,18, 'UI', 'Premium', 'Diamond');
INSERT INTO Tasks VALUES (21, 2, 'Provisioning of resources', 0);
INSERT INTO Employees VALUES(22, 'Yoselin', 'Best', 'a');
INSERT INTO Regular VALUES (22, 2,18, 'Development', 'Premium', 'Diamond');
INSERT INTO Tasks VALUES (22, 2, 'Provisioning of resources', 0);
INSERT INTO Employees VALUES(23, 'Layla', 'Boyd', 'a');
INSERT INTO Regular VALUES (23, 2,18, 'BusinessIntelligence', 'Silver', 'Diamond');
INSERT INTO Tasks VALUES (23, 2, 'Assigning tasks to resources', 0);
INSERT INTO Employees VALUES(24, 'Mila', 'Whitney', 'a');
INSERT INTO Regular VALUES (24, 2,18, 'UI', 'Silver', 'Diamond');
INSERT INTO Tasks VALUES (24, 2, 'Assigning tasks to resources', 0);
INSERT INTO Employees VALUES(25, 'Heidy', 'Maldonado', 'a');
INSERT INTO Regular VALUES (25, 2,18, 'Design', 'Premium', 'Diamond');
INSERT INTO Tasks VALUES (25, 2, 'Set up infrastructure for client', 0);
INSERT INTO Employees VALUES(26, 'Robert', 'Villegas', 'a');
INSERT INTO Manager VALUES (26, 2, 2);
INSERT INTO Employees VALUES(27, 'Brodie', 'Hammond', 'a');
INSERT INTO Regular VALUES (27, 2,26, 'BusinessIntelligence', 'Silver', 'Diamond');
INSERT INTO Tasks VALUES (27, 2, 'Allocating a dedicated point of contact', 0);
INSERT INTO Employees VALUES(28, 'Emery', 'Rivas', 'a');
INSERT INTO Regular VALUES (28, 2,26, 'UI', 'Normal', 'Diamond');
INSERT INTO Tasks VALUES (28, 2, 'Set up infrastructure for client', 0);
INSERT INTO Employees VALUES(29, 'Brianna', 'Dickson', 'a');
INSERT INTO Regular VALUES (29, 2,26, 'BusinessIntelligence', 'Silver', 'Diamond');
INSERT INTO Tasks VALUES (29, 2, 'Assigning tasks to resources', 0);
INSERT INTO Employees VALUES(30, 'Yosef', 'Rollins', 'a');
INSERT INTO Regular VALUES (30, 2,26, 'Development', 'Premium', 'Diamond');
INSERT INTO Tasks VALUES (30, 2, 'Set up infrastructure for client', 0);
INSERT INTO Employees VALUES(31, 'Milagros', 'Lozano', 'a');
INSERT INTO Regular VALUES (31, 2,26, 'Networking', 'Premium', 'Diamond');
INSERT INTO Tasks VALUES (31, 2, 'Set up infrastructure for client', 0);
INSERT INTO Employees VALUES(32, 'Skylar', 'Griffith', 'a');
INSERT INTO Manager VALUES (32, 2, 2);
INSERT INTO Employees VALUES(33, 'Maximo', 'Hampton', 'a');
INSERT INTO Regular VALUES (33, 2,32, 'Development', 'Silver', 'Diamond');
INSERT INTO Tasks VALUES (33, 2, 'Allocating a dedicated point of contact', 0);
INSERT INTO Employees VALUES(34, 'Luis', 'Benton', 'a');
INSERT INTO Regular VALUES (34, 2,32, 'BusinessIntelligence', 'Normal', 'Diamond');
INSERT INTO Tasks VALUES (34, 2, 'Allocating a dedicated point of contact', 0);
INSERT INTO Employees VALUES(35, 'Adrian', 'Carey', 'a');
INSERT INTO Regular VALUES (35, 2,32, 'Design', 'Silver', 'Diamond');
INSERT INTO Tasks VALUES (35, 2, 'Provisioning of resources', 0);
INSERT INTO Employees VALUES(36, 'Micaela', 'Moreno', 'a');
INSERT INTO Regular VALUES (36, 2,32, 'Design', 'Silver', 'Diamond');
INSERT INTO Tasks VALUES (36, 2, 'Allocating a dedicated point of contact', 0);
INSERT INTO Employees VALUES(37, 'Bailee', 'Carney', 'a');
INSERT INTO Regular VALUES (37, 2,32, 'QA', 'Normal', 'Diamond');
INSERT INTO Tasks VALUES (37, 2, 'Allocating a dedicated point of contact', 0);
INSERT INTO Employees VALUES(38, 'Jabari', 'Mahoney', 'a');
INSERT INTO Regular VALUES (38, 2,32, 'BusinessIntelligence', 'Premium', 'Diamond');
INSERT INTO Tasks VALUES (38, 2, 'Set up infrastructure for client', 0);
INSERT INTO Employees VALUES(39, 'Nikolas', 'Ellison', 'a');
INSERT INTO Regular VALUES (39, 2,32, 'Development', 'Premium', 'Diamond');
INSERT INTO Tasks VALUES (39, 2, 'Provisioning of resources', 0);
INSERT INTO Employees VALUES(40, 'Allison', 'King', 'a');
INSERT INTO SalesAssociate VALUES(40);
INSERT INTO Clients VALUES (3, 'Cloud Solutions', 'Jude', '', 'Ward', 'Jude_Ward@Cloud Solutions.com', 'Montreal', 'Prince Edward Island', 'xxxxxx', 'pass');
INSERT INTO Contracts VALUES (3, 3, 40, '5149108628', 68335.37485747016, 26441.2593739196, '2016-10-12', 'On-premises', 'Silver', 'Development', 5);
INSERT INTO Deliverables VALUES (3, 1, '2016-10-19', null);
INSERT INTO Deliverables VALUES (3, 2, '2016-11-02', null);
INSERT INTO Deliverables VALUES (3, 3, '2016-11-09', null);
INSERT INTO Deliverables VALUES (3, 4, '2016-11-21', null);
INSERT INTO Employees VALUES(41, 'Ryleigh', 'Riddle', 'a');
INSERT INTO Manager VALUES (41, 3, 40);
INSERT INTO Employees VALUES(42, 'Kylan', 'Hinton', 'a');
INSERT INTO Regular VALUES (42, 3,41, 'Networking', 'Premium', 'Silver');
INSERT INTO Tasks VALUES (42, 3, 'Assigning tasks to resources', 0);
INSERT INTO Employees VALUES(43, 'Ansley', 'Clarke', 'a');
INSERT INTO Regular VALUES (43, 3,41, 'BusinessIntelligence', 'Silver', 'Silver');
INSERT INTO Tasks VALUES (43, 3, 'Provisioning of resources', 0);
INSERT INTO Employees VALUES(44, 'Yazmin', 'Murillo', 'a');
INSERT INTO Regular VALUES (44, 3,41, 'UI', 'Normal', 'Silver');
INSERT INTO Tasks VALUES (44, 3, 'Allocating a dedicated point of contact', 0);
INSERT INTO Employees VALUES(45, 'Eve', 'Gillespie', 'a');
INSERT INTO Regular VALUES (45, 3,41, 'Development', 'Normal', 'Silver');
INSERT INTO Tasks VALUES (45, 3, 'Allocating a dedicated point of contact', 0);
INSERT INTO Employees VALUES(46, 'Jorge', 'Clay', 'a');
INSERT INTO Regular VALUES (46, 3,41, 'QA', 'Silver', 'Silver');
INSERT INTO Tasks VALUES (46, 3, 'Set up infrastructure for client', 0);
INSERT INTO Employees VALUES(47, 'Brogan', 'Fuentes', 'a');
INSERT INTO Regular VALUES (47, 3,41, 'Design', 'Premium', 'Silver');
INSERT INTO Tasks VALUES (47, 3, 'Assigning tasks to resources', 0);
INSERT INTO Employees VALUES(48, 'Max', 'Grimes', 'a');
INSERT INTO Regular VALUES (48, 3,41, 'Design', 'Silver', 'Silver');
INSERT INTO Tasks VALUES (48, 3, 'Set up infrastructure for client', 0);
INSERT INTO Employees VALUES(49, 'Nicolas', 'Sherman', 'a');
INSERT INTO Manager VALUES (49, 3, 40);
INSERT INTO Employees VALUES(50, 'Ariella', 'Ortiz', 'a');
INSERT INTO Regular VALUES (50, 3,49, 'Design', 'Silver', 'Silver');
INSERT INTO Tasks VALUES (50, 3, 'Set up infrastructure for client', 0);
INSERT INTO Employees VALUES(51, 'Barbara', 'Solis', 'a');
INSERT INTO Regular VALUES (51, 3,49, 'Development', 'Normal', 'Silver');
INSERT INTO Tasks VALUES (51, 3, 'Assigning tasks to resources', 0);
INSERT INTO Employees VALUES(52, 'Brynn', 'Benitez', 'a');
INSERT INTO Regular VALUES (52, 3,49, 'Development', 'Premium', 'Silver');
INSERT INTO Tasks VALUES (52, 3, 'Provisioning of resources', 0);
INSERT INTO Employees VALUES(53, 'Timothy', 'Holmes', 'a');
INSERT INTO Regular VALUES (53, 3,49, 'Development', 'Premium', 'Silver');
INSERT INTO Tasks VALUES (53, 3, 'Allocating a dedicated point of contact', 0);
INSERT INTO Employees VALUES(54, 'Kyle', 'Mathis', 'a');
INSERT INTO Regular VALUES (54, 3,49, 'BusinessIntelligence', 'Silver', 'Silver');
INSERT INTO Tasks VALUES (54, 3, 'Provisioning of resources', 0);
INSERT INTO Clients VALUES (4, 'Google', 'Carley', '', 'Flores', 'Carley_Flores@Google.com', 'Montreal', 'Saskatchewan', 'xxxxxx', 'pass');
INSERT INTO Contracts VALUES (4, 4, 40, '5149108628', 13041.088902069969, 1118.1209605268841, '2015-11-01', 'On-premises', 'Premium', 'CloudServices', 5);
INSERT INTO Deliverables VALUES (4, 1, '2015-11-04', null);
INSERT INTO Deliverables VALUES (4, 2, '2015-11-06', null);
INSERT INTO Deliverables VALUES (4, 3, '2015-11-13', null);
INSERT INTO Employees VALUES(55, 'Cortez', 'Ponce', 'a');
INSERT INTO Manager VALUES (55, 4, 40);
INSERT INTO Employees VALUES(56, 'Jasmine', 'Jones', 'a');
INSERT INTO Regular VALUES (56, 4,55, 'Design', 'Premium', 'Premium');
INSERT INTO Tasks VALUES (56, 4, 'Allocating a dedicated point of contact', 0);
INSERT INTO Employees VALUES(57, 'Neveah', 'Davenport', 'a');
INSERT INTO Regular VALUES (57, 4,55, 'Design', 'Premium', 'Premium');
INSERT INTO Tasks VALUES (57, 4, 'Provisioning of resources', 0);
INSERT INTO Employees VALUES(58, 'Tucker', 'Pena', 'a');
INSERT INTO Regular VALUES (58, 4,55, 'QA', 'Silver', 'Premium');
INSERT INTO Tasks VALUES (58, 4, 'Set up infrastructure for client', 0);
INSERT INTO Employees VALUES(59, 'Ann', 'Curry', 'a');
INSERT INTO Regular VALUES (59, 4,55, 'Networking', 'Normal', 'Premium');
INSERT INTO Tasks VALUES (59, 4, 'Allocating a dedicated point of contact', 0);
INSERT INTO Employees VALUES(60, 'Jillian', 'Shepherd', 'a');
INSERT INTO Regular VALUES (60, 4,55, 'QA', 'Silver', 'Premium');
INSERT INTO Tasks VALUES (60, 4, 'Set up infrastructure for client', 0);
INSERT INTO Employees VALUES(61, 'Conner', 'Bennett', 'a');
INSERT INTO Regular VALUES (61, 4,55, 'UI', 'Silver', 'Premium');
INSERT INTO Tasks VALUES (61, 4, 'Assigning tasks to resources', 0);
INSERT INTO Employees VALUES(62, 'Londyn', 'Harrell', 'a');
INSERT INTO Regular VALUES (62, 4,55, 'Networking', 'Normal', 'Premium');
INSERT INTO Tasks VALUES (62, 4, 'Provisioning of resources', 0);
INSERT INTO Employees VALUES(63, 'Armani', 'Preston', 'a');
INSERT INTO Manager VALUES (63, 4, 40);
INSERT INTO Employees VALUES(64, 'Marie', 'Reid', 'a');
INSERT INTO Regular VALUES (64, 4,63, 'BusinessIntelligence', 'Silver', 'Premium');
INSERT INTO Tasks VALUES (64, 4, 'Provisioning of resources', 0);
INSERT INTO Employees VALUES(65, 'River', 'Mitchell', 'a');
INSERT INTO Regular VALUES (65, 4,63, 'Development', 'Silver', 'Premium');
INSERT INTO Tasks VALUES (65, 4, 'Assigning tasks to resources', 0);
INSERT INTO Employees VALUES(66, 'Cristal', 'Bradford', 'a');
INSERT INTO Regular VALUES (66, 4,63, 'Development', 'Normal', 'Premium');
INSERT INTO Tasks VALUES (66, 4, 'Set up infrastructure for client', 0);
INSERT INTO Employees VALUES(67, 'Lailah', 'Valentine', 'a');
INSERT INTO Regular VALUES (67, 4,63, 'Networking', 'Normal', 'Premium');
INSERT INTO Tasks VALUES (67, 4, 'Set up infrastructure for client', 0);
INSERT INTO Employees VALUES(68, 'Miguel', 'Owens', 'a');
INSERT INTO Regular VALUES (68, 4,63, 'UI', 'Silver', 'Premium');
INSERT INTO Tasks VALUES (68, 4, 'Set up infrastructure for client', 0);
INSERT INTO Employees VALUES(69, 'Alberto', 'Montgomery', 'a');
INSERT INTO Regular VALUES (69, 4,63, 'Development', 'Normal', 'Premium');
INSERT INTO Tasks VALUES (69, 4, 'Allocating a dedicated point of contact', 0);
INSERT INTO Employees VALUES(70, 'Samson', 'Roth', 'a');
INSERT INTO Regular VALUES (70, 4,63, 'UI', 'Premium', 'Premium');
INSERT INTO Tasks VALUES (70, 4, 'Allocating a dedicated point of contact', 0);
INSERT INTO Employees VALUES(71, 'Elyse', 'Collins', 'a');
INSERT INTO SalesAssociate VALUES(71);
INSERT INTO Clients VALUES (5, 'Facebook', 'Chase', '', 'Edwards', 'Chase_Edwards@Facebook.com', 'Montreal', 'Prince Edward Island', 'xxxxxx', 'pass');
INSERT INTO Contracts VALUES (5, 5, 71, '5149108628', 52694.435764340626, 2927.801295776135, '2017-02-24', 'Cloud', 'Silver', 'Research', 5);
INSERT INTO Deliverables VALUES (5, 1, '2017-03-03', null);
INSERT INTO Deliverables VALUES (5, 2, '2017-03-17', null);
INSERT INTO Deliverables VALUES (5, 3, '2017-03-24', null);
INSERT INTO Deliverables VALUES (5, 4, '2017-04-05', null);
INSERT INTO Employees VALUES(72, 'Tamia', 'Mullins', 'a');
INSERT INTO Manager VALUES (72, 5, 71);
INSERT INTO Employees VALUES(73, 'Walker', 'Spence', 'a');
INSERT INTO Regular VALUES (73, 5,72, 'QA', 'Silver', 'Silver');
INSERT INTO Tasks VALUES (73, 5, 'Set up infrastructure for client', 0);
INSERT INTO Employees VALUES(74, 'Diana', 'Elliott', 'a');
INSERT INTO Regular VALUES (74, 5,72, 'Development', 'Silver', 'Silver');
INSERT INTO Tasks VALUES (74, 5, 'Set up infrastructure for client', 0);
INSERT INTO Employees VALUES(75, 'Dalia', 'Davidson', 'a');
INSERT INTO Regular VALUES (75, 5,72, 'Design', 'Normal', 'Silver');
INSERT INTO Tasks VALUES (75, 5, 'Provisioning of resources', 0);
INSERT INTO Employees VALUES(76, 'Quinten', 'Larsen', 'a');
INSERT INTO Regular VALUES (76, 5,72, 'Design', 'Premium', 'Silver');
INSERT INTO Tasks VALUES (76, 5, 'Set up infrastructure for client', 0);
INSERT INTO Employees VALUES(77, 'Hadassah', 'Brandt', 'a');
INSERT INTO Regular VALUES (77, 5,72, 'UI', 'Silver', 'Silver');
INSERT INTO Tasks VALUES (77, 5, 'Assigning tasks to resources', 0);
INSERT INTO Employees VALUES(78, 'Tristin', 'Hendricks', 'a');
INSERT INTO Regular VALUES (78, 5,72, 'Design', 'Normal', 'Silver');
INSERT INTO Tasks VALUES (78, 5, 'Allocating a dedicated point of contact', 0);
INSERT INTO Employees VALUES(79, 'Dulce', 'Benson', 'a');
INSERT INTO Regular VALUES (79, 5,72, 'Design', 'Silver', 'Silver');
INSERT INTO Tasks VALUES (79, 5, 'Assigning tasks to resources', 0);
INSERT INTO Employees VALUES(80, 'Krish', 'Simmons', 'a');
INSERT INTO Regular VALUES (80, 5,72, 'UI', 'Premium', 'Silver');
INSERT INTO Tasks VALUES (80, 5, 'Assigning tasks to resources', 0);
INSERT INTO Employees VALUES(81, 'Taryn', 'Graham', 'a');
INSERT INTO Manager VALUES (81, 5, 71);
INSERT INTO Employees VALUES(82, 'Jazlene', 'Tapia', 'a');
INSERT INTO Regular VALUES (82, 5,81, 'Networking', 'Silver', 'Silver');
INSERT INTO Tasks VALUES (82, 5, 'Set up infrastructure for client', 0);
INSERT INTO Employees VALUES(83, 'Nehemiah', 'Wiley', 'a');
INSERT INTO Regular VALUES (83, 5,81, 'UI', 'Silver', 'Silver');
INSERT INTO Tasks VALUES (83, 5, 'Allocating a dedicated point of contact', 0);
INSERT INTO Employees VALUES(84, 'Arnav', 'Silva', 'a');
INSERT INTO Regular VALUES (84, 5,81, 'BusinessIntelligence', 'Premium', 'Silver');
INSERT INTO Tasks VALUES (84, 5, 'Provisioning of resources', 0);
INSERT INTO Employees VALUES(85, 'Deven', 'Palmer', 'a');
INSERT INTO Regular VALUES (85, 5,81, 'UI', 'Silver', 'Silver');
INSERT INTO Tasks VALUES (85, 5, 'Set up infrastructure for client', 0);
INSERT INTO Employees VALUES(86, 'Sam', 'Park', 'a');
INSERT INTO Regular VALUES (86, 5,81, 'BusinessIntelligence', 'Premium', 'Silver');
INSERT INTO Tasks VALUES (86, 5, 'Provisioning of resources', 0);
INSERT INTO Employees VALUES(87, 'Brayan', 'Baird', 'a');
INSERT INTO Regular VALUES (87, 5,81, 'BusinessIntelligence', 'Normal', 'Silver');
INSERT INTO Tasks VALUES (87, 5, 'Assigning tasks to resources', 0);
INSERT INTO Employees VALUES(88, 'Isabella', 'Robles', 'a');
INSERT INTO Regular VALUES (88, 5,81, 'Design', 'Silver', 'Silver');
INSERT INTO Tasks VALUES (88, 5, 'Set up infrastructure for client', 0);
INSERT INTO Employees VALUES(89, 'Angie', 'Avery', 'a');
INSERT INTO SalesAssociate VALUES(89);
INSERT INTO Clients VALUES (6, 'Twitterm', 'Madalyn', '', 'Stokes', 'Madalyn_Stokes@Twitterm.com', 'Montreal', 'Quebec', 'xxxxxx', 'pass');
INSERT INTO Contracts VALUES (6, 6, 89, '5149108628', 34660.77933791782, 8622.682928245438, '2016-08-18', 'Cloud', 'Gold', 'Research', 5);
INSERT INTO Deliverables VALUES (6, 1, '2016-08-30', null);
INSERT INTO Deliverables VALUES (6, 2, '2016-09-07', null);
INSERT INTO Deliverables VALUES (6, 3, '2016-09-15', null);
INSERT INTO Employees VALUES(90, 'Madyson', 'Nunez', 'a');
INSERT INTO Manager VALUES (90, 6, 89);
INSERT INTO Employees VALUES(91, 'Giada', 'Greene', 'a');
INSERT INTO Regular VALUES (91, 6,90, 'BusinessIntelligence', 'Normal', 'Gold');
INSERT INTO Tasks VALUES (91, 6, 'Assigning tasks to resources', 0);
INSERT INTO Employees VALUES(92, 'Lilly', 'Stark', 'a');
INSERT INTO Regular VALUES (92, 6,90, 'QA', 'Normal', 'Gold');
INSERT INTO Tasks VALUES (92, 6, 'Allocating a dedicated point of contact', 0);
INSERT INTO Employees VALUES(93, 'Jayvon', 'Gutierrez', 'a');
INSERT INTO Regular VALUES (93, 6,90, 'Design', 'Normal', 'Gold');
INSERT INTO Tasks VALUES (93, 6, 'Set up infrastructure for client', 0);
INSERT INTO Employees VALUES(94, 'Breanna', 'Bowman', 'a');
INSERT INTO Regular VALUES (94, 6,90, 'Design', 'Normal', 'Gold');
INSERT INTO Tasks VALUES (94, 6, 'Allocating a dedicated point of contact', 0);
INSERT INTO Employees VALUES(95, 'Landen', 'Hardin', 'a');
INSERT INTO Regular VALUES (95, 6,90, 'Design', 'Normal', 'Gold');
INSERT INTO Tasks VALUES (95, 6, 'Assigning tasks to resources', 0);
INSERT INTO Employees VALUES(96, 'Hayden', 'Hurst', 'a');
INSERT INTO Regular VALUES (96, 6,90, 'Design', 'Premium', 'Gold');
INSERT INTO Tasks VALUES (96, 6, 'Assigning tasks to resources', 0);
INSERT INTO Employees VALUES(97, 'Houston', 'Barnett', 'a');
INSERT INTO Manager VALUES (97, 6, 89);
INSERT INTO Employees VALUES(98, 'Marquis', 'Hooper', 'a');
INSERT INTO Regular VALUES (98, 6,97, 'BusinessIntelligence', 'Silver', 'Gold');
INSERT INTO Tasks VALUES (98, 6, 'Assigning tasks to resources', 0);
INSERT INTO Employees VALUES(99, 'Ezekiel', 'Lewis', 'a');
INSERT INTO Regular VALUES (99, 6,97, 'UI', 'Premium', 'Gold');
INSERT INTO Tasks VALUES (99, 6, 'Assigning tasks to resources', 0);
INSERT INTO Employees VALUES(100, 'Cristofer', 'Gilmore', 'a');
INSERT INTO Regular VALUES (100, 6,97, 'Design', 'Silver', 'Gold');
INSERT INTO Tasks VALUES (100, 6, 'Assigning tasks to resources', 0);
INSERT INTO Employees VALUES(101, 'Nora', 'Wall', 'a');
INSERT INTO Regular VALUES (101, 6,97, 'Networking', 'Silver', 'Gold');
INSERT INTO Tasks VALUES (101, 6, 'Assigning tasks to resources', 0);
INSERT INTO Employees VALUES(102, 'Fabian', 'Maxwell', 'a');
INSERT INTO Regular VALUES (102, 6,97, 'BusinessIntelligence', 'Normal', 'Gold');
INSERT INTO Tasks VALUES (102, 6, 'Allocating a dedicated point of contact', 0);
INSERT INTO Employees VALUES(103, 'Callum', 'Green', 'a');
INSERT INTO Regular VALUES (103, 6,97, 'Development', 'Normal', 'Gold');
INSERT INTO Tasks VALUES (103, 6, 'Set up infrastructure for client', 0);
INSERT INTO Employees VALUES(104, 'Savannah', 'Finley', 'a');
INSERT INTO Regular VALUES (104, 6,97, 'BusinessIntelligence', 'Normal', 'Gold');
INSERT INTO Tasks VALUES (104, 6, 'Provisioning of resources', 0);
INSERT INTO Employees VALUES(105, 'Carmelo', 'Hudson', 'a');
INSERT INTO Manager VALUES (105, 6, 89);
INSERT INTO Employees VALUES(106, 'Phillip', 'Duran', 'a');
INSERT INTO Regular VALUES (106, 6,105, 'BusinessIntelligence', 'Premium', 'Gold');
INSERT INTO Tasks VALUES (106, 6, 'Allocating a dedicated point of contact', 0);
INSERT INTO Employees VALUES(107, 'Alfred', 'Villanueva', 'a');
INSERT INTO Regular VALUES (107, 6,105, 'UI', 'Normal', 'Gold');
INSERT INTO Tasks VALUES (107, 6, 'Assigning tasks to resources', 0);
INSERT INTO Employees VALUES(108, 'Kamari', 'Daugherty', 'a');
INSERT INTO Regular VALUES (108, 6,105, 'UI', 'Silver', 'Gold');
INSERT INTO Tasks VALUES (108, 6, 'Provisioning of resources', 0);
INSERT INTO Employees VALUES(109, 'Arthur', 'Leonard', 'a');
INSERT INTO Regular VALUES (109, 6,105, 'Networking', 'Normal', 'Gold');
INSERT INTO Tasks VALUES (109, 6, 'Provisioning of resources', 0);
INSERT INTO Employees VALUES(110, 'Roman', 'Guerra', 'a');
INSERT INTO Regular VALUES (110, 6,105, 'QA', 'Silver', 'Gold');
INSERT INTO Tasks VALUES (110, 6, 'Assigning tasks to resources', 0);
INSERT INTO Employees VALUES(111, 'Miles', 'Schmitt', 'a');
INSERT INTO Regular VALUES (111, 6,105, 'Design', 'Premium', 'Gold');
INSERT INTO Tasks VALUES (111, 6, 'Provisioning of resources', 0);
INSERT INTO Contracts VALUES (7, 6, 89, '5149108628', 52175.991497366136, 1273.5270670944556, '2017-05-12', 'On-premises', 'Diamond', 'Research', 5);
INSERT INTO Deliverables VALUES (7, 1, '2017-05-22', null);
INSERT INTO Deliverables VALUES (7, 2, '2017-05-29', null);
INSERT INTO Deliverables VALUES (7, 3, '2017-06-07', null);
INSERT INTO Employees VALUES(112, 'Maya', 'Mosley', 'a');
INSERT INTO Manager VALUES (112, 7, 89);
INSERT INTO Employees VALUES(113, 'Allen', 'Floyd', 'a');
INSERT INTO Regular VALUES (113, 7,112, 'Development', 'Silver', 'Diamond');
INSERT INTO Tasks VALUES (113, 7, 'Allocating a dedicated point of contact', 0);
INSERT INTO Employees VALUES(114, 'Raelynn', 'Burch', 'a');
INSERT INTO Regular VALUES (114, 7,112, 'Design', 'Premium', 'Diamond');
INSERT INTO Tasks VALUES (114, 7, 'Assigning tasks to resources', 0);
INSERT INTO Employees VALUES(115, 'Paige', 'Grant', 'a');
INSERT INTO Regular VALUES (115, 7,112, 'Development', 'Silver', 'Diamond');
INSERT INTO Tasks VALUES (115, 7, 'Set up infrastructure for client', 0);
INSERT INTO Employees VALUES(116, 'Jamiya', 'Holland', 'a');
INSERT INTO Regular VALUES (116, 7,112, 'UI', 'Premium', 'Diamond');
INSERT INTO Tasks VALUES (116, 7, 'Set up infrastructure for client', 0);
INSERT INTO Employees VALUES(117, 'Carson', 'Solomon', 'a');
INSERT INTO Regular VALUES (117, 7,112, 'UI', 'Premium', 'Diamond');
INSERT INTO Tasks VALUES (117, 7, 'Assigning tasks to resources', 0);
INSERT INTO Employees VALUES(118, 'Quentin', 'Ellis', 'a');
INSERT INTO Regular VALUES (118, 7,112, 'Development', 'Premium', 'Diamond');
INSERT INTO Tasks VALUES (118, 7, 'Provisioning of resources', 0);
INSERT INTO Employees VALUES(119, 'Lilia', 'Bartlett', 'a');
INSERT INTO Regular VALUES (119, 7,112, 'BusinessIntelligence', 'Silver', 'Diamond');
INSERT INTO Tasks VALUES (119, 7, 'Assigning tasks to resources', 0);
INSERT INTO Employees VALUES(120, 'Maia', 'Stephens', 'a');
INSERT INTO Manager VALUES (120, 7, 89);
INSERT INTO Employees VALUES(121, 'Alma', 'Serrano', 'a');
INSERT INTO Regular VALUES (121, 7,120, 'UI', 'Premium', 'Diamond');
INSERT INTO Tasks VALUES (121, 7, 'Allocating a dedicated point of contact', 0);
INSERT INTO Employees VALUES(122, 'Willie', 'Chavez', 'a');
INSERT INTO Regular VALUES (122, 7,120, 'Development', 'Silver', 'Diamond');
INSERT INTO Tasks VALUES (122, 7, 'Provisioning of resources', 0);
INSERT INTO Employees VALUES(123, 'Antony', 'Kline', 'a');
INSERT INTO Regular VALUES (123, 7,120, 'Networking', 'Silver', 'Diamond');
INSERT INTO Tasks VALUES (123, 7, 'Allocating a dedicated point of contact', 0);
INSERT INTO Employees VALUES(124, 'Irene', 'Duncan', 'a');
INSERT INTO Regular VALUES (124, 7,120, 'BusinessIntelligence', 'Silver', 'Diamond');
INSERT INTO Tasks VALUES (124, 7, 'Provisioning of resources', 0);
INSERT INTO Employees VALUES(125, 'Maggie', 'Henry', 'a');
INSERT INTO Regular VALUES (125, 7,120, 'Development', 'Silver', 'Diamond');
INSERT INTO Tasks VALUES (125, 7, 'Assigning tasks to resources', 0);
INSERT INTO Employees VALUES(126, 'Gregory', 'Madden', 'a');
INSERT INTO Regular VALUES (126, 7,120, 'QA', 'Normal', 'Diamond');
INSERT INTO Tasks VALUES (126, 7, 'Set up infrastructure for client', 0);
INSERT INTO Employees VALUES(127, 'Danielle', 'Mcdowell', 'a');
INSERT INTO Regular VALUES (127, 7,120, 'Design', 'Premium', 'Diamond');
INSERT INTO Tasks VALUES (127, 7, 'Set up infrastructure for client', 0);
INSERT INTO Employees VALUES(128, 'Rayna', 'Montoya', 'a');
INSERT INTO Manager VALUES (128, 7, 89);
INSERT INTO Employees VALUES(129, 'Alissa', 'Douglas', 'a');
INSERT INTO Regular VALUES (129, 7,128, 'Networking', 'Normal', 'Diamond');
INSERT INTO Tasks VALUES (129, 7, 'Set up infrastructure for client', 0);
INSERT INTO Employees VALUES(130, 'Kamron', 'Doyle', 'a');
INSERT INTO Regular VALUES (130, 7,128, 'Design', 'Premium', 'Diamond');
INSERT INTO Tasks VALUES (130, 7, 'Provisioning of resources', 0);
INSERT INTO Employees VALUES(131, 'Evangeline', 'Leblanc', 'a');
INSERT INTO Regular VALUES (131, 7,128, 'Development', 'Silver', 'Diamond');
INSERT INTO Tasks VALUES (131, 7, 'Provisioning of resources', 0);
INSERT INTO Employees VALUES(132, 'Kelton', 'Cannon', 'a');
INSERT INTO Regular VALUES (132, 7,128, 'Design', 'Premium', 'Diamond');
INSERT INTO Tasks VALUES (132, 7, 'Provisioning of resources', 0);
INSERT INTO Employees VALUES(133, 'Trevin', 'Cantrell', 'a');
INSERT INTO Regular VALUES (133, 7,128, 'BusinessIntelligence', 'Premium', 'Diamond');
INSERT INTO Tasks VALUES (133, 7, 'Assigning tasks to resources', 0);