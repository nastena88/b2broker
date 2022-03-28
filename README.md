# Test task for B2Broker

Implemented general structure for finance system. Some methods are abstract (e.g. for database operations) as it was not asked to work with database.
Also I didn't use any libraries, but I would definitly use Money class for all operations (it is better to work with decimal numbers than float), 
I would also be happy to add logging to all methods.

In real life this system would definitely work asynchronously with several retries.

I also created abstract lock class, which is need to prevent using one account by different processes at the same time.
