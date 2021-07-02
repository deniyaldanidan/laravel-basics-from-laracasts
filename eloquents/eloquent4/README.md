# many to many

Two Models and its relations
- Member
- Role
- MemberRole

- member belongsToMany roles
- role belongToMany members

Columns for tables:
- members
	- id
	- name

- roles
	- id
	- name

- member_role
	- member_id [pivot]
	- role_id [pivot]
	- active
	
**Tinkers**
```php
❯ php artisan tinker
Psy Shell v0.10.8 (PHP 7.4.3 — cli) by Justin Hileman
>>> App\Models\Member::create(['name'=>'member1'])
=> App\Models\Member {#4267
     name: "member1",
     updated_at: "2021-07-01 10:21:49",
     created_at: "2021-07-01 10:21:49",
     id: 1,
   }
>>> App\Models\Member::create(['name'=>'member2'])
=> App\Models\Member {#3390
     name: "member2",
     updated_at: "2021-07-01 10:21:55",
     created_at: "2021-07-01 10:21:55",
     id: 2,
   }
>>> App\Models\Role::create(['name'=>'editor'])
=> App\Models\Role {#4267
     name: "editor",
     updated_at: "2021-07-01 10:22:14",
     created_at: "2021-07-01 10:22:14",
     id: 1,
   }
>>> App\Models\Role::create(['name'=>'writer'])
=> App\Models\Role {#3390
     name: "writer",
     updated_at: "2021-07-01 10:22:22",
     created_at: "2021-07-01 10:22:22",
     id: 2,
   }
>>> App\Models\Role::create(['name'=>'publisher'])
=> App\Models\Role {#4267
     name: "publisher",
     updated_at: "2021-07-01 10:22:31",
     created_at: "2021-07-01 10:22:31",
     id: 3,
   }
>>> App\Models\Member::find(1)
=> App\Models\Member {#4178
     id: "1",
     name: "member1",
     created_at: "2021-07-01 10:21:49",
     updated_at: "2021-07-01 10:21:49",
   }
>>> App\Models\Member::find(1)->roles
=> Illuminate\Database\Eloquent\Collection {#4323
     all: [],
   }
>>> App\Models\Member::find(1)->roles->attach([1,2])
BadMethodCallException with message 'Method Illuminate\Database\Eloquent\Collection::attach does not exist.'
>>> App\Models\Member::find(1)->roles()->attach([1,2])
Illuminate\Database\QueryException with message 'SQLSTATE[23000]: Integrity constraint violation: 19 NOT NULL constraint failed: member_role.active (SQL: insert into "member_role" ("member_id", "role_id") values (1, 1), (1, 2))'
>>> App\Models\Member::find(1)->roles()->attach([1=>['active'=>true],2=>['active'=>false]])
=> null
>>> App\Models\Member::find(2)->roles()->attach([1=>['active'=>true],2=>['active'=>false]])
=> null
>>> App\Models\Member::find(2)->roles()->detach([2])
=> 1
>>> App\Models\Member::find(2)->roles()->attach([3=>['active'=>false]])
=> null
>>> App\Models\Member::find(2)->roles
=> Illuminate\Database\Eloquent\Collection {#4323
     all: [
       App\Models\Role {#4341
         id: "1",
         name: "editor",
         created_at: "2021-07-01 10:22:14",
         updated_at: "2021-07-01 10:22:14",
         pivot: Illuminate\Database\Eloquent\Relations\Pivot {#4336
           member_id: "2",
           role_id: "1",
           active: "1",
         },
       },
       App\Models\Role {#4338
         id: "3",
         name: "publisher",
         created_at: "2021-07-01 10:22:31",
         updated_at: "2021-07-01 10:22:31",
         pivot: Illuminate\Database\Eloquent\Relations\Pivot {#4330
           member_id: "2",
           role_id: "3",
           active: "0",
         },
       },
     ],
   }
>>> App\Models\Member::find(1)->roles
=> Illuminate\Database\Eloquent\Collection {#4353
     all: [
       App\Models\Role {#4345
         id: "1",
         name: "editor",
         created_at: "2021-07-01 10:22:14",
         updated_at: "2021-07-01 10:22:14",
         pivot: Illuminate\Database\Eloquent\Relations\Pivot {#4339
           member_id: "1",
           role_id: "1",
           active: "1",
         },
       },
       App\Models\Role {#4350
         id: "2",
         name: "writer",
         created_at: "2021-07-01 10:22:22",
         updated_at: "2021-07-01 10:22:22",
         pivot: Illuminate\Database\Eloquent\Relations\Pivot {#4354
           member_id: "1",
           role_id: "2",
           active: "0",
         },
       },
     ],
   }
>>> App\Models\Role::find(1)
=> App\Models\Role {#4332
     id: "1",
     name: "editor",
     created_at: "2021-07-01 10:22:14",
     updated_at: "2021-07-01 10:22:14",
   }
>>> App\Models\Role::find(1)->members
=> Illuminate\Database\Eloquent\Collection {#4355
     all: [
       App\Models\Member {#4362
         id: "1",
         name: "member1",
         created_at: "2021-07-01 10:21:49",
         updated_at: "2021-07-01 10:21:49",
         pivot: Illuminate\Database\Eloquent\Relations\Pivot {#4267
           role_id: "1",
           member_id: "1",
           active: "1",
         },
       },
       App\Models\Member {#4359
         id: "2",
         name: "member2",
         created_at: "2021-07-01 10:21:55",
         updated_at: "2021-07-01 10:21:55",
         pivot: Illuminate\Database\Eloquent\Relations\Pivot {#4356
           role_id: "1",
           member_id: "2",
           active: "1",
         },
       },
     ],
   }
>>> App\Models\Role::find(2)->members
=> Illuminate\Database\Eloquent\Collection {#4358
     all: [
       App\Models\Member {#4361
         id: "1",
         name: "member1",
         created_at: "2021-07-01 10:21:49",
         updated_at: "2021-07-01 10:21:49",
         pivot: Illuminate\Database\Eloquent\Relations\Pivot {#4349
           role_id: "2",
           member_id: "1",
           active: "0",
         },
       },
     ],
   }
>>> App\Models\Role::find(3)->members
=> Illuminate\Database\Eloquent\Collection {#4366
     all: [
       App\Models\Member {#4365
         id: "2",
         name: "member2",
         created_at: "2021-07-01 10:21:55",
         updated_at: "2021-07-01 10:21:55",
         pivot: Illuminate\Database\Eloquent\Relations\Pivot {#4332
           role_id: "3",
           member_id: "2",
           active: "0",
         },
       },
     ],
   }
>>> App\Models\Member::all()
=> Illuminate\Database\Eloquent\Collection {#4372
     all: [
       App\Models\Member {#4373
         id: "1",
         name: "member1",
         created_at: "2021-07-01 10:21:49",
         updated_at: "2021-07-01 10:21:49",
       },
       App\Models\Member {#4376
         id: "2",
         name: "member2",
         created_at: "2021-07-01 10:21:55",
         updated_at: "2021-07-01 10:21:55",
       },
     ],
   }
>>> App\Models\Member::find(2)->roles
=> Illuminate\Database\Eloquent\Collection {#4378
     all: [
       App\Models\Role {#4385
         id: "1",
         name: "editor",
         created_at: "2021-07-01 10:22:14",
         updated_at: "2021-07-01 10:22:14",
         pivot: Illuminate\Database\Eloquent\Relations\Pivot {#4364
           member_id: "2",
           role_id: "1",
           active: "1",
         },
       },
       App\Models\Role {#4382
         id: "3",
         name: "publisher",
         created_at: "2021-07-01 10:22:31",
         updated_at: "2021-07-01 10:22:31",
         pivot: Illuminate\Database\Eloquent\Relations\Pivot {#4379
           member_id: "2",
           role_id: "3",
           active: "0",
         },
       },
     ],
   }
>>> App\Models\Member::find(1)->roles
=> Illuminate\Database\Eloquent\Collection {#4368
     all: [
       App\Models\Role {#4390
         id: "1",
         name: "editor",
         created_at: "2021-07-01 10:22:14",
         updated_at: "2021-07-01 10:22:14",
         pivot: Illuminate\Database\Eloquent\Relations\Pivot {#4381
           member_id: "1",
           role_id: "1",
           active: "1",
         },
       },
       App\Models\Role {#4387
         id: "2",
         name: "writer",
         created_at: "2021-07-01 10:22:22",
         updated_at: "2021-07-01 10:22:22",
         pivot: Illuminate\Database\Eloquent\Relations\Pivot {#4384
           member_id: "1",
           role_id: "2",
           active: "0",
         },
       },
     ],
   }
>>> App\Models\Member::find(1)->roles()->updateExistingPivot(2, ['active'=>true])
=> 1
>>> App\Models\Member::find(1)->roles()->updateExistingPivot(1, ['active'=>false])
=> 1
>>> App\Models\Member::find(1)->roles
=> Illuminate\Database\Eloquent\Collection {#4388
     all: [
       App\Models\Role {#4399
         id: "1",
         name: "editor",
         created_at: "2021-07-01 10:22:14",
         updated_at: "2021-07-01 10:22:14",
         pivot: Illuminate\Database\Eloquent\Relations\Pivot {#4400
           member_id: "1",
           role_id: "1",
           active: "0",
         },
       },
       App\Models\Role {#4397
         id: "2",
         name: "writer",
         created_at: "2021-07-01 10:22:22",
         updated_at: "2021-07-01 10:22:22",
         pivot: Illuminate\Database\Eloquent\Relations\Pivot {#4392
           member_id: "1",
           role_id: "2",
           active: "1",
         },
       },
     ],
   }
>>> exit
Exit:  Goodbye

❯ php artisan tinker
Psy Shell v0.10.8 (PHP 7.4.3 — cli) by Justin Hileman
>>> App\Models\Role::find(1)
=> App\Models\Role {#4178
     id: "1",
     name: "editor",
     created_at: "2021-07-01 10:22:14",
     updated_at: "2021-07-01 10:22:14",
   }
>>> App\Models\Role::find(1)->members
=> Illuminate\Database\Eloquent\Collection {#4074
     all: [
       App\Models\Member {#4325
         id: "1",
         name: "member1",
         created_at: "2021-07-01 10:21:49",
         updated_at: "2021-07-01 10:21:49",
         pivot: Illuminate\Database\Eloquent\Relations\Pivot {#3387
           role_id: "1",
           member_id: "1",
           active: "0",
         },
       },
       App\Models\Member {#4268
         id: "2",
         name: "member2",
         created_at: "2021-07-01 10:21:55",
         updated_at: "2021-07-01 10:21:55",
         pivot: Illuminate\Database\Eloquent\Relations\Pivot {#3706
           role_id: "1",
           member_id: "2",
           active: "1",
         },
       },
     ],
   }
>>> App\Models\Role::find(1)->active_members
=> Illuminate\Database\Eloquent\Collection {#4112
     all: [
       App\Models\Member {#4334
         id: "2",
         name: "member2",
         created_at: "2021-07-01 10:21:55",
         updated_at: "2021-07-01 10:21:55",
         pivot: Illuminate\Database\Eloquent\Relations\Pivot {#4331
           role_id: "1",
           member_id: "2",
         },
       },
     ],
   }
>>> App\Models\Role::find(2)->members
=> Illuminate\Database\Eloquent\Collection {#4324
     all: [
       App\Models\Member {#4327
         id: "1",
         name: "member1",
         created_at: "2021-07-01 10:21:49",
         updated_at: "2021-07-01 10:21:49",
         pivot: Illuminate\Database\Eloquent\Relations\Pivot {#4178
           role_id: "2",
           member_id: "1",
           active: "1",
         },
       },
     ],
   }
>>> App\Models\Role::find(2)->active_members
=> Illuminate\Database\Eloquent\Collection {#4340
     all: [
       App\Models\Member {#4336
         id: "1",
         name: "member1",
         created_at: "2021-07-01 10:21:49",
         updated_at: "2021-07-01 10:21:49",
         pivot: Illuminate\Database\Eloquent\Relations\Pivot {#4329
           role_id: "2",
           member_id: "1",
         },
       },
     ],
   }
>>> App\Models\Role::find(3)->members
=> Illuminate\Database\Eloquent\Collection {#4341
     all: [
       App\Models\Member {#4344
         id: "2",
         name: "member2",
         created_at: "2021-07-01 10:21:55",
         updated_at: "2021-07-01 10:21:55",
         pivot: Illuminate\Database\Eloquent\Relations\Pivot {#4323
           role_id: "3",
           member_id: "2",
           active: "0",
         },
       },
     ],
   }
>>> App\Models\Role::find(3)->active_members
=> Illuminate\Database\Eloquent\Collection {#4333
     all: [],
   }
>>> App\Models\MemberRole::all()
=> Illuminate\Database\Eloquent\Collection {#3400
     all: [
       App\Models\MemberRole {#3401
         id: "1",
         member_id: "1",
         role_id: "1",
         active: "0",
         created_at: null,
         updated_at: null,
       },
       App\Models\MemberRole {#3402
         id: "2",
         member_id: "1",
         role_id: "2",
         active: "1",
         created_at: null,
         updated_at: null,
       },
       App\Models\MemberRole {#3403
         id: "3",
         member_id: "2",
         role_id: "1",
         active: "1",
         created_at: null,
         updated_at: null,
       },
       App\Models\MemberRole {#3404
         id: "5",
         member_id: "2",
         role_id: "3",
         active: "0",
         created_at: null,
         updated_at: null,
       },
     ],
   }
>>> 
```