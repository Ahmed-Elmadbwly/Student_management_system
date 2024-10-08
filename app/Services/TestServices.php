<?php

namespace App\Services;

use App\Models\lessonTest;
use App\Models\QuizAttempt;
use App\Models\TestOption;
use App\Models\UserAnswer;
use Illuminate\Support\Facades\DB;

class TestServices
{

    public function userScore($id)
    {
        $totalScore = 0; $score = 0;
        $userAnswers = DB::table('user_answers as ua')
            ->join('test_questions as tq', 'ua.questionId', '=', 'tq.id')
            ->join('test_options as to', 'ua.optionId', '=', 'to.id')
            ->where('tq.testId', $id)
            ->where('ua.userId', auth()->id())
            ->select('tq.score', 'to.isCorrect')
            ->get();

        foreach ($userAnswers as $answer) {
            $totalScore += $answer->score;
            if ($answer->isCorrect) {
                $score += $answer->score;
            }
        }
        QuizAttempt::create([
            'userId' => auth()->id(),
            'quizId' => $id,
            'score' => $score,
            'totalScore'=>$totalScore
        ]);
        return $totalScore;
    }
    public function userAnswer($data,$id)
    {
//        dd($data);
        foreach ($data->questionText as $questionData) {
            $optionId = '0' ; $isCorrect = false; $i=1;
            foreach ($questionData['optionText'] as $index =>  $optionText) {
                if($questionData['isCorrect'] == $i){
                    $isCorrect = true;
                    $optionId = $index;
                }
                $i++;
            }
            UserAnswer::create([
                'userId' => auth()->id(),
                'questionId' => $questionData['questionId'],
                'optionId' => $optionId,
                'isCorrect' => $isCorrect
            ]);
        }
        $this->userScore($id);
    }

    public function getScore($id)
    {
        $quizId = lessonTest::where('subLessonId',$id)->first()->id;
        $score = QuizAttempt::where('quizId', $quizId)->where('userId', auth()->id())->first();
        return $score;
    }
}
