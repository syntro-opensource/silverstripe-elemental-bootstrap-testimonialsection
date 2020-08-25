<?php

namespace Syntro\SilverStripeElementalBootstrapTestimonialSection\Elements;

use SilverStripe\Forms\DropdownField;
use SilverStripe\ORM\FieldType\DBField;
use SilverStripe\ORM\FieldType\DBHTMLText;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\GridField\GridField;
use SilverStripe\Forms\GridField\GridFieldAddExistingAutocompleter;
use SilverStripe\Forms\GridField\GridFieldDeleteAction;
use Symbiote\GridFieldExtensions\GridFieldOrderableRows;
use Syntro\SilverStripeElementalBaseitems\Elements\BootstrapSectionBaseElement;
use Syntro\SilverStripeElementalBootstrapTestimonialSection\Model\Testimonial;


/**
 *  Bootstrap based Testimonial section
 *
 * @author Matthias Leutenegger <hello@syntro.ch>
 */
class TestimonialSection extends BootstrapSectionBaseElement
{

    private static $icon = 'elemental-icon-testimonial';
    /**
     * This defines the block name in the CSS
     *
     * @config
     * @var string
     */
    private static $block_name = 'testimonial-section';

    /**
     * @var bool
     */
    private static $inline_editable = false;

    private static $styles = [
        'default' => 'Default style',
    ];

    /**
     * @var string
     */
    // private static $icon = 'font-icon-attention';

    /**
     * @var string
     */
    private static $table_name = 'ElementTestimonialSection';

    /**
     * set to false if image option should not show up
     *
     * @config
     * @var bool
     */
    private static $allow_image_background = true;

    /**
     * Available background colors for this Element
     *
     * @config
     * @var array
     */
    private static $background_colors = [
        'default' => 'Default',
        'light' => 'Lightgrey',
        'dark' => 'Dark',
    ];

    private static $text_colors = [
        'default' => 'Default',
        'white' => 'White'
    ];

    /**
     * Color mapping from background color. This is mainly intended
     * to set a default color on the section-level, ensuring text is readable.
     * Colors of subelementscan be added via templates
     *
     * @config
     * @var array
     */
    private static $text_colors_by_background = [
        'light' => 'default',
        'dark' => 'light',
    ];

    private static $db = [
        'Content' => 'Text',
    ];

    private static $has_many = [
        'Testimonials' => Testimonial::class
    ];

    /**
     * @var array
     */
    private static $owns = [
        'Testimonials'
    ];

    /**
     * @return FieldList
     */
    public function getCMSFields()
    {
        $this->beforeUpdateCMSFields(function ($fields) {

            if ($this->ID) {
                /** @var GridField $testimonials */
                $testimonials = $fields->dataFieldByName('Testimonials');
                $testimonials->setTitle($this->fieldLabel('Testimonials'));

                $fields->removeByName('Testimonials');

                $config = $testimonials->getConfig();
                $config->addComponent(new GridFieldOrderableRows('Sort'));
                $config->removeComponentsByType(GridFieldAddExistingAutocompleter::class);
                $config->removeComponentsByType(GridFieldDeleteAction::class);

                $fields->addFieldToTab('Root.Main', $testimonials);
            }

        });

        return parent::getCMSFields();
    }

    /**
     * @return string
     */
    public function getSummary()
    {
        return DBField::create_field('HTMLText', $this->Content)->Summary(20);
    }

    /**
     * @return array
     */
    protected function provideBlockSchema()
    {
        $blockSchema = parent::provideBlockSchema();
        $blockSchema['content'] = $this->getSummary();
        return $blockSchema;
    }

    public function getType()
    {
        return _t(__CLASS__ . '.BlockType', 'Testimonial Section');
    }
}
