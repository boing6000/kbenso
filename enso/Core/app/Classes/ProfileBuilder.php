<?php

namespace LaravelEnso\Core\app\Classes;

use Carbon\Carbon;
use LaravelEnso\Core\app\Models\User;
use LaravelEnso\ActionLogger\app\Models\ActionLog;

class ProfileBuilder
{
    private const LoginsRating = 80;
    private const ActionsRating = 20;

    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function set()
    {
        $this->user->load(['owner', 'role']);

        $this->build();
    }

    public function build()
    {
        $this->user->load(['owner', 'role']);

        $this->user->loginCount = $this->user->logins()->count();
        $this->user->actionLogCount = $this->user->actionLogs()->count();
        $this->user->daysSinceMember = Carbon::parse($this->user->created_at)->diffInDays() ?: 1;
        $this->user->avatar = $this->genAvatar();

        $this->user->rating = $this->rating();

        $this->user->timeline = $this->timeline();
    }
    
    private function genAvatar(){
        $names = explode(' ',$this->user->fullName);
        $colors = ["bdc3c7","6f7b87","2c3e50","2f3193","662d91","922790","ec2176","ed1c24","f36622","f8941e","fab70f","fdde00","d1d219","8ec73f","00a650","00aa9c","00adef","0081cd","005bab"];
        $initials = strtoupper($names[0][0]) . strtoupper($names[count($names) - 1][0]);
        $color_index = crc32($initials) % count($colors);
        $user_color = $colors[$color_index];
        return "http://placehold.jp/90/{$user_color}/ffffff/150x150.png?text={$initials}";
    }

    private function rating()
    {
        return intval(
            (self::LoginsRating * $this->user->loginCount / $this->user->daysSinceMember +
            self::ActionsRating * $this->user->actionLogCount / $this->user->daysSinceMember) / 100
        );
    }

    private function timeline()
    {
        return ActionLog::whereUserId($this->user->id)
            ->whereHas('permission', function ($query) {
                $query->where('name', 'like', '%index')
                    ->orWhere('name', 'like', '%create')
                    ->orWhere('name', 'like', '%edit')
                    ->orWhere('name', 'like', '%destroy');
            })->with('permission')->latest()
            ->paginate(10);
    }
}
