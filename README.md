# Template_docker_php_8.1
- Template docker PHP 8.1 Apache

### Requirements
---

- PHP 8.1
- Symfony 6.3 
- Apache 2.4
- MySQL 5.7
- Composer 2

### Usage
---

### Installation
---

```
git clone https://github.com/Jonathanlight/template_docker_php_8.1.git
$ cd template_docker_php_8

# build docker containers
$ make docker-build

# or start docker containers
$ make docker-run

# install dependencies
$ make docker-exec apache bash
$ composer install
```

### Installation SSl
---
```
cd docker/etc/apache/ssl/

openssl req -x509 -out server.crt -keyout server.key \
-newkey rsa:2048 -nodes -sha256 \
-subj '/CN=localhost' -extensions EXT -config <( \
printf "[dn]\nCN=localhost\n[req]\ndistinguished_name = dn\n[EXT]\nsubjectAltName=DNS:localhost\nkeyUsage=digitalSignature\nextendedKeyUsage=serverAuth")
```

### Configuration
---

### Deployment
---

### Authors
---

- Jonathan KABLAN

