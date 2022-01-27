<?php

declare(strict_types=1);

namespace app\controllers;

use app\core\Controller;

class SiteController extends Controller
{
    public function home()
    {
        $params['name'] = 'DiwadEK';
        echo $this->render('home', $params);
    }

    public function contact()
    {
        echo $this->render('contact');
    }

    public function handleContact()
    {
        return 'Handling post request';
    }
}
