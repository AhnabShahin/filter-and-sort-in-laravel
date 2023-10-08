# Filter and Sort in Laravel
Here we are going to use **Laravel purity** PHP package for filtering  and sorting. To see the package repo [Click Here](https://github.com/abbasudo/laravel-purity)
If we use this, it create a common query pattern for frontend developer so that they can easily execute filtering and sorting in server end using Query params. So that development becomes easier ans faster. 
## Table of Contents
- [Filter and Sort in Laravel](#filter-and-sort-in-laravel)
  - [Table of Contents](#table-of-contents)
    - [How To Use](#how-to-use)
      - [Laravel Setup](#laravel-setup)
      - [Laravel Purity Installation](#laravel-purity-installation)
        - [Filter](#filter)
        - [Sort](#sort)
      - [Frontend setup](#frontend-setup)
        - [Filter](#filter-1)
        - [Sort](#sort-1)
    - [Advance usage](#advance-usage)
    - [Available Oparation for Filtering](#available-oparation-for-filtering)
### How To Use

#### Laravel Setup
Create laravel application using.
`composer create-project laravel/laravel test-filter-and-sort-app`

Make Migrations, Model and controller for User and Post table by running those commends..
`php artisan make:model User -mc`
`php artisan make:model Post -mc`

Demo codes are given in link.
- User 
  - [Model](Models/User.php)
  - [Migration](migrations/01_create_users_table.php)
- Post 
  - [Model](Models/Post.php)
  - [Migration](migrations/02_create_posts_table.php)
- Routes 
  - [api](routes/api.php)
  
`php artisan migrate`
`php artisan serve`

- [Inserted User along with a Post](http://127.0.0.1:8000/api/save)
- [Get All Users](http://127.0.0.1:8000/api/users)
#### Laravel Purity Installation
need to run those commend in laravel application dir.
`
composer require abbasudo/laravel-purity
`
`
php artisan vendor:publish --tag=purity
`

Those commend will instal pakckage in vendor folder and published config file `(configs/purity.php)` where we can customize package’s behavior.
##### Filter
Just only need to add `Filterable` trait to your model to get filters functionalities.
```
use Abbasudo\Purity\Traits\Filterable;

class User extends Model
{
    use Filterable;
}
```
Now add `filter()` to your model eloquent query in the controller.
[`Post::filter()->get();`](routes/api.php)

**Request**
Formet `?filters[field][operator]=value`
 Example [`?filters[name][$in]=Shahin`](http://127.0.0.1:8000/get?filters[name][$in]=Shahin)
##### Sort
Just only need to add `Sortable` trait to your model to get filters functionalities.
```
use Abbasudo\Purity\Traits\Filterable;

class User extends Model
{
    use Sortable;
}
```
Now add `sort()` to your model eloquent query in the controller.
[`Post::sort()->get();`](routes/api.php)

**Request**
Formet `?sort=value:type`
Example [`?sort=created_at`](http://127.0.0.1:8000/get?sort=created_at)  **NB - By default its ascending.**
Example [`?sort=created_at:desc`](http://127.0.0.1:8000/get?sort=created_at:desc)

#### Frontend setup 
This laravel Purity pacakage is compatible with the popular [JavaScript Package QS](https://github.com/ljharb/qs)
Using this frontend developers can effortlessly generate APIs query params for filtering and sorting..
Commend : ```npm i qs```
##### Filter 
```
const qs = require('qs');
const query = qs.stringify({
    filters: {
    name: {
        $in: 'Shahin',
    },
  },
}, {
  encodeValuesOnly: true, // prettify URL
});

console.log(query) 
// result = ?filters[name][$in]=Shahin

await request(`/api/users?${query}`);
```
##### Sort 
```
const qs = require('qs');
const query = qs.stringify({
     sort:'created_at:desc'
}, {
  encodeValuesOnly: true, // prettify URL
});

console.log(query) 
// result = ?sort=created_at:desc

await request(`/api/users?${query}`);
```







### Advance usage
- [Silent Exceptions]()
- [Custom Filters]()
- [Restrict Filters]()
- [Complex Filtering]()
- [Deep Filtering]()
- [Multiple Sorting]()
### Available Oparation for Filtering
<table> <thead> <tr> <th>Operator</th> <th>Description</th> </tr> </thead> <tbody> <tr> <td><code >$eq</code></td> <td>Equal</td> </tr> <tr> <td><code >$eqc</code></td> <td>Equal (case-sensitive)</td> </tr> <tr> <td><code >$ne</code></td> <td>Not equal</td> </tr> <tr> <td><code >$lt</code></td> <td>Less than</td> </tr> <tr> <td><code >$lte</code></td> <td>Less than or equal to</td> </tr> <tr> <td><code >$gt</code></td> <td>Greater than</td> </tr> <tr> <td><code >$gte</code></td> <td>Greater than or equal to</td> </tr> <tr> <td><code >$in</code></td> <td>Included in an array</td> </tr> <tr> <td><code >$notIn</code></td> <td>Not included in an array</td> </tr> <tr> <td><code >$contains</code></td> <td>Contains</td> </tr> <tr> <td><code >$notContains</code></td> <td>Does not contain</td> </tr> <tr> <td><code >$containsc</code></td> <td>Contains (case-sensitive)</td> </tr> <tr> <td><code >$notContainsc</code></td> <td>Does not contain (case-sensitive)</td> </tr> <tr> <td><code >$null</code></td> <td>Is null</td> </tr> <tr> <td><code >$notNull</code></td> <td>Is not null</td> </tr> <tr> <td><code >$between</code></td> <td>Is between</td> </tr> <tr> <td><code >$startsWith</code></td> <td>Starts with</td> </tr> <tr> <td><code >$startsWithc</code></td> <td>Starts with (case-sensitive)</td> </tr> <tr> <td><code >$endsWith</code></td> <td>Ends with</td> </tr> <tr> <td><code >$endsWithc</code></td> <td>Ends with (case-sensitive)</td> </tr> <tr> <td><code >$or</code></td> <td>Joins the filters in an “or” expression</td> </tr> <tr> <td><code >$and</code></td> <td>Joins the filters in an “and” expression</td> </tr> </tbody> </table>