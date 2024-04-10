<?php
namespace Deployer;

require 'recipe/laravel.php';

// Zone ühendus

set('application', 'merilyn-hajusrakendused');
set('remote_user', 'virt118419');
set('http_user', 'virt118419');
set('keep_releases', 2);

host('ta22tohv.itmajakas.ee')
    ->setHostname('ta22tohv.itmajakas.ee')
    ->set('http_user', 'virt118419')
    ->set('deploy_path', '~/domeenid/www.ta22tohv.itmajakas.ee/hajusrakendus')
    ->set('branch', 'main');

set('repository', 'git@github.com:merilyntohv/merilyn-hajusrakendused.git');

//tasks
task('opcache:clear', function () {
    run('killall php82-cgi || true');
})->desc('Clear opcache');

task('build:node', function (){
    cd('{{release_path}}');
    run('npm i');
    run('npx vite build');
    run('rm -rf node_modules');
});

task('deploy',[
    'deploy:prepare',
    'deploy:vendors',
    'artisan:storage:link',
    'artisan:view:cache',
    'artisan:config:cache',
    'build:node',
    'deploy:publish',
    'opcache:clear',
    'artisan:cache:clear'
]);

// Hosts



// Hooks

after('deploy:failed', 'deploy:unlock');
