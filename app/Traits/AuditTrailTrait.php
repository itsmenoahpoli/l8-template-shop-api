<?php

namespace App\Traits;

use App\Models\AuditTrail as Model;

trait AuditTrailTrait
{
    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function recordTrail($user, $message)
    {
        $userId = $user->id;
        $userFullname = $user->first_name.' '.$user->last_name;

        $formattedTrailMessage = "[USER-ACTIVITY]: (USER) {$userFullname} || (ACTION) {$message} ";

        $this->model->create([
            'user_id' => $userId,
            'message' => $formattedTrailMessage
        ]);
    }
}
