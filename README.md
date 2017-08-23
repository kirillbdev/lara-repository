# lara-repository

Паттерн репозитория для работы с Eloquent ORM фреймворка Laravel.

## Требования

* php >= 5.6.4
* laravel framework - 5.4

## Установка

1. Используя composer пропишите команду:

`composer require kirillbdev/lara-repository:0.*`

2. В файде config/app.php в массиве провайдеров пропишите:

`\Kirillbdev\LaraRepository\Providers\RepositoryServiceProvider::class`

## Использование

1. Создайте модель, например `Book`.
2. Создайте свой класс `BookRepository`, наследуемый от `Kirillbdev\LaraRepository\Repository`.
3. Обязательно определите модель, которую будет использовать ваш репозиторий в переменной `$model`, например:

    `protected $model = 'App\Book';`
    
4. Используйте ваш репозиторий в контроллерах.

## Структура

Структура работы с репозиторием:

```
$repo = new Имя_вашего_репозитория();
$filter = new Filter();
$data = $repo->Метод_репозитория([$filter->Метод_фильтрации_данных()], [Дополнительные_переменные]);
```

где в квадратных скобках [] указаны необязательные параметры.

## Доступные методы класса Repository

* get(Filter $filter = null, $columns = ['*'])
* create($attributes = [])
* update(Filter $filter, array $attributes = [], array $options = [])
* delete(Filter $filter)
* transaction($callback)

## Доступные методы класса Filter

* where
* orWhere
* with
* orderBy
* take
* has
* whereHas
* first

Параметры методов выше являются стандартными для Eloquent Model.

* findById($id)
* last($orderColumn = 'id')

Порядок вызова методов фильтрации неважен. Вы также можете комбинировать методы фильтрации, вызывая их поочередно, испольщуя ->

```
$data = $repository->get(
            $filter->where('price', '>', '100')
                   ->first()
                   ->with('author')
            );
```

