CREATE TABLE `ab_domain_logs` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `user_id` INT(11) NOT NULL,
  `ip_address` VARCHAR(45) NULL,
  `action` VARCHAR(255) NOT NULL,
  `response` TEXT NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `ab_email_accounts` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `email_address` VARCHAR(100) NOT NULL,
  `website_id` INT(11) NOT NULL,
  `domain` VARCHAR(100) NOT NULL,
  `quota` VARCHAR(20) DEFAULT 'unlimited',
  `used_space` VARCHAR(20) DEFAULT '0',
  `status` VARCHAR(50) DEFAULT 'Active',
  `last_sync` DATETIME NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `ab_email_logs` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `email_id` INT(11) NULL,
  `action` VARCHAR(255) NOT NULL,
  `details` TEXT NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `ab_sync_history` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `type` VARCHAR(50) NOT NULL COMMENT 'domain, email, full',
  `start_time` DATETIME NOT NULL,
  `end_time` DATETIME NULL,
  `status` VARCHAR(50) DEFAULT 'Running',
  `items_synced` INT(11) DEFAULT 0,
  `log` TEXT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `ab_cleanup_logs` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `type` VARCHAR(50) NOT NULL COMMENT 'orphan_domain, orphan_email, missing_domain, missing_email',
  `entity` VARCHAR(255) NOT NULL,
  `action_taken` VARCHAR(100) NOT NULL,
  `details` TEXT NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `ab_hosting_audit` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `website_id` INT(11) NOT NULL,
  `health_score` INT(3) NOT NULL,
  `details` TEXT NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
