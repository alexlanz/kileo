Kileo
=====

## Prerequisites

- Virtualbox
- Vagrant


## Setup

### Repository

1. Clone the git repository
- Copy the file .env.example to .env

### Local machine

1.  Append the hosts configurations (vagrant/hosts) to the hosts file of your machine (/etc/hosts)

### Vagrant

1. Run `vagrant up` to start the machine
- Run `vagrant ssh` to log into the machine

### Repository dependencies, database migrations and tests

1. Run `vagrant ssh` to log into the machine
- Change to the directory /vagrant
- Run `./vagrant/setup.sh` to setup the dependencies


## Console

### Creating teachers and pupils

```bash
php artisan kileo:create-teacher "Alex Lanz" "alex" "password"
php artisan kileo:create-pupil "Marius Mössmer" "marius" "password"
```