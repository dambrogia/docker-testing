FROM php:7.2-rc-fpm-alpine3.6
MAINTAINER Dominic Dambrogia <domdambrogia@gmail.com>

RUN apk update; \
    apk upgrade;

# For easy navigating add oh my zsh and it's deps
RUN apk -q add curl \
    zsh \
    git; \
    sh -c "$(curl -fsSL https://raw.githubusercontent.com/robbyrussell/oh-my-zsh/master/tools/install.sh)"; \
    sed -i s^ZSH_THEME=\"robbyrussell\"^ZSH_THEME=\"blinks\"^g ~/.zshrc;

# Any PHP Configs in the php.ini file can be found here. Example:
# RUN sed -i "s/short_open_tag = Off/short_open_tag = On/" /etc/php/7.0/apache2/php.ini
# RUN sed -i "s/error_reporting = .*$/error_reporting = E_ERROR | E_WARNING | E_PARSE/" /etc/php/7.0/apache2/php.ini

# Add our docker.apache.conf file to bottom of the main apache configuration
# Copy backup of original to tmp, append ours and replace .conf file.
