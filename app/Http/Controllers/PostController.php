<?php

// Post Controller
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\PostCollection;
use App\Post;

class PostController extends Controller
{
    public function save(Request $request)
    {
        $mon = $request->get('mon');
        $tue = $request->get('tue');
        $wed = $request->get('wed');
        $thu = $request->get('thu');
        $fri = $request->get('fri');
        $sat = $request->get('sat');
        $sun = $request->get('sun');
        $sched_date = [];

        $startDate = $request->get('from');
        $endDate = $request->get('to');

        if($mon){ 
          $new_date = $this->getWeekDate($startDate, $endDate, 'monday');
          $sched_date =  array_merge($sched_date, $new_date);
        }

        if($tue){ 
          $new_date = $this->getWeekDate($startDate, $endDate, 'tuesday');
          $sched_date =  array_merge($sched_date, $new_date);
        }

        if($wed){
          $new_date = $this->getWeekDate($startDate, $endDate, 'wednesday');
          $sched_date =  array_merge($sched_date, $new_date);
        }

        if($thu){ 
          $new_date = $this->getWeekDate($startDate, $endDate, 'thursday');
          $sched_date =  array_merge($sched_date, $new_date);
        }

        if($fri){
          $new_date = $this->getWeekDate($startDate, $endDate, 'friday');
          $sched_date =  array_merge($sched_date, $new_date);
        }

        if($sat){ 
          $new_date = $this->getWeekDate($startDate, $endDate, 'saturday');
          $sched_date =  array_merge($sched_date, $new_date);
        }

        if($sun){ 
          $new_date = $this->getWeekDate($startDate, $endDate, 'sunday');
          $sched_date =  array_merge($sched_date, $new_date);
        }

        $str_dates = "";
        if($sched_date){
          $str_dates = implode($sched_date, ',');
        }
        $post = new Post([
            'event' => $request->get('event'),
            'from' => $startDate,
            'to' => $endDate,
            'schedule' => $str_dates
        ]);

      $post->save();

      return response()->json($post);
    }

    /*
      This will calculate set of dates weekly depends on the start and end date.
    */
    public function getWeekDate($startDate, $endDate, $week){
      $dateFrom = new \DateTime($startDate);
      $dateTo = new \DateTime($endDate);
      $dates = [];

      if ($dateFrom >= $dateTo) {
          return $dates;
      }

      if (1 != $dateFrom->format('N')) {
          $dateFrom->modify('next '.$week);
      }

      while ($dateFrom <= $dateTo) {
          $dates[] = $dateFrom->format('Y-m-d');
          $dateFrom->modify('+1 week');
      }
      return $dates;
    }
    
}
