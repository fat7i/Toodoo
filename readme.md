# Toodoo 

Toodoo is a simple todo app that will help multiple users quickly collaborate on the same tasks.

Take a look at the [online mind map](https://www.mindmeister.com/1157278790?t=7mJpbCxVIR) for further information on 
the project functionality.

This repository provides only the RESTful API. 


### Create Todo List  

##### URL 

POST - `api.php/lists`

##### PAYLOAD

```
{
	"name": "Todo List Name", 
	"participants": [
		"participant1@example.org",
		"participant2@example.org",
		"participant3@example.org"
	]
}
```


### Delete Todo List 

##### URL 

DELETE - `api.php/lists/:list-id`

##### PAYLOAD

*None*


### Read Todo List Items

##### URL 

GET - `api.php/lists/:list-id/todos`

##### PAYLOAD

*None*

### Create Todo Item 
 
##### URL 

POST - `api.php/lists/:list-id/todos`

##### PAYLOAD

```
{
	"id": "5270138f-865b-4835-976e-6ff132ee3fab",
	"title": "Sample Todo Item",
	"completed": false
}
```
 
### Update Todo Item

##### URL 

PUT - `api.php/lists/:list-id/todos/:item-id`

##### PAYLOAD

```
{
	"id": "5270138f-865b-4835-976e-6ff132ee3fab",
	"title": "Sample Todo Item",
	"completed": false
}
```

### Mark Multiple Todo Items As Completed/Pending

PATCH - `api.php/lists/:list-id/todos`

##### PAYLOAD

```
{
	"completed": false
}
```

### Delete Todo Item 

DELETE - `api.php/lists/:list-id/todos/:item-id`

##### PAYLOAD

*None* 

### Delete Completed Todo Items 

DELETE - `api.php/lists/:list-id/todos?completed`

##### PAYLOAD

*None* 

# About the script

- I used a [Laravel](https://laravel.com) framework.
- Folder [toodoo](toodoo) is contain all files about this assignment.

## Instructions

- Run: `composer install` to download all packages.
- Edit config (DB, mail, ...) in `.env` file.
- Run `php artisan migrate` to create database tables.
- Run `php artisan serve` to run the development server <http://127.0.0.1:8000>.