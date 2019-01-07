<?php

namespace ABC\Containers;

use Plenty\Plugin\Templates\Twig;

class ABCContainer
{
    public function call(Twig $twig):string
    {
        return $twig->render('ABC::Stylesheet');
    }
}