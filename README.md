# WPMVC Example Plugin

Maintained by: [The Code Company](https://thecode.co)

[![License: ISC](https://img.shields.io/badge/License-ISC-blue.svg)](https://opensource.org/licenses/ISC)

> [!IMPORTANT]  
> WPMVC is currently in alpha, as such there may be breaking changes introduced on our path to beta/v1.0. While we hope you will find the package useful in its current state you're using it at your own risk.

## Index

- [WPMVC Example Plugin](#wpmvc-example-plugin)
	- [Index](#index)
	- [Overview](#overview)
	- [Getting Started](#getting-started)
		- [Requirements](#requirements)
		- [Installation](#installation)
			- [Step 1](#step-1)
			- [Step 2](#step-2)
			- [Step 3](#step-3)
			- [Step 4](#step-4)
			- [Step 5](#step-5)
	- [Customise](#customise)
	- [Creating a controller](#creating-a-controller)
	- [Registering a controller](#registering-a-controller)
	- [Creating custom post types](#creating-custom-post-types)
		- [Step 1 - Create the model](#step-1---create-the-model)
		- [Step 2 - Create the registration controller](#step-2---create-the-registration-controller)
		- [Step 3 - Register the controller](#step-3---register-the-controller)
	- [Creating custom taxonomies](#creating-custom-taxonomies)
		- [Step 1 - Create the model](#step-1---create-the-model-1)
		- [Step 2 - Create the registration controller](#step-2---create-the-registration-controller-1)
			- [Relationship with post type(s)](#relationship-with-post-types)
			- [Taxonomy registration arguments](#taxonomy-registration-arguments)
		- [Step 3 - Register the controller](#step-3---register-the-controller-1)
	- [Contributing](#contributing)

## Overview

This is an example mu-plugin demonstrating the usage of [WPMVC](https://github.com/TheCodeCompany/wpmvc). It's designed to be downloaded as a zip and used as the basis for your own plugin, rather than cloned or forked (especially while in alpha).

The example plugin comes with some predefined models and controllers that demonstrate some common uses for WPMVC including registering custom post types and taxonomies. Additionally, there are examples of using controllers as the basis for configuration, REST and routing.

## Getting Started

### Requirements

- PHP 8.1+
- WordPress 6.4+

> Please refer to requirements for [WPMVC](https://github.com/TheCodeCompany/wpmvc).

### Installation

#### Step 1

As mentioned above, download this project as a zip rather than cloning.

<img src="https://thecodeco.b-cdn.net/wpmvc/download-zip.png" width="300"/>

#### Step 2

Extract the contents of the zip file into your `wp-content/mu-plugins` directory, for our example we will rename the extraced directory `example-corp` - you can use any name you'd like however you'll need to ensure the boot loader path is updated in Step 4.

<img src="https://thecodeco.b-cdn.net/wpmvc/mu-plugin-directory.png" width="200"/>

#### Step 3
Move the `mu-boot-example.php` file into your wp-content/mu-plugins directory, ensure the path in this file is accurate as mentioned in Step 2. You can rename `mu-boot-example.php` to anything you'd like.

<img src="https://thecodeco.b-cdn.net/wpmvc/boot-file.png" width="500"/>

#### Step 4
Open the plugin directory in your terminal and run composer install, this will install WPMVC as a dependency and allow the example application to function.

```
composer install --ignore-platform-reqs
```

#### Step 5
At this point you can log into wp-admin and verify that the mu-plugin is active and the example post type and taxonomy have been registered.

<img src="https://thecodeco.b-cdn.net/wpmvc/post-type.png" width="500"/>

You can use these example controllers/models as the basis for your own, in the future we will be introducing a scaffolding system to generate these via the cli.

> [!WARNING]  
> If you can't see the example post type (Movies) or taxonomy (Genres) or are receiving an error when registering the mu-plugin, ensure that the path in your boot file is accurate and that you've run composer install from Step 4.

## Customise
Assuming you'll want to customise the mu-plugin and provide your own package names, namespaces etc. the first step is to perform a search/replace within the mu-plugin directory, you'll want to update all occurances of `ExampleCorp`, `example-corp` and `Example Corp` with your own name e.g. `MyApp`, `my-app` and `My App`.

Once you've performed this replacement, which will also update the PSR-4 autoload namespace in your composer.json file, you will need to run the following command:

```
composer dump-autoload
```

Lastly you can modify the composer.json name and description to your liking, as well as the plugin declaration comment in the `boot.php` file.

## Creating a controller

Controllers in WPMVC are very flexible and serve multiple purposes, from more traditional use cases such as regiering routes or REST endpoints to more WordPress-specific uses such as mounting application code into WordPress via hooks using the `set_up()` method. There are a number of examples provided with this plugin that you can use as the basis for your controllers which are detailed below:

`ExampleConfigController.php`

This example demonstrates the usage of WPMVC's configuration system. It registers a custom route that maps to a method `route_example_config()` which demonstrates retrieving environment-specific configuration variables.

<img src="https://thecodeco.b-cdn.net/wpmvc/config.png" width="700"/>

WPMVC uses a constant `WP_ENV` which you can define in your `wp-config.php` file, you may use this to handle loading environment-specific configuration. The environment constant options the example plugin uses are `local`, `staging` and `production`. E.g.

```
define( 'WP_ENV', 'local' );
```

`ExampleRESTController.php`

The example REST controller demonstrates how to create a custom REST endpoint using the WordPress REST system. This is a simple system that mounts on the `plugins_loaded` hook via the `set_up()` method that all controllers inherit. You may use the same arguments when registering your endpoint as can be found [in the WordPress codex](https://developer.wordpress.org/rest-api/extending-the-rest-api/adding-custom-endpoints/).

<img src="https://thecodeco.b-cdn.net/wpmvc/rest.png" width="600"/>

`ExampleRouteController.php`

The example Route controller demonstrates two pieces of functionality, first the ability to register custom routes within WPMVC that you can bind to a method within your controller. The second is WPMVC's lightweight theme/templating system which can be used to create and render templates. Routes are registered within WPMVC, not as rewrite rules, this happens during the `do_parse_request` action.

<img src="https://thecodeco.b-cdn.net/wpmvc/route.png" width="500"/>

## Registering a controller

Controllers do nothing on their own, you will need to register them within the WPMVC application via the `boot.php` file in your plugin root. This example plugin has a handful of pre-registered controllers that take care of the registration of the example `Movie` post type and `Genre` taxonomy - you can intialiase your new controllers within the array pictured below.

<img src="https://thecodeco.b-cdn.net/wpmvc/application.png" width="400"/>

Any class instance you provide within this array will have its `set_up()` method called when WordPress initiliases, this is a required method and how your controller "hooks in" to WordPress.

## Creating custom post types

Creating custom post types with WPMVC requires three steps, first creating a model that represents the custom post type and then creating a controller to register it with WordPress.

### Step 1 - Create the model

Custom post type models are extended from the `GenericPost` model, this provides some post-specific methods that can be quite useful when creating, modifying or iterating over posts within WPMVC. You can simply provide the post type name as pictured below and the rest of the configuration happens within the registration controller.

<img src="https://thecodeco.b-cdn.net/wpmvc/post-model.png" width="500"/>

### Step 2 - Create the registration controller

Using the `RegisterMovieController` example, we can see that we're using the post model from the previous step as a reference on line 23 and defining our labeling with `get_label_singular()`, `get_label_plural()` and `get_post_type_args_labels()` methods. This is a fairly manual process, as best practices dictate to not use variables within translation functions.

The registration itself happens within the `get_register_post_type_args()` method, you may use the [register_post_type()](https://developer.wordpress.org/reference/functions/register_post_type/) docs as a reference for the arguments that get passed to WordPress via this method.

<img src="https://thecodeco.b-cdn.net/wpmvc/post-type-args.png" width="700"/>

### Step 3 - Register the controller

As per the "Registering a controller" section above, you must include and initialise your controller in the `boot.php` file.


## Creating custom taxonomies

Similarly to custom post types, creating a custom taxonomy requires three steps.

### Step 1 - Create the model

As opposed to post models, taxonomy models are extended from `TaxonomyTermModel`. They also require a single constant, the name of the taxonomy

<img src="https://thecodeco.b-cdn.net/wpmvc/taxonomy-model.png" width="500"/>

### Step 2 - Create the registration controller

This process is very similar to registering a custom post type, with two primary differences.

#### Relationship with post type(s)

The `get_taxonomy_object_types()` method is used to define which post types this taxonomy is related to, in our example you can see the inverse relationship between Movies and Genres is defined here. You may add as many post type references to this method as you'd like.

<img src="https://thecodeco.b-cdn.net/wpmvc/taxonomy-register.png" width="500"/>

#### Taxonomy registration arguments
The arguments used in the `get_taxonomy_args()` method are the same as the arguments used for the [register_taxonomy()](https://developer.wordpress.org/reference/functions/register_taxonomy/) function. 

### Step 3 - Register the controller

As per the "Registering a controller" section above, you must include and initialise your controller in the `boot.php` file.

## Contributing

[WPMVC](https://github.com/TheCodeCompany/wpmvc) is maintained by [The Code Company](https://thecode.co/), while we appreciate feedback and will endeavour to action requests for features/bug fixes this repository is not open to outside contribution at this time. You are, however, free to fork and use WPMVC in any way you see fit as per the ISC license.
