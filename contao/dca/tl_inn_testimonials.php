<?php
use Contao\Automator;
use Contao\Backend;
use Contao\BackendUser;
use Contao\Config;
use Contao\CoreBundle\Exception\AccessDeniedException;
use Contao\CoreBundle\Security\ContaoCorePermissions;
use Contao\CoreBundle\Util\LocaleUtil;
use Contao\DataContainer;
use Contao\DC_Table;
use Contao\Idna;
use Contao\Image;
use Contao\Input;
use Contao\LayoutModel;
use Contao\Message;
use Contao\Messages;
use Contao\Model;
use Contao\PageModel;
use Contao\StringUtil;
use Contao\System;
use Contao\Versions;

/**
 * Table tl_inn_testimonials
 */
$GLOBALS['TL_DCA']['tl_inn_testimonials'] = array
(

    // Config
    'config'   => array
    (
        'dataContainer'    => 'Table',
        'enableVersioning' => true,
        'sql'              => array
        (
            'keys' => array
            (
                'id' => 'primary'
            )
        ),
    ),
    // List
    'list'     => array
    (
        'sorting'           => array
        (
            'mode'        => DataContainer::MODE_SORTED,
            'fields'      => array('tstamp'),
            'flag'        => 1,
            'panelLayout' => 'filter;sort,search,limit'
        ),
        'label'             => array
        (
            'fields' => array('name','company','rating'),
            'format' => '%s %s Bewertung: %s',
        ),
        'global_operations' => array
        (
            'all' => array
            (
                'label'      => &$GLOBALS['TL_LANG']['MSC']['all'],
                'href'       => 'act=select',
                'class'      => 'header_edit_all',
                'attributes' => 'onclick="Backend.getScrollOffset()" accesskey="e"'
            )
        ),
        'operations'        => array
        (
            'edit'   => array
            (
                'label' => &$GLOBALS['TL_LANG']['tl_inn_testimonials']['edit'],
                'href'  => 'act=edit',
                'icon'  => 'edit.gif'
            ),
            'copy'   => [
                'label' => &$GLOBALS['TL_LANG']['tl_dlh_googlemaps_elements']['copy'],
                'href'  => 'act=paste&amp;mode=copy',
                'icon'  => 'copy.gif',
            ],
            'delete' => array
            (
                'label'      => &$GLOBALS['TL_LANG']['tl_inn_testimonials']['delete'],
                'href'       => 'act=delete',
                'icon'       => 'delete.gif',
                'attributes' => 'onclick="if(!confirm(\'' . $GLOBALS['TL_LANG']['MSC']['deleteConfirm'] . '\'))return false;Backend.getScrollOffset()"'
            ),
            'show'   => array
            (
                'label'      => &$GLOBALS['TL_LANG']['tl_inn_testimonials']['show'],
                'href'       => 'act=show',
                'icon'       => 'show.gif',
                'attributes' => 'style="margin-right:3px"'
            ),
            'toggle' => [
                'label'           => &$GLOBALS['TL_LANG']['tl_inn_testimonials']['toggle'],
                'icon'            => 'visible.gif',
                'attributes'      => 'onclick="Backend.getScrollOffset(); return AjaxRequest.toggleVisibility(this, %s);"',
//                'button_callback' => ['tl_dlh_googlemaps_elements', 'toggleIcon'],
                'button_callback'     => array('tl_inn_testimonials', 'toggleIcon')
            ],
            'featured' => [
                'label'           => &$GLOBALS['TL_LANG']['tl_inn_testimonials']['featured'],
                'icon'            => 'featured.gif',
                'attributes'      => 'onclick="Backend.getScrollOffset(); return AjaxRequest.toggleFeatured(this, %s);"',
//                'button_callback' => ['tl_dlh_googlemaps_elements', 'toggleIcon'],
                'button_callback'     => array('tl_inn_testimonials', 'featureIcon')
            ],

        )
    ),
    // Palettes
    'palettes' => array
    (
        //'default'       => '{kundeninfos_legend},Vorname,Nachname,Zentrum_Schule,Kundennummer,E_Mail,Telefon,Strasse,PLZ,Ort,Land,type;{pruefunginfos_legend},Pruefungstermin,Teilnehmer,Kurs,Level,Speaking_Listening,Betreff,Nachricht,type;'
        'default'       => '{Testimonial},name,company,c_position,location,title,text,rating,date_added;'
    ),
    // Fields
    'fields'   => array
    (
        'id'     => array
        (
            'sql' => "int(10) unsigned NOT NULL auto_increment"
        ),
        'tstamp' => array
        (
            'sql' => "int(10) unsigned NOT NULL default '0'"
        ),
        'name'  => array
        (
            'label'     => &$GLOBALS['TL_LANG']['tl_inn_testimonials']['name'],
            'inputType' => 'text',
            'exclude'   => true,
            'sorting'   => true,
            'flag'      => 1,
            'search'    => true,
            'eval'      => array(
                'mandatory'   => true,
                'maxlength'   => 255,
                'tl_class'        => 'w100',

            ),
            'sql'       => "varchar(255) NOT NULL default ''"
        ),
        'email'  => array
        (
            'label'     => &$GLOBALS['TL_LANG']['tl_inn_testimonials']['email'],
            'inputType' => 'text',
            'exclude'   => true,
            'sorting'   => true,
            'flag'      => 1,
            'search'    => true,
            'eval'      => array(
                'maxlength'   => 255,
                'tl_class'        => 'w100',

            ),
            'sql'       => "varchar(255) NOT NULL default ''"
        ),
        'phone'  => array
        (
            'label'     => &$GLOBALS['TL_LANG']['tl_inn_testimonials']['phone'],
            'inputType' => 'text',
            'exclude'   => true,
            'sorting'   => true,
            'flag'      => 1,
            'search'    => true,
            'eval'      => array(
                'maxlength'   => 255,
                'tl_class'        => 'w100',

            ),
            'sql'       => "varchar(255) NOT NULL default ''"
        ),
        'company'  => array
        (
            'label'     => &$GLOBALS['TL_LANG']['tl_inn_testimonials']['company'],
            'inputType' => 'text',
            'exclude'   => true,
            'sorting'   => true,
            'flag'      => 1,
            'search'    => true,
            'eval'      => array(
                'maxlength'   => 255,
                'tl_class'        => 'w100',

            ),
            'sql'       => "varchar(255) NOT NULL default ''"
        ),
        'c_position'  => array
        (
            'label'     => &$GLOBALS['TL_LANG']['tl_inn_testimonials']['c_position'],
            'inputType' => 'text',
            'exclude'   => true,
            'sorting'   => true,
            'flag'      => 1,
            'search'    => true,
            'eval'      => array(
                'maxlength'   => 255,
                'tl_class'        => 'w100',

            ),
            'sql'       => "varchar(255) NOT NULL default ''"
        ),
        'location'  => array
        (
            'label'     => &$GLOBALS['TL_LANG']['tl_inn_testimonials']['location'],
            'inputType' => 'text',
            'exclude'   => true,
            'sorting'   => true,
            'flag'      => 1,
            'search'    => true,
            'eval'      => array(
                'maxlength'   => 255,
                'tl_class'        => 'w100',

            ),
            'sql'       => "varchar(255) NOT NULL default ''"
        ),
        'title'  => array
        (
            'label'     => &$GLOBALS['TL_LANG']['tl_project_types']['title'],
            'inputType' => 'text',
            'exclude'   => true,
            'sorting'   => true,
            'flag'      => 1,
            'search'    => true,
            'eval'      => array(
                'mandatory'   => true,
                'maxlength'   => 1024,
                'tl_class'        => 'w100',

            ),
            'sql'       => "varchar(1024) NOT NULL default ''"
        ),
        'text'  => array
        (
            'label'     => &$GLOBALS['TL_LANG']['tl_project_types']['text'],
            'inputType' => 'text',
            'exclude'   => true,
            'sorting'   => true,
            'flag'      => 1,
            'search'    => true,
            'eval'      => array(
                'mandatory'   => true,
                'maxlength'   => 1024,
                'tl_class'        => 'w100',
                'rte'          =>'tinyMCE'

            ),
            'sql'       => "varchar(1024) NOT NULL default ''"
        ),
        'rating'  => array
        (
            'label'     => &$GLOBALS['TL_LANG']['tl_project_types']['text'],
            'inputType' => 'select',
            'exclude'   => true,
            'sorting'   => true,
            'flag'      => 1,
            'search'    => true,#
            'options' => array(
                1 => '1',
                2 => '2',
                3 => '3',
                4 => '4',
                5 => '5',
            ),
            'eval'      => array(
                'mandatory'   => true,
                'maxlength'   => 1024,
                'tl_class'        => 'w100',
            ),
            'sql'       => "varchar(1024) NOT NULL default ''"
        ),
        'date_added'  => array
        (
            'label'     => &$GLOBALS['TL_LANG']['tl_inn_testimonials']['date_added'],
            'inputType' => 'text',
            'exclude'   => true,
            'sorting'   => true,
            'flag'      => 1,
            'search'    => true,
            'eval'      => array(
                'rgxp' => 'date',
                'datepicker' => true,
                'tl_class' => 'wizard',

            ),
            'sql' => "int(10) unsigned NULL"
        ),
        'published'  => array
        (
            'label'               => &$GLOBALS['TL_LANG']['tl_inn_testimonials']['published'],
            'exclude'             => true,
            'filter'              => true,
            'inputType'           => 'checkbox',
            'sql'                 => "char(1) NOT NULL default ''"
        ),
        'featured'  => array
        (
            'label'               => &$GLOBALS['TL_LANG']['tl_inn_testimonials']['featured'],
            'exclude'             => true,
            'filter'              => true,
            'inputType'           => 'checkbox',
            'sql'                 => "char(1) NOT NULL default ''"
        ),

    )
);


class tl_inn_testimonials extends \Backend
{

    /**
     * Import the back end user object
     */
    public function __construct()
    {
        parent::__construct();

        $this->import('BackendUser', 'User');

    }
    /**
     * Ändert das Aussehen des Toggle-Buttons.
     * @param $row
     * @param $href
     * @param $label
     * @param $title
     * @param $icon
     * @param $attributes
     * @return string
     */
    public function toggleIcon($row, $href, $label, $title, $icon, $attributes)
    {
        $this->import('BackendUser', 'User');

        if (strlen($this->Input->get('tid')))
        {
            $this->toggleVisibility($this->Input->get('tid'), ($this->Input->get('state') == 0));
            $this->redirect($this->getReferer());
        }

        // Check permissions AFTER checking the tid, so hacking attempts are logged
        if (!$this->User->isAdmin && !$this->User->hasAccess('tl_inn_testimonials::published', 'alexf'))
        {
            return '';
        }

        $href .= '&amp;id='.$this->Input->get('id').'&amp;tid='.$row['id'].'&amp;state='.$row[''];

        if (!$row['published'])
        {
            $icon = 'invisible.gif';
        }

        return '<a href="'.$this->addToUrl($href).'" title="'.specialchars($title).'"'.$attributes.'>'.$this->generateImage($icon, $label).'</a> ';
    }
    /**
     * Toggle the visibility of an element
     * @param integer
     * @param boolean
     */
    public function toggleVisibility($intId, $blnPublished)
    {
        // Check permissions to publish
        if (!$this->User->isAdmin && !$this->User->hasAccess('tl_inn_testimonials::published', 'alexf'))
        {
            $this->log('Not enough permissions to show/hide record ID "'.$intId.'"', 'tl_inn_testimonials toggleVisibility', TL_ERROR);
            $this->redirect('contao/main.php?act=error');
        }

        $this->createInitialVersion('tl_inn_testimonials', $intId);

        // Trigger the save_callback
        if (is_array($GLOBALS['TL_DCA']['tl_inn_testimonials']['fields']['published']['save_callback']))
        {
            foreach ($GLOBALS['TL_DCA']['tl_inn_testimonials']['fields']['published']['save_callback'] as $callback)
            {
                $this->import($callback[0]);
                $blnPublished = $this->$callback[0]->$callback[1]($blnPublished, $this);
            }
        }

        // Update the database
        $this->Database->prepare("UPDATE tl_inn_testimonials SET tstamp=". time() .", published='" . ($blnPublished ? '' : '1') . "' WHERE id=?")
            ->execute($intId);
        $this->createNewVersion('tl_inn_testimonials', $intId);
    }

    /**
     * Ändert das Aussehen des Toggle-Buttons.
     * @param $row
     * @param $href
     * @param $label
     * @param $title
     * @param $icon
     * @param $attributes
     * @return string
     */
    public function featureIcon($row, $href, $label, $title, $icon, $attributes)
    {
        $this->import('BackendUser', 'User');

        if (strlen($this->Input->get('tid')))
        {
            $this->toggleFeatured($this->Input->get('tid'), ($this->Input->get('state') == 0));
            $this->redirect($this->getReferer());
        }

        // Check permissions AFTER checking the tid, so hacking attempts are logged
        if (!$this->User->isAdmin && !$this->User->hasAccess('tl_inn_testimonials::featured', 'alexf'))
        {
            return '';
        }

        $href .= '&amp;id='.$this->Input->get('id').'&amp;tid='.$row['id'].'&amp;state='.$row[''];

        if (!$row['featured'])
        {
            $icon = 'featured_.gif';
        }

        return '<a href="'.$this->addToUrl($href).'" title="'.specialchars($title).'"'.$attributes.'>'.$this->generateImage($icon, $label).'</a> ';
    }
    /**
     * Toggle the visibility of an element
     * @param integer
     * @param boolean
     */
    public function toggleFeatured($intId, $blnFeatured)
    {
        if (is_array($GLOBALS['TL_DCA']['tl_inn_testimonials']['fields']['featured']['save_callback']))
        {
            foreach ($GLOBALS['TL_DCA']['tl_inn_testimonials']['fields']['featured']['save_callback'] as $callback)
            {
                $this->import($callback[0]);
                $blnFeatured = $this->$callback[0]->$callback[1]($blnFeatured, $this);
            }
        }
        // Update the database
        $this->Database->prepare("UPDATE tl_inn_testimonials SET tstamp=". time() .", featured='" . ($blnFeatured ? 1 : '') . "' WHERE id=?")
            ->execute($intId);
        $this->createNewVersion('tl_inn_testimonials', $intId);
    }

}
