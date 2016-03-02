require('es6-promise').polyfill(); # fix the problem with running autoprefixer just after sass task

Path          = require 'path'
Gulp          = require 'gulp'
Yargs         = require 'yargs'
Coffee        = require 'gulp-coffee'
Changed       = require 'gulp-changed'
GUtil         = require 'gulp-util'
Sass          = require 'gulp-sass'
Cleaner       = require 'del'
Autoprefixer  = require 'gulp-autoprefixer'
Uglify        = require 'gulp-uglify'
Plumber       = require 'gulp-plumber'


if Yargs.argv.env and Yargs.argv.env in ['dev', 'prod']
  env =  Yargs.argv.env
else
  env = 'dev'  # by default

# @var appRoot absolutely path to project root
appRoot = Path.normalize '..'
# @var moduleRoot absolutely path to application module to handle
moduleRoot = Path.join appRoot, 'frontend'
# @var webRoot absolutely path to public web directory
webRoot = Path.join moduleRoot, 'web'


listeningScripts = []
listeningStyles = []


### TASKS ###

Gulp.task 'default', ->
  GUtil.log env

Gulp.task 'scripts', ->
  Cleaner(Path.join webRoot, 'assets')
  thread = Gulp.src(listeningScripts)
  .pipe(Changed(Path.join webRoot, 'assets'))
  .pipe(Plumber())
  .pipe(Coffee({bare: false}))
  if env == 'prod' then thread.pipe(Uglify())
  thread.pipe(Gulp.dest(Path.join webRoot, 'assets'))

Gulp.task 'styles', ->
  Cleaner(Path.join webRoot, 'assets')
  form = if env == 'dev' then 'expanded' else 'compressed'
  Gulp.src(listeningStyles)
  .pipe(Changed(Path.join webRoot, 'assets'))
  .pipe(Sass({outputStyle : form}).on('error', Sass.logError))
  .pipe(Autoprefixer())
  .pipe(Gulp.dest(Path.join webRoot, 'assets'))

Gulp.task 'listen', ->
  Gulp.watch(listeningStyles, ['styles'])
  Gulp.watch(listeningScripts, ['scripts'])