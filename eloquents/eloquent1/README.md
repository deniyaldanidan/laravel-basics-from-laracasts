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

## Default for Homwework
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