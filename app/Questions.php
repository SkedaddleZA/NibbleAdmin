<?

namespace App;

use Illuminate\Database\Eloquent\Model;

class Questions extends Model
{
    public $timestamps = false;
    protected $table = 'frequently_asked_question';
    protected $primaryKey = 'question_id';
}