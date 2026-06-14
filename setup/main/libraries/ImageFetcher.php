<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ImageFetcher {
    
    protected $api_key;
    protected $provider = 'pexels'; // or 'unsplash'
    
    public function __construct() {
        $CI =& get_instance();
        $CI->load->model('AiModel');
        // Retrieve key from settings, fallback to empty string
        $this->api_key = $CI->AiModel->get_setting('image_api_key', CLIENT_ID);
    }
    
    /**
     * Search for an image based on a keyword
     * 
     * @param string $keyword The search term (e.g. "construction site")
     * @return string URL of the image, or a generic placeholder if failed
     */
    public function fetch_image($keyword) {
        if (empty($this->api_key)) {
            // Fallback placeholder if no API key is provided
            return 'https://via.placeholder.com/800x600?text=' . urlencode($keyword);
        }

        if ($this->provider === 'pexels') {
            return $this->fetch_from_pexels($keyword);
        }
        
        return 'https://via.placeholder.com/800x600?text=' . urlencode($keyword);
    }

    private function fetch_from_pexels($keyword) {
        $url = "https://api.pexels.com/v1/search?query=" . urlencode($keyword) . "&per_page=1";

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Authorization: ' . $this->api_key
        ]);
        
        $response = curl_exec($ch);
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($http_code === 200) {
            $data = json_decode($response, true);
            if (!empty($data['photos']) && count($data['photos']) > 0) {
                // Return a medium-large sized image
                return $data['photos'][0]['src']['large'];
            }
        }

        // Fallback placeholder
        return 'https://via.placeholder.com/800x600?text=' . urlencode($keyword);
    }
}
