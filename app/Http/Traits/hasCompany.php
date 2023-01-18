<?php

namespace App\Http\Traits;

use App\Models\Company_invitation;
use App\Models\Company;


trait hasCompany {

  public function company() {
    return $this->belongsToMany(Company::class, 'company_user', 'user_id', 'company_id')->withPivot('role');
  }

  public function hasCompany() {
    return $this->company()->exists();
  }

  public function isOwner() {
    return $this->company->user_id == $this->id;
  }

}
