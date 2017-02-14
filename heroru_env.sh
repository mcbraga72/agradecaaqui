heroku config:set APP_ENV=local
heroku config:set APP_KEY=base64:wIZx+Cd9mNwszMUL1+H3CsfAnlXNQyhj7OC8ekKbZZw=
heroku config:set APP_DEBUG=true
heroku config:set APP_LOG_LEVEL=debug
heroku config:set APP_URL=https://stark-wildwood-60445.herokuapp.com

heroku config:set DB_CONNECTION=pgsql
heroku config:set DB_HOST=ec2-54-163-254-48.compute-1.amazonaws.com
heroku config:set DB_PORT=5432
heroku config:set DB_DATABASE=d9dt6ip1pjqeiv
heroku config:set DB_USERNAME=myhmxpjoflnthi
heroku config:set DB_PASSWORD=dccdfca478be0b69baf161d546c67ec96624bb7a8aaaed11820163a35d63e548

heroku config:set BROADCAST_DRIVER=log
heroku config:set CACHE_DRIVER=file
heroku config:set QUEUE_DRIVER=sync

heroku config:set SESSION_DRIVER=file
heroku config:set SESSION_DOMAIN=stark-wildwood-60445.herokuapp.com

heroku config:set REDIS_HOST=127.0.0.1
heroku config:set REDIS_PASSWORD=null
heroku config:set REDIS_PORT=6379

heroku config:set MAIL_DRIVER=smtp
heroku config:set MAIL_HOST=mailtrap.io
heroku config:set MAIL_PORT=2525
heroku config:set MAIL_USERNAME=null
heroku config:set MAIL_PASSWORD=null
heroku config:set MAIL_ENCRYPTION=null

heroku config:set PUSHER_APP_ID=
heroku config:set PUSHER_APP_KEY=
heroku config:set PUSHER_APP_SECRET=
