<?php
namespace App\AccountPlan;
use App\Models\Account;
class AccountPlan
{
    public $account;
    
    public function getFree() {
        $this->account = new Account;
        $this->account->account_type = "free";
        $this->account->device_number = 2;
        $this->account->request_quota = 100;
        $this->account->expired_at = date('Y-m-d', strtotime('+3 month'));;
        $this->account->is_active = true;
        return $this->account;
    }

    public function getStandard() {
        $this->account = new Account;
        $this->account->account_type = "standard";
        $this->account->device_number = 5;
        $this->account->request_quota = 600;
        $this->account->expired_at = date('Y-m-d', strtotime('+3 month'));
        $this->account->is_active = true;
        return $this->account;
    }

    public function getEnterprise() {
        $this->account = new Account;
        $this->account->account_type = "enterprise";
        $this->account->device_number = 12;
        $this->account->request_quota = 1500;
        $this->account->expired_at = date('Y-m-d', strtotime('+1 year'));
        $this->account->is_active = true;
        return $this->account;
    }
}
