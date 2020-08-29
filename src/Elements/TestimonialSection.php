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

    private static $styles = [];

    /**
     * @var string
     */
    // private static $icon = 'font-icon-attention';

    /**
     * @var string
     */
    private static $table_name = 'ElementTestimonialSection';



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
     * fieldLabels - apply labels
     *
     * @param  boolean $includerelations = true
     * @return array
     */
    public function fieldLabels($includerelations = true)
    {
        $labels = parent::fieldLabels($includerelations);
        $labels['Testimonials'] = _t(__CLASS__ . '.TESTIMONIALS', 'Testimonials');
        $labels['Content'] = _t(__CLASS__ . '.CONTENT', 'Content');
        return $labels;
    }

    /**
     * @return FieldList
     */
    public function getCMSFields()
    {
        $this->beforeUpdateCMSFields(function ($fields) {

            $fields->dataFieldByName('Content')->setTitle($this->fieldLabel('Content'));

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
        return sprintf(
            '%s %s',
            _t(
                __CLASS__ . '.SUMMARY',
                'one testimonial from|{count} testimonials from',
                ['count' => $this->Testimonials()->count()]
            ),
            implode(', ', $this->Testimonials()->map('Title')->keys())
        );
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

    /**
     * getType
     *
     * @return string
     */
    public function getType()
    {
        return _t(__CLASS__ . '.BlockType', 'Testimonial Section');
    }
}
