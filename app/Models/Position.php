<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    use HasFactory;
    public function players()
    {
        /* 中間テーブル(player_position テーブル)が持っているレコード で関連付けする
         * $this->belongsTo(<連携先クラス名>::class)
         */
        return $this->belongsToMany(Player::class);
    }
}
