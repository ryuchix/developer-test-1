## How to use

- Clone the repository with __git clone__

__Back-end__

- Go to the sub-folder `cd backend`
- Copy __.env.example__ file to __.env__ and edit database credentials there
- Add correct value of your domain for front URL in this variable: `URL=[your_domain]/verify/`
- Run __composer install__
- Run __php artisan key:generate__
- Run __php artisan passport:install__
- For storing file be sure to run __php artisan storage:link__


__Front-end__

- Go to the sub-folder `cd frontend`
- Run __npm install__ 
- Run __npm run serve__ 
- That's it: launch the URL that appears in the terminal - could be `http://localhost:8080`

