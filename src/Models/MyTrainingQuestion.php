<?php

namespace Module\MyTraining\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Module\System\Traits\HasMeta;
use Illuminate\Support\Facades\DB;
use Module\System\Traits\Filterable;
use Module\System\Traits\Searchable;
use Module\System\Traits\HasPageSetup;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Module\MyTraining\Models\MyTrainingEvent;
use Module\MyTraining\Http\Resources\QuestionResource;

class MyTrainingQuestion extends Model
{
    use Filterable;
    use HasMeta;
    use HasPageSetup;
    use Searchable;
    use SoftDeletes;

    /**
     * The connection name for the model.
     *
     * @var string|null
     */
    protected $connection = 'platform';

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'training_questions';

    /**
     * The roles variable
     *
     * @var array
     */
    protected $roles = ['mytraining-question'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'meta' => 'array',
        'options' => 'array'
    ];

    /**
     * The default key for the order.
     *
     * @var string
     */
    protected $defaultOrder = 'name';

    /**
     * mapStatuses function
     *
     * @param Request $request
     * @return array
     */
    public static function mapStatuses(Request $request, $model = null): array
    {
        $parent     = MyTrainingEvent::find($request->segment(4));
        $speaker    = $request->user()->hasLicenseAs('mytraining-speaker');

        return [
            'parent' => $parent,
            'speaker' => $speaker,
            'canCreate' => $speaker && $parent && $parent->status === 'ASSIGNED',
            'canEdit' => $speaker && $parent && $parent->status === 'ASSIGNED',
            'canUpdate' => $speaker && $parent && $parent->status === 'ASSIGNED',
            'canDelete' => $speaker && $parent && $parent->status === 'ASSIGNED',
            'canRestore' => $speaker && $parent && $parent->status === 'ASSIGNED',
            'canDestroy' => $speaker && $parent && $parent->status === 'ASSIGNED',
        ];
    }

    /**
     * mapRecordBase function
     *
     * @param Request $request
     * @return array
     */
    public static function mapRecordBase(Request $request): array
    {
        return [
            'id' => null,
            'name' => null,
            'answerkey' => null,
            'options' => [
                ['key' => 'A', 'text' => ''],
                ['key' => 'B', 'text' => ''],
                ['key' => 'C', 'text' => ''],
                ['key' => 'D', 'text' => '']
            ]
        ];
    }

    /**
     * mapResource function
     *
     * @param Request $request
     * @return array
     */
    public static function mapResource(Request $request, $model): array
    {
        return [
            'id' => $model->id,
            'name' => $model->name,
            'options' => $model->options,
            'answer' => null,
            'event_id' => $model->event_id,

            'subtitle' => (string) $model->updated_at,
            'updated_at' => (string) $model->updated_at,
        ];
    }

    /**
     * mapResourceShow function
     *
     * @param Request $request
     * @return array
     */
    public static function mapResourceShow(Request $request, $model): array
    {
        return [
            'id' => $model->id,
            'name' => $model->name,
            'slug' => $model->slug,
            'answerkey' => $model->answerkey,
            'options' => $model->options,
        ];
    }

    /**
     * mapResourceQuiz function
     *
     * @param Request $request
     * @param [type] $model
     * @return array
     */
    public static function mapResourceQuiz(Request $request, $model): array
    {
        return [
            'id' => $model->id,
            'name' => $model->name,
            'options' => $model->options,
            'event_id' => $model->event_id,
            'answer' => $model->answers()->firstWhere('participant_id', $request->user()->userable->id)->answer ?? null,
            'answered_at' => $model->answers()->firstWhere('participant_id', $request->user()->userable->id)->answered_at ?? null,
        ];
    }

    /**
     * scopePostest function
     *
     * @param Builder $query
     * @return void
     */
    public function scopePostest(Builder $query)
    {
        return $query
            ->where('mode', 'POSTEST');
    }

    /**
     * scopePretest function
     *
     * @param Builder $query
     * @return void
     */
    public function scopePretest(Builder $query)
    {
        return $query
            ->where('mode', 'PRETEST');
    }

    /**
     * answers function
     *
     * @return HasMany
     */
    public function answers(): HasMany
    {
        return $this->hasMany(MyTrainingAnswer::class, 'question_id');
    }

    /**
     * The model store method
     *
     * @param Request $request
     * @return void
     */
    public static function storeRecordPretest(Request $request, MyTrainingEvent $parent)
    {
        $model = new static();

        DB::connection($model->connection)->beginTransaction();

        try {
            $model->name = $request->name;
            $model->slug = sha1($request->name);
            $model->mode = 'PRETEST';
            $model->options = $request->options;
            $model->answerkey = $request->answerkey;

            $parent->questions()->save($model);

            DB::connection($model->connection)->commit();

            return new QuestionResource($model);
        } catch (\Exception $e) {
            DB::connection($model->connection)->rollBack();

            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * The model store method
     *
     * @param Request $request
     * @return void
     */
    public static function storeRecordPostest(Request $request, MyTrainingEvent $parent)
    {
        $model = new static();

        DB::connection($model->connection)->beginTransaction();

        try {
            $model->name = $request->name;
            $model->slug = sha1($request->name);
            $model->mode = 'POSTEST';
            $model->options = $request->options;
            $model->answerkey = $request->answerkey;

            $parent->questions()->save($model);

            DB::connection($model->connection)->commit();

            return new QuestionResource($model);
        } catch (\Exception $e) {
            DB::connection($model->connection)->rollBack();

            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * The model update method
     *
     * @param Request $request
     * @param [type] $model
     * @return void
     */
    public static function updateRecordPretest(Request $request, $model)
    {
        DB::connection($model->connection)->beginTransaction();

        try {
            $model->name = $request->name;
            $model->slug = sha1($request->name);
            $model->mode = 'PRETEST';
            $model->options = $request->options;
            $model->answerkey = $request->answerkey;
            $model->save();

            DB::connection($model->connection)->commit();

            return new QuestionResource($model);
        } catch (\Exception $e) {
            DB::connection($model->connection)->rollBack();

            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * The model update method
     *
     * @param Request $request
     * @param [type] $model
     * @return void
     */
    public static function updateRecordPostest(Request $request, $model)
    {
        DB::connection($model->connection)->beginTransaction();

        try {
            $model->name = $request->name;
            $model->slug = sha1($request->name);
            $model->mode = 'POSTEST';
            $model->options = $request->options;
            $model->answerkey = $request->answerkey;
            $model->save();

            DB::connection($model->connection)->commit();

            return new QuestionResource($model);
        } catch (\Exception $e) {
            DB::connection($model->connection)->rollBack();

            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * The model delete method
     *
     * @param [type] $model
     * @return void
     */
    public static function deleteRecord($model)
    {
        DB::connection($model->connection)->beginTransaction();

        try {
            $model->delete();

            DB::connection($model->connection)->commit();

            return new QuestionResource($model);
        } catch (\Exception $e) {
            DB::connection($model->connection)->rollBack();

            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * updateRecord function
     *
     * @param [type] $request
     * @param [type] $model
     * @return void
     */
    public static function updateRecord($request, $quest, $parent)
    {
        if (!$model = $quest->answers()->firstWhere('participant_id', $request->user()->userable->id)) {
            $model = new MyTrainingAnswer();
        }

        DB::connection($model->connection)->beginTransaction();

        try {
            $model->event_id = $parent->id;
            $model->participant_id = $request->user()->userable->id;
            $model->mode = $quest->mode;
            $model->answer = $request->answer;
            $model->is_correct = $request->answer === $quest->answerkey;
            $model->answered_at = now();

            $quest->answers()->save($model);

            DB::connection($model->connection)->commit();

            return new QuestionResource($model);
        } catch (\Exception $e) {
            DB::connection($model->connection)->rollBack();

            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * The model restore method
     *
     * @param [type] $model
     * @return void
     */
    public static function restoreRecord($model)
    {
        DB::connection($model->connection)->beginTransaction();

        try {
            $model->restore();

            DB::connection($model->connection)->commit();

            return new QuestionResource($model);
        } catch (\Exception $e) {
            DB::connection($model->connection)->rollBack();

            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * The model destroy method
     *
     * @param [type] $model
     * @return void
     */
    public static function destroyRecord($model)
    {
        DB::connection($model->connection)->beginTransaction();

        try {
            $model->forceDelete();

            DB::connection($model->connection)->commit();

            return new QuestionResource($model);
        } catch (\Exception $e) {
            DB::connection($model->connection)->rollBack();

            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
