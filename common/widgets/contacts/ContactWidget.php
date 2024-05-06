<?php

namespace common\widgets\contacts;

use common\models\Contact;
use yii\base\Widget;
use common\widgets\contacts\models\ContactForm;

class ContactWidget extends Widget
{
    public $type;
    public $object_id;

    public function init()
    {
        return parent::init();
    }

    /**
     * @return string|void
     */
    public function run()
    {
        return $this->render('default');
    }

    public function contactTableHtml()
    {
        $models = Contact::findModels()->andWhere(['object_type_id' => $this->type, 'object_id' => $this->object_id])->all();

        return $this->render('_contact_table', [
            'models' => $models,
        ]);
    }

    /**
     * @return string
     */
    public static function renderModal()
    {
        $model = new self();

        return $model->renderModalTemplate();
    }

    /**
     * @return string
     */
    private function renderModalTemplate()
    {
        return $this->render('_modal_template');
    }

    /**
     * @return string
     */
    public function createModalForm()
    {
        $model = new ContactForm();

        return $this->render('_modal', [
            'model' => $model,
        ]);
    }

    /**
     * @return string
     */
    public function updateModalForm(Contact $contact)
    {
        $model = new ContactForm(['_contact' => $contact]);

        return $this->render('_modal', [
            'model' => $model,
        ]);
    }

    /**
     * @param Contact $model
     * @return string|null
     */
    public function getPhoneFieldsHtml(Contact $model)
    {
        $data = null;

        if($phones = $model->contact_phones) {
            foreach($phones as $phone) {
                $data .= $this->getPhoneFieldHtml($phone['phone'], $phone['added']);
            }
        }
        else {
            $data .= $this->getPhoneFieldHtml();
        }

        return $data;
    }

    /**
     * @param null $phoneValue
     * @param null $addedValue
     * @return string
     */
    public function getPhoneFieldHtml($phoneValue = null, $addedValue = null)
    {
        return $this->render('_phone_field', [
            'phoneValue' => $phoneValue,
            'addedValue' => $addedValue,
        ]);
    }

    /**
     * @param Contact $model
     * @return string|null
     */
    public function getEmailFieldsHtml(Contact $model)
    {
        $data = null;

        if($emails = $model->contact_emails) {
            foreach($emails as $email) {
                $data .= $this->getEmailFieldHtml($email['email']);
            }
        }
        else {
            $data .= $this->getEmailFieldHtml();
        }

        return $data;
    }

    /**
     * @param null $email
     * @return string
     */
    public function getEmailFieldHtml($email = null)
    {
        return $this->render('_email_field', [
            'email' => $email,
        ]);
    }
}
