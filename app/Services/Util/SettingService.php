<?php
namespace App\Services\Util;

use App\Models\Util\Setting;
use App\Services\AdminService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

class SettingService extends AdminService
{
     public function __construct(
          protected $model = Setting::class,
     ) {
     }

     public function store(Request $request, $allowed)
     {
          $items = collect($allowed)->map(function ($key, $i) use ($request) {
               $value = $request->input($key);
               return [
                    'uuid' => Str::uuid(),
                    'created_at' => now()->addSeconds($i),
                    'key' => $key,
                    'value' => $value ?: '',
               ];
          });


          $allKey = $items->whereNotNull('value')->pluck('key');
          $allKey->each(function ($key) {
               Cache::forget("setting-{$key}");
          });
          $this->model::query()
               ->whereIn('key', $allKey->toArray())
               ->delete();

          return $this->model::insert($items->whereNotNull('value')->toArray());
     }

     public function findAll($keys)
     {
          return (object) $this->model::query()
               ->whereIn('key', $keys)
               ->select(['key', 'value'])
               ->get()
               ->pluck('value', 'key')
               ->map(fn($row, $key) => (str_contains($key, "bank_logo")) ? asset($row) : $row)
               ->toArray();
     }

     public function find($key)
     {
          return Cache::remember("setting-{$key}", 5000, fn() => $this->model::query()->where("key", $key)->first()?->value);
     }

     public function findValue($key)
     {
          return $this->model::query()->where("key", $key)->first()?->value;
     }


     public function findSettingInvoice()
     {
          $keys = [
               'company_name',
               'company_description',
               'company_address_1',
               'company_address_2',
               'company_phone_number',
               'company_fax',
               'company_email_1',
               'company_email_2',
               'company_npwp',
               'bank_rekening_name',
               'bank_name',
               'bank_branch',
               'nomor_rekening_idr',
               'nomor_rekening_usd',
               'bank_swift_code',
               'bank_address',
          ];
          return $this->findAll($keys);
     }
}
