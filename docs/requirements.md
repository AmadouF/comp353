### Notes
- Authentication required to view application

### Sales Associate
1. Create [client](#client) account
    - Pre-populated lists of 
        - Provinces
        - Cities
1. Upon successful authentication/login/register, the sales associate should select the line of business of the [contracts](#contract) and the [type of contracts](#types) from a list of at least 5 lines of businesses and 10 [contracts](#contract) in the browser
1. Select from list of [managers](#manager) assigned to a [contract](#contract)
### Employee
  1. Select type of [contracts](#contract) wanted
  1. #### Insurance
      1. **Premium** Plan: Employees reimbursed 90% of their medical costs
      1. **Silver** Plan: Employees reimbursed 80% of their medical costs
      1. **Normal** Plan: Employees reimbursed 70% of their medical costs
### Manager
  1. Allocated [employees](#employee) to [contracts](#contract) based on [type of contract wanted](#types)
  1. Retreive hour report for an ([employee](#employee), Contract)
  1. Remove [employee](#employee) from [contract](#contract)
### Client
  1. See all active/expired [contracts](#contract)
  1. Provide satisfaction scores
  1. Check satisfaction scores of [contracts](#contract) managed by [manager](#manager) leading the [contract](#contract)
### Admin
  1. Update any details of the [contract](#contract)
  1. Remove / Alter any [contract](#contract) in the platform
    
## Contract
1. ### Types
    1. #### Premium (10 business days)
        1. First deliverable: 3 business days 
        1. Second deliverable: 5 business days
        1. Final deliverable: 10th day from start
    1. #### Diamond (18 business days)
        1. First deliverable: 6 business days 
        1. Second deliverable: 11 business days
        1. Final deliverable: 18th day from start
    1. #### Gold (20 business days)
        1. First deliverable: 8 business days 
        1. Second deliverable: 14 business days
        1. Final deliverable: 20th day from start
    1. #### Silver (28 business days)
        1. First deliverable: 5 business days 
        1. Second deliverable: 15 business days
        1. Third deliverable: 20th day from start
        1. Final deliverable: 28th day from start

## Reports
1. Number of employees with Premium [employee plan](#insurance) with working hours less than 60 hrs / month
1. Number of [Premium contracts](#types) delivered in more than 10 buisiness days having more than 35 employees with Silver [Employee Plan](#insurance)
1. Compare the delivery schedule of First Deliverable of all [type of contracts](#types) in each month of the year 2017

## UI
1. Give a list of [client](#clients) who have the highest number of contracts in each line of business
1. Give the details of the [contracts](#contracts) recorded within the last 10 days in all categories by [sales associate](#sales-associate)
1. Fetch all the details of the [employees](#employee) from the "Quebec" province
1. Give a list of all [contracts](#contracts) of the [gold type](#types)
1. Generate one reprot for each category that indicates the [clients](#client) whose [contracts](#contract) have the highest satisfaction scores in that category, grouped by the cities of [clients](#client)
