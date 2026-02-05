@echo off
echo ========================================
echo   Bytesool Local Server Setup
echo ========================================
echo.
echo Checking for PHP...

where php >nul 2>&1
if %ERRORLEVEL% EQU 0 (
    echo PHP found! Starting server...
    echo.
    echo Server will start at: http://localhost:8000
    echo.
    echo Press Ctrl+C to stop the server
    echo.
    php -S localhost:8000
) else (
    echo PHP is not installed!
    echo.
    echo Please install one of the following:
    echo.
    echo OPTION 1: XAMPP (Recommended - Easy Setup)
    echo   1. Download from: https://www.apachefriends.org/
    echo   2. Install XAMPP
    echo   3. Copy this folder to: C:\xampp\htdocs\bytesool
    echo   4. Start Apache from XAMPP Control Panel
    echo   5. Open: http://localhost/bytesool/index.html
    echo.
    echo OPTION 2: PHP Standalone
    echo   1. Download PHP from: https://windows.php.net/download/
    echo   2. Extract and add to PATH
    echo   3. Run this file again
    echo.
    pause
)
