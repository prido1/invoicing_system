# Invicing System


This is a simple laravel billing system. You can use it to send html invoice emails.
Features: manage clients, manage users, manage, invoices, manage quotations, manage roles & permissions.


## Installation

Download and install composer

Clone this repo, open terminal and navigate to the folder containing the cloned repo, then run the following commands.
Before running the commands, create a .env file. _See the .env.example.._


```sh
composer install
php artisan migrate
php artisan db:seed
php artisan serve
```

Now on yr browser goto http://127.0.0.1:8000

Default email: admin@gmail.com

Default password: admin@_123

## Create Client

<img src="./demo/assets/images/create_client.jpeg" alt="" width="100%"/>

## Create Invoice

<img src="./demo/assets/images/create_invoice.jpeg" alt="" width="100%"/>

## View Invoice

<img src="./demo/assets/images/view_invoice.jpeg" alt="" width="100%"/>

## Send Invoice

<img src="./demo/assets/images/sending_invoice.jpeg" alt="" width="100%"/>

## Email templates

<img src="./demo/assets/images/edit_templates.jpeg" alt="" width="100%"/>

Here is a list of available variables to use when creating templates:
- {name} 
- {email}
- {company_name}
- {phone}
- {address}
- {total_due}
- {due_date}
- {user}
- {invoice_no}
- {quotation_no}
- {user_name}

## Roles

<img src="./demo/assets/images/list_roles.jpeg" alt="" width="100%"/>

## Permissions

<img src="./demo/assets/images/list_permissions.jpeg" alt="" width="100%"/>

## Create Permision

<img src="./demo/assets/images/create_permissions.jpeg" alt="" width="100%"/>

## Banking Details Settings

<img src="./demo/assets/images/banking_details_edit.jpeg" alt="" width="100%"/>

## SMTP Settings

<img src="./demo/assets/images/email_settings_edit.jpeg" alt="" width="100%"/>

## General Settings

<img src="./demo/assets/images/general_settings_edit.jpeg" alt="" width="100%"/>

## Imap Settings

<img src="./demo/assets/images/imap_settings_edit.jpeg" alt="" width="100%"/>


