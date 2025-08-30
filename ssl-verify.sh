#!/bin/bash

# SSL Configuration Verification Script for meetMyTech
# Run this script on your AWS server to verify SSL setup

echo "🔐 SSL Configuration Verification for meetMyTech"
echo "================================================"

# Check Apache configuration
echo ""
echo "1. Checking Apache SSL configuration..."
sudo apache2ctl configtest

# Check if SSL certificates exist
echo ""
echo "2. Checking SSL certificate files..."
if [ -f "/etc/letsencrypt/live/meetmytech.com/fullchain.pem" ]; then
    echo "✅ SSL certificate found: /etc/letsencrypt/live/meetmytech.com/fullchain.pem"

    # Check certificate validity
    echo ""
    echo "3. Checking certificate details..."
    openssl x509 -in /etc/letsencrypt/live/meetmytech.com/fullchain.pem -text -noout | grep -A 2 "Subject:"
    openssl x509 -in /etc/letsencrypt/live/meetmytech.com/fullchain.pem -text -noout | grep -A 5 "DNS:"

    # Check certificate expiry
    echo ""
    echo "4. Certificate expiration date:"
    openssl x509 -in /etc/letsencrypt/live/meetmytech.com/fullchain.pem -enddate -noout
else
    echo "❌ SSL certificate not found!"
fi

# Check private key
if [ -f "/etc/letsencrypt/live/meetmytech.com/privkey.pem" ]; then
    echo "✅ Private key found: /etc/letsencrypt/live/meetmytech.com/privkey.pem"
else
    echo "❌ Private key not found!"
fi

# Test SSL connectivity
echo ""
echo "5. Testing SSL connectivity..."

echo "Testing main domain (meetmytech.com):"
curl -I https://meetmytech.com/ 2>/dev/null | head -1 || echo "❌ Main domain SSL test failed"

echo "Testing www subdomain (www.meetmytech.com):"
curl -I https://www.meetmytech.com/ 2>/dev/null | head -1 || echo "❌ WWW subdomain SSL test failed"

echo "Testing user subdomain (vikas.meetmytech.com):"
curl -I https://vikas.meetmytech.com/ 2>/dev/null | head -1 || echo "❌ User subdomain SSL test failed"

# Check Apache status
echo ""
echo "6. Apache service status:"
sudo systemctl status apache2 --no-pager -l

# Check if ports are open
echo ""
echo "7. Checking open ports:"
sudo netstat -tlnp | grep -E ':(80|443)'

# Test HTTP to HTTPS redirect
echo ""
echo "8. Testing HTTP to HTTPS redirect:"
curl -I http://meetmytech.com/ 2>/dev/null | grep -E "(301|302)" && echo "✅ HTTP redirect working" || echo "❌ HTTP redirect not working"

echo ""
echo "🔐 SSL verification completed!"
echo ""
echo "If you see any ❌ errors above, please check:"
echo "1. Apache configuration in /etc/apache2/sites-available/laravel.conf"
echo "2. SSL certificate files in /etc/letsencrypt/live/meetmytech.com/"
echo "3. DNS settings for subdomains in GoDaddy"
echo "4. Security groups in AWS EC2 (ports 80 and 443 should be open)"
