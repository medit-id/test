<?php

namespace Deployer;

require 'recipe/laravel.php';


// Project name
set('application', 'api.medit');

// Project repository
set('repository', 'git@github.com:medit-id/test.git');

// [Optional] Allocate tty for git clone. Default value is false.
set('git_tty', true); 

// Shared files/dirs between deploys 
add('shared_files', [
    'database/database.sqlite'
]);
add('shared_dirs', []);

// Writable dirs by web server 
add('writable_dirs', []);
set('allow_anonymous_stats', false);

// Hosts
set('environment', $_ENV['INPUT_APP_ENV']);

host($_ENV['INPUT_SSH_HOST'])
    ->stage('{{environment}}')
    ->set('deploy_path', '/home/ubuntu/sites/{{application}}/{{environment}}');    
    
// Tasks

task('build', function () {
    run('cd {{release_path}} && build');
});

// [Optional] if deploy fails automatically unlock.
after('deploy:failed', 'deploy:unlock');

// Migrate database before symlink new release.

before('deploy:symlink', 'artisan:migrate');

