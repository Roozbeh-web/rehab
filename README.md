# Rehab Project - An App For Quitting Addiction
   This project connect addicted person to a leader and ease the process of quitting addiction.

# Table Of Contents
- [General info](#general-info)
- [Technologies](#technologies)
- [Setup](#setup)
    1. [Install PHP](#install-php)
    2. [Insatll Node js](#install-node-js) 
    3. [Install composer](#install-composer) 
    4. [Pull the project](#pull-the-project)
    5. [Install php dependencies](#install-php-dependencies)
    6. [Add node modules](#add-node-modules)
    7. [Create database file](#create-database-file)
    8. [Migrate the database](#migrate-the-database)
    9. [Seeding tables](#seeding-tables)
- [Project status](#project-status)

# General Info
  The goal of this project is to ease quitting addiction. Helpseekers and leaders can create an account. Helpseekers can choose a leader and comiunicate     with their leaders. Leaders can set plans for their helpseekers.

# Technologies
  - PHP 8
  - Composer 2.4.2
  - Laravel 9.19
  - Sanctum 3.0
  - Livewire 2.10
  - Predis 2.0
  - Node 16.17.1
  - Npm 8.15.0
  - Vite 3.0.0
  - laravel-vite-plugin 0.5.0
  - Lodash 4.17.19
  - Postcss 8.1.14
  - Sass 1.54.5
  
# Setup
The following setup is for linux debian base OS.

- ## Install PHP
    [Documentation for install PHP on linux OS](https://www.geeksforgeeks.org/how-to-install-php-on-linux/)
- ## Install Node js
    [Documentation for install Node.js on linux OS](https://linuxize.com/post/how-to-install-node-js-on-ubuntu-18.04/)
- ## Install composer
    [Documentation for install composer on linux OS](https://getcomposer.org/doc/00-intro.md)
- ## Pull the project
    `git clone https://github.com/Roozbeh-web/rehab.git`
- ## Install php dependencies
   In the main folder of cloned project open terminal and run this command:<br></br>
   `composer install`
- ## Add node modules
   Run this command in the root folder of project:<br></br>
   `npm install`
- ## Create database file
   Go to database folder from root folder in terminal:<br></br>
   `cd database`
   <br></br>
   Then create database.sqlite file:<br></br>
   `touch database.sqlite`
- ## Migrate the database
   In the root folder of project enter this artisan code:<br></br>
   `php artisan migrate`
- ## Seeding tables
   `php artisan db:seed`
# Project Status
   In progress
   
    
    
