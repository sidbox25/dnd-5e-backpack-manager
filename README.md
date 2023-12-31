### todo

-btw use sql "transactions" on prod ("begin transaction")

- solve "Uncaught PDOException: could not find driver" in connector.php
- install/enable pdo_mysql in php.ini

- make jsonDecode output usable/ check what is gotten(for now )

- properly set up database and bot user (?is done? await further testing)
    - run script on startup(?is done? await further testing)

- adapt database script(?is done? await further testing)



=======
- add items by providing name, value quantity and 
- properly set up database and bot user
- make entityManager, entityReader, entityWriter 
- Stashed changes
- connect entity manager with main program
- adjust rest of program

- use javascript to update frontend and send signal to backend to update db
- have the current state internally stored in js
- load item database with data
- take into account weight


- make plan on how to add/remove items/containers/charters from the frontend(maybe a "+"/"-" button next to each item to add)
- add hp coutner


- load/get item database with complete values
- make FE look nicer with ?outlines? but chars side by side

- ?bag in bag? bag is a item
- make  a dataCompleter in the controller to add total wight and value to the vue data package

- refine DTO(data trasnfer objects)
- add a proper feedabck message to user
- add CC(carring capacity constraints)
- ?redo with mongo db?

### info
- https://github.com/5e-bits/5e-database/
- docker run -p 127.0.0.1:27017:27017/tcp ghcr.io/5e-bits/5e-database:latest

- phpmyadmin on 8080
- docker-compose kill db;docker-compose up --build -d db;docker-compose logs db

- use netlify to deploy(DO NOT DEPLOEY UNTILL SECIRUTY ISSUES HAVE BEEN FIXED, db and secrets)












