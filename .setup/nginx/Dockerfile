FROM nginx:stable-alpine
MAINTAINER Dominic Dambrogia <domdambrogia@gmail.com>

RUN apk update; \
    apk upgrade;

# For easy navigating add oh my zsh and it's deps
RUN apk -q add curl \
    zsh \
    git; \
    sh -c "$(curl -fsSL https://raw.githubusercontent.com/robbyrussell/oh-my-zsh/master/tools/install.sh)"; \
    sed -i s^ZSH_THEME=\"robbyrussell\"^ZSH_THEME=\"blinks\"^g ~/.zshrc;
