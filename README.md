## Installing

To install the application, run the following commands:

- git clone https://github.com/MoaaidJamal/qr_generator.git
- cd qr_generator
- composer install
- npm install
- cp .env.example .env
- php artisan key:generate
- php artisan storage:link
- php artisan migrate


If you are using Laravel Valet, you need to change the APP_URL in .env file to match the URL you will use from Laravel Valet and then run this command:
- npm run dev

If not run these commands
- npm run build
- php artisan serve
