<?php

namespace App\Models\ActionLogs;

use Illuminate\Database\Eloquent\Model;

class ActionLog extends Model
{
    protected $table = 'action_logs';

    protected $fillable = [
        'user_id',
        'post_id',
        'event_at',
    ];


    public function posts()
    {
        return $this->belongsTo('App\Models\Posts\Post', 'post_id', 'id');
    }

    public function users()
    {
        return $this->belongsTo('App\Models\Users\User', 'user_id', 'id');
    }

    public function viewCounts($post_id)
    {
        return $this->where('post_id', $post_id)->get()->count();
    }
}
