<?php
namespace Syntro\SilverStripeElementalBootstrapTestimonialSection\Model;

use SilverStripe\Assets\Image;
use SilverStripe\Forms\TextareaField;
use SilverStripe\AssetAdmin\Forms\UploadField;
use Syntro\SilverStripeElementalBaseitems\Model\BaseItem;
use Syntro\SilverStripeElementalBootstrapTestimonialSection\Elements\TestimonialSection;
use Syntro\SilverStripeElementalBootstrapTestimonialSection\Elements\IllustratedTestimonialSection;

/**
 * Testimonial
 *
 * @author Matthias Leutenegger <hello@syntro.ch>
 */
class Testimonial extends BaseItem
{
    /**
     * @var string
     */
    private static $table_name = 'ElementalBootstrapTestimonial';

    /**
     * @var array
     */
    private static $db = [
        'Sort' => 'Int',
        'SubTitle' => 'Varchar(255)',
        'Quote' => 'Text',

    ];

    private static $default_sort = ['Sort' => 'ASC'];

    /**
     * @var array
     */
    private static $has_one = [
        'Section' => TestimonialSection::class,
        'Image' => Image::class,
    ];

    /**
     * @var array
     */
    private static $owns = [
        'Image'
    ];

    /**
     * @return FieldList
     */
    public function getCMSFields()
    {
        $this->beforeUpdateCMSFields(function ($fields) {
            /** @var FieldList $fields */
            $fields->removeByName([
                'Sort',
                'SectionID',
            ]);

            // Add Image Upload Field
            $fields->addFieldToTab(
                'Root.Main',
                $imageField = UploadField::create(
                    'Image',
                    'Image'
                )
            );
            $imageField->setFolderName('Uploads/Testimonials');

            // Add content field
            // $fields->addFieldToTab(
            //     'Root.Main',
            //     TextareaField::create(
            //         'Content',
            //         'Content'
            //     ),
            //     'CTALink'
            // );
        });

        return parent::getCMSFields();
    }

    /**
     * @param bool $includerelations
     * @return array
     */
    public function fieldLabels($includerelations = true)
    {
        $labels = parent::fieldLabels($includerelations);

        $labels['Title'] = _t(__CLASS__ . '.TitleLabel', 'Name');

        return $labels;
    }
}
