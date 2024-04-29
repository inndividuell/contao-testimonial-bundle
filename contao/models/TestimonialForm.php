<?php

namespace Inndividuell\ContaoTestimonialsBundle;


class TestimonialForm extends \Module
{
    /**
     * Template
     * @var string
     */
    protected $strTemplate = 'mod_inn_testimonial_form';

    /**
     * Compile the current element
     */
    protected function compile()
    {
        /** @var \Contao\Database\Result $rs */

    }

}
class_alias(TestimonialForm::class, 'TestimonialForm');
