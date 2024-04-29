<?php
use Inndividuell\ContaoTestimonialsBundle\TestimonialDisplay;
use Inndividuell\ContaoTestimonialsBundle\TestimonialForm;
/**
 * Back end modules
 */
$GLOBALS['BE_MOD']['content']['testimonials'] = array(
    'tables' => array('tl_inn_testimonials'),
    'icon'   => 'system/modules/perisoft_bereiche/assets/images/bereiche.png'
);
//$GLOBALS['BE_MOD']['content']['project_types'] = array(
//    'tables' => array('tl_project_types'),
//    'icon'   => 'system/modules/perisoft_bereiche/assets/images/bereiche.png'
//);

/**
 * Front end modules
 */
$GLOBALS['FE_MOD']['inn_testimonial_form'] = array
(
    'inn_testimonial_form'     => TestimonialForm::class,
    'inn_testimonial_display'     => TestimonialDisplay::class,
);

if(Input::post('inn_testimonial') == 1) {
    $GLOBALS['TL_HOOKS']['initializeSystem'][] = array('Inndividuell\Testimonial', 'sendTestimonial');
}
//$GLOBALS['TL_HOOKS']['getContentElement'][] = array('LinkedElement', 'modifyElement');
