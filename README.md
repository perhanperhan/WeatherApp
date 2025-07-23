# WeatherApp

docker build -t weather-app .
docker run -d -p 8000:8000 -v $(pwd):/app weather-app

curl -H "Authorization: Bearer your-token" http://localhost:8000/get-all-stations
curl -H "Authorization: Bearer your-token" -X POST -d "station_id=RIDAGDA" http://localhost:8000/get-station-by-id
