# EvAl (Real Estate Listing Platform)

EvAl is a real estate listing platform, a modern web application built using Laravel on the backend and Vue.js with Vuex on the frontend. This platform is designed to simplify the process of listing and searching for real estate properties, providing a user-friendly experience for both property owners and potential buyers.

## Table of Contents
- [EvAl (Real Estate Listing Platform)](#eval-real-estate-listing-platform)
  - [Table of Contents](#table-of-contents)
  - [Technologies](#technologies)
  - [Features](#features)
  - [Setup](#setup)

## Technologies
- **Laravel**(v8): A powerful PHP framework for building robust and scalable web applications.
- **Vue.js** (v2): A progressive JavaScript framework for building user interfaces.
- **Vuex**: State management library for Vue.js applications.
- **Vuetify**: A sleek and feature-rich material design component library for Vue.js.
- **Google Maps**: Integration for interactive maps.
- **Stripe**: Payments integration

## Features
- [x] **User Authentication**: Secure user authentication system to ensure the privacy and security of user data.
- [x] **Property Listing**: Easily list properties with detailed information such as price, location, images
- [x] **Search and Filter**: Intuitive search functionality with advanced filters to help users find properties that match their criteria.
- [x] **Interactive Map Search**: Search properties visually from a map.
- [x] **User roles**: Multiple user roles such as Admin, Moderator and Users
- [x] **Agencies With Properties**: Post property listings from an agency
- [x] **Flag Posts**: Report property listing posts to the system
- [x] **Paid Listing Advertisement**: Improve search rank and/or add premium status to a property listing with a payment. 

## Setup

Run locally:

1. ```php artisan key:generate``` (Generate App key)
2. ``` php artisan migrate ``` (To migrate tables to local database)

3. ``` php artisan db:seed DatabaseSeeder ``` (This seeder file runs all the necessary seeders for the app to look like a real app in development environment)

4. Set up the server: Can be done by running ```php artisan serve``` or by using tools such as XAMPP, Laragon.

5. Watch for npm changes: ```npm run hot```

6. Open the app locally in localhost:3000 