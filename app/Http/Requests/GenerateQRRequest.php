<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class GenerateQRRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'content' => ['required', 'string'],
            'size' => ['required', 'integer', 'min:1', 'max:1000'],
            'background_color' => ['required', 'string'],
            'fill_color' => ['required', 'string'],
        ];
    }

    protected function passedValidation()
    {
        [$bgr, $bgg, $bgb] = sscanf($this->get('background_color'), "#%02x%02x%02x");
        [$fgr, $fgg, $fgb] = sscanf($this->get('fill_color'), "#%02x%02x%02x");
        $path = auth()->id().'_'.Str::random(6).'.svg';
        QrCode::format('svg')->size($this->get('size'))->backgroundColor($bgr, $bgg, $bgb)->color($fgr, $fgg, $fgb)->generate($this->get('content'), Storage::path($path));
        $this->merge([
            'user_id' => auth()->id(),
            'path' => $path
        ]);
    }
}
