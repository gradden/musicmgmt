FROM webdevops/php-nginx:8.2
RUN echo date.timezone = "Europe/Budapest" >> /opt/docker/etc/php/php.ini
RUN echo allow_url_fopen = 1 >> /opt/docker/etc/php/php.ini
RUN echo display_startup_errors = 0 >> /opt/docker/etc/php/php.ini
COPY ./docker-entrypoint.sh /
RUN chmod +x /docker-entrypoint.sh

COPY ../ /app
WORKDIR /app
RUN wget -O "/usr/local/bin/go-replace" "https://github.com/webdevops/goreplace/releases/download/1.1.2/gr-arm64-linux"
RUN chmod +x "/usr/local/bin/go-replace"
RUN "/usr/local/bin/go-replace" --version
EXPOSE 8080
