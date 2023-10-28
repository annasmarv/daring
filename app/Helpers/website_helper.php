<?php

  if (!function_exists('web')) {
    function web(){
      $web = new \App\Models\WebsiteModel();
      return $web->getSettings()->getRow();
    }
  }

  if (!function_exists('period')) {
    function period(){
      $web = new \App\Models\PeriodYearModel();
      return $web->getPeriodActive()->getRow();
    }
  }

  if (!function_exists('periods')) {
    function periods(){
      $web = new \App\Models\PeriodYearModel();
      return $web->getData()->getResultArray();
    }
  }

  if (!function_exists('setCookiePeriod')) {
    function setCookiePeriod($periodyear){
      
      $coo = [
        'name' => 'periodyear',
        'value' => $periodyear,
        'expire' => '3600',
      ];
      
      return set_cookie($coo);
    }
  }

  function setMyCookie($name,$value,$time,$params = array()){
      if (empty($params)){
          $config = config('App');

          $params = array(
              'expires'   => $time,
              'path'      => $config->cookiePath,
              'domain'    => $config->cookieDomain,
              'secure'    => $config->cookieSecure,
              'httponly'  => $config->cookieHTTPOnly,
              'samesite'  => $config->cookieSameSite,
          );
      }

      setcookie($name,$value,$params);
  }

  if (!function_exists('initial')) {
    function initial($name)
    {
      $words = explode(' ', $name);
      if (count($words) >= 2) {
          return strtoupper(substr($words[0], 0, 1) . substr($words[1], 0, 1));
      }else{
        preg_match_all('#([A-Z]+)#', $name, $capitals);
        if (count($capitals[1]) >= 2) {
            return substr(implode('', $capitals[1]), 0, 2);
        }
        return strtoupper(substr($name, 0, 2));
      }
    }
  }

?>