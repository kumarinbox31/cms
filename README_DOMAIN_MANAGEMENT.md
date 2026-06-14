# Hosting, Domain & Email Management Module

This document outlines the usage and setup of the newly implemented Hosting Management module.

## Features
1. **Website Lifecycle Protections**: Safety checks before website creation, update, and a multi-step delete wizard.
2. **Email Management**: Create, edit, suspend, and delete cPanel email accounts directly from the panel.
3. **Sync & Cleanup Center**: Tools to find orphan cPanel domains and manually synchronize domains and emails.
4. **Automated Cron Jobs**: Background processes to continuously track DNS statuses and disk usage.
5. **Dashboard Widgets**: New metrics on the Super Admin Dashboard.

---

## 1. Environment Configuration
You must add the following variables to your root `.env` file:

```env
# cPanel API
CPANEL_HOST=your_cpanel_host.com
CPANEL_PORT=2083
CPANEL_USERNAME=your_cpanel_username
CPANEL_API_TOKEN=your_cpanel_api_token
CPANEL_SSL=true

# Hosting DNS
HOSTING_MAIN_IP=103.108.220.15
HOSTING_NS1=sg.solidhosting.pro
HOSTING_NS2=in.solidhosting.pro
HOSTING_NS3=us.solidhosting.pro
HOSTING_NS4=eu.solidhosting.pro

# Domain Checker
DNS_CHECK_TIMEOUT=10
DNS_PROPAGATION_HOURS=48

# Cron
DOMAIN_CHECK_BATCH_SIZE=100
EMAIL_SYNC_BATCH_SIZE=100
```

---

## 2. Database Migrations
Run the SQL files located in the `migration/` folder to create the required tables:
1. `001_add_domain_columns_to_websites.sql`
2. `002_create_hosting_management_tables.sql`

---

## 3. Cron Job Setup
For full automation of DNS tracking and Email synchronization, add the following to your server's crontab (accessed via `crontab -e` on Linux):

```bash
# Domain Status Check (Every 15 Minutes)
*/15 * * * * php /path/to/cms-tool/index.php cron domain_status

# Email Sync (Every 1 Hour)
0 * * * * php /path/to/cms-tool/index.php cron email_sync

# Full Audit & Orphan Cleanup (Daily at 2 AM)
0 2 * * * php /path/to/cms-tool/index.php cron full_audit
```
*(Make sure to replace `/path/to/cms-tool/` with the absolute path to your project).*

## 4. Usage Notes
- **Delete Wizard**: The old delete button now routes to a Wizard where Super Admins can selectively delete Panel Records, cPanel Addons, Emails, and Subdomains.
- **Health Score**: A percentage (0-100) indicating if a domain's DNS is pointed, addon is installed, and if it's active.
- **Cleanup Center**: Navigate to `Hosting -> Cleanup Center` to run manual syncs or hunt down orphan addon domains.
