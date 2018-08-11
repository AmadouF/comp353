ALTER TABLE Manager MODIFY contractId int;
ALTER TABLE Regular MODIFY contractId int;
UPDATE Manager set contractId = NULL  where contractId = 1;
UPDATE Regular set contractId = NULL  where contractId = 1;

delete from Tasks where contractId = 1;
delete from Contracts where contractId = 1;



