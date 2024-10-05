<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SubLessonRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $id = $this->route('id');
        return [
            'title' => 'required|string|max:255',
            'type' => 'required|in:text,assignment,test',
            'textContent' => 'required_if:type,text|string|nullable',
            'videoContent' => [$id ?'nullable':'required_if:type,text|mimes:mp4,mov|nullable'],
            'fileTitle' => [$id ?'nullable':'required_if:type,assignment|file|mimes:pdf,doc,docx,zip|max:5120|nullable'],
            'quizTitle' => 'required_if:type,test|string|max:255|nullable',
            'time' => 'required_if:type,test|nullable',
            'questionText.*.text' => 'required_if:type,test|string|nullable',
            'questionText.*.optionText.*' => 'required_if:type,test|string|nullable',
            'questionText.*.isCorrect' => 'required_if:type,test|in:1,2,3,4|nullable',
            'questionText.*.score' => 'required_if:type,test|numeric|min:0|nullable',
        ];
    }
}
