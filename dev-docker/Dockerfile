FROM webdevops/php-nginx:8.2
RUN apt update && apt install -y mc nano dos2unix
RUN docker-php-ext-install opcache
RUN echo date.timezone = "Europe/Budapest" >> /opt/docker/etc/php/php.ini
RUN echo allow_url_fopen = 1 >> /opt/docker/etc/php/php.ini
RUN echo display_startup_errors = 0 >> /opt/docker/etc/php/php.ini
COPY ./docker-entrypoint.sh /
RUN chmod +x /docker-entrypoint.sh

RUN apt-get install -y curl \
  && curl -sL https://deb.nodesource.com/setup_20.x | bash - \
  && apt-get install -y nodejs \
  && curl -L https://www.npmjs.com/install.sh | sh

# Add Yarn
RUN npm install -g yarn

COPY ../ /app
WORKDIR /app
EXPOSE 8080 5173
