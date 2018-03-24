<?php

class ViewRenderer {

    private static function get_template_location($filename) {
      return  __ROOT__ .'/templates/'.$filename;
    }

    public static function render($tpl, $data) {
      ob_start();
      include(ViewRenderer::get_template_location($tpl));
      $output = str_replace(array("\r", "\n"), '', ob_get_contents());
      ob_end_clean();
      return $output;
    }
  }
