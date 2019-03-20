Separates all database/business logic using the MVC pattern.
- database and validation are in a model folder
- html pages are in a views folder
- classes are in a classes folder

Routes all URLs and leverages a templating language using the Fat-Free framework.
- index uses fatfree to route to each html page

Has a clearly defined database layer using PDO and prepared statements.
- the database inserts posts and users
- the database returns posts and users

Data can be viewed, added, updated, and deleted.
- users can be inserted into the database
- new posts can be inserted into the databse

Has a history of commits from both team members to a Git repository.
- over 80 commits from both members

Uses OOP, and defines multiple classes, including at least one inheritance relationship.
- uses posts and user and database classes to use and store data

Contains full Docblocks for all PHP files.
- every class is defined with params and return values

Has full validation on the client side through JavaScript and server side through PHP.
- validates user signin and password

Incorporates jQuery and Ajax.
- automatically updates like button with jquery and ajax

BONUS:  Utilizes an API (Note:  If you do use an API, be sure to talk about it in your presentation.)
- No api used for this project