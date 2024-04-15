<?php
 
namespace App\Models;
 
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
 
class Exam extends Model
{
  /**
   * The table associated with the model.
   *
   * @var string
   */
  protected $table = 'exam';

  public function user(): BelongsTo
  {
    return $this->belongsTo(User::class);
  }

    
}