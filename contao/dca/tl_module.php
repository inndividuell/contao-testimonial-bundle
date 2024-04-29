<?php

/**
 * dlh_googlemaps
 * Extension for Contao Open Source CMS (contao.org)
 *
 * Copyright (c) 2014 de la Haye
 *
 * @package dlh_googlemaps
 * @author  Christian de la Haye
 * @link    http://delahaye.de
 * @license http://www.gnu.org/licenses/lgpl-3.0.html LGPL
 */


/**
 * add palettes
 */
$GLOBALS['TL_DCA']['tl_module']['palettes']['inn_testimonial_form'] =
    '{title_legend},name,headline,type;{testimonial_options},inn_test,inn_fields,inn_use_stars,inn_show_starnumber,inn_return_text,inn_notification;{protected_legend:hide},protected;{expert_legend:hide},guests,cssID,space';
$GLOBALS['TL_DCA']['tl_module']['palettes']['inn_testimonial_display'] =
    '{title_legend},name,headline,type;{testimonial_options},inn_count,inn_display_fields,inn_use_stars,inn_show_starnumber,inn_order_by_time,inn_testimonials_show_featured_only,inn_testimonials_display_template;{protected_legend:hide},protected;{expert_legend:hide},guests,cssID,space';

//
///**
// * add subpalettes
// */
//
//$GLOBALS['TL_DCA']['tl_module']['subpalettes']['dlh_googlemap_static'] = 'dlh_googlemap_url,dlh_googlemap_target,dlh_googlemap_linkTitle,dlh_googlemap_rel';
//$GLOBALS['TL_DCA']['tl_module']['subpalettes']['dlh_googlemap_protected'] = 'dlh_googlemap_privacy';


/**
 * add fields
 */

$GLOBALS['TL_DCA']['tl_module']['fields']['inn_count'] = [
    'label' => &$GLOBALS['TL_LANG']['tl_module']['inn_count'],
    'exclude' => true,
    'inputType' => 'text',
    'eval' => ['mandatory' => true],
    'sql' => "varchar NULL default '0'",
];

$GLOBALS['TL_DCA']['tl_module']['fields']['inn_fields'] = [
    'label' => &$GLOBALS['TL_LANG']['tl_module']['inn_fields'],
    'exclude' => true,
    'inputType' => 'select',

    'eval' => [
        'mandatory' => true,
        'multiple' => true,
    ],
    'options' => array(
        'anrede' => 'Anrede',
        'name' => 'Name',
        'phone' => 'Telefonnummer',
        'company' => 'Firma',
        'position' => 'Position',
        'location' => 'Ort',
        'title' => 'Bewertungstitel',
        'text' => 'Nachricht',
        'rating' => 'Sterne/Bewertung'
    ),
    'sql' => "varchar NULL default '0'",
];$GLOBALS['TL_DCA']['tl_module']['fields']['inn_display_fields'] = [
    'label' => &$GLOBALS['TL_LANG']['tl_module']['inn_display_fields'],
    'exclude' => true,
    'inputType' => 'select',

    'eval' => [
        'mandatory' => true,
        'multiple' => true,
    ],
    'options' => array(
        'name' => 'Name',
        'company' => 'Firma',
        'position' => 'Position',
        'location' => 'Ort',
        'title' => 'Bewertungstitel',
        'text' => 'Nachricht',
        'rating' => 'Sterne/Bewertung'
    ),
    'sql' => "varchar NULL default '0'",
];
$GLOBALS['TL_DCA']['tl_module']['fields']['inn_use_stars'] = [
    'label' => &$GLOBALS['TL_LANG']['tl_module']['inn_use_stars'],
    'exclude' => true,
    'inputType' => 'checkbox',
    'sql'       => "varchar NOT NULL default '10'",
];
$GLOBALS['TL_DCA']['tl_module']['fields']['inn_show_starnumber'] = [
    'label' => &$GLOBALS['TL_LANG']['tl_module']['inn_show_starnumber'],
    'exclude' => true,
    'inputType' => 'checkbox',
    'sql'       => "varchar NOT NULL default '10'",
];

$GLOBALS['TL_DCA']['tl_module']['fields']['inn_return_text'] = [
    'label' => &$GLOBALS['TL_LANG']['tl_module']['inn_return_text'],
    'exclude' => true,
    'inputType' => 'text',
    'eval' => [
        'mandatory' => true,
        'rte' => 'tinyMCE'
        ],
    'sql' => "varchar NULL",
];
$GLOBALS['TL_DCA']['tl_module']['fields']['inn_notification'] = [
    'label' => &$GLOBALS['TL_LANG']['tl_module']['inn_notification'],
    'exclude' => true,
    'inputType' => 'radio',
    'foreignKey'       => 'tl_nc_notification.title',
    'eval' => [
        'mandatory' => false,
    ],
    'sql'       => "int(10) unsigned",
];

$GLOBALS['TL_DCA']['tl_module']['fields']['inn_order_by_time'] = [
    'label' => &$GLOBALS['TL_LANG']['tl_module']['inn_order_by_time'],
    'exclude' => true,
    'inputType' => 'checkbox',
    'sql'       => "varchar NOT NULL default '10'",
];
$GLOBALS['TL_DCA']['tl_module']['fields']['inn_testimonials_show_featured_only'] = [
    'label' => &$GLOBALS['TL_LANG']['tl_module']['inn_testimonials_show_featured_only'],
    'exclude' => true,
    'inputType' => 'radio',
    'options'=>array(
        'no-featured' => 'keine Einschränkung',
        'only-featured' => 'Zeige nur Hervorgehobene',
        'hide-featured' => 'Zeige Hervorgebene nicht'
    ),
    'sql'       => "varchar NULL",
];



$GLOBALS['TL_DCA']['tl_module']['fields']['inn_testimonials_display_template'] = [
    'label'            => &$GLOBALS['TL_LANG']['tl_module']['inn_testimonials_display_template'],
    'default'          => 'mod_inn_testimonial_display_default',
    'exclude'          => true,
    'inputType'        => 'select',
    'options_callback' => ['tl_module_inn_testimonial_display', 'getTemplates'],
    'eval'             => ['tl_class' => 'w50'],
    'sql'              => "varchar(64) NOT NULL default ''",
];

//$GLOBALS['TL_DCA']['tl_module']['fields']['dlh_googlemap_zoom'] = [
//    'label'     => &$GLOBALS['TL_LANG']['tl_module']['dlh_googlemap_zoom'],
//    'exclude'   => true,
//    'inputType' => 'select',
//    'options'   => ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12', '13', '14', '15', '16', '17', '18', '19', '20'],
//    'default'   => '10',
//    'eval'      => ['includeBlankOption' => true, 'tl_class' => 'w50'],
//    'sql'       => "int(10) unsigned NOT NULL default '10'",
//];
//
//$GLOBALS['TL_DCA']['tl_module']['fields']['dlh_googlemap_size'] = [
//    'label'     => &$GLOBALS['TL_LANG']['tl_module']['dlh_googlemap_size'],
//    'exclude'   => true,
//    'inputType' => 'imageSize',
//    'options'   => ['proportional','box'],
//    'reference' => &$GLOBALS['TL_LANG']['MSC'],
//    'eval'      => ['includeBlankOption' => true, 'rgxp' => 'digit', 'nospace' => true, 'helpwizard' => false, 'tl_class' => 'w50'],
//    'default'      => serialize(array(16,9,'proportional')),
//    'sql'       => "varchar(128) NOT NULL default ''",
//];
//
//$GLOBALS['TL_DCA']['tl_module']['fields']['dlh_googlemap_static'] = [
//    'label'     => &$GLOBALS['TL_LANG']['tl_module']['dlh_googlemap_static'],
//    'exclude'   => true,
//    'inputType' => 'checkbox',
//    'eval'      => ['submitOnChange' => true, 'tl_class' => 'clr m12'],
//    'sql'       => "char(1) NOT NULL default ''",
//];
//
//$GLOBALS['TL_DCA']['tl_module']['fields']['dlh_googlemap_nocss'] = [
//    'label'     => &$GLOBALS['TL_LANG']['tl_module']['dlh_googlemap_nocss'],
//    'exclude'   => true,
//    'inputType' => 'checkbox',
//    'eval'      => ['tl_class' => 'clr m12'],
//    'sql'       => "char(1) NOT NULL default ''",
//];
//
//$GLOBALS['TL_DCA']['tl_module']['fields']['dlh_googlemap_tabs'] = [
//    'label'     => &$GLOBALS['TL_LANG']['tl_module']['dlh_googlemap_tabs'],
//    'exclude'   => true,
//    'inputType' => 'checkbox',
//    'eval'      => ['tl_class' => 'clr m12'],
//    'sql'       => "char(1) NOT NULL default ''",
//];
//
//$GLOBALS['TL_DCA']['tl_module']['fields']['dlh_googlemap_url'] = [
//    'label'     => &$GLOBALS['TL_LANG']['tl_module']['dlh_googlemap_url'],
//    'exclude'   => true,
//    'search'    => true,
//    'inputType' => 'text',
//    'eval'      => ['rgxp' => 'url', 'decodeEntities' => true, 'maxlength' => 255, 'tl_class' => 'w50 wizard'],
//    'wizard'    => [
//        ['tl_module_dlh_googlemaps', 'pagePicker'],
//    ],
//    'sql'       => "varchar(255) NOT NULL default ''",
//];
//
//$GLOBALS['TL_DCA']['tl_module']['fields']['dlh_googlemap_target'] = [
//    'label'     => &$GLOBALS['TL_LANG']['MSC']['target'],
//    'exclude'   => true,
//    'inputType' => 'checkbox',
//    'eval'      => ['tl_class' => 'w50 m12'],
//    'sql'       => "char(1) NOT NULL default ''",
//];
//
//$GLOBALS['TL_DCA']['tl_module']['fields']['dlh_googlemap_linkTitle'] = [
//    'label'     => &$GLOBALS['TL_LANG']['tl_content']['linkTitle'],
//    'exclude'   => true,
//    'search'    => true,
//    'inputType' => 'text',
//    'eval'      => ['maxlength' => 255, 'tl_class' => 'w50'],
//    'sql'       => "varchar(255) NOT NULL default ''",
//];
//
//$GLOBALS['TL_DCA']['tl_module']['fields']['dlh_googlemap_rel'] = [
//    'label'     => &$GLOBALS['TL_LANG']['tl_content']['rel'],
//    'exclude'   => true,
//    'search'    => true,
//    'inputType' => 'text',
//    'eval'      => ['maxlength' => 64, 'tl_class' => 'w50'],
//    'sql'       => "varchar(64) NOT NULL default ''",
//];
//
//$GLOBALS['TL_DCA']['tl_module']['fields']['dlh_googlemap_protected'] = [
//    'label'     => &$GLOBALS['TL_LANG']['tl_content']['dlh_googlemap_protected'],
//    'exclude'   => true,
//    'default'   => false,
//    'inputType' => 'checkbox',
//    'default'   => '',
//    'eval'      => ['submitOnChange' => true, 'tl_class' => 'clr m12'],
//    'sql'       => "char(1) NOT NULL default ''",
//];
//
//$GLOBALS['TL_DCA']['tl_module']['fields']['dlh_googlemap_privacy'] = [
//    'label'       => &$GLOBALS['TL_LANG']['tl_content']['dlh_googlemap_privacy'],
//    'exclude'     => true,
//    'search'      => true,
//    'inputType'   => 'textarea',
//    'eval'        => ['rte' => 'tinyMCE', 'helpwizard' => true],
//    'explanation' => 'insertTags',
//    'sql'         => "text NULL",
//];



class tl_module_inn_testimonial_display extends Backend
{

    /**
     * Return all templates as array
     *
     * @return array
     */
    public function getTemplates()
    {
        return $this->getTemplateGroup('mod_inn_testimonial_display');
    }

}
