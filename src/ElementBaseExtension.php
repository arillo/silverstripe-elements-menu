<?php
namespace Arillo\Elements\Menu;

use SilverStripe\ORM\DataExtension;

use SilverStripe\Forms\{
    FieldList,
    TextField,
    CheckboxField
};

use Arillo\Elements\ElementBase;
use Arillo\Elements\ElementURLSegmentField;

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
class ElementBaseExtension extends DataExtension
{
    private static
        $db = [
            'MenuTitle' => 'Text',
            'ShowInMenu' => 'Boolean',
        ]
    ;

    /**
     * Menu cms fields
     * @param ElementBase $record
     * @param FieldList   $fields
     * @param string      $insertAfter
     */
    public static function add_menu_fields(
        ElementBase $record,
        FieldList $fields,
        string $insertAfter = 'Title'
    ) {
        $holder = $record->owner->getHolder();
        if (
            is_a($holder, 'Page')
            && !$holder->config()->disable_elements_menu
        ) {
            $fields->insertAfter(
                TextField::create('MenuTitle', _t(ElementBase::class . '.MenuTitle', 'Menu title')),
                $insertAfter
            );

            $fields->insertAfter(
                ElementURLSegmentField::create('URLSegment', _t(ElementBase::class . '.URLSegment', 'Url-Segment')),
                $insertAfter
            );

            $fields->insertAfter(
                CheckboxField::create('ShowInMenu', _t(ElementBase::class . '.ShowInMenu', 'Show in menu')),
                $insertAfter
            );
        }
    }

    public function updateCMSFields(FieldList $fields)
    {
        self::add_menu_fields($this->owner, $fields);
        return $fields;
    }

    public function onBeforeWrite()
    {
        parent::onBeforeWrite();
        if (!$this->owner->MenuTitle) $this->owner->MenuTitle = $this->owner->Title;
    }
}
