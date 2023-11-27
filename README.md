# Laravel+Inertia+Vue 3+Tailwind+Vite App Template

This package is a full template/scaffolding using the following technologies:
* Laravel
* Inertia.js
* TailwindCSS
* Vite
* Vue.js (version 3 with Composition API)
* for use with DDEV
* Laravel Vue i18n

At its core, it's using the Laravel PHP Framework, together with Laravel JetStream providing basic
authentication, and user profile.
Additionally, it provides some sample code to list and edit users.

## Installation

1. git clone https://github.com/pronego/laravel-inertia-vue3-tailwind-template.git myapp

2. cd myapp/

3.  `ddev config --project-type=laravel --docroot=public --create-docroot --php-version=8.2`

4. Install phpmyadmin: `ddev get ddev/ddev-phpmyadmin`

5. Copy `.env.example` to `.env` and adjust accordingly

6. `ddev start`

7. `ddev composer install`

8. `ddev exec "php artisan key:generate"`

9. `ddev npm install`

10. `ddev php artisan migrate`

11. `ddev php artisan db:seed` 

12. Enable xdebug: `ddev xdebug`
  Verify in `.ddev/config.yaml` that `xdebug_enabled: true`

13. Adjust `.ddev/config.yaml`, add
    ```
    nodejs_version: "18"
      hooks:
        post-start:
        - exec: "npm run dev -- --host"
    ```

14. Create `.ddev/docker-compose.vite.yaml`:
   ```
   # Override the web container's standard HTTP_EXPOSE and HTTPS_EXPOSE services
   # to expose port 3000 of DDEV's web container.
   version: '3.6'
   services:
      web:
      expose:
        - "5173"
      environment:
        HTTP_EXPOSE: ${DDEV_ROUTER_HTTP_PORT}:80,${DDEV_MAILHOG_PORT}:8025,5174:5173
        HTTPS_EXPOSE: ${DDEV_ROUTER_HTTPS_PORT}:80,${DDEV_MAILHOG_HTTPS_PORT}:8025,5173:5173
   ```
   
15. `ddev restart`

> Open application and login with `info@pronego.com` and password `test`.



## License
The Laravel framework, Inertia.js, Vite, Vue.js, and Tailwind CSS are open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
DDEV is licensed under the [Apache License 2.0](https://raw.githubusercontent.com/ddev/ddev/master/LICENSE).