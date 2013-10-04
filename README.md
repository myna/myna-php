myna-php
========

A [Myna](http://mynaweb.com/) client for PHP 5.3+

## Testing

There is a [Vagrant](http://vagrantup.com/) configuration for testing.

- Install Ansible: `pip install ansible`
- Run Vagrant: `vagrant up`

You now have a box with PHP installed, ready to use and abuse.

To run the tests:

- `vagrant ssh`
- `cd /vagrant`
- `./bin/phpspec run`
