<?php

namespace App\Services;

use App\Models\Course;
use App\Models\enrollecourse;
use Illuminate\Support\Facades\DB;
use Stripe\Charge;
use Stripe\Stripe;

class EnrollServices extends CoursesServices
{
    public function getMyCourses()
    {
        $courses = Course::whereHas('enrollees', function ($query) {
            $query->where('userId', auth()->id())
                ->where('isEnrolled', true);
        })->get();
        return $courses;
    }

    public function enrollCourse($data)
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));
        try {
            $charge = Charge::create([
                'amount' => $data->price*100,
                'currency' => 'usd',
                'source' => $data->stripeToken,
                'description' => 'Payment Description',
            ]);

            enrollecourse::create(['userId' => auth()->id(),'courseId' => $data->id,'isEnrolled' => true]);

            return  'Payment successful!';
        } catch (\Exception $e) {
            return'payment.failure'. $e->getMessage();
        }
    }

    public static function isEnrolledCourse($courseId)
    {
        return enrollecourse::where('courseId',$courseId)->where('userId',auth()->id())->exists();
    }

}
