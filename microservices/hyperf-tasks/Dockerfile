FROM hyperf/hyperf:8.2-alpine-v3.18-swoole

WORKDIR /opt/www
COPY . .
RUN composer install --no-dev -o
EXPOSE 9501
CMD ["php", "bin/hyperf.php", "start"]
