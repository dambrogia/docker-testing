FROM httpd:2.4-alpine
MAINTAINER Dominic Dambrogia <domdambrogia@gmail.com>

RUN apk update; \
    apk upgrade;

# For easy navigating add oh my zsh and it's deps
RUN apk -q add curl \
    zsh \
    git; \
    sh -c "$(curl -fsSL https://raw.githubusercontent.com/robbyrussell/oh-my-zsh/master/tools/install.sh)"; \
    sed -i s^ZSH_THEME=\"robbyrussell\"^ZSH_THEME=\"blinks\"^g ~/.zshrc;

# Add our docker.apache.conf file to bottom of the main apache configuration
# Copy backup of original to tmp, append ours and replace .conf file.

RUN touch /tmp/new_apache.conf; \
    cat /usr/local/apache2/conf/original/httpd.conf > /tmp/new_apache.conf; \
    echo "Include /usr/local/apache2/conf.d/docker.apache.conf" >> /tmp/new_apache.conf; \
    mv /tmp/new_apache.conf /usr/local/apache2/conf/httpd.conf;
