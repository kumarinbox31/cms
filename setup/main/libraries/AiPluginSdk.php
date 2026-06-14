<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AiPluginSdk {
    
    protected $CI;
    protected $registered_widgets = [];

    public function __construct() {
        $this->CI =& get_instance();
        $this->CI->load->database();
    }

    /**
     * SDK Hook for third-party developers to register custom AI widgets/sections
     * 
     * @param string $name Display name of the widget (e.g. 'Advanced Pricing Table')
     * @param string $category The category it belongs to (e.g. 'pricing', 'hero')
     * @param string $html The raw HTML template with placeholders
     * @param string $css The CSS styling for the widget
     * @param string $tags Comma separated tags for searchability
     */
    public function register_ai_widget($name, $category, $html, $css = '', $tags = '') {
        $this->registered_widgets[] = [
            'name' => $name,
            'category' => strtolower($category),
            'html' => $html,
            'css' => $css,
            'tags' => $tags
        ];

        // In a real execution environment, we might directly inject these into memory 
        // during runtime, or sync them to the ab_ai_components table.
        // For persistence across sessions without rescanning files every load, we sync them to the DB.
        $this->sync_widget_to_db($name, $category, $html, $css, $tags);
    }

    /**
     * Internal method to ensure the widget exists in the component library table
     */
    private function sync_widget_to_db($name, $category, $html, $css, $tags) {
        $chk = $this->CI->db->get_where('ab_ai_components', [
            'name' => $name,
            'category' => $category
        ]);

        if ($chk->num_rows() == 0) {
            $this->CI->db->insert('ab_ai_components', [
                'name' => $name,
                'category' => $category,
                'html' => $html,
                'css' => $css,
                'tags' => $tags,
                'created_by' => 999 // Representing a plugin/SDK
            ]);
        }
    }

    /**
     * Get all dynamically registered widgets
     */
    public function get_registered_widgets() {
        return $this->registered_widgets;
    }
}
