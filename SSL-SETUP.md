# SSL Configuration for meetMyTech

## Overview
This document describes the SSL configuration for meetMyTech.com and its subdomains using Let's Encrypt wildcard certificates.

## Current Setup

### 1. Apache Configuration (`/etc/apache2/sites-available/laravel.conf`)
```apache
# HTTP - Redirect ALL to HTTPS
<VirtualHost *:80>
    ServerName meetmytech.com
    ServerAlias www.meetmytech.com *.meetmytech.com
    RewriteEngine On
    RewriteRule ^ https://%{HTTP_HOST}%{REQUEST_URI} [L,R=301]
</VirtualHost>

# HTTPS - Root + www
<VirtualHost *:443>
    ServerName meetmytech.com
    ServerAlias www.meetmytech.com
    DocumentRoot /var/www/laravel/public
    SSLEngine on
    SSLCertificateFile /etc/letsencrypt/live/meetmytech.com/fullchain.pem
    SSLCertificateKeyFile /etc/letsencrypt/live/meetmytech.com/privkey.pem
</VirtualHost>

# HTTPS - Wildcard Subdomains
<VirtualHost *:443>
    ServerName subdomain.meetmytech.com
    ServerAlias *.meetmytech.com
    DocumentRoot /var/www/laravel/public
    SSLEngine on
    SSLCertificateFile /etc/letsencrypt/live/meetmytech.com/fullchain.pem
    SSLCertificateKeyFile /etc/letsencrypt/live/meetmytech.com/privkey.pem
</VirtualHost>
```

### 2. Let's Encrypt Certificate
- **Type**: Wildcard certificate
- **Domains Covered**: `*.meetmytech.com` and `meetmytech.com`
- **Certificate Path**: `/etc/letsencrypt/live/meetmytech.com/fullchain.pem`
- **Private Key Path**: `/etc/letsencrypt/live/meetmytech.com/privkey.pem`

### 3. Laravel Configuration

#### Production Environment Variables (`.env`)
```env
APP_ENV=production
APP_URL=https://meetmytech.com
APP_DOMAIN=meetmytech.com
FORCE_HTTPS=true
SESSION_SECURE_COOKIE=true
SESSION_DOMAIN=.meetmytech.com
```

#### Middleware
- `ForceHttps` middleware automatically redirects HTTP to HTTPS in production
- Registered in `app/Http/Kernel.php` global middleware stack

#### Service Provider
- `SslServiceProvider` forces HTTPS URLs and configures trusted proxies

## Subdomain Routing

### How it Works
1. **DNS Configuration**: Wildcard A record `*.meetmytech.com` points to AWS EC2 IP
2. **Apache**: Wildcard SSL certificate serves all subdomains
3. **Laravel**: Route domain grouping handles subdomain requests

### Example URLs
- Main site: `https://meetmytech.com`
- User profiles: `https://vikas.meetmytech.com`, `https://jyothi.meetmytech.com`
- All automatically redirect from HTTP to HTTPS

## Certificate Management

### Renewal
Let's Encrypt certificates auto-renew via cron job. To manually renew:
```bash
sudo certbot renew
sudo systemctl reload apache2
```

### Check Certificate Status
```bash
sudo certbot certificates
```

## Verification Commands

### Run SSL Verification Script
```bash
chmod +x ssl-verify.sh
./ssl-verify.sh
```

### Manual Tests
```bash
# Test main domain
curl -I https://meetmytech.com/

# Test subdomain
curl -I https://vikas.meetmytech.com/

# Test HTTP redirect
curl -I http://meetmytech.com/
```

## Troubleshooting

### Common Issues
1. **Certificate not found**: Check file paths in Apache config
2. **Subdomain not working**: Verify DNS wildcard record
3. **Mixed content warnings**: Ensure all resources use HTTPS URLs
4. **Session issues**: Check `SESSION_DOMAIN` in `.env`

### Logs
- Apache errors: `/var/log/apache2/error.log`
- Laravel logs: `/var/www/laravel/storage/logs/laravel.log`

### DNS Verification
```bash
dig meetmytech.com
dig vikas.meetmytech.com
```

## Security Best Practices
- Automatic HTTP to HTTPS redirect enabled
- Secure cookie settings in production
- Strong SSL configuration with modern ciphers
- Regular certificate monitoring and renewal
