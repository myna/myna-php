myna-php
========

A [Myna](http://mynaweb.com/) client for PHP 5.3+. See [here](http://help.mynaweb.com/php).

## Documentation

Full documentation is on [the Myna site](http://help.mynaweb.com/php).

## Testing

There is a [Vagrant](http://vagrantup.com/) configuration for testing.

- Install Ansible: `pip install ansible`
- Run Vagrant: `vagrant up`

You now have a box with PHP installed, ready to use and abuse.

To run the tests:

- `vagrant ssh`
- `cd /vagrant`
- `./bin/phpspec run`

### Troubleshooting

Vagrant is not very reliable. Different versions of Vagrant and Virtualbox work together more or less well. If you cannot run the ansible deployment successfully, the following command will do so manually. You must have the VM running first (via `vagrant up`).

`ansible-playbook --inventory-file ./vagrant_ansible_inventory_default playbook.yml -u vagrant --private-key ~/.vagrant.d/insecure_private_key`

If you have a SSH error it is usually an out-of-date entry in `~/.ssh/known_hosts`.

`ansible all --inventory-file ./vagrant_ansible_inventory_default -m ping -vvvv -u vagrant --private-key ~/.vagrant.d/insecure_private_key`
