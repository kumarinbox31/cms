<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class TemplateGenerator {
    
    protected $CI;

    public function __construct() {
        $this->CI =& get_instance();
        $this->CI->load->database();
    }

    /**
     * Converts AI JSON layout into combined HTML and CSS
     * 
     * @param array $sections Array of section definitions from AI JSON
     * @return array ['html' => string, 'css' => string]
     */
    public function generate_page($sections) {
        $html_output = '';
        $css_output = '';

        if (empty($sections) || !is_array($sections)) {
            return ['status' => false, 'error' => 'Invalid section format provided.'];
        }

        foreach ($sections as $section) {
            $type = isset($section['type']) ? strtolower($section['type']) : '';
            if (empty($type)) continue;

            // Fetch a template from the component library matching the type/category
            $query = $this->CI->db->order_by('RAND()')->get_where('ab_ai_components', ['category' => $type], 1);
            
            if ($query->num_rows() > 0) {
                $component = $query->row();
                
                $section_html = $component->html;
                $section_css = $component->css;

                // Replace dummy content with AI provided data
                if (isset($section['title'])) {
                    $section_html = preg_replace('/<h1[^>]*>(.*?)<\/h1>/i', '<h1>' . htmlspecialchars($section['title']) . '</h1>', $section_html);
                }
                if (isset($section['subtitle'])) {
                    $section_html = preg_replace('/<p class="lead[^>]*>(.*?)<\/p>/i', '<p class="lead text-muted">' . htmlspecialchars($section['subtitle']) . '</p>', $section_html);
                }

                // If AI provides an image keyword, fetch an image and replace placeholders
                if (isset($section['image_keyword'])) {
                    $this->CI->load->library('ImageFetcher');
                    $imageUrl = $this->CI->imagefetcher->fetch_image($section['image_keyword']);
                    
                    // Replace <img src="..."> or background-image URLs in the section
                    // We'll look for generic placeholder patterns or simply the first image
                    $section_html = preg_replace('/<img([^>]*)src="([^"]*)"([^>]*)>/i', '<img$1src="' . $imageUrl . '"$3>', $section_html);
                }
                
                $html_output .= $section_html . "\n";
                $css_output .= $section_css . "\n";
            } else {
                // Fallback if no matching section is found
                $html_output .= "<!-- Missing component library item for type: $type -->\n";
            }
        }

        return [
            'status' => true,
            'html' => $html_output,
            'css' => $css_output
        ];
    }
}
