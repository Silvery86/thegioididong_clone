#! /bin/bash  
COPY /var/www/html/blue-dashboard/storage/test1.blue-dashboard.com.conf /etc/apache2/sites-available/test1.blue-dashboard.com.conf
RUN a2ensite test1.blue-dashboard.com.conf
RUN service apache2 restart