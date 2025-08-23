---
extends: _layouts.post
section: content
title: "Laravel Migrations from an Existing Database"
date: 2025-01-08
description: Automate migration creation in Laravel from an existing database using the Laravel Migrations Generator package. Save time and streamline your workflow.
featured: true
published: true
type: article
image: "generate-laravel-migrations.webp"
cover: "generate-laravel-migrations.webp"
categories: ['tutorials']
slug: laravel-migrations-from-database
---

One of the common challenges when migrating a legacy PHP application to Laravel is creating database migrations based on the existing database.

Depending on the size of the database, it can become an exhausting task.
I had to do it a few times, but recently I stumbled upon a database with over a hundred tables.

As a programmer, we don’t have the patience to do such a task, 
and we shouldn't.
The first thought is how to automate it.
With that in mind, I searched for an existing solution, found some packages,
and picked one by [kitloong](https://github.com/kitloong/),
the [Laravel migration generator](https://github.com/kitloong/laravel-migrations-generator) package.

## Practical example using an existing database structure

### Creating the tables

```sql
CREATE TABLE permissions
(
    id bigint unsigned auto_increment primary key,
    name varchar(255) not null,
    guard_name varchar(255) not null,
    created_at timestamp    null,
    updated_at timestamp    null,
    constraint permissions_name_guard_name_unique
    unique (name, guard_name)
)
collate = utf8_unicode_ci;
```

```sql
CREATE TABLE roles
(
    id bigint unsigned auto_increment primary key,
    team_id bigint unsigned null,
    name varchar(255) not null,
    guard_name varchar(255) not null,
    created_at timestamp null,
    updated_at timestamp null,
    constraint roles_team_id_name_guard_name_unique
    unique (team_id, name, guard_name)
)
collate = utf8_unicode_ci;
```

```sql
CREATE TABLE role_has_permissions
(
    permission_id bigint unsigned not null,
    role_id bigint unsigned not null,
    primary key (permission_id, role_id),
    constraint role_has_permissions_permission_id_foreign
    foreign key (permission_id) references permissions (id)
    on delete cascade,
    constraint role_has_permissions_role_id_foreign
    foreign key (role_id) references roles (id)
    on delete cascade
)
collate = utf8_unicode_ci;
```

```sql
CREATE INDEX roles_team_foreign_key_index on roles (team_id);
```

### Installing the package

```bash
> composer require --dev kitloong/laravel-migrations-generator
```

### Running the package command that does the magic

You can specify or ignore the tables you want using `--tables=` or `--ignore=` respectively.

Below is the command I ran for the tables we created above. 
To run for all the tables, don't add any additional filters.

```bash
> php artisan migrate:generate --tables="roles,permissions,role_permissions"
```

Command output

```bash
> Using connection: mysql

Generating migrations for: permissions,role_has_permissions,roles

Do you want to log these migrations in the migrations table? (yes/no) [yes]:
> yes

Setting up Tables and Index migrations.

Created: /var/www/html/database/migrations/2023_06_08_132125_create_permissions_table.php
Created: /var/www/html/database/migrations/2023_06_08_132125_create_role_has_permissions_table.php
Created: /var/www/html/database/migrations/2023_06_08_132125_create_roles_table.php

Setting up Views migrations.

Setting up Stored Procedures migrations.

Setting up Foreign Key migrations.

Created: /var/www/html/database/migrations/2023_06_08_132128_add_foreign_keys_to_role_has_permissions_table.php

Finished!
```

### Checking the migration files

Permissions table:

*`2023_06_08_132125_create_permissions_table.php`*
```php
...

Schema::create('roles', function (Blueprint $table) {
    $table->bigIncrements('id');
    
    $table->unsignedBigInteger('team_id')
        ->nullable()
        ->index('roles_team_foreign_key_index');
        
    $table->string('name');
    $table->string('guard_name');
    $table->timestamps();

    $table->unique(['team_id', 'name', 'guard_name']);
});

...
```

Roles table: 

*`2023_06_08_132125_create_role_has_permissions_table.php`*
```php
...

Schema::create('roles', function (Blueprint $table) {
    $table->bigIncrements('id');
    
    $table->unsignedBigInteger('team_id')
        ->nullable()
        ->index('roles_team_foreign_key_index');
        
    $table->string('name');
    $table->string('guard_name');
    $table->timestamps();

    $table->unique(['team_id', 'name', 'guard_name']);
});

...
```

Pivot table: 

*`2023_06_08_132125_create_roles_table.php`*
```php
...

Schema::create('role_has_permissions', function (Blueprint $table) {
    $table->unsignedBigInteger('permission_id');
    
    $table->unsignedBigInteger('role_id')
        ->index('role_has_permissions_role_id_foreign');

    $table->primary(['permission_id', 'role_id']);
});

...
```

Add foreign key to the pivot table: 

*`2023_06_08_132128_add_foreign_keys_to_role_has_permissions_table.php`*
```php
...

Schema::table('role_has_permissions', function (Blueprint $table) {
    $table->foreign(['permission_id'])
        ->references(['id'])
        ->on('permissions')
        ->onUpdate('NO ACTION')
        ->onDelete('CASCADE');
        
    $table->foreign(['role_id'])
        ->references(['id'])
        ->on('roles')
        ->onUpdate('NO ACTION')
        ->onDelete('CASCADE');
});

...
```
This is just one of the challenges when migrating a legacy PHP application to Laravel. 

The following post will be about password hashing algorithm incompatibility. 

[Join the discussion on Twitter.](https://twitter.com/leopoletto/status/1667887822764752898)

