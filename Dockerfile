FROM ubuntu:latest

ENV TZ=Asia/Tokyo
RUN ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && echo $TZ > /etc/timezone

RUN apt update
RUN apt -y upgrade
RUN apt -y install vim
RUN apt -y install apache2 php libapache2-mod-php
RUN apt -y install php-fpm php-common php-mbstring php-xmlrpc php-gd php-xml php-mysql php-cli php-zip php-curl php-imagick
RUN service apache2 restart

COPY file/fqdn.conf /etc/apache2/conf-available/
RUN a2enconf fqdn
RUN service apache2 restart