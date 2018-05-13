<?php

class FontAwesomeSVG {

    public $svg_dir;

    public function __construct($svg_dir) {
        $this->svg_dir = $svg_dir;
    }




    /**
     * 
     */
    public function get_svg($id, $opts=false) {
        try {
            $icon = $this->get_icon_details($id);
        } catch(Exception $e) {
            return false;
        }

        $doc = new DOMDocument();
        $doc->load($icon['filepath']);

        $default_opts = [
            'title' => false,
            'class' => false,
            'default_class' => true,
            'role' => 'img',
        ];

        if (is_array($opts)) {
            $opts = array_merge($default_opts, $opts);
        } else {
            $opts = $default_opts;
        }



        $classes = '';
        if($opts['default_class']) {
            $classes .= 'svg-inline--fa';
        }
        if($opts['class']) {
            $classes .= ' ' . $opts['class'];
        }


        foreach ($doc->getElementsByTagName('svg') as $item) {
            if($classes != '') $item->setAttribute('class', $classes);
            if($opts['role']) $item->setAttribute('role', $opts['role']);
            

            if($opts['title']) {
                $title = $doc->createElement("title");
                $title->nodeValue = $opts['title'];

                // TODO: add aria-labelledby
                //$title->setAttribute('id', '');
                //$item->setAttribute('aria-labelledby', '');

                $item->appendChild($title);
            } else {
                $item->setAttribute('aria-hidden', 'true');
            }
        }
        
        return $doc->saveHTML();
    }




    /**
     * 
     */
    public function get_icon_details($id) {
        $icon = array();

        $id = explode(' ', $id);
        $dir = $this->get_icon_dir($id[0]);
        $filename = $this->get_icon_filename($id[1]);

        $icon['dir'] = $dir;
        $icon['filename'] = $filename;
        $icon['filepath'] = str_replace('/', DIRECTORY_SEPARATOR, "$this->svg_dir/$dir/$filename.svg");

        if(!is_file($icon['filepath'])) {
            throw new Exception('File ' . $icon['filepath'] . ' does not exist.');
        }

        return $icon;
    }




    /**
     * 
     */
    public function get_icon_dir($iconID) {
        switch($iconID) {
            case 'fas':
                $dir = 'solid';
                break;

            case 'far':
                $dir = 'regular';
                break;

            case 'fal':
                $dir = 'light';
                break;

            case 'fab':
                $dir = 'brands';
                break;

            default:
                $dir = 'solid';
        }

        return $dir;
    }




    /**
     * 
     */
    public function get_icon_filename($icon_name) {
        return str_replace('fa-', '', $icon_name);
    }
}