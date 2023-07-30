<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>


# Expenses Tracker

- The application allows users to add, edit, and delete their expenses and income as needed, making it easy to manage their finances in one place.
- The application also provides users with a clear view of their financial transactions, displaying a summary of their income and expenses for each month and year.
- This feature allows users to quickly evaluate their financial performance and make informed decisions about their spending habits.

I've used:
- Laravel 10
- Sanctum
- DTO & Service Layer:
I utilized the Data Transfer Object (DTO) pattern in my implementation, helped me to separate my model from the controller layer and allowed me to pass data between my application's various components in a structured format.
Additionally, I implemented a Service Layer to encapsulate the business logic, which further enhanced the application's scalability and maintainability.


## Categories


## GET: index

GET /api/v1/categories

### Params
|Name|Location|Type|Required|Description|
|---|---|---|---|---|
|items_per_page|query|string| no |Cutomize results for pagination|

## POST: store

POST /api/v1/categories

### Params

|Name|Location|Type|Required|Description|
|---|---|---|---|---|
|name|body|string| yes|none|
|description|body|string| yes|none|
|type|body|string| yes |income , expense|

## GET: show

GET /api/v1/categories/{id}

### Params

|Name|Location|Type|Required|Description|
|---|---|---|---|---|
|id|path|string| yes |none|

## GET: show

GET /api/v1/categories/{id}

### Params

|Name|Location|Type|Required|Description|
|---|---|---|---|---|
|id|path|string| yes |none|

## POST: update

POST /api/v1/categories/{id}

### Body Parameters

|Name|Location|Type|Required|Description|
|---|---|---|---|---|
|id|path|string| yes |none|
|name|body|string| no |none|
|description|body|string| no |none|
|type|body|string| no |income , expense|
|_method|body|string| no |PUT|

## DELETE destroy

DELETE /api/v1/categories/{id}

|Name|Location|Type|Required|Description|
|---|---|---|---|---|
|id|path|string| yes |none|


## Transactions


## GET: index

GET /api/v1/transactions

### Params
|Name|Location|Type|Required|Description|
|---|---|---|---|---|
|items_per_page|query|string| no |none|

## POST: store

POST /api/v1/transactions

### Body Parameters

|Name|Location|Type|Required|Description|
|---|---|---|---|---|
|amount|body|string| yes |none|
|description|body|string| yes |none|
|category_id|body|string| yes|none|
|date|body|date| yes|format: Y-m-d|

## GET: show

GET /api/v1/transactions/{id}

### Params

|Name|Location|Type|Required|Description|
|---|---|---|---|---|
|id|path|string| yes |none|

## GET: show

GET /api/v1/transactions/{id}

### Params

|Name|Location|Type|Required|Description|
|---|---|---|---|---|
|id|path|string| yes |none|

## POST: update

POST /api/v1/transactions/{id}

### Body Parameters

|Name|Location|Type|Required|Description|
|---|---|---|---|---|
|id|path|string| yes |none|
|amount|body|string| no |none|
|description|body|string| no |none|
|category_id|body|string| no |none|
|date|body|date| yes |format: Y-m-d|
|_method|body|string| no |PUT|

## DELETE destroy

DELETE /api/v1/transactions/{id}

|Name|Location|Type|Required|Description|
|---|---|---|---|---|
|id|path|string| yes |none|

## GET statistics

GET /api/v1/transactions/statistics

### Params

|Name|Location|Type|Required|Description|
|---|---|---|---|---|
|items_per_page|query|string| no |none|

## About Me

Iam a Junior Backend Developer with one year of experience, I specialize in PHP, Laravel, and front-end technologies like TailwindCSS and Livewire. I have expertise in developing REST APIs and working with MySQL databases, and I am familiar with software architecture patterns such as MVC and HMVC. I am committed to producing clean, well-documented code that is easily maintainable, and I enjoy sharing my knowledge through various channels. I am eager to take on new challenges and continue to develop my skills.

- [LinkedIn](https://www.linkedin.com/in/elgammal/).
- [Youtube](https://www.youtube.com/@yasser.elgammal).
- [Dev_to](https://dev.to/yasserelgammal).

