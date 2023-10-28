<?php
  
  function get_classgroup_user($username)
  {
  $studentModel = new \App\Models\Data\StudentModel;
  $row = $studentModel->get_student_detail_id($username);
  return $row->getRow();

  }

  if (!function_exists('persen')) {
    function persen($jumlah) {
      if ($jumlah > 100) {
        $percent = 100;
      }elseif($jumlah > 75) {
        $percent = 75;
      }elseif ($jumlah > 50) {
        $percent = 50;
      }elseif ($jumlah > 25) {
        $percent = 25;
      }else{
        $percent = 0;
      }

      return $percent;
    }
  }

  if (!function_exists('persencolor')) {
    function persencolor($persen) {
      if ($persen == 100) {
        $color = 'success';
      }elseif($persen == 75) {
        $color = 'success';
      }elseif ($persen == 50) {
        $color = 'warning';
      }elseif ($persen == 25) {
        $color = 'warning';
      }else{
        $color = 'danger';
      }

      return $color;
    }
  }

  if (!function_exists('predikat_skp')) {
    function predikat_skp($score) {
      if ($score >= 91 ) {
          return "Sangat Baik";
        }elseif ($score >= 76) {
          return "Baik";
        }elseif ($score >= 61) {
          return "Cukup";
        }elseif ($score >= 51) {
          return "Sedang";
        }elseif ($score < 70) {
          return "Buruk";
        }
    }
  }

  if (!function_exists('journal')) {
    function journal($key){
      $d = new \App\Models\JournalModel();
      return $d->get_journal_by_key($key);
    }
  }

  if (!function_exists('percent_by_week')) {
    function percent_by_week($week_id){
      $d = new \App\Models\JournalModel();
      return $d->get_percent_journal_week($week_id)['percent'];
    }
  }

  if (!function_exists('count_schedule_by_week')) {
    function count_schedule_by_week($week){
      $d = new \App\Models\ScheduleModel();
      return $d->count_schedule_by_week($week)['id'];
    }
  }

?>