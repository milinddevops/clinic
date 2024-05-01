FROM php:5.6-apache
MAINTAINER Milind Chavan <milindchavan.24@gmail.com>

RUN docker-php-ext-install mysql

COPY . /var/www/html/
COPY default-cnf.conf /etc/apache2/sites-available/000-default.conf
WORKDIR /var/www/html
RUN mkdir ./Interfaces/Templates/templates_c
RUN chown -R www-data:www-data /var/www/html/
RUN chmod 755 -R /var/www/html/

RUN ls -lart



RUN a2ensite 000-default.conf

EXPOSE 80

# CMD ["/bin/bash"]
CMD ["apachectl", "-D", "FOREGROUND"]