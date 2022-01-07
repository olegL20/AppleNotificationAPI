## Test Project

### 1. Task Description

The main goal of this project is to create  backend system, which provides an API for a mobile application and allow customers to be able to buy subscriptions via in-app purchases on their mobile devices. 
The system should be extendable, so in future it can be used with different payment system not only with Apple/Google Payments.
As example of system abilities, there was taken 4 events from apple subscription payment:

- Initial subscription [INITIAL_BUY]

- Renewed subscription [DID_RENEW]

- Unsuccessful renewal [DID_FAIL_TO_RENEW]

- Cancel subscription [CANCEL]

### 2. Task Solution
To solve this task was chosen Laravel Framework with Laravel Sanctum Library,
that help us to work with mobile apps and give permission to users via tokens.

As there is no requirements to identify user in this task for each Apple request we supposed
that we would have some middleware that help us to check receipt in request and find user by this receipt.

To make this Application flexible in extension I decided to use interfaces for main services that will help us solve the task.

First, we created a *DataMapperInterface* and bind to it AppleTransactionDataMapper to help us to map apple structure request to our base TransactionEntity structure.
After we map request to our structure, we run strategy, that resolve, which exact transaction type we are proceeding and then run operation processor depends on transaction type.
For each operation, I used own event action interface and make SubscriptionService implements it. Inside each operation we save transaction into DB and do actions with user permissions.
For writing transaction in a database I used repository pattern and split this repository on 2 main interface Read and Write. Read repository can be used for further needs but for now we're using only write to make transaction save in DB.

