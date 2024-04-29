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
        $rs = Database::getInstance()
            ->query('SELECT * FROM tl_inn_testimonials ORDER BY id');

        $this->Template->projects = $rs->fetchAllAssoc();
    }

}
class_alias(TestimonialForm::class, 'TestimonialForm');
