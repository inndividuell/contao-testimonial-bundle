<?php
namespace Inndividuell\ContaoTestimonialsBundle;



class TestimonialDisplay extends \Module
{
    /**
     * Template
     * @var string
     */
    protected $strTemplate = 'mod_inn_testimonial_display_default';

    /**
     * Compile the current element
     */
    protected function compile()
    {
        /** @var \Contao\Database\Result $rs */
        $rs = $this->Database->query('SELECT * FROM tl_inn_testimonials ORDER BY id');

        $this->Template->projects = $rs->fetchAllAssoc();

        if($this->inn_testimonials_display_template && $this->inn_testimonials_display_template != 'mod_inn_testimonial_display_default')
        {
            $this->Template = new \FrontendTemplate($this->inn_testimonials_display_template);
        }
        $this->Template->inn_display_fields = $this->inn_display_fields;
        $this->Template->inn_testimonials_show_featured_only = $this->inn_testimonials_show_featured_only;
        $this->Template->inn_count = $this->inn_count;
        $this->Template->inn_order_by_time = $this->inn_order_by_time;
        $this->Template->i_style = $this->i_style;

    }

}
class_alias(TestimonialDisplay::class, 'TestimonialDisplay');
