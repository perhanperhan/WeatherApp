FROM php:8.3-cli
WORKDIR /WeatherApp
EXPOSE 8000
CMD ["php", "-S", "0.0.0.0:8000", "index.php"]