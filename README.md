This is an attempt at modifying the source code release of Nextcloud to run on PaaS services, at the moment mainly Heroku.

To run this on your own, clone this repo and deploy it to Heroku. Then attach a database service (I've only had success with Postgres).
Set up your DB by running bash in a one-off dyno, then run `php occ maintenance:install --database-url $DATABASE_URL --admin-user "admin" --admin-pass "password"`.
Make note of the secret and password salt, which you should then save in the Heroku config vars `SECRET` and `PASSWORD_SALT` respectively.

That should get a basic install operational, though of course since Heroku does not have filesystem persistance, to keep your Nextcloud files you will need to enable cloud object storage.
This is where I am currently having trouble (I can get it to work but PHP runs out of memory).
Put your S3-compatible keys in the config vars `S3_BUCKET`, `S3_HOSTNAME`, `S3_KEY`, and `S3_SECRET`.

I don't know if there's anything worth pursuing here or the combo of Heroku's low default memory and the latency induced by object storage means this is doomed to failure.
Please let me know if you're interested in helping.
