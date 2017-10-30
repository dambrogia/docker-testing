Preface:

I had posted a stack overflow question and there seemed to be little documentation or explanation about how this separation of power works. I've decided to document this for future reference.

[See my question here](https://stackoverflow.com/questions/46997791/containerizing-apache-mysql-and-php-with-docker)

# Docker Testing

This is a very small proof of concept for running a docker environment.

This test environment contains the following separate containers working together:
- php:7.1-fpm-alpine
- httpd:2.4-alpine
- mysql:5.6

There is also an nginx section commented out in the docker-compose file that can be interchanged with apache.

For more info please see `docker-compose.yml`

## To get started

Setup a hostfile that points `127.0.0.1` to `docker.dev`

    docker-compose up -d
    
Visit `docker.dev` in your browser.

_Please wait up to 60 seconds for the MySQL service to be available to connect to!_

## Problems and their resolutions

#### Apache
First and foremost, the biggest problem was getting apache to run PHP files rather than display their source code. Because Apache and PHP are running in separate containers we couldn't _simply_ have apache call PHP to render the files.

The answer to this was to to use PHP FPM which will accept incoming requests. We proxy our Apache requests to PHP FPM. You can find this direct setting [here](https://github.com/dambrogia/docker-testing/blob/master/.setup/apache/docker.apache.conf#L19).

I found out this was possible in nginx first - [docs here](http://geekyplatypus.com/dockerise-your-php-application-with-nginx-and-php7-fpm/)

And then I applied what I found in nginx to Apache through some help [here](https://stackoverflow.com/questions/41306112/why-cant-apache-communicate-with-php-fpm-in-separate-containers-using-docker-fo).

### PHP
After being able to run PHP files through apache the next error I ran into was that I was missing the MySQL extension for PHP. Because we're using lightweight alpine linux distros, we can't simply add php extensions through `yum` or `apt` or event `apk` (alpines package manager). After a while of googling my fingers off I found out that docker has a solution for this. You can see it in action [here](https://github.com/dambrogia/docker-testing/blob/master/.setup/php/Dockerfile#L7), and that link also includes commentary to where I stumbled across the solution.

### MySQL
Finally, now that I can run MySQL functions in PHP. Of course I run into my last problem - the good ol' `connection refused` error. I knew that my credentials were valid because through port forwarding I could connect with a MySQL GUI. I googled my fingers off for a few minutes and came across a networking concept within Docker that I wasn't aware of of. [This stackoverflow answer](https://stackoverflow.com/questions/37363705/connect-to-mysql-database-from-docker-container#37380350) states that along with networking your PHP & MySQL services, you want to declare your MySQL host as the name of your MySQL service. You can see related aspects in [index.php](https://github.com/dambrogia/docker-testing/blob/master/public_html/index.php#L10) and [docker-compose.yml](https://github.com/dambrogia/docker-testing/blob/master/docker-compose.yml#L24)

If you have any Questions feel I skipped over an import detail, I'd be glad to elaborate.
