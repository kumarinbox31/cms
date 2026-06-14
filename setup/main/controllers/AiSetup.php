<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AiSetup extends CI_Controller {

    public function install() {
        $queries = [
            "CREATE TABLE IF NOT EXISTS ab_settings (
                id INT AUTO_INCREMENT PRIMARY KEY,
                setting_key VARCHAR(100) NOT NULL UNIQUE,
                setting_value TEXT NULL,
                admin_id INT NULL DEFAULT 0,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;",

            "CREATE TABLE IF NOT EXISTS ab_ai_prompts_history (
                id INT AUTO_INCREMENT PRIMARY KEY,
                admin_id INT NOT NULL,
                prompt TEXT NOT NULL,
                response_json LONGTEXT NULL,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;",
            
            "CREATE TABLE IF NOT EXISTS ab_ai_components (
                id INT AUTO_INCREMENT PRIMARY KEY,
                name VARCHAR(255) NOT NULL,
                category VARCHAR(100) NOT NULL,
                html LONGTEXT NOT NULL,
                css LONGTEXT NULL,
                thumbnail VARCHAR(255) NULL,
                tags VARCHAR(255) NULL,
                created_by INT NULL DEFAULT 0,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;",

            "CREATE TABLE IF NOT EXISTS ab_ai_design_tokens (
                id INT AUTO_INCREMENT PRIMARY KEY,
                website_id INT NOT NULL DEFAULT 0,
                theme_id INT NOT NULL DEFAULT 0,
                token_key VARCHAR(100) NOT NULL,
                token_value VARCHAR(255) NOT NULL,
                updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;"
        ];

        foreach ($queries as $query) {
            if (!$this->db->query($query)) {
                echo "Error executing query: " . $this->db->error()['message'] . "<br>";
                return;
            }
        }
        
        // Insert default setting if not exists
        $this->db->query("INSERT IGNORE INTO ab_settings (setting_key, setting_value, admin_id) VALUES ('ai_provider', 'openrouter', 0)");
        $this->db->query("INSERT IGNORE INTO ab_settings (setting_key, setting_value, admin_id) VALUES ('ai_model', 'qwen/qwen-2.5-coder-32b-instruct', 0)");
        $this->db->query("INSERT IGNORE INTO ab_settings (setting_key, setting_value, admin_id) VALUES ('ai_api_key', '', 0)");

        // Seed initial AI components if they don't exist
        $componentCheck = $this->db->get('ab_ai_components');
        if ($componentCheck->num_rows() == 0) {
            $heroHTML = '<section class="ai-hero py-5 text-center"><div class="container"><h1 class="display-4 fw-bold">Hero Title</h1><p class="lead text-muted">Subtitle for hero section</p><a href="#" class="btn btn-primary btn-lg mt-3">Call to Action</a></div></section>';
            $heroCSS = '.ai-hero { background-color: var(--ai-bg-color, #f8f9fa); padding: 80px 0; }';
            
            $pricingHTML = '<section class="ai-pricing py-5"><div class="container text-center"><div class="row"><div class="col-md-4"><div class="card mb-4 shadow-sm"><div class="card-header"><h4 class="my-0 fw-normal">Basic</h4></div><div class="card-body"><h1 class="card-title pricing-card-title">$10 <small class="text-muted">/ mo</small></h1><ul class="list-unstyled mt-3 mb-4"><li>Feature 1</li><li>Feature 2</li></ul><button type="button" class="w-100 btn btn-lg btn-outline-primary">Sign up</button></div></div></div></div></div></section>';
            $pricingCSS = '.ai-pricing { background-color: #fff; } .ai-pricing .card { border-radius: 10px; }';
            
            $faqHTML = '<section class="ai-faq py-5"><div class="container"><h2 class="text-center mb-4">Frequently Asked Questions</h2><div class="accordion" id="faqAccordion"><div class="accordion-item"><h2 class="accordion-header"><button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne">Question 1</button></h2><div id="collapseOne" class="accordion-collapse collapse show"><div class="accordion-body">Answer 1</div></div></div></div></div></section>';
            $faqCSS = '.ai-faq { background-color: #f8f9fa; }';

            $this->db->insert_batch('ab_ai_components', [
                ['name' => 'Default Hero', 'category' => 'hero', 'html' => $heroHTML, 'css' => $heroCSS, 'tags' => 'hero, header, main'],
                ['name' => 'Basic Pricing', 'category' => 'pricing', 'html' => $pricingHTML, 'css' => $pricingCSS, 'tags' => 'pricing, cost, plans'],
                ['name' => 'Standard FAQ', 'category' => 'faq', 'html' => $faqHTML, 'css' => $faqCSS, 'tags' => 'faq, questions, help']
            ]);
        }

        echo "AI Builder Pro Tables created and seeded successfully!";
    }
}
