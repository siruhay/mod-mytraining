<?php

namespace Module\MyTraining\Models;

use Illuminate\Http\Request;
use Module\System\Traits\HasMeta;
use Illuminate\Support\Facades\DB;
use Module\System\Traits\Filterable;
use Module\System\Traits\Searchable;
use Module\System\Traits\HasPageSetup;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Module\Training\Models\TrainingVillage;
use Illuminate\Database\Eloquent\SoftDeletes;
use Module\Training\Models\TrainingCommittee;
use Module\Training\Models\TrainingSubdistrict;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Module\MyTraining\Http\Resources\EventResource;

class MyTrainingEvent extends Model
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
    protected $table = 'training_events';

    /**
     * The roles variable
     *
     * @var array
     */
    protected $roles = ['mytraining-event'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'meta' => 'array'
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
        if ($request->user()->hasLicenseAs('mytraining-member')) {
            return [
                'hasPresence' => $model ? $model->participants()->firstWhere('particiable_id', $request->user()->userable->id)->accepted_at === null : false,
                'hasPretest' => $model ? $model->questions()->where('mode', 'PRETEST')->count() > 0 : false,
                'hasPostest' => $model ? $model->questions()->where('mode', 'POSTEST')->count() > 0 : false,
                'isMember' => $request->user()->hasLicenseAs('mytraining-member'),
                // 'isSpeaker' => $request->user()->hasLicenseAs('mytraining-speaker')
            ];
        }

        return [
            'isSpeaker' => $request->user()->hasLicenseAs('mytraining-speaker')
        ];
    }

    /**
     * mapCombos function
     *
     * @param Request $request
     * @return array
     */
    public static function mapCombos(Request $request, $model = null): array
    {
        return [
            'subdistricts'  => TrainingSubdistrict::where('regency_id', 3)->forCombo(),
            'villages'      => optional($model)->subdistrict_id ?
                TrainingVillage::where('district_id', $model->subdistrict_id)->forCombo() :
                []
        ];
    }

    /**
     * mapHeaders function
     *
     * readonly value?: SelectItemKey<any>
     * readonly title?: string | undefined
     * readonly align?: 'start' | 'end' | 'center' | undefined
     * readonly width?: string | number | undefined
     * readonly minWidth?: string | undefined
     * readonly maxWidth?: string | undefined
     * readonly nowrap?: boolean | undefined
     * readonly sortable?: boolean | undefined
     *
     * @param Request $request
     * @return array
     */
    public static function mapHeaders(Request $request): array
    {
        return [
            ['title' => 'Name', 'value' => 'name'],
            ['title' => 'Start', 'value' => 'startdate'],
            ['title' => 'Finish', 'value' => 'finishdate'],
            ['title' => 'Status', 'value' => 'status'],
            ['title' => 'Updated', 'value' => 'updated_at', 'sortable' => false, 'width' => '170'],
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
            'startdate' => $model->startdate,
            'finishdate' => $model->finishdate,
            'status' => $model->status,

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
            'id'                => $model->id,
            'name'              => $model->name,
            'slug'              => $model->slug,
            'startdate'         => $model->startdate,
            'finishdate'        => $model->finishdate,
            'village_id'        => $model->village_id,
            'subdistrict_id'    => $model->subdistrict_id,
            'regency_id'        => $model->regency_id,
            'status'            => $model->status,
        ];
    }

    /**
     * Undocumented function
     *
     * @param Builder $query
     * @return void
     */
    public function scopeOnlyActive(Builder $query)
    {
        return $query->whereNotIn('status', ['REJECTED', 'COMPLETED']);
    }

    /**
     * Undocumented function
     *
     * @param Builder $query
     * @return void
     */
    public function scopeOnlyHistory(Builder $query)
    {
        return $query->whereIn('status', ['REJECTED', 'COMPLETED']);
    }

    /**
     * committees function
     *
     * @return HasMany
     */
    public function committees(): HasMany
    {
        return $this->hasMany(TrainingCommittee::class, 'event_id');
    }

    /**
     * speakers function
     *
     * @return HasMany
     */
    public function speakers(): HasMany
    {
        return $this->hasMany(TrainingCommittee::class, 'event_id')->where('type', 'SPEAKER');
    }

    /**
     * participants function
     *
     * @return HasMany
     */
    public function participants(): HasMany
    {
        return $this->hasMany(MyTrainingParticipant::class, 'event_id');
    }

    /**
     * rundowns function
     *
     * @return HasMany
     */
    public function rundowns(): HasMany
    {
        return $this->hasMany(MyTrainingRundown::class, 'event_id');
    }

    /**
     * answers function
     *
     * @return HasMany
     */
    public function answers(): HasMany
    {
        return $this->hasMany(MyTrainingAnswer::class, 'event_id');
    }

    /**
     * questions function
     *
     * @return HasMany
     */
    public function questions(): HasMany
    {
        return $this->hasMany(MyTrainingQuestion::class, 'event_id');
    }

    /**
     * booted function
     *
     * @return void
     */
    protected static function booted(): void
    {
        static::addGlobalScope('onlyActive', function (Builder $query) {
            $query->whereNotIn('status', ['COMPLETED', 'REJECTED']);
        });
    }

    /**
     * scopeForCurrentUser function
     *
     * @param Builder $query
     * @param [type] $user
     * @return void
     */
    public function scopeForCurrentUser(Builder $query, $user)
    {
        if ($user->hasLicenseAs('mytraining-speaker')) {
            return $query
                ->whereIn('status', ['ASSIGNED', 'PUBLISHED', 'CERTIFICATE'])
                ->whereHas('committees', function ($subquery) use ($user) {
                    $subquery->where('biodata_id', $user->userable->biodata_id);
                });
        }

        return $query
            ->whereIn('status', ['PUBLISHED', 'CERTIFICATE'])
            ->whereHas('participants', function ($subquery) use ($user) {
                $subquery->where('particiable_id', $user->userable->id);
            });
    }

    /**
     * The model store method
     *
     * @param Request $request
     * @return void
     */
    public static function storeRecord(Request $request)
    {
        $model = new static();

        DB::connection($model->connection)->beginTransaction();

        try {
            // ...
            $model->save();

            DB::connection($model->connection)->commit();

            return new EventResource($model);
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
    public static function updateRecord(Request $request, $model)
    {
        DB::connection($model->connection)->beginTransaction();

        try {
            // ...
            $model->save();

            DB::connection($model->connection)->commit();

            return new EventResource($model);
        } catch (\Exception $e) {
            DB::connection($model->connection)->rollBack();

            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * presenceRecord function
     *
     * @param Request $request
     * @param [type] $model
     * @return void
     */
    public static function presenceRecord(Request $request, $model)
    {
        $participant = $model->participants()->firstWhere('particiable_id', $request->user()->userable->id);

        DB::connection($model->connection)->beginTransaction();

        try {
            $participant->accepted_at = now();
            $participant->save();

            DB::connection($model->connection)->commit();

            return new EventResource($model);
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

            return new EventResource($model);
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

            return new EventResource($model);
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

            return new EventResource($model);
        } catch (\Exception $e) {
            DB::connection($model->connection)->rollBack();

            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
