<?php

namespace App\Services;

use App\Models\ActivityModel;

class ActivityService
{
    protected ActivityModel $activityModel;

    public function __construct()
    {
        $this->activityModel = new ActivityModel();
    }

    /**
     * Create an activity with basic validation.
     * Returns the new activity ID or false on failure.
     */
    public function createActivity(array $data): int|false
    {
        $required = ['type', 'description', 'date'];
        foreach ($required as $field) {
            if (empty($data[$field])) {
                return false;
            }
        }

        $allowedTypes = ['call', 'email', 'meeting', 'note'];
        if (! in_array($data['type'], $allowedTypes, true)) {
            return false;
        }

        $id = $this->activityModel->insert($data, true);

        return $id !== false ? (int) $id : false;
    }
}
