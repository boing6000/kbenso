<?php

namespace LaravelEnso\Core\app\Models;

use Illuminate\Notifications\Notifiable;
use LaravelEnso\Helpers\app\Traits\IsActive;
use LaravelEnso\RoleManager\app\Models\Role;
use LaravelEnso\ActivityLog\app\Traits\LogActivity;
use LaravelEnso\AvatarManager\app\Traits\HasAvatar;
use LaravelEnso\CommentsManager\app\Traits\Comments;
use LaravelEnso\Core\app\Classes\DefaultPreferences;
use LaravelEnso\Impersonate\app\Traits\Impersonates;
use LaravelEnso\ActionLogger\app\Traits\HasActionLogs;
use LaravelEnso\DocumentsManager\app\Traits\Documents;
use Illuminate\Foundation\Auth\User as Authenticatable;
use LaravelEnso\Core\app\Notifications\ResetPasswordNotification;
use Symfony\Component\HttpKernel\Exception\ConflictHttpException;

class User extends Authenticatable
{
    use Notifiable, HasAvatar, Impersonates, HasActionLogs,
        IsActive, Comments, Documents;

    protected $hidden = ['password', 'remember_token'];

    protected $fillable = [
        'first_name', 'last_name', 'phone', 'is_active', 'email', 'owner_id', 'role_id',
    ];

    protected $appends = ['fullName'];

    protected $casts = ['is_active' => 'boolean'];

    protected $loggableLabel = 'fullName';

    protected $loggable = [
        'first_name', 'last_name', 'phone', 'email', 'owner_id' => [Owner::class, 'name'],
        'role_id' => [Role::class, 'name'], 'is_active' => 'active state',
    ];

    public function owner()
    {
        return $this->belongsTo(config('enso.config.ownerModel'));
    }

    public function teams()
    {
        return $this->belongsToMany(Team::class);
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function logins()
    {
        return $this->hasMany(Login::class);
    }

    public function preference()
    {
        return $this->hasOne(Preference::class);
    }

    public function isAdmin()
    {
        return $this->role_id === Role::AdminId;
    }

    public function isSupervisor()
    {
        return $this->role_id === Role::SupervisorId;
    }

    public function persistDefaultPreferences()
    {
        $this->preference()
            ->save($this->defaultPreferences());
    }

    public function preferences()
    {
        $preferences = $this->preference
            ? $this->preference->value
            : $this->defaultPreferences()->value;

        unset($this->preference);

        return $preferences;
    }

    public function lang()
    {
        return $this->preferences()
            ->global
            ->lang;
    }

    private function defaultPreferences()
    {
        return new Preference([
            'value' => DefaultPreferences::data(),
        ]);
    }

    public function getFullNameAttribute()
    {
        return trim($this->first_name.' '.$this->last_name);
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordNotification($this, $token));
    }

    public function setGlobalPreferences($global)
    {
        $preferences = $this->preferences();
        $preferences->global = $global;

        $this->setPreferences($preferences);
    }

    public function setLocalPreferences($route, $value)
    {
        $preferences = $this->preferences();
        $preferences->local->$route = $value;

        $this->setPreferences($preferences);
    }

    public function delete()
    {
        try {
            parent::delete();
        } catch (\Exception $e) {
            throw new ConflictHttpException(__(
                'The user has activity in the system and cannot be deleted'
            ));
        }
    }

    private function setPreferences($preferences)
    {
        $this->preference()
            ->updateOrCreate(
                ['user_id' => $this->id],
                ['value' => $preferences]
            );
    }
}
