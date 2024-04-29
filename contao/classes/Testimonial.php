<?php


namespace Inndividuell\ContaoTestimonialsBundle;

use Contao;
use Database;

class Testimonial extends \Frontend
{

    public function sendTestimonial() {
        $foo='bar';


        $dataArray = array();
        if(\Input::post('email')){
            $dataArray['email']=\Input::post('email');
        }
        if(\Input::post('phone')){
            $dataArray['phone']=\Input::post('phone');
        }
        if(\Input::post('firstname') && \Input::post('lastname')){
            $dataArray['name']=\Input::post('firstname').' '.\Input::post('lastname');
        }
        if(\Input::post('company')){
            $dataArray['company']=\Input::post('company');
        }
        if(\Input::post('position')){
            $dataArray['c_position']=\Input::post('position');
        }
        if(\Input::post('location')){
            $dataArray['location']=\Input::post('location');
        }
        if(\Input::post('text')){
            $dataArray['text']=\Input::post('text');
        }
        if(\Input::post('rate')){
            $dataArray['rating']=\Input::post('rate');
        }
        if(\Input::post('title')){
            $dataArray['title']=\Input::post('title');
        }
        $dataArray['date_added']=time();
        $dataArray['tstamp']=time();

        $this->Database->prepare('INSERT INTO tl_inn_testimonials %s')->set($dataArray)->execute();

        if(\Input::post('notification_id') !== 'false' && \Input::post('notification_id')){
            $notification_id = \Input::post('notification_id');

            $arrTokens=array();
            foreach($dataArray as $key=>$object){
                $arrTokens['form_'.$key] = $object;
            }
            $objNotification = \NotificationCenter\Model\Notification::findByPk($notification_id);
            if (null !== $objNotification) {
                $objNotification->send($arrTokens); // Language is optional
            }
        }

        $testarray = array('testval'=>'test');
        return json_encode($testarray);
    }

}
