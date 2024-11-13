# vue-inertia-crm-bw
Laravel + Vue(Inertia) CRUD with Breeze User Authentication for Binarywebs

1. Download vue-inertia-crm-bw
2. Copy folder to Laravel projects folder
3. Copy vue-inertia-crm-bw\\.env.example to vue-inertia-crm-bw\\.env
4. Update .env MAIL_X values to preferred SMTP settings
5. CLI: cd vue-inertia-crm-bw
6. composer install
7. php artisan key:generate
8. mysql -u root -p -e "CREATE DATABASE vue_inertia_crm_bw"
9. php artisan migrate:fresh --seed
10. npm install
11. php artisan serve
12. npm run dev

http://localhost:8000

User Logins
-----------
admin@admin.com  |  password
<br>
editor@edit.com  |  password
