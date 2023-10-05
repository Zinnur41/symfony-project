<?php

namespace App\Controller;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class WeatherController extends AbstractController
{
    #[Route('/', name: 'app_weather', methods: 'GET')]
    public function index(): Response
    {
        return $this->render('weather/weatherMainPage.html.twig');
    }

    #[Route('/getWeather', name: 'get_weather', methods: 'POST')]
    public function getWeather(): Response
    {
        define("App\Controller\apiKey", '2ec895ba8bc944068c3210514232909');

        define("App\Controller\URL", 'http://api.weatherapi.com/v1/forecast.json');

        $params = [
            'query' => [
                'key' => apiKey,
                'q' => $_POST['cityName'],
                'days' => $_POST['option']
            ]
        ];

        $client = new Client();
        $response = $client->get(URL, $params);
        $contents = $response->getBody()->getContents();
        $array_contents = json_decode($contents, true);
        return $this->render('weather/showWeather.html.twig', ['weather_array' => $array_contents,
            'days' => $params['query']['days']]);
    }
}
