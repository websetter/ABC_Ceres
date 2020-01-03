<?php

namespace ABC\Providers;

use Plenty\Plugin\ServiceProvider;
use Plenty\Plugin\Events\Dispatcher;
use Plenty\Plugin\Templates\Twig;
use IO\Helper\TemplateContainer;
use IO\Helper\ComponentContainer;
use IO\Extensions\Functions\Partial;
use Plenty\Plugin\ConfigRepository;
use ABC\Contexts\MyContext;
use IO\Services\ItemSearch\Helper\ResultFieldTemplate;

/**
 * Class ABCServiceProvider
 * @package ABC\Providers
 */
class ABCServiceProvider extends ServiceProvider
{
    const PRIORITY = 0;

    public function register()
    {

    }

    public function boot(Twig $twig, Dispatcher $dispatcher, ConfigRepository $config)
    {

        $enabledOverrides = explode(", ", $config->get("ABC.templates.override"));

        $dispatcher->listen('IO.ResultFields.*', function(ResultFieldTemplate $templateContainer) {
            $templateContainer->setTemplates([ ResultFieldTemplate::TEMPLATE_LIST_ITEM => 'ABC::ResultFields.ListItem' ]);
        }, 0);



        // Override partials
        $dispatcher->listen('IO.init.templates', function (Partial $partial) use ($enabledOverrides)
        {

            $partial->set('head', 'Ceres::PageDesign.Partials.Head');
            $partial->set('header', 'Ceres::PageDesign.Partials.Header.Header');
            $partial->set('page-design', 'Ceres::PageDesign.PageDesign');
            $partial->set('footer', 'Ceres::PageDesign.Partials.Footer');

            if (in_array("head", $enabledOverrides) || in_array("all", $enabledOverrides))
            {
                $partial->set('head', 'ABC::PageDesign.Partials.Head');
            }

            if (in_array("header", $enabledOverrides) || in_array("all", $enabledOverrides))
            {
                $partial->set('header', 'ABC::PageDesign.Partials.Header.Header');
            }

            if (in_array("page_design", $enabledOverrides) || in_array("all", $enabledOverrides))
            {
                $partial->set('page-design', 'ABC::PageDesign.PageDesign');
            }

            if (in_array("footer", $enabledOverrides) || in_array("all", $enabledOverrides))
            {
                $partial->set('footer', 'ABC::PageDesign.Partials.Footer');
            }

            return false;
        }, self::PRIORITY);

        $dispatcher->listen('IO.Component.Import', function(ComponentContainer $container){
          if( $container->getOriginComponentTemplate() == 'Ceres::Customer.Components.Contact.ContactForm')
          {
             $container->setNewComponentTemplate('ABC::Customer.Components.Contact.ContactForm');
          }
        }, 0);

        // Override homepage
        if (in_array("homepage", $enabledOverrides) || in_array("all", $enabledOverrides))
        {

            $dispatcher->listen('IO.tpl.home', function (TemplateContainer $container)
            {
                $container->setTemplate('ABC::Homepage.Homepage');
                return false;
            }, self::PRIORITY);
        }

        // Override template for content categories
        if (in_array("category_content", $enabledOverrides) || in_array("all", $enabledOverrides))
        {

            $dispatcher->listen('IO.tpl.category.content', function (TemplateContainer $container)
            {
                $container->setTemplate('ABC::Category.Content.CategoryContent');
                return false;
            }, self::PRIORITY);
        }

        // Override template for item categories
        if (in_array("category_view", $enabledOverrides) || in_array("all", $enabledOverrides))
        {

            $dispatcher->listen('IO.tpl.category.item', function (TemplateContainer $container)
            {
                $container->setTemplate('ABC::Category.Item.CategoryItem');
                return false;
            }, self::PRIORITY);
        }

        // Override shopping cart
        if (in_array("basket", $enabledOverrides) || in_array("all", $enabledOverrides))
        {

            $dispatcher->listen('IO.tpl.basket', function (TemplateContainer $container)
            {
                $container->setTemplate('ABC::Basket.Basket');
                return false;
            }, self::PRIORITY);
        }

        // Override checkout
        if (in_array("checkout", $enabledOverrides) || in_array("all", $enabledOverrides))
        {

            $dispatcher->listen('IO.tpl.checkout', function (TemplateContainer $container)
            {
                $container->setTemplate('ABC::Checkout.CheckoutView');
                return false;
            }, self::PRIORITY);
        }

        // Override order confirmation page
        if (in_array("order_confirmation", $enabledOverrides) || in_array("all", $enabledOverrides))
        {

            $dispatcher->listen('IO.tpl.confirmation', function (TemplateContainer $container)
            {
                $container->setTemplate('ABC::Checkout.OrderConfirmation');
                return false;
            }, self::PRIORITY);
        }

        // Override login page
        if (in_array("login", $enabledOverrides) || in_array("all", $enabledOverrides))
        {

            $dispatcher->listen('IO.tpl.login', function (TemplateContainer $container)
            {
                $container->setTemplate('ABC::Customer.Login');
                return false;
            }, self::PRIORITY);
        }

        // Override register page
        if (in_array("register", $enabledOverrides) || in_array("all", $enabledOverrides))
        {

            $dispatcher->listen('IO.tpl.register', function (TemplateContainer $container)
            {
                $container->setTemplate('ABC::Customer.Register');
                return false;
            }, self::PRIORITY);
        }

        // Override single item page
        if (in_array("item", $enabledOverrides) || in_array("all", $enabledOverrides))
        {

            $dispatcher->listen('IO.tpl.item', function (TemplateContainer $container)
            {
                $container->setTemplate('ABC::Item.SingleItemWrapper');
                return false;
            }, self::PRIORITY);
        }

        // Override search view
      if (in_array("search", $enabledOverrides) || in_array("all", $enabledOverrides))
      {

          $dispatcher->listen('IO.tpl.search', function (TemplateContainer $container)
          {
              $container->setTemplate('ABC::Category.Item.CategoryItem');
              return false;
          }, self::PRIORITY);
      }

        // Override my account
        if (in_array("my_account", $enabledOverrides) || in_array("all", $enabledOverrides))
        {

            $dispatcher->listen('IO.tpl.my-account', function (TemplateContainer $container)
            {
                $container->setTemplate('ABC::MyAccount.MyAccount');
                return false;
            }, self::PRIORITY);
        }

        // Override wish list
        if (in_array("wish_list", $enabledOverrides) || in_array("all", $enabledOverrides))
        {

            $dispatcher->listen('IO.tpl.wish-list', function (TemplateContainer $container)
            {
                $container->setTemplate('ABC::WishList.WishListView');
                return false;
            }, self::PRIORITY);
        }

        // Override contact page
      if (in_array("contact", $enabledOverrides) || in_array("all", $enabledOverrides))
      {

          $dispatcher->listen('IO.tpl.contact', function (TemplateContainer $container)
          {
              $container->setTemplate('ABC::Customer.Contact');
              return false;
          }, self::PRIORITY);
      }

      // Override order return view
        if (in_array("order_return", $enabledOverrides) || in_array("all", $enabledOverrides))
        {

            $dispatcher->listen('IO.tpl.order.return', function (TemplateContainer $container)
            {
                $container->setTemplate('ABC::OrderReturn.OrderReturnView');
                return false;
            }, self::PRIORITY);
        }

        // Override order return confirmation
        if (in_array("order_return_confirmation", $enabledOverrides) || in_array("all", $enabledOverrides))
        {

            $dispatcher->listen('IO.tpl.order.return.confirmation', function (TemplateContainer $container)
            {
                $container->setTemplate('ABC::OrderReturn.OrderReturnConfirmation');
                return false;
            }, self::PRIORITY);
        }

        // Override cancellation rights
        if (in_array("cancellation_rights", $enabledOverrides) || in_array("all", $enabledOverrides))
        {

            $dispatcher->listen('IO.tpl.cancellation-rights', function (TemplateContainer $container)
            {
                $container->setTemplate('ABC::StaticPages.CancellationRights');
                return false;
            }, self::PRIORITY);
        }

        // Override legal disclosure
        if (in_array("legal_disclosure", $enabledOverrides) || in_array("all", $enabledOverrides))
        {

            $dispatcher->listen('IO.tpl.legal-disclosure', function (TemplateContainer $container)
            {
                $container->setTemplate('ABC::StaticPages.LegalDisclosure');
                return false;
            }, self::PRIORITY);
        }

        // Override privacy policy
        if (in_array("privacy_policy", $enabledOverrides) || in_array("all", $enabledOverrides))
        {

            $dispatcher->listen('IO.tpl.privacy-policy', function (TemplateContainer $container)
            {
                $container->setTemplate('ABC::StaticPages.PrivacyPolicy');
                return false;
            }, self::PRIORITY);
        }

        // Override terms and conditions
        if (in_array("terms_conditions", $enabledOverrides) || in_array("all", $enabledOverrides))
        {

            $dispatcher->listen('IO.tpl.terms-conditions', function (TemplateContainer $container)
            {
                $container->setTemplate('ABC::StaticPages.TermsAndConditions');
                return false;
            }, self::PRIORITY);
        }

        // Override item not found page
        if (in_array("item_not_found", $enabledOverrides) || in_array("all", $enabledOverrides))
        {

            $dispatcher->listen('IO.tpl.item-not-found', function (TemplateContainer $container)
            {
                $container->setTemplate('ABC::StaticPages.ItemNotFound');
                return false;
            }, self::PRIORITY);
        }

        // Override page not found page
        if (in_array("page_not_found", $enabledOverrides) || in_array("all", $enabledOverrides))
        {

            $dispatcher->listen('IO.tpl.page-not-found', function (TemplateContainer $container)
            {
                $container->setTemplate('ABC::StaticPages.PageNotFound');
                return false;
            }, self::PRIORITY);
        }
        // Override newsletter opt-out page
        if (in_array("newsletter_opt_out", $enabledOverrides) || in_array("all", $enabledOverrides))
        {

            $dispatcher->listen('IO.tpl.newsletter.opt-out', function (TemplateContainer $container)
            {
                $container->setTemplate('ABC::Newsletter.NewsletterOptOut');
                return false;
            }, self::PRIORITY);
        }

        $enabledResultFields = [];

        if(!empty($config->get("ABC.result_fields.override")))
        {
            $enabledResultFields = explode(", ", $config->get("ABC.result_fields.override"));
        }

        if(!empty($enabledResultFields))
        {
            $dispatcher->listen( 'IO.ResultFields.*', function(ResultFieldTemplate $templateContainer) use ($enabledResultFields)
            {
                $templatesToOverride = [];

                // Override list item result fields
                if (in_array("list_item", $enabledResultFields) || in_array("all", $enabledResultFields))
                {
                    $templatesToOverride[ResultFieldTemplate::TEMPLATE_LIST_ITEM] = 'ABC::ResultFields.ListItem';
                }

                // Override single item view result fields
                if (in_array("single_item", $enabledResultFields) || in_array("all", $enabledResultFields))
                {
                    $templatesToOverride[ResultFieldTemplate::TEMPLATE_SINGLE_ITEM] = 'ABC::ResultFields.SingleItem';
                }

                // Override basket item result fields
                if (in_array("basket_item", $enabledResultFields) || in_array("all", $enabledResultFields))
                {
                    $templatesToOverride[ResultFieldTemplate::TEMPLATE_BASKET_ITEM] = 'ABC::ResultFields.BasketItem';
                }

                // Override auto complete list item result fields
                if (in_array("auto_complete_list_item", $enabledResultFields) || in_array("all", $enabledResultFields))
                {
                    $templatesToOverride[ResultFieldTemplate::TEMPLATE_AUTOCOMPLETE_ITEM_LIST] = 'ABC::ResultFields.AutoCompleteListItem';
                }

                // Override category tree result fields
                if (in_array("category_tree", $enabledResultFields) || in_array("all", $enabledResultFields))
                {
                    $templatesToOverride[ResultFieldTemplate::TEMPLATE_CATEGORY_TREE] = 'ABC::ResultFields.CategoryTree';
                }

                $templateContainer->setTemplates($templatesToOverride);
            }, self::PRIORITY);
        }
    }
}
