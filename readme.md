# Shaftaloo!

## Installation

To run the project on your local machine:

```bash
$ git clone https://github.com/miladrahimi/shaftaloo
$ cd shaftaloo
$ cp .env.example .env
$ docker-compose up -d
$ docker-compose exec php composer install
$ docker-compose exec php php artisan migrate:refresh --seed
```

## Deployment

You can deploy the project via Ansible.

First create following files based on your server information:

* `extra/ansible/group_vars/all.yml`
* `extra/ansible/inventory/hosts`

Sample for `all.yml`:

```yaml
---
remote_dir: /var/www/shaftaloo
db_password: secret
```

And sample for `hosts`:

```
[defaults]
1.1.1.1
```

Then you can run the Ansible playbook this way:

```bash
$ cd extra/ansible
$ ansible-playbook deploy.yml
```

## License
[MIT License](http://opensource.org/licenses/mit-license.php)
