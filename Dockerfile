FROM milinddocker/clinic:clinic-image
MAINTAINER Milind Chavan <milindchavan.24@gmail.com>
COPY . /var/www/html/

RUN chown -R www-data:www-data /var/www/html/
RUN chmod 755 -R /var/www/html/

COPY 000-default.conf /etc/apache2/sites-available/

RUN a2ensite /etc/apache2/sites-available/000-default.conf

RUN service apache2 restart

EXPOSE 80

CMD ["/bin/bash"]

