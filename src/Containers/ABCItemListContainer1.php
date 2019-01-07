<?php

namespace ABC\Containers;

use Plenty\Plugin\Templates\Twig;

class ABCItemListContainer1
{
    public function call(Twig $twig, $arg):string
    {
        return $twig->render('ABC::Containers.ItemLists.ItemList1', ["item" => $arg[0]]);
    }
}