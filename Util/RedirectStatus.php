<?php 

namespace BOMO\RedirectBundle\Util;

class RedirectStatus {

    public static function getRedirectStatus()
    {
        $status = \Symfony\Component\HttpFoundation\Response::$statusTexts;

        foreach ($status as $key => $st) {
            if ($key < 300 || $key >= 400) {
                unset($status[$key]);
            }
            
        }

        return $status;
    }
}
