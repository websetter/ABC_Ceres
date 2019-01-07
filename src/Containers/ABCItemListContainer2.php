<?php

namespace ABC\Containers;

use Plenty\Plugin\Templates\Twig;

class ABCItemListContainer2
{
    public function call(Twig $twig, $arg):string
    {
        return $twig->render('ABC::Containers.ItemLists.ItemList2', ["item" => $arg[0]]);
    }
}