<?php
/**
 * Created by PhpStorm.
 * User: loic
 * Date: 23/09/2019
 * Time: 00:02
 */

namespace App\vendor;


use Pagerfanta\View\Template\DefaultTemplate;
use Pagerfanta\View\Template\TwitterBootstrap4Template;

class CustomPaginationTemplate extends TwitterBootstrap4Template
{

    protected function linkLi($class, $href, $text, $rel = null)
    {
        $liClass = implode(' ', array_filter(array('page-item', $class)));
        $rel = $rel ? sprintf(' rel="%s"', $rel) : '';

        return sprintf('<li class="%s ml-10"><a class="lezada-button lezada-button--small" href="%s"%s>%s</a></li>', $liClass, $href, $rel, $text);
    }

    protected function spanLi($class, $text)
    {
        $liClass = implode(' ', array_filter(array('page-item', $class)));

        return sprintf('<li class="%s"><span class="lezada-button lezada-button--small">%s</span></li>', $liClass, $text);
    }

}