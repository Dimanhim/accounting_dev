<?php

namespace common\models\traits;

use common\models\OrganizationRequisite;

trait OrganizationTrait
{
    public $position_name;
    public $action_basis;
    public $person_name;
    public $short_person_name;
    public $phone;
    public $email;
    public $legal_address;
    public $actual_address;
    public $inn;
    public $kpp;
    public $okpo;
    public $ogrn;
    public $rs;
    public $kors;
    public $bik;
    public $bank_name;

    public function handleRequisites()
    {
        if($this->_requisites) {
            if($organizationRequisites = OrganizationRequisite::findOne(['organization_id' => $this->_requisites->organization_id])) {
                return $organizationRequisites->updateMainAttributes($this->_requisites);
            }
            $organizationRequisites = new OrganizationRequisite();
            $organizationRequisites->attributes = $this->_requisites->attributes;
            $organizationRequisites->organization_id = $this->id;
            return $organizationRequisites->save();
        }
        return false;
    }

}
