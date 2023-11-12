FROM webdevops/php-nginx:8.2
ARG version
ENV WEB_DOCUMENT_ROOT="/app/public"

RUN wget -O "/usr/local/bin/go-replace" "https://github.com/webdevops/go-replace/releases/download/22.10.0/go-replace.linux.arm64" \
    && chmod +x "/usr/local/bin/go-replace" \
    && "/usr/local/bin/go-replace" --version

RUN apt-get install -y curl \
  && curl -sL https://deb.nodesource.com/setup_20.x | bash - \
  && apt-get install -y nodejs \
  && curl -L https://www.npmjs.com/install.sh | sh

# Add Yarn
RUN npm install -g yarn

RUN chown -R application:application /app
EXPOSE 80 5173
