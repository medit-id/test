<?php

namespace Deployer;

require 'recipe/laravel.php';


// Project name
set('application', 'api.medit');

// Project repository
set('repository', 'git@github.com:medit-id/test.git');

// [Optional] Allocate tty for git clone. Default value is false.
set('git_tty', false); 

// Shared files/dirs between deploys 
add('shared_files', [
    'database/database.sqlite'
]);
add('shared_dirs', []);

// Writable dirs by web server 
add('writable_dirs', []);
set('allow_anonymous_stats', false);

// Hosts
host('fathur.gcloud')
    ->stage('development')
    ->set('deploy_path', '/home/ubuntu/sites/{{application}}/development');    
    
host('fathur.gcloud')
    ->stage('production')
    ->set('deploy_path', '/home/ubuntu/sites/{{application}}/production');    

host('fathur.gcloud')
    ->stage('staging')
    ->set('deploy_path', '/home/ubuntu/sites/{{application}}/staging');    
// Tasks

task('build', function () {
    run('cd {{release_path}} && build');
});

// [Optional] if deploy fails automatically unlock.
after('deploy:failed', 'deploy:unlock');

// Migrate database before symlink new release.

before('deploy:symlink', 'artisan:migrate');

