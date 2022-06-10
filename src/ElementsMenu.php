<?php
namespace Arillo\Elements\Menu;

use Arillo\Elements\ElementBase;
use TractorCow\Fluent\Extension\FluentVersionedExtension;

/**
 * Add this trait to any SiteTree or ContentController class,
 * where you want to use inpage menus.
 *
 * With $elements_menu_relationname config variable,
 * the relation name the elements you added inpage menu capabilities.
 * It defaults to 'Elements'.
 *
 * @package Arillo\Elements
 * @subpackage Arillo\Elements\Menu
 * @author <bumbus sf@arillo.net>
 */
trait ElementsMenu
{
    public function getElementsMenuItems()
    {
        if ($this->config()->disable_elements_menu) {
            return null;
        }

        $relationName =
            $this->config()->elements_menu_relationname ?? 'Elements';

        $elements = $this->ElementsByRelation($relationName)->filter(
            'ShowInMenu',
            true
        );

        if (ElementBase::has_extension(FluentVersionedExtension::class)) {
            $elements = $elements->filterByCallback(function ($e) {
                return $e->isPublishedInLocale($e->Locale);
            });
        }

        return $elements;
    }
}
