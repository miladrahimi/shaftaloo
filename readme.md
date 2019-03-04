# Shaftaloo!
Shaftaloo is a simple cost accounting web (backend + PWA) application.

## Installation

To install the project on your machine:

```bash
$ git clone https://github.com/miladrahimi/shaftaloo
$ cd shaftaloo
$ cp .env.example .env
$ docker-compose up -d
```

## Deployment

You can deploy the project via Ansible.

First create following files based on your server information:
* `extra/ansible/group_vars/all.yml`
* `extra/ansible/inventory/hosts`

Sample for `all.yml`:

```yaml
---
remote_dir: /var/apps/shaftaloo
db_password: secret
```

Sample for `hosts`:

```
[defaults]
1.1.1.1
```

Then you can run the Ansible playbook this way:

```bash
$ cd extra/ansible
$ ansible-playbook deploy.yml
```

## Getting Started

To create a sample user you can run seed:

```bash
php artisan db:seed
```

Then visit the app url in your web browser and
sign in with the displayed credentials.

## License
[MIT License](http://opensource.org/licenses/mit-license.php)
