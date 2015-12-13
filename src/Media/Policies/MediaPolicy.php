<?php

namespace LaravelFlare\Media\Policies;

class MediaPolicy
{
    /**
     * Determine if the given Model can be viewed by the user.
     *
     * @param  $user
     * @param  $admin
     * 
     * @return bool
     */
    public function view($user, $admin)
    {
        return $user->is_admin;
    }
}
