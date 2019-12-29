<?php

class FontAwesomeSVG {

    public $svg_dir;

    public function __construct($svg_dir) {
        $this->svg_dir = $svg_dir;
    }




    /**
     * Get SVG icon
     * 
     * @param string $id    icon ID e.g. fas fa-house
     * @param array $opts   options array
     * @return string|boolean
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
            'fill' => 'currentColor',
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

                $title_node = $item->appendChild($title);

                // <title> id attribute has to be set to add aria-labelledby
                if(isset($opts['title_id'])) {
                    $title_id = $opts['title_id'];
                    $title_node->setAttribute('id', $title_id);
                    $item->setAttribute('aria-labelledby', $title_id);
                }
                
            } else {
                $item->setAttribute('aria-hidden', 'true');
            }
        }

        foreach ($doc->getElementsByTagName('path') as $item) {
            $item->setAttribute('fill', $opts['fill']);
        }
        
        return $doc->saveHTML();
    }




    /**
     * Get an icon's details from icon ID
     * 
     * @param string $id    icon ID e.g. fas fa-house
     * @return array
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
     * Get the directory that contains the SVG icon file
     * 
     * @param string $style
     * @return string
     */
    public function get_icon_dir($style) {
        switch($style) {
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
     * Get the icon's SVG file name
     * 
     * @param string $icon_name
     * @return string
     */
    public function get_icon_filename($icon_name) {
        return str_replace('fa-', '', $icon_name);
    }
}