<?php

namespace ABC\Containers;

use Plenty\Plugin\Templates\Twig;

class ABCItemListContainer3
{
    public function call(Twig $twig, $arg):string
    {
        return $twig->render('ABC::Containers.ItemLists.ItemList3', ["item" => $arg[0]]);
    }
}