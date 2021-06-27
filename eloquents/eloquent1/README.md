notes:
	- App\Models\Profile::truncate()
		- will drop all rows in the table
	- ->refresh();
		- you  can use it tinker while creating a row 
	-


# Relation -- One to One
- hasOne - belongsTo
- Ex: Student - Info
	- Every Student hasOne Info
	- Every Info belongsTo One Student
	- students table
		- id [Local/Parent_Key]
		- name
	- Info
		- student_id [Foreign_key]
		- city
		- class
		- section
		- age
	- Student
		- info() hasOne(Class, 'Foreign_key', 'Local_key)
	- Info
    	- student() belongsTo(Class, 'Foreign_key', 'Parent_Key']

Tinker for relation One to One
```php
❯ php artisan tinker
Psy Shell v0.10.8 (PHP 7.4.3 — cli) by Justin Hileman
>>> App\Models\Student::create(['name'=>'stella']);
=> App\Models\Student {#4179
     name: "stella",
     updated_at: "2021-06-26 00:38:47",
     created_at: "2021-06-26 00:38:47",
     id: 1,
   }
>>> App\Models\Student::create(['name'=>'elle']);
=> App\Models\Student {#4324
     name: "elle",
     updated_at: "2021-06-26 00:38:55",
     created_at: "2021-06-26 00:38:55",
     id: 2,
   }
>>> App\Models\Student::all()
=> Illuminate\Database\Eloquent\Collection {#4323
     all: [
       App\Models\Student {#4321
         id: "1",
         name: "stella",
         created_at: "2021-06-26 00:38:47",
         updated_at: "2021-06-26 00:38:47",
       },
       App\Models\Student {#4074
         id: "2",
         name: "elle",
         created_at: "2021-06-26 00:38:55",
         updated_at: "2021-06-26 00:38:55",
       },
     ],
   }
>>> App\Models\Student::first()
=> App\Models\Student {#3706
     id: "1",
     name: "stella",
     created_at: "2021-06-26 00:38:47",
     updated_at: "2021-06-26 00:38:47",
   }
>>> App\Models\Student::first()->info
=> null
>>> App\Models\Student::first()->info()->create(['city'=>'chennai', 'class'=>12, 'section'=>'a', 'age'=>17])
=> App\Models\Info {#4179
     city: "chennai",
     class: 12,
     section: "a",
     age: 17,
     student_id: 1,
     updated_at: "2021-06-26 00:40:48",
     created_at: "2021-06-26 00:40:48",
     id: 1,
   }
>>> App\Models\Student::first()->info
=> App\Models\Info {#4113
     id: "1",
     student_id: "1",
     city: "chennai",
     class: "12",
     section: "a",
     age: "17",
     created_at: "2021-06-26 00:40:48",
     updated_at: "2021-06-26 00:40:48",
   }
>>> App\Models\Student::all()
=> Illuminate\Database\Eloquent\Collection {#4335
     all: [
       App\Models\Student {#3380
         id: "1",
         name: "stella",
         created_at: "2021-06-26 00:38:47",
         updated_at: "2021-06-26 00:38:47",
       },
       App\Models\Student {#4269
         id: "2",
         name: "elle",
         created_at: "2021-06-26 00:38:55",
         updated_at: "2021-06-26 00:38:55",
       },
     ],
   }
>>> App\Models\Student::find(2)->info()->create(['city'=>'chennai', 'class'=>12, 'section'=>'a', 'age'=>17])
=> App\Models\Info {#4329
     city: "chennai",
     class: 12,
     section: "a",
     age: 17,
     student_id: 2,
     updated_at: "2021-06-26 00:41:43",
     created_at: "2021-06-26 00:41:43",
     id: 2,
   }
>>> App\Models\Info::all()
=> Illuminate\Database\Eloquent\Collection {#3706
     all: [
       App\Models\Info {#4325
         id: "1",
         student_id: "1",
         city: "chennai",
         class: "12",
         section: "a",
         age: "17",
         created_at: "2021-06-26 00:40:48",
         updated_at: "2021-06-26 00:40:48",
       },
       App\Models\Info {#4331
         id: "2",
         student_id: "2",
         city: "chennai",
         class: "12",
         section: "a",
         age: "17",
         created_at: "2021-06-26 00:41:43",
         updated_at: "2021-06-26 00:41:43",
       },
     ],
   }
>>> App\Models\Info::find(2)->student
=> App\Models\Student {#4177
     id: "2",
     name: "elle",
     created_at: "2021-06-26 00:38:55",
     updated_at: "2021-06-26 00:38:55",
   }
```
# Relation One to Many
A one-to-many relationship is used to define relationships where a single model is the parent to one or more child models
- Student can have many Homeworks but a Homework belongsTo only-One Student

- Student is the parent and Homework is the child
	
- Student hasMany Homeworks
- Homework belongsTo Student

- students
	- id [Local/Parent_Key]
	- name
- homeworks
	- student_id [Foreign_key]
	- title
	
- Student-model
	- homeworks() hasMany(Class, 'Foreign_key', 'Local_key')
- Homework-model
	- belongsTo(Class, 'Foreign_key', 'Parent_key')

## Default for Homework
to set a default model if none available..
available for [belongsTo, hasOne, hasOneThrough, and morphOne]
```php
$this->belongsTo(Student::class, 'student_id', 'id' ->withDefault(['name' => 'unknown_student']);
```
relation2 tinker
```php
❯ php artisan tinker
Psy Shell v0.10.8 (PHP 7.4.3 — cli) by Justin Hileman
>>> App\Models\Student::all()
=> Illuminate\Database\Eloquent\Collection {#4179
     all: [],
   }
>>> App\Models\Student::create(['name'=>'stella maxwell'])
=> App\Models\Student {#3390
     name: "stella maxwell",
     updated_at: "2021-06-26 01:30:06",
     created_at: "2021-06-26 01:30:06",
     id: 1,
   }
>>> App\Models\Student::create(['name'=>'bella hadid'])
=> App\Models\Student {#4179
     name: "bella hadid",
     updated_at: "2021-06-26 01:30:21",
     created_at: "2021-06-26 01:30:21",
     id: 2,
   }
>>> App\Models\Student::find(1)
=> App\Models\Student {#4113
     id: "1",
     name: "stella maxwell",
     created_at: "2021-06-26 01:30:06",
     updated_at: "2021-06-26 01:30:06",
   }
>>> App\Models\Student::find(1)->homeworks
=> Illuminate\Database\Eloquent\Collection {#4325
     all: [],
   }
>>> App\Models\Student::find(1)->homeworks()->create(['title'=>'algebra1'])
=> App\Models\Homework {#4324
     title: "algebra1",
     student_id: 1,
     updated_at: "2021-06-26 01:31:05",
     created_at: "2021-06-26 01:31:05",
     id: 1,
   }
>>> App\Models\Student::find(1)->homeworks()->create(['title'=>'photosynthesis'])
=> App\Models\Homework {#4268
     title: "photosynthesis",
     student_id: 1,
     updated_at: "2021-06-26 01:31:21",
     created_at: "2021-06-26 01:31:21",
     id: 2,
   }
>>> App\Models\Student::find(1)->homeworks()->create(['title'=>'biology lesson1'])
=> App\Models\Homework {#4326
     title: "biology lesson1",
     student_id: 1,
     updated_at: "2021-06-26 01:31:39",
     created_at: "2021-06-26 01:31:39",
     id: 3,
   }
>>> App\Models\Student::find(2)->homeworks()->create(['title'=>'biology lesson2'])
=> App\Models\Homework {#4327
     title: "biology lesson2",
     student_id: 2,
     updated_at: "2021-06-26 01:31:52",
     created_at: "2021-06-26 01:31:52",
     id: 4,
   }
>>> App\Models\Student::find(2)->homeworks()->create(['title'=>'chemistry lesson2'])
=> App\Models\Homework {#4325
     title: "chemistry lesson2",
     student_id: 2,
     updated_at: "2021-06-26 01:32:00",
     created_at: "2021-06-26 01:32:00",
     id: 5,
   }
>>> App\Models\Student::find(2)->homeworks
=> Illuminate\Database\Eloquent\Collection {#4268
     all: [
       App\Models\Homework {#4267
         id: "4",
         student_id: "2",
         title: "biology lesson2",
         created_at: "2021-06-26 01:31:52",
         updated_at: "2021-06-26 01:31:52",
       },
       App\Models\Homework {#4338
         id: "5",
         student_id: "2",
         title: "chemistry lesson2",
         created_at: "2021-06-26 01:32:00",
         updated_at: "2021-06-26 01:32:00",
       },
     ],
   }
>>> App\Models\Student::find(1)->homeworks
=> Illuminate\Database\Eloquent\Collection {#4339
     all: [
       App\Models\Homework {#4342
         id: "1",
         student_id: "1",
         title: "algebra1",
         created_at: "2021-06-26 01:31:05",
         updated_at: "2021-06-26 01:31:05",
       },
       App\Models\Homework {#4343
         id: "2",
         student_id: "1",
         title: "photosynthesis",
         created_at: "2021-06-26 01:31:21",
         updated_at: "2021-06-26 01:31:21",
       },
       App\Models\Homework {#4344
         id: "3",
         student_id: "1",
         title: "biology lesson1",
         created_at: "2021-06-26 01:31:39",
         updated_at: "2021-06-26 01:31:39",
       },
     ],
   }
>>> App\Models\Homework::all()
=> Illuminate\Database\Eloquent\Collection {#4334
     all: [
       App\Models\Homework {#4335
         id: "1",
         student_id: "1",
         title: "algebra1",
         created_at: "2021-06-26 01:31:05",
         updated_at: "2021-06-26 01:31:05",
       },
       App\Models\Homework {#4345
         id: "2",
         student_id: "1",
         title: "photosynthesis",
         created_at: "2021-06-26 01:31:21",
         updated_at: "2021-06-26 01:31:21",
       },
       App\Models\Homework {#4346
         id: "3",
         student_id: "1",
         title: "biology lesson1",
         created_at: "2021-06-26 01:31:39",
         updated_at: "2021-06-26 01:31:39",
       },
       App\Models\Homework {#4347
         id: "4",
         student_id: "2",
         title: "biology lesson2",
         created_at: "2021-06-26 01:31:52",
         updated_at: "2021-06-26 01:31:52",
       },
       App\Models\Homework {#4348
         id: "5",
         student_id: "2",
         title: "chemistry lesson2",
         created_at: "2021-06-26 01:32:00",
         updated_at: "2021-06-26 01:32:00",
       },
     ],
   }
>>> App\Models\Homework::find(1)
=> App\Models\Homework {#4342
     id: "1",
     student_id: "1",
     title: "algebra1",
     created_at: "2021-06-26 01:31:05",
     updated_at: "2021-06-26 01:31:05",
   }
>>> App\Models\Homework::find(1)->student
=> App\Models\Student {#4269
     id: "1",
     name: "stella maxwell",
     created_at: "2021-06-26 01:30:06",
     updated_at: "2021-06-26 01:30:06",
   }
>>> App\Models\Homework::find(2)->student
=> App\Models\Student {#4326
     id: "1",
     name: "stella maxwell",
     created_at: "2021-06-26 01:30:06",
     updated_at: "2021-06-26 01:30:06",
   }
>>> App\Models\Homework::find(5)->student
=> App\Models\Student {#4343
     id: "2",
     name: "bella hadid",
     created_at: "2021-06-26 01:30:21",
     updated_at: "2021-06-26 01:30:21",
   }
>>> App\Models\Homework::create(['title'=>'english1'])
=> App\Models\Homework {#4326
     title: "english1",
     updated_at: "2021-06-26 01:34:14",
     created_at: "2021-06-26 01:34:14",
     id: 6,
   }
>>> App\Models\Homework::all()
=> Illuminate\Database\Eloquent\Collection {#4350
     all: [
       App\Models\Homework {#4351
         id: "1",
         student_id: "1",
         title: "algebra1",
         created_at: "2021-06-26 01:31:05",
         updated_at: "2021-06-26 01:31:05",
       },
       App\Models\Homework {#4352
         id: "2",
         student_id: "1",
         title: "photosynthesis",
         created_at: "2021-06-26 01:31:21",
         updated_at: "2021-06-26 01:31:21",
       },
       App\Models\Homework {#4353
         id: "3",
         student_id: "1",
         title: "biology lesson1",
         created_at: "2021-06-26 01:31:39",
         updated_at: "2021-06-26 01:31:39",
       },
       App\Models\Homework {#4354
         id: "4",
         student_id: "2",
         title: "biology lesson2",
         created_at: "2021-06-26 01:31:52",
         updated_at: "2021-06-26 01:31:52",
       },
       App\Models\Homework {#4355
         id: "5",
         student_id: "2",
         title: "chemistry lesson2",
         created_at: "2021-06-26 01:32:00",
         updated_at: "2021-06-26 01:32:00",
       },
       App\Models\Homework {#4356
         id: "6",
         student_id: null,
         title: "english1",
         created_at: "2021-06-26 01:34:14",
         updated_at: "2021-06-26 01:34:14",
       },
     ],
   }
>>> App\Models\Homework::find(6)
=> App\Models\Homework {#4326
     id: "6",
     student_id: null,
     title: "english1",
     created_at: "2021-06-26 01:34:14",
     updated_at: "2021-06-26 01:34:14",
   }
>>> App\Models\Homework::find(6)->student
=> App\Models\Student {#4351
     name: "unknown_student",
   }
>>> App\Models\Student::find(1)
=> App\Models\Student {#4355
     id: "1",
     name: "stella maxwell",
     created_at: "2021-06-26 01:30:06",
     updated_at: "2021-06-26 01:30:06",
   }
>>> App\Models\Student::find(1)->homeworks
=> Illuminate\Database\Eloquent\Collection {#4336
     all: [
       App\Models\Homework {#4269
         id: "1",
         student_id: "1",
         title: "algebra1",
         created_at: "2021-06-26 01:31:05",
         updated_at: "2021-06-26 01:31:05",
       },
       App\Models\Homework {#4327
         id: "2",
         student_id: "1",
         title: "photosynthesis",
         created_at: "2021-06-26 01:31:21",
         updated_at: "2021-06-26 01:31:21",
       },
       App\Models\Homework {#4357
         id: "3",
         student_id: "1",
         title: "biology lesson1",
         created_at: "2021-06-26 01:31:39",
         updated_at: "2021-06-26 01:31:39",
       },
     ],
   }
```

# Has One Through

- mechanic->car->owner

- mechanics
    - id - integer
    - name - string

- cars
    - id - integer
    - model - string
    - mechanic_id - integer

- owners
    - id - integer
    - name - string
    - car_id - integer
	
- Mechanic-model
```php
public function carOwner(){
        return $this->hasOneThrough(Owner::class, Car::class);
    }
```

tinkers
```php
❯ php artisan tinker
Psy Shell v0.10.8 (PHP 7.4.3 — cli) by Justin Hileman
>>> App\Models\Mechanic::all()
=> Illuminate\Database\Eloquent\Collection {#4179
     all: [],
   }
>>> App\Models\Mechanic::create(['name'=>'alex']);
=> App\Models\Mechanic {#4268
     name: "alex",
     updated_at: "2021-06-26 07:35:43",
     created_at: "2021-06-26 07:35:43",
     id: 1,
   }
>>> App\Models\Mechanic::create(['name'=>'evan']);
=> App\Models\Mechanic {#3390
     name: "evan",
     updated_at: "2021-06-26 07:35:50",
     created_at: "2021-06-26 07:35:50",
     id: 2,
   }
>>> App\Models\Mechanic::all()
=> Illuminate\Database\Eloquent\Collection {#4074
     all: [
       App\Models\Mechanic {#3706
         id: "1",
         name: "alex",
         created_at: "2021-06-26 07:35:43",
         updated_at: "2021-06-26 07:35:43",
       },
       App\Models\Mechanic {#4113
         id: "2",
         name: "evan",
         created_at: "2021-06-26 07:35:50",
         updated_at: "2021-06-26 07:35:50",
       },
     ],
   }
>>> App\Models\Mechanic::first()
=> App\Models\Mechanic {#3386
     id: "1",
     name: "alex",
     created_at: "2021-06-26 07:35:43",
     updated_at: "2021-06-26 07:35:43",
   }
>>> App\Models\Mechanic::first()->carOwner
=> null
>>> App\Models\Car::all()
=> Illuminate\Database\Eloquent\Collection {#3386
     all: [],
   }
>>> new App\Models\Car()
=> App\Models\Car {#3390}
>>> $car1 = new App\Models\Car()
=> App\Models\Car {#4111}
>>> $car1->mechanic_id = 1
=> 1
>>> $car1->model = 'volvo'
=> "volvo"
>>> $car1->save()
=> true
>>> $car1 = new App\Models\Car()
=> App\Models\Car {#3386}
>>> $car1->mechanic_id = 2
=> 2
>>> $car1->model = 'maruti'
=> "maruti"
>>> $car1->save()
=> true
>>> App\Models\Car::all()
=> Illuminate\Database\Eloquent\Collection {#4326
     all: [
       App\Models\Car {#4179
         id: "1",
         model: "volvo",
         mechanic_id: "1",
         created_at: "2021-06-26 07:42:08",
         updated_at: "2021-06-26 07:42:08",
       },
       App\Models\Car {#4112
         id: "2",
         model: "maruti",
         mechanic_id: "2",
         created_at: "2021-06-26 07:42:36",
         updated_at: "2021-06-26 07:42:36",
       },
     ],
   }
>>> App\Models\Mechanic::first()->car
=> null
>>> App\Models\Owner::all()
=> Illuminate\Database\Eloquent\Collection {#4269
     all: [],
   }
>>> $owner1 = new App\Models\Owner()
=> App\Models\Owner {#4328}
>>> $owner1->car_id = 1
=> 1
>>> $owner1->name = 'stella'
=> "stella"
>>> $owner1->save()
=> true
>>> $owner1 = new App\Models\Owner()
=> App\Models\Owner {#4326}
>>> $owner1->car_id = 2
=> 2
>>> $owner1->name = 'maxwell'
=> "maxwell"
>>> $owner1->save()
=> true
>>> App\Models\Mechanic::all()
=> Illuminate\Database\Eloquent\Collection {#4323
     all: [
       App\Models\Mechanic {#4333
         id: "1",
         name: "alex",
         created_at: "2021-06-26 07:35:43",
         updated_at: "2021-06-26 07:35:43",
       },
       App\Models\Mechanic {#4331
         id: "2",
         name: "evan",
         created_at: "2021-06-26 07:35:50",
         updated_at: "2021-06-26 07:35:50",
       },
     ],
   }
>>> App\Models\Mechanic::find(1)->carOwner
=> App\Models\Owner {#4344
     id: "1",
     name: "stella",
     car_id: "1",
     created_at: "2021-06-26 07:45:59",
     updated_at: "2021-06-26 07:45:59",
     laravel_through_key: "1",
   }
>>> App\Models\Mechanic::find(2)->carOwner
=> App\Models\Owner {#4339
     id: "2",
     name: "maxwell",
     car_id: "2",
     created_at: "2021-06-26 07:46:20",
     updated_at: "2021-06-26 07:46:20",
     laravel_through_key: "2",
   }
```

# hasManyThrough

Relation:
- Contributor hasMany Projects
- Each Project belongsTo a Contributor
- Project hasMany Tasks
- Each Task belongsTo a Project
- Contributor hasMany Tasks Through Project

table-Columns:
- Contributor
	- id
	- name 

- Project
	- contributor_id
	- name

- Task
	- project_id
	- name
	

Models
- Contributor
```php
    public function projects()
    {
        return $this->hasMany(Project::class);
    }

    public function tasks()
    {
        return $this->hasManyThrough(Task::class, Project::class);
    }
```

- Project
```php
    public function contributor()
    {
        return $this->belongsTo(Contributor::class);
    }
    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
```

- Task
```php
    public function project()
    {
        return $this->belongsTo(Project::class);
    }
```

tinkers
```php
❯ php artisan tinker
Psy Shell v0.10.8 (PHP 7.4.3 — cli) by Justin Hileman
>>> App\Models\Contributor::create(['name'=>'Alexa'])
=> App\Models\Contributor {#4267
     name: "Alexa",
     updated_at: "2021-06-27 01:21:14",
     created_at: "2021-06-27 01:21:14",
     id: 1,
   }
>>> App\Models\Contributor::find(1)
=> App\Models\Contributor {#4321
     id: "1",
     name: "Alexa",
     created_at: "2021-06-27 01:21:14",
     updated_at: "2021-06-27 01:21:14",
   }
>>> App\Models\Contributor::find(1)->projects
=> Illuminate\Database\Eloquent\Collection {#4178
     all: [],
   }
>>> App\Models\Contributor::find(1)->projects()->create(['name'=>'Typography1'])
=> App\Models\Project {#4323
     name: "Typography1",
     contributor_id: 1,
     updated_at: "2021-06-27 01:22:19",
     created_at: "2021-06-27 01:22:19",
     id: 1,
   }
>>> App\Models\Contributor::find(1)->projects()->create(['name'=>'History1'])
=> App\Models\Project {#4322
     name: "History1",
     contributor_id: 1,
     updated_at: "2021-06-27 01:24:28",
     created_at: "2021-06-27 01:24:28",
     id: 2,
   }
>>> App\Models\Contributor::find(1)->projects
=> Illuminate\Database\Eloquent\Collection {#4325
     all: [
       App\Models\Project {#4321
         id: "1",
         name: "Typography1",
         contributor_id: "1",
         created_at: "2021-06-27 01:22:19",
         updated_at: "2021-06-27 01:22:19",
       },
       App\Models\Project {#4330
         id: "2",
         name: "History1",
         contributor_id: "1",
         created_at: "2021-06-27 01:24:28",
         updated_at: "2021-06-27 01:24:28",
       },
     ],
   }
>>> App\Models\Contributor::find(1)->projects->find(1)
=> App\Models\Project {#4323
     id: "1",
     name: "Typography1",
     contributor_id: "1",
     created_at: "2021-06-27 01:22:19",
     updated_at: "2021-06-27 01:22:19",
   }
>>> App\Models\Contributor::find(1)->projects->find(1)->task
=> null
>>> App\Models\Contributor::find(1)->projects->find(1)->tasks
=> Illuminate\Database\Eloquent\Collection {#4330
     all: [],
   }
>>> App\Models\Contributor::find(1)->projects->find(1)->tasks()->create(['name'=>'lesson1'])
=> App\Models\Task {#4345
     name: "lesson1",
     project_id: 1,
     updated_at: "2021-06-27 01:25:33",
     created_at: "2021-06-27 01:25:33",
     id: 1,
   }
>>> App\Models\Contributor::find(1)->projects->find(1)->tasks()->create(['name'=>'lesson2'])
=> App\Models\Task {#4348
     name: "lesson2",
     project_id: 1,
     updated_at: "2021-06-27 01:25:38",
     created_at: "2021-06-27 01:25:38",
     id: 2,
   }
>>> App\Models\Contributor::find(1)->projects->find(1)->tasks()->create(['name'=>'lesson3'])
=> App\Models\Task {#4351
     name: "lesson3",
     project_id: 1,
     updated_at: "2021-06-27 01:25:42",
     created_at: "2021-06-27 01:25:42",
     id: 3,
   }
>>> App\Models\Contributor::find(1)->projects->find(2)
=> App\Models\Project {#4326
     id: "2",
     name: "History1",
     contributor_id: "1",
     created_at: "2021-06-27 01:24:28",
     updated_at: "2021-06-27 01:24:28",
   }
>>> App\Models\Contributor::find(1)->projects->find(2)->tasks
=> Illuminate\Database\Eloquent\Collection {#4351
     all: [],
   }
>>> App\Models\Contributor::find(1)->projects->find(2)->tasks()->create(['name'=>'world war 1'])
=> App\Models\Task {#4359
     name: "world war 1",
     project_id: 2,
     updated_at: "2021-06-27 01:27:13",
     created_at: "2021-06-27 01:27:13",
     id: 4,
   }
>>> App\Models\Contributor::find(1)->projects->find(2)->tasks()->create(['name'=>'cold war'])
=> App\Models\Task {#4362
     name: "cold war",
     project_id: 2,
     updated_at: "2021-06-27 01:27:26",
     created_at: "2021-06-27 01:27:26",
     id: 5,
   }
>>> App\Models\Contributor::find(1)->projects->find(2)->tasks()->create(['name'=>'Roman empire'])
=> App\Models\Task {#4365
     name: "Roman empire",
     project_id: 2,
     updated_at: "2021-06-27 01:27:36",
     created_at: "2021-06-27 01:27:36",
     id: 6,
   }
>>> App\Models\Contributor::find(1)
=> App\Models\Contributor {#4350
     id: "1",
     name: "Alexa",
     created_at: "2021-06-27 01:21:14",
     updated_at: "2021-06-27 01:21:14",
   }
>>> App\Models\Contributor::find(1)->projects
=> Illuminate\Database\Eloquent\Collection {#4333
     all: [
       App\Models\Project {#4357
         id: "1",
         name: "Typography1",
         contributor_id: "1",
         created_at: "2021-06-27 01:22:19",
         updated_at: "2021-06-27 01:22:19",
       },
       App\Models\Project {#4361
         id: "2",
         name: "History1",
         contributor_id: "1",
         created_at: "2021-06-27 01:24:28",
         updated_at: "2021-06-27 01:24:28",
       },
     ],
   }
>>> App\Models\Contributor::find(1)->tasks
=> Illuminate\Database\Eloquent\Collection {#4371
     all: [
       App\Models\Task {#4372
         id: "1",
         name: "lesson1",
         project_id: "1",
         created_at: "2021-06-27 01:25:33",
         updated_at: "2021-06-27 01:25:33",
         laravel_through_key: "1",
       },
       App\Models\Task {#4373
         id: "2",
         name: "lesson2",
         project_id: "1",
         created_at: "2021-06-27 01:25:38",
         updated_at: "2021-06-27 01:25:38",
         laravel_through_key: "1",
       },
       App\Models\Task {#4374
         id: "3",
         name: "lesson3",
         project_id: "1",
         created_at: "2021-06-27 01:25:42",
         updated_at: "2021-06-27 01:25:42",
         laravel_through_key: "1",
       },
       App\Models\Task {#4375
         id: "4",
         name: "world war 1",
         project_id: "2",
         created_at: "2021-06-27 01:27:13",
         updated_at: "2021-06-27 01:27:13",
         laravel_through_key: "1",
       },
       App\Models\Task {#4376
         id: "5",
         name: "cold war",
         project_id: "2",
         created_at: "2021-06-27 01:27:26",
         updated_at: "2021-06-27 01:27:26",
         laravel_through_key: "1",
       },
       App\Models\Task {#4377
         id: "6",
         name: "Roman empire",
         project_id: "2",
         created_at: "2021-06-27 01:27:36",
         updated_at: "2021-06-27 01:27:36",
         laravel_through_key: "1",
       },
     ],
   }
>>> 
```

