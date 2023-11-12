FROM webdevops/php-nginx:8.2
RUN apt update && apt install -y mc nano dos2unix
RUN echo date.timezone = "Europe/Budapest" >> /opt/docker/etc/php/php.ini
RUN echo allow_url_fopen = 1 >> /opt/docker/etc/php/php.ini
RUN echo display_startup_errors = 0 >> /opt/docker/etc/php/php.ini
COPY ./docker-entrypoint.sh /
RUN chmod +x /docker-entrypoint.sh

RUN wget -O "/usr/local/bin/go-replace" "https://github.com/webdevops/go-replace/releases/download/22.10.0/go-replace.linux.arm64" \
    && chmod +x "/usr/local/bin/go-replace" \
    && "/usr/local/bin/go-replace" --version

RUN apt-get install -y curl \
  && curl -sL https://deb.nodesource.com/setup_20.x | bash - \
  && apt-get install -y nodejs \
  && curl -L https://www.npmjs.com/install.sh | sh

# Add Yarn
RUN npm install -g yarn

COPY ../ /app
WORKDIR /app
EXPOSE 8080 5173
