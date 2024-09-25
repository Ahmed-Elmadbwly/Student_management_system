<?php

namespace App\Services;

use App\Models\assignment;
use App\Models\lessonTest;
use App\Models\lessonText;
use App\Models\SubLesson;
use App\Models\TestOption;
use App\Models\TestQuestion;
use Faker\Provider\Text;

class SubLessonServices
{
    public function getSubLessons($lessonId)
    {
        return SubLesson::where('lessonId', $lessonId)->get();
    }
    public function createSubLesson($lessonId,$data)
    {
        $subLesson = SubLesson::create([
            'title' => $data->title,
            'lessonId'=>$lessonId,
            'type'=>$data->type,
        ]);

        if($data['type']=='assignment'){
            $file = $data->file('fileTitle');
            $filePath = $file->store('uploads');
            $fileName = basename($filePath);
            assignment::create([
                'subLessonId'=>$subLesson->id,
                'fileTitle'=>  $fileName ,
            ]);
        }else if($data['type']=='text'){
            $file = $data->file('videoContent');
            $filePath = $file->store('videos');
            $fileName = basename($filePath);
            lessonText::create([
                'subLessonId'=>$subLesson->id,
                 'textContent'=>$data->textContent,
                'videoContent'=>$fileName
            ]);
        }else{
            $test = lessonTest::create([
                'subLessonId'=>$subLesson->id,
                'quizTitle'=>$data->quizTitle,
                'time'=>$data->time
            ]);

            foreach ($data->questionText as $questionData) {
                $question = TestQuestion::create([
                    'questionText' => $questionData['text'],
                    'testId' => $test->id,
                ]);

                foreach ($questionData['optionText'] as $index => $optionText) {
                    TestOption::create([
                        'optionText' => $optionText,
                        'isCorrect' => ($questionData['isCorrect'] == $index  ? 1 : 0),
                        'questionId' => $question->id,
                    ]);
                }
            }
        }
    }

    public  function showSubLesson($subLessonId)
    {
        $subLesson = SubLesson::find($subLessonId);
        $content = [
            'subLessonId' => $subLesson->id,
            'title' => $subLesson->title,
            'type' => $subLesson->type,
        ];
        if ($subLesson->type == 'assignment') {
            $assignment = assignment::where('subLessonId', $subLessonId)->first();
            $content = array_merge($content, $assignment->toArray());
        }
        else if ($subLesson->type == 'text') {
            $text = lessonText::where('subLessonId', $subLessonId)->first();
            $content = array_merge($content, $text->toArray());
        }
        else {
            $test = lessonTest::where('subLessonId', $subLessonId)->first();
            $content['testId'] = $test->id;
            $content['quizTitle'] = $test->quizTitle;
            $content['time'] = $test->time;
            $content['questions'] = [];
            $questions = TestQuestion::where('testId', $test->id)->get();
            foreach ($questions as $question) {
                $options = TestOption::where('questionId', $question->id)->get();
                $questionArray = [
                    'id' => $question->id,
                    'questionText' => $question->questionText,
                    'options' => $options->toArray()
                ];
                $content['questions'][] = $questionArray;
            }
        }
        return $content;
    }

    public function updateSubLesson($subLessonId, $data)
    {
        $subLesson = SubLesson::find($subLessonId);

        $subLesson->update([
            'title' => $data->title,
            'type' => $data->type,
        ]);

        if ($data['type'] == 'assignment') {
            $assignment = assignment::where('subLessonId', $subLessonId)->first();
            if ($data->hasFile('fileTitle')) {
                $file = $data->file('fileTitle');
                $filePath = $file->store('uploads');
                $fileName = basename($filePath);
                $assignment->update(['fileTitle' => $fileName]);
            }
        } elseif ($data['type'] == 'text') {
            $text = lessonText::where('subLessonId', $subLessonId)->first();
            if ($data->hasFile('videoContent')) {
                $file = $data->file('videoContent');
                $filePath = $file->store('videos');
                $fileName = basename($filePath);
                $text->update([
                    'textContent' => $data->textContent,
                    'videoContent' => $fileName,
                ]);
            } else {
                $text->update(['textContent' => $data->textContent]);
            }
        } else {
            $test = lessonTest::where('subLessonId', $subLessonId)->first();
            $test->update([
                'quizTitle' => $data->quizTitle,
                'time' => $data->time,
            ]);
            foreach ($data->questionText as $questionData) {
                $question = TestQuestion::where('testId', $test->id)->where('id', $questionData['questionId'])->first();
                if ($question) {
                    $question->update(['questionText' => $questionData['text']]);
                    $i=1;
                    foreach ($questionData['optionText'] as $index => $optionText) {
                        $option = TestOption::where('questionId', $question->id)->where('id', $index)->first();
                        if ($option) {
                            $option->update([
                                'optionText' => $optionText,
                                'isCorrect' => ($questionData['isCorrect'] == $i ? 1 : 0),
                            ]);
                        }
                        $i++;
                    }
                }
            }
        }
    }


    public function deleteSubLesson($subLessonId)
    {
        assignment::where('subLessonId', $subLessonId)->delete();
        lessonText::where('subLessonId', $subLessonId)->delete();
        $subLesson = SubLesson::findOrFail($subLessonId);
        $test = LessonTest::where('subLessonId', $subLessonId)->first();
        if ($test) {
            foreach ($test->questions as $question) {
                $question->options()->delete();
                $question->delete();
            }
            $test->delete();
        }
        $subLesson->delete();
    }
}
