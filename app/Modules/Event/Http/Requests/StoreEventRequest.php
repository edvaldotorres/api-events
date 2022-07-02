<?php

namespace Modules\Event\Http\Requests;

class StoreEventRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'event_time' => 'required|date_format:d/m/Y H:i',
            'email_notification' => 'required|email|max:50|unique:events,email_notification', 
        ];
    }
}
