# Bytesool - Local Server Setup Guide

## Quick Setup (Choose One Method)

### Method 1: XAMPP (Easiest - Recommended)

1. **Download XAMPP**
   - Go to: https://www.apachefriends.org/
   - Download XAMPP for Windows
   - Install it (default location: `C:\xampp`)

2. **Copy Your Files**
   - Copy the entire `bytesool` folder
   - Paste it into: `C:\xampp\htdocs\bytesool`

3. **Start Apache**
   - Open **XAMPP Control Panel**
   - Click **Start** next to Apache
   - Wait for it to turn green

4. **Access Your Website**
   - Open browser and go to: `http://localhost/bytesool/index.html`
   - Or: `http://localhost/bytesool/contact.html`

5. **Test Contact Form**
   - Fill out the form on contact.html
   - Submit it
   - You should see a success message
   - Check your email (the one set in `contact.php` line 29)

---

### Method 2: PHP Built-in Server

1. **Install PHP**
   - Download from: https://windows.php.net/download/
   - Extract to: `C:\php`
   - Add `C:\php` to your Windows PATH:
     - Right-click "This PC" → Properties → Advanced System Settings
     - Click "Environment Variables"
     - Under "System Variables", find "Path" → Edit
     - Add: `C:\php`
     - Click OK

2. **Start Server**
   - Open Command Prompt in this folder
   - Run: `php -S localhost:8000`
   - Or double-click `START_SERVER.bat`

3. **Access Website**
   - Open: `http://localhost:8000/index.html`

---

### Method 3: Python Simple Server (For Testing HTML/CSS Only - PHP Won't Work)

**Note:** This method will NOT run PHP, so contact form won't work!

```bash
python -m http.server 8000
```

Then open: `http://localhost:8000/index.html`

---

## Important Notes

- **Contact Form Email**: Edit `contact.php` line 29 to set your email:
  ```php
  $to = 'your-email@gmail.com'; // Change this!
  ```

- **File Location**: Make sure `contact.php` is in the same folder as `contact.html`

- **Testing**: After submitting the form, you should see:
  - URL changes to: `contact.html?success=1` (green message)
  - OR: `contact.html?error=1` (red message)

---

## Troubleshooting

**Form not submitting?**
- Make sure you're accessing via `http://localhost/...` NOT `file:///...`
- Check that Apache is running (if using XAMPP)
- Check browser console for errors (F12)

**Email not received?**
- Check spam folder
- Verify email in `contact.php` is correct
- Some local servers don't send emails - check if success message appears (that means PHP is working)

**Need Help?**
- Check XAMPP logs: `C:\xampp\apache\logs\error.log`
- Check PHP errors in browser console (F12)
