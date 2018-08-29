<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Answer extends Model
{
    protected $table = 'answers';
    protected $fillable = ['answer', 'question_id', 'admin_id'];
    /** Связь с моделью вопросов
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function question()
    {
        return $this->belongsTo('App\Models\Questions', 'id');
    }
}