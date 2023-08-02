FROM php:8.2-cli

COPY . .

RUN

CMD ["php", "bin/console", "import", "filepath"]