## pivot hasManyThrough

relation between Projects, Employees and Tasks

- A Project belongsToMany Employees
- A Employee belongsToMany Projects

- Project hasMany Tasks
- Each Task belongsTo a Project

- Employee hasMany Tasks Through Projects 

Columns of tables
- projects
	- id
	- name

- employees
	- id
	- name

- employee_project [Pivot table]
	- id
	- project_id
	- employee_id
	- Unique[project_id,employee_id]

- tasks
	- id 
	- name
	- project_id

Models:
- Project
- Employee
- Colab [Pivot for employee_project]
- Task

Artisans:
- ❯ php artisan make:model Project -m
- ❯ php artisan make:model Employee -m
- ❯ php artisan make:model Task -m
- ❯ php artisan make:model Colab

refer [code](app/Models/) for relations
	
tinkers
```php
>>> App\Models\Employee::all()
=> Illuminate\Database\Eloquent\Collection {#4179
     all: [],
   }
>>> App\Models\Employee::create(['name'=>'emp1'])
=> App\Models\Employee {#3390
     name: "emp1",
     updated_at: "2021-06-29 00:11:57",
     created_at: "2021-06-29 00:11:57",
     id: 1,
   }
>>> App\Models\Employee::create(['name'=>'emp2'])
=> App\Models\Employee {#4179
     name: "emp2",
     updated_at: "2021-06-29 00:12:00",
     created_at: "2021-06-29 00:12:00",
     id: 2,
   }
>>> App\Models\Employee::create(['name'=>'emp3'])
=> App\Models\Employee {#3390
     name: "emp3",
     updated_at: "2021-06-29 00:12:36",
     created_at: "2021-06-29 00:12:36",
     id: 3,
   }
>>> App\Models\Employee::all()
=> Illuminate\Database\Eloquent\Collection {#3385
     all: [
       App\Models\Employee {#4111
         id: "1",
         name: "emp1",
         created_at: "2021-06-29 00:11:57",
         updated_at: "2021-06-29 00:11:57",
       },
       App\Models\Employee {#3389
         id: "2",
         name: "emp2",
         created_at: "2021-06-29 00:12:00",
         updated_at: "2021-06-29 00:12:00",
       },
       App\Models\Employee {#4325
         id: "3",
         name: "emp3",
         created_at: "2021-06-29 00:12:36",
         updated_at: "2021-06-29 00:12:36",
       },
     ],
   }
>>> App\Models\Project::all()
=> Illuminate\Database\Eloquent\Collection {#4321
     all: [],
   }
>>> App\Models\Project::create(['name'=>'Project 1'])
=> App\Models\Project {#3385
     name: "Project 1",
     updated_at: "2021-06-29 00:13:12",
     created_at: "2021-06-29 00:13:12",
     id: 1,
   }
>>> App\Models\Project::create(['name'=>'Project 2'])
=> App\Models\Project {#4321
     name: "Project 2",
     updated_at: "2021-06-29 00:13:15",
     created_at: "2021-06-29 00:13:15",
     id: 2,
   }
>>> App\Models\Employee::all()
=> Illuminate\Database\Eloquent\Collection {#4267
     all: [
       App\Models\Employee {#4325
         id: "1",
         name: "emp1",
         created_at: "2021-06-29 00:11:57",
         updated_at: "2021-06-29 00:11:57",
       },
       App\Models\Employee {#4112
         id: "2",
         name: "emp2",
         created_at: "2021-06-29 00:12:00",
         updated_at: "2021-06-29 00:12:00",
       },
       App\Models\Employee {#3389
         id: "3",
         name: "emp3",
         created_at: "2021-06-29 00:12:36",
         updated_at: "2021-06-29 00:12:36",
       },
     ],
   }
>>> App\Models\Project::all()
=> Illuminate\Database\Eloquent\Collection {#4179
     all: [
       App\Models\Project {#4330
         id: "1",
         name: "Project 1",
         created_at: "2021-06-29 00:13:12",
         updated_at: "2021-06-29 00:13:12",
       },
       App\Models\Project {#4331
         id: "2",
         name: "Project 2",
         created_at: "2021-06-29 00:13:15",
         updated_at: "2021-06-29 00:13:15",
       },
     ],
   }
>>> App\Models\Project::find(1)
=> App\Models\Project {#4326
     id: "1",
     name: "Project 1",
     created_at: "2021-06-29 00:13:12",
     updated_at: "2021-06-29 00:13:12",
   }
>>> App\Models\Project::find(1)->employees
=> Illuminate\Database\Eloquent\Collection {#4179
     all: [],
   }
>>> App\Models\Employee::all()->pluck('id')
=> Illuminate\Support\Collection {#4330
     all: [
       1,
       2,
       3,
     ],
   }
>>> App\Models\Project::find(1)->employees()->attach([1,3])
=> null
>>> App\Models\Project::find(1)->employees
=> Illuminate\Database\Eloquent\Collection {#4113
     all: [
       App\Models\Employee {#4339
         id: "1",
         name: "emp1",
         created_at: "2021-06-29 00:11:57",
         updated_at: "2021-06-29 00:11:57",
         pivot: Illuminate\Database\Eloquent\Relations\Pivot {#4179
           project_id: "1",
           employee_id: "1",
         },
       },
       App\Models\Employee {#4333
         id: "3",
         name: "emp3",
         created_at: "2021-06-29 00:12:36",
         updated_at: "2021-06-29 00:12:36",
         pivot: Illuminate\Database\Eloquent\Relations\Pivot {#4331
           project_id: "1",
           employee_id: "3",
         },
       },
     ],
   }
>>> App\Models\Project::find(2)->employees
=> Illuminate\Database\Eloquent\Collection {#4336
     all: [],
   }
>>> App\Models\Project::find(2)->employees()->attach([2,1])
=> null
>>> App\Models\Project::find(2)->employees
=> Illuminate\Database\Eloquent\Collection {#4345
     all: [
       App\Models\Employee {#4351
         id: "1",
         name: "emp1",
         created_at: "2021-06-29 00:11:57",
         updated_at: "2021-06-29 00:11:57",
         pivot: Illuminate\Database\Eloquent\Relations\Pivot {#3390
           project_id: "2",
           employee_id: "1",
         },
       },
       App\Models\Employee {#4344
         id: "2",
         name: "emp2",
         created_at: "2021-06-29 00:12:00",
         updated_at: "2021-06-29 00:12:00",
         pivot: Illuminate\Database\Eloquent\Relations\Pivot {#4347
           project_id: "2",
           employee_id: "2",
         },
       },
     ],
   }
>>> App\Models\Employee::find(1)
=> App\Models\Employee {#4350
     id: "1",
     name: "emp1",
     created_at: "2021-06-29 00:11:57",
     updated_at: "2021-06-29 00:11:57",
   }
>>> App\Models\Employee::find(1)->projects
=> Illuminate\Database\Eloquent\Collection {#4357
     all: [
       App\Models\Project {#4361
         id: "1",
         name: "Project 1",
         created_at: "2021-06-29 00:13:12",
         updated_at: "2021-06-29 00:13:12",
         pivot: Illuminate\Database\Eloquent\Relations\Pivot {#4354
           employee_id: "1",
           project_id: "1",
         },
       },
       App\Models\Project {#4358
         id: "2",
         name: "Project 2",
         created_at: "2021-06-29 00:13:15",
         updated_at: "2021-06-29 00:13:15",
         pivot: Illuminate\Database\Eloquent\Relations\Pivot {#4326
           employee_id: "1",
           project_id: "2",
         },
       },
     ],
   }
>>> App\Models\Employee::find(1)->projects->find(1)
=> App\Models\Project {#4368
     id: "1",
     name: "Project 1",
     created_at: "2021-06-29 00:13:12",
     updated_at: "2021-06-29 00:13:12",
     pivot: Illuminate\Database\Eloquent\Relations\Pivot {#4338
       employee_id: "1",
       project_id: "1",
     },
   }
>>> App\Models\Employee::find(1)->projects->find(1)->tasks
=> Illuminate\Database\Eloquent\Collection {#4379
     all: [],
   }
>>> App\Models\Employee::find(1)->projects->find(1)->tasks()->create(['name'=>'task1proj1'])
=> App\Models\Task {#4342
     name: "task1proj1",
     project_id: 1,
     updated_at: "2021-06-29 00:21:09",
     created_at: "2021-06-29 00:21:09",
     id: 1,
   }
>>> App\Models\Employee::find(1)->projects->find(1)->tasks()->create(['name'=>'task2proj1'])
=> App\Models\Task {#4384
     name: "task2proj1",
     project_id: 1,
     updated_at: "2021-06-29 00:21:30",
     created_at: "2021-06-29 00:21:30",
     id: 2,
   }
>>> App\Models\Employee::find(1)->projects->find(2)->tasks()->create(['name'=>'task1proj2'])
=> App\Models\Task {#4380
     name: "task1proj2",
     project_id: 2,
     updated_at: "2021-06-29 00:21:44",
     created_at: "2021-06-29 00:21:44",
     id: 3,
   }
>>> App\Models\Employee::find(1)->tasks
=> Illuminate\Database\Eloquent\Collection {#4415
     all: [
       App\Models\Task {#4412
         id: "1",
         name: "task1proj1",
         project_id: "1",
         created_at: "2021-06-29 00:21:09",
         updated_at: "2021-06-29 00:21:09",
         laravel_through_key: "1",
       },
       App\Models\Task {#4413
         id: "2",
         name: "task2proj1",
         project_id: "1",
         created_at: "2021-06-29 00:21:30",
         updated_at: "2021-06-29 00:21:30",
         laravel_through_key: "1",
       },
       App\Models\Task {#4416
         id: "3",
         name: "task1proj2",
         project_id: "2",
         created_at: "2021-06-29 00:21:44",
         updated_at: "2021-06-29 00:21:44",
         laravel_through_key: "1",
       },
     ],
   }
>>> App\Models\Employee::find(1)->tasks->find(1)
=> App\Models\Task {#4321
     id: "1",
     name: "task1proj1",
     project_id: "1",
     created_at: "2021-06-29 00:21:09",
     updated_at: "2021-06-29 00:21:09",
     laravel_through_key: "1",
   }
>>> App\Models\Employee::find(1)->tasks->find(1)->project
=> App\Models\Project {#3706
     id: "1",
     name: "Project 1",
     created_at: "2021-06-29 00:13:12",
     updated_at: "2021-06-29 00:13:12",
   }
>>> exit
Exit:  Goodbye
```