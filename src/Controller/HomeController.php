<?php
namespace App\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController
{
    #[Route('/{name}', name: 'home_page')]
    public function showMainPage(string $name)
    {
        return new Response("<html><body>Hello $name</body></html>");
    }
}
