<?php
namespace Deployer;

require 'recipe/laravel.php';

// Project name
set('application', 'laravel');

// Project repository
set('repository', 'git@github.com:rroslan/laravel.git');

// [Optional] Allocate tty for git clone. Default value is false.
set('git_tty', true); 

// Shared files/dirs between deploys 
add('shared_files', []);
add('shared_dirs', []);

// Writable dirs by web server
set('http_user', 'www-data');
add('writable_dirs', []);


// Hosts

host('www.eastservices.biz')
    ->user('deployer')
    ->identityFile('~/.ssh/deployer')
    ->set('deploy_path', '/var/www/laravel');
    
// Tasks

task('build', function () {
    run('cd {{release_path}} && build');
});

// [Optional] if deploy fails automatically unlock.
after('deploy:failed', 'deploy:unlock');

//Migrate database before symlink new release.

before('deploy:symlink', 'artisan:migrate');

